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

class BaseController extends Controller
{
    protected $prefix = "/";

    protected $routes = [
        "GET:" => "index",
        "GET:donate/[i:id]" => "donate"
    ];

    public function index() {
        echo "meme";
    }

    public function donate($req, $res) {
        $page = new DonatePage();
        $user = User::where('id', $req->id)->first();
        if($user == null) {
            echo "todo: streamer not found page";
        } else {
            $page->execute(['userID' => $req->id, 'streamer_name' => $user->first_name . " " . $user->last_name]);
        }
    }
}