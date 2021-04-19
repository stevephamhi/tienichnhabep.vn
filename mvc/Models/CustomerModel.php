<?php

class CustomerModel extends Database
{

    const TABLE_CUSTOMER    = "tbl_customer";
    const TABLE_SP_CUSTOMER = "tbl_sp_customer";
    const TABLE_ADDRESS     = "tbl_address";

    public function addCustomerNew($dataCustomer) {
        return $this->insert(self::TABLE_CUSTOMER, $dataCustomer);
    }

    public function checkFieldInTableCustomerExists($fieldCheck, $dataCheck)
    {
        $sql = "SELECT `customer_id` FROM ". self::TABLE_CUSTOMER ." WHERE `{$fieldCheck}` = '{$dataCheck}'";
        $numRow = $this->getNumRow($sql);
        if($numRow > 0) return true;
        return false;
    }

    public function resetDefaultAddress($customer_id)
    {
        $dataAddress = [
            'address_default' => '0'
        ];
        $this->update(self::TABLE_ADDRESS, $dataAddress, "`address_customer_id` = '{$customer_id}'");
    }

    public function resetInfoAddressByCustomerId($dataAddress, $customer_id) {
        return $this->update(self::TABLE_ADDRESS, $dataAddress, "`address_customer_id` = '{$customer_id}'");
    }

    public function checkCustomerAddressExists( $customer_address, $customer_id ) {
        $sql = "SELECT `address_id` FROM " . self::TABLE_ADDRESS . " WHERE `address_value` = '{$customer_address}' AND `address_customer_id` = '{$customer_id}'";
        $numRow = $this->getNumRow($sql);
        if($numRow > 0) return true;
        return false;
    }

    public function getListAddressByCustomerId( $customer_id )
    {
        return $this->selectAll(self::TABLE_ADDRESS,"`address_customer_id` = '{$customer_id}'");
    }

    public function add_addressNew( $dataAddress ) {
        return $this->insert(self::TABLE_ADDRESS, $dataAddress);
    }

    public function updateCustomer($dataCustomer, $customer_id) {
        return $this->update(self::TABLE_CUSTOMER, $dataCustomer, "`customer_id` = '$customer_id'");
    }

    public function addSupportCustomerNew( $dataSpCustomer )
    {
        return $this->insert(self::TABLE_SP_CUSTOMER, $dataSpCustomer);
    }

    public function checkCustomerExists( $fullname, $phone )
    {
        $sql = "SELECT `customer_id` FROM " . self::TABLE_CUSTOMER . " WHERE `customer_fullname` = '{$fullname}' AND `customer_phone` = '{$phone}'";
        $customerItem = $this->selectRow($sql);
        if( !empty($customerItem) ) return $customerItem['customer_id'];
        return null;
    }


    public function getCustomerItemByToken($tokenType, $token)
    {
        $sql = "SELECT * FROM " . self::TABLE_CUSTOMER . " WHERE `{$tokenType}` = '{$token}'";
        return $this->selectRow($sql);
    }

    public function checkPhoneExists($phone) {
        $sql    = "SELECT `customer_id` FROM " . self::TABLE_CUSTOMER . " WHERE `customer_phone` = '{$phone}'";
        $numRow = $this->getNumRow($sql);
        if( $numRow > 0 ) return true;
        else return false;
    }


    public function getCustomerItemByEmail($customer_email) {
        $sql = "SELECT * FROM ". self::TABLE_CUSTOMER ." WHERE `customer_email` = '{$customer_email}'";
        return $this->selectRow($sql);
    }

    public function checkEmailExists($email) {
        $sql    = "SELECT `customer_id` FROM " . self::TABLE_CUSTOMER . " WHERE `customer_email` = '{$email}'";
        $numRow = $this->getNumRow($sql);
        if( $numRow > 0 ) return true;
        else return false;
    }

    public function updateAddress($dataAddress, $address_id)
    {
        return $this->update(self::TABLE_ADDRESS, $dataAddress, "`address_id` = '{$address_id}'");
    }

    public function deleteAddressItemById( $address_id )
    {
        return $this->delete(self::TABLE_ADDRESS, "`address_id` = '{$address_id}'");
    }

    public function getCustomerById($customer_id)
    {
        $sql = "SELECT * FROM " . self::TABLE_CUSTOMER . " WHERE `customer_id` = '{$customer_id}'";
        return $this->selectRow($sql);
    }

    public function confirmPassword($customer_password_old, $customer_id)
    {
        $customerItem = $this->getCustomerById($customer_id);
        if( password_verify($customer_password_old, $customerItem['customer_password']) ) {
            return true;
        } else {
            return false;
        }
    }

    public function checkLogin( $customer_phone_or_email, $customer_password )
    {
        $sql = "SELECT * FROM ". self::TABLE_CUSTOMER ." WHERE `customer_email` = '{$customer_phone_or_email}' OR `customer_phone` = '{$customer_phone_or_email}'";
        $customerItem = $this->selectRow($sql);
        if( !empty($customerItem) ) {
            if( $customerItem['customer_is_active'] == '1' ) {
                if( $customerItem['customer_status'] !== 'disable' ) {
                    $passwordConfig = md5($customer_password).md5($customerItem['customer_createDate']);
                    if( password_verify($passwordConfig, $customerItem['customer_password']) ) {
                        return [
                            'status'       => true,
                            'customerItem' => $customerItem
                        ];
                    }
                } else {
                    return [
                        'status' => false,
                        "error"  => "<span class='error'>* Tài khoảng đã bị vô hiệu hóa</span>"
                    ];
                }
            } else {
                return [
                    'status' => false,
                    "error"  => "<span class='error'>* Tài khoảng chưa được xác nhận, vui lòng kiểm tra email</span>"
                ];
            }
        } return [
            'status' => false,
            "error"  => "<span class='error'>* Đăng nhập không thành công</span>"
        ];
    }
}