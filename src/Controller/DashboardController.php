<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 1/9/2018
 * Time: 5:25 PM
 */

namespace Me\Controller;

use Me\Models\Transaction;
use Me\Services\AuthService;
use Me\Services\NonceService;
use Me\Views\DashboardPage;
use Me\Views\DashboardView;


class DashboardController extends Controller
{
    protected $prefix = "/dashboard/";
    protected $protected_routes = [
        "GET:" => "dashboard",
        "GET:donations/[i:page]?" => "donations",
        "GET:settings" => "get_settings",
        "POST:settings" => "post_settings",
        "GET:alertbox" => "get_alertbox",
        "POST:alertbox" => "post_alertbox"
    ];

    public function dashboard() {
        $page = new DashboardPage();
        $page->execute();
    }

    public function get_alertbox() {
        $page = new DashboardView("alertbox.tpl");
        $page->execute(["alertbox_key" => AuthService::get_user()->alertboxApiKey]);
    }

    public function post_alertbox() {
        $user = AuthService::get_user();
        $user->alertboxApiKey = NonceService::generate_nonce();
        $user->save();
        $page = new DashboardView("alertbox.tpl");
        $page->execute(["alertbox_key" => $user->alertboxApiKey]);
    }

    public function donations($req, $res) {
        if(!isset($req->page)) {
            $req->page = 0;
        }
        $page = new DashboardView("transactions.tpl");
        $items = Transaction::where("to_email", AuthService::get_user()->id)->orderBy("creation_time", "desc")->offset($req->page * 10)->limit(10)->get();
        $page->execute(["page_name" => "Donations Overview",
            "transaction_array" => $items,
            "current_page" => $req->page,
            "has_next" => $items->count() > 9]);
    }

    public function get_settings() {
        $page = new DashboardView("settings.tpl");
        $page->execute();
    }

    public function post_settings($req, $res) {
        $user = AuthService::get_user();
        if(!empty($req->first_name) && !empty($req->last_name) && !empty($req->email)) {
            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            $user->email = $req->email;
            if(!empty($req->password)) {
                $user->password = password_hash($req->password, PASSWORD_BCRYPT);
            }
            $user->save();
            $page = new DashboardView("settings.tpl");
            if(!empty($req->password)) {
                $res->redirect("/logout");
            }
            $page->execute(["success"=>"Settings saved successfully!"]);
        } else {
            $page = new DashboardView("settings.tpl");
            $page->execute(['warning'=>"All fields must be filled out."]);
        }
    }
}
