<?php
class Auth
{
    public function checkReQuest($action)
    {
        $helper = new Helper;
        $actionAllow = ["Login","error404"];
        if(!Session::check("isLogin") && !in_array($action, $actionAllow)) {
            $helper->redirect("User/Login");
        }
    }
}