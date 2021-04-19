<?php

class ConfigModel extends Database
{

    const TABLE_CONFIG = "tbl_config";

    public function getInfoConfig()
    {
        $sql = "SELECT * FROM " . self::TABLE_CONFIG . "";
        return $this->selectRow($sql);
    }

}