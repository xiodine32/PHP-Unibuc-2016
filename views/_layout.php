<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:36 PM
 * @var $engine \App\ViewRenderer
 */
if (empty($engine)) die("no engine");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= $engine->css("bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= $engine->css("app.css") ?>">
    <link rel="stylesheet" href="<?= $engine->css("font-awesome.css") ?>">
    <title>bibl.io</title>
</head>
<body>
<?php $engine->propagate(); ?>
<script src="<?= $engine->js("jquery.min.js") ?>"></script>
<script src="<?= $engine->js("bootstrap.min.js") ?>"></script>
<?php $engine->includeInlineJS(); ?>
</body>
</html>
