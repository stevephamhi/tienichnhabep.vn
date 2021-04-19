<?php

class ModuleitemController extends Controller
{
    private $ModuleitemModel;
    private $CateProductModel;
    private $ModuleModel;
    private $ProductModel;

    public function __construct()
    {
        $this->ModuleitemModel  = $this->model("Moduleitem");
        $this->CateProductModel = $this->model("CateProduct");
        $this->ModuleModel      = $this->model("Module");
        $this->ProductModel     = $this->model("Product");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listModuleitem = $this->ModuleitemModel->recommentSearchByFiled("", $strSearch);
        } else {
            $orderByAllow    = ["asc","desc"];
            $statusAllow     = ["all","on","off"];
            $orderBy         = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status          = in_array($status,$statusAllow)   ? $status  : "all";
            $page            = $page >= 1 ? $page : 1;
            $numPerPage      = 10;
            $totalModuleitem = count($this->ModuleitemModel->getListTotalModuleitemByStatus($status));
            $totalPage       = ceil($totalModuleitem/$numPerPage);
            $pageStart       = (int) ($page - 1) * $numPerPage;
            $listModuleitem  = $this->ModuleitemModel->getListModuleitemByPagination($orderBy,"moduleitem_order", $status, $pageStart, $numPerPage);
        }
        $dataView = [
            "title"  => "Danh sách module item",
            "layOut" => "ListModuleitem",
            "css"    => ["home"],
            "data"   => [
                "orderBy"         => !empty($orderBy)         ? $orderBy         : null,
                "status"          => !empty($status)          ? $status          : null,
                "page"            => !empty($page)            ? $page            : null,
                "totalPage"       => !empty($totalPage)       ? $totalPage       : null,
                "numPerPage"      => !empty($numPerPage)      ? $numPerPage      : null,
                "listModuleitem"  => !empty($listModuleitem)  ? $listModuleitem  : null,
                "strSearch"       => !empty($strSearch)       ? $strSearch       : null,
                "totalModuleitem" => !empty($totalModuleitem) ? $totalModuleitem : count($listModuleitem),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {

        $helper = new Helper;

        if(isset($_POST['addModuleitem_action'])) {
            $error = [];
            global $error;

            /*
            * --- check module item status
            */

            $_POST['moduleitem_status'] = !empty($_POST['moduleitem_status']) ? "on" : "off";
            $moduleitem_status = $_POST['moduleitem_status'];

            /*
            * --- check module item name tap
            */

            if(empty($_POST['moduleitem_nametap'])) {
                $error['moduleitem_nametap'] = "<span class='error'>(*) Vui lòng chọn tên tab</span>";
            } else {
                $moduleitem_nametap = $_POST['moduleitem_nametap'];
            }

            /*
            * --- check module item title txt
            */

            if(empty($_POST['moduleitem_title_txt'])) {
                $error['moduleitem_title_txt'] = "<span class='error'>(*) Vui lòng nhập tên cho module item</span>";
            } else {
                $moduleitem_title_txt = $_POST['moduleitem_title_txt'];
            }

            /*
            * --- check module item title img
            */

            $_POST['moduleitem_title_img'] = !empty($_POST['moduleitem_title_img']) ? $_POST['moduleitem_title_img'] : null;
            $moduleitem_title_img = $_POST['moduleitem_title_img'];

            /*
            * --- check module bg
            */

            $moduleitem_bg_body = $_POST['moduleitem_bg_body'];

            /*
            * --- check module order
            */

            $_POST['moduleitem_order'] = !empty($_POST['moduleitem_order']) ? (int) $_POST['moduleitem_order'] : 0;
            $moduleitem_order = $_POST['moduleitem_order'];

            /*
            * --- check module item module parent id
            */

            if(empty($_POST['moduleitem_module_parent_id'])) {
                $error['moduleitem_module_parent_id'] = "<span class='error'>(*) Vui lòng chọn module cha</span>";
            } else {
                $moduleitem_module_parent_id = $_POST['moduleitem_module_parent_id'][0];
            }


            /*
            * --- check module item main cate id
            */

            if(empty($_POST['cateProd_main'])) {
                $moduleitem_cateProd_id_ties = null;
            } else {
                $moduleitem_cateProd_id_ties = $_POST['cateProd_main'][0];
            }

            /*
            * --- check module item list id prod
            */

            if(empty($_POST['block_prod_ties'])) {
                $error['block_prod_ties'] = "<span class='error'>(*) Vui lòng chọn sản phẩm hiển thị</span>";
            } else {
                $moduleitem_list_idProd_ties = [];
                foreach($_POST['block_prod_ties'] as $item) {
                    $moduleitem_list_idProd_ties[] = $item["id"];
                }
                $moduleitem_list_idProd_ties = json_encode($moduleitem_list_idProd_ties);
            }

            /*
            * --- check group banner image
            */

            $listbannerPromotion_prod = [];
            if(!empty($_POST['banner_module_item'])) {
                foreach($_POST['banner_module_item'] as $banner_item) {
                    if((!empty($banner_item['title'])) && (!empty($banner_item['link']))) {
                        $listbannerPromotion_prod[] = $banner_item;
                    }
                }
            }

            if(empty($listbannerPromotion_prod)) {
                $listbannerPromotion_prod = null;
            } else {
                $_POST['listbannerPromotion_prod'] = $listbannerPromotion_prod;
            }

            /*
            *--- check error group banner
            */

            if(empty($error)) {
                if( !($this->ModuleitemModel->checkModuleItemExists($moduleitem_nametap, $moduleitem_module_parent_id)) ) {
                    $dataModuleitem = [
                        "moduleitem_nametap"          => $moduleitem_nametap,
                        "moduleitem_title_txt"        => $moduleitem_title_txt,
                        "moduleitem_title_img"        => $moduleitem_title_img,
                        "moduleitem_cateProd_id_ties" => $moduleitem_cateProd_id_ties,
                        "moduleitem_list_idProd_ties" => $moduleitem_list_idProd_ties,
                        "moduleitem_module_parent_id" => $moduleitem_module_parent_id,
                        "moduleitem_status"           => $moduleitem_status,
                        "moduleitem_bg_body"          => $moduleitem_bg_body,
                        "moduleitem_order"            => $moduleitem_order,
                        "moduleitem_createDate"       => time(),
                        "moduleitem_creatorId"        => $helper->infoUser("user_id")
                    ];
                    $moduleitem_id = $this->ModuleitemModel->addModuleitemNew($dataModuleitem);
                    if(is_int($moduleitem_id)) {
                        if(!empty($listbannerPromotion_prod)) {
                            foreach($listbannerPromotion_prod as $bannerPromotion_item) {
                                $dataBannerPromotion = [
                                    "modulebannerPromo_title"              => $bannerPromotion_item['title'],
                                    "modulebannerPromo_desc"               => $bannerPromotion_item['desc'],
                                    "modulebannerPromo_src"                => $bannerPromotion_item['bannerPC'],
                                    "modulebannerPromo_link"               => $bannerPromotion_item['link'],
                                    "modulebannerPromo_target"             => !empty($bannerPromotion_item['target']) ? $bannerPromotion_item['target'] : "_blank",
                                    "modulebannerPromo_order"              => $bannerPromotion_item['order'],
                                    "modulebannerPromo_moduleitem_id_ties" => $moduleitem_id
                                ];
                                $this->ModuleitemModel->addModuleBannerPromotionNew($dataBannerPromotion);
                            }
                        }
                        $statusActionModuleitem = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm module item thành công"
                        ];
                    } else {
                        $statusActionModuleitem = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm module item không thành công"
                        ];
                    }
                } else {
                    $statusActionModuleitem = [
                        "status"    => "error",
                        "notifiTxt" => "Module item này đã tồn tại [ Trùng tên và danh mục cha ]"
                    ];
                }
            } else {
                $statusActionModuleitem = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $listCateProd = $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd());
        $listModule   = $this->ModuleModel->getListModuleByStatus("all");
        $dataView = [
            "title"  => "Thêm module item",
            "layOut" => "AddModuleitem",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listCateProd"           => !empty($listCateProd) ? $listCateProd : null,
                "listModule"             => !empty($listModule)   ? $listModule   : null,
                "statusActionModuleitem" => !empty($statusActionModuleitem) ? $statusActionModuleitem : null
            ]
        ];

        $this->view("MasterIndex", $dataView);

    }

