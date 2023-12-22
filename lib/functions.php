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

function priceCurrency($price, $currency = null) {
    if (is_null($currency)) {
        $currency = \IShop\Framework\App::$registry::getProperty('currency');
    }
    return $currency['symbol_left'] . $price * $currency['value'] . $currency['symbol_right'];
}

