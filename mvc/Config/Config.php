<?php
class Config
{
    protected $controllerConfig = "home";
    protected $actionConfig     = "index";

    // public static $base_url_admin  = "http://localhost/tienichnhabep.vn/admin/";
    // public static $base_url_client = "http://localhost/tienichnhabep.vn/";

    public static $base_url_client = "https://tienichnhabep.vn/";
    public static $base_url_admin  = "https://tienichnhabep.vn/admin/";

    public static function getBaseUrlAdmin($url = null)
    {
        return self::$base_url_admin . $url;
    }

    public static function getBaseUrlClient($url = null)
    {
        return self::$base_url_client . $url;
    }

    protected function fileAutoLoadClass()
    {
        return [
            "Database",
            "BaseController",
            "Format",
            "Pagination",
            "Session",
            "Cookie",
            "Mail",
            "Validation",
            "Helper",
            "Customer",
            "Auth",
        ];
    }

    protected function fileAutoLoadFunc()
    {
        return [
            "BaseView"
        ];
    }

    protected function fileAutoLoadModel()
    {
        return [
            "CateProductModel",
            "AboutusModel",
        ];
    }

    protected function fileAutoLoadController()
    {
        return [
            "BannerController",
            "FlashsaleController",
            "VideoController",
            "ConfigController"
        ];
    }
}