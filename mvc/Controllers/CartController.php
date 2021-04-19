<?php

class CartController extends BaseController
{

    private $ProductModel;
    private $FlashsaleModel;
    private $CustomerModel;
    private $ConfigModel;
    private $CartModel;
    public $customerItem;

    public function __construct()
    {
        $this->ProductModel   = $this->model("ProductModel");
        $this->FlashsaleModel = $this->model("FlashsaleModel");
        $this->CustomerModel  = $this->model("CustomerModel");
        $this->OrderModel     = $this->model("OrderModel");
        $this->ConfigModel    = $this->model("ConfigModel");
        $this->CartModel      = $this->model("CartModel");
        $customerCore         = new Customer;
        $this->customerItem   = $this->CustomerModel->getCustomerItemByEmail($customerCore->getInfoCustomer("customer_email", Session::get("isLgTP_set")));
    }

    public function index()
    {
        $infoCart = $this->handleGetListInfoCart();
        $customerItem = $this->customerItem;
        $addressOrder = $this->getAddressOrderByCustomer($customerItem['customer_id']);
        $this->view("Frontend.Carts.index", [
            "configInfo"        => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "listProdCartStore" => $infoCart['listProdCartStore'],
            "totalOrder"        => $infoCart['totalOrder'],
            "totalPriceCart"    => $infoCart['totalPriceCart'],
            "addressOrder"      => $addressOrder,
            "customerItem"      => $customerItem
        ]);
    }

    function handleGetListInfoCart()
    {
        $listProdCartStore    = [];
        if( Auth::isLogin() ) {
            $customerItem = $this->customerItem;
            $listProdCartStore = $this->CartModel->getListCartBuyCustomerId($customerItem['customer_id']);
        } else {
            $cartSaveCookie = !empty($_COOKIE['CART_STORE_AT_TIENICHNHABEP']) ? json_decode($_COOKIE['CART_STORE_AT_TIENICHNHABEP'], true) : [];
            if( !empty($cartSaveCookie) ) {
                $listProdCartStore = $cartSaveCookie['buy'];
            }
        }

        if( !empty($listProdCartStore) ) {

            /** ------------------------ ## --------------------- */
            $listProdInCartResult = [];
            $totalOrder           = $this->getNumTotalOrderCart();
            $listFlashSale        = $this->FlashsaleModel->getListFlashSaleInToday(time());
            $listProdInCartResult = [];
            /** ------------------------ ## --------------------- */

            foreach( $listProdCartStore as &$cartProdItem ) {
                $dataProdCart = [
                    "prodInfo" => $this->ProductModel->getProdItemById($cartProdItem['cart_prod_id']),
                    "cart_num_qty" => $cartProdItem['cart_num_qty']
                ];
                $listProdInCartResult[] = $dataProdCart;
            }

            unset($listProdCartStore);
            foreach ( $listProdInCartResult as &$prodInCartResultArrItem ) {
                $prodInCartResultArrItem['prodInfo']['cart_num_qty'] = $prodInCartResultArrItem['cart_num_qty'];
                unset($prodInCartResultArrItem['cart_num_qty']);
                $listProdCartStore[] = $prodInCartResultArrItem['prodInfo'];
            }

            // push flash sale into product
            foreach($listProdCartStore as &$prodItem__1) {
                if(!empty($listFlashSale)) {
                    foreach($listFlashSale as $flashSaleItem) {
                        if($prodItem__1['prod_id'] == $flashSaleItem['prod_flashsale_prodId']) {
                            $prodItem__1['flashSale'][] = $flashSaleItem;
                        }
                    }
                }
            }

            // handle caculator total price of prod cart item
            foreach( $listProdCartStore as &$prodItem__2 ) {
                if( !empty($prodItem__2['flashSale']) ) {
                    $prodItem__2['totalPrice_cart'] = (int) $prodItem__2['flashSale'][0]['prod_flashsale_price'] * (int) $prodItem__2['cart_num_qty'];
                    $prodItem__2['price_cart']      = (int) $prodItem__2['flashSale'][0]['prod_flashsale_price'];
                } else {
                    $prodItem__2['totalPrice_cart'] = (int) $prodItem__2['prod_currentPrice'] * (int) $prodItem__2['cart_num_qty'];
                    $prodItem__2['price_cart']      = (int) $prodItem__2['prod_currentPrice'];
                }
            }

            // handle caculator total price cart
            $totalPriceCart = 0;
            foreach( $listProdCartStore as $prodItem__3 ) {
                $totalPriceCart += (int) $prodItem__3['totalPrice_cart'];
            }
        }

        return [
            "listProdCartStore" => !empty($listProdCartStore) ? $listProdCartStore   : null,
            "totalOrder"        => !empty($totalOrder)        ? $totalOrder          : null,
            "totalPriceCart"    => !empty($totalPriceCart)    ? $totalPriceCart      : "0"
        ];
    }

