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

    $tools = [
        [
            "type" => "function",
            "function" => [
                "name" => "message_ionvop",
                "description" => "Send a casual message to ionvop. Call this when the user wants a message to be sent to ionvop, or if you lack the information to answer the user's question.",
                "parameters" => [
                    "type" => "object",
                    "properties" => [
                        "subject" => [
                            "type" => "string",
                            "description" => "The subject of the message."
                        ],
                        "content" => [
                            "type" => "string",
                            "description" => "Your message to be sent to ionvop."
                        ],
                        "additional_context" => [
                            "type" => "string",
                            "description" => "Additional context if any to be included in the message."
                        ],
                        "email" => [
                            "type" => "string",
                            "description" => "The email address of the user for ionvop to contact, unless if the user requests to remain anonymous or if the message is coming from you."
                        ]
                    ],
                    "required" => [
                        "subject", "content"
                    ],
                    "additionalProperties" => false,
                    "strict" => true
                ]
            ]
        ]
    ];

    $headers = [
        "Content-Type: application/json",
        "Accept: application/json",
        "Authorization: Bearer {$OPENAI_API_KEY}"
    ];

    $body = [
        "model" => "gpt-4o-mini",
        "messages" => $history,
        "tools" => $tools
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

    if ($response["choices"][0]["finish_reason"] == "tool_calls") {
        switch ($response["choices"][0]["message"]["tool_calls"][0]["function"]["name"]) {
            case "message_ionvop":
                $obj = json_decode($response["choices"][0]["message"]["tool_calls"][0]["function"]["arguments"], true);
                $subject = $obj["subject"];
                $content = $obj["content"];
                $context = "";

                if (isset($obj["additional_context"])) {
                    $context = $obj["additional_context"];
                    $context .= "\n\nDate sent: " . date("Y-m-d H:i:s");
                } else {
                    $context = "Date sent: " . date("Y-m-d H:i:s");
                }
                
                if (isset($obj["email"])) {
                    $context .= "\n\nUser's email: " . $obj["email"];
                }

                $adminData = file_get_contents("../admin/data.json");
                $adminData = json_decode($adminData, true);

                $chat = [
                    "id" => uniqid("chat"),
                    "title" => $subject,
                    "context" => $context,
                    "time" => time(),
                    "modified" => time()
                ];

                $message = [
                    "id" => uniqid("message"),
                    "chatId" => $chat["id"],
                    "role" => "assistant",
                    "content" => $content,
                    "time" => time()
                ];

                $adminData["chats"][] = $chat;
                $adminData["messages"][] = $message;
                file_put_contents("../admin/data.json", json_encode($adminData));

                $history[] = [
                    "role" => "system",
                    "content" => "You have sent a message to ionvop."
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

                break;
        }
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