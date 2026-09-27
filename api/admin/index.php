<?php

chdir(dirname(__DIR__, 2));
require_once "common.php";
$data = json_decode(file_get_contents('php://input'), true);

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        $password = $data["password"] ?? "";
        $ok = attemptLogin($password);

        if ($ok == false) {
            http_response_code(401);
            echo json_encode(["message" => "Incorrect password."]);
            exit;
        }

        echo json_encode(["ok" => true]);
        exit;
    case "DELETE":
        logout();
        echo json_encode(["ok" => true]);
        exit;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        exit;
}