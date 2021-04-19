<?php

class ModuleController extends Controller
{
    private $ModuleModel;
    private $UserModel;

    public function __construct()
    {
        $this->ModuleModel = $this->model("Module");
        $this->UserModel   = $this->model("User");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listModule = $this->ModuleModel->searchModuleByName($strSearch);;
        } else {
            $orderByAllow = ["asc","desc"];
            $statusAllow  = ["all","on","off"];
            $orderBy      = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status       = in_array($status,$statusAllow)   ? $status  : "all";
            $page         = $page >= 1 ? $page : 1;
            $numPerPage   = 10;
            $totalModule  = count($this->ModuleModel->getListModuleByStatus($status));
            $totalPage    = ceil($totalModule/$numPerPage);
            $pageStart    = (int) ($page-1) * $numPerPage;
            $listModule   = $this->ModuleModel->getListModuleByPagination($orderBy, "module_order", $status, $pageStart, $numPerPage);
        }

        if(!empty($listModule)) {
            foreach( $listModule as &$moduleItem ) {
                $userItem = $this->UserModel->getUserItemById($moduleItem['module_creatorId']);
                $userInfo = [
                    "user_id"   => $userItem['user_id'],
                    "user_name" => $userItem['user_fullname'],
                ];
                $moduleItem['user_create'] = $userInfo;
            }
        }

        $dataView = [
            "title"  => "Danh sách module",
            "layOut" => "ListModule",
            "css"    => ["home"],
            "data"   => [
                "orderBy"     => !empty($orderBy)     ? $orderBy     : null,
                "status"      => !empty($status)      ? $status      : null,
                "page"        => !empty($page)        ? $page        : null,
                "totalPage"   => !empty($totalPage)   ? $totalPage   : null,
                "numPerPage"  => !empty($numPerPage)  ? $numPerPage  : null,
                "listModule"  => !empty($listModule)  ? $listModule  : null,
                "strSearch"   => !empty($strSearch)   ? $strSearch   : null,
                "totalModule" => !empty($totalModule) ? $totalModule : count($listModule),
            ]
        ];

