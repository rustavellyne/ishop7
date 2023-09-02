<?php

define("ENV", "developer");
#define("ENV", "prod");
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__DIR__));
define("VENDOR", ROOT . DS . "vendor");
define("WWW", ROOT . DS . "public");
define("APP", ROOT . DS . "app");
define("LIB", ROOT . DS . "lib");
define("FRAMEWORK", LIB . DS . "framework");
define("TMP", ROOT . DS . "var");
define("CACHE", TMP . DS . "cache");
define("CONFIG", ROOT . DS . "config");
define("LAYOUT", "default");

require_once(VENDOR . DS . "autoload.php");
require_once("functions.php");
require_once("router.php");

$protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
define("PROTOCOL", $protocol);
define("DOMAIN_NAME", $_SERVER['HTTP_HOST']);
define("APP_URI", PROTOCOL . "://" . DOMAIN_NAME . "/");
define("ADMIN", APP_URI . "admin");
