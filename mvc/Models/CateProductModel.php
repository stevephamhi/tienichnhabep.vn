<?php

class CateProductModel extends Database
{
    const TABLE_CATE_PRODUCT = "tbl_cateprod";

    public function getCateProdItemById($cateProd_id)
    {
        $sql = "SELECT * FROM ".self::TABLE_CATE_PRODUCT." WHERE `cateProd_status` = 'on' AND `cateProd_id` = '{$cateProd_id}'";
        return $this->selectRow($sql);
    }

    public function getAll()
    {
        return $this->selectAll(self::TABLE_CATE_PRODUCT, "`cateProd_status` = 'on' ORDER BY `cateProd_order` ASC");
    }

    public function getAllCateProduct()
    {
        return $this->selectAll(self::TABLE_CATE_PRODUCT, "`cateProd_status` = 'on' ORDER BY `cateProd_order` ASC");
    }

    public function checkListCateProdChildExistsByCateProdId($cateProd_id)
    {
        $num = $this->getNumRow("SELECT `cateProd_id` FROM ".self::TABLE_CATE_PRODUCT." WHERE `cateProd_parentId` = '${cateProd_id}' AND `cateProd_status` = 'on'");
        if($num > 0) return true;
        return false;
    }

    public function getByParentId($cateProd_id)
    {
        return $this->selectAll(self::TABLE_CATE_PRODUCT, "`cateProd_status` = 'on' AND `cateProd_parentId` = '{$cateProd_id}' ORDER BY `cateProd_order` asc");
    }


    public function getCateProdHot()
    {
        return $this->selectByQuery("SELECT `cateProd_image`,`cateProd_name`,`cateProd_seoUrl`,`cateProd_id` FROM ".self::TABLE_CATE_PRODUCT." WHERE `cateProd_status` = 'on' AND `cateProd_hot` = '1'");
    }

    public function getListCateProdByListIdCateProd($listIdCateProd)
    {
        if(!empty($listIdCateProd)) {
            $listCateProd = $this->selectAll(self::TABLE_CATE_PRODUCT,"`cateProd_status` = 'on'");
            $result = [];
            foreach($listCateProd as $cateProdItem) {
                if( in_array($cateProdItem['cateProd_id'], $listIdCateProd) ) {
                    $result[] = $cateProdItem;
                }
            }
            return $result;
        } return [];
    }

    public function checkCateFieldProductExists($filedCheck, $strSearch)
    {
        $sql = "SELECT COUNT(`cateProd_id`) as `numRow` FROM `tbl_cateprod` WHERE `cateProd_status` = 'on' AND `{$filedCheck}` LIKE '%{$strSearch}%'";
        $numRow = $this->selectByQuery($sql);
        if( (int) $numRow[0]['numRow'] > 0) return true;
        return false;
    }

    public function searchListCateProdByFieldSearch($filedSearch, $strSearch)
    {
        return $this->selectAll(self::TABLE_CATE_PRODUCT,"`cateProd_status` = 'on' AND `{$filedSearch}` LIKE '%{$strSearch}%'");
    }

    // recoment search ajax
    public function searchListCateProdFieldByFieldSearch( $filedSearch, $strSearch, $data )
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $sql = "SELECT {$data} FROM " . self::TABLE_CATE_PRODUCT . " WHERE `{$filedSearch}` LIKE '%{$strSearch}%' AND `cateProd_status` = 'on'";
        return $this->selectByQuery($sql);
    }
}