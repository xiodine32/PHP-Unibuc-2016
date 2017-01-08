<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:25 PM
 */

namespace App;


class View extends Response
{
    private $vr;

    function __construct($view)
    {
        $path = VIEWS;
        $flow = [];
        foreach (explode(".", $view) as $item) {
            $flow[] = "{$path}/_layout.php";
            $path .= "/{$item}";
        }
        $flow[] = "$path.php";

        $this->vr = null;
        foreach (array_reverse($flow) as $item) {
            $this->vr = new ViewRenderer($item, $this->vr);
        }
    }

    public function run(Request $request)
    {
        $this->vr->run($request);
    }
}