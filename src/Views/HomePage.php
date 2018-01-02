<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2017
 * Time: 3:48 AM
 */

namespace Me\Views;


use Smarty;

class HomePage extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute($args = null) {
        parent::$engine->display('index.tpl');
    }
}