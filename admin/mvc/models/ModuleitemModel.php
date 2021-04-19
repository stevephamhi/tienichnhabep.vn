<?php

class ModuleitemModel extends DB
{
    private $table_module_item   = "tbl_moduleitem";
    private $table_module_banner = "tbl_modulebannerpromotion";

    public function addModuleitemNew($dataModuleitem)
    {
        return $this->insert("{$this->table_module_item}", $dataModuleitem);
    }

    public function addModuleBannerPromotionNew($dataBannerPromotion)
    {
        return $this->insert("{$this->table_module_banner}", $dataBannerPromotion);
    }

    public function checkModuleItemExists($moduleitem_nametap, $moduleitem_module_parent_id)
    {
        $numRow = $this->selectSql("{$this->table_module_item}","COUNT(`moduleitem_id`) as `numRow`","WHERE `moduleitem_nametap` = '{$moduleitem_nametap}' AND `moduleitem_module_parent_id` = '{$moduleitem_module_parent_id}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function getOrderMax()
    {
        return $this->selectSql("{$this->table_module_item}","MAX(`moduleitem_order`) as `orderMax`","")[0];
    }

    public function getListTotalModuleitemByStatus($status)
    {
        $where = $status == 'all' ? '' : "`moduleitem_status` = '{$status}'";
        return $this->select("{$this->table_module_item}","",$where);
    }

    public function getListModuleitemByPagination($orderBy, $orderField, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `moduleitem_status` = '{$status}'";
        $where = "{$status} ORDER BY `{$orderField}` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->table_module_item}","",$where);
    }

    public function updateModuleitem($dataModuleitem, $moduleitem_id)
    {
        return $this->update("{$this->table_module_item}",$dataModuleitem,"`moduleitem_id` = '{$moduleitem_id}'");
    }

    public function deleteModuleitem($moduleitem_id)
    {
        return $this->delete("{$this->table_module_item}","`moduleitem_id` = {$moduleitem_id}");
    }

    public function deleteModulebannerpromo($moduleitem_id)
    {
        return $this->delete("{$this->table_module_banner}","`modulebannerPromo_moduleitem_id_ties` = {$moduleitem_id}");
    }

    public function getListTotalModuleitemByField($fieldArr)
    {
        return $this->select("{$this->table_module_item}",$fieldArr,"");
    }

    public function recommentSearchByFiled($fieldArr, $strSearch)
    {
        $fieldArr = !empty($Moduleitem) ? $Moduleitem : "";
        return $this->select("{$this->table_module_item}",$fieldArr,"`moduleitem_nametap` LIKE '%{$strSearch}%'");
    }

    public function getModuleitem_item($moduleitem_id)
    {
        return $this->selectRow("{$this->table_module_item}","","`moduleitem_id` = '{$moduleitem_id}'");
    }

    public function getListModuleitemBannerPromotionByIdModuleitem($moduleitem_id)
    {
        return $this->select("{$this->table_module_banner}","","`modulebannerPromo_moduleitem_id_ties`='{$moduleitem_id}'");
    }
}