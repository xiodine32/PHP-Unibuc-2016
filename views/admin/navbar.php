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
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-user"></i>
                        <?= $request->session("user")->name ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($request->session('user')->hasRole(\Models\User::ADMINISTRATOR)): ?>
                            <li>
                                <a href="<?= $engine->route('/admin/users') ?>"><i class="fa fa-users"></i> Edit
                                    Users</a>
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
            <form class="navbar-form navbar-right" method="post" action="<?= $engine->route('/search') ?>">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"
                                                                             aria-hidden="true"></i></button>
                        </span>
                    </div>
                </div>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="jumbotron" style="margin-top: -20px;">
    <div class="text-center">
        <h1>bibl.io</h1>
        <h2>For all your reading needs</h2>
    </div>
</div>