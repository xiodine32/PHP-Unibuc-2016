<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 7:01 PM
 * @var \App\ViewRenderer $engine
 * @var \App\Request $request
 */
$hasError = $request->viewbag('error', false);
?>
<div class="container">
    <h2>Login</h2>
    <hr>
    <?php if ($hasError): ?>
        <div class="alert alert-danger">
            Username and/or password not found!
        </div>
    <?php endif ?>
    <form action="<?= $engine->route("/login") ?>" method="post" class="form form-horizontal">
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email: </label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required
                       value="<?= $request->post('email', '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password: </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-lg btn-primary" id="submit">
                    <span class="fa fa-users" aria-hidden="true"></span>
                    Login
                </button>
            </div>
        </div>
    </form>
</div>
