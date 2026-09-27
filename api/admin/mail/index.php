<?php

chdir(dirname(__DIR__, 3));
require_once "common.php";
$data = json_decode(file_get_contents('php://input'), true);

if (isAuthed() == false) {
    http_response_code(401);
    echo json_encode(["message" => "Unauthorized"]);
    exit;
}

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = executePreparedQuery($db, <<<SQL
            SELECT *
            FROM `mails`
            ORDER BY `id` DESC
        SQL);

        $mails = [];

        while ($row = $result->fetchArray()) {
            $mails[] = $row;
        }

        echo json_encode(["mails" => $mails]);
    case "DELETE":
        if (isset($_GET["id"]) == false) {
            http_response_code(400);
            echo json_encode(["message" => "Missing 'id' parameter"]);
            exit;
        }

        executePreparedQuery($db, <<<SQL
            DELETE FROM `mails` WHERE `id` = :id
        SQL, [
            ":id" => $_GET["id"]
        ]);

        echo json_encode(["ok" => true]);
        exit;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        exit;
}