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
use App\View;

class Index extends Controller
{

    /**
     * @param $request Request
     * @return View
     */
    protected function view(Request $request)
    {
        return new View("index");
    }
}