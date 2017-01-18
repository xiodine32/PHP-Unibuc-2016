<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/18/2017
 * Time: 4:31 AM
 * @var $engine \App\ViewRenderer
 * @var $request \App\Request
 */
use Golonka\BBCode\BBCodeParser;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Mail</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;font-size: 16px;border: 0;padding: 0;margin: 0;line-height: 1.2em;">
<header>
    <h1><?= htmlentities($request->viewbag('subject', '')) ?></h1>
    <h2><?= $request->session('user')->name ?></h2>
    <h3><?= date("Y-m-d H:i:s") ?></h3>
    <p><a href="mailto:<?= $request->session('user')->email ?>"><?= $request->session('user')->email ?></a></p>
    <hr>
</header>
<?= (new BBCodeParser())->parse(htmlentities($request->viewbag('message', ''))); ?>
<footer>
    <hr>
    <h2 style="color: red">This message was generated automatically. Please do NOT respond.</h2>
</footer>
</body>
</html>