    public function update($moduleitem_id)
    {
        $moduleitem_id   = (!empty($moduleitem_id)) ? (int) $moduleitem_id : 0;
        $moduleitem_item = $this->ModuleitemModel->getModuleitem_item($moduleitem_id);

        /*
        * -------------------------------------
        * ----- Handle update module item -----
        * -------------------------------------
        */

        if(isset($_POST['addModuleitem_action'])) {
            $error = [];
            global $error;

            /*
            * --- check module item status
            */

            $_POST['moduleitem_status'] = !empty($_POST['moduleitem_status']) ? "on" : "off";
            $moduleitem_status = $_POST['moduleitem_status'];

            /*
            * --- check module item name tap
            */

            if(empty($_POST['moduleitem_nametap'])) {
                $error['moduleitem_nametap'] = "<span class='error'>(*) Vui lòng chọn tên tab</span>";
            } else {
                $moduleitem_nametap = $_POST['moduleitem_nametap'];
            }

            /*
            * --- check module item title txt
            */

            if(empty($_POST['moduleitem_title_txt'])) {
                $error['moduleitem_title_txt'] = "<span class='error'>(*) Vui lòng nhập tên cho module item</span>";
            } else {
                $moduleitem_title_txt = $_POST['moduleitem_title_txt'];
            }

            /*
            * --- check module item title img
            */

            $_POST['moduleitem_title_img'] = !empty($_POST['moduleitem_title_img']) ? $_POST['moduleitem_title_img'] : null;
            $moduleitem_title_img = $_POST['moduleitem_title_img'];

            /*
            * --- check module bg
            */

            $moduleitem_bg_body = $_POST['moduleitem_bg_body'];

            /*
            * --- check module order
            */

            $_POST['moduleitem_order'] = !empty($_POST['moduleitem_order']) ? (int) $_POST['moduleitem_order'] : 0;
            $moduleitem_order = $_POST['moduleitem_order'];

            /*
            * --- check module item module parent id
            */

            if(empty($_POST['moduleitem_module_parent_id'])) {
                $error['moduleitem_module_parent_id'] = "<span class='error'>(*) Vui lòng chọn module cha</span>";
            } else {
                $moduleitem_module_parent_id = $_POST['moduleitem_module_parent_id'][0];
            }


            /*
            * --- check module item main cate id
            */

            if(empty($_POST['cateProd_main'])) {
                $moduleitem_cateProd_id_ties = null;
            } else {
                $moduleitem_cateProd_id_ties = $_POST['cateProd_main'][0];
            }

            /*
            * --- check module item list id prod
            */

            if(empty($_POST['block_prod_ties'])) {
                $error['block_prod_ties'] = "<span class='error'>(*) Vui lòng chọn sản phẩm hiển thị</span>";
            } else {
                $moduleitem_list_idProd_ties = [];
                foreach($_POST['block_prod_ties'] as $item) {
                    $moduleitem_list_idProd_ties[] = $item["id"];
                }
                $moduleitem_list_idProd_ties = json_encode($moduleitem_list_idProd_ties);
            }

            /*
            * --- check group banner image
            */

            $listbannerPromotion_prod = [];
            if(!empty($_POST['banner_module_item'])) {
                foreach($_POST['banner_module_item'] as $banner_item) {
                    if((!empty($banner_item['title'])) && (!empty($banner_item['link']))) {
                        $listbannerPromotion_prod[] = $banner_item;
                    }
                }
            }

            if(empty($listbannerPromotion_prod)) {
                $listbannerPromotion_prod = null;
            } else {
                $_POST['listbannerPromotion_prod'] = $listbannerPromotion_prod;
            }

            /*
            *--- check error group banner
            */

            if(empty($error)) {
                $dataModuleitem = [
                    "moduleitem_nametap"          => $moduleitem_nametap,
                    "moduleitem_title_txt"        => $moduleitem_title_txt,
                    "moduleitem_title_img"        => $moduleitem_title_img,
                    "moduleitem_cateProd_id_ties" => $moduleitem_cateProd_id_ties,
                    "moduleitem_list_idProd_ties" => $moduleitem_list_idProd_ties,
                    "moduleitem_module_parent_id" => $moduleitem_module_parent_id,
                    "moduleitem_status"           => $moduleitem_status,
                    "moduleitem_bg_body"          => $moduleitem_bg_body,
                    "moduleitem_order"            => $moduleitem_order,
                    "moduleitem_updateDate"       => time(),
                ];
                $process = $this->ModuleitemModel->updateModuleitem($dataModuleitem, $moduleitem_id);
                if($process) {
                    // handle delete total module banner promotion
                    $this->ModuleitemModel->deleteModulebannerpromo($moduleitem_id);
                    // handle add new modeul banner promotion
                    if(!empty($listbannerPromotion_prod)) {
                        foreach( $listbannerPromotion_prod as $bannerPromotion_item ) {
                            $dataBannerPromotion = [
                                "modulebannerPromo_title"              => $bannerPromotion_item['title'],
                                "modulebannerPromo_desc"               => $bannerPromotion_item['desc'],
                                "modulebannerPromo_src"                => $bannerPromotion_item['bannerPC'],
                                "modulebannerPromo_link"               => $bannerPromotion_item['link'],
                                "modulebannerPromo_target"             => !empty($bannerPromotion_item['target']) ? $bannerPromotion_item['target'] : "_blank",
                                "modulebannerPromo_order"              => $bannerPromotion_item['order'],
                                "modulebannerPromo_moduleitem_id_ties" => $moduleitem_id
                            ];
                            $this->ModuleitemModel->addModuleBannerPromotionNew($dataBannerPromotion);
                        }
                    }
                    $statusActionModuleitem = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật module item thành công"
                    ];
                } else {
                    $statusActionModuleitem = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật module item không thành công"
                    ];
                }
            } else {
                $statusActionModuleitem = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $listCateProd = $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd());
        $listModule   = $this->ModuleModel->getListModuleByStatus("all");
        $dataView = [
            "title"  => "Cập nhật module item",
            "layOut" => "UpdateModuleitem",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "listCateProd"                  => !empty($listCateProd)           ? $listCateProd           : null,
                "listModule"                    => !empty($listModule)             ? $listModule             : null,
                "statusActionModuleitem"        => !empty($statusActionModuleitem) ? $statusActionModuleitem : null,
                "moduleitem_item"               => !empty($moduleitem_item)        ? $moduleitem_item        : null,
                "moduleitem_list_idProd_ties"   => !empty($this->getListProductByListArrId($moduleitem_item['moduleitem_list_idProd_ties'])) ? $this->getListProductByListArrId($moduleitem_item['moduleitem_list_idProd_ties']) : null,
                "listModuleitemBannerPromotion" => !empty($this->ModuleitemModel->getListModuleitemBannerPromotionByIdModuleitem($moduleitem_id)) ? $this->ModuleitemModel->getListModuleitemBannerPromotionByIdModuleitem($moduleitem_id) : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function getListProductByListArrId($listData)
    {
        $result = [];
        $listArrayId   = json_decode($listData);
        $listTotalProd = $this->ProductModel->getListProdByStatus("all");
        if(!empty($listTotalProd) && !empty($listArrayId)) {
            foreach($listTotalProd as $prodItem) {
                if(in_array($prodItem['prod_id'], $listArrayId)) {
                    $arr = [
                        "id" => $prodItem['prod_id'],
                        "name" => $prodItem['prod_name']
                    ];
                    $result[] = $arr;
                }
            }
        }
        return $result;
    }

    public function handleGetOrderMax()
    {
        $dataAjax = [
            "orderMax" => $this->ModuleitemModel->getOrderMax()
        ];
        echo json_encode($dataAjax['orderMax']);
    }

    public function changeStatus()
    {
        $moduleitem_id      = (int)$_POST['moduleitem_id'];
        $moduleitem_status  = $_POST['statusChange'];
        $dataModuleitem     = [
            "moduleitem_status" => $moduleitem_status
        ];
        $process = $this->ModuleitemModel->updateModuleitem($dataModuleitem, $moduleitem_id);
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

    public function deleteItem ()
    {
        $moduleitem_id = $_POST['moduleitem_id'];
        $process  = $this->ModuleitemModel->deleteModuleitem($moduleitem_id);
        if($process) {
            $this->ModuleitemModel->deleteModulebannerpromo($moduleitem_id);
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
        $list_module_Id = $_POST['list_module_Id'];
        $module_IdDeleteError = [];
        foreach($list_module_Id as $module_IdItem) {
            $moduleitem_id = (int) $module_IdItem;
            $process = $this->ModuleitemModel->deleteModuleitem($moduleitem_id);
            if(!$process) {
                $module_IdDeleteError[] = $module_IdItem;
            } else {
                $this->ModuleitemModel->deleteModulebannerpromo($moduleitem_id);
            }
        }
        if(!empty($module_IdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $module_IdDeleteError
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
        $list_module_Id  = $_POST['list_module_Id'];
        $statusChange    = $_POST['statusChange'];
        $module_IdUpdateError = [];
        foreach($list_module_Id as $moduleitem_IdItem) {
            $moduleitem_id = (int) $moduleitem_IdItem;
            $dataModuleitem = [
                "moduleitem_status" => $statusChange
            ];
            $process = $this->ModuleitemModel->updateModuleitem($dataModuleitem, $moduleitem_id);
            if(!$process) {
                $module_IdUpdateError[] = $moduleitem_IdItem;
            }
        }
        if(!empty($module_IdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantUpdate"  => $module_IdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function getListTotalModuleitem()
    {
        $dataAjax = [
            "dataRecomment" => $this->ModuleitemModel->getListTotalModuleitemByField(["moduleitem_id", "moduleitem_nametap"])
        ];
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $strSearch = $_POST['vlSearch'];
        $dataAjax = [
            "searchData" => $this->ModuleitemModel->recommentSearchByFiled(["moduleitem_id", "moduleitem_nametap"], $strSearch)
        ];
        echo json_encode($dataAjax);
    }
}