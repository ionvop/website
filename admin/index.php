<?php

chdir("../");
require_once "common.php";

// ---------------------------------------------------------------------------
// Auth gate
// ---------------------------------------------------------------------------

$ADMIN_PASSWORD = $ADMIN_PASSWORD ?? "";

function isAuthed(): bool {
    session_start();
    return ($_SESSION["admin"] ?? false) == true;
}

function attemptLogin(string $password): bool {
    global $ADMIN_PASSWORD;

    if ($ADMIN_PASSWORD == "") {
        return false;
    }

    if (password_verify($password, $ADMIN_PASSWORD) == false) {
        return false;
    }

    session_start();
    $_SESSION["admin"] = true;
    return true;
}

function logout() {
    session_start();
    $_SESSION["admin"] = false;
}

// Handle login / logout POSTs before rendering.
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

    if ($action == "logout") {
        logout();
        echo json_encode(["ok" => true]);
        exit;
    }

    if ($action == "delete" && isAuthed()) {
        $id = intval($data["id"] ?? 0);

        if ($id > 0) {
            executePreparedQuery($db, <<<SQL
                DELETE FROM `mails` WHERE `id` = :id
            SQL, [
                ":id" => $id
            ]);
        }

        echo json_encode(["ok" => true]);
        exit;
    }

    http_response_code(400);
    echo json_encode(["message" => "Unknown action."]);
    exit;
}

$authed = isAuthed();

// ---------------------------------------------------------------------------
// Mail data (only loaded when authed)
// ---------------------------------------------------------------------------

$mails = [];

if ($authed) {
    $result = executePreparedQuery($db, <<<SQL
        SELECT `id`, `subject`, `author`, `email`, `content`, `created_at`
        FROM `mails`
        ORDER BY `id` DESC
    SQL);

    while ($row = $result->fetchArray()) {
        $mails[] = $row;
    }
}

function esc($value): string {
    return htmlspecialchars($value ?? "");
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
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <style>
            body > .main {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg3.webp");
                background-size: 100%;

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
                    background-size: cover;
                    background-position: 30% 50%;
                    background-attachment: fixed;

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
                <?php if ($authed == false) { ?>
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
                <?php } else { ?>
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
                                <?php if (empty($mails)) { ?>
                                    <div class="empty">
                                        No mails yet.
                                    </div>
                                <?php } else { ?>
                                    <?php foreach ($mails as $mail) { ?>
                                        <div class="item" data-id="<?=esc($mail["id"])?>" onclick="selectMail(this)">
                                            <div class="subject">
                                                <?=esc($mail["subject"])?>
                                            </div>
                                            <div class="meta">
                                                <?=esc($mail["author"])?> &middot; <?=esc($mail["created_at"])?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
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
                                            <?=loader("rings")?>
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
                                            <?=icon("send")?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        <?php if ($authed == false) { ?>
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

                    location.reload();
                } catch (error) {
                    loginError.textContent = "⚠️ " + error.message;
                    btnLogin.disabled = false;
                }
            }
        <?php } else { ?>
            let panelBox = document.getElementById("panelBox");
            let panelRender = document.getElementById("panelRender");
            let panelLoader = document.getElementById("panelLoader");
            let inputReply = document.getElementById("inputReply");
            let btnSend = document.getElementById("btnSend");
            let mailList = document.getElementById("mailList");
            let mailDetail = document.getElementById("mailDetail");
            let detailSubject = document.getElementById("detailSubject");
            let detailMeta = document.getElementById("detailMeta");
            let detailBody = document.getElementById("detailBody");
            let btnDelete = document.getElementById("btnDelete");
            let btnLogout = document.getElementById("btnLogout");

            const SESSION_KEY = "adminChatSessionKey";
            const ENDPOINT = "api/chat/";

            let mails = <?=json_encode($mails)?>;

            function getSessionKey() {
                return localStorage.getItem(SESSION_KEY);
            }

            function setSessionKey(key) {
                localStorage.setItem(SESSION_KEY, key);
            }

            function escapeHtml(text) {
                let div = document.createElement("div");
                div.textContent = text;
                return div.innerHTML;
            }

            function renderMessage(role, content, animate = true) {
                let isUser = role == "user";
                let body = isUser ? escapeHtml(content) : marked.parse(content);
                let intro = animate ? " -intro -intro__float__" + (isUser ? "right" : "left") : "";
                let item = elementFromHTML(/*html*/`
                    <div class="item ${isUser ? "item--user" : "item--ai"}">
                        <div></div>
                        <div class="text ${isUser ? "" : "item--ai__text"}${intro}">
                            ${body}
                        </div>
                    </div>
                `);

                panelRender.appendChild(item);

                for (let anchor of item.querySelectorAll("a")) {
                    anchor.setAttribute("target", "_blank");
                }

                scrollToPosition(panelBox, 1, 1000, "easeInOut");
            }

            async function restoreHistory() {
                let key = getSessionKey();

                if (key == null) {
                    return;
                }

                let response = await fetch(ENDPOINT + "?key=" + encodeURIComponent(key));

                if (!response.ok) {
                    localStorage.removeItem(SESSION_KEY);
                    return;
                }

                let data = await response.json();

                if (data.messages == null || data.messages.length == 0) {
                    return;
                }

                panelRender.innerHTML = "";

                for (let message of data.messages) {
                    renderMessage(message.role, message.content, false);
                }
            }

            function selectMail(element) {
                let id = parseInt(element.getAttribute("data-id"));
                let mail = mails.find(m => m.id == id);

                if (mail == null) return;

                for (let item of mailList.querySelectorAll(".item")) {
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
                let id = btnDelete.dataset.id;

                if (id == null || confirm("Delete this mail?") == false) return;

                let response = await fetch("admin/", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        action: "delete",
                        id: id
                    })
                });

                if (!response.ok) {
                    alert("Failed to delete mail.");
                    return;
                }

                mails = mails.filter(m => m.id != id);
                mailDetail.hidden = true;

                for (let item of mailList.querySelectorAll(".item")) {
                    if (item.getAttribute("data-id") == id) {
                        item.remove();
                    }
                }

                if (mails.length == 0) {
                    mailList.innerHTML = '<div class="empty">No mails yet.</div>';
                }
            }

            btnLogout.onclick = async () => {
                let response = await fetch("admin/", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        action: "logout"
                    })
                });

                if (response.ok) {
                    location.reload();
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

            restoreHistory();

            inputReply.oninput = () => {
                btnSend.disabled = inputReply.value == "";
            }

            inputReply.onkeydown = (event) => {
                if (event.key == "Enter") {
                    btnSend.click();
                }
            }
        <?php } ?>
    </script>
</html>