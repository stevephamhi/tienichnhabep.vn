<?php

class VideoGroupModel extends DB
{
    private $VideoGroupTableName = "tbl_videogroup";
    private $VideoTableName = "tbl_video";


    public function getOrderMaxPlus()
    {
        $numMax = (int)($this->selectSql("{$this->VideoGroupTableName}","MAX(`videoGroup_order`) as `orderMax`",'')[0]);
        return $numMax['orderMax'] + 1;
    }

    public function checkVideoGroupExists($videoGroup_name, $videoGroup_startDate, $videoGroup_endDate)
    {
        $numRow = $this->selectSql("{$this->VideoGroupTableName}","COUNT(`videoGroup_id`) as `numRow`","WHERE `videoGroup_name` = '{$videoGroup_name}' AND `videoGroup_startDate` = '{$videoGroup_startDate}' AND `videoGroup_endDate` = '{$videoGroup_endDate}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addVideoGroupNew($dataVideoGroup)
    {
        return $this->insert("{$this->VideoGroupTableName}", $dataVideoGroup);
    }

    public function addVideoNew($dataVideo)
    {
        return $this->insert("{$this->VideoTableName}", $dataVideo);
    }

    public function getListVideoGroupByStatus($status)
    {
        $where = $status == 'all' ? '' : "`videoGroup_status` = '{$status}'";
        return $this->select("{$this->VideoGroupTableName}","",$where);
    }

    public function getListVideoGroupByPagination($orderBy, $orderByField, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `videoGroup_status` = '{$status}'";
        $where = "{$status} ORDER BY `{$orderByField}` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->VideoGroupTableName}","",$where);
    }

    public function updateVideoGroup($dataDisplay, $videoGroupID)
    {
        return $this->update("{$this->VideoGroupTableName}",$dataDisplay,"`videoGroup_id` = '{$videoGroupID}'");
    }

    public function deleteVideoGroup($videoGroup_id)
    {
        return $this->delete("{$this->VideoGroupTableName}","`videoGroup_id` = {$videoGroup_id}");
    }

    public function deleteTotalVideoByIdVideoGroup($videoGroup_id)
    {
        return $this->delete("{$this->VideoTableName}","`video_videoGroupId_ties` = {$videoGroup_id}");
    }

    public function searchVideoGroupByName($vlSearch)
    {
        return $this->select("{$this->VideoGroupTableName}","","`videoGroup_name` LIKE '%{$vlSearch}%'");
    }

    public function getVideoGroupItemById($videoGroup_id)
    {
        return $this->selectRow("{$this->VideoGroupTableName}","","`videoGroup_id` = '{$videoGroup_id}'");
    }

    public function getVideoInfoByIdVideoGroup($videoGroup_id)
    {
        return $this->selectRow("{$this->VideoTableName}","","`video_videoGroupId_ties` = '{$videoGroup_id}'");
    }

}