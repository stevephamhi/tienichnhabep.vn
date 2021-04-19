<?php

class UserModel extends DB
{
    private $table_user = "tbl_users";

    public function checkLogin($username, $password)
    {

        $userItem = $this->selectRow("tbl_users",["user_active","user_disable","user_num_password_ettempts","user_email","user_password"],"`user_username` = '{$username}'");

        if(!empty($userItem)) {
            if($userItem['user_disable'] == "1") {
                return [
                    "status"   => false,
                    "errorTxt" => "Tài khoảng của bạn tạm thời bị khóa, vui lòng liên hệ admin để mở lại tài khoản"
                ];
            } else {
                if($userItem['user_active'] == '0') {
                    return [
                        "status"   => false,
                        "errorTxt" => "Tài khoảng của bạn chưa được kích hoặt, vui lòng truy cập email để kích hoặt"
                    ];
                } else {
                    $userEmail = $userItem['user_email'];
                    $userPassword = $userItem['user_password'];
                    $passwordConfig = md5($userEmail).md5($password);
                    if(password_verify($passwordConfig, $userPassword)) {
                        $this->update("tbl_users", ["user_num_password_ettempts" => 1],"`user_username` = '{$username}'");
                        return [
                            "status" => true
                        ];
                    } else {
                        $userNumPasswordEttempts = $userItem['user_num_password_ettempts'] + 1;
                        if($userItem['user_num_password_ettempts'] >= 3) {
                            $this->update("tbl_users",["user_disable" => "1"], "`user_username` = '{$username}'");
                        }
                        $this->update("tbl_users", ["user_num_password_ettempts" => $userNumPasswordEttempts],"`user_username` = '{$username}'");
                        $numLogin = 3 - (int)$userItem['user_num_password_ettempts'];
                        return [
                            "status"   => false,
                            "errorTxt" => "Mật khẩu không chính xác vui lòng thử lại [còn ". $numLogin ." lần]"
                        ];
                    }
                }
            }
        }
        return [
            "status"   => false,
            "errorTxt" => "Tài khoảng không tồn tại, vui lòng thử lại"
        ];
    }

    public function getUserItemById($user_id) {
        return $this->selectRow("{$this->table_user}", "", "`user_id` = '{$user_id}'");
    }
}