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
    private $_get;
    private $_post;
    private $_files;
    private $_viewbag;
    /**
     * @var Session;
     */
    private $_session;

    /**
     * Request constructor.
     * @param array $get
     * @param array $post
     * @param array $files
     */
    public function __construct($get, $post, $files, $session)
    {
        $this->_get = $get;
        $this->_post = $post;
        $this->_files = $files;
        $this->_session = $session;
        $this->_viewbag = [];
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->retrieve("_get", $name, $default);
    }

    /**
     * @param string $item
     * @param mixed $name
     * @param mixed $default
     * @return mixed
     */
    private function retrieve($item, $name, $default)
    {
        $list = $this->$item;
        if (!isset($list[$name]))
            return $default;

        return $list[$name];
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function post($name, $default = null)
    {
        return $this->retrieve("_post", $name, $default);
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function files($name, $default = null)
    {
        return $this->retrieve("_files", $name, $default);
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function viewbag($name, $default = null)
    {
        return $this->retrieve("_viewbag", $name, $default);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function hasGet($name = null)
    {
        return $this->hasRetrieve("_get", $name);
    }

    /**
     * @param string $item
     * @param string|string[] $name
     * @return bool
     */
    private function hasRetrieve($item, $name)
    {
        $list = $this->$item;

        if ($name === null)
            return !empty($list);

        if (!is_array($name))
            $name = [$name];

        foreach ($name as $item) {
            if (!isset($list[$item]))
                return false;
        }
        return true;
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function hasPost($name = null)
    {
        return $this->hasRetrieve("_post", $name);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function hasFiles($name = null)
    {
        return $this->hasRetrieve("_files", $name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasViewbag($name = null)
    {
        return $this->hasRetrieve("_viewbag", $name);
    }

    public function session($name, $default = null)
    {
        return $this->_session->get($name, $default);
    }


    /**
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value)
    {
        $this->_viewbag[$name] = $value;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function save($name, $value)
    {
        $this->_session->save($name, $value);
    }

    public function sessionObject()
    {
        return $this->_session;
    }

    public function allPost()
    {
        return $this->_post;
    }
}