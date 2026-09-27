<?php

chdir("../");
require_once "common.php";

// ---------------------------------------------------------------------------
// Auth gate
// ---------------------------------------------------------------------------

// Already logged in? Go straight to the dashboard.
if (isAuthed()) {
    header("Location: dashboard/");
    exit;
}

// Handle login POSTs before rendering.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data["action"] ?? null;

    if ($action == "login") {
        $password = $data["password"] ?? "";
        $ok = attemptLogin($password);

        if ($ok == false) {
            http_response_code(401);
            echo json_encode(["message" => "Incorrect password."]);
            exit;
        }

        echo json_encode(["ok" => true]);
        exit;
    }

    http_response_code(400);
    echo json_encode(["message" => "Unknown action."]);
    exit;
}

?>

<html>
    <head>
        <title>
            Admin
        </title>
        <base href="../">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body > .main {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg3.webp");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;

                & > .content {
                    & > .login {
                        padding: 10rem;
                        padding-top: 5rem;

                        & > .title {
                            padding: 1rem;
                            font-weight: bold;
                        }

                        & > .box {
                            display: grid;
                            grid-template-columns: 1fr max-content;
                            border-radius: 1rem;
                            overflow: hidden;

                            & > .input {
                                & > input {
                                    height: 100%;
                                    box-sizing: border-box;
                                }
                            }

                            & > .button {
                                & > button {
                                    height: 100%;
                                    box-sizing: border-box;
                                }
                            }
                        }

                        & > .error {
                            padding: 1rem;
                            color: #f00;
                        }
                    }

                }
            }
        </style>
    </head>
    <body>
        <div class="main -main">
            <div class="content -content">
                <div class="login">
                    <div class="title -title -center">
                        Admin Access
                    </div>
                    <div class="box">
                        <div class="input">
                            <input class="-input" id="inputPassword" type="password" placeholder="Password" onkeydown="if (event.key == 'Enter') btnLogin.click()">
                        </div>
                        <div class="button">
                            <button class="-button" id="btnLogin">
                                Unlock
                            </button>
                        </div>
                    </div>
                    <div class="error" id="loginError"></div>
                </div>
            </div>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        let inputPassword = document.getElementById("inputPassword");
        let btnLogin = document.getElementById("btnLogin");
        let loginError = document.getElementById("loginError");

        btnLogin.onclick = async () => {
            let password = inputPassword.value;

            if (password == "") return;

            btnLogin.disabled = true;

            try {
                let response = await fetch("admin/", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        action: "login",
                        password: password
                    })
                });

                let data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || ("Request failed (" + response.status + ")"));
                }

                location.href = "dashboard/";
            } catch (error) {
                loginError.textContent = "⚠️ " + error.message;
                btnLogin.disabled = false;
            }
        }

        animatePage([]);
    </script>
</html>