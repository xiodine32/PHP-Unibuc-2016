<?php
/**
 * @var $engine \App\ViewRenderer
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:36 PM
 */
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="text-center">
                <h2>Why register</h2>
                <div style="display: table;margin: 0 auto;">
                    <ul class="list-unstyled list-loud">
                        <li>Free recommendations</li>
                        <li>Always in the loop</li>
                        <li>Pomote your book</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="text-center">
                <h2>Features</h2>
                <div style="display: table;margin: 0 auto;">
                    <ul class="list-unstyled list-loud">
                        <li>Curated lists</li>
                        <li>Email newsletters</li>
                        <li>Made with love</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-center">
            <h2>What are you waiting for?</h2>
            <h3>A whole new world is ready for you</h3>
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?= $engine->route("/register") ?>" class="btn btn-lg btn-primary">
                        REGISTER
                        <span class="fa fa-address-book" aria-hidden="true">
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="<?= $engine->route("/login") ?>" class="btn btn-lg btn-default">
                        LOGIN
                        <span class="fa fa-users" aria-hidden="true">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>