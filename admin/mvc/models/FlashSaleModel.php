<?php

class FlashSaleModel extends DB
{
    private $flashSaleTableName = "tbl_prod_flashsale_ties";

    public function getListFlashSaleByStatus($status)
    {
        $where = $status == 'all' ? '' : "`prod_flashsale_status` = '{$status}'";
        return $this->select("{$this->flashSaleTableName}","",$where);
    }

    public function getFlashSaleByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `prod_flashsale_status` = '{$status}'";
        $where = "{$status} ORDER BY `prod_flashsale_dateStart` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->flashSaleTableName}","",$where);
    }

    public function addFlashSaleNew($dataFlashSale)
    {
        return $this->insert("{$this->flashSaleTableName}", $dataFlashSale);
    }

    public function updateFlashSale($dataFlashSale, $flashSale_id)
    {
        return $this->update("{$this->flashSaleTableName}",$dataFlashSale,"`prod_flashsale_id` = '{$flashSale_id}'");
    }

    public function deleteFlashSale($flashSale_id)
    {
        return $this->delete("{$this->flashSaleTableName}","`prod_flashsale_id` = {$flashSale_id}");
    }

    public function getFlashSaleItemById($flashSale_id)
    {
        return $this->selectRow("{$this->flashSaleTableName}","","`prod_flashsale_id` = '{$flashSale_id}'");
    }

    public function getOrderMax()
    {
        return $this->selectSql("{$this->flashSaleTableName}","MAX(`prod_flashsale_order`) as `orderMax`","")[0];
    }

    public function getListFlashSaleByTime($time)
    {
        return $this->select("{$this->flashSaleTableName}","","`prod_flashsale_dateStart` <= '{$time}' AND `prod_flashsale_dateEnd` >= '{$time}'");
    }
}