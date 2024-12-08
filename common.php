<?php

include("config.php");

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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M176-183q-20 8-38-3.5T120-220v-180l320-80-320-80v-180q0-22 18-33.5t38-3.5l616 260q25 11 25 37t-25 37L176-183Z"/></svg>
            HTML;
        case "code":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m193-479 155 155q11 11 11 28t-11 28q-11 11-28 11t-28-11L108-452q-6-6-8.5-13T97-480q0-8 2.5-15t8.5-13l184-184q12-12 28.5-12t28.5 12q12 12 12 28.5T349-635L193-479Zm574-2L612-636q-11-11-11-28t11-28q11-11 28-11t28 11l184 184q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L668-268q-12 12-28 11.5T612-269q-12-12-12-28.5t12-28.5l155-155Z"/></svg>
            HTML;
        case "game":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M182-200q-51 0-79-35.5T82-322l42-300q9-60 53.5-99T282-760h396q60 0 104.5 39t53.5 99l42 300q7 51-21 86.5T778-200q-21 0-39-7.5T706-230l-90-90H344l-90 90q-15 15-33 22.5t-39 7.5Zm498-240q17 0 28.5-11.5T720-480q0-17-11.5-28.5T680-520q-17 0-28.5 11.5T640-480q0 17 11.5 28.5T680-440Zm-80-120q17 0 28.5-11.5T640-600q0-17-11.5-28.5T600-640q-17 0-28.5 11.5T560-600q0 17 11.5 28.5T600-560Zm-290 50v40q0 13 8.5 21.5T340-440q13 0 21.5-8.5T370-470v-40h40q13 0 21.5-8.5T440-540q0-13-8.5-21.5T410-570h-40v-40q0-13-8.5-21.5T340-640q-13 0-21.5 8.5T310-610v40h-40q-13 0-21.5 8.5T240-540q0 13 8.5 21.5T270-510h40Z"/></svg>
            HTML;
        case "heart":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-147q-14 0-28.5-5T426-168l-69-63q-106-97-191.5-192.5T80-634q0-94 63-157t157-63q53 0 100 22.5t80 61.5q33-39 80-61.5T660-854q94 0 157 63t63 157q0 115-85 211T602-230l-68 62q-11 11-25.5 16t-28.5 5Z"/></svg>
            HTML;
        case "github":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.001 2C6.47598 2 2.00098 6.475 2.00098 12C2.00098 16.425 4.86348 20.1625 8.83848 21.4875C9.33848 21.575 9.52598 21.275 9.52598 21.0125C9.52598 20.775 9.51348 19.9875 9.51348 19.15C7.00098 19.6125 6.35098 18.5375 6.15098 17.975C6.03848 17.6875 5.55098 16.8 5.12598 16.5625C4.77598 16.375 4.27598 15.9125 5.11348 15.9C5.90098 15.8875 6.46348 16.625 6.65098 16.925C7.55098 18.4375 8.98848 18.0125 9.56348 17.75C9.65098 17.1 9.91348 16.6625 10.201 16.4125C7.97598 16.1625 5.65098 15.3 5.65098 11.475C5.65098 10.3875 6.03848 9.4875 6.67598 8.7875C6.57598 8.5375 6.22598 7.5125 6.77598 6.1375C6.77598 6.1375 7.61348 5.875 9.52598 7.1625C10.326 6.9375 11.176 6.825 12.026 6.825C12.876 6.825 13.726 6.9375 14.526 7.1625C16.4385 5.8625 17.276 6.1375 17.276 6.1375C17.826 7.5125 17.476 8.5375 17.376 8.7875C18.0135 9.4875 18.401 10.375 18.401 11.475C18.401 15.3125 16.0635 16.1625 13.8385 16.4125C14.201 16.725 14.5135 17.325 14.5135 18.2625C14.5135 19.6 14.501 20.675 14.501 21.0125C14.501 21.275 14.6885 21.5875 15.1885 21.4875C19.259 20.1133 21.9999 16.2963 22.001 12C22.001 6.475 17.526 2 12.001 2Z"></path></svg>
            HTML;
        case "widgets":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M638-468 468-638q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l170-170q6-6 13-8.5t15-2.5q8 0 15 2.5t13 8.5l170 170q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L694-468q-6 6-13 8.5t-15 2.5q-8 0-15-2.5t-13-8.5Zm-518-92v-240q0-17 11.5-28.5T160-840h240q17 0 28.5 11.5T440-800v240q0 17-11.5 28.5T400-520H160q-17 0-28.5-11.5T120-560Zm400 400v-240q0-17 11.5-28.5T560-440h240q17 0 28.5 11.5T840-400v240q0 17-11.5 28.5T800-120H560q-17 0-28.5-11.5T520-160Zm-400 0v-240q0-17 11.5-28.5T160-440h240q17 0 28.5 11.5T440-400v240q0 17-11.5 28.5T400-120H160q-17 0-28.5-11.5T120-160Z"/></svg>
            HTML;
        case "group":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M40-272q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240v-32Zm698 112q11-18 16.5-38.5T760-240v-40q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v40q0 33-23.5 56.5T840-160H738ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113Z"/></svg>
            HTML;
        case "folder_shared":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h207q16 0 30.5 6t25.5 17l57 57h320q33 0 56.5 23.5T880-640v400q0 33-23.5 56.5T800-160H160Zm280-120h320v-22q0-45-44-71.5T600-400q-72 0-116 26.5T440-302v22Zm160-160q33 0 56.5-23.5T680-520q0-33-23.5-56.5T600-600q-33 0-56.5 23.5T520-520q0 33 23.5 56.5T600-440Z"/></svg>
            HTML;
        case "phone_android":
            return <<<HTML
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M420-160h120q8 0 14-6t6-14q0-8-6-14t-14-6H420q-8 0-14 6t-6 14q0 8 6 14t14 6ZM280-40q-33 0-56.5-23.5T200-120v-720q0-33 23.5-56.5T280-920h400q33 0 56.5 23.5T760-840v720q0 33-23.5 56.5T680-40H280Zm0-280h400v-400H280v400Z"/></svg>
            HTML;
    }
}

