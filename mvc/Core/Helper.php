<?php

class Helper extends Database {

    const TABLE_CUSTOMER = 'tbl_customer';

    public static function redirect($url)
    {
        if( !empty($url) )
            header("Location: {$url}");
        else return false;
    }

    public static function getUrl() {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

}