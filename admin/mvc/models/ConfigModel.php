<?php

class ConfigModel extends DB
{

    private $table_config = "tbl_config";

    public function getConfigInfo()
    {
        return $this->select("{$this->table_config}","","");
    }

    public function updateConfig($dataConfig, $config_id)
    {
        return $this->update("{$this->table_config}",$dataConfig,"`config_id` = '{$config_id}'");
    }
}