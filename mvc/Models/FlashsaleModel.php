<?php
class FlashsaleModel extends Database
{
    const TABLE_FLASHSALE = "tbl_prod_flashsale_ties";
    const TABLR_PRODUCT   = "tbl_prod";

    public function getListFlashSaleByTime($dateToday)
    {
        $sql = "SELECT `tbl_prod_flashsale_ties`.*, `tbl_prod`.*,`tbl_brand`.brand_id as `brand_id`, `tbl_brand`.brand_name as `brand_name` FROM `tbl_prod_flashsale_ties` JOIN `tbl_prod` ON `tbl_prod`.prod_id = `tbl_prod_flashsale_ties`.prod_flashsale_prodId JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod_flashsale_ties`.prod_flashsale_dateStart <= '{$dateToday}' AND `tbl_prod_flashsale_ties`.prod_flashsale_dateEnd >= '{$dateToday}' ORDER BY `tbl_prod_flashsale_ties`.prod_flashsale_order asc";
        $result = $this->selectByQuery($sql);
        $listFlashSale = [];
        foreach($result as $item) {
            if($item['prod_flashsale_status'] == "on") {
                array_push($listFlashSale, $item);
            }
        }
        return $listFlashSale;
    }

    public function getListFlashSaleInToday($dateToday)
    {
        return $this->selectAll(self::TABLE_FLASHSALE,"`prod_flashsale_status` = 'on' AND `prod_flashsale_dateStart` <= '{$dateToday}' AND `prod_flashsale_dateEnd` >= '{$dateToday}'");
    }

    public function getListFlashSaleTodayByIdProd($prod_id)
    {
        $dateToday = time();
        return $this->selectRow("SELECT * FROM `tbl_prod_flashsale_ties` WHERE `prod_flashsale_prodId` = '{$prod_id}' AND `prod_flashsale_status` = 'on' AND `prod_flashsale_dateStart` <= '{$dateToday}' AND `prod_flashsale_dateEnd` >= '{$dateToday}'");
    }
}