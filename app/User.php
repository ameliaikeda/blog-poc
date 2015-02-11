<?php namespace Amelia\Blog;

class User extends Model {
    protected $table = "users";

    /**
     * Test a login.
     *
     * @param string $username
     * @param string $password
     * @return array|bool
     */
    public function login($username, $password) {
        $user = current($this->getByAttribute("username", $username));

        if ($user) {
            // caveat: use a time-insensitive function to compare 2 strings
            if (password_verify($password, $user["password"])) {
                return $user;
            }
        }

        return false;
    }

    /**
     * Hash a password
     *
     * @param string $text
     * @return bool|string
     */
    public function hash($text) {
        return password_hash($text, PASSWORD_DEFAULT);
    }
}
