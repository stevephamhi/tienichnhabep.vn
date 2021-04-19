<?php
class Validation
{
    public static function is_username($username)
    {
        $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
        if(preg_match($partten,$username,$matches)) return true;
        return false;
    }

    public static function is_password($password)
    {
        $partten = "/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z@#$%^&*_!]{6,}$/";
        if(preg_match($partten,$password,$matches)) return true;
        return false;
    }

    public static function is_email($email) {
        $partten = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/";
        if(preg_match($partten,$email,$matches)) return true;
        return false;
    }

    public static function is_phone($phone) {
        $partten = "/((01|02|03|04|05|05|06|07|08|09)+([0-9]{8})\b)/";
        if(preg_match($partten,$phone,$matches)) return true;
        return false;
    }

    public static function formError($field)
    {
        global $error;
        if(!empty($error[$field])) return $error[$field];
        return false;
    }

    public static function setValue($field)
    {
        if(!empty($_POST[$field])) return $_POST[$field];
        return false;
    }

}
?>