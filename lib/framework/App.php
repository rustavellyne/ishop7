<?php

namespace IShop\Framework;

class App
{
    private static $app;

    private \IShop\Framework\Router $router;
    private array $request = [];

    public $registry;

    public function __construct($router, $request)
    {
        $this->request = $request;
        $this->router = $router;
        $this->registry = Registry::getInstance();
        $this->fetchParams();
        new ErrorHandler();
    }

    private function fetchParams()
    {
        $params = require(CONFIG . DS . 'env.php');
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $this->registry->setProperty($key, $value);
            }
        }
        return true;
    }
    
    public function launch()
    {
        $this->router->dispatch($this->request);
    }



}

