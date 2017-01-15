<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 6:19 PM
 */

namespace Controllers;


use App\Controller;
use App\Request;
use App\Response;
use App\View;
use Exception;

class Controller505 extends Controller
{
    public function __construct(Request $request, Exception $e)
    {
        $request->set("e", $e);
        parent::__construct($request);
    }


    /**
     * @param $request Request
     * @return Response
     */
    protected function view(Request $request)
    {
        return new View("505");
    }
}