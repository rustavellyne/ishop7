<?php

namespace IShop\Framework;

class App
{
    private static $app;

    private \IShop\Framework\Router $router;
    private array $request = [];

    public static Registry $registry;

    public function __construct($router, $request)
    {
        $this->request = $request;
        $this->router = $router;
        self::$registry = Registry::getInstance();
        $this->fetchParams();
        new ErrorHandler();
    }

    private function fetchParams()
    {
        $params = require(CONFIG . DS . 'env.php');
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                self::$registry->setProperty($key, $value);
            }
        }
        return true;
    }
    
    public function launch()
    {
        lazy_session_start();
        $this->router->dispatch($this->request);
    }

    public static function getProperties(?string $key = null)
    {
        if ($key === null) {
            return self::$registry->getProperties();
        }
        return self::$registry->getProperty($key);
    }
}

