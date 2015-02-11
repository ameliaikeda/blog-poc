<!doctype html>
<html>
    <head>
        <title>Log In</title>
        <?php require __DIR__ . "/head.php"; ?>
    </head>
    <body>
        <div class="container">
            <h1>Sign In</h1>
            <form action="" method="post">
                <input type="hidden" name="_token" value="<?= Amelia\Blog\Security\CsrfToken::get() ?>">
                <input class="form-control" type="text" placeholder="Username" name="username">
                <input class="form-control" type="password" placeholder="Password" name="password">

                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
        </div>
    </body>
</html>