    public function handleAddCart()
    {
        $cart_prod_id = (int) $_POST['cart_prod_id'];
        $cart_num_qty = (int) $_POST['cart_num_qty'];
        $dataCart = [
            "cart_prod_id" => $cart_prod_id,
            "cart_num_qty" => $cart_num_qty
        ];
        if( Auth::isLogin() ) {
            $dataResult = $this->addCartDatabase($dataCart);
        } else {
            $dataResult = $this->addCartStorage($dataCart);
        }
        $prodItem = $this->ProductModel->getProdItemById($dataCart['cart_prod_id']);

        $prodCart = [
            "prod_avatar" => Config::getBaseUrlAdmin($prodItem['prod_avatar']),
            "prod_name"   => $prodItem['prod_name'],
            "prod_url"    => Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html")
        ];

        $dataAjax = [
            "prodCart"   => $prodCart,
            "status"     => "success",
            "dataResult" => !empty($dataResult) ? $dataResult : null
        ];

        echo json_encode($dataAjax);
    }

    public function addCartDatabase($data)
    {
        $customerItem = $this->customerItem;
        $processCheck = $this->CartModel->checkCartExists($data['cart_prod_id'], $customerItem['customer_id']);
        if( $processCheck['status'] ) {
            $dataCart = [
                "cart_num_qty" => (int) $processCheck['cartInfo']['cart_num_qty'] + (int) $data['cart_num_qty'],
                "cart_createDate_new" => time()
            ];
            $processUpdate = $this->CartModel->updateCart($dataCart, $processCheck['cartInfo']['cart_id']);
        } else {
            $dataCart = [
                "cart_prod_id"        => $data['cart_prod_id'],
                "cart_num_qty"        => $data['cart_num_qty'],
                "cart_customer_id"    => $customerItem['customer_id'],
                "cart_createDate_new" => time()
            ];
            $cart_id = $this->CartModel->addCartNew($dataCart);
        }
        return [
            "totalOrder" => $this->CartModel->getTotalOrderByCustomerId($customerItem['customer_id']),
        ];
    }

    public function addCartStorage($data)
    {
        $cartStore[$data['cart_prod_id']] = [
            "cart_prod_id" => $data['cart_prod_id'],
            "cart_num_qty" => $data['cart_num_qty']
        ];
        $cart_num_qty = $data['cart_num_qty'];
        $cartSaveCookie = !empty($_COOKIE['CART_STORE_AT_TIENICHNHABEP']) ? json_decode($_COOKIE['CART_STORE_AT_TIENICHNHABEP'], true) : [];
        if( !empty($_COOKIE['CART_STORE_AT_TIENICHNHABEP']) && array_key_exists($data['cart_prod_id'], $cartSaveCookie['buy']) ) {
            $cart_num_qty = $cartSaveCookie['buy'][$data['cart_prod_id']]['cart_num_qty'] + $cart_num_qty;
            $cartSaveCookie['buy'][$data['cart_prod_id']]['cart_num_qty'] = $cart_num_qty;
        } else {
            $cartSaveCookie['buy'][$data['cart_prod_id']] = $cartStore[$data['cart_prod_id']];
        }
        $cartSaveCookie['totalOrder'] = $this->getTotalOrderCart($cartSaveCookie);
        setcookie("CART_STORE_AT_TIENICHNHABEP", json_encode($cartSaveCookie), time() + 36000,  '/');
        return [
            "totalOrder" => $cartSaveCookie['totalOrder'],
        ];
    }

    public function getTotalOrderCart($cartSaveCookie)
    {
        $totalOrder = 0;
        if(!empty($cartSaveCookie)) {
            foreach( $cartSaveCookie['buy'] as $cartItem ) {
                $totalOrder += (int) $cartItem['cart_num_qty'];
            }
        }
        return $totalOrder;
    }

    public function handleGetNumTotalOrderCart() {
        $dataAjax = [
            "totalOrder" => $this->getNumTotalOrderCart()
        ];
        echo json_encode($dataAjax);
    }

