<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 1/9/2018
 * Time: 4:47 PM
 */

namespace Me\Views;


use Me\Services\AuthService;

class TemplateView extends View
{
    private $template = null;
    public function __construct($template = null)
    {
        if($template === null)
            throw new \LogicException("Cannot instatiate without argument");

        parent::__construct();
        $this->template = $template;
    }

    public function execute($args = null)
    {
        if($args != null) {
            foreach ($args as $k => $v) {
                parent::$engine->assign($k, $v);
            }
        }
        parent::$engine->assign("is_logged_in", AuthService::is_authed());
        parent::$engine->display($this->template);
    }
}