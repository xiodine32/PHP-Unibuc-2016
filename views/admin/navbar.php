<?php
/**
 * @var $request \App\Request
 * @var $engine \App\ViewRenderer
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 6:41 PM
 */
if (empty($engine)) die("no engine");
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= $engine->route('/admin/') ?>">bibl.io</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?= $engine->is('/admin/') ? 'active' : '' ?>"><a href="<?= $engine->route('/admin/') ?>"><i
                                class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                <?php foreach ($request->viewbag('titles') as $category): ?>
                    <li><a href="<?= $engine->route("/admin/?category={$category->id}") ?>"><?= $category->name ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?= $engine->route("/admin/contact") ?>">
                        <i class="fa fa-envelope" aria-hidden="true"></i> Contact Us
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-user"></i>
                        <?= htmlentities($request->session("user")->name) ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($request->session('user')->hasRole(\Models\User::ADMINISTRATOR)): ?>
                            <li>
                                <a href="<?= $engine->route('/admin/users') ?>"><i class="fa fa-users"></i> Edit
                                    Users</a>
                            </li>
                        <?php endif ?>
                        <?php if ($request->session('user')->hasRole(\Models\User::EDITOR)): ?>
                            <li>
                                <a href="<?= $engine->route('/admin/categories') ?>"><i class="fa fa-list"></i> Edit
                                    Categories</a>
                            </li>
                            <li>
                                <a href="<?= $engine->route('/admin/books') ?>"><i class="fa fa-book"></i> Edit
                                    Books</a>
                            </li>
                        <?php endif ?>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="<?= $engine->route('/logout') ?>">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="jumbotron landing">
    <a href="/" style="color: inherit; text-decoration: none;">
    <div class="text-center">
        <h1>bibl.io</h1>
        <h2>for all your reading needs</h2>
    </div>
    </a>
</div>