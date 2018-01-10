<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 1/9/2018
 * Time: 5:25 PM
 */

namespace Me\Controller;

use Me\Services\AuthService;
use Me\Views\DashboardPage;
use Me\Views\DashboardView;


class DashboardController extends Controller
{
    protected $prefix = "/dashboard/";
    protected $protected_routes = [
        "GET:" => "dashboard",
        "GET:donations" => "donations",
        "GET:settings" => "get_settings",
        "POST:settings" => "post_settings"
    ];

    public function dashboard() {
        $page = new DashboardPage();
        $page->execute();
    }

    public function donations() {
        $page = new DashboardView("transactions.tpl");
        $page->execute(["page_name", "Donations Overview"]);
    }

    public function get_settings() {
        $page = new DashboardView("settings.tpl");
        $page->execute(["page_name" => "Settings"]);
    }

    public function post_settings($req, $res) {
        $user = AuthService::get_user();
        if(!empty($req["first-name"]) && !empty($req["last-name"]) && !empty($req->email)) {
            $user->first_name = $req["first-name"];
            $user->last_name = $req["last-name"];
            $user->email = $req->email;
            if(!empty($user->password)) {
                $user->password = password_hash($req->password, PASSWORD_BCRYPT);
            }
            $user->save();
            $page = new DashboardView("settings.tpl");
            $page->execute(["success"=>"Settings saved successfully!"]);
        } else {
            $page = new DashboardView("settings.tpl");
            $page->execute(['warning'=>"All fields must be filled out."]);
        }
    }
}
