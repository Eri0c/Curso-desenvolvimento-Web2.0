<?php

namespace DankiCode;

class Bcrypt {
    /**
     * Hash a string using bcrypt
     *
     * @param string $string The string to hash
     * @param int $cost The cost parameter
     * @return string The hashed string
     */
    public static function hash($string, $cost = 12) {
        return password_hash($string, PASSWORD_BCRYPT, ['cost' => $cost]);
    }

    /**
     * Check a hashed string against the given hash
     *
     * @param string $string The string to check
     * @param string $hash The hash to check against
     * @return boolean True if the string matches the hash, false otherwise
     */
    public static function check($string, $hash) {
        return password_verify($string, $hash);
    }
}

