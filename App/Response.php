<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 6:01 PM
 */

namespace App;


abstract class Response
{
    public abstract function run(Request $request);
}