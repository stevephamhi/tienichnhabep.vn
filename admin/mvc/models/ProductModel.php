<?php

class ProductModel extends DB
{

    private $ProdTableName                  = "tbl_prod";
    private $ProdFlashSaleTableName         = "tbl_prod_flashsale_ties";
    private $ProdImageDescTabelName         = "tbl_prod_listimg_ties";
    private $ProdListImageTiesTableName     = "tbl_prod_listimg_ties";
    private $ProdListFlashSaleTiesTableName = "tbl_prod_flashsale_ties";

    public function getListProdByStatus($status)
    {
        $where = $status == 'all' ? '' : "`prod_status` = '{$status}'";
        return $this->select("{$this->ProdTableName}", "", $where);
    }

    public function getListAllProductByField()
    {
        return $this->select("{$this->ProdTableName}", [ "prod_name", "prod_id", "prod_avatar" ], "");
    }

    public function getOrderMaxPlus()
    {
        $numMax = (int)($this->selectSql("{$this->ProdTableName}", "MAX(`prod_order`) as `orderMax`", '')[0]);
        return @$numMax['orderMax'] + 1;
    }

    public function checkProdExists($prod_name, $prod_listId_cateProd_ties)
    {
        $numRow = $this->selectSql("{$this->ProdTableName}", "COUNT(`prod_id`) as `numRow`", "WHERE `prod_name` = '{$prod_name}' AND `prod_listId_cateProd_ties` = '{$prod_listId_cateProd_ties}'")[0];
        if ($numRow['numRow'] > 0) return true;
        return false;
    }

    public function addProdNew($dataProd)
    {
        return $this->insert("{$this->ProdTableName}", $dataProd);
    }

    public function addListImgNew($dataProdListImg)
    {
        return $this->insert("{$this->ProdImageDescTabelName}", $dataProdListImg);
    }

    public function addListFlashSaleNew($dataProdFlashSale)
    {
        return $this->insert("{$this->ProdFlashSaleTableName}", $dataProdFlashSale);
    }

    public function searchProdByName($vlSearch)
    {
        return $this->select("{$this->ProdTableName}", ["prod_id", "prod_name"], "`prod_name` LIKE '%{$vlSearch}%'");
    }

    public function getListProdByPagination($orderBy, $status, $pageStart, $numPerPage)
    {
        $status = $status == 'all' ? '' : "WHERE `prod_status` = '{$status}'";
        $where = "{$status} ORDER BY `prod_name` {$orderBy} LIMIT {$pageStart},{$numPerPage}";
        return $this->selectSql("{$this->ProdTableName}", "", $where);
    }

    public function updateProd($dataProd, $prod_id)
    {
        return $this->update("{$this->ProdTableName}", $dataProd, "`prod_id` = '{$prod_id}'");
    }

    public function deleteProd($prod_id)
    {
        return $this->delete("{$this->ProdTableName}", "`prod_id` = {$prod_id}");
    }

    public function loadProductByField__model($fieldName, $where)
    {
        return $this->select("{$this->ProdTableName}", $fieldName, "{$where}");
    }

    public function searchRecommentByField($fieldName, $searchValue)
    {
        return $this->select("{$this->ProdTableName}", [$fieldName], "`{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function getProdItemById($prod_id)
    {
        return $this->selectRow("{$this->ProdTableName}", "", "`prod_id` = '{$prod_id}'");
    }

    public function getListImgDescByIdProd($prod_id)
    {
        return $this->select("{$this->ProdListImageTiesTableName}", "", "`prod_listImg_prodId_ties` = '{$prod_id}'");
    }

    public function getListFlashSaleByIdProd($prod_id)
    {
        return $this->select("{$this->ProdListFlashSaleTiesTableName}", "", "`prod_flashsale_prodId` = '{$prod_id}'");
    }

    public function updateProdNew($dataProd, $prod_id)
    {
        return $this->update("{$this->ProdTableName}", $dataProd, "`prod_id` = '{$prod_id}'");
    }

    public function updateListFlashSaleNew($dataProdFlashSale, $prod_id)
    {
        return $this->update("{$this->ProdListFlashSaleTiesTableName}", $dataProdFlashSale, "`prod_id` = '{$prod_id}'");
    }

    public function deleteTotalProdImageDescByProdId($prod_id)
    {
        return $this->delete("{$this->ProdListImageTiesTableName}", "`prod_listImg_prodId_ties` = '{$prod_id}'");
    }

    public function deleteTotalProdFlashSaleByProdId($prod_id)
    {
        return $this->delete("{$this->ProdFlashSaleTableName}", "`prod_flashsale_prodId` = '{$prod_id}'");
    }

    public function searchRecommentByFile($fieldName, $searchValue)
    {
        return $this->select("{$this->ProdTableName}", "", "`{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function searchRecommentFieldByFile($fieldName, $searchValue, $data)
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        return $this->selectByQuery("SELECT {$data} FROM `tbl_prod` WHERE `{$fieldName}` LIKE '%{$searchValue}%'");
    }

    public function getProdItemByField($fieldName, $strSearch)
    {
        return $this->selectRow("{$this->ProdTableName}", ["prod_id"], "`{$fieldName}` LIKE '%{$strSearch}%'");
    }

    public function getListTotalProdByField($fieldArr)
    {
        return $this->select("{$this->ProdTableName}", $fieldArr, "");
    }
}
