<?php

function escape(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

function _url(string $url): string {
    if ($url[0] == '/') {
        return (SITE_ROOT . $url);
    }
    return ($_SERVER["REQUEST_URI"] . $url);
}

function url(string $url) {
    echo _url($url);
}

function e(string $str) {
    echo escape($str);
}

function redirect(string $url) {
    header("Location: "._url($url));
}