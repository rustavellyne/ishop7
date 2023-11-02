<?php 

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\widgets\currency\Currency;

class BaseController extends \IShop\Framework\AbstractController
{
    public function __construct(array $route)
    {
        parent::__construct($route);

        // setcookie('currency', 'EUR', time() + 3600);
        $currencies = Currency::getCurrencies();
        $currency = Currency::getCurrency($currencies);
        App::$registry::setProperty('currencies', $currencies);
        App::$registry::setProperty('currency', $currency);
    }
}

