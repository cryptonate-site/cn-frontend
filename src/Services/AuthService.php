<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/8/2017
 * Time: 3:30 AM
 */

namespace Me\Services;


use Me\Exceptions\NotAuthedException;
use Illuminate\Database\Capsule\Manager as Capsule;
use Me\Models\LoginToken;
use Me\Models\User;

class AuthService
{
    private static $user;
    public static function is_authed($level = 0) {
        if(isset($user))
            return true; //break early if we've already executed this function
        if(isset($_SESSION['login'])) {
            static::$user = User::where("id", $_SESSION['login'])->first();
            return true;
        }

        if(isset($_COOKIE['login_token']) && isset($_COOKIE['userid'])) {
            $collection = LoginToken::where("token", $_COOKIE['login_token'])
                ->where("for_id", $_COOKIE['userid'])->first();
            if($collection != null) {
                setcookie("login_token", null, 0);
                setcookie("userid", null, 0);
                return false;
            }
            $_SESSION['login'] = $_COOKIE['userid'];
            static::$user = User::where("id", $_SESSION['login'])->first();
            return true;
        }
        return false;
    }

    public static function authenticate($callback, $args = null, $level = 0) {
        if(static::is_authed($level)) {
            return call_user_func_array($callback, $args);
        } else {
            throw new NotAuthedException("User not authenticated.");
        }
    }

    public static function get_user() {
        if(isset(static::$user)) {
            return static::$user;
        } else {
            if(static::is_authed()) {
                return static::$user;
            } else {
                return null;
            }
        }
    }
}