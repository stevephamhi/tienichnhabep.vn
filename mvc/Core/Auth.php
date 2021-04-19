<?php

class Auth {

    public function __construct()
    {
        $this->setRequest();
        $this->setLogin();
        $this->confirmLogin();
    }

    public function setRequest() {
        $action = !empty($_GET['action']) ? $_GET['action'] : 'index';
        $requestInfo = [
            "profile"  => Config::getBaseUrlClient("thong-tin-ca-nhan.html"),
            "history"  => Config::getBaseUrlClient("lich-su-mua-hang.html"),
            "payment"  => Config::getBaseUrlClient("phuong-thuc-thanh-toan.html"),
            "shipping" => Config::getBaseUrlClient("dia-chi-thanh-toan.html")
        ];
        if( !empty($requestInfo[$action]) ) {
            Session::set("actionRequest", $requestInfo[$action]);
        }
    }

    public function confirmLogin() {
        $action = !empty($_GET['action']) ? $_GET['action'] : 'index';
        $actionIllegal = ["profile", "history", "address_store", "shipping"];
        if( Cookie::check("isLgTP_set") ) {
            Session::set('isLgTP_set', Cookie::get("isLgTP_set"));
        } else {
            if( !Session::check("isLgTP_set") && in_array( $action, $actionIllegal ) ) {
                Helper::redirect(Config::getBaseUrlClient("dang-nhap.html"));
            }
        }
    }

    public function setLogin() {
        if( Cookie::check("isLgTP_set") ) {
            Session::set("isLgTP_set", Cookie::get("isLgTP_set"));
        }
    }

    public static function isLogin() {
        if( Session::check("isLgTP_set") ) {
            $customer = new Customer;
            $customerItem = $customer->getInfoCustomer("customer_fullname", Session::get("isLgTP_set"));
            if( !empty( $customerItem ) ) {
                return true;
            }
        }
        return false;
    }
}
