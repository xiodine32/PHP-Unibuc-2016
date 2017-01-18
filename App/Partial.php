<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/18/2017
 * Time: 4:38 AM
 */

namespace App;

class Partial extends View
{
    public function __construct($view)
    {
        parent::__construct($view);
    }

    public function run(Request $request)
    {
        // Fast forward to the last ViewRenderer... hacky.
        $vr = $this->vr;
        while ($vr->getNext() != null)
            $vr = $vr->getNext();
        $this->vr = $vr;

        parent::run($request);
    }

}