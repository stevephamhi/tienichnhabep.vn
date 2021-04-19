<?php

class BrandModel extends DB
{

    private $brandTableName = "tbl_brand";

    public function checkBrandExists($brand_name)
    {
        $numRow = $this->selectSql("{$this->brandTableName}","COUNT(`brand_id`) as `numRow`","WHERE `brand_name` = '{$brand_name}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addBrandNew($dataBrand)
    {
        return $this->insert("{$this->brandTableName}", $dataBrand);
    }

    public function searchBrandByName($strSearch)
    {
        return $this->select("{$this->brandTableName}","","`brand_name` LIKE '%{$strSearch}%'");
    }

    public function getListTotalBrandByStatus($status)
    {
        $where = $status == 'all' ? '' : "`brand_status` = '{$status}'";
        return $this->select("{$this->brandTableName}","",$where);
    }

    public function getBrandByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `brand_status` = '{$status}'";
        $where = "{$status} ORDER BY `brand_name` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->brandTableName}","",$where);
    }

    public function updateBrand($dataBrand, $brand_id)
    {
        return $this->update("{$this->brandTableName}",$dataBrand,"`brand_id` = '{$brand_id}'");
    }

    public function deleteBrand($brand_id)
    {
        return $this->delete("{$this->brandTableName}","`brand_id` = {$brand_id}");
    }

    public function getBrandItemById($brand_id)
    {
        return $this->selectRow("{$this->brandTableName}","","`brand_id` = '{$brand_id}'");
    }

    public function getOrderMax()
    {
        return $this->selectSql("{$this->brandTableName}","MAX(`brand_order`) as `orderMax`","")[0];
    }
}