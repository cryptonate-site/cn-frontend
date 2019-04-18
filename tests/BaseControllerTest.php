<?php

require_once "BaseTest.php";

/**
 * Created by PhpStorm.
 * User: ian
 * Date: 4/17/19
 * Time: 8:33 PM
 */


class BaseControllerTest extends BaseTest
{
    public function testTemplatingEngineFunctioning() {
        $c = new \Me\Controller\BaseController();
        $c->index();
        $this->expectOutputRegex("/\<title\>Cryptonate - Home\<\/title\>/");
    }
}
