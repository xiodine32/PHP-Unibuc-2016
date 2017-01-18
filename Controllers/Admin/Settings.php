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
        if ($name = $request->post('save_array')) {
            $json = explode("\n", trim($request->post($name)));
            foreach ($json as &$obj) {
                $obj = trim($obj);
            }
            unset($obj);
            S::set($name, $json);
        }
        if ($name = $request->post('save_number')) {
            S::set($name, intval($request->post($name)));
        }
        if ($name = $request->post('save_string')) {
            S::set($name, $request->post($name));
        }
        return new Redirect("/admin/");
    }
}