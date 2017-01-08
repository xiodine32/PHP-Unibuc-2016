<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 9:19 PM
 */

namespace Controllers\Admin;


use App\Request;
use App\Response;
use App\View;

class Index extends ControllerAdmin
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function viewAdmin(Request $request)
    {
        return new View("admin.index");
    }
}