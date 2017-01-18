<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/18/2017
 * Time: 12:09 AM
 */

namespace App;


class SuggestionEngine
{
    const OPTIONS = [
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
    ];
    private $c;

    public function run()
    {
        $url = $this->getURL();

        // this is awesome
        $data = CacheManager::get($url, function () use ($url) {
            $this->c = curl_init();

            curl_setopt_array($this->c, self::OPTIONS);
            curl_setopt($this->c, CURLOPT_URL, $url);

            $data = $this->parseJSON(curl_exec($this->c));

            curl_close($this->c);
            return json_encode($data);
        });

        return json_decode($data, true);
    }

    public function getURL()
    {
        $urls = Settings::get('subreddits');
        $index = mt_rand(0, count($urls) - 1);
        $subreddit = $urls[$index];
        return "https://www.reddit.com/r/{$subreddit}/.json";
    }

    private function parseJSON($data)
    {
        $json = json_decode($data, true);
        $children = $json["data"]["children"];
        $filter = array_filter($children, function ($e) {
            return
                isset($e["data"]["is_self"]) &&
                empty($e["data"]["is_self"]);
        });
        $return = [];
        foreach ($filter as $item) {
            $return[] = [
                "title" => $item["data"]["title"],
                "link" => $item["data"]["url"],
                "thumbnail" => $item["data"]["thumbnail"],
            ];
        }
        return $return;
    }
}