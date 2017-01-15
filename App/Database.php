<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 8:24 PM
 */

namespace App;


class Database
{
    private static $singleton = null;
    private $pdo;

    function __construct()
    {
        $hostname = "localhost";
        $dbname = "project";
        $username = "project";
        $password = "project";
        $this->pdo = new \PDO("mysql:host=$hostname;dbname={$dbname}", $username, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public static function singleton()
    {
        if (self::$singleton === null)
            self::$singleton = new Database();

        return self::$singleton;
    }

    public function get($statement, $assoc = [])
    {
        $v = $this->prepare($statement);
        $v->execute($assoc);
        return $v->fetch();
    }

    public function prepare($statement)
    {
        return $this->pdo->prepare($statement);
    }

    public function getAll($statement, $assoc = [])
    {
        $v = $this->prepare($statement);
        $v->execute($assoc);
        return $v->fetchAll();
    }

    public function query($statement, $assoc = [])
    {
        $v = $this->prepare($statement);
        return $v->execute($assoc);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}