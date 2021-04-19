<?php

class ProductspModel extends DB
{
    private $prodspTableName = "tbl_prodsp";

    public function checkProdspExists($prodsp_name)
    {
        $numRow = $this->selectSql("{$this->prodspTableName}","COUNT(`prodsp_id`) as `numRow`","WHERE `prodsp_name` = '{$prodsp_name}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function getProdSupportInfoById($infoSpProd_id)
    {
        return $this->selectRow("{$this->prodspTableName}","","`prodsp_id` = '{$infoSpProd_id}'");
    }

    public function addProdspNew($dataProdsp)
    {
        return $this->insert("{$this->prodspTableName}", $dataProdsp);
    }

    public function getOrderMax()
    {
        return $this->selectSql("{$this->prodspTableName}","MAX(`prodsp_order`) as `orderMax`","")[0];
    }

    public function getListProdspByStatus($status)
    {
        $where = $status == 'all' ? '' : "`prodsp_status` = '{$status}'";
        return $this->select("{$this->prodspTableName}","",$where);
    }

    public function getProdspByPagination($orderBy, $orderByField, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `prodsp_status` = '{$status}'";
        $where = "{$status} ORDER BY `{$orderByField}` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->prodspTableName}","",$where);
    }

    public function updateProdsp($dataProdsp, $prodsp_id)
    {
        return $this->update("{$this->prodspTableName}",$dataProdsp,"`prodsp_id` = '{$prodsp_id}'");
    }

    public function deleteProdsp($prodsp_id)
    {
        return $this->delete("{$this->prodspTableName}","`prodsp_id` = {$prodsp_id}");
    }

    public function searchProdspByName($vlSearch)
    {
        return $this->select("{$this->prodspTableName}","","`prodsp_name` LIKE '%{$vlSearch}%'");
    }
}