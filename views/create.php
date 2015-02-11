<?php

if (is_null($loggedInUser)) {
    header("Location: /login");
    return;
}

?>
<!doctype html>
<html>
    <head>
        <title>New Post</title>
        <?php require __DIR__ . "/head.php"; ?>
    </head>
    <body>
        <div class="container">
            <h1>New Post</h1>

            <form action="" method="post">
                <input type="hidden" name="_token" value="<?= Amelia\Blog\Security\CsrfToken::get() ?>">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </h3>
                    </div>
                    <div class="panel-body">
                        <textarea rows="15" class="form-control" name="body" placeholder="Body"></textarea>
                        <hr>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>