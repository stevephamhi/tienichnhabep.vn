<?php

class CustomerController extends Controller
{
    private $CustomerModel;
    private $OrderMode;

    public function __construct()
    {
        $this->CustomerModel = $this->model("Customer");
        $this->OrderMode     = $this->model("Order");
    }

    public function index($orderBy = 'desc', $status = 'all', $page = 1, $fieldName = '', $strSearch = '')
    {
        echo $fieldName;
        if( !empty( $strSearch ) ) {
            $strSearch = Format::validationSearch($strSearch);
            $listCustomer = $this->CustomerModel->searchRecommentByFile_model($fieldName, $strSearch);
        } else {
            $orderByAllow  = ["asc","desc"];
            $statusAllow   = ["all","active","pending","disable"];
            $orderBy       = in_array($orderBy,$orderByAllow) ? $orderBy : "asc";
            $status        = in_array($status,$statusAllow)   ? $status  : "all";
            $page          = $page >= 1 ? $page : 1;
            $numPerPage    = 10;
            $totalCustomer = count( $this->CustomerModel->getListCustomerByStatus( $status ) );
            $totalPage     = ceil( $totalCustomer / $numPerPage );
            $pageStart     = ($page - 1) * $numPerPage;
            $listCustomer  = $this->CustomerModel->getListCustomerByPagination( $orderBy, $status, $pageStart, $numPerPage );
        }
        $dataView = [
            "title"  => "Danh sách khách hàng",
            "layOut" => "ListCustomers",
            "css"    => ["home"],
            "data"   => [
                "orderBy"       => !empty($orderBy)       ? $orderBy       : null,
                "status"        => !empty($status)        ? $status        : null,
                "page"          => !empty($page)          ? $page          : null,
                "listCustomer"  => !empty($listCustomer)  ? $listCustomer  : null,
                "numPerPage"    => !empty($numPerPage)    ? $numPerPage    : null,
                "totalPage"     => !empty($totalPage)     ? $totalPage     : null,
                "strSearch"     => !empty($strSearch)     ? $strSearch     : null,
                "totalCustomer" => !empty($totalCustomer) ? $totalCustomer : count($listCustomer),
                "fieldName"     => !empty($fieldName)     ? $fieldName     : null
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }


    public function update( $customer_id = 0 ) {
        $customer_id  = !empty( $customer_id ) ? (int) $customer_id : 0;
        $customerItem = $this->CustomerModel->getCustomerById( $customer_id );

        /*
        * ----------------------------------
        * ----- Handle update customer -----
        * ----------------------------------
        */

        if( isset( $_POST['updateCustomer_action'] ) ) {
            $error = [];
            global $error;

            /**
             * --- check customer status
             */
            $customer_status = $_POST['customer_status'];
            $_POST['customer_status'] = $customer_status;

            /**
             * --- check customer fullname
             */

            if( empty( $_POST['customer_fullname'] ) ) {
                $error['customer_fullname'] = "<span class='error'>(*) Vui lòng nhập họ tên khách hàng</span>";
            } else {
                $customer_fullname = $_POST['customer_fullname'];
            }

            /**
             * --- check customer gender
             */

            $customer_gender = $_POST['customer_gender'];
            $_POST['customer_gender'] = $customer_gender;

            // echo $customer_gender;

            /**
             * -- check customer email
             */
            if( empty( $_POST['customer_email'] ) ) {
                $error['customer_email'] = "<span class='error'>(*) Vui lòng nhập email khách hàng</span>";
            } else {
                $customer_email = $_POST['customer_email'];
            }

            /**
             * -- check customer phone
             */
            if( empty( $_POST['customer_phone'] ) ) {
                $error['customer_phone'] = "<span class='error'>(*) Vui lòng nhập SĐT khách hàng</span>";
            } else {
                $customer_phone = $_POST['customer_phone'];
            }

            /**
             * -- check error
             */
            if( empty( $error ) ) {
                $dataCustomer = [
                    "customer_fullname"   => $customer_fullname,
                    "customer_email"      => $customer_email,
                    "customer_phone"      => $customer_phone,
                    "customer_gender"     => $customer_gender,
                    "customer_updateDate" => time(),
                    "customer_status"     => $customer_status
                ];
                $process = $this->CustomerModel->updateCustomer( $dataCustomer, $customer_id );
                if( $process ) {
                    $statusActionCustomer = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật thông tin khách hàng thành công"
                    ];
                } else {
                    $statusActionCustomer = [
                        "status"    => "error",
                        "notifiTxt" => "Cập nhật thông tin khách hàng không thành công"
                    ];
                }
            } else {
                $statusActionCustomer = [
                    "status"    => "error",
                    "notifiTxt" => "Vui lòng điền đầy đủ thông tin"
                ];
            }
        }


        if( !empty( $customerItem ) ) {
            $listOrder = $this->OrderMode->getListOrderByCustomerId( $customer_id );
            if( !empty($listOrder) ) {
                $totalTransactionPrice = 0;
                foreach( $listOrder as $orderItem ) {
                    $totalTransactionPrice += (int) $orderItem['order_totalPrice'];
                }
            }
        }
        $dataView = [
            "title"  => "Cập nhật khách hàng",
            "layOut" => "UpdateCustomer",
            "css"    => ["home","fancybox.min"],
            "data"   => [
                "customerItem" => !empty( $customerItem ) ? $customerItem : null,
                "statusActionCustomer" => !empty( $statusActionCustomer ) ? $statusActionCustomer : null,
                "listOrder" => !empty( $listOrder ) ? $listOrder : null,
                "totalTransactionPrice" => !empty( $totalTransactionPrice ) ? $totalTransactionPrice : 0
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }

    public function LoadListCustomerByField() {
        $fieldName = $_POST['fieldName'];
        $dataAjax = [
            "listData" => $this->CustomerModel->getCustomerByField__model($fieldName)
        ];
        echo json_encode($dataAjax);
    }

    public function searchRecommentByFile() {
        $searchValue = $_POST['searchValue'];
        $fieldName   = $_POST['fieldName'];
        $dataAjax = [
            "searchData" => $this->CustomerModel->searchRecommentByFile_model($fieldName, $searchValue)
        ];
        echo json_encode($dataAjax);
    }
}