<?php

chdir(dirname(__DIR__, 2));
require_once "common.php";
$data = json_decode(file_get_contents('php://input'), true);

function findSessionId(string $key): int | false {
    global $db;
    
    $row = executePreparedQuery($db, <<<SQL
        SELECT `id` FROM `sessions` WHERE `key` = :key
    SQL, [
        ":key" => $key
    ])->fetchArray();

    if ($row == false) {
        return false;
    }

    return $row["id"];
}

function loadHistory(int $sessionId): array {
    global $db;
    
    $result = executePreparedQuery($db, <<<SQL
        SELECT `role`, `content` FROM `messages` WHERE `session_id` = :session_id ORDER BY `id` ASC
    SQL, [
        ":session_id" => $sessionId
    ]);

    $history = [];
    
    while ($row = $result->fetchArray()) {
        $history[] = [
            "role" => $row["role"],
            "content" => $row["content"]
        ];
    }

    return $history;
}

function createSession(): int {
    global $db;
    $key = uniqid("session");

    executePreparedQuery($db, <<<SQL
        INSERT INTO `sessions` (`key`) VALUES (:key)
    SQL, [
        ":key" => $key
    ]);

    return $db->lastInsertRowID();
}

function insertMessage(int $sessionId, string $role, string $content) {
    global $db;

    executePreparedQuery($db, <<<SQL
        INSERT INTO `messages` (`session_id`, `role`, `content`) VALUES (:session_id, :role, :content)
    SQL, [
        ":session_id" => $sessionId,
        ":role" => $role,
        ":content" => $content
    ]);
}

function askModel(array $history): array {
    global $OPENROUTER_API_KEY, $MODEL;

    $response = fetch("https://openrouter.ai/api/v1/chat/completions", [
        "method" => "POST",
        "headers" => [
            "Content-Type" => "application/json",
            "Authorization" => "Bearer {$OPENROUTER_API_KEY}"
        ],
        "body" => [
            "model" => $MODEL,
            "messages" => $history,
            "response_format" => [
                "type" => "json_schema",
                "json_schema" => json_decode(file_get_contents("assets/response-format.json"), true)
            ]
        ],
        "timeout" => 120
    ]);

    if ($response["ok"] == false) {
        $error = $response["json"]["error"]["message"] ?? "OpenRouter request failed.";
        return ["ok" => false, "error" => $error];
    }

    $content = $response["json"]["choices"][0]["message"]["content"];
    return ["ok" => true, "content" => $content];
}

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $key = $_GET["key"] ?? null;

        if ($key == null || $key == "") {
            http_response_code(400);
            echo json_encode(["message" => "Missing 'key' query parameter."]);
            exit;
        }

        $sessionId = findSessionId($key);

        if ($sessionId == false) {
            http_response_code(404);
            echo json_encode(["message" => "Session not found."]);
            exit;
        }

        $messages = loadHistory($sessionId);

        echo json_encode([
            "key" => $key,
            "messages" => $messages
        ]);

        exit;
    case "POST":
        $key = $data["key"] ?? null;
        $content = $data["content"] ?? null;

        if ($content == null || trim($content) == "") {
            http_response_code(400);
            echo json_encode(["message" => "Missing 'content' field."]);
            exit;
        }

        if ($key == null || $key == "") {
            $sessionId = createSession();

            $key = executePreparedQuery($db, <<<SQL
                SELECT `key` FROM `sessions` WHERE `id` = :sessionId
            SQL, [
                ":sessionId" => $sessionId
            ])->fetchArray()["key"];

            insertMessage($sessionId, "assistant", "Hello! ✨ I'm Hatsune Pinku and I will be your assistant regarding your messages for ionvop. 💖");
        } else {
            $sessionId = findSessionId($key);

            if ($sessionId == false) {
                http_response_code(404);
                echo json_encode(["message" => "Session not found."]);
                exit;
            }
        }

        insertMessage($sessionId, "user", $content);
        $history = loadHistory($sessionId);

        array_unshift($history, [
            "role" => "system",
            "content" => file_get_contents("assets/prompt.md")
        ]);

        $answer = askModel($history);

        if ($answer["ok"] == false) {
            http_response_code(502);
            echo json_encode(["message" => $answer["error"]]);
            exit;
        }

        $parsed = json_decode($answer["content"], true);

        if (!is_array($parsed) || !isset($parsed["response"])) {
            http_response_code(502);
            echo json_encode(["message" => "The model returned an invalid response."]);
            exit;
        }

        $response = $parsed["response"];
        $reply = $response["reply"] ?? "";

        if (($response["type"] ?? null) == "mail_to_ionvop" && isset($response["mail"])) {
            $mail = $response["mail"];

            $subject = trim($mail["subject"] ?? "");
            $author = trim($mail["name"] ?? "");
            $email = trim($mail["email"] ?? "");
            $body = trim($mail["body"] ?? "");

            $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
            $valid = $subject !== "" && $body !== "" && mb_strlen($subject) <= 100 && mb_strlen($body) <= 2000;

            // Require a valid email unless the user explicitly wants to remain anonymous.
            if ($email !== "" && $email !== "N/A" && $validEmail === false) {
                $valid = false;
            }

            if ($valid) {
                executePreparedQuery($db, <<<SQL
                    INSERT INTO `mails` (`session_id`, `subject`, `author`, `email`, `content`)
                    VALUES (:session_id, :subject, :author, :email, :content)
                SQL, [
                    ":session_id" => $sessionId,
                    ":subject" => $subject,
                    ":author" => $author === "" ? "N/A" : $author,
                    ":email" => $email === "" ? "N/A" : $email,
                    ":content" => $body
                ]);
            } else {
                $reply = "I couldn't send that mail because it was missing required details or looked like spam. Please provide a valid email, a subject, and a meaningful message, and try again. 💖";
            }
        }

        insertMessage($sessionId, "assistant", $reply);

        echo json_encode([
            "key" => $key,
            "reply" => $reply
        ]);

        exit;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        exit;
}