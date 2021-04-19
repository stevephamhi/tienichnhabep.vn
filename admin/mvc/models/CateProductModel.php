<?php

class CateProductModel extends DB
{
    private $cateProdTableName = "tbl_cateprod";

    public function getOrderMaxPlus()
    {
        $numMax = ($this->selectSql("{$this->cateProdTableName}","MAX(`cateProd_order`) as `orderMax`",'')[0]);
        return @$numMax['orderMax'] + 1;
    }

    public function addCateNew($dataCateProd)
    {
        return $this->insert("{$this->cateProdTableName}", $dataCateProd);
    }

    public function getListTotalCateProd()
    {
        return $this->select("{$this->cateProdTableName}","","");
    }

    public function getMultiLevelCateProd($listCatePord, $parentId = 0, $level = 0)
    {
        $result = [];
        foreach($listCatePord as $cateProdItem) {
            if($cateProdItem['cateProd_parentId'] == $parentId) {
                $cateProdItem['level'] = $level;
                $result[] = $cateProdItem;
                unset($listCatePord[$cateProdItem['cateProd_id']]);
                $child   = $this->getMultiLevelCateProd($listCatePord, $cateProdItem['cateProd_id'], $level+1);
                $result  = array_merge($result, $child);
            }
        }
        return $result;
    }

    public function checkCateProdExist($cateProd_name, $cateProd_parentId)
    {
        $numRow = $this->selectSql("{$this->cateProdTableName}","COUNT(`cateProd_id`) as `numRow`","WHERE `cateProd_name` = '{$cateProd_name}' AND `cateProd_parentId` = '{$cateProd_parentId}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function getListCateProdByStatus($status)
    {
        $where = $status == 'all' ? '' : "`cateProd_status` = '{$status}'";
        return $this->select("{$this->cateProdTableName}","",$where);
    }

    public function getCateProdByPagination($orderBy, $orderByField, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `cateProd_status` = '{$status}'";
        $where = "{$status} ORDER BY `{$orderByField}` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->cateProdTableName}","",$where);
    }

    public function getCateProdItemById($cateProd_id)
    {
        return $this->selectRow("{$this->cateProdTableName}","","`cateProd_id` = '{$cateProd_id}'");
    }

    public function getCateProdItemByField($fieldName, $strSearch)
    {
        return $this->selectRow("{$this->cateProdTableName}",["cateProd_id"],"`{$fieldName}` LIKE '%{$strSearch}%'");
    }

    public function updateCateProd($dataCateProd, $cateProd_id)
    {
        return $this->update("{$this->cateProdTableName}",$dataCateProd,"`cateProd_id` = '{$cateProd_id}'");
    }

    public function deleteCateProd($cateProd_id)
    {
        return $this->delete("{$this->cateProdTableName}","`cateProd_id` = {$cateProd_id}");
    }

    public function searchCateProdByName($vlSearch)
    {
        return $this->select("{$this->cateProdTableName}","","`cateProd_name` LIKE '%{$vlSearch}%'");
    }

    public function loadCateProductByField($fieldName)
    {
        return $this->select("{$this->cateProdTableName}",[$fieldName],"");
    }

    public function searchRecommentByFile($fieldName, $searchValue)
    {
        return $this->select("{$this->cateProdTableName}",[$fieldName],"`{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function getCateProdByParentCateId($parentCate_id)
    {
        return $this->select("{$this->cateProdTableName}","","`cateProd_parentId` = '{$parentCate_id}'");
    }
}