<?php

chdir("../../");
require_once "common.php";

if (isAuthed() == false) {
    header("Location: ../");
    exit;
}

$mails = [];

$result = executePreparedQuery($db, <<<SQL
    SELECT *
    FROM `mails`
    ORDER BY `id` DESC
SQL);

while ($row = $result->fetchArray()) {
    $mails[] = $row;
}

?>

<html>
    <head>
        <title>
            Admin
        </title>
        <base href="../../">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            html, body {
                height: 100%;
                box-sizing: border-box;
            }

            body > .main {
                height: 100%;
                box-sizing: border-box;
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg3.webp");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;

                & > .content {
                    height: 100%;
                    box-sizing: border-box;
                    display: flex;
                    flex-direction: column;

                    & > .topbar {
                        flex: 0 0 auto;
                        display: grid;
                        grid-template-columns: 1fr max-content;
                        align-items: center;
                        padding: 1rem;

                        & > .title {
                            font-weight: bold;
                        }
                    }

                    & > .dashboard {
                        flex: 1 1 auto;
                        min-height: 0;
                        width: 100%;
                        box-sizing: border-box;
                        padding: 0 1rem 1rem;

                        & > .mails {
                            height: 100%;
                            box-sizing: border-box;
                            display: grid;
                            grid-template-columns: 1fr;
                            grid-template-rows: max-content 1fr;
                            gap: 1rem;

                            &.selected {
                                grid-template-columns: 1fr 1fr;
                            }

                            & > .title {
                                grid-column: 1 / -1;
                                padding: 1rem;
                                font-weight: bold;
                            }

                            & > .list {
                                background-color: #000a;
                                border-radius: 1rem;
                                height: 100%;
                                box-sizing: border-box;
                                min-height: 0;
                                overflow-y: auto;

                                & > .item {
                                    padding: 1rem;
                                    border-bottom: 0.1rem solid #333;
                                    cursor: pointer;
                                    user-select: none;
                                    transition-duration: 0.1s;

                                    &:hover {
                                        background-color: #222;
                                    }

                                    &.selected {
                                        background-color: var(--theme--dark);
                                    }

                                    & > .subject {
                                        font-weight: bold;
                                    }

                                    & > .meta {
                                        font-size: 0.8rem;
                                        color: #aaa;
                                    }
                                }

                                & > .empty {
                                    padding: 2rem;
                                    color: #aaa;
                                    text-align: center;
                                }
                            }

                            & > .detail {
                                background-color: #000a;
                                border-radius: 1rem;
                                padding: 1rem;
                                height: 100%;
                                box-sizing: border-box;
                                min-height: 0;
                                overflow-y: auto;

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
                                    text-align: right;
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
                            & > .mails {
                                grid-template-columns: 1fr;
                                grid-template-rows: max-content 1fr 1fr;
                            }
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
                    <div class="title -title">
                        Admin
                    </div>
                    <div class="logout">
                        <button class="-button" id="btnLogout">
                            Logout
                        </button>
                    </div>
                </div>
                <div class="dashboard">
                    <div class="mails">
                        <div class="title -title">
                            Mails
                        </div>
                        <div class="list" id="mailList">
                            <?php
                                if (empty($mails)) {
                                    echo <<<HTML
                                        <div class="empty">
                                            No mails yet.
                                        </div>
                                    HTML;
                                } else {
                                    foreach ($mails as $mail) {
                                        $id = esc($mail["id"]);
                                        $subject = esc($mail["subject"]);
                                        $author = esc($mail["author"]);
                                        $createdAt = esc($mail["created_at"]);

                                        echo <<<HTML
                                            <div class="item" data-id="{$id}" onclick="selectMail(this)">
                                                <div class="subject">
                                                    {$subject}
                                                </div>
                                                <div class="meta">
                                                    {$author} &middot; {$createdAt}
                                                </div>
                                            </div>
                                        HTML;
                                    }
                                }
                            ?>
                        </div>
                        <div class="detail" id="mailDetail" hidden>
                            <div class="subject" id="detailSubject"></div>
                            <div class="meta" id="detailMeta"></div>
                            <div class="body" id="detailBody"></div>
                            <div class="actions">
                                <button class="-button" id="btnOpen">
                                    Open
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        const mailList = document.getElementById("mailList");
        const mailDetail = document.getElementById("mailDetail");
        const mailsPanel = document.querySelector(".mails");
        const detailSubject = document.getElementById("detailSubject");
        const detailMeta = document.getElementById("detailMeta");
        const detailBody = document.getElementById("detailBody");
        const btnOpen = document.getElementById("btnOpen");
        const btnLogout = document.getElementById("btnLogout");
        const mails = <?=json_encode($mails)?>;

        animatePage([
            {target: "body > .main > .content > .topbar > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .mails > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .mails > .list", type: "-intro__float__left"}
        ]);

        function selectMail(element) {
            const id = parseInt(element.getAttribute("data-id"));
            const mail = mails.find(m => m.id == id);

            if (mail == null) return;

            for (const item of mailList.querySelectorAll(".item")) {
                item.classList.remove("selected");
            }

            element.classList.add("selected");
            detailSubject.textContent = mail.subject;
            detailMeta.textContent = (mail.author || "N/A") + " · " + (mail.email || "N/A") + " · " + mail.created_at;
            detailBody.textContent = mail.content;
            btnOpen.dataset.id = mail.id;
            mailDetail.hidden = false;
            mailsPanel.classList.add("selected");
        }

        btnOpen.onclick = () => {
            const id = btnOpen.dataset.id;
            if (id == null) return;
            location.href = "admin/dashboard/mail/?id=" + encodeURIComponent(id);
        }

        btnLogout.onclick = async () => {
            const response = await fetch("api/admin/", {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                }
            });

            if (response.ok) {
                location.href = "admin/";
            }
        }
    </script>
</html>
