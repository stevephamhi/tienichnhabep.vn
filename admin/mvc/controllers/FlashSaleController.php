<?php

class FlashSaleController extends Controller
{
    public $FlashSaleModel;
    public $ProductModel;
    public $CustomerModel;

    function __construct()
    {
        $this->FlashSaleModel = $this->model("FlashSale");
        $this->ProductModel   = $this->model("Product");
        $this->CustomerModel  = $this->model("Customer");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listFlashSale = [];
        } else {
            $orderByAllow   = ["asc","desc"];
            $statusAllow    = ["all","on","off"];
            $orderBy        = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status         = in_array($status,$statusAllow)   ? $status  : "all";
            $page           = $page >= 1 ? $page : 1;
            $numPerPage     = 10;
            $totalFlashSale = count($this->FlashSaleModel->getListFlashSaleByStatus($status));
            $totalPage      = ceil($totalFlashSale / $numPerPage);
            $pageStart      = ($page - 1) * $numPerPage;
            $listFlashSale  = $this->FlashSaleModel->getFlashSaleByPagination($orderBy, $status, $pageStart, $numPerPage);
        }

        if(!empty($listFlashSale)) {
            foreach($listFlashSale as &$flashSaleItem) {
                if(!empty($flashSaleItem['prod_flashsale_prodId'])) {
                    $flashSaleItem['prod_flashsale_customerGroupName'] = !empty($this->CustomerModel->getCustomerGroupItemById($flashSaleItem['prod_flashsale_customer_groupId'])['customerGroup_name']) ? $this->CustomerModel->getCustomerGroupItemById($flashSaleItem['prod_flashsale_customer_groupId'])['customerGroup_name'] : null;
                    $flashSaleItem['prod_flashsale_prodName']          = !empty($this->ProductModel->getProdItemById($flashSaleItem['prod_flashsale_prodId'])['prod_name']) ? $this->ProductModel->getProdItemById($flashSaleItem['prod_flashsale_prodId'])['prod_name'] : null;
                    $flashSaleItem['prod_flashsale_currentPrice']      = !empty($this->ProductModel->getProdItemById($flashSaleItem['prod_flashsale_prodId'])['prod_currentPrice']) ? $this->ProductModel->getProdItemById($flashSaleItem['prod_flashsale_prodId'])['prod_currentPrice'] : null;
                    $flashSaleItem['prod_flashsale_image']             = !empty($this->ProductModel->getProdItemById($flashSaleItem['prod_flashsale_prodId'])['prod_avatar']) ? $this->ProductModel->getProdItemById($flashSaleItem['prod_flashsale_prodId'])['prod_avatar'] : null;
                }
            }
        }

