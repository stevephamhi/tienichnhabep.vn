<?php

class CustomerController extends BaseController
{
    private $CustomerModel;
    public $customerItem;

    public function __construct()
    {
        $this->CustomerModel = $this->model("CustomerModel");
        $customerCore = new Customer;
        $this->customerItem = $this->CustomerModel->getCustomerItemByEmail($customerCore->getInfoCustomer("customer_email", Session::get("isLgTP_set")));
    }

    public function customersSskingForSupport()
    {
        $gender_vl   = !empty($_POST['gender_vl'])   ? $_POST['gender_vl']     : null;
        $fullname_vl = !empty($_POST['fullname_vl']) ? $_POST['fullname_vl']   : null;
        $phone_vl    = !empty($_POST['phone_vl'])    ? $_POST['phone_vl']      : null;
        $prod_id     = !empty($_POST['prod_id'])     ? (int) $_POST['prod_id'] : null;
        $dataSpCustomer = [
            "sp_customer_fullname" => $fullname_vl,
            "sp_customer_phone"    => $phone_vl,
            "sp_customer_gender"   => $gender_vl,
            "sp_customer_time"     => time(),
            "sp_customer_status"   => "no_process",
            "sp_customer_prodid"   => $prod_id
        ];
        $sp_customer_id  = $this->CustomerModel->addSupportCustomerNew( $dataSpCustomer );
        if(is_int($sp_customer_id)) {
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

    public function add_customerAddress() {
        $customer_address = $_POST['customer_address'];
        $customer_phone = $_POST['customer_phone'];
        $customer_fullname = $_POST['customer_fullname'];
        $isDefault = $_POST['isDefault'];
        $customer_id = $_POST['customer_id'];
        if( !$this->CustomerModel->checkCustomerAddressExists( $customer_address, $customer_id ) ) {
            $dataAddress = [
                "address_value"       => $customer_address,
                "address_fullname"    => $customer_fullname,
                "address_customer_id" => $customer_id,
                "address_phone"       => $customer_phone,
                "address_default"     => $isDefault,
            ];
            if( $isDefault == '1' ) {
                $this->CustomerModel->resetInfoAddressByCustomerId(['address_default' => '0'], $customer_id);
            }
            $address_id = $this->CustomerModel->add_addressNew( $dataAddress );
            if( is_int($address_id) ) {
                $dataAjax = [
                    "status" => "success",
                ];
            } else {
                $dataAjax = [
                    "status" => "error",
                    "txtErr" => "* Thêm địa chỉ không thành công"
                ];
            }
        } else {
            $dataAjax = [
                "status" => "error",
                "txtErr" => "* Địa chỉ đã tồn tại"
            ];
        }
        echo json_encode($dataAjax);
    }

    public function update_customerAddress()
    {
        $isDefault      = $_POST['isDefault'];
        $address_id     = $_POST['address_id'];
        $fullname_value = $_POST['fullname_value'];
        $address_value  = $_POST['address_value'];
        $phone_value    = $_POST['phone_value'];
        $customer_id    = (int) $_POST['customer_id'];
        $dataAddress = [
            "address_fullname" => $fullname_value,
            "address_value"    => $address_value,
            "address_phone"    => $phone_value,
            "address_default"  => $isDefault,
        ];
        if( $isDefault == '1' ) {
            $this->CustomerModel->resetDefaultAddress($customer_id);
        }
        $process = $this->CustomerModel->updateAddress($dataAddress, $address_id);
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

    public function handleDeleteAddress() {
        $address_id = (int)$_POST['address_id'];
        $process = $this->CustomerModel->deleteAddressItemById( $address_id );
        if( $process ) {
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

    public function handleSelectAddressOrder() {
        $address_id = (int) $_POST['address_id'];
        $customerItem = $this->customerItem;
        $processReset = $this->CustomerModel->resetInfoAddressByCustomerId(["address_is_select" => '0'], $customerItem['customer_id']);
        if($processReset) {
            $processUpdate = $this->CustomerModel->updateAddress(["address_is_select" => '1'], $address_id);
            if($processUpdate) {
                $dataAjax = [
                    "status" => "success",
                    "nextSite" => Config::getBaseUrlClient("phuong-thuc-thanh-toan.html")
                ];
            } else {
                $dataAjax = [
                    "status" => "error"
                ];
            }
        } else {
            $dataAjax = [
                "status" => "error",
            ];
        }
        echo json_encode($dataAjax);
    }
}