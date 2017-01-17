<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/17/2017
 * Time: 9:45 PM
 */

namespace App;


use Models\Setting;

class Settings
{
    private static $options = [];

    private static $cached = [];

    public static function get($name)
    {
        if (!self::isAllowed($name))
            return false;

        self::assureCache($name);

        return self::$cached[$name]->json;
    }

    private static function isAllowed($name)
    {
        self::assureSettings();
        return in_array($name, self::$options);
    }

    private static function assureSettings()
    {
        if (empty(self::$options)) {
            $file_get_contents = file_get_contents(__DIR__ . '/../settings.valid');
            $trim = trim($file_get_contents);
            $explode = explode("\n", $trim);
            $fat = [];
            foreach ($explode as $item) {
                if (substr($item, 0, 1) === "#" || !strlen($item))
                    continue;
                $fat[] = $item;
            }
            self::$options = $fat;
        }
    }

    private static function assureCache($name)
    {
        if (empty(self::$cached[$name])) {
            $result = Setting::where('name', '=', $name);
            if ($result === false) {
                $result = new Setting();
                $result->name = $name;
                $result->json = false;
                $result->save();
            }
            self::$cached[$name] = $result;
        }
    }

    public static function set($name, $json)
    {
        if (!self::isAllowed($name))
            return;

        self::assureCache($name);

        self::$cached[$name]->json = $json;
        self::$cached[$name]->save();
    }

    public static function getAllSettings()
    {
        self::assureSettings();
        return self::$options;
    }
}