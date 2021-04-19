<?php

class AboutusModel extends Database
{

    const TABLE_ABOUTUS = "tbl_policy";

    public function getAboutUsItemById($aboutus_id)
    {
        return $this->selectRow("SELECT * FROM ".self::TABLE_ABOUTUS." WHERE `policy_id` = '{$aboutus_id}'");
    }

    public function getListAboutUs()
    {
        return $this->selectAll(self::TABLE_ABOUTUS,"`policy_status` = 'on'");
    }

}