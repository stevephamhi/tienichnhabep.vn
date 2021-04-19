
<?php


class BrandModel extends Database
{

    const TABLE_BRAND = "tbl_brand";

    public function getBrandItemById($brand_id)
    {
        $sql = "SELECT * FROM ".self::TABLE_BRAND." WHERE `brand_status` = 'on' AND `brand_id` = '{$brand_id}'";
        return $this->selectRow($sql);
    }

    public function checkFieldBrandExists($fieldCheck, $strSearch)
    {
        $sql = "SELECT COUNT(`brand_id`) as `numRow` FROM `tbl_brand` WHERE `brand_status` = 'on' AND `{$fieldCheck}` LIKE '%{$strSearch}%'";
        $numRow = $this->selectByQuery($sql);
        if( (int) $numRow[0]['numRow'] > 0) return true;
        return false;
    }

    public function getListBrandBySearch($fieldSearch, $strSearch)
    {
        $sql = "SELECT * FROM ".self::TABLE_BRAND." WHERE `brand_status` = 'on' AND `{$fieldSearch}` LIKE '%{$strSearch}%'";
        return $this->selectByQuery($sql);
    }

    // recomment search ajax

    public function getListBrandFieldBySearch($fieldSearch, $strSearch, $data)
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $sql = "SELECT {$data} FROM " . self::TABLE_BRAND . " WHERE `{$fieldSearch}` LIKE '%{$strSearch}%' AND `brand_status` = 'on'";
        return $this->selectByQuery($sql);
    }
}