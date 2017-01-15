<?php
/**
 * @var $engine \App\ViewRenderer
 * @var $request \App\Request
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:45 AM
 */
use App\FormHelper;

?>
<?= FormHelper::start($engine->route("/admin/users"), "post", "Edit user") ?>
<?= FormHelper::input("text", "name", "name", "Name", ['value' => $request->viewbag('item')->name]); ?>
<?= FormHelper::input("email", "email", "email", "Email", ['value' => $request->viewbag('item')->email]); ?>
<?= FormHelper::input("password", "password", "password", "Password"); ?>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-danger <?= $request->viewbag('item')->hasRole("Administrator") ? "active" : "" ?>">
                    <input type="checkbox" autocomplete="off" name="roles[]" value="Administrator"
                        <?= $request->viewbag('item')->hasRole("Administrator") ? "checked" : "" ?>
                    >Administrator
                </label>
                <label class="btn btn-default <?= $request->viewbag('item')->hasRole("Editor") ? "active" : "" ?>">
                    <input type="checkbox" autocomplete="off" name="roles[]" value="Editor"
                        <?= $request->viewbag('item')->hasRole("Editor") ? "checked" : "" ?>
                    >Editor
                </label>
            </div>
        </div>
    </div>
<?= FormHelper::submit("Edit", ['class' => 'btn btn-lg btn-primary', 'name' => 'save', 'value' => $request->viewbag('item')->id]) ?>
<?= FormHelper::end() ?>