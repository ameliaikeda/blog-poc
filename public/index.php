<?php

session_start();

// composer, can't live without it.
require __DIR__ . "/../vendor/autoload.php";

// global objects because we dont have an IoC container or anything
$pdo = new PDO("mysql:host=localhost;dbname=nigelfrank;charset=utf8", "root", "", []);
$route = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];
$loggedInUser = null;

if (array_key_exists("id", $_SESSION)) {
    $loggedInUser = (new Amelia\Blog\User($pdo))->getById($_SESSION["id"]);
}

Amelia\Blog\Security\CsrfToken::generate();

require __DIR__ . "/../app/routes.php";
require __DIR__ . "/../views/" . $method . $view;
