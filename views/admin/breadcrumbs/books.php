<?php
/**
 * @var $request \App\Request
 * @var $engine \App\ViewRenderer
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:09 AM
 */
?>
<div class="text-center">
    <a href="<?= $engine->route('/admin/books') ?>" class="btn btn-lg btn-success">Add</a>
</div>
<?php require __DIR__ . '/../books/view.php'; ?>


