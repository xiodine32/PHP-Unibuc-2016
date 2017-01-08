<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:37 PM
 */

namespace App;


class ViewRenderer
{
    private $path;
    private $request;
    private $next;

    /**
     * ViewRenderer constructor.
     * @param string $path
     * @param null|ViewRenderer $next
     */
    public function __construct($path, $next = null)
    {
        $this->path = $path;
        $this->next = $next;
    }

    public function propagate()
    {
        if ($this->next !== null)
            $this->next->run($this->request);
    }

    public function run(Request $request)
    {
        $this->request = $request;
        self::call($this, $request, $this->path);
    }

    /**
     * @param ViewRenderer $engine
     * @param Request $request
     * @param string $path
     */
    private static function call(/** @noinspection PhpUnusedParameterInspection */
        ViewRenderer $engine, Request $request, $path)
    {
        /** @noinspection PhpIncludeInspection */
        require $path;
    }
}