<?php


class SupportCustomerController extends Controller
{

    protected $SupportCustomerModel;
    protected $ProductModel;
    protected $UserModel;

    public function __construct()
    {
        $this->SupportCustomerModel = $this->model("SupportCustomer");
        $this->ProductModel         = $this->model("Product");
        $this->UserModel            = $this->model("User");
    }


    public function index($orderBy = 'desc', $status = 'all', $page = 1, $fieldName = 'sp_customer_fullname', $strSearch = '')
    {
        if(!empty($strSearch)) {
            $strSearch = Format::validationSearch($strSearch);
            $listSupportCustomer = $this->SupportCustomerModel->searchRecommentByFile($fieldName, $strSearch);
        } else {
            $orderByAllow         = ["asc","desc"];
            $statusAllow          = ["all","processed","no_process"];
            $orderBy              = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status               = in_array($status,$statusAllow)   ? $status  : "all";
            $page                 = $page >= 1 ? $page : 1;
            $numPerPage           = 10;
            $totalSupportcustomer = count( $this->SupportCustomerModel->getListSupportcustomerByStatus($status) );
            $totalPage            = ceil($totalSupportcustomer / $numPerPage);
            $pageStart            = ($page - 1) * $numPerPage;
            $listSupportCustomer  = $this->SupportCustomerModel->getListSupportcustomerByPagination($orderBy, "sp_customer_time", $status, $pageStart, $numPerPage);
        }

        $dataView = [
            "title"  => "Hỗ trợ khách hàng",
            "layOut" => "listSupportcustomer",
            "css"    => ["home"],
            "data"   => [
                "orderBy"              => !empty($orderBy)              ? $orderBy              : null,
                "status"               => !empty($status)               ? $status               : null,
                "page"                 => !empty($page)                 ? $page                 : null,
                "numPerPage"           => !empty($numPerPage)           ? $numPerPage           : null,
                "totalPage"            => !empty($totalPage)            ? $totalPage            : null,
                "strSearch"            => !empty($strSearch)            ? $strSearch            : null,
                "listSupportCustomer"  => !empty($listSupportCustomer)  ? $listSupportCustomer  : null,
                "totalSupportcustomer" => !empty($totalSupportcustomer) ? $totalSupportcustomer : count($listSupportCustomer),
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function deleteItem()
    {
        $sp_customer_id = $_POST['sp_customer_id'];
        $process = $this->SupportCustomerModel->deleteSupportcustomer($sp_customer_id);
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
        $listSupportcustomerId = $_POST['listSupportcustomerId'];
        $supportcustomerIdDeleteError = [];
        foreach($listSupportcustomerId as $supportcustomerIdItem) {
            $idSupportcustomer = (int) $supportcustomerIdItem;
            $process = $this->SupportCustomerModel->deleteSupportcustomer($idSupportcustomer);
            if(!$process) {
                $supportcustomerIdDeleteError[] = $supportcustomerIdItem;
            }
        }
        if(!empty($supportcustomerIdDeleteError)) {
            $dataAjax = [
                "status"            => "error",
                "listIdCantDeleted" => $supportcustomerIdDeleteError
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function loadListSupportcustomerByField()
    {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->SupportCustomerModel->loadSupportcustomerByField__model($fieldName)
        ];
        echo json_encode($dataAjax);
    }

    public function searchRecommentByFile()
    {
        $searchValue = $_POST['searchValue'];
        $fieldName   = $_POST['fieldName'];
        $dataAjax = [
            "searchData" => $this->SupportCustomerModel->searchRecommentByFile($fieldName, $searchValue)
        ];
        echo json_encode($dataAjax);
    }

    public function detail( $sp_customer_id = 0 )
    {

        $sp_customer_id      = (!empty($sp_customer_id)) ? (int)$sp_customer_id : 0;
        $supportcustomerItem = $this->SupportCustomerModel->getSupportCustomerItemById($sp_customer_id);
        $sp_customer_prodid  = !empty($supportcustomerItem['sp_customer_prodid']) ? (int) $supportcustomerItem['sp_customer_prodid'] : 0;
        $sp_customer_handler = !empty($supportcustomerItem['sp_customer_handler']) ? (int) $supportcustomerItem['sp_customer_handler'] : 0;
        $userItem            = $this->UserModel->getUserItemById($sp_customer_handler);
        $productItem         = $this->ProductModel->getProdItemById($sp_customer_prodid);

        $dataView = [
            "title"  => "Chi tiết yêu cầu",
            "layOut" => "DetailSupportcustomer",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "supportcustomerItem" => !empty($supportcustomerItem) ? $supportcustomerItem : null,
                "productItem"         => !empty($productItem) ? $productItem : null,
                "userItem"            => !empty($userItem) ? $userItem : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function updateStatus()
    {
        $statusChange   = $_POST['statusChange'];
        $sp_customer_id = (int) $_POST['sp_customer_id'];

        if($statusChange == "no_process") {
            $timeProcessed = null;
        } else {
            $timeProcessed = time();
        }

        $helper = new Helper;

        $dataSupportcustomer = [
            "sp_customer_status"         => $statusChange,
            "sp_customer_time_processed" => $timeProcessed,
            "sp_customer_handler"        => $helper->infoUser("user_id")
        ];

        $process = $this->SupportCustomerModel->updateSupportcustomer( $dataSupportcustomer, $sp_customer_id );

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