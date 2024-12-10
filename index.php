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
            .main {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg.png");
                background-size: 100%;
            }

            .title {
                padding: 5rem;
                padding-bottom: 3rem;
                font-size: 3rem;
                font-weight: bolder;
            }

            .subtitle {
                padding: 1rem;
                padding-top: 0rem;
            }

            .contact {
                padding: 3rem;
                padding-bottom: 5rem;
                display: grid;
                grid-template-columns: 1fr 20rem max-content 1fr;
            }

            .contact__button > button {
                height: 100%;
            }

            .contact__button > button > svg {
                width: 1.5rem;
                height: 1.5rem;
            }

            .about {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                background-color: #111;
            }

            .about__card {
                padding: 3rem;
            }

            .about__info {
                display: grid;
                grid-template-columns: max-content 1fr;
            }

            .about__info__icon {
                padding: 1rem;
            }

            .about__info__icon > svg {
                width: 3rem;
                height: 3rem;
            }

            .about__info__subject {
                padding: 1rem;
                font-weight: bold;
            }

            .about__details {
                padding: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="main -main -script__parallax" data-height="-0.5">
            <?=SetHeader()?>
            <div class="content -content">
                <div class="title -center">
                    Hi! I'm ionvop
                </div>
                <div class="subtitle -title -center">
                    Welcome to my website
                </div>
                <form action="contact/" class="-form contact">
                    <div></div>
                    <div class="contact__input">
                        <input class="-input" name="m" placeholder="Send me a message">
                    </div>
                    <div class="contact__button">
                        <button class="-button">
                            <?=Icon("send")?>
                        </button>
                    </div>
                    <div></div>
                </form>
                <div class="about">
                    <div class="about__programming about__card">
                        <div class="about__programming__info about__info">
                            <div class="about__programming__info__icon about__info__icon -center__flex">
                                <?=Icon("code")?>
                            </div>
                            <div class="about__programming__info__subject about__info__subject -center -title">
                                Software Development
                            </div>
                        </div>
                        <div class="about__programming__details about__details -center">
                            I am currently a college student studying computer science and I am learning to be a web, software, and game developer.
                        </div>
                    </div>
                    <div class="about__hobby about__card">
                        <div class="about__hobby__info about__info">
                            <div class="about__hobby__info__icon about__info__icon -center__flex">
                                <?=Icon("game")?>
                            </div>
                            <div class="about__hobby__info__subject about__info__subject -center -title">
                                Games and Other Hobbies
                            </div>
                        </div>
                        <div class="about__hobby__details about__details -center">
                            I like playing rhythm games and fast-paced Tetris games. I'm also learning music production and my favorite genre is dubstep.
                        </div>
                    </div>
                    <div class="about__waifu about__card">
                        <div class="about__waifu__info about__info">
                            <div class="about__waifu__info__icon about__info__icon -center__flex">
                                <?=Icon("heart")?>
                            </div>
                            <div class="about__waifu__info__subject about__info__subject -center -title">
                                Simping for CHU&sup2; from BanG Dream!
                            </div>
                        </div>
                        <div class="about__waifu__details about__details -center">
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
            { target: ".title", type: "-intro__float__left" },
            { target: ".subtitle", type: "-intro__float__left" },
            { target: ".contact", type: "-intro__float__left" },
            { target: ".about__programming__info__icon", type: "-intro__float__up" },
            { target: ".about__programming__info__subject", type: "-intro__float__up" },
            { target: ".about__programming__details", type: "-intro__float__left" },
            { target: ".about__hobby__info__icon", type: "-intro__float__up" },
            { target: ".about__hobby__info__subject", type: "-intro__float__up" },
            { target: ".about__hobby__details", type: "-intro__float__left" },
            { target: ".about__waifu__info__icon", type: "-intro__float__up" },
            { target: ".about__waifu__info__subject", type: "-intro__float__up" },
            { target: ".about__waifu__details", type: "-intro__float__left" }
        ]);

        let easterEggPhase = 0;
        let about = document.querySelector(".-header__content__about");
        let contact = document.querySelector(".-header__content__contact");
        let sites = document.querySelector(".-header__content__sites");
        let send = document.querySelector(".contact__button");

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