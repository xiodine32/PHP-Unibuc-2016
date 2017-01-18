<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/18/2017
 * Time: 12:22 AM
 */

namespace App;


use Models\Cache;

class CacheManager
{
    private static $cached = [];

    public static function get($name, $callable, $expire_seconds = 3600)
    {
        if (empty(self::$cached[$name])) {
            self::$cached[$name] = Cache::where('name', '=', $name);
            if (self::$cached[$name] === false) {
                $item = new Cache();
                $item->fill([
                    'name' => $name,
                    'value' => $callable(),
                ]);
                $item->seconds = $expire_seconds;
                $item->save();

                self::$cached[$name] = $item;
            }
        }

        $item = self::$cached[$name];

        if (strtotime($item->expires_at) < time()) {
            $item->value = $callable();
            $item->seconds = $expire_seconds;
            $item->save();
        }
        return $item->value;
    }
}