<?php

class BackgroundModel extends DB
{

    private $BackgroundTableName = "tbl_background";

    public function getOrderMaxPlus()
    {
        $numMax = (int)($this->selectSql("{$this->BackgroundTableName}","MAX(`background_order`) as `orderMax`",'')[0]);
        return $numMax['orderMax'] + 1;
    }

    public function checkBackgroundExists($background_startDate, $background_endDate)
    {
        $numRow = $this->selectSql("{$this->BackgroundTableName}","COUNT(`background_id`) as `numRow`","WHERE `background_startDate` = '{$background_startDate}' AND `background_endDate` = '{$background_endDate}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addBackgroundNew($dataBackground)
    {
        return $this->insert("{$this->BackgroundTableName}", $dataBackground);
    }

    public function getListBackgroundByStatus($status)
    {
        $where = $status == 'all' ? '' : "`background_status` = '{$status}'";
        return $this->select("{$this->BackgroundTableName}","",$where);
    }

    public function getListBackgroundByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `background_status` = '{$status}'";
        $where = "{$status} ORDER BY `background_name` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->BackgroundTableName}","",$where);
    }

    public function updateBackground($dataBackground, $background_id)
    {
        return $this->update("{$this->BackgroundTableName}",$dataBackground,"`background_id` = '{$background_id}'");
    }

    public function deleteBackground($background_id)
    {
        return $this->delete("{$this->BackgroundTableName}","`background_id` = {$background_id}");
    }
    public function searchBackgroundByName($vlSearch)
    {
        return $this->select("{$this->BackgroundTableName}","","`background_name` LIKE '%{$vlSearch}%'");
    }

    public function getBackgroundItemById($background_id)
    {
        return $this->selectRow("{$this->BackgroundTableName}","","`background_id` = '{$background_id}'");
    }
}