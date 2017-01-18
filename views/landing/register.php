<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 7:01 PM
 * @var \App\ViewRenderer $engine
 */
use App\Settings;

$hasError = $request->viewbag('error', false);
?>
<div class="container">
    <h2>Register</h2>
    <hr>
    <?php if ($hasError): ?>
        <div class="alert alert-danger">
            The email is already taken!
        </div>
    <?php endif ?>
    <?php if (!Settings::get("DISABLE_REGISTER")): ?>
        <form action="<?= $engine->route("/register") ?>" method="post" class="form form-horizontal">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name: </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required
                           value="<?= $request->post('name', '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email: </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" required
                           value="<?= $request->post('email', '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="encrypted" class="col-sm-2 control-label">Password: </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="encrypted" name="encrypted" required>
                </div>
            </div>
            <div class="form-group">
                <label for="repeat_encrypted" class="col-sm-2 control-label">Repeat Password: </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="repeat_encrypted" name="repeat_encrypted" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-lg btn-primary" id="submit">
                        <span class="fa fa-address-book" aria-hidden="true"></span>
                        Register
                    </button>
                </div>
            </div>
        </form>
    <?php else: ?>
        <p>Sorry, we're not accepting registrations for now.</p>
        <p>Please come back later!</p>
    <?php endif; ?>
</div>
<?php $engine->inlineJS(); ?>
<script>
    (function () {
        $("#submit").click(function (e) {
            var passwordValue = $("#encrypted").val();
            var repeatPasswordValue = $("#repeat_encrypted").val();
            if (passwordValue != repeatPasswordValue || !repeatPasswordValue) {
                e.stopPropagation();
                e.preventDefault();
                alert("Passwords must match!");
                return false;
            }
            return true;
        });
    })();
</script>
<?php $engine->stopInline(); ?>
