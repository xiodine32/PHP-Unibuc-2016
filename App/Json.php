<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:25 PM
 */

namespace App;


class Json extends Response
{
    private $data;

    function __construct($data)
    {
        $this->data = $data;
    }

    public function run(Request $request)
    {
        header("Content-Type: application/json");
        echo json_encode($this->data);
    }
}