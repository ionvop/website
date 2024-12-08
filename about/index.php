<?php

chdir("../");
include("common.php");
Debug();

?>

<html>
    <head>
        <title>
            About
        </title>
        <base href="../">
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .main__about {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg2.png");
                background-size: 100%;
            }

            .content {
                padding: 10rem;
            }

            .profile {
                display: grid;
                grid-template-columns: max-content 1fr;
                border-radius: 1rem;
                background-color: #0005;
                backdrop-filter: blur(0.5rem);
            }

            .profile__column__avatar {
                padding: 5rem;
                padding-bottom: 1rem;
            }

            .profile__column__avatar > img {
                width: 10rem;
                height: 10rem;
                object-fit: cover;
                border-radius: 10rem;
                user-select: none;
            }

            .profile__column__username {
                padding: 1rem;
                padding-top: 0rem;
                font-weight: bold;
            }

            .profile__column__titles {
                padding: 1rem;
            }

            .profile__column__label {
                padding: 1rem;
                padding-top: 15rem;
            }

            .profile__column__chu2 {
                padding: 1rem;
            }

            .profile__column__chu2 > img {
                width: 10rem;
                user-select: none;
            }

            .profile__panel__banner {
                padding: 1rem;
            }

            .profile__panel__banner > img {
                width: 100%;
                border-radius: 1rem;
                user-select: none;
            }

            .profile__panel__about__title {
                padding: 1rem;
                font-weight: bold;
                letter-spacing: 1rem;
            }

            .profile__panel__about__subtitle {
                padding: 1rem;
            }

            .profile__panel__about__content {
                padding: 1rem;
                padding-top: 3rem;
                line-height: 3rem;
            }
        </style>
    </head>
    <body>
        <div class="main__about -main -script__parallax">
            <?=SetHeader()?>
            <div class="content -content">
                <div class="profile">
                    <div class="profile__column">
                        <div class="profile__column__avatar">
                            <img src="assets/avatar.png">
                        </div>
                        <div class="profile__column__username -title -center">
                            ionvop
                        </div>
                        <div class="profile__column__titles -subtitle -center">
                            2024 ACM Programming<br>
                            Competition Champion<br>
                            <br>
                            TETR.IO Season 1<br>
                            U Rank Player<br>
                            <br>
                            TETR.IO Season 2<br>
                            U Rank Player<br>
                            <br>
                            the plap guy
                        </div>
                        <div class="profile__column__label -subtitle -center">
                            my waifu &darr;&darr;&darr;
                        </div>
                        <div class="profile__column__chu2 -center">
                            <img src="assets/chu2.png">
                        </div>
                    </div>
                    <div class="profile__panel">
                        <div class="profile__panel__banner">
                            <img src="assets/banner.png">
                        </div>
                        <div class="profile__panel__about">
                            <div class="profile__panel__about__title -title -center">
                                About Me
                            </div>
                            <div class="profile__panel__about__subtitle -subtitle -center">
                                Last updated: 2024-12-04
                            </div>
                            <div class="profile__panel__about__content">
                                I'm currently a 3rd year college student studying Bachelor of Science in Computer Science, and my interests include web development, software development, and game development.<br>
                                <br>
                                The programming languages I'm familiar with are VBScript for automations, HTML, CSS, JavaScript, and PHP for web development, C# for GUI applications, Java for legacy applications and self-torture, Python for machine-learning, Brainf*ck for fun, Lua for game modding, GLSL for post-processing effects, Turbowarp (Scratch) for game development, and <span class="-script__new -link" data-href="https://github.com/ionvop/ivpy/">ivpy</span> which is a custom programming language that I made for fun.<br>
                                <br>
                                I like to play rhythm games and fast-paced Tetris games. My favorite rhythm games include osu!, mobile games such as Arcaea, Rotaeno, BanG Dream, and arcade rhythm games such as maimai, SDVX, and PIU. My favorite fast-paced Tetris games include TETR.IO and Jstris.<br>
                                <br>
                                I'm also learning music production and my favorite genre to listen to is dubstep. My favorite artists include ReeK, Eliminate, and Similar Outskirts. I won't list down the JP artists because there's too many of them. The DAW software I used to use was Caustic 3 but I've since switched to Waveform 11.
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
            {target: ".profile", type: "-intro__fade"},
            {target: ".profile__column__avatar > img", type: "-intro__float__left"},
            {target: ".profile__column__username", type: "-intro__float__left"},
            {target: ".profile__column__titles", type: "-intro__float__left"},
            {target: ".profile__column__label", type: "-intro__float__left"},
            {target: ".profile__column__chu2", type: "-intro__float__left"},
            {target: ".profile__panel__banner", type: "-intro__float__left"},
            {target: ".profile__panel__about__title", type: "-intro__float__left"},
            {target: ".profile__panel__about__subtitle", type: "-intro__float__left"},
            {target: ".profile__panel__about__content", type: "-intro__float__left"},
        ]);
    </script>
</html>