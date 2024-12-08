<?php

chdir("../");
include("common.php");
Debug();

?>

<html>
    <head>
        <title>
            Sites
        </title>
        <base href="../">
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .main__sites {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg4.png");
                background-size: 100%;
            }

            .header__title {
                padding: 10rem;
                padding-bottom: 5rem;
                font-size: 3rem;
                font-weight: bolder;
            }

            .header__subtitle {
                padding: 10rem;
                padding-top: 0rem;
            }

            .header__section {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                background-color: #111;
            }

            .header__section__card {
                padding: 3rem;
            }

            .header__section__info {
                display: grid;
                grid-template-columns: max-content 1fr;
            }

            .header__section__info__icon {
                padding: 1rem;
            }

            .header__section__info__icon > svg {
                width: 3rem;
                height: 3rem;
            }

            .header__section__info__subject {
                padding: 1rem;
                font-weight: bold;
            }

            .header__section__details {
                padding: 1rem;
            }

            .section__header {
                cursor: pointer;
                transition-duration: 0.1s;
                backdrop-filter: brightness(50%);
            }

            .section__header:hover {
                backdrop-filter: brightness(100%);
            }

            .section__header__title {
                padding: 10rem;
                padding-bottom: 5rem;
                font-weight: bold;
            }

            .section__header__subtitle {
                padding: 10rem;
                padding-top: 0rem;
            }

            .section__details {
                padding: 5rem;
                padding-bottom: 10rem;
                background-color: #111;
                line-height: 3rem;
            }

            .ionvop {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/ionvop.png");
                background-size: 100%;
            }

            .mailist {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/mailist.png");
                background-size: 100%;
            }

            .saucedb {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/saucedb.png");
                background-size: 100%;
            }
        </style>
    </head>
    <body>
        <div class="main__sites -main -script__parallax">
            <?=SetHeader()?>
            <div class="content -content">
                <div class="header">
                    <div class="header__title -center">
                        Welcome to my sites
                    </div>
                    <div class="header__subtitle -title -center">
                        These are the sites and services I made
                    </div>
                    <div class="header__section">
                        <div class="header__section__apps header__section__card">
                            <div class="header__section__apps__info header__section__info">
                                <div class="header__section__apps__info__icon header__section__info__icon">
                                    <?=Icon("widgets")?>
                                </div>
                                <div class="header__section__apps__info__subject header__section__info__subject -title -center">
                                    Apps
                                </div>
                            </div>
                            <div class="header__section__apps__details header__section__details -center">
                                I make apps for web and mobile using HTML, CSS, and JavaScript.<br>
                                All my mobile apps are simply a WebView of the web app.
                            </div>
                        </div>
                        <div class="header__section__socials header__section__card">
                            <div class="header__section__socials__info header__section__info">
                                <div class="header__section__socials__info__icon header__section__info__icon">
                                    <?=Icon("group")?>
                                </div>
                                <div class="header__section__socials__info__subject header__section__info__subject -title -center">
                                    Platforms
                                </div>
                            </div>
                            <div class="header__section__socials__details header__section__details -center">
                                I make social platforms using HTML, CSS, JavaScript, and PHP.<br>
                                The social platforms I make are intended for small-scale communities.
                            </div>
                        </div>
                        <div class="header__section__portfolio header__section__card">
                            <div class="header__section__portfolio__info header__section__info">
                                <div class="header__section__portfolio__info__icon header__section__info__icon">
                                    <?=Icon("folder_shared")?>
                                </div>
                                <div class="header__section__portfolio__info__subject header__section__info__subject -title -center">
                                    Personal
                                </div>
                            </div>
                            <div class="header__section__portfolio__details header__section__details -center">
                                I make webpages to put all of the things I've made from my other hobbies.<br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ionvop section -script__parallax">
                    <div class="ionvop__header section__header -script__new" data-href="/home/">
                        <div class="ionvop__header__title section__header__title -title -center">
                            ionvop
                        </div>
                        <div class="ionvop__header__subtitle section__header__subtitle -center">
                            Click here to go to this website
                        </div>
                    </div>
                    <div class="ionvop__details section__details">
                        This is the landing page for this website.<br>
                        You are currently here right now.
                    </div>
                </div>
                <div class="mailist section -script__parallax">
                    <div class="saucedb__header section__header -script__new" data-href="/mailist/">
                        <div class="mailist__header__title section__header__title -title -center">
                            mailist
                        </div>
                        <div class="mailist__header__subtitle section__header__subtitle -center">
                            A simple platform for custom maimai charts
                        </div>
                    </div>
                    
                    <div class="mailist__details section__details">
                        mailist offers a platform for sharing, discovering, and enjoying custom maimai charts.<br>
                        The goal is to create a user-friendly space by developing an English-supported platform that makes it easier to share and discover custom maimai charts.
                    </div>
                </div>
                <div class="saucedb section -script__parallax">
                    <div class="saucedb__header section__header -script__new" data-href="/saucedb/">
                        <div class="saucedb__header__title section__header__title -title -center">
                            saucedb
                        </div>
                        <div class="saucedb__header__subtitle section__header__subtitle -center">
                            A simple database for archiving anime and manga sources.
                        </div>
                    </div>
                    <div class="saucedb__details section__details">
                        saucedb is a simple database for archiving sources of anime and manga that were hard to find.<br>
                        This was one of my first projects and was mostly for personal use.<br>
                        <br>
                        It was very useful back when I was running a Facebook page called "Anime SauceHub" dedicated to helping people find the source of images they provided.<br>
                        Unfortunately, the page was taken down and I no longer do source hunting.
                    </div>
                </div>
            </div>
            <?=SetFooter()?>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        AnimatePage([]);

        window.addEventListener("resize", () => {
            updateOffset();
        });

        updateOffset();

        function updateOffset() {
            let sections = document.querySelectorAll(".section");

            sections.forEach((section) => {
                section.setAttribute("data-offset", (section.getBoundingClientRect().top + window.scrollY) * -0.7);
            });

            UpdateParallax();
        }
    </script>
</html>