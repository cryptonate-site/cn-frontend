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

    public function post_alertbox($req) {
        if($req->action == "regen_key") {
            $user = AuthService::get_user();
            $user->alertboxApiKey = NonceService::generate_nonce();
            $user->save();
        }
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
        $page->execute(['nonce'=>NonceService::initialize_nonce()]);
    }

    public function post_settings($req, $res, $svc) {
        if(!NonceService::verify_nonce($req)) {
            $page = new DashboardView("settings.tpl");
            $page->execute(['warning'=>"Please reenter this information."]);
        }
        if($req->action == "set_settings") {
            try {
                $svc->validateParam("first_name")->notNull()->isLen(1,16);
                $svc->validateParam("last_name")->notNull()->isLen(1,16);
                $svc->validateParam("email")->notNull()->isLen(1,32)->isEmail();
                $svc->validateparam("stream_name")->notNull()->isLen(1,32);
                $user = AuthService::get_user();
                $user->first_name = $req->first_name;
                $user->last_name = $req->last_name;
                $user->email = $req->email;
                $user->stream_name = $req->stream_name;
                $user->save();
                $page = new DashboardView("settings.tpl");
                $page->execute(["success"=>"Settings saved successfully!"]);
            } catch(\Exception $e) {
                $page = new DashboardView("settings.tpl");
                $page->execute(['warning'=>$e->getMessage()]);
            }
        } else if($req->action == "set_password") {
            try {
                $svc->validateParam("password")->notNull()->isLen(8, 64);
                $svc->validateParam("password_confirm")->notNull();
                if($req->password != $req->password_confirm) {
                    $page = new DashboardView("settings.tpl");
                    $page->execute(['warning'=>"Passwords must match!"]);
                }

            } catch(\Exception $e) {
                $page = new DashboardView("settings.tpl");
                $page->execute(['warning'=>$e->getMessage()]);
            }
        } else {
            $page = new DashboardView("settings.tpl");
            $page->execute(['warning'=>"Invalid request."]);
        }
    }
}
