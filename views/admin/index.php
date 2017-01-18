<?php
/**
 * @var $engine \App\ViewRenderer
 * @var $request \App\Request
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 5:36 PM
 */
use Models\Book;
use Models\User;

?>
<div class="container">
    <?php if (
        $request->session('user')->hasRole(User::EDITOR) ||
        $request->session('user')->hasRole(User::ADMINISTRATOR)
    ): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#" data-toggle="collapse" data-target="#targetcollapse">
                        Tools
                    </a>
                </h3>
            </div>
            <div class="collapse <?= \App\Settings::get('COLLAPSE') ? 'in' : '' ?>" id="targetcollapse">
                <div class="panel-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#stats" aria-controls="stats" role="tab"
                                                                  data-toggle="tab">Statistics</a>
                        </li>
                        <?php if ($request->session('user')->hasRole(User::EDITOR)): ?>
                            <li role="presentation"><a href="#categories" aria-controls="categories" role="tab"
                                                       data-toggle="tab">Categories</a>
                            </li>
                            <li role="presentation"><a href="#books" aria-controls="books" role="tab" data-toggle="tab">Books</a>
                            </li>
                        <?php endif ?>
                        <?php if ($request->session('user')->hasRole(User::ADMINISTRATOR)): ?>
                            <li role="presentation" class="admin"><a href="#users" aria-controls="users" role="tab"
                                                                     data-toggle="tab">Users</a></li>
                            <li role="presentation" class="admin"><a href="#settings" aria-controls="settings"
                                                                     role="tab"
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
    </div>
        <hr>
    <?php endif ?>
    <div class='row'>
        <?php foreach ($request->viewbag('books') as $book): ?>
            <?php breadcrumb($book); ?>
        <?php endforeach ?>
    </div>
</div>
<?php

function breadcrumb(Book $book)
{
    ?>
    <div class='col-sm-6'>
        <div class="story">
            <a href='<?= $book->link ?>' target='_blank'>
                <div class='well noa'>
                    <div class='row'>
                        <div class='col-sm-6'><img class='img-responsive' src='<?= $book->thumbnail ?>'/></div>
                        <div class='col-sm-6'><?= $book->title ?></div>
                    </div>
                    <hr>
                    <span><?= $book->created_at ?></span>
                    <span class='pull-right'>
                        <span class='category'><?= $book->user->name ?>: <?= $book->category->name ?></span>
                    </span>
                </div>
            </a>
        </div>
    </div>
    <?php
}