<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 1/9/2018
 * Time: 4:47 PM
 */

namespace Me\Views;


class EmailTemplateView extends View
{
    private $template = null;
    public function __construct($template = null)
    {
        if($template === null)
            throw new \LogicException("Cannot instatiate without argument");

        parent::__construct();
        $this->template = "email/" . $template . ".tpl";
    }

    /**
     * @param null $args
     * @return string
     * @throws \Exception
     * @throws \SmartyException
     */
    public function execute($args = null)
    {
        if($args != null) {
            foreach ($args as $k => $v) {
                parent::$engine->assign($k, $v);
            }
        }
        return parent::$engine->fetch($this->template);
    }
}