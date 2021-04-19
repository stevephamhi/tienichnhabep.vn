<?php

class NewsModel extends DB
{
    private $NewsTable = "tbl_news";

    public function getOrderMaxPlus()
    {
        $numMax = (int)($this->selectSql("{$this->NewsTable}","MAX(`news_order`) as `orderMax`",'')[0]);
        return $numMax['orderMax'] + 1;
    }

    public function checkNewsExists($news_name, $news_listId_cateNews_ties)
    {
        $numRow = $this->selectSql("{$this->NewsTable}","COUNT(`news_id`) as `numRow`","WHERE `news_name` = '{$news_name}' AND `news_listId_cateNews_ties` = '{$news_listId_cateNews_ties}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addNewsNew($dataNews)
    {
        return $this->insert("{$this->NewsTable}", $dataNews);
    }

    public function searchNewsByName($strSearch)
    {
        return $this->select("{$this->NewsTable}","","`news_name` LIKE '%{$strSearch}%'");
    }

    public function getListNewsByStatus($status)
    {
        $where = $status == 'all' ? '' : "`news_status` = '{$status}'";
        return $this->select("{$this->NewsTable}","",$where);
    }

    public function getListNewsByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `news_status` = '{$status}'";
        $where = "{$status} ORDER BY `news_name` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->NewsTable}","",$where);
    }

    public function updateNews($dataNews, $news_id)
    {
        return $this->update("{$this->NewsTable}",$dataNews,"`news_id` = '{$news_id}'");
    }

    public function deleteNews($news_id)
    {
        return $this->delete("{$this->NewsTable}","`news_id` = {$news_id}");
    }

    public function getNewsItemById($news_id)
    {
        return $this->selectRow("{$this->NewsTable}","","`news_id` = '{$news_id}'");
    }

    public function loadNewsByField($fieldName)
    {
        return $this->select("{$this->NewsTable}",[$fieldName],"");
    }

    public function getNewsItemByField($fieldName, $strSearch)
    {
        return $this->selectRow("{$this->NewsTable}",["news_id"],"`{$fieldName}` LIKE '%{$strSearch}%'");
    }
}