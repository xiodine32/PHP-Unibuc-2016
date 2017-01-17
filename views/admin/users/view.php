<?php
/**
 * @var $request \App\Request
 * @var $engine \App\ViewRenderer
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:45 AM
 */
?>
<fieldset>
    <legend>View users</legend>
    <div class="table-responsive">
        <table class="table table-striped" style="table-layout: auto">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($request->viewbag('users') as $user):
                /**
                 * @var $user \Models\User
                 */
                ?>
                <tr>
                    <td><?= htmlentities($user->id) ?></td>
                    <td><?= htmlentities($user->name) ?></td>
                    <td><?= htmlentities($user->email) ?></td>
                    <td><?= join(", ", $user->roles(false)) ?></td>
                    <td style="width: 120px;">
                        <form action="<?= $engine->route('/admin/users') ?>" method="post">
                            <div class="btn-group">
                                <button class="btn btn-danger btn-sm" name="delete" value="<?= $user->id ?>"
                                        onclick="return confirm('Are you sure?');">
                                    Delete
                                </button>
                                <button class="btn btn-default btn-sm" name="edit" value="<?= $user->id ?>">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</fieldset>
