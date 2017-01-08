<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 9:17 PM
 */

namespace App;

class Redirect extends Response
{
    private $location;

    /**
     * Redirect constructor.
     * @param string $string
     */
    public function __construct($string)
    {
        $this->location = ViewRenderer::route($string);
    }

    public function run(Request $request)
    {
        header("Location: {$this->location}");
        die();
    }
}