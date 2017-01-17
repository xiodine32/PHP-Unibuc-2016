<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 9:19 PM
 */

namespace Controllers\Admin;


use App\Redirect;
use App\Request;
use App\Response;
use App\Settings as S;

class Settings extends ControllerAdmin
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function viewAdmin(Request $request)
    {
        if ($name = $request->post("toggle")) {
            S::set($name, !S::get($name));
        }
        return new Redirect("/admin/");
    }
}