    public function getNumTotalOrderCart()
    {
        $totalOrder = 0;
        if( Auth::isLogin() ) {
            $customerItem = $this->customerItem;
            $totalOrder   = $this->CartModel->getTotalOrderByCustomerId($customerItem['customer_id']);
        } else {
            $cartSaveCookie = !empty($_COOKIE['CART_STORE_AT_TIENICHNHABEP']) ? json_decode($_COOKIE['CART_STORE_AT_TIENICHNHABEP'], true) : [];
            $totalOrder = $this->getTotalOrderCart($cartSaveCookie);
        }
        return $totalOrder;
    }


    public function handleUpdateNumQtyOrder()
    {
        $qtyCurrent = (int)$_POST['qtyCurrent'];
        $prod_id    = (int)$_POST['prod_id'];
        if(Auth::isLogin()) {
            $customerItem = $this->customerItem;
            $processCheck = $this->CartModel->checkCartExists($prod_id, $customerItem['customer_id']);
            if( $processCheck['status'] ) {
                $dataCart = [
                    "cart_num_qty" => $qtyCurrent
                ];
                $processUpdate = $this->CartModel->updateCart($dataCart, $processCheck['cartInfo']['cart_id']);
                if($processUpdate) {
                    $dataAjax = [
                        "status"  => "success",
                    ];
                } else {
                    $dataAjax = [
                        "status" => "error",
                        "errTxt" => "Cập nhật thông tin giỏ hàng không thành công"
                    ];
                }
            } else {
                $dataAjax = [
                    "status" => "error",
                    "errTxt" => "Không tồn tại sản phẩm này trong giỏ hàng"
                ];
            }
        } else {
            $cartSaveCookie = !empty($_COOKIE['CART_STORE_AT_TIENICHNHABEP']) ? json_decode($_COOKIE['CART_STORE_AT_TIENICHNHABEP'], true) : [];
            if( !empty($_COOKIE['CART_STORE_AT_TIENICHNHABEP']) && array_key_exists($prod_id, $cartSaveCookie['buy']) ) {
                $cartSaveCookie['buy'][$prod_id]['cart_num_qty'] = $qtyCurrent;
                setcookie("CART_STORE_AT_TIENICHNHABEP", json_encode($cartSaveCookie), time() + 36000,  '/');
                $dataAjax = [
                    "status" => "success"
                ];
            } else {
                $dataAjax = [
                    "status" => "error",
                    "errTxt" => "Không tồn tại sản phẩm này trong giỏ hàng"
                ];
            }
        }
        echo json_encode($dataAjax);
    }

    public function handleGetAllInfoCart() {
        $dataAjax = [
            "allInfoCart" => $this->handleGetListInfoCart(),
            "totalPrice"  => Format::formatCurrency($this->handleGetListInfoCart()['totalPriceCart'])
        ];
        echo json_encode($dataAjax);
    }

    public function shipping() {
        $customerItem = $this->customerItem;
        if( !empty( $customerItem ) ) {
            $listAddress = $this->CustomerModel->getListAddressByCustomerId( $customerItem['customer_id'] );
        }
        $this->view("Frontend.Carts.shipping", [
            "configInfo"   => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "listAddress"  => !empty($listAddress) ? $listAddress : null,
            "customerItem" => !empty($customerItem) ? $customerItem : null
        ]);
    }

    public function payment() {
        $infoCart = $this->handleGetListInfoCart();
        $customerItem = $this->customerItem;
        $addressOrder = $this->getAddressOrderByCustomer($customerItem['customer_id']);
        $this->view("Frontend.Carts.payment", [
            "configInfo"   => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "addressOrder" => !empty($addressOrder) ? $addressOrder : null,
            "listProdCartStore" => $infoCart['listProdCartStore'],
            "totalOrder"        => $infoCart['totalOrder'],
            "totalPriceCart"    => $infoCart['totalPriceCart'],
        ]);
    }

    public function getAddressOrderByCustomer($customer_id) {
        $listAddress = $this->CustomerModel->getListAddressByCustomerId($customer_id);
        foreach($listAddress as $addressItem) {
            if(  $addressItem['address_is_select'] == '1' ) {
                return $addressItem;
            }
        }
        foreach($listAddress as $addressItem) {
            if(  $addressItem['address_default'] == '1' ) {
                return $addressItem;
            }
        }
        return [];
    }

