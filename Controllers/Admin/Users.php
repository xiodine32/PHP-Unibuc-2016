<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:23 AM
 */

namespace Controllers\Admin;


use App\Request;
use App\Response;
use App\View;
use Models\User;

class Users extends ControllerAdmin
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function viewAdmin(Request $request)
    {
        if ($id = $request->post('delete', false)) {
            User::find($id)->delete();
        }

        if ($id = $request->post('edit', false)) {
            $user = User::find($id);

            // for security...
            $request->save('post_edit_id', $user->id);
            $request->set('item', $user);
            return new View("admin.users.edit");

        }

        if ($request->post('add') === "true") {
            $user = new User();

            $user->fill($request->allPost());
            $user->save();
            $user->setRoles($request->post('roles', []));
        }

        if ($id = $request->post('save', false)) {

            // for security...
            if ($request->session('post_edit_id') !== $id) {
                $request->save('post_edit_id', null);
                return new View("admin.users.edit");
            }

            $user = User::find($id);
            $data = $request->allPost();
            $user->fillEmpty($data);
            $user->save();
            $user->setRoles($request->post('roles', []));
        }

        $request->set('users', User::all());
        return new View("admin.users.index");
    }
}