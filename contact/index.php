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

            body > .main {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg3.png");
                background-size: 100%;
                
                & > .content {
                    & > .socials {
                        padding: 10rem;
                    
                        & > .title {
                            padding: 1rem;
                            font-weight: bold;
                        }

                        & > .platforms {
                            display: grid;
                            grid-template-columns: 1fr repeat(3, max-content) 1fr;
                        
                            & > .platform {
                                padding: 5rem;

                                & > img {
                                    width: 5rem;
                                    height: 5rem;
                                    border-radius: 50%;
                                    transition-duration: 0.1s;
                                    cursor: pointer;
                                    user-select: none;
                                
                                    &:hover {
                                        transform: scale(1.3);
                                        box-shadow: 0rem 0rem 1rem #fff;
                                    }
                                }
                            }

                            & > .discord {
                                & > img {
                                    box-shadow: 0rem 0rem 1rem #5865f2;
                                }
                            }

                            & > .github {
                                & > img {
                                    box-shadow: 0rem 0rem 1rem #000;
                                }
                            }

                            & > .youtube {
                                & > img {
                                    box-shadow: 0rem 0rem 1rem #f00;
                                }
                            }
                        }
                    }

                    & > .contact {
                        padding: 10rem;
                        padding-top: 0rem;
                    
                        & > .title {
                            padding: 1rem;
                            font-weight: bold;
                        }

                        & > .assistant {
                            display: grid;
                            grid-template-columns: max-content 1fr;
                        
                            & > .avatar {
                                padding: 1rem;
                            
                                & > img {
                                    width: 20rem;
                                    user-select: none;
                                }
                            }

                            & > .chat {
                                & > .container {
                                    padding: 1rem;
                                
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

                                        & > .button {
                                            & > button {
                                                height: 100%;

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
            }

            @media (orientation: portrait) {
                body > .main {
                    background-size: cover;
                    background-position: 30% 50%;
                    background-attachment: fixed;

                    & > .content {
                        & > .socials {
                            padding: 1rem;
                        
                            & > .title {
                                padding: 5rem;
                                padding-bottom: 1rem;
                            }

                            & > .platforms {
                                & > .platform {
                                    padding: 1rem;
                                }
                            }
                        }

                        & > .contact {
                            padding: 1rem;
                            padding-top: 5rem;
                        
                            & > .assistant {
                                grid-template-columns: 1fr;
                            
                                & > .avatar {
                                    text-align: center;
                                }

                                & > .chat {
                                    & > .container {
                                        & > .box {
                                            & > .render {
                                                & > .item {
                                                    & > .text {
                                                        max-width: 20rem;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        </style>
    </head>
    <body>
        <div class="main -main -script__parallax">
            <?=SetHeader("contact")?>
            <div class="content -content">
                <div class="socials">
                    <div class="title -title -center">
                        You can find me on these platforms:
                    </div>
                    <div class="platforms">
                        <div></div>
                        <div class="discord platform">
                            <img src="https://s.magecdn.com/social/tc-discord.svg" class="-script__new" data-href="https://discord.com/users/301203021608779776">
                        </div>
                        <div class="github platform">
                            <img src="https://s.magecdn.com/social/tc-github.svg" class="-script__new" data-href="https://github.com/ionvop">
                        </div>
                        <div class="youtube platform">
                            <img src="https://s.magecdn.com/social/tc-youtube.svg" class="-script__new" data-href="https://www.youtube.com/channel/UCXDfWc9wKYat9KmgRRMqaDg">
                        </div>
                        <div></div>
                    </div>
                </div>
                <div class="contact">
                    <div class="title -title -center">
                        Contact Assistant
                    </div>
                    <div class="assistant">
                        <div class="avatar">
                            <img src="assets/miku.png">
                        </div>
                        <div class="chat">
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
                                            <?=Loader("rings")?>
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
        let panelBox = document.getElementById("panelBox");
        let panelRender = document.getElementById("panelRender");
        let panelLoader = document.getElementById("panelLoader");
        let inputReply = document.getElementById("inputReply");
        let btnSend = document.getElementById("btnSend");

        AnimatePage([
            {target: "body > .main > .content > .socials > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .socials > .platforms > .discord", type: "-intro__float__up"},
            {target: "body > .main > .content > .socials > .platforms > .github", type: "-intro__float__up"},
            {target: "body > .main > .content > .socials > .platforms > .youtube", type: "-intro__float__up"},
            {target: "body > .main > .content > .contact > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .contact > .assistant > .avatar", type: "-intro__float__up"},
            {target: "body > .main > .content > .contact > .assistant > .chat > .container > .box", type: "-intro__float__left"},
            {target: "body > .main > .content > .contact > .assistant > .chat > .reply", type: "-intro__float__left"}
        ]);

        let message = new URLSearchParams(window.location.search).get("m");

        if (message != null) {
            inputReply.value = message;
            inputReply.disabled = false;
            inputReply.focus();
        }

        btnSend.onclick = async () => {
            if (inputReply.value == "") return;

            let item = ElementFromHTML(/*html*/`
                <div class="item item--user">
                    <div></div>
                    <div class="text -intro -intro__float__right">
                        ${inputReply.value}
                    </div>
                </div>
            `);

            panelRender.appendChild(item);

            inputReply.value = "";
            inputReply.disabled = true;
            btnSend.disabled = true;
            panelLoader.style.height = "auto";
            panelLoader.style.opacity = "100%";
            ScrollToPosition(panelBox, 1, 1000, "easeInOut");
            let history = [];
            let messages = panelRender.querySelectorAll(".item");

            for (let message of messages) {
                let text = message.querySelector(".text").innerText;
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
            }

            console.log(history);

            let response = await fetch("server.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    method: "sendMessage",
                    history: history
                })
            })

            response = await response.json();
            console.log(response);
            panelLoader.style.opacity = "0%";
            await new Promise(resolve => setTimeout(resolve, 1000));
            panelLoader.style.height = "0rem";

            item = ElementFromHTML(/*html*/`
                <div class="item item--ai">
                    <div></div>
                    <div class="item--ai__text text -intro -intro__float__left">
                        ${marked.parse(response.message)}
                    </div>
                </div>
            `);

            panelRender.appendChild(item);

            for (let anchor of document.querySelectorAll('a')) {
                anchor.setAttribute('target', '_blank');
            }

            inputReply.disabled = false;
            btnSend.disabled = false;
            ScrollToPosition(panelBox, 1, 1000, "easeInOut");
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