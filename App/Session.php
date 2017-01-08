<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 7:56 PM
 */

namespace App;


class Session
{
    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        session_name("biblio_id");
        session_start();
    }

    public function get($name, $default = null)
    {
        if (!isset($_SESSION[$name]))
            return $default;

        return unserialize($_SESSION[$name]);
    }

    public function save($key, $val)
    {
        $_SESSION[$key] = serialize($val);
    }

    public function close()
    {
        session_write_close();
    }

    public function has($name)
    {
        return isset($_SESSION[$name]);
    }

    public function destroy()
    {
        session_destroy();
    }
}