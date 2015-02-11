<?php namespace Amelia\Blog\Security;

class CsrfToken {

    protected static $token;

    /**
     * Generates a CSRF token on every session creation.
     *
     * Normally there'd be some kind of session management
     * in an application, but in this case I'll just cram it in.
     *
     * Also this should use abstraction and SOLID.
     */
    public static function generate() {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();

        if (array_key_exists("_token", $_SESSION)) {
            static::$token = $_SESSION["_token"];
            return;
        }

        $token = base64_encode(mcrypt_create_iv(48, MCRYPT_DEV_URANDOM));
        static::$token = $token;
        $_SESSION["_token"] = $token;
    }

    public static function get() {
        if (is_null(static::$token))
            static::generate();

        return static::$token;
    }

    public static function validate() {
        if (session_status() == PHP_SESSION_ACTIVE)
            return $_POST["_token"] === $_SESSION["_token"];

        return false;
    }
}