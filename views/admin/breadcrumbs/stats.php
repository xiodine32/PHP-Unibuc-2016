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
<div class="row">
    <div class="col-sm-6">
        <div>
            <pre id="statistics_data" style="height: 340px">loading...</pre>
        </div>
    </div>
    <div class="col-sm-6">
        <div>
            <pre id="pages_data" style="height: 340px">loading...</pre>
        </div>
    </div>
</div>
<?php if ($request->session('user')->hasRole(\Models\User::ADMINISTRATOR)): ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="btn-group text-center" style="margin:0 auto; display: table;">
                <a href="<?= $engine->route('/admin/stats?download=1&range=hour') ?>" target="_blank"
                   class="btn btn-default">Last hour</a>
                <a href="<?= $engine->route('/admin/stats?download=1&range=day') ?>" target="_blank"
                   class="btn btn-default">Last day</a>
                <a href="<?= $engine->route('/admin/stats?download=1&range=week') ?>" target="_blank"
                   class="btn btn-default">Last week</a>
                <a href="<?= $engine->route('/admin/stats?download=1&range=year') ?>" target="_blank"
                   class="btn btn-default">Last year</a>
                <a href="<?= $engine->route('/admin/stats?download=1&range=all') ?>" target="_blank"
                   class="btn btn-default">All</a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="btn-group text-center" style="margin:0 auto; display: table;">
                <a href="<?= $engine->route('/admin/stats?download=2&range=all') ?>" target="_blank"
                   class="btn btn-default">All</a>
            </div>
        </div>
    </div>
<?php endif ?>
<?php $engine->inlineJS() ?>
<script>
    (function () {
        window.hookedUp = function (e) {
            $("#statistics_data").html(e["last"]);
            $("#pages_data").html(e["pages"]);
        };
    })();
</script>
<?php $engine->stopInline() ?>
