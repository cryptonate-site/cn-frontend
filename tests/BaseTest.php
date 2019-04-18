<?php
require_once "../vendor/autoload.php";
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 4/17/19
 * Time: 8:13 PM
 */


class BaseTest extends \PHPUnit\Framework\TestCase
{
    public function __construct() {
        parent::__construct();
        define("__DOCROOT__", realpath(__DIR__ . "/../"));
        $router = new \Klein\Klein();
        new \Me\Kernel($router);
    }
}
