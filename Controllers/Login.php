<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:36 PM
 */

namespace Controllers;


use App\Controller;
use App\Request;
use App\Response;
use App\View;

class Login extends Controller
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function view(Request $request)
    {
        return new View("landing.login");
    }
}