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

    public function get($name, $default)
    {
        if (!isset($_SESSION[$name]))
            return $default;

        return $_SESSION[$name];
    }

    public function save($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public function close()
    {
        session_write_close();
    }
}