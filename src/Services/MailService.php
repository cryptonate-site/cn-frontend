<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 2/13/2018
 * Time: 6:28 PM
 */

namespace Me\Services;

use Me\Kernel;
use Me\Views\EmailTemplateView;
use SendGrid;

class MailService
{
    public static function send_email_from_tpl($template, $args, $subject, $to, $plain_text = null) {
        $from = new SendGrid\Email("Cryptonate", "no-reply@cryptonate.me");
        $to = new SendGrid\Email("Cryptonate User", $to);
        $content1 = null;
        if($plain_text)
            $content1 = new SendGrid\Content("text/plain", $plain_text);
        $view = new EmailTemplateView($template);
        try {
            $content = new SendGrid\Content("text/html", $view->execute($args));
            $mail = new SendGrid\Mail($from, $subject, $to, $content);
            if($content1)
                $mail->addContent($content1);
        } catch(\Exception $e) {
            error_log("Failed to send email! " . $e->getMessage());
            return false;
        }

        $apiKey = Kernel::getInstance()->config['sendgrid']['api_key'];
        $sg = new \SendGrid($apiKey);
        $sg->client->mail()->send()->post($mail);
        return true;
    }
}