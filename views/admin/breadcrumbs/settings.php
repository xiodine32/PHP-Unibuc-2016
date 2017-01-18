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
    <?php /**
     * @param $item
     * @return string
     */
    function readableName($item)
    {
        return ucwords(strtolower(str_replace("_", " ", $item)));
    }

    foreach ($request->viewbag('settings') as $item):
        if (strtolower($item[0]) === $item[0])
            continue;
        ?>
        <li>
            <?= FormHelper::start('/admin/settings', 'post', null, ['class' => 'form-horizontal']) ?>
            <?php $activeClass = \App\Settings::get($item) ? 'btn-success' : 'btn-danger' ?>
            <?= FormHelper::submit(readableName($item), [
                'class' => 'btn btn-lg ' . $activeClass,
                'label' => 'Toggle',
                'name' => 'toggle',
                'value' => $item

            ]) ?>
            <?= FormHelper::end() ?>
        </li>
    <?php endforeach; ?>
    <?php foreach (['subreddits'] as $item): ?>
        <li>
            <?= FormHelper::start('/admin/settings', 'post', null, ['class' => 'form-horizontal']) ?>
            <?= FormHelper::input('textarea', $item, $item, readableName($item), ['rows' => 10, 'value' => join(\App\Settings::get($item), "\n"), 'style' => 'resize: none;']) ?>
            <?= FormHelper::submit("Submit", [
                'class' => 'btn btn-lg btn-default btn-block',
                'style' => 'margin-top: -15px;',
                'name' => 'save_array',
                'value' => $item
            ]) ?>
            <?= FormHelper::end() ?>
        </li>
    <?php endforeach; ?>
    <?php foreach (['cache', 'pagination'] as $item): ?>
        <li>
            <?= FormHelper::start('/admin/settings', 'post', null, ['class' => 'form-horizontal']) ?>
            <?= FormHelper::input('number', $item, $item, readableName($item), ['value' => \App\Settings::get($item), 'step' => '1']) ?>
            <?= FormHelper::submit("Submit", [
                'class' => 'btn btn-lg btn-default btn-block',
                'style' => 'margin-top: -15px;',
                'name' => 'save_number',
                'value' => $item
            ]) ?>
            <?= FormHelper::end() ?>
        </li>
    <?php endforeach; ?>
</ul>
