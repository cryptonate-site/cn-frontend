<?php
/**
 * Created by PhpStorm.
 * User: ianot
 * Date: 4/7/2017
 * Time: 11:06 PM
 */

namespace Me\Controller;

use Illuminate\Database\Capsule\Manager as Capsule;

use Klein\Request;
use Klein\Response;
use Me\Exceptions\NotAuthedException;
use Me\Services\AuthService;

class ApiController extends Controller
{
    protected $prefix = "/frontapi/";
    protected $routes = [
        "GET:generate" => "generate_pass"
    ];

    public function generate_pass($request, $response) {
        return json_encode(["hashed" => password_hash($request->password, PASSWORD_BCRYPT)]);
    }
}