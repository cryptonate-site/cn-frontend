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
use Me\Models\User;
use Me\Services\AuthService;
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
        "POST:register" => "process_register"
    ];

    public function index() {
        $page = new TemplateView("index.tpl");
        $page->execute();
    }

    public function donate($req, $res) {
        $page = new DonatePage();
        $user = null;
        $user = User::where('email', $req->streamer)->first();
        if($user == null) {
            echo "todo: streamer not found page";
        } else {
            $page->execute(['userID' => $user->id, 'streamer_name' => $user->first_name . " " . $user->last_name]);
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
            $svc->validateParam("username", "Fill out the email field.")->isEmail();
            $svc->validateParam("password", "Fill out the password field with at least 8 characters")->isLen(8, 64);
            $svc->validateParam("first_name", "Fill out the name field (a-z, max 16 characters)")->notNull()->isAlnum()->isLen(1,16);
            $svc->validateParam("last_name", "Fill out the name field (a-z, max 16 characters)")->notNull()->isAlnum()->isLen(1,16);
            $svc->validateParam("stream_url", "Fill out the URL field")->notNull()->isUrl();
        } catch(Exception $e) {
            $page = new TemplateView("register.tpl");
            $page->execute(["warning" => $e->getMessage()]);
            return;
        }
        $user = new User();
        $user->email = $req->username;
        $user->password = password_hash($req->password, PASSWORD_BCRYPT);
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->url = $req->stream_url;
        $user->alertboxApiKey = NonceService::generate_nonce();
        $user->save();
        $res->redirect("login")->send();
    }
}
