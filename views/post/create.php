<?php

if (is_null($loggedInUser)) {
    header("Location: /login");
    return;
}

$postFactory = (new Amelia\Blog\Post($pdo));
$postFactory->insert($_POST); // we don't have a mass-assignment vuln
                              // because we choose the attributes to use

header("Location: /admin");
