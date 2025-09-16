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
        <link rel="icon" href="favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body > .main {
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg4.png");
                background-size: 100%;

                & > .content {
                    & > .header {
                        & > .title {
                            padding: 10rem;
                            padding-bottom: 5rem;
                            font-size: 2rem;
                            font-weight: bolder;
                        }

                        & > .subtitle {
                            padding: 10rem;
                            padding-top: 0rem;
                        }

                        & > .section {
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            background-color: #111;
                        
                            & > .card {
                                padding: 3rem;

                                & > .info {
                                    display: grid;
                                    grid-template-columns: max-content 1fr;
                                
                                    & > .icon {
                                        padding: 1rem;
                                    
                                        & > svg {
                                            width: 3rem;
                                            height: 3rem;
                                        }
                                    }

                                    & > .subject {
                                        padding: 1rem;
                                        font-weight: bold;
                                    }
                                }

                                & > .details {
                                    padding: 1rem;
                                }
                            }
                        }
                    }

                    & > .section {
                        & > .header {
                            cursor: pointer;
                            filter: brightness(100%);
                            transition: filter 0.1s;
                            background-size: 100%;

                            &:hover {
                                filter: brightness(150%);
                            }
                        
                            & > .title {
                                padding: 10rem;
                                padding-bottom: 5rem;
                                font-weight: bold;
                            }

                            & > .subtitle {
                                padding: 10rem;
                                padding-top: 0rem;
                            }
                        }

                        & > .details {
                            background-color: #111;
                        
                            & > .text {
                                padding: 5rem;
                                line-height: 3rem;
                            }

                            & > .visit {
                                padding: 1rem;
                                padding-top: 0rem;
                                padding-bottom: 10rem;
                            }
                        }
                    }

                    & > .ionvop {
                        & > .header {
                            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/ionvop.png");
                        }
                    }

                    & > .mailist {
                        & > .header {
                            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/mailist.png");
                        }
                    }

                    & > .saucedb {
                        & > .header {
                            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/saucedb.png");
                        }
                    }

                    & > .nicka {
                        & > .header {
                            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/nicka.png");
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
                        & > .header {
                            & > .title {
                                padding: 5rem;
                            }

                            & > .subtitle {
                                padding: 5rem;
                                padding-top: 0rem;
                            }

                            & > .section {
                                grid-template-columns: 1fr;
                            }
                        }

                        & > .section {
                            & > .header {
                                background-size: cover;
                                background-position: 0% 50%;
                                background-attachment: fixed;
                            }
                        }
                    }
                }
            }
        </style>
    </head>
    <body>
        <div class="main -main -script__parallax">
            <?=SetHeader("sites")?>
            <div class="content -content">
                <div class="header">
                    <div class="title -center">
                        Welcome to my sites
                    </div>
                    <div class="subtitle -title -center">
                        These are the sites and services I made
                    </div>
                    <div class="section">
                        <div class="apps card">
                            <div class="info">
                                <div class="icon">
                                    <?=Icon("widgets")?>
                                </div>
                                <div class="subject -title -center">
                                    Apps
                                </div>
                            </div>
                            <div class="details -center">
                                I make apps for web and mobile using HTML, CSS, and JavaScript.<br>
                                All my mobile apps are simply a WebView of the web app.
                            </div>
                        </div>
                        <div class="socials card">
                            <div class="info">
                                <div class="icon">
                                    <?=Icon("group")?>
                                </div>
                                <div class="subject -title -center">
                                    Platforms
                                </div>
                            </div>
                            <div class="details -center">
                                I make social platforms using HTML, CSS, JavaScript, and PHP.<br>
                                The social platforms I make are intended for small-scale communities.
                            </div>
                        </div>
                        <div class="portfolio card">
                            <div class="info">
                                <div class="icon">
                                    <?=Icon("folder_shared")?>
                                </div>
                                <div class="subject -title -center">
                                    Personal
                                </div>
                            </div>
                            <div class="details -center">
                                I make webpages to put all of the things I've made from my other hobbies.<br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ionvop section">
                    <div class="header -script__parallax -script__new" data-href="/home/">
                        <div class="title -title -center">
                            ionvop
                        </div>
                        <div class="subtitle -center">
                            Click here to visit this website
                        </div>
                    </div>
                    <div class="details">
                        <div class="text">
                            This is the landing page for this website.<br>
                            You are currently here right now.
                        </div>
                        <div class="visit -center">
                            <button class="-button -script__new" data-href="/home/">
                                Visit Page
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mailist section">
                    <div class="header -script__parallax -script__new" data-href="/mailist/">
                        <div class="title -title -center">
                            mailist
                        </div>
                        <div class="subtitle -center">
                            A simple platform for custom maimai charts
                        </div>
                    </div>
                    <div class="details">
                        <div class="text">
                            mailist offers a platform for sharing, discovering, and enjoying custom maimai charts.<br>
                            The goal is to create a user-friendly space by developing an English-supported platform that makes it easier to share and discover custom maimai charts.
                        </div>
                        <div class="visit -center">
                            <button class="-button -script__new" data-href="/mailist/">
                                Visit Page
                            </button>
                        </div>
                    </div>
                </div>
                <div class="saucedb section">
                    <div class="header -script__parallax -script__new" data-href="/saucedb/">
                        <div class="title -title -center">
                            SauceDB
                        </div>
                        <div class="subtitle -center">
                            A simple database for archiving anime and manga sources.
                        </div>
                    </div>
                    <div class="details">
                        <div class="text">
                            SauceDB is a simple database for archiving sources of anime and manga that took a little more effort to find.<br>
                            This was one of my first projects and was mostly for personal use.<br>
                            <br>
                            It was very useful back when I was running a Facebook page called "Anime SauceHub" dedicated to helping people find the source of images they provided.<br>
                            Unfortunately, the page was taken down and I no longer do source hunting.
                        </div>
                        <div class="visit -center">
                            <button class="-button -script__new" data-href="/saucedb/">
                                Visit Page
                            </button>
                        </div>
                    </div>
                </div>
                <div class="nicka section">
                    <div class="header -script__parallax -script__new" data-href="/saucedb/">
                        <div class="title -title -center">
                            Nicka's Bohol Motorbike & Car Rental
                        </div>
                        <div class="subtitle -center">
                            An early-2025 commission
                        </div>
                    </div>
                    <div class="details">
                        <div class="text">
                            Nicka's Bohol Motorbike & Car Rental is a service that provide top-quality motorbikes and cars for rent in Bohol, Philippines.<br>
                            Vehicles are well-maintained, reliable, and perfect for exploring the beautiful island of Bohol at your own pace.<br>
                            <br>
                            This was my first time working on a service portfolio kind of website that doesn't have much user interactivity.<br>
                            It was not my strong suite so I hope my future commissions wouldn't be too similar.
                        </div>
                        <div class="visit -center">
                            <button class="-button -script__new" data-href="/saucedb/">
                                Visit Page
                            </button>
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
            {target: "body > .main > .content > .header > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .header > .subtitle", type: "-intro__float__left"},
            {target: "body > .main > .content > .header > .section > .apps > .info > .icon", type: "-intro__float__up"},
            {target: "body > .main > .content > .header > .section > .apps > .info > .subject", type: "-intro__float__up"},
            {target: "body > .main > .content > .header > .section > .apps > .details", type: "-intro__float__left"},
            {target: "body > .main > .content > .header > .section > .socials > .info > .icon", type: "-intro__float__up"},
            {target: "body > .main > .content > .header > .section > .socials > .info > .subject", type: "-intro__float__up"},
            {target: "body > .main > .content > .header > .section > .socials > .details", type: "-intro__float__left"},
            {target: "body > .main > .content > .header > .section > .portfolio > .info > .icon", type: "-intro__float__up"},
            {target: "body > .main > .content > .header > .section > .portfolio > .info > .subject", type: "-intro__float__up"},
            {target: "body > .main > .content > .header > .section > .portfolio > .details", type: "-intro__float__left"},
            {target: "body > .main > .content > .ionvop > .header > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .ionvop > .header > .subtitle", type: "-intro__float__left"},
            {target: "body > .main > .content > .ionvop > .details > .text", type: "-intro__float__left"},
            {target: "body > .main > .content > .ionvop > .details > .visit", type: "-intro__float__left"},
            {target: "body > .main > .content > .mailist > .header > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .mailist > .header > .subtitle", type: "-intro__float__left"},
            {target: "body > .main > .content > .mailist > .details > .text", type: "-intro__float__left"},
            {target: "body > .main > .content > .mailist > .details > .visit", type: "-intro__float__left"},
            {target: "body > .main > .content > .saucedb > .header > .title", type: "-intro__float__left"},
            {target: "body > .main > .content > .saucedb > .header > .subtitle", type: "-intro__float__left"},
            {target: "body > .main > .content > .saucedb > .details > .text", type: "-intro__float__left"},
            {target: "body > .main > .content > .saucedb > .details > .visit", type: "-intro__float__left"}
        ]);

        window.addEventListener("resize", () => {
            updateOffset();
        });

        updateOffset();

        function updateOffset() {
            let sections = document.querySelectorAll("body > .main > .content > .header");

            for (let section of sections) {
                section.setAttribute("data-offset", (section.getBoundingClientRect().top + window.scrollY) * -0.7);
            }

            UpdateParallax();
        }
    </script>
</html>