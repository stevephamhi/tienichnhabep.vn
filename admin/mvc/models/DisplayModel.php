<?php

class DisplayModel extends DB
{
    private $DisplayTableName = "tbl_display";

    public function getOrderMaxPlus()
    {
        $numMax = (int)($this->selectSql("{$this->DisplayTableName}","MAX(`display_order`) as `orderMax`",'')[0]);
        return $numMax['orderMax'] + 1;
    }

    public function dislayExists($display_title)
    {
        $numRow = $this->selectSql("{$this->DisplayTableName}","COUNT(`display_id`) as `numRow`","WHERE `display_title` = '{$display_title}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addDisplayNew($dataDisplay)
    {
        return $this->insert("{$this->DisplayTableName}",$dataDisplay);
    }

    public function getListDisplayByStatus($status)
    {
        $where = $status == 'all' ? '' : "`display_status` = '{$status}'";
        return $this->select("{$this->DisplayTableName}","",$where);
    }

    public function getListDisplayByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `display_status` = '{$status}'";
        $where = "{$status} ORDER BY `display_order` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->DisplayTableName}","",$where);
    }

    public function updateDisplay($dataDisplay, $displayID)
    {
        return $this->update("{$this->DisplayTableName}",$dataDisplay,"`display_id` = '{$displayID}'");
    }

    public function deleteDisplay($display_id)
    {
        return $this->delete("{$this->DisplayTableName}","`display_id` = {$display_id}");
    }

    public function searchDisplayByName($vlSearch)
    {
        return $this->select("{$this->DisplayTableName}","","`display_title` LIKE '%{$vlSearch}%'");
    }

    public function getDisplayItemById($display_id)
    {
        return $this->selectRow("{$this->DisplayTableName}","","`display_id` = '{$display_id}'");
    }

}