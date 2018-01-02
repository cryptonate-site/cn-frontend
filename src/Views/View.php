<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 4/5/2017
 * Time: 3:54 AM
 */

namespace Me\Views;


use Me\Services\AuthService;
use Me\Services\NonceService;
use Smarty;

abstract class View
{
    /**
     * @var Smarty smarty var
     */
    protected static $engine;

    public function __construct()
    {
        static::$engine = new Smarty();
        static::$engine->setTemplateDir(__DOCROOT__ . "/templates")
            ->setCompileDir(__DOCROOT__ . "/templates_c");
        static::$engine->assign("nonce", NonceService::initialize_nonce());
        static::$engine->assign("user", AuthService::get_user());

    }

    abstract public function execute($args = null);
}