<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 5/24/2017
 * Time: 11:58 PM
 */

namespace Me\Controller;


use Me\Models\User;
use Me\Views\DonatePage;
use Me\Views\HomePage;

class BaseController extends Controller
{
    protected $prefix = "/";

    protected $routes = [
        "GET:" => "index",
        "GET:donate/[i:id]" => "donate"
    ];

    protected $protected_routes = [
        "GET:dashboard" => "dashboard"
    ];

    public function index() {
        echo "meme";
    }

    public function dashboard() {
        $page = new HomePage();
        $page->execute();
    }

    public function donate($req, $res) {
        $page = new DonatePage();
        $user = User::where('id', $req->id)->first();
        if($user == null) {
            echo "todo: streamer not found page";
        } else {
            $page->execute(['userID' => $req->id, 'streamer_name' => $user->firstName . " " . $user->lastName]);
        }
    }
}