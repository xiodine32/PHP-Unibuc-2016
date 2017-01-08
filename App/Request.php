<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:25 PM
 */

namespace App;


class Request
{
    private $get;
    private $post;
    private $files;
    private $viewbag;

    /**
     * Request constructor.
     * @param array $get
     * @param array $post
     * @param array $files
     */
    public function __construct($get, $post, $files)
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->viewbag = [];
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->retrieve("get", $name, $default);
    }

    /**
     * @param string $item
     * @param mixed $name
     * @param mixed $default
     * @return mixed
     */
    private function retrieve($item, $name, $default)
    {
        if (!isset($this->$item[$name]))
            return $default;

        return $this->$item[$name];
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function post($name, $default = null)
    {
        return $this->retrieve("post", $name, $default);
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function files($name, $default = null)
    {
        return $this->retrieve("files", $name, $default);
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function viewbag($name, $default = null)
    {
        return $this->retrieve("viewbag", $name, $default);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value)
    {
        $this->viewbag[$name] = $value;
    }

}