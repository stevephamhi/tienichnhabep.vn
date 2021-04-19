<?php

class GroupBannerModel extends DB
{

    private $GroupBannerTable = "tbl_bannergroup";
    private $BannerTable      = "tbl_banner";

    public function getOrderMaxPlus()
    {
        $numMax = (int)($this->selectSql("{$this->GroupBannerTable}","MAX(`bannerGroup_order`) as `orderMax`",'')[0]);
        return $numMax['orderMax'] + 1;
    }

    public function checkGroupBannerExists($bannerGroup_name, $bannerGroup_startDate, $bannerGroup_endDate)
    {
        $numRow = $this->selectSql("{$this->GroupBannerTable}","COUNT(`bannerGroup_id`) as `numRow`","WHERE `bannerGroup_name` = '{$bannerGroup_name}' AND `bannerGroup_startDate` = '{$bannerGroup_startDate}' AND `bannerGroup_endDate` = '{$bannerGroup_endDate}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addGroupBannerNew($dataGroupBanner)
    {
        return $this->insert("{$this->GroupBannerTable}", $dataGroupBanner);
    }

    public function addBannerNew($dataBanner)
    {
        return $this->insert("{$this->BannerTable}", $dataBanner);
    }

    public function getListBannerGroupByStatusAndType($type, $status)
    {
        $where = $status == 'all' ? "`bannerGroup_type` = '{$type}'" : "`bannerGroup_status` = '{$status}' AND `bannerGroup_type` = '{$type}'";
        return $this->select("{$this->GroupBannerTable}","",$where);
    }

    public function getListGroupBannerByPagination($orderBy, $status, $pageStart, $numPerPage, $type)
    {
        $status = $status == 'all' ? "WHERE `bannerGroup_type` = '{$type}'" : "WHERE `bannerGroup_status` = '{$status}' AND `bannerGroup_type` = '{$type}'";
        $where = "{$status} ORDER BY `bannerGroup_name` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->GroupBannerTable}","",$where);
    }

    public function updateGroupBanner($dataGroupBanner, $groupBanner_id)
    {
        return $this->update("{$this->GroupBannerTable}",$dataGroupBanner,"`bannerGroup_id` = '{$groupBanner_id}'");
    }

    public function deleteGroupBanner($GroupBanner_id)
    {
        return $this->delete("{$this->GroupBannerTable}","`bannerGroup_id` = {$GroupBanner_id}");
    }

    public function deleteTotalBannerByGroupBannerId($GroupBanner_id)
    {
        return $this->delete("{$this->BannerTable}","`banner_groupBannerId_ties` = '{$GroupBanner_id}'");
    }

    public function getGroupBannerItemById($groupBanner_id)
    {
        return $this->selectRow("{$this->GroupBannerTable}","","`bannerGroup_id` = '{$groupBanner_id}'");
    }

    public function getListBannerByGroupBannerId($groupBanner_id)
    {
        return $this->select("{$this->BannerTable}","","`banner_groupBannerId_ties` = '{$groupBanner_id}'");
    }

    public function searchGroupBannerByName($vlSearch, $groupType)
    {
        return $this->select("{$this->GroupBannerTable}","","`bannerGroup_name` LIKE '%{$vlSearch}%' AND `bannerGroup_type` = '{$groupType}'");
    }

    public function getListTotalGroupBannerByGroupBannerType($groupType)
    {
        return $this->select("{$this->GroupBannerTable}","","`bannerGroup_type` = '{$groupType}'");
    }

}