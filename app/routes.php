<?php

$methods = [];

switch ($route) {
    case "/":
    case "":
        $view = "index.php";
        $methods = ["GET"];
        break;
    case "/login":
        $view = "login.php";
        $methods = ["GET", "POST"];
        break;
    case "/logout":
        $view = "logout.php";
        $methods = ["GET"];
        break;
    case "/admin":
        $view = "admin.php";
        $methods = ["GET", "POST"];
        break;
    case "/admin/create":
        $view = "create.php";
        $methods = ["GET", "POST"];
        break;
    default:
        // preg_match for post routes, etc
        if (preg_match("/\/post\/(\d+)/", $route, $matches)) {
            $id = (int) $matches[1];
            unset($matches);
            $view = "post.php";
            $methods = ["GET"];
        } else if (preg_match("/\/admin\/edit\/(\d+)/", $route, $matches)) {
            $id = (int) $matches[1];
            unset($matches);
            $view = "edit.php";
            $methods = ["GET", "POST"];
        } else if (preg_match("/\/admin\/delete\/(\d+)/", $route, $matches)) {
            $id = (int) $matches[1];
            unset($matches);
            $view = "delete.php";
            $methods = ["GET"];
        }
}

if ($method == "POST" and ! Amelia\Blog\Security\CsrfToken::validate()) {
    $method = "invalid method";
}

if ( ! in_array($method, $methods)) {
    $view = "404.php";
    $method = "GET";
}

if ($method == "GET") {
    $method = "";
} else {
    $method = strtolower($method) . "/";
}
