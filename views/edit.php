<?php

if (is_null($loggedInUser)) {
    header("Location: /login");
    return;
}

$post = current((new Amelia\Blog\Post($pdo))->getById($id));
?>
<!doctype html>
<html>
    <head>
        <title>Edit Post</title>
        <?php require __DIR__ . "/head.php"; ?>
    </head>
    <body>
        <div class="container">

            <h1>Edit Post</h1>

            <form action="" method="post">
                <input type="hidden" name="_token" value="<?= Amelia\Blog\Security\CsrfToken::get() ?>">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <input type="text" class="form-control" name="title" value="<?= e($post["title"]) ?>" placeholder="Title">
                        </h3>
                    </div>
                    <div class="panel-body">
                        Date Posted: <span class="text-muted"><?= e($post["created_at"]) ?></span>
                        <textarea rows="15" class="form-control" name="body" placeholder="Body"><?= e($post["body"]) ?></textarea>
                        <hr>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
