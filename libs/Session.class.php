<?php

class Session
{
    public static $user = null;

    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            @ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 30);
            @session_set_cookie_params(60 * 60 * 24 * 30);
            @session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function destroy() {
        session_destroy();
    }
    
    public static function regenerate()
    {
        session_regenerate_id(true);
    }

    public static function isset($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function getUser()
    {
        return Session::get('login_user', 'Guest');
    }

    public static function getAccountUser()
    {
        return Session::get('accountUser', 'Guest');
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['login_user']);
    }
}

?>