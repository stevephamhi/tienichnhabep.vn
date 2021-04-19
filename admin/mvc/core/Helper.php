<?php
class Helper extends DB
{
    public function redirect($url)
    {
        $base = new Base;
        if(!empty($url)) header("Location: ".$base->getBaseURLAdmin()."{$url}");
        else return false;
    }

    public function infoUser($field = "user_fullname") {
        if(Session::check("isLogin")) {
            $userItem = $this->select("tbl_users",'',"`user_username` = '".Session::get("isLogin")."'")[0];
            if(array_key_exists($field, $userItem)) {
                return $userItem[$field];
            }
        }
    }

}
?>