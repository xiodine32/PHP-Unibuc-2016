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
<?php include __DIR__ . "/navbar.php" ?>
<?php $engine->propagate(); ?>
