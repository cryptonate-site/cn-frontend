<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 5/24/2017
 * Time: 11:45 PM
 */

namespace Me\Services;


class NonceService
{
    public static function initialize_nonce($size = 16) {
        if(!isset($_SESSION['nonce'])) {
            $_SESSION['nonce'] = bin2hex(openssl_random_pseudo_bytes($size));
        }
        return $_SESSION['nonce'];
    }

    public static function verify_nonce($request) {
        return $request->nonce == $_SESSION['nonce'];
    }

    public static function generate_nonce($size = 32) {
        return bin2hex(openssl_random_pseudo_bytes($size));
    }
}