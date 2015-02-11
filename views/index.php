<?php
    $posts = (new Amelia\Blog\Post($pdo))->getLatest();
?>
<!doctype html>
<html>
    <head>
        <title>Blog Posts</title>
        <?php include __DIR__ . "/head.php"; ?>
    </head>

    <body>
        <div class="container">
            <h1>Blog Posts</h1>

            <?php foreach ($posts as $post): ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?= e($post["title"]) ?> <span class="pull-right"><?= e($post["created_at"]) ?></span>
                    </h3>
                </div>
                <div class="panel-body">
                    <?= e(mb_substr($post["body"], 0, 100)) ?>
                    <hr>
                    <p><a class="btn btn-default" href="/post/<?= $post["id"] ?>">View Full Post</a></p>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </body>
</html>
