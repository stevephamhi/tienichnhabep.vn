<?php
/*
 * --------------------------------------------------------------------
 * SESSION
 * --------------------------------------------------------------------
 */
class Session {
    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }


    public static function check($key)
    {
        if(!empty($_SESSION[$key])) return true;
        return false;
    }

    public static function _unset($key)
    {
        unset($_SESSION[$key]);
    }
}
?>