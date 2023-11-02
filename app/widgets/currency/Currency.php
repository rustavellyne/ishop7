<?php

namespace IShop\widgets\currency;

use IShop\Framework\App;

class Currency
{
    protected static $template = __DIR__ . '/currency_tpl/currency.php';

    public static function getCurrencies()
    {
        return \IShop\Framework\Db::getInstance()
            ->getAssoc('SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC');
    }

    public static function getCurrency($currencies)
    {
        if (isset($_COOKIE['currency']) && isset($currencies[$_COOKIE['currency']])) {
            $key = $_COOKIE['currency'];
        } else {
            $key = key($currencies);
        }
        $currency = $currencies[$key];
        $currency['code'] = $key;
        return $currency;
    }

    public static function toHtml()
    {
        $currencies = App::$registry::getProperty('currencies');
        $currency = App::$registry::getProperty('currency');
        ob_start();
        include self::$template;
        return ob_get_clean();
    }
}