        $this->view("MasterIndex", $dataView);

    }

    public function add()
    {

        $helper = new Helper;

        if(isset($_POST['addModule_action'])) {
            $error = [];
            global $error;

            /*
            * --- check module status
            */

            $_POST['module_status'] = !empty($_POST['module_status']) ? "on" : "off";
            $module_status = $_POST['module_status'];

            /*
            * --- check module name
            */

            if(empty($_POST['module_name'])) {
                $error['module_name'] = "<span class='error'>(*) Vui lòng nhập tên module</span>";
            } else {
                $module_name = $_POST['module_name'];
            }

            /*
            * --- check module bg title
            */

            if(empty($_POST['module_bg_title'])) {
                $error['module_bg_title'] = "<span class='error'>(*) Vui lòng nhập chọn màu nền cho tab control</span>";
            } else {
                $module_bg_title = $_POST['module_bg_title'];
            }

            /*
            * --- check module bg body
            */

            if(empty($_POST['module_bg_body'])) {
                $error['module_bg_body'] = "<span class='error'>(*) Vui lòng chọn màu nền cho body</span>";
            } else {
                $module_bg_body = $_POST['module_bg_body'];
            }

            /*
            * --- check module meta title
            */

            if(empty($_POST['module_metaTitle'])) {
                $error['module_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title</span>";
            } else {
                $module_metaTitle = $_POST['module_metaTitle'];
            }

            /*
            * --- check module meta desc
            */

            if(empty($_POST['module_metaDesc'])) {
                $error['module_metaDesc'] = "<span class='error'>(*) Vui lòng nhập meta desc</span>";
            } else {
                $module_metaDesc = $_POST['module_metaDesc'];
            }

            /*
            * --- check module meta keyrowd
            */

            if(empty($_POST['module_keyword'])) {
                $error['module_keyword'] = "<span class='error'>(*) Vui lòng nhập từ khóa về module</span>";
            } else {
                $module_keyword = $_POST['module_keyword'];
            }

            /*
            * --- check module seo url
            */

            if(empty($_POST['module_seoUrl'])) {
                $error['module_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo</span>";
            } else {
                $module_seoUrl = $_POST['module_seoUrl'];
            }

            /*
            * --- check module banner pc
            */

            if(empty($_POST['module_bannerPc'])) {
                $error['module_bannerPc'] = "<span class='error'>(*) Vui lòng chọn banner pc cho module</span>";
            } else {
                $module_bannerPc = $_POST['module_bannerPc'];
            }

            /*
            * --- check module banner mb
            */

            if(empty($_POST['module_bannerMb'])) {
                $error['module_bannerMb'] = "<span class='error'>(*) Vui lòng chọn banner mb cho module</span>";
            } else {
                $module_bannerMb = $_POST['module_bannerMb'];
            }

            /*
            * --- check module order
            */

            $module_order = !empty($_POST['module_order']) ? (int)$_POST['module_order'] : 0;
            $_POST['module_order'] = $module_order;

            /*
            * --- check module error
            */

            if( empty($error) ) {
                if( !($this->ModuleModel->checkModuleExists($module_name)) ) {
                    $module_createDate = time();
                    $module_creatorId  = (int) $helper->infoUser("user_id");
                    $dataModule = [
                        "module_name"       => $module_name,
                        "module_bg_title"   => $module_bg_title,
                        "module_bg_body"    => $module_bg_body,
                        "module_metaTitle"  => $module_metaTitle,
                        "module_metaDesc"   => $module_metaDesc,
                        "module_keyword"    => $module_keyword,
                        "module_seoUrl"     => $module_seoUrl,
                        "module_bannerPc"   => $module_bannerPc,
                        "module_bannerMb"   => $module_bannerMb,
                        "module_order"      => $module_order,
                        "module_createDate" => $module_createDate,
                        "module_creatorId"  => $module_creatorId,
                        "module_status"     => $module_status
                    ];
                    $module_id = $this->ModuleModel->addModuleNew($dataModule);
                    if(is_int($module_id)) {
                        $statusActionModule = [
                            "status" => "success",
                            "notifiTxt" => "Thêm module thành công"
                        ];
                    } else {
                        $statusActionModule = [
                            "status" => "error",
                            "notifiTxt" => "Thêm module không thành công"
                        ];
                    }
                } else {
                    $statusActionModule = [
                        "status"    => "error",
                        "notifiTxt" => "Module này đã tồn tại [ Trùng tên module ]"
                    ];
                }
            } else {
                $statusActionModule = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Thêm module",
            "layOut" => "AddModule",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionModule" => !empty($statusActionModule) ? $statusActionModule : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($module_id = 0)
    {
        $module_id  = (!empty($module_id)) ? (int)$module_id : 0;
        $moduleItem = $this->ModuleModel->getModuleItemById($module_id);

        /*
        * --------------------------------
        * ----- Handle update module -----
        * --------------------------------
        */
        if(isset($_POST['updateModule_action'])) {
            $error = [];
            global $error;

            /*
            * --- check module status
            */

            $_POST['module_status'] = !empty($_POST['module_status']) ? "on" : "off";
            $module_status = $_POST['module_status'];

            /*
            * --- check module name
            */

            if(empty($_POST['module_name'])) {
                $error['module_name'] = "<span class='error'>(*) Vui lòng nhập tên module</span>";
            } else {
                $module_name = $_POST['module_name'];
            }

            /*
            * --- check module bg title
            */

            if(empty($_POST['module_bg_title'])) {
                $error['module_bg_title'] = "<span class='error'>(*) Vui lòng nhập chọn màu nền cho tab control</span>";
            } else {
                $module_bg_title = $_POST['module_bg_title'];
            }

            /*
            * --- check module bg body
            */

            if(empty($_POST['module_bg_body'])) {
                $error['module_bg_body'] = "<span class='error'>(*) Vui lòng chọn màu nền cho body</span>";
            } else {
                $module_bg_body = $_POST['module_bg_body'];
            }

            /*
            * --- check module meta title
            */

            if(empty($_POST['module_metaTitle'])) {
                $error['module_metaTitle'] = "<span class='error'>(*) Vui lòng nhập meta title</span>";
            } else {
                $module_metaTitle = $_POST['module_metaTitle'];
            }

            /*
            * --- check module meta desc
            */

            if(empty($_POST['module_metaDesc'])) {
                $error['module_metaDesc'] = "<span class='error'>(*) Vui lòng nhập meta desc</span>";
            } else {
                $module_metaDesc = $_POST['module_metaDesc'];
            }

            /*
            * --- check module meta keyrowd
            */

            if(empty($_POST['module_keyword'])) {
                $error['module_keyword'] = "<span class='error'>(*) Vui lòng nhập từ khóa về module</span>";
            } else {
                $module_keyword = $_POST['module_keyword'];
            }

            /*
            * --- check module seo url
            */

            if(empty($_POST['module_seoUrl'])) {
                $error['module_seoUrl'] = "<span class='error'>(*) Vui lòng nhập đường dẫn seo</span>";
            } else {
                $module_seoUrl = $_POST['module_seoUrl'];
            }

            /*
            * --- check module banner pc
            */

            if(empty($_POST['module_bannerPc'])) {
                $error['module_bannerPc'] = "<span class='error'>(*) Vui lòng chọn banner pc cho module</span>";
            } else {
                $module_bannerPc = $_POST['module_bannerPc'];
            }

            /*
            * --- check module banner mb
            */

            if(empty($_POST['module_bannerMb'])) {
                $error['module_bannerMb'] = "<span class='error'>(*) Vui lòng chọn banner mb cho module</span>";
            } else {
                $module_bannerMb = $_POST['module_bannerMb'];
            }

            /*
            * --- check module order
            */

            $module_order = !empty($_POST['module_order']) ? (int)$_POST['module_order'] : 0;
            $_POST['module_order'] = $module_order;

            /*
            * --- check module error
            */

            if( empty($error) ) {
                $dataModule = [
                    "module_name"       => $module_name,
                    "module_bg_title"   => $module_bg_title,
                    "module_bg_body"    => $module_bg_body,
                    "module_metaTitle"  => $module_metaTitle,
                    "module_metaDesc"   => $module_metaDesc,
                    "module_keyword"    => $module_keyword,
                    "module_seoUrl"     => $module_seoUrl,
                    "module_bannerPc"   => $module_bannerPc,
                    "module_bannerMb"   => $module_bannerMb,
                    "module_order"      => $module_order,
                    "module_updateDate" => time(),
                    "module_status"     => $module_status
                ];
                $process = $this->ModuleModel->updateModule( $dataModule, $module_id );
                if($process) {
                    $statusActionModule = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật module thành công"
                    ];
                } else {
                    $statusActionModule = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật module không thành công"
                    ];
                }
            } else {
                $statusActionModule = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật module",
            "layOut" => "UpdateModule",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "moduleItem"         => !empty($moduleItem)         ? $moduleItem         : null,
                "statusActionModule" => !empty($statusActionModule) ? $statusActionModule : []
            ]
        ];

        $this->view("MasterIndex", $dataView);

    }

    public function handleGetOrderMax()
    {
        $dataAjax = [
            "orderMax" => $this->ModuleModel->getOrderMax()
        ];
        echo json_encode($dataAjax['orderMax']);
    }

    public function changeStatus()
    {
        $module_id     = (int)$_POST['module_id'];
        $module_status = $_POST['statusChange'];
        $dataModule    = [
            "module_status" => $module_status
        ];
        $process = $this->ModuleModel->updateModule($dataModule, $module_id);
        if($process) {
            $dataAjax = [
                "status" => "success",
            ];
        } else {
            $dataAjax = [
                "status" => "error"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function deleteItem()
    {
        $module_id = $_POST['module_id'];
        $process  = $this->ModuleModel->deleteModule($module_id);
        if($process) {
            $dataAjax = [
                "status" => "success"
            ];
        } else {
            $dataAjax = [
                "status" => "error"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function multiDelete()
    {
        $listModuleId        = $_POST['listModuleId'];
        $ModuleIdDeleteError = [];
        foreach($listModuleId as $ModuleIdItem) {
            $module_id = (int) $ModuleIdItem;
            $process = $this->ModuleModel->deleteModule($module_id);
            if(!$process) {
                $ModuleIdDeleteError[] = $ModuleIdItem;
            }
        }
        if(!empty($ModuleIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $ModuleIdDeleteError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function multiChangeStatus()
    {
        $listModuleId        = $_POST['listModuleId'];
        $statusChange       = $_POST['statusChange'];
        $ModuleIdUpdateError = [];
        foreach($listModuleId as $ModuleIdItem) {
            $idModule = (int) $ModuleIdItem;
            $dataModule = [
                "module_status" => $statusChange
            ];
            $process = $this->ModuleModel->updateModule($dataModule, $idModule);
            if(!$process) {
                $ModuleIdUpdateError[] = $ModuleIdItem;
            }
        }
        if(!empty($ModuleIdUpdateError)) {
            $dataAjax = [
                "status"              => "error",
                "ModuleIdUpdateError" => $ModuleIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function getListTotalModule()
    {
        $dataAjax = [
            "dataRecomment" => $this->ModuleModel->getListModuleByStatus("all")
        ];
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $vlSearch = $_POST['vlSearch'];
        $result   = $this->ModuleModel->searchModuleByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function updateUrlFlashsale()
    {
        $module_id  = (int) $_POST['module_id'];
        $listModule = $this->ModuleModel->getListModuleByStatus("all");
        foreach($listModule as $moduleItem) {
            $dataModule = [
                "module_is_flashsale" => "2"
            ];
            $this->ModuleModel->updateModule($dataModule, $moduleItem['module_id']);
        }
        $dataModule_update = [
            "module_is_flashsale" => "1"
        ];
        $process = $this->ModuleModel->updateModule($dataModule_update, $module_id);
        if($process) {
            $dataAjax = [
                "status" => "success"
            ];
        } else {
            $dataAjax = [
                "status" => "error"
            ];
        }
        echo json_encode($dataAjax);
    }
}