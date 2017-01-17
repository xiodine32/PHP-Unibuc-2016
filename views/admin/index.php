<?php
/**
 * @var $engine \App\ViewRenderer
 * @var $request \App\Request
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:36 PM
 */
use Models\User;

?>
<div class="container">
    <h1>Quick tools</h1>
    <hr>
    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Statistics</a>
            </li>
            <?php if ($request->session('user')->hasRole(User::EDITOR)): ?>
            <li role="presentation"><a href="#categories" aria-controls="categories" role="tab" data-toggle="tab">Categories</a>
            </li>
            <li role="presentation"><a href="#books" aria-controls="books" role="tab" data-toggle="tab">Books</a></li>
            <?php endif ?>
            <?php if ($request->session('user')->hasRole(User::ADMINISTRATOR)): ?>
                <li role="presentation" class="admin"><a href="#users" aria-controls="users" role="tab"
                                                         data-toggle="tab">Users</a></li>
                <li role="presentation" class="admin"><a href="#settings" aria-controls="settings" role="tab"
                                       data-toggle="tab">Settings</a></li>
            <?php endif ?>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="stats">
                <br>
                <?php require __DIR__ . '/breadcrumbs/stats.php ' ?>
            </div>
            <?php if ($request->session('user')->hasRole(User::EDITOR)): ?>
            <div role="tabpanel" class="tab-pane" id="categories">
                <br>
                <?php require __DIR__ . '/breadcrumbs/categories.php ' ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="books">
                <br>
                <?php require __DIR__ . '/breadcrumbs/books.php ' ?>
            </div>
            <?php endif ?>

            <?php if ($request->session('user')->hasRole(User::ADMINISTRATOR)): ?>
                <div role="tabpanel" class="tab-pane" id="users">
                    <br>
                    <?php require __DIR__ . '/breadcrumbs/users.php ' ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="settings">
                    <br>
                    <?php require __DIR__ . '/breadcrumbs/settings.php ' ?>
                </div>
            <?php endif ?>
        </div>

    </div>
</div>