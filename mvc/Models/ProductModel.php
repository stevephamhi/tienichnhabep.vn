<?php

class ProductModel extends Database
{

    const TABLE_PRODUCT     = "tbl_prod";
    const TABLE_BRAND       = "tbl_brand";
    const TABLE_IMAGES_TIES = "tbl_prod_listimg_ties";

    public function getListAllProduct()
    {
        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_id as `brand_id`, `tbl_brand`.brand_name as `brand_name` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.prod_status = 'on'";
        return $this->selectByQuery($sql);
    }

    public function getListAllProdAndBrandTiesAnd()
    {
        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_name as `brand_name`, `tbl_brand`.brand_id as `brand_id` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.prod_status = 'on' AND `tbl_brand`.brand_status = 'on'";
        return $this->selectByQuery($sql);
    }

    public function getListProdByBrandId($brand_id)
    {
        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_id as `brand_id`, `tbl_brand`.brand_name as `brand_name` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.prod_ties_brand_id = '{$brand_id}' AND `tbl_prod`.prod_status = 'on'";
        return $this->selectByQuery($sql);
    }

    public function getProdItemById($prod_id)
    {
        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_id as `brand_id`, `tbl_brand`.brand_name as `brand_name` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.prod_status = 'on' AND `tbl_prod`.prod_id = '{$prod_id}'";
        return $this->selectRow($sql);
    }

    public function getProdAndBrandTiesItemByIdProd($prod_id)
    {
        $sql = "SELECT ".self::TABLE_PRODUCT.".*, ".self::TABLE_BRAND.".brand_name as `brand_name`, ".self::TABLE_BRAND.".brand_id as `brand_id` FROM ".self::TABLE_PRODUCT." JOIN ".self::TABLE_BRAND." ON ".self::TABLE_BRAND.".brand_id = ".self::TABLE_PRODUCT.".prod_ties_brand_id WHERE `tbl_prod`.prod_id = '{$prod_id}' AND ".self::TABLE_PRODUCT.".prod_status = 'on' AND ".self::TABLE_BRAND.".brand_status = 'on'";
        return $this->selectRow($sql);
    }

    public function getListImagesTiesByIdProd($prod_id)
    {
        return $this->selectAll(self::TABLE_IMAGES_TIES,"`prod_listImg_prodId_ties` = '{$prod_id}' ORDER BY `prod_listImg_ties_order` asc");
    }

    public function getListProdTiesByListIdProd($listIdProd) {
        $listProd = $this->selectAll(self::TABLE_PRODUCT,"`prod_status` = 'on'");
        if(!empty($listIdProd)) {
            $result = [];
            foreach($listProd as $prodItem) {
                if( in_array($prodItem['prod_id'], $listIdProd) ) {
                    $result[] = $prodItem;
                }
            }
            return $result;
        } return null;
    }

    public function getListProductByMixFilterAndPagination( $cateProd_id, $price_vl, $brand_id, $sort_vl , $pageStart, $numPerPage)
    {
        if($sort_vl == "priceasc") {
            $sortValue = [
                "field" => "prod_currentPrice",
                "value" => "asc"
            ];
        } else if($sort_vl == "pricedesc") {
            $sortValue = [
                "field" => "prod_currentPrice",
                "value" => "desc"
            ];
        } else if($sort_vl == "bestsellers") {
            $sortValue = [
                "field" => "prod_quantitySold",
                "value" => "desc"
            ];
        } else if($sort_vl == "lastest") {
            $sortValue = [
                "field" => "prod_createDate",
                "value" => "desc"
            ];
        } else {
            $sortValue = [
                "field" => "prod_name",
                "value" => "desc"
            ];
        }
        $brandSql = !empty($brand_id) ? "AND `tbl_prod`.prod_ties_brand_id = '{$brand_id}'": "";
        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_name as `brand_name`, `tbl_brand`.brand_id as `brand_id` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.prod_status = 'on' AND `tbl_brand`.brand_status = 'on' {$brandSql} AND `tbl_prod`.prod_currentPrice >= ".$price_vl['min']." AND `tbl_prod`.prod_currentPrice <= ".$price_vl['max']." ORDER BY `{$sortValue['field']}` {$sortValue['value']}";
        $listProd = $this->selectByQuery($sql);
        $listProductByIdCate = [];
        if( !empty($listProd) ) {
            foreach($listProd as $prodItem) {
                $arrayProdCateTies = json_decode($prodItem['prod_listId_cateProd_ties']);
                if( in_array($cateProd_id, $arrayProdCateTies) ) {
                    $listProductByIdCate[] = $prodItem;
                }
            }
            if( !empty($numPerPage) || !empty($pageStart) ) {
                $listProductByIdCatePagination = [];
                if( $pageStart == 0 ) {
                    for( $i = $pageStart ; $i < $numPerPage ; $i++ ) {
                        if( !empty($listProductByIdCate[$i]) ) {
                            $listProductByIdCatePagination[] = $listProductByIdCate[$i];
                        }
                    }
                } else {
                    for( $i = $pageStart ; $i < $pageStart + $numPerPage ; $i++ ) {
                        if( !empty($listProductByIdCate[$i]) ) {
                            $listProductByIdCatePagination[] = $listProductByIdCate[$i];
                        }
                    }
                }

                return $listProductByIdCatePagination;
            } else {
                return $listProductByIdCate;
            }
        } return [];
    }

