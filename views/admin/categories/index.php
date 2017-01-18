<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/17/2017
 * Time: 7:44 PM
 * @var $engine \App\ViewRenderer
 * @var $request \App\Request
 */

use App\FormHelper;

$tree = $request->viewbag('tree', []);

recursive($tree, 0);
?>
    <br>
<?= FormHelper::start('/admin/categories', 'post', null, [
    'class' => 'form-horizontal',
    'id' => "form_-1"]) ?>
    <div class="input-group">
        <input type="text" class="form-control" name="name" id="name_-1" placeholder="New item">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default" name="create" value="">Create</button>
        </span>
    </div>
<?= FormHelper::end() ?>


<?php
/**
 * @param \Models\Category[] $tree
 * @param int $index
 */
function recursive($tree, $index = 0)
{
    foreach ($tree as $item): ?>
        <div style="padding-left: 30px;">

            <h3 data-leaf="<?= $item->id ?>" class="leaf">
                <?= htmlentities($item->name) ?>
                <?= FormHelper::start('/admin/categories', 'post', null, ['class' => 'pull-right']) ?>
                <span class="btn-group">
                    <a href="#form_<?= $item->id ?>" data-toggle="collapse" data-target="#form_<?= $item->id ?>"
                       class="btn btn-success btn-sm">+</a>
                    <button name="remove" value="<?= $item->id ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?');">-</button>
                </span>
                <?= FormHelper::end() ?>

            </h3>

            <?php recursive($item->children, $index + 1); ?>

            <?= FormHelper::start('/admin/categories', 'post', null, [
                'class' => 'form-horizontal collapse',
                'style' => 'padding-left: 30px',
                'id' => "form_{$item->id}"]) ?>
            <div class="input-group">
                <input type="text" class="form-control" name="name" id="name_<?= $item->id ?>" placeholder="New item">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" name="create" value="<?= $item->id ?>">Create</button>
                </span>
            </div>
            <?= FormHelper::end() ?>
        </div>
        <?php
    endforeach;
}