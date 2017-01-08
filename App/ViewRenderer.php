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
    /**
     * @var Request
     */
    private $request;
    private $next;
    private $inlineJS;

    /**
     * ViewRenderer constructor.
     * @param string $path
     * @param null|ViewRenderer $next
     */
    public function __construct($path, $next = null)
    {
        $this->path = $path;
        $this->next = $next;
        $this->inlineJS = "";
    }

    public function propagate()
    {
        if ($this->next == null)
            return;

        $this->next->run($this->request);
        $this->inlineJS .= $this->next->inlineJS;
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

    public function is($url)
    {
        $viewbag = $this->request->viewbag("url", "");
        return $viewbag === $url;
    }

    public function css($path)
    {
        return $this->route("/res/css/{$path}");
    }

    public function route($url)
    {
        return $url;
    }

    public function js($path)
    {
        return $this->route("/res/js/{$path}");
    }

    public function inlineJS()
    {
        ob_start();
    }

    public function stopInline()
    {
        $content = ob_get_clean();
        $this->inlineJS .= $content;
    }

    public function includeInlineJS()
    {
        echo $this->inlineJS;
        $this->inlineJS = "";
    }
}