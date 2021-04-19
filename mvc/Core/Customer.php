<?php

class Customer extends Database
{
    public function getInfoCustomer( $field, $dataCheck ) {
        if( !empty( $field ) ) {
            $sql = "SELECT * FROM `tbl_customer` WHERE `customer_is_active` = '1'";
            $listCustomer = $this->selectByQuery($sql);
            $customerFind = [];
            foreach( $listCustomer as $customerItem ) {
                if( md5($customerItem['customer_email']) == $dataCheck ) {
                    $customerFind = $customerItem;
                    break;
                }
            }
            if( !empty($customerFind) ) {
                return $customerFind[$field];
            }
        } return false;
    }
}