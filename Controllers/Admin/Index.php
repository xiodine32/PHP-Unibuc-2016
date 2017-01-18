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
use App\Settings;
use App\View;
use Models\Book;
use Models\User;

class Index extends ControllerAdmin
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function viewAdmin(Request $request)
    {
        $request->set('users', User::all());
        Categories::addTreeToRequest($request);
        $request->set('settings', Settings::getAllSettings());

        $str = '';
        $v = [];

        if ($item = $request->get('category')) {
            $v = [intval($item)];
            $str = 'WHERE category_id = ?';
        }

        $request->set('breadcrumbs', Book::all($str, $v));
        $request->set('books', Book::all());
        return new View("admin.index");
    }
}