    public function deleteCart() {
        $prod_id = (int) $_POST['prod_id'];
        $customerItem = $this->customerItem;
        if( Auth::isLogin() ) {
            $process = $this->CartModel->deleteCartByProdIdAndCustomer($prod_id, $customerItem['customer_id']);
            if($process) {
                $dataAjax = [
                    "status" => "success"
                ];
            } else {
                $dataAjax = [
                    "status" => "error"
                ];
            }
        } else {
            $cartSaveCookie = !empty($_COOKIE['CART_STORE_AT_TIENICHNHABEP']) ? json_decode($_COOKIE['CART_STORE_AT_TIENICHNHABEP'], true) : [];
            if( !empty($cartSaveCookie) ) {
                unset($cartSaveCookie['buy'][$prod_id]);
                setcookie("CART_STORE_AT_TIENICHNHABEP", json_encode($cartSaveCookie), time() + 36000,  '/');
                $dataAjax = [
                    "status" => "success"
                ];
            } else {
                $dataAjax = [
                    "status" => "error"
                ];
            }
        }
        echo json_encode($dataAjax);
    }


    public function handleOrderFromCustomer()
    {
        $infoCustomer          = $_POST['infoCustomer'];
        $paymentMethod         = $_POST['paymentMethod'];
        $customer_note         = $_POST['customer_note'];
        $infoCart              = $this->handleGetListInfoCart();
        $infoCart['timeOrder'] = time();
        if( !empty($infoCustomer) ) {
            $infoCustomer = $infoCustomer;
            $customer_id = null;
        } else {
            $customerItem = $this->customerItem;
            $addressOrder = $this->getAddressOrderByCustomer($customerItem['customer_id']);
            $infoCustomer = [
                "fullname" => $addressOrder['address_fullname'],
                "phone"    => $addressOrder['address_phone'],
                "email"    => $customerItem['customer_email'],
                "address"  => $addressOrder['address_value'],
            ];
            $customer_id = (int) $customerItem['customer_id'];
        }
        $codeOrder                      = $this->createCodeOrder($infoCustomer['phone']);
        $infoCart['codeOrder']          = $codeOrder;
        $infoCustomer['payment_method'] = $paymentMethod;
        $infoCustomer['note']           = $customer_note;
        $infoCustomer['customer_id']    = $customer_id;
        $this->sendMainOrderCustomer( $infoCustomer, $infoCart );
        $process = $this->handleAddOrderNew( $infoCart, $infoCustomer );
        if($process) {
            if(Auth::isLogin()) {
                $this->CartModel->deleteCartByCustomerId($infoCustomer['customer_id']);
            } else {
                Cookie::delete("CART_STORE_AT_TIENICHNHABEP", Cookie::get("CART_STORE_AT_TIENICHNHABEP"), 36000);
            }
            $dataAjax = [
                "status" => "success",
                "baseURL_orderSuccess" => Config::getBaseUrlClient("trang-thai-don-hang.html?donhangID={$infoCart['codeOrder']}")
            ];
        } else {
            $dataAjax = [
                "status" => "error",
            ];
        }
        echo json_encode($dataAjax);
    }

