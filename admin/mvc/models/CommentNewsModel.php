<?php

class CommentNewsModel extends DB
{
    private $CommentNewsTableName = "tbl_commentnews";

    public function checkCommentNewsExist($commentnews_customerFullname, $commentnews_newsId_ties, $commentnews_content, $commentnews_createDate)
    {
        $numRow = $this->selectSql("{$this->CommentNewsTableName}","COUNT(`commentnews_id`) as `numRow`","WHERE `commentnews_customerFullname` = '{$commentnews_customerFullname}' AND `commentnews_newsId_ties` = '{$commentnews_newsId_ties}' AND `commentnews_content` = '{$commentnews_content}' AND `commentnews_createDate` = '{$commentnews_createDate}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addCommentNewsNew($dataCommentNews)
    {
        return $this->insert("{$this->CommentNewsTableName}", $dataCommentNews);
    }

    public function getListCommentNewsByStatus($status)
    {
        $where = $status == 'all' ? '' : "`commentnews_status` = '{$status}'";
        return $this->select("{$this->CommentNewsTableName}","",$where);
    }

    public function getListCommentNewsByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `commentnews_status` = '{$status}'";
        $where = "{$status} ORDER BY `commentnews_customerFullname` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->CommentNewsTableName}","",$where);
    }

    public function updateCommentNews($dataCommentNews, $commentnews_id)
    {
        return $this->update("{$this->CommentNewsTableName}",$dataCommentNews,"`commentnews_id` = '{$commentnews_id}'");
    }

    public function deletecommentNews($commentnews_id)
    {
        return $this->delete("{$this->CommentNewsTableName}","`commentnews_id` = {$commentnews_id}");
    }

    public function loadCommentNewsByField($fieldName)
    {
        return $this->select("{$this->CommentNewsTableName}",[$fieldName],"");
    }

    public function searchRecommentByFile($fieldName, $searchValue)
    {
        return $this->select("{$this->CommentNewsTableName}","","`{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function getCommentNewsItemById($commentnews_id)
    {
        return $this->selectRow("{$this->CommentNewsTableName}","","`commentnews_id` = '{$commentnews_id}'");
    }

}