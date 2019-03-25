<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2017
 * Time: 3:48 AM
 */

namespace Me\Views;


use Smarty;

class LoginPage extends View
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute($args = null) {
        foreach($args as $k=>$v) {
            parent::$engine->assign($k, $v);
        }
        parent::$engine->display('login.tpl');
    }
}