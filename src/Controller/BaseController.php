<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 5/24/2017
 * Time: 11:58 PM
 */

namespace Me\Controller;


use Exception;
use Me\Kernel;
use Me\Models\AlertboxSetting;
use Me\Models\BetaToken;
use Me\Models\Ledger;
use Me\Models\User;
use Me\Services\AuthService;
use Me\Services\MailService;
use Me\Services\NonceService;
use Me\Services\RecaptchaService;
use Me\Views\DonatePage;
use Me\Views\TemplateView;

class BaseController extends Controller
{
    protected $prefix = "/";

    protected $routes = [
        "GET:" => "index",
        "GET:donate/[:streamer]" => "donate",
        "GET:register" => "register",
        "POST:register" => "process_register",
        "GET:register/success" => "success_register",
        "GET:register/activate/[:key]" => "activate_beta",
        "POST:register/activate/[:key]" => "activate_beta_submit"
    ];

    public function index() {
        $page = new TemplateView("index.tpl");
        $page->execute();
    }

    public function donate($req, $res) {
        $page = new DonatePage();
        $user = User::where('stream_name', $req->streamer)->first();
        if($user == null) {
            echo "todo: streamer not found page";
        } else {
            $page->execute(['userID' => $user->id, 'streamer_name' => $user->stream_name]);
        }
    }

    public function register($req, $res) {
        if(AuthService::is_authed()) {
            $res->redirect("/dashboard/")->send();
            return;
        }
        $page = new TemplateView("register.tpl");
        $page->execute();
    }

    public function process_register($req, $res, $svc) {
        if(Kernel::getInstance()->config['register']['disabled']) {
            $page = new TemplateView("register.tpl");
            $page->execute(["warning" => "Registration is closed at the moment. Try again later!"]);
            return;
        }
        if(AuthService::is_authed()) {
            $res->redirect("/dashboard/")->send();
            return;
        }
        if(!RecaptchaService::validateCaptcha($req->param("g-recaptcha-response"))) {
            $page = new TemplateView("register.tpl");
            $page->execute(["warning" => "Recaptcha incorrect, try again."]);
            return;
        }
        try {
            $svc->validateParam("stream_name", "Provide a stream name (at least 3 characters, a-z, -_)")->notNull()->isLen(3,16)->isRegex("/[a-zA-Z0-9-_]*/");
            $svc->validateParam("username", "Fill out the email field.")->isEmail();
            $svc->validateParam("password", "Fill out the password field with at least 8 characters")->isLen(8, 64);
            $svc->validateParam("first_name", "Fill out the name field (a-z, max 16 characters)")->notNull()->isAlnum()->isLen(1,16);
            $svc->validateParam("last_name", "Fill out the name field (a-z, max 16 characters)")->notNull()->isAlnum()->isLen(1,16);
        } catch(Exception $e) {
            $page = new TemplateView("register.tpl");
            $page->execute(["warning" => $e->getMessage()]);
            return;
        }
        if(User::where('email', $req->username)->first()) {
            $page = new TemplateView("register.tpl");
            $page->execute(['warning' => "Email already registered."]);
            return;
        }
        if(User::where('stream_name', $req->stream_name)->first()) {
            $page = new TemplateView("register.tpl");
            $page->execute(['warning' => "Stream name already registered."]);
            return;
        }
        $user = new User();
        $user->email = $req->username;
        $user->password = password_hash($req->password, PASSWORD_BCRYPT);
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->stream_name = $req->stream_name;
        $user->alertboxApiKey = NonceService::generate_nonce();
        $user->registerToken = NonceService::generate_nonce();
        $user->save();
        $ledger = new Ledger();
        $ledger->user_id = $user->id;
        $ledger->save();
        $alertbox = new AlertboxSetting();
        $alertbox->user_id = $user->id;
        $alertbox->save();
        $res->redirect("register/success")->send();
        MailService::send_email_from_tpl("activate",
            ['activation_key'=>$user->id . ":" . $user->registerToken],
            "Activate Your Cryptonate Account",
            $user->email);
    }

    public function success_register() {
        $view = new TemplateView("register.tpl");
        $view->execute(['success' => "Success! Please validate your email by clicking the link we sent you!"]);
    }

    public function activate_beta() {
        $page = new TemplateView("activate_beta.tpl");
        $page->execute(['title' => "Activate"]);
    }

    public function activate_beta_submit($req, $res) {
        if(isset($req->key)) {
            if(!RecaptchaService::validateCaptcha($req->param("g-recaptcha-response"))) {
                $page = new TemplateView("activate_beta.tpl");
                $page->execute(["title" => "Activate", 'warning' =>"Recaptcha incorrect, try again."]);
                return;
            }
            $data = preg_split("/:/", $req->key, 2);
            if(count($data) < 2) {
                $view = new TemplateView("activate_beta.tpl");
                $view->execute(['title' => "Activate", 'warning' => "Could not find your user or activation key! Are you sure you entered the correct URL?"]);
                return;
            }
            $user = User::where('id', $data[0])->where('registerToken', $data[1])->first();
            $token = BetaToken::where('token', $req->beta_token)->where('activated', 0)->first();
            if($user) {
                if($token) {
                    $user->activated = 1;
                    $user->save();
                    $token->activated = 1;
                    $token->user_id = $user->id;
                    $token->save();
                    $view = new TemplateView("activate.tpl");
                    $view->execute(['title' => "Activation Successful", 'body' => "Activation successful. You may now login."]);
                } else {
                    $view = new TemplateView("activate_beta.tpl");
                    $view->execute(['title' => "Activate", "warning" => "Could not find your beta token. Please try again."]);
                }
            } else {
                $view = new TemplateView("activate_beta.tpl");
                $view->execute(['title' => "Activate", 'warning' => "Could not find your user or activation key! Are you sure you entered the correct URL?"]);
            }
        } else {
            $view = new TemplateView("activate.tpl");
            $view->execute(['title' => "Activation Unsuccessful", 'body' => "Could not find your user! Are you sure you entered the correct URL?"]);
        }
    }

    public function activate($req, $res) {
        if(isset($req->key)) {
            if(isset($req))
            $data = preg_split("/:/", $req->key, 2);
            if(count($data) < 2) {
                $view = new TemplateView("activate.tpl");
                $view->execute(['title' => "Activation Unsuccessful", 'body' => "Could not find your user or activation key! Are you sure you entered the correct URL?"]);
                return;
            }
            $user = User::where('id', $data[0])->where('registerToken', $data[1])->first();
            if($user) {
                $user->activated = 1;
                $user->save();
                $view = new TemplateView("activate.tpl");
                $view->execute(['title' => "Activation Successful", 'body' => "Activation successful. You may now login."]);
            } else {
                $view = new TemplateView("activate.tpl");
                $view->execute(['title' => "Activation Unsuccessful", 'body' => "Could not find your user or activation key! Are you sure you entered the correct URL?"]);
            }
        } else {
            $view = new TemplateView("activate.tpl");
            $view->execute(['title' => "Activation Unsuccessful", 'body' => "Could not find your user! Are you sure you entered the correct URL?"]);
        }
    }
}
