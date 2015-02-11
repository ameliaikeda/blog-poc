<?php

$userFactory = new \Amelia\Blog\User($pdo);

// if these are missing, someone didn't actually post using our form anyway.
// (Normally I'd use a form validation class, etc)
if ($user = $userFactory->login($_POST["username"], $_POST["password"])) {
    $_SESSION["id"] = (int) $user["id"]; // we're assumed to have a session already because of CSRF
} else {
    header("Location: /login?error=1");
}

// Welcome aboard
header("Location: /admin");
return;
