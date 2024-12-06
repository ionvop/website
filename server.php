<?php

include("common.php");
Debug();
header("Content-type: application/json");
$_POST = json_decode(file_get_contents('php://input'), true);

if (isset($_POST["method"])) {
    switch ($_POST["method"]) {
        case "sendMessage":
            SendMessage();
            break;
        default:
            DefaultMethod();
            break;
    }
} else {
    DefaultMethod();
}

function SendMessage() {
    global $OPENAI_API_KEY;

    $history = $_POST["history"];

    array_unshift($history, [
        "role" => "system",
        "content" => file_get_contents("assets/prompt.txt")
    ]);

    $headers = [
        "Content-Type: application/json",
        "Accept: application/json",
        "Authorization: Bearer {$OPENAI_API_KEY}"
    ];

    $body = [
        "model" => "gpt-4o-mini",
        "messages" => $history
    ];

    $response = SendCurl("https://api.openai.com/v1/chat/completions", "POST", $headers, json_encode($body));
    $response = json_decode($response, true);

    if (isset($response["error"])) {
        echo json_encode([
            "status" => 500,
            "message" => $response["error"]["message"]
        ]);

        exit();
    }

    echo json_encode([
        "status" => 200,
        "message" => $response["choices"][0]["message"]["content"]
    ]);
}

function DefaultMethod() {
    echo json_encode([
        "status" => "error",
        "message" => "Method not found"
    ]);
}