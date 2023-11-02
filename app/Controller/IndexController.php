<?php

namespace IShop\Controller;

use IShop\Framework\App;
use IShop\widgets\currency\Currency;

class IndexController extends BaseController
{
    public function index()
    {
        $data = [];
        $meta = [
            'head' => ['title' => 'IShop7 Home Page'],
            'meta' => [
                ['name' => 'description', 'content' => 'some content of ISHop']
            ]
        ];
        $cache = \IShop\Framework\Cache::getInstance();

        $db = \IShop\Framework\Db::getInstance();
        $brands = $db->connection->find('brand', [], 'LIMIT 3');
        $popularProjects = $db->connection->find('product', [], "hit = '1' AND status = '1' LIMIT 8");
        $currency = App::$registry::getProperty('currency');

        $data['brands'] = $brands;        
        $data['popularProjects'] = $popularProjects;
        $data['currency'] = $currency;
        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }
}
