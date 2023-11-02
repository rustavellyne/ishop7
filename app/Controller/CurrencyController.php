<?php

namespace IShop\Controller;

class CurrencyController
{
    public function change()
    {
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if ($currency) {
            $db = \IShop\Framework\Db::getInstance();
            $curr = $db->findOne('currency', 'code = ?', [$currency]);
            if (!empty($curr)) {
                setcookie('currency', $currency, time() + 3600 * 24 * 7, '/');
            }
        }
        redirect();
    }
}