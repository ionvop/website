<?php

chdir("../");
require_once "common.php";

?>

<html>
    <head>
        <title>
            About
        </title>
        <base href="../">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body > .main {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg2.webp");
                background-size: 100%;
            
                & > .content {
                    padding: 10rem;

                    & > .profile {
                        display: grid;
                        grid-template-columns: max-content 1fr;
                        border-radius: 1rem;
                        background-color: #0005;
                        backdrop-filter: blur(0.5rem);
                    
                        & > .column {
                            & > .avatar {
                                padding: 5rem;
                                padding-bottom: 1rem;
                            
                                & > img {
                                    width: 10rem;
                                    height: 10rem;
                                    object-fit: cover;
                                    border-radius: 10rem;
                                    user-select: none;
                                }
                            }
                        
                            & > .username {
                                padding-top: 0rem;
                                font-weight: bold;
                            }

                            & > .label {
                                padding-top: 15rem;
                            }

                            & > .chu2 {
                                & > img {
                                    width: 10rem;
                                    user-select: none;
                                }
                            }
                        }

                        & > .panel {
                            & > .banner {
                                & > img {
                                    width: 100%;
                                    border-radius: 1rem;
                                    user-select: none;
                                }
                            }

                            & > .about {
                                & > .title {
                                    font-weight: bold;
                                    letter-spacing: 1rem;
                                }

                                & > .content {
                                    padding-top: 3rem;
                                    line-height: 3rem;
                                }
                            }
                        }
                    }
                }
            }

            @media (orientation: portrait) {
                body > .main {
                    background-size: cover;
                    background-position: center;
                    background-attachment: fixed;
                
                    & > .content {
                        padding: 1rem;

                        & > .profile {
                            grid-template-columns: 1fr;
                        
                            & > .column {
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
        <div class="main -main -script__parallax">
            <?= setHeader("about") ?>
            <div class="content -content">
                <div class="profile">
                    <div class="column">
                        <div class="avatar">
                            <img src="assets/avatar.webp">
                        </div>
                        <div class="username -pad -title -center">
                            ionvop
                        </div>
                        <div class="titles -pad -subtitle -center">
                            Mapua Malayan Colleges Mindanao<br>
                            Mindanao-Wide IT Olympiad 2024<br>
                            ACM Programming Competition<br>
                            Champion<br>
                            <br>
                            UM Tagum College<br>
                            Festival of Talents 2025<br>
                            Tetris Battle<br>
                            Champion<br>
                            <br>
                            UM Tagum College<br>
                            CSIT Academic Festival 2025<br>
                            Software Engineering Project Presentation<br>
                            Best Presenter<br>
                            <br>
                            TETR.IO Season 1<br>
                            U Rank Player<br>
                            <br>
                            the plap guy
                        </div>
                        <div class="label -pad -subtitle -center">
                            my waifu &darr;&darr;&darr;
                        </div>
                        <div class="chu2 -pad -center">
                            <img src="assets/chu2.webp">
                        </div>
                    </div>
                    <div class="panel">
                        <div class="banner -pad">
                            <img src="assets/banner.webp">
                        </div>
                        <div class="about">
                            <div class="title -pad -title -center">
                                About Me
                            </div>
                            <div class="subtitle -pad -subtitle -center">
                                Last updated: 2024-12-04
                            </div>
                            <div class="content -pad">
                                I'm a Bachelor of Science in Computer Science college graduate from UM Tagum College, and my interests include web development, software development, and game development.<br>
                                <br>
                                The programming languages I'm familiar with are HTML, CSS, JavaScript, TypeScript, and PHP for web development, and Python or C# for GUI applications.<br>
                                <br>
                                Other languages include VBScript for automations, BrainF for challenges and self-torture, and <span class="-script__new -link" data-href="https://github.com/ionvop/ivpy/">ivpy</span> which is a custom programming language that I made for fun.<br>
                                <br>
                                I like to play rhythm games such as Arcaea, maimai and BanG Dream!, and fast-paced Tetris games such as TETR.IO and Jstris.<br>
                                <br>
                                My main games nowadays are Strinova and Neverness to Everness.<br>
                                <br>
                                Some <span class="-script__new -link" data-href="https://youtu.be/h0OTWNkLP8s?si=TqzM9YbkHIpr0Njn&t=257">context</span> on &quot;the plap guy&quot; title.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= setFooter() ?>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        animatePage([
            {target: "body > .main > .content > .profile", type: "-intro__fade"},
            {target: "body > .main > .content > .profile > .column > .avatar > img", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .column > .username", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .column > .titles", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .column > .label", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .column > .chu2", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .panel > .banner", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .panel > .about > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .panel > .about > .subtitle", type: "-intro__float__left"},
            {target: "body > .main > .content > .profile > .panel > .about > .content", type: "-intro__float__left"},
        ]);
    </script>
</html>