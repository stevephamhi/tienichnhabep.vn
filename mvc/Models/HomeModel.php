<?php
class HomeModel extends Database
{

    const TABLE_DISPLAY    = "tbl_display";
    const TABLE_BACKGROUND = "tbl_background";

    public function getListAllDisplayInnerJoinMainCateProd()
    {
        $sql = "SELECT `tbl_display`.*, `tbl_cateprod`.cateProd_id as `cateProd_id`, `tbl_cateprod`.cateProd_seoUrl as `cateProd_seoUrl` FROM `tbl_display` JOIN `tbl_cateprod` ON `tbl_cateprod`.cateProd_id = `tbl_display`.display_cateProdId_main_ties WHERE `tbl_display`.display_status = 'on' ORDER BY `tbl_display`.display_order asc";
        return $this->selectByQuery($sql);
    }

    public function getBackgroundEventHomeToday()
    {
        $dateToday = time();
        return $this->selectAll(self::TABLE_BACKGROUND, "`background_status` = 'on' AND `background_startDate` <= '{$dateToday}' AND `background_endDate` >= '{$dateToday}' ORDER BY `background_order` asc");
    }
}