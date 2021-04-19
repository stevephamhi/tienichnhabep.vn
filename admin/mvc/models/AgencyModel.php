<?php

class AgencyModel extends DB
{

    private $table_agency = "tbl_agency";

    public function getListAgencyByStatus($status)
    {
        $where = $status == 'all' ? '' : "`agency_status` = '{$status}'";
        return $this->select("{$this->table_agency}","",$where);
    }

    public function getListAgencyByPagination($orderBy, $orderByField, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `agency_status` = '{$status}'";
        $where = "{$status} ORDER BY `{$orderByField}` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->table_agency}","",$where);
    }

    public function deleteAgency($agency_id)
    {
        return $this->delete("{$this->table_agency}","`agency_id` = {$agency_id}");
    }

    public function loadAgencyByField__model($fieldName)
    {
        return $this->select("{$this->table_agency}", [$fieldName], "");
    }

    public function searchRecommentByFile($fieldName, $searchValue)
    {
        return $this->select("{$this->table_agency}", "", "`{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function getAgencyItembyAgencyId($agency_id)
    {
        return $this->selectRow("{$this->table_agency}", "", "`agency_id` = '{$agency_id}'");
    }

    public function updateAgency($dataAgency, $agency_id)
    {
        return $this->update("{$this->table_agency}", $dataAgency, "`agency_id` = '{$agency_id}'");
    }

}