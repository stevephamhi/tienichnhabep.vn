<?php

class ReviewModel extends DB
{
    private $ReviewTableName    = "tbl_review";
    private $ReviewImgTableName = "tbl_review_img_ties";

    public function addReviewNew($dataReview)
    {
        return $this->insert("{$this->ReviewTableName}", $dataReview);
    }

    public function addReviewImgNew($dataReviewImg)
    {
        return $this->insert("{$this->ReviewImgTableName}", $dataReviewImg);
    }

    public function checkReviewExist($review_customerFullname, $review_prodId_ties, $review_content, $review_createDate)
    {
        $numRow = $this->selectSql("{$this->ReviewTableName}","COUNT(`review_id`) as `numRow`","WHERE `review_customerFullname` = '{$review_customerFullname}' AND `review_prodId_ties` = '{$review_prodId_ties}' AND `review_content` = '{$review_content}' AND `review_createDate` = '{$review_createDate}'")[0];
        if($numRow['numRow'] > 0) return true;
        return false;
    }

    public function getListReviewByStatus($status)
    {
        $where = $status == 'all' ? '' : "`review_status` = '{$status}'";
        return $this->select("{$this->ReviewTableName}","",$where);
    }

    public function getListReviewByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `review_status` = '{$status}'";
        $where = "{$status} ORDER BY `review_customerFullname` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->ReviewTableName}","",$where);
    }

    public function updateReview($dataReview, $review_id)
    {
        return $this->update("{$this->ReviewTableName}",$dataReview,"`review_id` = '{$review_id}'");
    }

    public function deleteReview($review_id)
    {
        return $this->delete("{$this->ReviewTableName}","`review_id` = {$review_id}");
    }

    public function loadReviewByField($fieldName)
    {
        return $this->select("{$this->ReviewTableName}",[$fieldName],"");
    }

    public function searchRecommentByFile($fieldName, $searchValue)
    {
        return $this->select("{$this->ReviewTableName}","","`{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function getReviewItemById($review_id)
    {
        return $this->selectRow("{$this->ReviewTableName}","","`review_id` = '{$review_id}'");
    }

    public function getListImgReviewByIdReview($review_id)
    {
        return $this->select("{$this->ReviewImgTableName}","","`review_img_reviewId_ties` = '{$review_id}'");
    }

    public function deleteTotalImgReviewByIdReView($review_id)
    {
        return $this->delete("{$this->ReviewImgTableName}","`review_img_reviewId_ties` = '{$review_id}'");
    }

}