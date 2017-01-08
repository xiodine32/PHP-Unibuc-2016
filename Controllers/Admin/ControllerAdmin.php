<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 9:42 PM
 */

namespace Controllers\Admin;


use App\Controller;
use App\Redirect;
use App\Request;
use App\Session;

abstract class ControllerAdmin extends Controller
{
    protected $user;

    protected function view(Request $request)
    {
        if (!$this->authenticated($request->sessionObject()))
            return new Redirect("/login");
        return $this->viewAdmin($request);
    }

    private function authenticated(Session $session)
    {
        if ($session->has("user")) {
            $this->user = $session->get("user");
            return true;
        }
        return false;
    }

    protected abstract function viewAdmin(Request $request);

}