        $dataView = [
            "title"  => "Danh sách flash sale",
            "layOut" => "ListFlashSale",
            "css"    => ["home"],
            "data"   => [
                "orderBy"        => !empty($orderBy) ? $orderBy : null,
                "status"         => !empty($status) ? $status : null,
                "page"           => !empty($page) ? $page : null,
                "numPerPage"     => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"      => !empty($totalPage) ? $totalPage : null,
                "strSearch"      => !empty($strSearch) ? $strSearch : null,
                "listFlashSale"  => !empty($listFlashSale) ? $listFlashSale : null,
                "totalFlashSale" => !empty($totalFlashSale) ? $totalFlashSale : count($listFlashSale),
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function add()
    {
        $helper = new Helper;
        if(isset($_POST['addFlashSale_action'])) {
            $error = [];
            global $error;

            /*
            * --- check flashSale status
            */

            $prod_flashsale_status = !empty($_POST['prod_flashsale_status']) ? "on" : "off";

            /*
            * --- check flashSale customer group
            */

            $prod_flashsale_customer_groupId = $_POST['prod_flashsale_customer_groupId'];

            /*
            * --- check flashSale order
            */

            $prod_flashsale_order = !empty($_POST['prod_flashsale_order']) ? (int)$_POST['prod_flashsale_order'] : 0;
            $_POST['prod_flashsale_order'] = $prod_flashsale_order;

            /*
            * --- check flashSale price
            */

            if(empty($_POST['prod_flashsale_price'])) {
                $error['prod_flashsale_price'] = "<span class='error'>(*) Vui lòng nhập giá khuyến mãi</span>";
            } else {
                $prod_flashsale_price = $_POST['prod_flashsale_price'];
            }

            /*
            * --- check flashSale date start
            */

            if(empty($_POST['prod_flashsale_dateStart'])) {
                $error['prod_flashsale_dateStart'] = "<span class='error'>(*) Vui lòng nhập ngày bắt đầu</span>";
            } else {
                $prod_flashsale_dateStart = strtotime($_POST['prod_flashsale_dateStart']);
            }

            /*
            * --- check flashSale date end
            */

            if(empty($_POST['prod_flashsale_dateEnd'])) {
                $error['prod_flashsale_dateEnd'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $prod_flashsale_dateEnd = strtotime($_POST['prod_flashsale_dateEnd']);
            }

            /*
            * --- check flashSale prod ties
            */

            if(empty($_POST['prodId'])) {
                $error['prodId'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 sản phẩm</span>";
            } else {
                $listProdId = $_POST['prodId'];
            }

            /*
            * --- check flashSale prod error
            */

            if(empty($error)) {
                $prod_flashsale_createDate = time();
                $prod_flashsale_creatorId  = $helper->infoUser("user_id");
                $numSuccessStatusInfo = 0;
                foreach($listProdId as $prodIdItem) {
                    $dataFlashSale = [
                        "prod_flashsale_prodId"           => $prodIdItem,
                        "prod_flashsale_customer_groupId" => $prod_flashsale_customer_groupId,
                        "prod_flashsale_order"            => $prod_flashsale_order,
                        "prod_flashsale_price"            => $prod_flashsale_price,
                        "prod_flashsale_dateStart"        => $prod_flashsale_dateStart,
                        "prod_flashsale_dateEnd"          => $prod_flashsale_dateEnd,
                        "prod_flashsale_createDate"       => $prod_flashsale_createDate,
                        "prod_flashsale_creatorId"        => $prod_flashsale_creatorId,
                        "prod_flashsale_status"           => $prod_flashsale_status
                    ];
                    $idFlashSale = $this->FlashSaleModel->addFlashSaleNew($dataFlashSale);
                    if(is_int($idFlashSale)) {
                        $numSuccessStatusInfo ++;
                    }
                }
                if($numSuccessStatusInfo == count($listProdId)) {
                    $statusActionFlashSale = [
                        "status"    => "success",
                        "notifiTxt" => "Thêm flash sale thành công"
                    ];
                } else {
                    $statusActionFlashSale = [
                        "status"    => "error",
                        "notifiTxt" => "Thêm flash sale không thành công"
                    ];
                }
            } else {
                $statusActionFlashSale = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }
        $dataView = [
            "title"  => "Thêm flash sale",
            "layOut" => "AddFlashSale",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "statusActionFlashSale" => !empty($statusActionFlashSale) ? $statusActionFlashSale : null,
                "listProd"              => !empty($this->ProductModel->getListProdByStatus("all")) ? $this->ProductModel->getListProdByStatus("all") : null,
                "list_customerGroup"    => !empty($this->CustomerModel->getListCustomerGroupByStatus("all")) ? $this->CustomerModel->getListCustomerGroupByStatus("all") : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function update($flashSale_id = 0)
    {
        $flashSale_id  = (!empty($flashSale_id)) ? (int) $flashSale_id : 0;
        $flashSaleItem = $this->FlashSaleModel->getFlashSaleItemById($flashSale_id);

        /*
        * ------------------------------------
        * ----- Handle update flash sale -----
        * ------------------------------------
        */

        if(isset($_POST['updateFlashSale_action'])) {
            $error = [];
            global $error;

            /*
            * --- check flashSale status
            */

            $prod_flashsale_status = !empty($_POST['prod_flashsale_status']) ? "on" : "off";
            $_POST['prod_flashsale_status'] = $prod_flashsale_status;

            /*
            * --- check flashSale customer group
            */

            $prod_flashsale_customer_groupId = !empty($_POST['prod_flashsale_customer_groupId']) ? (int) $_POST['prod_flashsale_customer_groupId'] : 1;

            /*
            * --- check flashSale order
            */

            $prod_flashsale_order = !empty($_POST['prod_flashsale_order']) ? (int)$_POST['prod_flashsale_order'] : 0;
            $_POST['prod_flashsale_order'] = $prod_flashsale_order;

            /*
            * --- check flashSale price
            */

            if(empty($_POST['prod_flashsale_price'])) {
                $error['prod_flashsale_price'] = "<span class='error'>(*) Vui lòng nhập giá khuyến mãi</span>";
            } else {
                $prod_flashsale_price = $_POST['prod_flashsale_price'];
            }

            /*
            * --- check flashSale date start
            */

            if(empty($_POST['prod_flashsale_dateStart'])) {
                $error['prod_flashsale_dateStart'] = "<span class='error'>(*) Vui lòng nhập ngày bắt đầu</span>";
            } else {
                $prod_flashsale_dateStart = strtotime($_POST['prod_flashsale_dateStart']);
            }

            /*
            * --- check flashSale date end
            */

            if(empty($_POST['prod_flashsale_dateEnd'])) {
                $error['prod_flashsale_dateEnd'] = "<span class='error'>(*) Vui lòng nhập ngày kết thúc</span>";
            } else {
                $prod_flashsale_dateEnd = strtotime($_POST['prod_flashsale_dateEnd']);
            }

            /*
            * --- check flashSale prod ties
            */

            if(empty($_POST['prodId'])) {
                $error['prodId'] = "<span class='error'>(*) Vui lòng chọn ít nhất 1 sản phẩm</span>";
            } else {
                $prodId = $_POST['prodId'][0];
            }

            /*
            * --- check flashSale prod error
            */

            if(empty($error)) {
                $prod_flashsale_updateDate = time();
                $dataFlashSale = [
                    "prod_flashsale_prodId"           => $prodId,
                    "prod_flashsale_customer_groupId" => $prod_flashsale_customer_groupId,
                    "prod_flashsale_order"            => $prod_flashsale_order,
                    "prod_flashsale_price"            => $prod_flashsale_price,
                    "prod_flashsale_dateStart"        => $prod_flashsale_dateStart,
                    "prod_flashsale_dateEnd"          => $prod_flashsale_dateEnd,
                    "prod_flashsale_updateDate"       => $prod_flashsale_updateDate,
                    "prod_flashsale_status"           => $prod_flashsale_status
                ];
                $process = $this->FlashSaleModel->updateFlashSale($dataFlashSale, $flashSale_id);
                if($process) {
                    $statusActionFlashSale = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật flash sale thành công"
                    ];
                } else {
                    $statusActionFlashSale = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật flash sale không thành công"
                    ];
                }
            } else {
                $statusActionFlashSale = [
                    "status"    => "error",
                    "notifiTxt" => "Một số thông tin bạn chưa hoàn thành hoặc không đúng kiểu dữ liệu"
                ];
            }
        }

        $dataView = [
            "title"  => "Cập nhật flash sale",
            "layOut" => "UpdateFlashSale",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "flashSaleItem"         => !empty($flashSaleItem) ? $flashSaleItem : null,
                "listProd"              => !empty($this->ProductModel->getListProdByStatus("all")) ? $this->ProductModel->getListProdByStatus("all") : null,
                "list_customerGroup"    => !empty($this->CustomerModel->getListCustomerGroupByStatus("all")) ? $this->CustomerModel->getListCustomerGroupByStatus("all") : null,
                "statusActionFlashSale" => !empty($statusActionFlashSale) ? $statusActionFlashSale : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function changeStatus()
    {
        $flashSale_id  = (int)$_POST['flashSale_id'];
        $statusChange = Format::validation($_POST['statusChange']);
        $dataFlashSale = [
            "prod_flashsale_status" => $statusChange
        ];
        $process = $this->FlashSaleModel->updateFlashSale($dataFlashSale, $flashSale_id);
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
        $flashSale_id = $_POST['flashSale_id'];
        $process = $this->FlashSaleModel->deleteFlashSale($flashSale_id);
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
        $listFlashSaleId = $_POST['listFlashSaleId'];
        $flashSaleIdDeleteError   = [];
        foreach($listFlashSaleId as $flashSaleIdItem) {
            $process    = $this->FlashSaleModel->deleteFlashSale((int) $flashSaleIdItem);
            if(!$process) {
                $flashSaleIdDeleteError[] = $flashSaleIdItem;
            }
        }
        if(!empty($flashSaleIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $flashSaleIdDeleteError
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
        $listFlashSaleId        = $_POST['listFlashSaleId'];
        $statusChange          = $_POST['statusChange'];
        $flashSaleIdUpdateError = [];
        foreach($listFlashSaleId as $flashSaleIdItem) {
            $dataFlashSale = [
                "prod_flashsale_status" => $statusChange
            ];
            $process = $this->FlashSaleModel->updateFlashSale($dataFlashSale, (int) $flashSaleIdItem);
            if(!$process) {
                $flashSaleIdUpdateError[] = $flashSaleIdItem;
            }
        }
        if(!empty($flashSaleIdUpdateError)) {
            $dataAjax = [
                "status"                => "error",
                "flashSaleIdUpdateError" => $flashSaleIdUpdateError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function handleGetOrderMax()
    {
        $dataAjax = [
            "orderMax" => $this->FlashSaleModel->getOrderMax()
        ];
        echo json_encode($dataAjax['orderMax']);
    }
}