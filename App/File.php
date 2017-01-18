<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:25 PM
 */

namespace App;


class File extends Response
{
    private $data;

    function __construct(FileData $data)
    {
        $this->data = $data;
    }

    public function run(Request $request)
    {
        header("Content-Type: text/csv");

        $name = $request->viewbag('name', 'output');

        $date = date("YmdHis");

        header("Content-Disposition: attachment; filename=\"{$name}_{$date}.csv\"");
        echo $this->data;
    }
}