<?php

if (is_null($loggedInUser)) {
    header("Location: /login");
    return;
}

$postFactory = (new Amelia\Blog\Post($pdo));
$postFactory->update($id, $_POST);

header("Location: /admin");
