<?php

if (is_null($loggedInUser)) {
    header("Location: /login");
    return;
}

(new Amelia\Blog\Post($pdo))->delete($id);

header("Location: /admin");
