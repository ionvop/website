<?php

chdir("../");
require_once "common.php";

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
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg3.webp");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                
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
                                & > .image {
                                    padding: 1rem;
                            
                                    & > img {
                                        width: 20rem;
                                        user-select: none;
                                    }
                                }

                                & > .new {
                                    padding: 1rem;
                                    padding-top: 0rem;
                                    text-align: center;
                                }
                            }
                        }
                    }
                }
            }

            @media (orientation: portrait) {
                body > .main {
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
                            }
                        }
                    }
                }
            }
        </style>
    </head>
    <body>
        <div class="main -main">
            <?= setHeader("contact") ?>
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
                            <div class="image">
                                <img src="assets/miku.webp">
                            </div>
                            <div class="new">
                                <button class="-button" id="btnNew">
                                    New Chat
                                </button>
                            </div>
                        </div>
                        <?= renderChatAssistant() ?>
                    </div>
                </div>
            </div>
            <?= setFooter() ?>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        <?= chatAssistantJS("chatSessionKey") ?>

        const btnNew = document.getElementById("btnNew");

        (async () => {
            const message = new URLSearchParams(window.location.search).get("m");

            if (message != null) {
                inputReply.value = message;
                inputReply.disabled = false;
                inputReply.focus();
            }
        })();

        animatePage([
            {target: "body > .main > .content > .socials > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .socials > .platforms > .discord", type: "-intro__float__up"},
            {target: "body > .main > .content > .socials > .platforms > .github", type: "-intro__float__up"},
            {target: "body > .main > .content > .socials > .platforms > .youtube", type: "-intro__float__up"},
            {target: "body > .main > .content > .contact > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .contact > .assistant > .avatar", type: "-intro__float__up"},
            {target: "body > .main > .content > .contact > .assistant > .chat > .container > .box", type: "-intro__float__left"},
            {target: "body > .main > .content > .contact > .assistant > .chat > .reply", type: "-intro__float__left"}
        ]);

        const sendReply = btnSend.onclick;
        btnSend.onclick = async () => {
            const url = new URL(window.location.href);
            url.searchParams.delete("m");
            window.history.replaceState({}, "", url);
            await sendReply();
        };

        btnNew.onclick = () => {
            if (confirm("Your current conversation will be cleared. Are you sure?") == false) return;
            localStorage.removeItem(CHAT.key);
            location.reload();
        }
    </script>
</html>