<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 5/24/2017
 * Time: 11:58 PM
 */

namespace Me\Controller;


use Me\Models\LoginToken;
use Me\Services\NonceService;
use Me\Views\LoginPage;
use Illuminate\Database\Capsule\Manager as Capsule;
class LoginController extends Controller
{
    protected $prefix = "/";
    protected $routes = [
        "GET:login" => "login",
        "POST:login" => "process_login",
        "GET:logout" => "process_logout"
    ];

    public function process_login($request, $response) {
        if(isset($request->username) && isset($request->password) && isset($request->nonce)) {
            $val = Capsule::table("users")->where('username', $request->username)->first();
            if(password_verify($request->password, $val->password)) {
                $_SESSION['login'] = $val->id;
                if($request->remember) {
                    $token = new LoginToken();
                    $token->token = NonceService::generate_nonce();
                    $token->for_id = $val->id;
                    $token->save();
                    setcookie("login_token", $token->token, time() + (3600 * 24 * 30));
                    setcookie("userid", $val->id, time() + (3600 * 24 * 30));
                }
                $response->redirect("/")->send();
            } else {
                $login = new LoginPage();
                $login->execute(['warning' => "Bad username or password."]);
            }
        } else {
            $login = new LoginPage();
            $login->execute(['warning' => "Please enter a username and password."]);
        }
    }

    public function process_logout($request, $response) {
        unset($_SESSION['login']);
        setcookie("login_token", null, 0);
        setcookie("username", null, 0);
        $response->redirect("/")->send();
    }
}