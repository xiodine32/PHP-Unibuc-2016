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
use Models\User;

class Login extends Controller
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
        if ($request->hasPost()) {
            $user = User::where('email', '=', $request->post('email'));
            if (password_verify($request->post('password'), $user->password)) {
                $request->sessionObject()->save("user", $user);
                return new Redirect("/admin/");
            }
            $request->set("error", true);
        }
        return new View("landing.login");
    }
}