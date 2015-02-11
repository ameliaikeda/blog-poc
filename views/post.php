<?php

// bail out early
if ( ! isset($id)) {
    require __DIR__ . "/404.php";
    return;
}

$post = current((new \Amelia\Blog\Post($pdo))->getById($id));

if (empty($post)) {
    require __DIR__ . "/404.php";
    return;
}

?>
<!doctype html>
<html>
    <head>
        <title><?= e($post["title"]) ?></title>
        <?php require __DIR__ . "/head.php" ?>
    </head>

    <body>
        <div class="container">
            <h1>View Post</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?= e($post["title"]) ?> <span class="pull-right"><?= e($post["created_at"]) ?></span>
                    </h3>
                </div>
                <div class="panel-body">
                    <?= nl2br(e($post["body"]), false); ?>
                </div>
            </div>
            <a class="btn btn-default" href="/">View latest posts</a>
        </div>
    </body>
</html>
