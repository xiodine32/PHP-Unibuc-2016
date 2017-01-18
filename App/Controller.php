<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:25 PM
 */

namespace App;


use Models\Statistic;

abstract class Controller
{
    function __construct(Request $request)
    {
        $this->run($request);
    }

    /**
     * @param Request $request
     */
    private function run(Request $request)
    {
        $view = $this->view($request);

        $s = new Statistic();
        $s->fillFromRequest();
        $s->save();

        // close request because all session logic was done in the controller.
        $request->sessionObject()->close();
        $view->run($request);
    }

    /**
     * @param $request Request
     * @return Response
     */
    abstract protected function view(Request $request);
}