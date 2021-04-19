<?php

class CateNewsModel extends DB
{
    private $cateNewsTableName = "tbl_catenews";

    public function getOrderMaxPlus() {
        $numMax = (int)($this->selectSql("{$this->cateNewsTableName}","MAX(`cateNews_order`) as `orderMax`",'')[0]);
        return $numMax['orderMax'] + 1;
    }

    public function checkCateNewsExist($cateNews_name, $cateNews_parentId) {
        $numRow = $this->selectSql("{$this->cateNewsTableName}","COUNT(`cateNews_id`) as `numRow`","WHERE `cateNews_name` = '{$cateNews_name}' AND `cateNews_parentId` = '{$cateNews_parentId}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addCateNewsNew($dataCateNews)
    {
        return $this->insert("{$this->cateNewsTableName}", $dataCateNews);
    }

    public function getMultiLevelCateNews($listCateNews, $parentId = 0, $level = 0)
    {
        $result = [];
        foreach($listCateNews as $cateNewsItem) {
            if($cateNewsItem['cateNews_parentId'] == $parentId) {
                $cateNewsItem['level'] = $level;
                $result[] = $cateNewsItem;
                unset($listCateNews[$cateNewsItem['cateNews_id']]);
                $child   = $this->getMultiLevelCateNews($listCateNews, $cateNewsItem['cateNews_id'], $level+1);
                $result  = array_merge($result, $child);
            }
        }
        return $result;
    }

    public function getListTotalCateNews()
    {
        return $this->select("{$this->cateNewsTableName}","","");
    }

    public function searchCateNewsByName($vlSearch)
    {
        return $this->select("{$this->cateNewsTableName}","","`cateNews_name` LIKE '%{$vlSearch}%'");
    }

    public function getListCateNewsByStatus($status)
    {
        $where = $status == 'all' ? '' : "`cateNews_status` = '{$status}'";
        return $this->select("{$this->cateNewsTableName}","",$where);
    }

    public function getCateNewsByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `cateNews_status` = '{$status}'";
        $where = "{$status} ORDER BY `cateNews_name` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->cateNewsTableName}","",$where);
    }

    public function updateCateNews($dataCateNews, $cateNews_id)
    {
        return $this->update("{$this->cateNewsTableName}",$dataCateNews,"`cateNews_id` = '{$cateNews_id}'");
    }

    public function deleteCateNews($cateNews_id)
    {
        return $this->delete("{$this->cateNewsTableName}","`cateNews_id` = {$cateNews_id}");
    }

    public function getCateNewsById($cateNews_id)
    {
        return $this->selectRow("{$this->cateNewsTableName}","","`cateNews_id` = '{$cateNews_id}'");
    }
}