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
use Models\Category;
use Models\User;

abstract class ControllerAdmin extends Controller
{
    /**
     * @var $user User
     */
    protected $user;

    protected function view(Request $request)
    {
        if (!$this->authenticated($request->sessionObject()))
            return new Redirect("/login");
        $viewAdmin = $this->viewAdmin($request);
        $value = Category::all('WHERE parent_id IS NULL');
        $request->set('titles', $value);
        return $viewAdmin;
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