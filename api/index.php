<?php

chdir(dirname(__DIR__, 1));
require_once "common.php";
header("Content-Type: application/json");
echo json_encode(["message" => "Hello, world!"]);