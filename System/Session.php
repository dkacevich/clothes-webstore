<?php 

namespace System;

class Session {
    public static function set(string $key, mixed $value, string $subArray = null) {
        $subArray ? $_SESSION[$subArray][$key] = $value : $_SESSION[$key] = $value;
    }
    public static function get(string $key = null, string $subArray = null) : mixed {
        if (!$key) {
            return $_SESSION;
        }
        return ($subArray ? $_SESSION[$subArray][$key] : $_SESSION[$key]) ?? null ;
    }
    public static function remove(string $key, string $subArray = null) {
        unset($_SESSION[$key]);
    }
}