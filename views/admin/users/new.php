<?php
/**
 * @var $engine \App\ViewRenderer
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:45 AM
 */
use App\FormHelper;

?>
<?= FormHelper::start($engine->route("/admin/users"), "post", "Add user") ?>
<?= FormHelper::input("text", "name", "name", "Name"); ?>
<?= FormHelper::input("email", "email", "email", "Email"); ?>
<?= FormHelper::input("password", "password", "password", "Password"); ?>
<?= FormHelper::input("password", "password_confirm", "password_confirm", "Repeat Password"); ?>
<div class="form-group">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-danger active">
                <input type="radio" autocomplete="off" checked name="roles[]" value="Administrator">Administrator
            </label>
            <label class="btn btn-default">
                <input type="checkbox" autocomplete="off" name="roles[]" value="Editor">Editor
            </label>
        </div>
    </div>
</div>
<?= FormHelper::submit("Add", ['class' => 'btn btn-lg btn-primary', 'name' => 'add', 'value' => 'true']) ?>
<?= FormHelper::end() ?>
