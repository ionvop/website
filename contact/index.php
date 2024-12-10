<?php

chdir("../");
include("common.php");
Debug();

?>

<html>
    <head>
        <title>
            Contact
        </title>
        <base href="../">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <style>
            p {
                margin: 0rem;
            }

            a {
                cursor: pointer;
                color: var(--theme--light);
                text-decoration: underline;
                transition-duration: 0.1s;
            }

            a:hover {
                color: var(--theme--contrast);
            }

            .main__contact {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg3.png");
                background-size: 100%;
            }

            .socials {
                padding: 10rem;
            }

            .socials__title {
                padding: 1rem;
                font-weight: bold;
            }

            .socials__platforms {
                display: grid;
                grid-template-columns: 1fr repeat(3, max-content) 1fr;
            }

            .socials__platform {
                padding: 5rem;
            }

            .socials__platform > img {
                width: 5rem;
                height: 5rem;
                border-radius: 50%;
                transition-duration: 0.1s;
                cursor: pointer;
                user-select: none;
            }

            .socials__platform > img:hover {
                transform: scale(1.3);
                box-shadow: 0rem 0rem 1rem #fff;
            }

            .socials__platforms__discord > img {
                box-shadow: 0rem 0rem 1rem #5865f2;
            }

            .socials__platforms__github > img {
                box-shadow: 0rem 0rem 1rem #000;
            }

            .socials__platforms__youtube > img {
                box-shadow: 0rem 0rem 1rem #f00;
            }

            .contact {
                padding: 10rem;
                padding-top: 0rem;
            }

            .contact__title {
                padding: 1rem;
                font-weight: bold;
            }

            .contact__assistant {
                display: grid;
                grid-template-columns: max-content 1fr;
            }

            .contact__assistant__avatar {
                padding: 1rem;
            }

            .contact__assistant__avatar > img {
                width: 20rem;
                user-select: none;
            }

            .contact__assistant__chat__container {
                padding: 1rem;
            }

            .contact__assistant__chat__container__box {
                background-color: #000a;
                border-radius: 1rem;
                height: 30rem;
                overflow-x: hidden;
                overflow-y: auto;
            }

            .contact__assistant__chat__container__box__render .item {
                padding: 1rem;
            }

            .contact__assistant__chat__container__box__render .item--ai {
                display: grid;
                grid-template-columns: max-content 1fr;
            }

            .contact__assistant__chat__container__box__render .item--user {
                display: grid;
                grid-template-columns: 1fr max-content;
            }

            .contact__assistant__chat__container__box__render .item__text {
                padding: 1rem;
                border-radius: 1rem;
                max-width: 30rem;
            }

            .contact__assistant__chat__container__box__render .item--ai__text {
                background-color: var(--theme);
            }

            .contact__assistant__chat__container__box__render .item--user__text {
                background-color: #555;
            }

            .contact__assistant__chat__container__box__loader {
                display: grid;
                grid-template-columns: max-content 1fr;
                transition-duration: 1s;
                opacity: 0%;
                height: 0rem;
                overflow: hidden;
            }

            .contact__assistant__chat__container__box__loader__icon {
                padding: 5rem;
                padding-top: 1rem;
                padding-bottom: 1rem;
                color: var(--theme--contrast);
            }

            .contact__assistant__chat__container__box__loader__icon > svg {
                width: 5rem;
                height: 5rem;
            }

            .contact__assistant__chat__reply {
                padding: 1rem;
            }

            .contact__assistant__chat__reply__box {
                display: grid;
                grid-template-columns: 1fr max-content;
                border-radius: 1rem;
                overflow: hidden;
            }

            .contact__assistant__chat__reply__box__button > button {
                height: 100%;
            }

            .contact__assistant__chat__reply__box__button > button > svg {
                width: 1.5rem;
                height: 1.5rem;
            }

            @media (orientation: portrait) {
                .main__contact {
                    background-size: cover;
                    background-position: 30% 50%;
                    background-attachment: fixed;
                }

                .socials {
                    padding: 1rem;
                }

                .socials__title {
                    padding: 5rem;
                    padding-bottom: 1rem;
                }

                .socials__platform {
                    padding: 1rem;
                }

                .contact {
                    padding: 1rem;
                    padding-top: 5rem;
                }

                .contact__assistant {
                    grid-template-columns: 1fr;
                }

                .contact__assistant__avatar {
                    text-align: center;
                }

                .contact__assistant__chat__container__box__render .item__text {
                    max-width: 20rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="main__contact -main -script__parallax">
            <?=SetHeader()?>
            <div class="content -content">
                <div class="socials">
                    <div class="socials__title -title -center">
                        You can find me on these platforms:
                    </div>
                    <div class="socials__platforms">
                        <div></div>
                        <div class="socials__platforms__discord socials__platform">
                            <img src="https://s.magecdn.com/social/tc-discord.svg" class="-script__new" data-href="https://discord.com/users/301203021608779776">
                        </div>
                        <div class="socials__platforms__github socials__platform">
                            <img src="https://s.magecdn.com/social/tc-github.svg" class="-script__new" data-href="https://github.com/ionvop">
                        </div>
                        <div class="socials__platforms__youtube socials__platform">
                            <img src="https://s.magecdn.com/social/tc-youtube.svg" class="-script__new" data-href="https://www.youtube.com/channel/UCXDfWc9wKYat9KmgRRMqaDg">
                        </div>
                        <div></div>
                    </div>
                </div>
                <div class="contact">
                    <div class="contact__title -title -center">
                        Contact Assistant
                    </div>
                    <div class="contact__assistant">
                        <div class="contact__assistant__avatar">
                            <img src="assets/miku.png">
                        </div>
                        <div class="contact__assistant__chat">
                            <div class="contact__assistant__chat__container">
                                <div class="contact__assistant__chat__container__box">
                                    <div class="contact__assistant__chat__container__box__render">
                                        <div class="item--ai item">
                                            <div class="item--ai__text item__text -intro -intro__float__left">
                                                Hello! ✨ I'm Hatsune Pinku and I will be your assistant regarding your messages for ionvop. 💖
                                            </div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="contact__assistant__chat__container__box__loader">
                                        <div class="contact__assistant__chat__container__box__loader__icon">
                                            <?=Loader("rings")?>
                                        </div>
                                        <div></div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="contact__assistant__chat__reply">
                                <div class="contact__assistant__chat__reply__box">
                                    <div class="contact__assistant__chat__reply__box__input">
                                        <input class="-input" placeholder="Write a reply" oninput="inputReply(this)" onkeydown="if (event.key == 'Enter') inputReplyEnter(this)">
                                    </div>
                                    <div class="contact__assistant__chat__reply__box__button">
                                        <button class="-button" onclick="btnSend(this)" disabled>
                                            <?=Icon("send")?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?=SetFooter()?>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        AnimatePage([
            {target: ".socials__title", type: "-intro__float__left"},
            {target: ".socials__platforms__discord", type: "-intro__float__up"},
            {target: ".socials__platforms__github", type: "-intro__float__up"},
            {target: ".socials__platforms__youtube", type: "-intro__float__up"},
            {target: ".contact__title", type: "-intro__float__left"},
            {target: ".contact__assistant__avatar", type: "-intro__float__up"},
            {target: ".contact__assistant__chat__container__box", type: "-intro__float__left"},
            {target: ".contact__assistant__chat__reply", type: "-intro__float__left"}
        ]);

        let message = new URLSearchParams(window.location.search).get("m");

        if (message != null) {
            let input = document.querySelector(".contact__assistant__chat__reply__box__input > input");
            input.value = message;
            input.disabled = false;
            input.focus();
        }

        function btnSend(element) {
            let input = document.querySelector(".contact__assistant__chat__reply__box__input > input");
            let send = document.querySelector(".contact__assistant__chat__reply__box__button > button");
            let box = document.querySelector(".contact__assistant__chat__container__box");
            let render = document.querySelector(".contact__assistant__chat__container__box__render");
            let loader = document.querySelector(".contact__assistant__chat__container__box__loader");

            if (input.value == "") {
                return;
            }

            let item = document.createElement("div");
            item.classList.add("item");
            item.classList.add("item--user");
            item.appendChild(document.createElement("div"));
            let itemText = document.createElement("div");
            itemText.classList.add("item--user__text");
            itemText.classList.add("item__text");
            itemText.classList.add("-intro");
            itemText.classList.add("-intro__float__right");
            itemText.innerHTML = input.value;
            item.appendChild(itemText);
            render.appendChild(item);

            input.value = "";
            input.disabled = true;
            send.disabled = true;
            loader.style.height = "auto";
            loader.style.opacity = "100%";
            ScrollToPosition(box, 1, 1000, "easeInOut");
            let history = [];
            let messages = document.querySelectorAll(".contact__assistant__chat__container__box__render .item");

            messages.forEach(message => {
                let text = message.querySelector(".item__text").innerText;
                let role = "";

                if (message.classList.contains("item--user")) {
                    role = "user";
                } else if (message.classList.contains("item--ai")) {
                    role = "assistant";
                }

                history.push({
                    role: role,
                    content: text
                });
            });

            console.log(history);

            fetch("server.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    method: "sendMessage",
                    history: history
                })
            }).then(response => response.json()).then(data => {
                console.log(data);

                if (data.status != 200) {
                    alert(data.message);
                    return;
                }

                loader.style.opacity = "0%";

                setTimeout(() => {
                    loader.style.height = "0rem";

                    let item = document.createElement("div");
                    item.classList.add("item");
                    item.classList.add("item--ai");
                    item.appendChild(document.createElement("div"));
                    let itemText = document.createElement("div");
                    itemText.classList.add("item--ai__text");
                    itemText.classList.add("item__text");
                    itemText.classList.add("-intro");
                    itemText.classList.add("-intro__float__left");
                    itemText.innerHTML = marked.parse(data.message);
                    item.appendChild(itemText);
                    render.appendChild(item);

                    document.querySelectorAll('a').forEach((anchor) => {
                        anchor.setAttribute('target', '_blank');
                    });

                    input.disabled = false;
                    send.disabled = false;
                    ScrollToPosition(box, 1, 1000, "easeInOut");
                }, 1000);
            })
        }

        function inputReply(element) {
            let send = document.querySelector(".contact__assistant__chat__reply__box__button > button");
            send.disabled = element.value == "";
        }

        function inputReplyEnter(element) {
            let send = document.querySelector(".contact__assistant__chat__reply__box__button > button");
            send.click();
        }
    </script>
</html>