<?php

class ModuleModel extends DB
{

    private $table_module = "tbl_module";

    public function checkModuleExists($module_name)
    {
        $numRow = $this->selectSql("{$this->table_module}","COUNT(`module_id`) as `numRow`","WHERE `module_name` = '{$module_name}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function getModuleItemById($module_id)
    {
        return $this->selectRow("{$this->table_module}","","`module_id` = '{$module_id}'");
    }

    public function addModuleNew($dataModule)
    {
        return $this->insert("{$this->table_module}", $dataModule);
    }

    public function getOrderMax()
    {
        return $this->selectSql("{$this->table_module}","MAX(`module_order`) as `orderMax`","")[0];
    }

    public function getListModuleByStatus($status)
    {
        $where = $status == 'all' ? '' : "`module_status` = '{$status}'";
        return $this->select("{$this->table_module}","",$where);
    }

    public function getListModuleByPagination($orderBy, $orderField, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `module_status` = '{$status}'";
        $where = "{$status} ORDER BY `{$orderField}` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->table_module}","",$where);
    }

    public function updateModule($dataModule, $module_id)
    {
        return $this->update("{$this->table_module}",$dataModule,"`module_id` = '{$module_id}'");
    }

    public function deleteModule($module_id)
    {
        return $this->delete("{$this->table_module}","`module_id` = {$module_id}");
    }

    public function searchModuleByName($vlSearch)
    {
        return $this->select("{$this->table_module}","","`module_name` LIKE '%{$vlSearch}%'");
    }

}