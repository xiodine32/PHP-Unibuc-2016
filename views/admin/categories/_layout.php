<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/17/2017
 * Time: 7:44 PM
 * @var $engine \App\ViewRenderer
 */
if (empty($engine)) die("no engine");
?>
<div class="container">
    <h3>Categories</h3>
    <hr>
    <?php $engine->propagate(); ?>
</div>
