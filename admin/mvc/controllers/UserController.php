<?php

class UserController extends Controller
{
    public $userModel;
    function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function Login()
    {
        $validation = new Validation;
        $format  = new Format;
        $helper  = new Helper;
        if(isset($_POST['loginAddminAction'])) {
            $error = [];
            global $error;
            /*
            * --- check username
            */
            if(empty($_POST['username'])) {
                $error['username'] = "<span class='error'>Không được để trống</span>";
            } else {
                if(!($validation->is_username($_POST['username']))) {
                    $error['username'] = "<span class='error'>Tên đăng nhập không hợp lệ</span>";
                } else {
                    $username = $format->validation($_POST['username']);
                }
            }
            /*
            * --- check passWord
            */
            if(empty($_POST['password'])) {
                $error['password'] = "<span class='error'>Không được để trống</span>";
            } else {
                if(!($validation->is_password($_POST['password']))) {
                    $error['password'] = "<span class='error'>Mật khẩu không hợp lệ</span>";
                } else {
                    $password = $format->validation($_POST['password']);
                }
            }
            /*
            * --- check error
            */
            if(empty($error)) {
                $processLogin = $this->userModel->checkLogin($username, $password);
                if($processLogin['status']) {
                    Session::set("isLogin", $username);
                    $helper->redirect("Home");
                } else {
                    $error['statusLogin'] = $processLogin['errorTxt'];
                }
            }
        }
        $dataView = [
            "layOut" => "Login",
        ];
        $this->view('MasterUser', $dataView);
    }


    public function Logout()
    {
        $helper  = new Helper;
        Session::_unset("isLogin");
        $helper->redirect("User/Login");
    }
}