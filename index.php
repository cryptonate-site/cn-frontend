<?php
session_start();
require_once "vendor/autoload.php";
define("__DOCROOT__", realpath(__DIR__));
$router = new \Klein\Klein();
$kernel = new \Me\Kernel($router);
$router->dispatch();