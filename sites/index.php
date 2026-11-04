<?php

chdir("../");
require_once "common.php";

$sitesJson = file_get_contents(__DIR__ . "/sites.json");
if ($sitesJson === false) {
    throw new RuntimeException("Unable to read Sites configuration.");
}

$sites = json_decode($sitesJson, true, 512, JSON_THROW_ON_ERROR);
if (!is_array($sites) || !array_is_list($sites)) {
    throw new UnexpectedValueException("Sites configuration must be a JSON array.");
}

$siteAnimations = [];
$siteAnimationTargets = [
    ".header > .title",
    ".header > .subtitle",
    ".details > .text",
    ".details > .visit"
];
foreach ($sites as $index => $site) {
    foreach (["id", "title", "subtitle", "description", "href", "image"] as $key) {
        if (!isset($site[$key]) || !is_string($site[$key])) {
            throw new UnexpectedValueException("Invalid Sites entry at index " . $index . ".");
        }
    }

    foreach ($siteAnimationTargets as $target) {
        $siteAnimations[] = [
            "target" => "body > .main > .content > .site-entry[data-site-index=\"" . $index . "\"] > " . $target,
            "type" => "-intro__float__left"
        ];
    }
}

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
                background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("assets/bg4.webp");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;

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
                            background-size: cover;
                            background-position: center;
                            background-attachment: fixed;

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

                }
            }

            @media (orientation: portrait) {
                body > .main {
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
                    }
                }
            }
        </style>
    </head>
    <body>
        <div class="main -main">
            <?= setHeader("sites") ?>
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
                                    <?= icon("widgets") ?>
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
                                    <?= icon("group") ?>
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
                                    <?= icon("folder_shared") ?>
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
                <?php foreach ($sites as $index => $site): ?>
                    <div class="site-entry section" data-site-index="<?= $index ?>" data-site-id="<?= esc($site["id"]) ?>">
                        <div class="header -script__new" data-href="<?= esc($site["href"]) ?>" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= esc($site["image"]) ?>');">
                            <div class="title -title -center">
                                <?= esc($site["title"]) ?>
                            </div>
                            <div class="subtitle -center">
                                <?= esc($site["subtitle"]) ?>
                            </div>
                        </div>
                        <div class="details">
                            <div class="text">
                                <?= nl2br(esc($site["description"]), false) ?>
                            </div>
                            <div class="visit -center">
                                <button class="-button -script__new" data-href="<?= esc($site["href"]) ?>">
                                    Visit Page
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?= setFooter() ?>
        </div>
    </body>
    <script src="script.js"></script>
    <script>
        animatePage([
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
            ...<?= json_encode($siteAnimations, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_THROW_ON_ERROR) ?>
        ]);
    </script>
</html>