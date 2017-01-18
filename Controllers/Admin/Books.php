<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:23 AM
 */

namespace Controllers\Admin;


use App\Json;
use App\Redirect;
use App\Request;
use App\Response;
use App\SuggestionEngine;
use App\View;
use Models\Book;
use Models\Category;
use Models\User;

class Books extends ControllerAdmin
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function viewAdmin(Request $request)
    {
        if (!$this->user->hasRole(User::EDITOR))
            return new Redirect("/admin/index");

        if ($request->hasGet('suggestions')) {
            return new Json((new SuggestionEngine())->run());
        }

        if ($id = $request->post('delete', false)) {
            Book::find($id)->delete();
        }

        if ($id = $request->post('edit', false)) {
            $user = Book::find($id);

            // for security...
            $request->save('book_edit_id', $user->id);
            $request->set('item', $user);
            return new View("admin.books.edit");

        }

        if ($request->post('add') === "true") {
            $book = new Book();
//
            $book->fill($request->allPost());
            $book->user_id = $request->session('user')->id;
            $book->created_at = date("Y-m-d H:i:s");
            if (!$book->save()) {
                die("could not insert");
            }
        }

        if ($id = $request->post('save', false)) {
//
//            // for security...
//            if ($request->session('book_edit_id') !== $id) {
//                $request->save('post_edit_id', null);
//                return new View("admin.books.edit");
//            }
//
//            $user = User::find($id);
//            $data = $request->allPost();
//            $user->fillEmpty($data);
//            $user->save();
//            $user->setRoles($request->post('roles', []));
        }

        $request->set('books', Book::all());
        $categories = [];
        foreach (Category::all() as $item) {
            $categories[$item->id] = $item->name;
        }
        $request->set('categories', $categories);
        return new View("admin.books.index");
    }
}