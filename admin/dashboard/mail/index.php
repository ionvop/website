<?php

chdir("../../../");
require_once "common.php";

if (isAuthed() == false) {
    header("Location: ../../");
    exit;
}

$id = $_GET["id"] ?? null;

if ($id == null || $id == "") {
    header("Location: ../");
    exit;
}

$mail = executePreparedQuery($db, <<<SQL
    SELECT *
    FROM `mails`
    WHERE `id` = :id
SQL, [
    ":id" => $id
])->fetchArray();

if ($mail == false) {
    http_response_code(404);
}

?>

<html>
    <head>
        <title>
            Mail
        </title>
        <base href="../../../">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <style>
            body > .main {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg3.webp");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;

                & > .content {
                    & > .topbar {
                        display: grid;
                        grid-template-columns: max-content 1fr max-content;
                        align-items: center;
                        gap: 1rem;
                        padding: 1rem;

                        & > .title {
                            font-weight: bold;
                        }
                    }

                    & > .dashboard {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 2rem;
                        align-items: start;

                        & > .mail {
                            background-color: #000a;
                            border-radius: 1rem;
                            padding: 1rem;

                            & > .subject {
                                font-size: 1.2rem;
                                font-weight: bold;
                            }

                            & > .meta {
                                font-size: 0.8rem;
                                color: #aaa;
                            }

                            & > .body {
                                padding: 1rem 0;
                                white-space: pre-wrap;
                            }

                            & > .actions {
                                padding-top: 1rem;
                                text-align: right;

                                & > button {
                                    background-color: #f00;
                                }
                            }
                        }

                        & > .chat {
                            & > .title {
                                padding: 1rem;
                                font-weight: bold;
                            }

                            & > .container {
                                & > .box {
                                    background-color: #000a;
                                    border-radius: 1rem;
                                    height: 30rem;
                                    overflow-x: hidden;
                                    overflow-y: auto;

                                    & > .render {
                                        & > .item {
                                            padding: 1rem;

                                            & > .text {
                                                padding: 1rem;
                                                border-radius: 1rem;
                                                max-width: 30rem;
                                            }
                                        }

                                        & > .item--ai {
                                            display: grid;
                                            grid-template-columns: max-content 1fr;

                                            & > .text {
                                                background-color: var(--theme);
                                            }
                                        }

                                        & > .item--user {
                                            display: grid;
                                            grid-template-columns: 1fr max-content;

                                            & > .text {
                                                background-color: #555;
                                            }
                                        }
                                    }

                                    & > .loader {
                                        display: grid;
                                        grid-template-columns: max-content 1fr;
                                        transition-duration: 1s;
                                        opacity: 0%;
                                        height: 0rem;
                                        overflow: hidden;

                                        & > .icon {
                                            padding: 5rem;
                                            padding-top: 1rem;
                                            padding-bottom: 1rem;
                                            color: var(--theme--contrast);

                                            & > svg {
                                                width: 5rem;
                                                height: 5rem;
                                            }
                                        }
                                    }
                                }
                            }

                            & > .reply {
                                padding: 1rem;

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

                                            & > svg {
                                                width: 1.5rem;
                                                height: 1.5rem;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            @media (orientation: portrait) {
                body > .main {
                    & > .content {
                        & > .dashboard {
                            grid-template-columns: 1fr;
                        }
                    }
                }
            }
        </style>
    </head>
    <body>
        <div class="main -main">
            <div class="content -content">
                <div class="topbar">
                    <div class="back">
                        <button class="-button" onclick="location.href = '../'">
                            Back
                        </button>
                    </div>
                    <div class="title -title">
                        <?= $mail == false ? "Not Found" : esc($mail["subject"]) ?>
                    </div>
                    <div class="logout">
                        <button class="-button" id="btnLogout">
                            Logout
                        </button>
                    </div>
                </div>
                <div class="dashboard">
                    <div class="mail">
                        <?php
                            if ($mail == false) {
                                echo <<<HTML
                                    <div class="body">
                                        This mail does not exist or was deleted.
                                    </div>
                                HTML;
                            } else {
                                $id = esc($mail["id"]);
                                $subject = esc($mail["subject"]);
                                $author = esc($mail["author"]);
                                $email = esc($mail["email"]);
                                $createdAt = esc($mail["created_at"]);
                                $content = esc($mail["content"]);

                                echo <<<HTML
                                    <div class="subject">
                                        {$subject}
                                    </div>
                                    <div class="meta">
                                        {$author} &middot; {$email} &middot; {$createdAt}
                                    </div>
                                    <div class="body">
                                        {$content}
                                    </div>
                                    <div class="actions">
                                        <button class="-button" id="btnDelete" data-id="{$id}">
                                            Delete
                                        </button>
                                    </div>
                                HTML;
                            }
                        ?>
                    </div>
                    <div>
                        <div class="title -title">
                            Hatsune Pinku
                        </div>
                        <?= renderChatAssistant() ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        <?= chatAssistantJS("adminChatSessionKey", "api/chat/", $mail == false ? null : intval($mail["id"])) ?>

        animatePage([
            {target: "body > .main > .content > .topbar > .back", type: "-intro__float__left"},
            {target: "body > .main > .content > .topbar > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .mail", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > div > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > div > .chat > .container > .box", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > div > .chat > .reply", type: "-intro__float__left"}
        ]);

        const btnDelete = document.getElementById("btnDelete");
        const btnLogout = document.getElementById("btnLogout");

        if (btnDelete != null) {
            btnDelete.onclick = async () => {
                const id = btnDelete.dataset.id;
                if (id == null || confirm("Delete this mail?") == false) return;

                btnDelete.disabled = true;

                const response = await fetch(`api/admin/mail/?id=${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json"
                    }
                });

                if (!response.ok) {
                    alert("Failed to delete mail.");
                    btnDelete.disabled = false;
                    return;
                }

                location.href = "../";
            }
        }

        btnLogout.onclick = async () => {
            const response = await fetch("api/admin/", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                }
            });

            if (response.ok) {
                location.href = "../../";
            }
        }
    </script>
</html>
