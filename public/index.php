<?php 

require_once("../lib/bootstrap.php");

$router = new \IShop\Framework\Router();

$app = new \IShop\Framework\App($router, $_SERVER);
$app->launch();

