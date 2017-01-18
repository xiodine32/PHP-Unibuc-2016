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
    <legend>View books</legend>
    <div class="table-responsive">
        <table class="table table-striped" style="table-layout: auto">
            <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>User</th>
                <th>Title</th>
                <th>Link</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($request->viewbag('books', []) as $book):
                /**
                 * @var $book \Models\Book
                 */
                ?>
                <tr>
                    <td><?= htmlentities($book->id) ?></td>
                    <td><?= htmlentities($book->category->name) ?></td>
                    <td><?= htmlentities($book->user->name) ?></td>
                    <td><?= htmlentities($book->title) ?></td>
                    <td><a href="<?= htmlentities($book->link) ?>" target="_blank"><?= htmlentities($book->link) ?></a>
                    </td>
                    <td><?= htmlentities($book->created_at) ?></td>
                    <td style="width: 120px;">
                        <form action="<?= $engine->route('/admin/books') ?>" method="post">
                            <div class="btn-group">
                                <button class="btn btn-danger btn-sm" name="delete" value="<?= $book->id ?>"
                                        onclick="return confirm('Are you sure?');">
                                    Delete
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
