<?php

namespace IShop\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        $data = [
          'model' => 'I am Home Page model',  
        ];

        $meta = [
            'head' => ['title' => 'IShop7 Home Page'],
            'meta' => [
                ['name' => 'description', 'content' => 'some content of ISHop']
            ]
        ];
        $db = \IShop\Framework\Db::getInstance();
        $brands = $db->connection->find('brand', [], 'LIMIT 3');
        $cache = \IShop\Framework\Cache::getInstance(); 
        $data['brands'] = $brands;        
        $this->setMeta($meta);
        $this->setData($data);
        echo $this->renderPage();
    }
}
