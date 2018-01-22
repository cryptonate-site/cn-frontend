<?php
namespace Me\Services;
use Me\Kernel;

class RecaptchaService {
    public static function validateCaptcha($g_captcha_response) {
        if($g_captcha_response === null) return false;
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => Kernel::getInstance()->config['recaptcha']['secret'],
            'response' => $g_captcha_response
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success=json_decode($verify);
        return $captcha_success->success;
    }
}