<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:06 PM
 */

namespace Me\Controller;


use Klein\Klein;
use Me\Services\AuthService;
use Me\Views\LoginPage;

class Controller
{
    /**
     * @var string The prefix that is added to all routes under the controller
     */
    protected $prefix = "";
    /**
     * @var array relates uris to controller functions
     */
    protected $routes = [
    ];

    /**
     * @var array relates uris to protected controller functions.
     */
    protected $protected_routes = [
    ];

    protected $not_authed = "login";
    /**
     * Adds routes from the controller.
     * @param $klein Klein the router interface
     */
    public function add_routes($klein) {
        foreach($this->routes as $uri => $function) {
            $method = null;
            if(stristr($uri, ":")) {
                $parts = preg_split("/:/", $uri, 2);
                $method = $parts[0];
                $uri = $parts[1];
            }
            $complete = $this->prefix . $uri;
            if($method != null) {
                $klein->respond($method, $complete, [$this, $function]);
            } else {
                $klein->respond($complete, [$this, $function]);
            }
        }
    }

    /**
     * Adds routes from the controller.
     * @param $klein Klein the router interface
     */
    public function add_protected_routes($klein) {
        foreach($this->protected_routes as $uri => $function) {
            $method = null;
            if(stristr($uri, ":")) {
                $parts = preg_split("/:/", $uri, 2);
                $method = $parts[0];
                $uri = $parts[1];
            }
            $complete = $this->prefix . $uri;
            if(AuthService::is_authed()) {
                if ($method != null) {
                    $klein->respond($method, $complete, [$this, $function]);
                } else {
                    $klein->respond($complete, [$this, $function]);
                }
            } else {
                if ($method != null) {
                    $klein->respond($method, $complete, [$this, $this->not_authed]);
                } else {
                    $klein->respond($complete, [$this, $this->not_authed]);
                }
            }
        }
    }

    public function login() {
        $page = new LoginPage();
        $page->execute(['warning' => 'You need to login to view this page!']);
    }
}