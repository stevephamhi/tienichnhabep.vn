<?php

class DisplayController extends Controller
{
    protected $DisplayModel;
    protected $CateProductModel;
    protected $ProductModel;

    function __construct()
    {
        $this->DisplayModel = $this->model("Display");
        $this->CateProductModel = $this->model("CateProduct");
        $this->ProductModel = $this->model("Product");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listDisplay = $this->DisplayModel->searchDisplayByName($strSearch);
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","on","off"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalDisplay  = count($this->DisplayModel->getListDisplayByStatus($status));
            $totalPage     = ceil($totalDisplay / $numPerPage);
            $pageStart     = ($page - 1) * $numPerPage;
            $listDisplay   = $this->DisplayModel->getListDisplayByPagination($orderBy, $status, $pageStart, $numPerPage);
        }

        $dataView = [
            "title"  => "Danh sách bố cục",
            "layOut" => "ListDisplay",
            "css"    => ["home"],
            "data"   => [
                "orderBy"      => !empty($orderBy) ? $orderBy : null,
                "status"       => !empty($status) ? $status : null,
                "page"         => !empty($page) ? $page : null,
                "listDisplay"  => !empty($listDisplay) ? $listDisplay : null,
                "numPerPage"   => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"    => !empty($totalPage) ? $totalPage : null,
                "strSearch"    => !empty($strSearch) ? $strSearch : null,
                "totalDisplay" => !empty($totalDisplay) ? $totalDisplay : count($listDisplay),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {

        $helper = new Helper;

        if(isset($_POST['addDisplay_action'])) {
            $error = [];
            global $error;

            /*
            * --- check display status
            */

            $display_status = !empty($_POST['display_status']) ? "on" : "off";

            /*
            * --- check display name
            */

            if(empty($_POST['display_title'])) {
                $error['display_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề bố cục</span>";
            } else {
                $display_title = $_POST['display_title'];
            }

            /*
            * --- check display order
            */

            $display_order = !empty($_POST['display_order']) ? (int) $_POST['display_order'] : ($this->DisplayModel->getOrderMaxPlus());

            /*
            * --- check display type
            */

            $display_type = !empty($_POST['display_type']) ? $_POST['display_type'][0] : "normal";
            $_POST['display_type'] = $display_type;

            /*
            * --- check display cate prod main
            */

            if(empty($_POST['cateProd_main'])) {
                $error['cateProd_main'] = "<span class='error'>(*) Vui lòng chọn danh mục chính</span>";
            } else {
                $display_cateProdId_main_ties = $_POST['cateProd_main'][0];
            }

            /*
            * --- check display cate link
            */

            if(empty($_POST['cateProd_rela'])) {
                $error['cateProd_rela'] = "<span class='error'>(*) Vui lòng chọn danh mục liên kết</span>";
            } else {
                $display_cateProdId_list_ties = [];
                foreach($_POST['cateProd_rela'] as $item) {
                    $display_cateProdId_list_ties[] = $item["id"];
                }
                $display_cateProdId_list_ties = json_encode($display_cateProdId_list_ties);
            }

            /*
            * --- check display prod highlight
            */

            if(empty($_POST['prod_highlight'])) {
                $display_prodId_highlight_list_ties = null;
            } else {
                $display_prodId_highlight_list_ties = [];
                foreach($_POST['prod_highlight'] as $item) {
                    $display_prodId_highlight_list_ties[] = $item["id"];
                }
                $display_prodId_highlight_list_ties = json_encode($display_prodId_highlight_list_ties);
            }

            /*
            * --- check display prod normal
            */

            if(empty($_POST['prod_normal'])) {
                $error['prod_normal'] = "<span class='error'>(*) Vui lòng chọn sản phẩm hiển thị</span>";
            } else {
                $display_prodId_normal_list_ties = [];
                foreach($_POST['prod_normal'] as $item) {
                    $display_prodId_normal_list_ties[] = $item["id"];
                }
                $display_prodId_normal_list_ties = json_encode($display_prodId_normal_list_ties);
            }

            /*
            * --- check display prod mobile
            */

            if(empty($_POST['prod_mobile'])) {
                $display_prodId_mobile_list_ties = null;
            } else {
                $display_prodId_mobile_list_ties = [];
                foreach($_POST['prod_mobile'] as $item) {
                    $display_prodId_mobile_list_ties[] = $item["id"];
                }
                $display_prodId_mobile_list_ties = json_encode($display_prodId_mobile_list_ties);
            }

            /*
            * --- check display error
            */

            if(empty($error)) {
                if(!($this->DisplayModel->dislayExists($display_title))) {
                    $display_createDate = time();
                    $display_creatorId  = $helper->infoUser("user_id");
                    $dataDisplay = [
                        "display_title"                      => $display_title,
                        "display_cateProdId_list_ties"       => $display_cateProdId_list_ties,
                        "display_cateProdId_main_ties"       => $display_cateProdId_main_ties,
                        "display_prodId_highlight_list_ties" => $display_prodId_highlight_list_ties,
                        "display_prodId_normal_list_ties"    => $display_prodId_normal_list_ties,
                        "display_prodId_mobile_list_ties"    => $display_prodId_mobile_list_ties,
                        "display_order"                      => $display_order,
                        "display_status"                     => $display_status,
                        "display_createDate"                 => $display_createDate,
                        "display_creatorId"                  => $display_creatorId,
                        "display_type"                       => $display_type,
                    ];
                    $idDisplay = $this->DisplayModel->addDisplayNew($dataDisplay);
                    if(is_int($idDisplay)) {
                        $statusActionDisplay = [
                            "status"    => "success",
                            "notifiTxt" => "Thêm bố cục thành công"
                        ];
                    } else {
                        $statusActionDisplay = [
                            "status"    => "error",
                            "notifiTxt" => "Thêm bố cục không thành công"
                        ];
                    }
                } else {
                    $statusActionDisplay = [
                        "status"    => "error",
                        "notifiTxt" => "Bố cụ đã tồn tại [ Trùng tên bố cục ]"
                    ];
                }
            } else {
                $statusActionDisplay = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }

        }

        $dataView = [
            "title"  => "Thêm bố cục trang chủ",
            "layOut" => "AddDisplay",
            "css"    => ["home"],
            "data"   => [
                "listCateProd"       => $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd()),
                "statusActionDisplay" => !empty($statusActionDisplay) ? $statusActionDisplay : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($display_id = 0)
    {
        $display_id  = (!empty($display_id)) ? (int) $display_id : 0;
        $displayItem = $this->DisplayModel->getDisplayItemById($display_id);

        /*
        * ---------------------------------
        * ----- Handle update display -----
        * ---------------------------------
        */

        if(isset($_POST['updateDisplay_action'])) {
            $error = [];
            global $error;

            /*
            * --- check display status
            */

            $display_status = !empty($_POST['display_status']) ? "on" : "off";

            /*
            * --- check display name
            */

            if(empty($_POST['display_title'])) {
                $error['display_title'] = "<span class='error'>(*) Vui lòng nhập tiêu đề bố cục</span>";
            } else {
                $display_title = $_POST['display_title'];
            }

            /*
            * --- check display order
            */

            $display_order = !empty($_POST['display_order']) ? (int) $_POST['display_order'] : ($this->DisplayModel->getOrderMaxPlus());

            /*
            * --- check display type
            */

            $display_type = !empty($_POST['display_type']) ? $_POST['display_type'][0] : "normal";
            $_POST['display_type'] = $display_type;

            /*
            * --- check display cate prod main
            */

            if(empty($_POST['cateProd_main'])) {
                $error['cateProd_main'] = "<span class='error'>(*) Vui lòng chọn danh mục chính</span>";
            } else {
                $display_cateProdId_main_ties = $_POST['cateProd_main'][0];
            }

            /*
            * --- check display cate link
            */

            if(empty($_POST['cateProd_rela'])) {
                $error['cateProd_rela'] = "<span class='error'>(*) Vui lòng chọn danh mục liên kết</span>";
            } else {
                $display_cateProdId_list_ties = [];
                foreach($_POST['cateProd_rela'] as $item) {
                    $display_cateProdId_list_ties[] = $item["id"];
                }
                $display_cateProdId_list_ties = json_encode($display_cateProdId_list_ties);
            }

            /*
            * --- check display prod highlight
            */

            if(empty($_POST['prod_highlight'])) {
                $display_prodId_highlight_list_ties = null;
            } else {
                $display_prodId_highlight_list_ties = [];
                foreach($_POST['prod_highlight'] as $item) {
                    $display_prodId_highlight_list_ties[] = $item["id"];
                }
                $display_prodId_highlight_list_ties = json_encode($display_prodId_highlight_list_ties);
            }

            /*
            * --- check display prod normal
            */

            if(empty($_POST['prod_normal'])) {
                $error['prod_normal'] = "<span class='error'>(*) Vui lòng chọn sản phẩm hiển thị</span>";
            } else {
                $display_prodId_normal_list_ties = [];
                foreach($_POST['prod_normal'] as $item) {
                    $display_prodId_normal_list_ties[] = $item["id"];
                }
                $display_prodId_normal_list_ties = json_encode($display_prodId_normal_list_ties);
            }

            /*
            * --- check display prod mobile
            */

            if(empty($_POST['prod_mobile'])) {
                $display_prodId_mobile_list_ties = null;
            } else {
                $display_prodId_mobile_list_ties = [];
                foreach($_POST['prod_mobile'] as $item) {
                    $display_prodId_mobile_list_ties[] = $item["id"];
                }
                $display_prodId_mobile_list_ties = json_encode($display_prodId_mobile_list_ties);
            }

            if(empty($error)) {
                $display_updateDate = time();
                $dataDisplay = [
                    "display_title"                      => $display_title,
                    "display_cateProdId_list_ties"       => $display_cateProdId_list_ties,
                    "display_cateProdId_main_ties"       => $display_cateProdId_main_ties,
                    "display_prodId_highlight_list_ties" => $display_prodId_highlight_list_ties,
                    "display_prodId_normal_list_ties"    => $display_prodId_normal_list_ties,
                    "display_prodId_mobile_list_ties"    => $display_prodId_mobile_list_ties,
                    "display_order"                      => $display_order,
                    "display_status"                     => $display_status,
                    "display_updateDate"                 => $display_updateDate,
                    "display_type"                       => $display_type,
                ];
                $process = $this->DisplayModel->updateDisplay($dataDisplay, $display_id);
                if($process) {
                    $statusActionDisplay = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật bố cục thành công"
                    ];
                } else {
                    $statusActionDisplay = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật bố cục không thành công"
                    ];
                }
            } else {
                $statusActionDisplay = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật bố cục",
            "layOut" => "UpdateDisplay",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "displayItem"                        => !empty($displayItem) ? $displayItem : null,
                "listCateProd"                       => !empty($this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd())) ? $this->CateProductModel->getMultiLevelCateProd($this->CateProductModel->getListTotalCateProd()) : null,
                "statusActionDisplay"                => !empty($statusActionDisplay) ? $statusActionDisplay : null,
                "display_prodId_highlight_list_ties" => !empty($this->getListProductByListArrId($displayItem['display_prodId_highlight_list_ties'])) ? $this->getListProductByListArrId($displayItem['display_prodId_highlight_list_ties']) : null,
                "display_prodId_mobile_list_ties"    => !empty($this->getListProductByListArrId($displayItem['display_prodId_mobile_list_ties'])) ? $this->getListProductByListArrId($displayItem['display_prodId_mobile_list_ties']) : null,
                "display_prodId_normal_list_ties"    => !empty($this->getListProductByListArrId($displayItem['display_prodId_normal_list_ties'])) ? $this->getListProductByListArrId($displayItem['display_prodId_normal_list_ties']) : null,
                "display_cateProdId_list_ties"       => !empty($this->getListCateProdListArrId($displayItem['display_cateProdId_list_ties'])) ? $this->getListCateProdListArrId($displayItem['display_cateProdId_list_ties']) : null,
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function getListCateProdListArrId($listData)
    {
        $result = [];
        $listArrayId = json_decode($listData);
        $listTotalCateProd = $this->CateProductModel->getListCateProdByStatus("all");
        foreach($listTotalCateProd as $cateProdItem) {
            if(in_array($cateProdItem['cateProd_id'], $listArrayId)) {
                $arr = [
                    "id" => $cateProdItem['cateProd_id'],
                    "name" => $cateProdItem['cateProd_name']
                ];
                $result[] = $arr;
            }
        }
        return $result;
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

    public function updateDisplayOrder()
    {
        $dispOrderChange = (int) $_POST['dispOrderChange'];
        $displayID       = (int) $_POST['displayID'];
        $dataDisplay = [
            "display_order" => $dispOrderChange
        ];
        $process = $this->DisplayModel->updateDisplay($dataDisplay, $displayID);
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

    public function changeStatus()
    {
        $display_id  = (int)$_POST['display_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataDisplay = [
            "display_status" => $statusChange
        ];
        $process = $this->DisplayModel->updateDisplay($dataDisplay, $display_id);
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
        $display_id = $_POST['display_id'];
        $process = $this->DisplayModel->deleteDisplay($display_id);
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
        $listDisplayId = $_POST['listDisplayId'];
        $DisplayIdDeleteError   = [];
        foreach($listDisplayId as $DisplayIdItem) {
            $idDisplay = (int) $DisplayIdItem;
            $process    = $this->DisplayModel->deleteDisplay($idDisplay);
            if(!$process) {
                $DisplayIdDeleteError[] = $DisplayIdItem;
            }
        }
        if(!empty($DisplayIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $DisplayIdDeleteError
            ];
        } else {
            $dataAjax = [
                "status" => "success",
            ];
        }
        echo json_encode($dataAjax);
    }

    public function multiChangeStatus()
    {
        $listDisplayId   = $_POST['listDisplayId'];
        $statusChange = $_POST['statusChange'];
        $DisplayIdUpdateError = [];
        foreach($listDisplayId as $DisplayIdItem) {
            $idDisplay   = (int) $DisplayIdItem;
            $dataDisplay = [
                "display_status" => $statusChange
            ];
            $process = $this->DisplayModel->updateDisplay($dataDisplay, $idDisplay);
            if(!$process) {
                $DisplayIdUpdateError[] = $DisplayIdItem;
            }
        }
        if(!empty($DisplayIdUpdateError)) {
            $dataAjax = [
                "status"            => "error",
                "DisplayIdUpdateError" => $DisplayIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function recommentSearch()
    {
        $vlSearch = Format::validation($_POST['vlSearch']);
        $result   = $this->DisplayModel->searchDisplayByName($vlSearch);
        $dataAjax = [
            "searchData" => $result
        ];
        echo json_encode($dataAjax);
    }

    public function getAllDisplay()
    {
        $dataAjax = [
            "listDisplay" => $this->DisplayModel->getListDisplayByStatus("all")
        ];
        echo json_encode($dataAjax);
    }

}