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
                        grid-template-columns: 1fr max-content;
                        align-items: center;
                        padding: 1rem;

                        & > .title {
                            font-weight: bold;
                        }
                    }

                    & > .dashboard {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 2rem;

                        & > .mails {
                            & > .title {
                                padding: 1rem;
                                font-weight: bold;
                            }

                            & > .list {
                                background-color: #000a;
                                border-radius: 1rem;
                                height: 30rem;
                                overflow-y: auto;

                                & > .item {
                                    padding: 1rem;
                                    border-bottom: 0.1rem solid #333;
                                    cursor: pointer;
                                    user-select: none;

                                    &:hover {
                                        background-color: #222;
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
                                margin-top: 1rem;

                                & > .subject {
                                    font-size: 1.2rem;
                                    font-weight: bold;
                                }

                                & > .meta {
                                    font-size: 0.8rem;
                                    color: #aaa;
                                }

                                & > .body {
                                    padding: 1rem;
                                    white-space: pre-wrap;
                                }

                                & > .delete {
                                    padding: 1rem;
                                    text-align: right;

                                    & > button {
                                        background-color: #f00;
                                    }
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
                            <div class="delete">
                                <button class="-button" id="btnDelete">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="chat">
                        <div class="title -title">
                            Hatsune Pinku
                        </div>
                        <div class="container">
                            <div class="box" id="panelBox">
                                <div class="render" id="panelRender">
                                    <div class="item--ai item">
                                        <div class="item--ai__text text -intro -intro__float__left">
                                            Hello! ✨ I'm Hatsune Pinku and I will be your assistant regarding your messages for ionvop. 💖
                                        </div>
                                        <div></div>
                                    </div>
                                </div>
                                <div class="loader" id="panelLoader">
                                    <div class="icon">
                                        <?= loader("rings") ?>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <div class="reply">
                            <div class="box">
                                <div class="input">
                                    <input class="-input" id="inputReply" placeholder="Write a reply" oninput="inputReply(this)" onkeydown="if (event.key == 'Enter') inputReplyEnter(this)">
                                </div>
                                <div class="button">
                                    <button class="-button" id="btnSend" disabled>
                                        <?= icon("send") ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        const panelBox = document.getElementById("panelBox");
        const panelRender = document.getElementById("panelRender");
        const panelLoader = document.getElementById("panelLoader");
        const inputReply = document.getElementById("inputReply");
        const btnSend = document.getElementById("btnSend");
        const mailList = document.getElementById("mailList");
        const mailDetail = document.getElementById("mailDetail");
        const detailSubject = document.getElementById("detailSubject");
        const detailMeta = document.getElementById("detailMeta");
        const detailBody = document.getElementById("detailBody");
        const btnDelete = document.getElementById("btnDelete");
        const btnLogout = document.getElementById("btnLogout");
        const mails = <?=json_encode($mails)?>;

        (() => {
            restoreHistory();
        })();

        function getSessionKey() {
            return localStorage.getItem("adminChatSessionKey");
        }

        function setSessionKey(key) {
            localStorage.setItem("adminChatSessionKey", key);
        }

        function escapeHtml(text) {
            const div = document.createElement("div");
            div.textContent = text;
            return div.innerHTML;
        }

        function renderMessage(role, content, animate = true) {
            const isUser = role == "user";
            const body = isUser ? escapeHtml(content) : marked.parse(content);
            const intro = animate ? " -intro -intro__float__" + (isUser ? "right" : "left") : "";

            const item = elementFromHTML(/*html*/`
                <div class="item ${isUser ? "item--user" : "item--ai"}">
                    <div></div>
                    <div class="text ${isUser ? "" : "item--ai__text"}${intro}">
                        ${body}
                    </div>
                </div>
            `);

            panelRender.appendChild(item);

            for (const anchor of item.querySelectorAll("a")) {
                anchor.setAttribute("target", "_blank");
            }

            scrollToPosition(panelBox, 1, 1000, "easeInOut");
        }

        async function restoreHistory() {
            const key = getSessionKey();

            if (key == null) {
                return;
            }

            const response = await fetch("api/chat/" + "?key=" + encodeURIComponent(key));

            if (!response.ok) {
                localStorage.removeItem("adminChatSessionKey");
                return;
            }

            const data = await response.json();

            if (data.messages == null || data.messages.length == 0) {
                return;
            }

            panelRender.innerHTML = "";

            for (const message of data.messages) {
                renderMessage(message.role, message.content, false);
            }
        }

        animatePage([
            {target: "body > .main > .content > .topbar > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .mails > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .mails > .list", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .chat > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .chat > .container > .box", type: "-intro__float__left"},
            {target: "body > .main > .content > .dashboard > .chat > .reply", type: "-intro__float__left"}
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
            mailDetail.hidden = false;
            btnDelete.dataset.id = mail.id;
        }

        btnDelete.onclick = async () => {
            const id = btnDelete.dataset.id;
            if (id == null || confirm("Delete this mail?") == false) return;

            const response = await fetch(`api/admin/mail/?id=${id}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                }
            });

            if (!response.ok) {
                alert("Failed to delete mail.");
                return;
            }

            mails = mails.filter(m => m.id != id);
            mailDetail.hidden = true;

            for (const item of mailList.querySelectorAll(".item")) {
                if (item.getAttribute("data-id") == id) {
                    item.remove();
                }
            }

            if (mails.length == 0) {
                mailList.innerHTML = '<div class="empty">No mails yet.</div>';
            }
        }

        btnLogout.onclick = async () => {
            const response = await fetch("api/admin/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                }
            });

            if (response.ok) {
                location.href = "admin/";
            }
        }

        btnSend.onclick = async () => {
            let content = inputReply.value.trim();

            if (content == "") return;

            renderMessage("user", content);

            inputReply.value = "";
            inputReply.disabled = true;
            btnSend.disabled = true;
            panelLoader.style.height = "auto";
            panelLoader.style.opacity = "100%";

            try {
                let response = await fetch(ENDPOINT, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        key: getSessionKey() ?? undefined,
                        content: content
                    })
                });

                let data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || ("Request failed (" + response.status + ")"));
                }

                setSessionKey(data.key);

                panelLoader.style.opacity = "0%";
                await new Promise(resolve => setTimeout(resolve, 1000));
                panelLoader.style.height = "0rem";

                renderMessage("assistant", data.reply);
            } catch (error) {
                panelLoader.style.opacity = "0%";
                panelLoader.style.height = "0rem";
                renderMessage("assistant", "⚠️ " + error.message);
            }

            inputReply.disabled = false;
            btnSend.disabled = false;
        }

        inputReply.oninput = () => {
            btnSend.disabled = inputReply.value == "";
        }

        inputReply.onkeydown = (event) => {
            if (event.key == "Enter") {
                btnSend.click();
            }
        }
    </script>
</html>
