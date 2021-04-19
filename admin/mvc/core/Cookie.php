<?php
class Cookie {
    public static function set($key, $val, $time) {
        setcookie($key,$val,time()+$time,'/');
    }

    public static function get($key)
    {
        if(isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        } else {
            return false;
        }
    }

    public static function check($key)
    {
        if(isset($_COOKIE[$key])) return true;
        return false;
    }

    public static function delete($key, $val, $time)
    {
        setcookie($key,$val,time()-$time,'/');
    }
}
?>