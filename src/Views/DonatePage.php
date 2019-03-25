<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/1/2018
 * Time: 2:30 PM
 */

namespace Me\Views;


class DonatePage extends View
{

    public function execute($args = null)
    {
        foreach($args as $k=>$v) {
            parent::$engine->assign($k, $v);
        }
        parent::$engine->display('donate.tpl');
    }
}