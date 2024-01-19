<?php

function dd($var) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

function redirect ($http = false) {
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = $_SERVER['HTTP_REFERER'] ?? APP_URI;
    }
    header("Location: $redirect");
    exit;
}
function moneySymbol(float $money) {
    $currency = \IShop\Framework\App::$registry::getProperty('currency');
    return $currency['symbol_left'] . number_format($money, 2, '.', '') . $currency['symbol_right'];
}

function priceCurrency(float $price, $currency = null, $symbols = true) {
    if (is_null($currency)) {
        $currency = \IShop\Framework\App::$registry::getProperty('currency');
    }
    $money = number_format($price * $currency['value'], 2, '.', '');
    if ($symbols) {
        return $currency['symbol_left'] . $money . $currency['symbol_right'];
    }
    return $price * $currency['value'];
}

function lazy_session_start() {
    if (!isset($_SESSION) || !is_array($_SESSION)) {
        session_start();
    }
}

function slugify($string) {
    $string = \transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
    $string = preg_replace('/[-\s]+/', '-', $string);
    return trim($string, '-');
}

