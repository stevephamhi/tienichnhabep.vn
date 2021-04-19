<?php

class BannerModel extends Database
{
    const TABLE_BANNER_GROUP = "tbl_bannergroup";
    const TABLE_BANNER = "tbl_banner";

    public function getBannerByToday($bannerType, $dateToday, $numLimit = null)
    {
        $limit = !empty($numLimit) ? "LIMIT 0, $numLimit" : "";
        $sql = "SELECT ".self::TABLE_BANNER.".* FROM ".self::TABLE_BANNER." JOIN ".self::TABLE_BANNER_GROUP." ON ".self::TABLE_BANNER_GROUP.".bannergroup_id = ".self::TABLE_BANNER.".banner_groupBannerId_ties WHERE ".self::TABLE_BANNER_GROUP.".bannergroup_type = '{$bannerType}' AND ".self::TABLE_BANNER_GROUP.".bannergroup_status = 'on' AND ".self::TABLE_BANNER_GROUP.".bannerGroup_startDate <= '{$dateToday}' AND ".self::TABLE_BANNER_GROUP.".bannerGroup_endDate >= '{$dateToday}' ORDER BY ".self::TABLE_BANNER.".banner_order asc {$limit}";
        return $this->selectByQuery($sql);
    }
}