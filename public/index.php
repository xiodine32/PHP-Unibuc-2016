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

$requestPage = filter_input(INPUT_GET, "page", FILTER_SANITIZE_URL);
$page = $requestPage;
$requestPage = "/{$requestPage}";

if (empty($page) || substr($page, -1) === "/")
    $page .= "index";

$realPath = CONTROLLERS;
$path = "\\Controllers";
foreach (explode("/", $page) as $item) {
    $path .= '\\' . ucfirst($item);
    $realPath .= '/' . ucfirst($item);
}
$realPath .= ".php";

$request = initRequest($requestPage);

try {
    if (!file_exists($realPath))
        $path = "\\Controllers\\Controller404";

    $class = new $path($request);

} catch (Exception $e) {
    $class = new \Controllers\Controller505($request, $e);
}

function initRequest($requestPage)
{
    $request = new \App\Request($_GET, $_POST, $_FILES, new \App\Session());
    $request->set("url", $requestPage);
    return $request;
}