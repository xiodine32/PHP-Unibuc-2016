<?php
/**
 * @var $request \App\Request
 * @var $engine \App\ViewRenderer
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:09 AM
 */
use App\FormHelper;

?>
<ul class="list-unstyled">
    <?php foreach ($request->viewbag('settings') as $item):
        if (strtolower($item[0]) === $item[0])
            continue;
        ?>
        <li>
            <?= FormHelper::start('/admin/settings', 'post', null) ?>
            <?php $activeClass = \App\Settings::get($item) ? 'btn-success' : 'btn-danger' ?>
            <?= FormHelper::submit(ucwords(strtolower(str_replace("_", " ", $item))), [
                'class' => 'btn btn-lg ' . $activeClass,
                'name' => 'toggle',
                'value' => $item

            ]) ?>
            <?= FormHelper::end() ?>
        </li>
    <?php endforeach; ?>
</ul>
