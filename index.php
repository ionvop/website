<?php

include("common.php");
Debug();

?>

<html>
    <head>
        <title>
            ionvop
        </title>
        <base href="./">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body > .main {
                background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg.png");
                background-size: 100%;

                & > .content {
                    & > .title {
                        padding: 5rem;
                        padding-bottom: 3rem;
                        font-size: 2rem;
                        font-weight: bolder;
                    }

                    & > .subtitle {
                        padding-top: 0rem;
                    }

                    & > .contact {
                        padding: 3rem;
                        padding-bottom: 5rem;
                        display: grid;
                        grid-template-columns: 1fr 20rem max-content 1fr;

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

                    & > .about {
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        background-color: #111;

                        & > .card {
                            padding: 3rem;

                            & > .info {
                                display: grid;
                                grid-template-columns: max-content 1fr;
                            
                                & > .icon {
                                    & > svg {
                                        width: 3rem;
                                        height: 3rem;
                                    }
                                }
                            
                                & > .subject {
                                    font-weight: bold;
                                }
                            }
                        }
                    }
                }
            }

            @media (orientation: portrait) {
                body > .main {
                    background-size: cover;
                    background-position: 70% 50%;
                    background-attachment: fixed;
                
                    & > .content {
                        & > .about {
                            grid-template-columns: 1fr;
                        }
                    }
                }
            }
        </style>
    </head>
    <body>
        <div class="main -main -script__parallax" data-height="-0.5">
            <?=SetHeader("home")?>
            <div class="content -content">
                <div class="title -center">
                    Hi! I'm ionvop
                </div>
                <div class="subtitle -pad -title -center">
                    Welcome to my website
                </div>
                <form action="contact/" class="-form contact">
                    <div></div>
                    <div class="input">
                        <input class="-input" name="m" placeholder="Send me a message">
                    </div>
                    <div class="button">
                        <button class="-button">
                            <?=Icon("send")?>
                        </button>
                    </div>
                    <div></div>
                </form>
                <div class="about">
                    <div class="programming card">
                        <div class="info">
                            <div class="icon -pad -center__flex">
                                <?=Icon("code")?>
                            </div>
                            <div class="subject -pad -center -title">
                                Software Development
                            </div>
                        </div>
                        <div class="details -pad -center">
                            I am currently a college student studying computer science and I am learning to be a web, software, and game developer.
                        </div>
                    </div>
                    <div class="hobby card">
                        <div class="info">
                            <div class="icon -pad -center__flex">
                                <?=Icon("game")?>
                            </div>
                            <div class="subject -pad -center -title">
                                Games and Other Hobbies
                            </div>
                        </div>
                        <div class="details -pad -center">
                            I like playing rhythm games and fast-paced Tetris games. I'm also learning music production and my favorite genre is dubstep.
                        </div>
                    </div>
                    <div class="waifu card">
                        <div class="info">
                            <div class="icon -pad -center__flex">
                                <?=Icon("heart")?>
                            </div>
                            <div class="subject -pad -center -title">
                                Simping for CHU&sup2;
                            </div>
                        </div>
                        <div class="details -pad -center">
                            My love for CHU&sup2; from BanG Dream is like a deep well of happiness. She is the sole reason why I keep going forward in life.
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
            { target: "body > .main > .content > .title", type: "-intro__float__left" },
            { target: "body > .main > .content > .subtitle", type: "-intro__float__left" },
            { target: "body > .main > .content > .contact", type: "-intro__float__left" },
            { target: "body > .main > .content > .about > .programming > .info > .icon", type: "-intro__float__up" },
            { target: "body > .main > .content > .about > .programming > .info > .subject", type: "-intro__float__up" },
            { target: "body > .main > .content > .about > .programming > .details", type: "-intro__float__left" },
            { target: "body > .main > .content > .about > .hobby > .info > .icon", type: "-intro__float__up" },
            { target: "body > .main > .content > .about > .hobby > .info > .subject", type: "-intro__float__up" },
            { target: "body > .main > .content > .about > .hobby > .details", type: "-intro__float__left" },
            { target: "body > .main > .content > .about > .waifu > .info > .icon", type: "-intro__float__up" },
            { target: "body > .main > .content > .about > .waifu > .info > .subject", type: "-intro__float__up" },
            { target: "body > .main > .content > .about > .waifu > .details", type: "-intro__float__left" }
        ]);

        let easterEggPhase = 0;
        let about = document.querySelector(".-header > .content > .about");
        let contact = document.querySelector(".-header > .content > .contact");
        let sites = document.querySelector(".-header > .content > .sites");
        let send = document.querySelector("body > .main > .content > .contact > .button");

        about.addEventListener("mouseenter", () => {
            switch (easterEggPhase) {
                case 0:
                    easterEggPhase = 1;
                    break;
                case 4:
                    easterEggPhase = 5;
                    break;
                case 8:
                    easterEggPhase = 9;
                    break;
                default:
                    easterEggPhase = 0;
                    break;
            }

            console.log(easterEggPhase);
        });

        contact.addEventListener("mouseenter", () => {
            switch (easterEggPhase) {
                case 1:
                    easterEggPhase = 2;
                    break;
                case 5:
                    easterEggPhase = 6;
                    break;
                case 9:
                    easterEggPhase = 10;
                    break;
                default:
                    easterEggPhase = 0;
                    break;
            }

            console.log(easterEggPhase);
        });

        sites.addEventListener("mouseenter", () => {
            switch (easterEggPhase) {
                case 2:
                    easterEggPhase = 3;
                    break;
                case 6:
                    easterEggPhase = 7;
                    break;
                case 10:
                    easterEggPhase = 11;
                    break;
                default:
                    easterEggPhase = 0;
                    break;
            }

            console.log(easterEggPhase);
        });

        send.addEventListener("mouseenter", () => {
            switch (easterEggPhase) {
                case 3:
                    easterEggPhase = 4;
                    break;
                case 7:
                    easterEggPhase = 8;
                    break;
                case 11:
                    alert("Easter egg unlocked!");
                    easterEggPhase = 0;
                    break;
                default:
                    easterEggPhase = 0;
                    break;
            }

            console.log(easterEggPhase);
        });
    </script>
</html>