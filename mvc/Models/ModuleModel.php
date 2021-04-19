<?php

class ModuleModel extends Database
{
    const TABLE_MODULE      = "tbl_module";
    const TABLE_MODULE_ITEM = "tbl_moduleitem";
    const TABLE_MODULE_BANNER_PROMO = "tbl_modulebannerpromotion";

    public function getModuleById($module_id)
    {
        return $this->selectRow("SELECT * FROM " . self::TABLE_MODULE . " WHERE `module_id` = '{$module_id}' AND `module_status` = 'on'");
    }

    public function getListModuleitemByModule_id($module_id)
    {
        return $this->selectAll(self::TABLE_MODULE_ITEM, "`moduleitem_module_parent_id` = '{$module_id}' AND `moduleitem_status` = 'on'");
    }

    public function getListModuleBannerPromotionByIdModuleitem($moduleitem_id, $orderBy)
    {
        return $this->selectAll(self::TABLE_MODULE_BANNER_PROMO, "`modulebannerPromo_moduleitem_id_ties` = '{$moduleitem_id}' ORDER BY `modulebannerPromo_order` $orderBy");
    }

    public function getModuleIsFlashSale()
    {
        $sql = "SELECT `module_id`, `module_name`, `module_seoUrl` FROM `tbl_module` WHERE `module_is_flashsale` = '1' AND `module_status` = 'on'";
        return $this->selectRow($sql);
    }
}