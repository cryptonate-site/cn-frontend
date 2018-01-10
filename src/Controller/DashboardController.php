<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 1/9/2018
 * Time: 5:25 PM
 */

namespace Me\Controller;

use Me\Views\DashboardPage;
use Me\Views\DashboardView;


class DashboardController extends Controller
{
    protected $prefix = "/dashboard/";
    protected $protected_routes = [
        "GET:" => "dashboard",
        "GET:donations" => "donations"
    ];

    public function dashboard() {
        $page = new DashboardPage();
        $page->execute();
    }

    public function donations() {
        $page = new DashboardView("transactions.tpl");
        $page->execute();
    }
}