    public function getListProdByBrandAndMixFilter( $brand_id, $price_vl, $sort_vl, $pageStart, $numPerPage )
    {
        if($sort_vl == "priceasc") {
            $sortValue = [
                "field" => "prod_currentPrice",
                "value" => "asc"
            ];
        } else if($sort_vl == "pricedesc") {
            $sortValue = [
                "field" => "prod_currentPrice",
                "value" => "desc"
            ];
        } else if($sort_vl == "bestsellers") {
            $sortValue = [
                "field" => "prod_quantitySold",
                "value" => "desc"
            ];
        } else if($sort_vl == "lastest") {
            $sortValue = [
                "field" => "prod_createDate",
                "value" => "desc"
            ];
        } else {
            $sortValue = [
                "field" => "prod_name",
                "value" => "desc"
            ];
        }

        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_name as `brand_name`, `tbl_brand`.brand_id as `brand_id` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.prod_status = 'on' AND `tbl_brand`.brand_status = 'on' AND `tbl_prod`.prod_ties_brand_id = '{$brand_id}' AND `tbl_prod`.prod_currentPrice >= ".$price_vl['min']." AND `tbl_prod`.prod_currentPrice <= ".$price_vl['max']." ORDER BY `{$sortValue['field']}` {$sortValue['value']}";
        $listProd = $this->selectByQuery($sql);
        if( !empty($listProd) ) {
            if( !empty($numPerPage) || !empty($pageStart) ) {
                $listProdByIdBrandPagination = [];
                if( $pageStart == 0 ) {
                    for($i = $pageStart ; $i < $numPerPage ; $i++) {
                        if( !empty($listProd[$i]) ) {
                            $listProdByIdBrandPagination[] = $listProd[$i];
                        }
                    }
                } else {
                    for($i = $pageStart ; $i < $pageStart + $numPerPage ; $i++) {
                        if( !empty($listProd[$i]) ) {
                            $listProdByIdBrandPagination[] = $listProd[$i];
                        }
                    }
                }
                return $listProdByIdBrandPagination;
            } return $listProd;
        } return [];
    }

