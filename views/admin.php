<?php

if (is_null($loggedInUser)) {
    header("Location: /login");
    return;
}

$posts = (new Amelia\Blog\Post($pdo))->getAll();
?>

<!doctype html>
<html>
    <head>
        <title>Admin</title>
        <?php require __DIR__ . "/head.php"; ?>
    </head>
    <body>
        <div class="container">
            <hr>

            <div class="text-center" style="max-width: 300px">
                <a class="btn btn-default btn-block" href="/admin/create">New Post</a>
                <a class="btn btn-info btn-block" href="/logout">Log Out</a>
            </div>

            <hr>

            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <?= e($post["title"]) ?> <span class="pull-right"><?= e($post["created_at"]) ?></span>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <?= nl2br(e($post["body"]), false) ?>
                            <hr>
                            <p>
                                <a class="btn btn-warning" href="/admin/edit/<?= $post["id"] ?>">Edit Post</a>
                                <a class="btn btn-danger" href="/admin/delete/<?= $post["id"] ?>">Delete Post</a>
                            </p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </body>
</html>