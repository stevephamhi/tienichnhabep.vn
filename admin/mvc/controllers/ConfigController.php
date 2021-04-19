<?php

class ConfigController extends Controller
{
    private $ConfigModel;

    public function __construct()
    {
        $this->ConfigModel = $this->model("Config");
    }

    public function index()
    {

        $configInfo = $this->ConfigModel->getConfigInfo()[0];

        if(isset($_POST['saveConfig_action'])) {
            $error = [];
            global $error;

            /*
            * ------ check config logo
            */

            if(empty($_POST['config_logo'])) {
                $error['config_logo'] = "<span>(*) Vui lòng chọn logo</span>";
            } else {
                $config_logo = $_POST['config_logo'];
            }

            /*
            * ------ check config icon
            */

            if(empty($_POST['config_icon'])) {
                $error['config_icon'] = "<span>(*) Vui lòng chọn icon</span>";
            } else {
                $config_icon = $_POST['config_icon'];
            }

            /*
            * ------ check config name company
            */

            if(empty($_POST['config_name_company'])) {
                $error['config_name_company'] = "<span>(*) Vui lòng nhập tên</span>";
            } else {
                $config_name_company = $_POST['config_name_company'];
            }

            /*
            * ------ check config address company
            */

            if(empty($_POST['config_address_company'])) {
                $error['config_address_company'] = "<span>(*) Vui lòng nhập địa chỉ</span>";
            } else {
                $config_address_company = $_POST['config_address_company'];
            }

            /*
            * ------ check config tax code
            */

            if(empty($_POST['config_taxcode'])) {
                $error['config_taxcode'] = "<span class='error'>(*) Vui lòng nhập mã số thuế</span>";
            } else {
                $config_taxcode = $_POST['config_taxcode'];
            }

            /*
            * ------ check config image
            */

            if(empty($_POST['config_image'])) {
                $error['config_image'] = "<span>(*) Vui lòng chọn ảnh</span>";
            } else {
                $config_image = $_POST['config_image'];
            }

            /*
            * ------ check config meta title
            */

            if(empty($_POST['config_metaTitle'])) {
                $error['config_metaTitle'] = "<span>(*) Vui lòng nhập thẻ tiêu đề</span>";
            } else {
                $config_metaTitle = $_POST['config_metaTitle'];
            }

            /*
            * ------ check config meta desc
            */

            if(empty($_POST['config_metaDesc'])) {
                $error['config_metaDesc'] = "<span>(*) Vui lòng nhập thẻ mô tả</span>";
            } else {
                $config_metaDesc = $_POST['config_metaDesc'];
            }

            /*
            * ------ check config meta keyword
            */

            if(empty($_POST['config_metaKeyword'])) {
                $error['config_metaKeyword'] = "<span>(*) Vui lòng nhập từ khóa</span>";
            } else {
                $config_metaKeyword = $_POST['config_metaKeyword'];
            }

            /*
            * ------ check config hotline
            */

            if(empty($_POST['config_hotline'])) {
                $error['config_hotline'] = "<span>(*) Vui lòng nhập số hotline</span>";
            } else {
                $config_hotline = $_POST['config_hotline'];
            }

            /*
            * ------ check config placeholder search
            */

            if(empty($_POST['config_placeholder_search'])) {
                $error['config_placeholder_search'] = "<span>(*) Vui lòng chọn title search</span>";
            } else {
                $config_placeholder_search = $_POST['config_placeholder_search'];
            }

            if(empty($error)) {
                $dataConfig = [
                    "config_logo"               => $config_logo,
                    "config_icon"               => $config_icon,
                    "config_name_company"       => $config_name_company,
                    "config_address_company"    => $config_address_company,
                    "config_taxcode"            => $config_taxcode,
                    "config_metaTitle"          => $config_metaTitle,
                    "config_metaDesc"           => $config_metaDesc,
                    "config_metaKeyword"        => $config_metaKeyword,
                    "config_hotline"            => $config_hotline,
                    "config_image"              => $config_image,
                    "config_placeholder_search" => $config_placeholder_search
                ];

                $process = $this->ConfigModel->updateConfig($dataConfig, $configInfo['config_id']);
                if($process) {
                    $statusActionConfig = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật thông tin thành công"
                    ];
                } else {
                    $statusActionConfig = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật thông tin không thành công"
                    ];
                }
            } else {
                $statusActionConfig = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Thiết lập",
            "layOut" => "ConfigInfo",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "configInfo"         => !empty($configInfo) ? $configInfo : null,
                "statusActionConfig" => !empty($statusActionConfig) ? $statusActionConfig : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }
}