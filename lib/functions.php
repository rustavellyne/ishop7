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

function priceCurrency($price, $currency = null, $symbols = true) {
    if (is_null($currency)) {
        $currency = \IShop\Framework\App::$registry::getProperty('currency');
    }
    if ($symbols) {
        return $currency['symbol_left'] . $price * $currency['value'] . $currency['symbol_right'];
    }
    return $price * $currency['value'];
}

function lazy_session_start() {
    if (!isset($_SESSION) || !is_array($_SESSION)) {
        session_start();
    }
}

