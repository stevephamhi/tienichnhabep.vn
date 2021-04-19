<?php


class OrderController extends Controller
{
    private $OrderModel;
    private $CustomerModel;
    private $ProductModel;

    public function __construct()
    {
        $this->OrderModel = $this->model("Order");
        $this->CustomerModel = $this->model('Customer');
        $this->ProductModel = $this->model("Product");
    }

    public function getUrlREQUEST() {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public function handleFilterOrder( $filter_value ) {
        return !empty(explode( "&" ,$filter_value )[0]) ? explode( "&" ,$filter_value )[0] : '';
    }

    public function index( $page = 1 ) {

        $urlREQUEST = $this->getUrlREQUEST();

        $filter_order_code_arr   = explode( "&filter_order_code="   , $urlREQUEST );
        $filter_order_status_arr = explode( "&filter_order_status=" , $urlREQUEST );
        $filter_order_date_arr   = explode( "&filter_order_date="   , $urlREQUEST );
        $filter_customer_arr     = explode( "&filter_customer="     , $urlREQUEST );
        $filter_total_price_arr  = explode( "&filter_total_price="  , $urlREQUEST );
        $filter_update_date_arr  = explode( "&filter_update_date="  , $urlREQUEST );
        $page_arr                = explode( "&page=", $urlREQUEST );

        $filter_order_code   = !empty( $filter_order_code_arr[1] )   ? $this->handleFilterOrder( $filter_order_code_arr[1] )   : null;
        $filter_order_status = !empty( $filter_order_status_arr[1] ) ? $this->handleFilterOrder( $filter_order_status_arr[1] ) : null;
        $filter_order_date   = !empty( $filter_order_date_arr[1] )   ? $this->handleFilterOrder( $filter_order_date_arr[1] )   : null;
        $filter_customer     = !empty( $filter_customer_arr[1] )     ? $this->handleFilterOrder( $filter_customer_arr[1] )     : null;
        $filter_total_price  = !empty( $filter_total_price_arr[1] )  ? $this->handleFilterOrder( $filter_total_price_arr[1] )  : null;
        $filter_update_date  = !empty( $filter_update_date_arr[1] )  ? $this->handleFilterOrder( $filter_update_date_arr[1] )  : null;

        $page       = !empty( $page_arr[1] ) ? $this->handleFilterOrder( $page_arr[1] ) : 1;
        $page       = $page >= 1 ? $page : 1;
        $numPerPage = 10;

        if( !empty($filter_order_code) || !empty($filter_order_status) || !empty($filter_order_date) || !empty($filter_customer) || !empty($filter_total_price) || !empty($filter_update_date) ) {
            $totalOrder = count($this->OrderModel->getListOrderByFilterPagination( $filter_order_code, $filter_order_status, $filter_order_date, $filter_customer, $filter_total_price, $filter_update_date, null, null ));
            $totalPage  = ceil( $totalOrder / $numPerPage );
            $pageStart  = ( $page - 1 ) * $numPerPage;
            $listOrder  = $this->OrderModel->getListOrderByFilterPagination( $filter_order_code, $filter_order_status, $filter_order_date, $filter_customer, $filter_total_price, $filter_update_date, $pageStart, $numPerPage );
        } else {
            $totalOrder = count( $this->OrderModel->getListOrderByStatus('all') );
            $totalPage  = ceil( $totalOrder / $numPerPage );
            $pageStart  = ( $page - 1 ) * $numPerPage;
            $listOrder  = $this->OrderModel->getListOrderByPagination( 'asc', 'order_createDate', $pageStart, $numPerPage );
        }

        $dataView = [
            "title"  => "Danh sách đơn hàng",
            "layOut" => "ListOrder",
            "css"    => ["home"],
            "data"   => [
                "page"       => !empty($page)       ? $page       : null,
                "numPerPage" => !empty($numPerPage) ? $numPerPage : null,
                "totalPage"  => !empty($totalPage)  ? $totalPage  : null,
                "listOrder"  => !empty($listOrder)  ? $listOrder  : null,
                "totalOrder" => !empty($totalOrder) ? $totalOrder : null,
                "filter_value" => [
                    "code"       => !empty( $filter_order_code )   ? $filter_order_code   : null,
                    "status"     => !empty( $filter_order_status ) ? $filter_order_status : null,
                    "createDate" => !empty( $filter_order_date )   ? $filter_order_date   : null,
                    "customer"   => !empty( $filter_customer )     ? $this->CustomerModel->getCustomerById($filter_customer)['customer_fullname'] : null,
                    "totalPrice" => !empty( $filter_total_price )  ? $filter_total_price  : null,
                    "updateDate" => !empty( $filter_update_date )  ? $filter_update_date  : null,
                ],
                "filter" => [
                    "code"       => !empty( $filter_order_code )   ? "&filter_order_code="   . $filter_order_code   : null,
                    "status"     => !empty( $filter_order_status ) ? "&filter_order_status=" . $filter_order_status : null,
                    "createDate" => !empty( $filter_order_date )   ? "&filter_order_date="   . $filter_order_date   : null,
                    "customer"   => !empty( $filter_customer )     ? "&filter_customer="     . $filter_customer     : null,
                    "totalPrice" => !empty( $filter_total_price )  ? "&filter_total_price="  . $filter_total_price  : null,
                    "updateDate" => !empty( $filter_update_date )  ? "&filter_update_date="  . $filter_update_date  : null,
                    "page"       => !empty( $page )                ? $page                                          : null
                ],
            ]
        ];
        $this->view("MasterIndex", $dataView);
    }

    public function getFieldOrderByFieldGet() {
        $fieldGet = $_POST['fieldGet'];
        $dataAjax = [
            "data" => $this->OrderModel->getFieldOrder($fieldGet)
        ];
        echo json_encode($dataAjax);
    }

    public function searchFieldOrder()
    {
        $strSearch = $_POST['strSearch'];
        $fieldSearch = $_POST['fieldSearch'];
        $dataAjax = [
            "data" => $this->OrderModel->searchFieldOrderByFieldSearch($fieldSearch, $strSearch)
        ];
        echo json_encode($dataAjax);
    }

    public function getFieldCustomerByFieldGet()
    {
        $fieldGet = $_POST['fieldGet'];
        $dataAjax = [
            "data" => $this->OrderModel->getFieldCustomer($fieldGet)
        ];
        echo json_encode($dataAjax);
    }

    public function getFieldCustomer()
    {
        $strSearch = $_POST['strSearch'];
        $fieldSearch = $_POST['fieldSearch'];
        $dataAjax = [
            "data" => $this->OrderModel->searchFieldCustomerByFieldSearch($fieldSearch, $strSearch)
        ];
        echo json_encode($dataAjax);
    }

    public function getFieldProdOrderByFieldGet() {
        $dataAjax = [
            "data" => $this->OrderModel->getListProdOrder()
        ];
        echo json_encode($dataAjax);
    }

    public function searchFielProdOrder() {
        $strSearch = $_POST['strSearch'];
        $dataAjax = [
            "data" => $this->OrderModel->searchFieldProdOrderByFieldSearch($strSearch)
        ];
        echo json_encode($dataAjax);
    }

    public function getFieldBrandProdOrderByFieldGet() {
        $dataAjax = [
            "data" => $this->OrderModel->getListProdOrder()
        ];
        echo json_encode($dataAjax);
    }

    public function searchFielBrandProdOrder() {
        $strSearch = $_POST['strSearch'];
        $dataAjax = [
            "data" => $this->OrderModel->searchFieldBrandProdOrderByFieldSearch($strSearch)
        ];
        echo json_encode($dataAjax);
    }

    public function getFieldCateProdOrderByFieldGet() {
        $dataAjax = [
            "data" => $this->OrderModel->getListCateProdOrder()
        ];
        echo json_encode($dataAjax);
    }

    public function searchFielCateProdOrder() {
        $strSearch = $_POST['strSearch'];
        $dataAjax = [
            "data" => $this->OrderModel->searchFieldCateProdOrderByFieldSearch($strSearch)
        ];
        echo json_encode($dataAjax);
    }

    public function getCustomerIdByCustomerFullname() {
        $customer_fullname = $_POST['customer_fullname'];
        if( !empty($customer_fullname) ) {
            $customerItem = $this->CustomerModel->getCustomerByFullname( $customer_fullname );
            $dataAjax = [
                "customer_id" => !empty($customerItem['customer_id']) ? $customerItem['customer_id'] : null
            ];
        } else {
            $dataAjax = [
                "customer_id" => ''
            ];
        }
        echo json_encode($dataAjax);
    }

    public function detail($order_id = 0) {
        $order_id = !empty( $order_id ) ? (int) $order_id : 0;
        $orderInfoItem = $this->OrderModel->getOrderItemById( $order_id );
        if( !empty( $orderInfoItem )) {
            $listOrderitem = $this->OrderModel->getListOrderItemOfOrderByIdOrder( $orderInfoItem['order_id'] );
            if( !empty( $listOrderitem ) ) {
                foreach( $listOrderitem as &$orderItem ) {
                    $orderItem['prodInfo'] = $this->ProductModel->getProdItemById($orderItem['orderItem_prodId']);
                }
            }
        }

        $dataView = [
            "title"  => "Chi tiết đơn hàng",
            "layOut" => "DetailOrder",
            "css"    => ["home"],
            "data"   => [
                "orderInfoItem" => !empty( $orderInfoItem ) ? $orderInfoItem : null,
                "listOrderitem" => !empty( $listOrderitem ) ? $listOrderitem : null,
                "customerInfo"  => !empty( $customerInfo )  ? $customerInfo  : null
            ]
        ];

        $this->view("MasterIndex", $dataView);
    }
    public function saveOrderShippingUnit() {
        $shippingUnitVl   = !empty($_POST['shippingUnitVl'])   ? $_POST['shippingUnitVl']   : null;
        $billLadingCodeVl = !empty($_POST['billLadingCodeVl']) ? $_POST['billLadingCodeVl'] : null;
        $shippingCodeVl   = !empty($_POST['shippingCodeVl'])   ? $_POST['shippingCodeVl']   : null;
        $transportFee     = !empty($_POST['transportFee'])     ? $_POST['transportFee']     : null;
        $order_id         = (int)$_POST['order_id'];
        $dataOrder = [
            "order_shipping_unit"    => $shippingUnitVl,
            "order_bill_lading_code" => $billLadingCodeVl,
            "order_shipping_note"    => $shippingCodeVl,
            "order_transport_fee"    => $transportFee
        ];
        $process = $this->OrderModel->updateOrder( $dataOrder, $order_id );
        if( $process ) {
            $dataAjax = [
                'status' => 'success'
            ];
        } else {
            $dataAjax = [
                'status' => 'error'
            ];
        }
        echo json_encode($dataAjax);
    }

    public function updateStatusOrder() {
        $order_id = (int)$_POST['order_id'];
        $statusVl = $_POST['statusVl'];
        $dataOrder = [
            "order_status" => $statusVl,
        ];
        $process = $this->OrderModel->updateOrder( $dataOrder, $order_id );
        if( $process ) {
            $dataAjax = [
                'status' => 'success'
            ];
        } else {
            $dataAjax = [
                'status' => 'error'
            ];
        }
        echo json_encode($dataAjax);
    }

    public function deleteItem() {
        $order_id = (int) $_POST['order_id'];
        $process = $this->OrderModel->deleteOrderById( $order_id );
        if( $process ) {
            $this->OrderModel->deleteOrderItemByOrder( $order_id );
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

    public function multiDelete() {
        $listIdOrder = $_POST['listIdOrder'];
        $orderDeleteError = [];
        foreach( $listIdOrder as $orderIdItem ) {
            $order_id = (int) $orderIdItem;
            $process = $this->OrderModel->deleteOrderById($order_id);
            if( !$process ) {
                $orderDeleteError[] = $order_id;
            } else {
                $this->OrderModel->deleteOrderItemByOrder( $order_id );
            }
        }
        if( !empty($orderDeleteError) ) {
            $dataAjax = [
                "status" => "error"
            ];
        } else {
            $dataAjax = [
                "status" => "success"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function sendMessageNotificationOrder() {
        $txtNotifi = $_POST['txtNotifi'];
        $order_id  = (int)$_POST['order_id'];
        $dataOrder = [
            "order_notification" => !empty($txtNotifi) ? $txtNotifi : null,
            "order_time_notification" => time()
        ];
        $process = $this->OrderModel->updateOrder($dataOrder, $order_id );
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