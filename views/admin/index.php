<?php
/**
 * @var $engine \App\ViewRenderer
 * @var $request \App\Request
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:36 PM
 */
?>
<div class="container">
    <h1>Tools</h1>
    <hr>
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Stats</a>
            </li>
            <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
            <li role="presentation"><a href="#categories" aria-controls="categories" role="tab" data-toggle="tab">Categories</a>
            </li>
            <li role="presentation"><a href="#books" aria-controls="books" role="tab" data-toggle="tab">Books</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab"
                                       data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="stats">
                <br>
                <?php require __DIR__ . '/breadcrumbs/stats.php ' ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="users">
                <br>
                <?php require __DIR__ . '/breadcrumbs/users.php ' ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="categories">
                <br>
                <?php require __DIR__ . '/breadcrumbs/categories.php ' ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="books">
                <br>
                <?php require __DIR__ . '/breadcrumbs/books.php ' ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <br>
                <?php require __DIR__ . '/breadcrumbs/settings.php ' ?>
            </div>
        </div>

    </div>
</div>