<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 1/9/2018
 * Time: 6:16 PM
 */

namespace Me\Views;


use Me\Services\AuthService;

class DashboardView extends TemplateView
{
    public function __construct($template = null)
    {
        parent::__construct("dashboard/" . $template);
        parent::$engine->assign("user", AuthService::get_user());
        parent::$engine->assign("streamer_name", AuthService::get_user()->first_name . " " . AuthService::get_user()->last_name);
    }
}