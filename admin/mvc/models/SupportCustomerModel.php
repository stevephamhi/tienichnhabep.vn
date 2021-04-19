<?php

class SupportCustomerModel extends DB
{
    private $table_support_customer = "tbl_sp_customer";

    public function getListSupportcustomerByStatus($status)
    {
        $where = $status == 'all' ? '' : "`sp_customer_status` = '{$status}'";
        return $this->select("{$this->table_support_customer}","",$where);
    }

    public function getListSupportcustomerByPagination($orderBy, $orderByField, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `sp_customer_status` = '{$status}'";
        $where = "{$status} ORDER BY `{$orderByField}` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->table_support_customer}","",$where);
    }

    public function deleteSupportcustomer($sp_customer_id)
    {
        return $this->delete("{$this->table_support_customer}","`sp_customer_id` = {$sp_customer_id}");
    }

    public function loadSupportcustomerByField__model($fieldName)
    {
        return $this->select("{$this->table_support_customer}", [$fieldName], "");
    }

    public function searchRecommentByFile($fieldName, $searchValue)
    {
        return $this->select("{$this->table_support_customer}", "", "`{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function getSupportCustomerItemById($sp_customer_id)
    {
        return $this->selectRow("{$this->table_support_customer}", "", "`sp_customer_id` = '{$sp_customer_id}'");
    }

    public function updateSupportcustomer( $dataSupportcustomer, $sp_customer_id )
    {
        return $this->update("{$this->table_support_customer}", $dataSupportcustomer, "`sp_customer_id` = '{$sp_customer_id}'");
    }

}