    public function getListProdByLiquidationAndMixFilter( $brand_id, $price_vl, $sort_vl, $pageStart, $numPerPage )
    {
        if($sort_vl == "priceasc") {
            $sortValue = [
                "field" => "prod_currentPrice",
                "value" => "asc"
            ];
        } else if($sort_vl == "pricedesc") {
            $sortValue = [
                "field" => "prod_currentPrice",
                "value" => "desc"
            ];
        } else if($sort_vl == "bestsellers") {
            $sortValue = [
                "field" => "prod_quantitySold",
                "value" => "desc"
            ];
        } else if($sort_vl == "lastest") {
            $sortValue = [
                "field" => "prod_createDate",
                "value" => "desc"
            ];
        } else {
            $sortValue = [
                "field" => "prod_name",
                "value" => "desc"
            ];
        }
        $brandSql = !empty($brand_id) ? "AND `tbl_prod`.prod_ties_brand_id = '{$brand_id}'": "";
        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_name as `brand_name`, `tbl_brand`.brand_id as `brand_id` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.prod_status = 'on' AND `tbl_brand`.brand_status = 'on' AND `tbl_prod`.prod_liquidation = '1' {$brandSql} AND `tbl_prod`.prod_currentPrice >= ".$price_vl['min']." AND `tbl_prod`.prod_currentPrice <= ".$price_vl['max']." ORDER BY `{$sortValue['field']}` {$sortValue['value']}";
        $listProd = $this->selectByQuery($sql);
        if( !empty($listProd) ) {
            if( !empty($numPerPage) || !empty($pageStart) ) {
                $listProdByIdBrandPagination = [];
                if( $pageStart == 0 ) {
                    for($i = $pageStart ; $i < $numPerPage ; $i++) {
                        if( !empty($listProd[$i]) ) {
                            $listProdByIdBrandPagination[] = $listProd[$i];
                        }
                    }
                } else {
                    for($i = $pageStart ; $i < $pageStart + $numPerPage ; $i++) {
                        if( !empty($listProd[$i]) ) {
                            $listProdByIdBrandPagination[] = $listProd[$i];
                        }
                    }
                }
                return $listProdByIdBrandPagination;
            } return $listProd;
        } return [];
    }

    public function getlistProdByLiquidation()
    {
        return $this->selectAll(self::TABLE_PRODUCT,"`prod_status` = 'on' AND `prod_liquidation` = '1'");
    }

    public function checkProductExists($strSearch) {
        $sql = "SELECT COUNT(`prod_id`) as `numRow` FROM `tbl_prod` WHERE `prod_status` = 'on' AND `prod_name` LIKE '%{$strSearch}%'";
        $numRow = $this->selectByQuery($sql);
        if( (int) $numRow[0]['numRow'] > 0) return true;
        return false;
    }

    public function checkProdFieldExists($filedCheck, $strSearch)
    {
        $sql = "SELECT COUNT(`prod_id`) as `numRow` FROM `tbl_prod` WHERE `prod_status` = 'on' AND `{$filedCheck}` LIKE '%{$strSearch}%'";
        $numRow = $this->selectByQuery($sql);
        if( (int) $numRow[0]['numRow'] > 0) return true;
        return false;
    }

    public function searchProductByField($fieldSearch, $strSearch)
    {
        $sql = "SELECT `tbl_prod`.*, `tbl_brand`.brand_id as `brand_id`, `tbl_brand`.brand_name as `brand_name` FROM `tbl_prod` JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_prod`.$fieldSearch LIKE '%{$strSearch}%' AND `tbl_prod`.prod_status = 'on'";
        return $this->selectByQuery($sql);
    }

    // recomment ajax

    public function checkProductKeywordExists($strSearch)
    {
        $sql = "SELECT COUNT(`prod_id`) as `numRow` FROM `tbl_prod` WHERE `prod_status` = 'on' AND `prod_keywords` LIKE '%{$strSearch}%'";
        $numRow = $this->selectByQuery($sql);
        if( (int) $numRow[0]['numRow'] > 0) return true;
        return false;
    }

    public function getListProdFieldByBrandId($brand_id, $data)
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $sql = "SELECT {$data} FROM " . self::TABLE_PRODUCT . " WHERE `prod_ties_brand_id` = '{$brand_id}' AND `prod_status` = 'on'";
        return $this->selectByQuery($sql);
    }

    public function searchProductFieldByKeyword($strSearch, $data)
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $sql = "SELECT {$data} FROM " . self::TABLE_PRODUCT . " WHERE `prod_keywords` LIKE '%{$strSearch}%' AND `prod_status` = 'on'";
        return $this->selectByQuery($sql);
    }

    public function searchProdFieldByFieldSearch( $fieldSearch, $strSearch, $data )
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $sql = "SELECT {$data} FROM " . self::TABLE_PRODUCT . " WHERE `{$fieldSearch}` LIKE '%{$strSearch}%' AND `prod_status` = 'on'";
        return $this->selectByQuery($sql);
    }

    public function getListALlProductByField($data)
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $sql = "SELECT {$data} FROM " . self::TABLE_PRODUCT . " WHERE `prod_status` = 'on'";
        return $this->selectByQuery($sql);
    }
}
