<?php

class PolicyModel extends DB
{
    private $policy_table = "tbl_policy";

    public function checkPolicyExists($policy_title)
    {
        $numRow = $this->selectSql("{$this->policy_table}","COUNT(`policy_id`) as `numRow`","WHERE `policy_title` = '{$policy_title}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addPolicyNew($dataPolicy)
    {
        return $this->insert("{$this->policy_table}", $dataPolicy);
    }

    public function getListPolicyByStatus($status)
    {
        $where = $status == 'all' ? '' : "`policy_status` = '{$status}'";
        return $this->select("{$this->policy_table}","",$where);
    }

    public function getListPolicyByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `policy_status` = '{$status}'";
        $where = "{$status} ORDER BY `policy_order` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->policy_table}","",$where);
    }

    public function updatePolicy($dataPolicy, $policy_id)
    {
        return $this->update("{$this->policy_table}",$dataPolicy,"`policy_id` = '{$policy_id}'");
    }

    public function deletePolicy($policy_id)
    {
        return $this->delete("{$this->policy_table}","`policy_id` = {$policy_id}");
    }

    public function searchPolicyByName($vlSearch)
    {
        return $this->select("{$this->policy_table}","","`policy_title` LIKE '%{$vlSearch}%'");
    }

    public function getPolicyItemById($policy_id)
    {
        return $this->selectRow("{$this->policy_table}","","`policy_id` = '{$policy_id}'");
    }
}