function Loader($type) {
    switch ($type) {
        case "pulse-rings-multiple":
            return <<<HTML
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" transform="translate(12, 12) scale(0)">
                        <animateTransform id="spinner_dYH2" begin="0;spinner_2BXs.end" attributeName="transform" calcMode="spline" type="translate" dur="1.2s" values="12 12;0 0" keySplines=".52,.6,.25,.99"/>
                        <animateTransform begin="0;spinner_2BXs.end" attributeName="transform" calcMode="spline" additive="sum" type="scale" dur="1.2s" values="0;1" keySplines=".52,.6,.25,.99"/>
                        <animate begin="0;spinner_2BXs.end" attributeName="opacity" calcMode="spline" dur="1.2s" values="1;0" keySplines=".52,.6,.25,.99"/>
                    </path>
                    <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" transform="translate(12, 12) scale(0)">
                        <animateTransform id="spinner_novB" begin="spinner_dYH2.begin+0.2s" attributeName="transform" calcMode="spline" type="translate" dur="1.2s" values="12 12;0 0" keySplines=".52,.6,.25,.99"/>
                        <animateTransform begin="spinner_dYH2.begin+0.2s" attributeName="transform" calcMode="spline" additive="sum" type="scale" dur="1.2s" values="0;1" keySplines=".52,.6,.25,.99"/>
                        <animate begin="spinner_dYH2.begin+0.2s" attributeName="opacity" calcMode="spline" dur="1.2s" values="1;0" keySplines=".52,.6,.25,.99"/>
                    </path>
                    <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" transform="translate(12, 12) scale(0)">
                        <animateTransform id="spinner_2BXs" begin="spinner_dYH2.begin+0.4s" attributeName="transform" calcMode="spline" type="translate" dur="1.2s" values="12 12;0 0" keySplines=".52,.6,.25,.99"/>
                        <animateTransform begin="spinner_dYH2.begin+0.4s" attributeName="transform" calcMode="spline" additive="sum" type="scale" dur="1.2s" values="0;1" keySplines=".52,.6,.25,.99"/>
                        <animate begin="spinner_dYH2.begin+0.4s" attributeName="opacity" calcMode="spline" dur="1.2s" values="1;0" keySplines=".52,.6,.25,.99"/>
                    </path>
                </svg>
            HTML;
        case "rings":
            return <<<HTML
                <svg viewBox="0 0 45 45" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                    <g fill="none" fill-rule="evenodd" transform="translate(1 1)" stroke-width="2">
                        <circle cx="22" cy="22" r="6" stroke-opacity="0">
                            <animate attributeName="r" begin="1.5s" dur="3s" values="6;22" calcMode="linear" repeatCount="indefinite"/>
                            <animate attributeName="stroke-opacity" begin="1.5s" dur="3s" values="1;0" calcMode="linear" repeatCount="indefinite"/>
                            <animate attributeName="stroke-width" begin="1.5s" dur="3s" values="2;0" calcMode="linear" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="22" cy="22" r="6" stroke-opacity="0">
                            <animate attributeName="r" begin="3s" dur="3s" values="6;22" calcMode="linear" repeatCount="indefinite"/>
                            <animate attributeName="stroke-opacity" begin="3s" dur="3s" values="1;0" calcMode="linear" repeatCount="indefinite"/>
                            <animate attributeName="stroke-width" begin="3s" dur="3s" values="2;0" calcMode="linear" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="22" cy="22" r="8">
                            <animate attributeName="r" begin="0s" dur="1.5s" values="6;1;2;3;4;5;6" calcMode="linear" repeatCount="indefinite"/>
                        </circle>
                    </g>
                </svg>
            HTML;
    }
}

/**
 * Sends an HTTP request using cURL and returns the response.
 *
 * This function initiates a cURL session to send an HTTP request to the specified URL using the given method, headers, 
 * and data. It supports custom request methods and bypasses SSL verification. If the request fails, the function returns false.
 *
 * @param string $url     The URL to which the request is sent.
 * @param string $method  The HTTP method to use for the request (e.g., 'GET', 'POST', 'PUT', 'DELETE').
 * @param array  $headers An array of HTTP headers to include in the request.
 * @param mixed  $data    The data to send with the request. Typically an associative array or a JSON string.
 *
 * @return mixed The response from the server as a string, or false if the request fails.
 */
function SendCurl($url, $method, $headers, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);

    if (curl_errno($ch) != 0) {
        return false;
    }

    curl_close($ch);
    return $result;
}