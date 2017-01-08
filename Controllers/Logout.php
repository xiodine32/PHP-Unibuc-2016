<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 9:53 PM
 */

namespace Controllers;

use App\Controller;
use App\Redirect;
use App\Request;
use App\Response;

class Logout extends Controller
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function view(Request $request)
    {
        $request->sessionObject()->destroy();
        return new Redirect("/");
    }
}