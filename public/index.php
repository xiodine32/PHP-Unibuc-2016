<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:18 PM
 */

require __DIR__ . '/../vendor/autoload.php';

const VIEWS = __DIR__ . "/../views";

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

if (empty($page) || substr($page, -1) === "/")
    $page .= "index";

$path = "\\Controllers";
foreach (explode("/", $page) as $item) {
    $path .= '\\' . ucfirst($item);
}
$request = new \App\Request($_GET, $_POST, $_FILES);

$class = new $path($request);