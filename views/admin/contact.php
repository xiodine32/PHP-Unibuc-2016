<?php
/**
 * @var $engine \App\ViewRenderer
 * @var $request \App\Request
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/18/2017
 * Time: 4:12 AM
 */
use App\FormHelper;

//str_replace("\n", "<br/>", (new Golonka\BBCode\BBCodeParser())->parse(e($message->message)))
?>
<div class="container">
    <?= FormHelper::start($engine->route("/admin/contact"), "post", "Contact Us", ['size' => 10]) ?>

    <?php if ($request->viewbag('success', false)): ?>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="alert alert-success">
                    Message sent successfully!
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if ($request->viewbag('error', false) && $request->viewbag('error', false) !== true): ?>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="alert alert-danger">
                    <?= $request->viewbag('error', false) ?>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?= FormHelper::input("text", "subject", "subject", "Subject", ['required' => true, 'value' => $request->viewbag('subject', '')]); ?>

    <?php if ($request->viewbag('error', false) === true): ?>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="alert alert-danger">
                    Message must not be empty!
                </div>
            </div>
        </div>
    <?php endif ?>

    <?= FormHelper::input("textarea", "message", "message", "Message", ['rows' => 10, 'value' => $request->viewbag('message', '')]); ?>
    <?= FormHelper::submit("Send", ['class' => 'btn btn-primary btn-lg', 'name' => 'send', 'value' => 'true']) ?>
    <?= FormHelper::end(); ?>
</div>
<?php $engine->inlineJS() ?>
<script src="//cdn.wysibb.com/js/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="//cdn.wysibb.com/css/default/wbbtheme.css"/>
<script>
    (function () {
        $(document).ready(function () {
            $("#message").wysibb({
                buttons: "bold,italic,underline"
            });
        })
    })();
</script>
<?php $engine->stopInline() ?>