    public function handleAddOrderNew( $infoCart, $infoCustomer )
    {
        $dataOrder = [
            "order_code"              => $infoCart['codeOrder'],
            "order_customer_fullname" => $infoCustomer['fullname'],
            "order_customer_email"    => $infoCustomer['email'],
            "order_customer_phone"    => $infoCustomer['phone'],
            "order_payment_method"    => $infoCustomer['payment_method'],
            "order_customerId_ties"   => $infoCustomer['customer_id'],
            "order_totalPrice"        => $infoCart['totalPriceCart'],
            "order_note"              => $infoCustomer['note'],
            "order_address"           => $infoCustomer['address'],
            "order_createDate"        => $infoCart['timeOrder'],
            "order_status"            => "processing"
        ];
        $order_id = $this->OrderModel->addOrderNew($dataOrder);
        if(is_int($order_id)) {
            foreach ( $infoCart['listProdCartStore'] as $prodCartItem ) {
                $dataOrderItem = [
                    "orderItem_prodId"  => $prodCartItem['prod_id'],
                    "orderItem_orderId" => $order_id,
                    "orderItem_amount"  => $prodCartItem['cart_num_qty'],
                    "orderItem_price"   => $prodCartItem['totalPrice_cart']
                ];
                $this->OrderModel->addOrderItemNew($dataOrderItem);
            }
            return true;
        }
        return false;
    }
    public function order_received_new() {
        $url         = Helper::getUrl();
        $orderCode   = !empty(explode("?donhangID=", $url)[1]) ? explode("?donhangID=", $url)[1] : null;
        $viewOrderStatus = false;
        if(!empty($orderCode)) {
            Session::set("actionRequest", Config::getBaseUrlClient("trang-thai-don-hang.html?donhangID={$orderCode}"));
            $orderItem = $this->OrderModel->getOrderByOrderCode($orderCode);
            if( !empty($orderItem) ) {
                if( !empty($orderItem['order_customerId_ties']) || Auth::isLogin() ) {
                    if( $orderItem['order_customerId_ties'] == $this->customerItem['customer_id'] ) {
                        $viewOrderStatus = true;
                    } else {
                        $viewOrderStatus = false;
                    }
                } else {
                    $viewOrderStatus = true;
                }
                $listOrderItem = $this->OrderModel->getListOrderItemByOrderId($orderItem['order_id']);
                if(!empty($listOrderItem)) {
                    foreach($listOrderItem as &$orderItem_item) {
                        $orderItem_item['prodInfo'] = $this->ProductModel->getProdItemById($orderItem_item['orderItem_prodId']);
                    }
                }
            }
        }
        $this->view("Frontend.Carts.order_received_new" , [
            "configInfo"      => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "orderItem"       => $orderItem,
            "listOrderItem"   => !empty($listOrderItem) ? $listOrderItem : null,
            "viewOrderStatus" => $viewOrderStatus
        ]);
    }

    public function sendMainOrderCustomer( $infoCustomer, $infoCart )
    {
        $dataSendMail = [
            [
                "email"    => $infoCustomer['email'],
                "fullname" => $infoCustomer['fullname'],
                "title"    => "Xác nhận đơn hàng từ tienichnhabep.vn, mã đơn hàng ". $infoCart['codeOrder']  ."",
                "content"  => $this->mailContentOrderCustomer($infoCart, $infoCustomer)
            ],
        ];
        send_mail($dataSendMail[0]);
    }

    public function createCodeOrder($phone)
    {
        $phoneCode = $phone[ strlen($phone) - 3 ] . $phone[ strlen($phone) - 2 ] . $phone[ strlen($phone) - 1 ];
        return "TP{$phoneCode}". rand(100, 999) ."";
    }

