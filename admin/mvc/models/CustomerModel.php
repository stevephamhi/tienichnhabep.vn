<?php

class CustomerModel extends DB
{
    private $customerGroupTableName = "tbl_customergroup";
    private $customerTable = "tbl_customer";

    public function getCustomerGroupItemById($customerGroup_id)
    {
        return $this->selectRow("{$this->customerGroupTableName}","","`customerGroup_id` = '{$customerGroup_id}'");
    }

    public function getListCustomerGroupByStatus($status)
    {
        $where = $status == 'all' ? '' : "`prod_flashsale_status` = '{$status}'";
        return $this->select("{$this->customerGroupTableName}","",$where);
    }

    public function getCustomerById( $customer_id )
    {
        return $this->selectRow("{$this->customerTable}","","`customer_id` = '{$customer_id}'");
    }

    public function getCustomerByFullname( $customer_fullname )
    {
        return $this->selectRow("{$this->customerTable}","","`customer_fullname` LIKE '%{$customer_fullname}%'");
    }

    public function getListCustomerByStatus( $status )
    {
        $where = $status == 'all' ? '' : "`customer_status` = '{$status}'";
        return $this->select("{$this->customerTable}","",$where);
    }

    public function getListCustomerByPagination( $orderBy, $status, $pageStart, $numPerPage )
    {
        $status = $status == 'all' ? '' : "WHERE `customer_status` = '{$status}'";
        $where = "{$status} ORDER BY `customer_createDate` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->customerTable}","",$where);
    }

    public function updateCustomer( $dataCustomer, $customer_id ) {
        return $this->update("{$this->customerTable}", $dataCustomer, "`customer_id` = '{$customer_id}'");
    }

    public function getCustomerByField__model($fieldName)
    {
        return $this->select("{$this->customerTable}", [$fieldName], "");
    }

    public function searchRecommentByFile_model($fieldName, $searchValue)
    {
        return $this->select("{$this->customerTable}", "", "`{$fieldName}` LIKE '%{$searchValue}%'");
    }
}