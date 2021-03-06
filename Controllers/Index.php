<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:36 PM
 */

namespace Controllers;


use App\Controller;
use App\Redirect;
use App\Request;
use App\Response;
use App\View;

class Index extends Controller
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function view(Request $request)
    {
        if ($request->session("user")) {
            return new Redirect("/admin/");
        }
        return new View("landing.index");
    }
}