    public function handleCancelOrder()
    {
        $order_reason_cancel = $_POST['order_reason_cancel'];
        $order_detail_cancel = $_POST['order_detail_cancel'];
        $order_id            = (int) $_POST['order_id'];
        $dataOrder = [
            "order_status"        => "canceled",
            "order_reason_cancel" => $order_reason_cancel,
            "order_detail_cancel" => $order_detail_cancel
        ];
        $process = $this->OrderModel->updateOrderById($dataOrder, $order_id);
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

    public function mailContentOrderCustomer($infoCart, $infoCustomer)
    {
        return '<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
                <tbody>
                    <tr>
                        <td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="800">
                            <tbody>
                                <tr>
                                    <td align="center" id="m_5107760814148147289headerImage" valign="bottom">
                                    <table cellpadding="0" cellspacing="0" style="border-bottom:3px solid #ff782a;padding-bottom:10px;background-color:#fff" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
                                                    <a href=" ' . Config::getBaseUrlClient() . ' " style="padding: 15px 0 5px 0; display: block; text-decoration: none; letter-spacing: 1px; font-weight: bold; font-size: 1.3rem; color: #ff782a;">TIENICHNHABEP.VN</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                                <tr style="background:#fff">
                                    <td align="left" height="auto" style="padding:15px" width="600">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách '. $infoCustomer['fullname'] .' đã đặt hàng tại Tienichnhabep,</h1>

                                                    <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Tienichnhabep rất vui thông báo đơn hàng '. $infoCart['codeOrder'] .' của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Tienichnhabep sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>

                                                    <h3 style="font-size:13px;font-weight:bold;color:#ff782a;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Thông tin đơn hàng '. $infoCart['codeOrder'] .' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('. Format::formatTimeOrder($infoCart['timeOrder']) .')</span></h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th align="left" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin thanh toán</th>
                                                            <th align="left" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%"> Địa chỉ giao hàng </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'. $infoCustomer['fullname'] .'</span><br>
                                                            <a href="mailto:'. $infoCustomer['email'] .'" target="_blank">'. $infoCustomer['email'] .'</a><br>
                                                            SĐT: '. $infoCustomer['phone'] .'</td>
                                                            <td style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'. $infoCustomer['fullname'] .'</span><br>
                                                            <a href="mailto:'. $infoCustomer['email'] .'" target="_blank">'. $infoCustomer['email'] .'</a><br>
                                                            '. $infoCustomer['address'] .'<br>
                                                            SĐT: '. $infoCustomer['phone'] .'</td>
                                                        </tr>
                                                                                                    <tr>
                                                            <td colspan="2" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
                                                                <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Phương thức thanh toán: </strong> '. $infoCustomer['payment_method'] .'<br></p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao nhận có thể yêu cầu người nhận hàng cung cấp CMND / giấy phép lái xe để chụp ảnh hoặc ghi lại thông tin.</i></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#ff782a">CHI TIẾT ĐƠN HÀNG</h2>
                                                <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th align="left" bgcolor="#ff782a" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                                                            <th align="left" bgcolor="#ff782a" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
                                                            <th align="left" bgcolor="#ff782a" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
                                                            <th align="left" bgcolor="#ff782a" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Giảm giá</th>
                                                            <th align="right" bgcolor="#ff782a" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng giá</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                        '. Mail::RetureListProdCartInfo($infoCart['listProdCartStore']) .'
                                                    </tbody>
                                                    <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                        <tr>
                                                            <td align="right" colspan="4" style="padding:5px 9px">Tạm tính</td>
                                                            <td align="right" style="padding:5px 9px"><span>'. Format::formatCurrency($infoCart['totalPriceCart']) .'</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right" colspan="4" style="padding:5px 9px">Phí vận chuyển</td>
                                                            <td align="right" style="padding:5px 9px">
                                                                <p style="font-size: .7rem; font-style: italic; margin: 2px 0;">Từ 500K miễn phí vận chuyển</p>
                                                                <p style="font-size: .7rem; font-style: italic; margin: 2px 0;">Dưới 500K chúng tôi sẽ liên hệ lại với bạn</p>
                                                                <p style="font-size: .7rem; font-style: italic; margin: 2px 0;">Chưa bao gồm thuế VAT (Thuế giá trị gia tăng)</p>
                                                            </td>
                                                        </tr>
                                                            <tr bgcolor="#eee">
                                                                <td align="right" colspan="4" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
                                                                <td align="right" style="padding:7px 9px"><strong><big><span>'. Format::formatCurrency($infoCart['totalPriceCart']) .'</span> </big> </strong></td>
                                                            </tr>
                                                    </tfoot>
                                                </table>
                                                <div style="margin:auto"><a href="'. Config::getBaseUrlClient("chi-tiet-don-hang.html?donhangID={$infoCart['codeOrder']}") .'" style="display:inline-block;text-decoration:none;background-color:#ff782a!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:35%;margin-top:5px" target="_blank" >Chi tiết đơn hàng tại Tienichnhabep.vn</a></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;
                                                <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Trường hợp quý khách có những băn khoăn về đơn hàng, có thể liên hệ <a href=""> <strong>0708 0708 27</strong>.</a></p>
                                                <p style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Mọi thắc mắc và góp ý, quý khách vui lòng liên hệ với Tienichnhabep qua email <a href="mailTo:tienichnhabep.vn@gmail.com">tienichnhabep.vn@gmail.com</a>. Đội ngũ chăm sóc khách hàngTienichnhabep luôn sẵn sàng hỗ trợ bạn.</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa Tienichnhabep cảm ơn quý khách.</p>
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'. Config::getBaseUrlClient() .'" style="color:#ff782a;text-decoration:none;font-size:14px" target="_blank">Tienichnhabep.vn</a> </strong></p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                        <table width="800">
                            <tbody>
                                <tr>
                                    <td>
                                    <p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#303030;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã mua hàng tại Tienichnhabep.<br>
                                    nếu đây không phải là yêu cầu của quý khách xin vui lòng liên hệ với chúng tôi để có hướng xử lý thỏa đáng. <br>
                                    <b>Văn phòng Tienichnhabep:</b> 104 Lương Nhữ Hộc - Hoà Cường Bắc- Quận Hải Châu - TP Đà Nẵng.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </tbody>
            </table>';
    }
}