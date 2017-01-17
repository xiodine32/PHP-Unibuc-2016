<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:23 AM
 */

namespace Controllers\Admin;


use App\Redirect;
use App\Request;
use App\Response;
use App\View;
use Models\Category;
use Models\User;

class Categories extends ControllerAdmin
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function viewAdmin(Request $request)
    {
        if (!$this->user->hasRole(User::EDITOR))
            return new Redirect("/admin/index");


        if (($id = $request->post('remove', false))) {
            Category::where('id', '=', $id)->delete();
        }

        if (!$request->hasPost(Category::$required)) {
            self::addTreeToRequest($request);
            return new View("admin.categories.index");
        }

        if (($parent_id = $request->post('create', false)) !== null) {
            if (empty($parent_id))
                $parent_id = null;

            $category = new Category();
            $category->parent_id = $parent_id;
            $category->name = $request->post('name');
            $category->save();
        }


        self::addTreeToRequest($request);
        return new View("admin.categories.index");
    }

    public static function addTreeToRequest(Request $request)
    {
        $roots = [];
        foreach (self::getAll() as $item) {

            if ($item->parent_id === null) {
                $roots[] = $item;
                continue;
            }

            self::recursiveAdd($roots, $item);
        }

        // Planting trees!
        $request->set('tree', $roots);
    }

    private static function getAll()
    {
        return Category::all('ORDER BY ifnull(parent_id, -1) ASC');
    }

    private static function recursiveAdd($roots, $itemToAdd)
    {
        // This function works because a child is always with it's id greater than it's parent.
        // By design I'm not using updates for MySQL, even though I may get sparse tables.
        $targetParent = $itemToAdd->parent_id;
        foreach ($roots as $item) {

            // We have luck.
            if ($targetParent == $item->id) {
                $item->children[] = $itemToAdd;
                return true;
            }

            // Go(l)d digging.
            $returned = self::recursiveAdd($item->children, $itemToAdd);
            if ($returned)
                return true;
        }

        // Bummer.
        return false;
    }
}