<?php

chdir("../");
require_once "common.php";

if (isAuthed()) {
    header("Location: dashboard/");
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
                height: 100%;
                box-sizing: border-box;

                & > .content {
                    display: flex;
                    align-items: center;
                    height: 100%;
                    box-sizing: border-box;

                    & > .login {
                        width: 100%;
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
        const inputPassword = document.getElementById("inputPassword");
        const btnLogin = document.getElementById("btnLogin");
        const loginError = document.getElementById("loginError");

        btnLogin.onclick = async () => {
            const password = inputPassword.value;
            if (password == "") return;
            btnLogin.disabled = true;

            try {
                const response = await fetch("api/admin/", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        password: password
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || ("Request failed (" + response.status + ")"));
                }

                location.href = "admin/dashboard/";
            } catch (error) {
                loginError.textContent = "⚠️ " + error.message;
                btnLogin.disabled = false;
            }
        }

        animatePage([]);
    </script>
</html>