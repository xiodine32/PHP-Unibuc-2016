<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:18 PM
 */

require __DIR__ . '/../vendor/autoload.php';

const VIEWS = __DIR__ . "/../views";
const CONTROLLERS = __DIR__ . "/../Controllers";

$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);

if (empty($page) || substr($page, -1) === "/")
    $page .= "index";

$realPath = CONTROLLERS;
$path = "\\Controllers";
foreach (explode("/", $page) as $item) {
    $path .= '\\' . ucfirst($item);
    $realPath .= '/' . ucfirst($item);
}
$realPath .= ".php";
$request = new \App\Request($_GET, $_POST, $_FILES);


if (!file_exists($realPath))
    $path = "\\Controllers\\Controller404";

$class = new $path($request);
