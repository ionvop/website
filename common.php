<?php

/**
 * Enable debugging.
 */
function Debug() {
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);
}

function SetHeader() {
    return <<<HTML
        <div class="-header">
            <div class="-header__content">
                <div class="-header__content__title -title -script__link" data-href="./">
                    <div class="-unskew">
                        ionvop
                    </div>
                </div>
                <div></div>
                <div class="-header__content__about -header__tab -center__flex -script__link" data-href="about/">
                    <div class="-unskew">
                        About
                    </div>
                </div>
                <div class="-header__content__contact -header__tab -center__flex -script__link" data-href="contact/">
                    <div class="-unskew">
                        Contact
                    </div>
                </div>
                <div class="-header__content__sites -header__tab -center__flex -script__link" data-href="sites/">
                    <div class="-unskew">
                        Sites
                    </div>
                </div>
                <div></div>
            </div>
            <div class="-header__border"></div>
        </div>
    HTML;
}

function SetFooter() {
    return <<<HTML
        <div class="-footer">
            <div class="-footer__title">
                &copy; 2024 ionvop
            </div>
            <div></div>
            <div class="-footer__home -footer__tab -center__flex -script__link" data-href="./">
                Home
            </div>
            <div class="-footer__about -footer__tab -center__flex -script__link" data-href="about/">
                About
            </div>
            <div class="-footer__contact -footer__tab -center__flex -script__link" data-href="contact/">
                Contact
            </div>
            <div class="-footer__join -footer__tab -center__flex -script__link" data-href="sites/">
                Sites
            </div>
            <div></div>
        </div>
    HTML;
}

function Icon($icon) {
    switch ($icon) {
        case "send":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e8eaed"><path d="M176-183q-20 8-38-3.5T120-220v-180l320-80-320-80v-180q0-22 18-33.5t38-3.5l616 260q25 11 25 37t-25 37L176-183Z"/></svg>
            HTML;
        case "code":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e8eaed"><path d="m193-479 155 155q11 11 11 28t-11 28q-11 11-28 11t-28-11L108-452q-6-6-8.5-13T97-480q0-8 2.5-15t8.5-13l184-184q12-12 28.5-12t28.5 12q12 12 12 28.5T349-635L193-479Zm574-2L612-636q-11-11-11-28t11-28q11-11 28-11t28 11l184 184q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L668-268q-12 12-28 11.5T612-269q-12-12-12-28.5t12-28.5l155-155Z"/></svg>
            HTML;
        case "game":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e8eaed"><path d="M182-200q-51 0-79-35.5T82-322l42-300q9-60 53.5-99T282-760h396q60 0 104.5 39t53.5 99l42 300q7 51-21 86.5T778-200q-21 0-39-7.5T706-230l-90-90H344l-90 90q-15 15-33 22.5t-39 7.5Zm498-240q17 0 28.5-11.5T720-480q0-17-11.5-28.5T680-520q-17 0-28.5 11.5T640-480q0 17 11.5 28.5T680-440Zm-80-120q17 0 28.5-11.5T640-600q0-17-11.5-28.5T600-640q-17 0-28.5 11.5T560-600q0 17 11.5 28.5T600-560Zm-290 50v40q0 13 8.5 21.5T340-440q13 0 21.5-8.5T370-470v-40h40q13 0 21.5-8.5T440-540q0-13-8.5-21.5T410-570h-40v-40q0-13-8.5-21.5T340-640q-13 0-21.5 8.5T310-610v40h-40q-13 0-21.5 8.5T240-540q0 13 8.5 21.5T270-510h40Z"/></svg>
            HTML;
        case "heart":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e8eaed"><path d="M480-147q-14 0-28.5-5T426-168l-69-63q-106-97-191.5-192.5T80-634q0-94 63-157t157-63q53 0 100 22.5t80 61.5q33-39 80-61.5T660-854q94 0 157 63t63 157q0 115-85 211T602-230l-68 62q-11 11-25.5 16t-28.5 5Z"/></svg>
            HTML;
    }
}