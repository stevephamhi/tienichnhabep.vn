<?php

class OrderModel extends DB {
    private $table_order     = 'tbl_order';
    private $table_orderItem = 'tbl_orderitem';
    private $table_customer  = 'tbl_customer';

    public function getFieldOrder($fieldGet)
    {
        return $this->select($this->table_order,[$fieldGet],"");
    }

    public function getOrderItemById($order_id) {
        return $this->selectRow("{$this->table_order}", "", "`order_id` = '{$order_id}'");
    }

    public function getListOrderItemOfOrderByIdOrder( $order_id ) {
        return $this->select("{$this->table_orderItem}","","`orderItem_orderId` = '{$order_id}'");
    }

    public function getFieldCustomer($fieldGet)
    {
        return $this->select($this->table_customer,[$fieldGet],"");
    }

    public function searchFieldOrderByFieldSearch($fieldSearch, $strSearch)
    {
        return $this->select($this->table_order,[$fieldSearch],"`{$fieldSearch}` LIKE '%{$strSearch}%'");
    }

    public function searchFieldCustomerByFieldSearch($fieldSearch, $strSearch)
    {
        return $this->select($this->table_customer,[$fieldSearch],"`{$fieldSearch}` LIKE '%{$strSearch}%'");
    }

    public function getListProdOrder() {
        $sql = "SELECT `tbl_orderitem`.* ,`tbl_prod`.prod_name, `tbl_brand`.brand_name,`tbl_brand`.brand_id FROM `tbl_orderitem` INNER JOIN `tbl_prod` ON `tbl_prod`.prod_id = `tbl_orderitem`.orderItem_prodId INNER JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id";
        return $this->selectByQuery($sql);
    }

    public function searchFieldProdOrderByFieldSearch($strSearch)
    {
        $sql = "SELECT `tbl_orderitem`.* ,`tbl_prod`.prod_name FROM `tbl_orderitem` INNER JOIN `tbl_prod` ON `tbl_prod`.prod_id = `tbl_orderitem`.orderItem_prodId WHERE `tbl_prod`.prod_name LIKE '%{$strSearch}%'";
        return $this->selectByQuery($sql);
    }

    public function searchFieldBrandProdOrderByFieldSearch($strSearch)
    {
        $sql = "SELECT `tbl_orderitem`.* ,`tbl_prod`.prod_name, `tbl_brand`.brand_name,`tbl_brand`.brand_id FROM `tbl_orderitem` INNER JOIN `tbl_prod` ON `tbl_prod`.prod_id = `tbl_orderitem`.orderItem_prodId INNER JOIN `tbl_brand` ON `tbl_brand`.brand_id = `tbl_prod`.prod_ties_brand_id WHERE `tbl_brand`.brand_name LIKE '%{$strSearch}%'";
        return $this->selectByQuery($sql);
    }

    public function getListCateProdOrder() {
        $sql = "SELECT `tbl_orderitem`.* ,`tbl_prod`.prod_listId_cateProd_ties FROM `tbl_orderitem` INNER JOIN `tbl_prod` ON `tbl_prod`.prod_id = `tbl_orderitem`.orderItem_prodId";
        $listProdOrder = $this->selectByQuery($sql);
        foreach( $listProdOrder as &$prodItem ) {
            $cateProdId_list = json_decode($prodItem['prod_listId_cateProd_ties'], true);
            $cateProdItem = $this->selectByQuery("SELECT  `cateProd_id`, `cateProd_name` FROM `tbl_cateprod` WHERE `cateProd_id` = '{$cateProdId_list[0]}'");
            $prodItem['cateProd_name'] = $cateProdItem[0]['cateProd_name'];
            $prodItem['cateProd_id']   = $cateProdItem[0]['cateProd_id'];
        }
        return $listProdOrder;
    }

    public function searchFieldCateProdOrderByFieldSearch($strSearch) {
        $sql = "SELECT `tbl_orderitem`.* ,`tbl_prod`.prod_listId_cateProd_ties FROM `tbl_orderitem` INNER JOIN `tbl_prod` ON `tbl_prod`.prod_id = `tbl_orderitem`.orderItem_prodId";
        $listProdOrder = $this->selectByQuery($sql);
        foreach( $listProdOrder as &$prodItem ) {
            $cateProdId_list = json_decode($prodItem['prod_listId_cateProd_ties'], true);
            $cateProdItem = $this->selectByQuery("SELECT  `cateProd_id`, `cateProd_name` FROM `tbl_cateprod` WHERE `cateProd_id` = '{$cateProdId_list[0]}'");
            $prodItem['cateProd_name'] = $cateProdItem[0]['cateProd_name'];
            $prodItem['cateProd_id']   = $cateProdItem[0]['cateProd_id'];
        }

        $listSearchCateProd = [];

        foreach($listProdOrder as $cateProdItem) {
            if(strpos($cateProdItem['cateProd_name'], $strSearch) !== false){
                $listSearchCateProd[] = $cateProdItem;
            }
        }
        return $listSearchCateProd;
    }

    public function getListOrderByStatus($status)
    {
        $where = $status == 'all' ? ' ORDER BY `order_createDate` asc' : "WHERE `order_status` = '{$status}' ORDER BY `order_createDate` asc";
        $sql = "SELECT * FROM `tbl_order` {$where}";
        return $this->selectByQuery($sql);
    }

    public function getTotalSalesByOrder()
    {
        $sql = "SELECT SUM(`order_totalPrice`) as `order_totalPrice` FROM " . $this->table_order . "";
        return $this->selectByQuery($sql)[0]['order_totalPrice'];
    }

    public function getListOrderByPagination( $orderDir, $orderBy, $pageStart, $numPerPage )
    {
        $sql = "SELECT * FROM `tbl_order` ORDER BY `{$orderBy}` {$orderDir} LIMIT {$pageStart}, {$numPerPage}";
        return $this->selectByQuery($sql);
    }

    public function getListOrderByFilterPagination( $filter_order_code, $filter_order_status, $filter_order_date, $filter_customer, $filter_total_price, $filter_update_date, $pageStart, $numPerPage )
    {
        $w_filter_order_code   = !empty( $filter_order_code )   ? "AND `order_code` = '{$filter_order_code}'" : null;
        if( !empty( $filter_order_status ) ) {
            if( $filter_order_status == 'all' ) {
                $w_filter_order_status = null;
            } else {
                $w_filter_order_status = "AND `order_status` = '{$filter_order_status}'";
            }
        } else {
            $w_filter_order_status = null;
        }
        $w_filter_order_date   = !empty( $filter_order_date )   ? "AND `order_createDate` = ' " . strtotime($filter_order_date) . " '"  : null;
        $w_filter_custom       = !empty( $filter_customer )     ? "AND `order_customerId_ties` = '{$filter_customer}'" : null;
        $w_filter_total_price  = !empty( $filter_total_price )  ? "AND `order_totalPrice` = '{$filter_total_price}'" : null;
        $w_filter_update_date  = !empty( $filter_update_date )  ? "AND `order_updateDate` = ' " . strtotime($filter_update_date) . " '" : null;
        if( !empty($w_filter_order_code) || !empty($w_filter_order_status) || !empty($w_filter_order_date) || !empty($w_filter_custom) || !empty($w_filter_total_price) || !empty($w_filter_update_date) ) {
            $filter_value = trim("{$w_filter_order_code} {$w_filter_order_status} {$w_filter_order_date} {$w_filter_custom} {$w_filter_total_price} {$w_filter_update_date}");
            $filter_string = substr( $filter_value, 3, strlen($filter_value) );
            $where = "WHERE {$filter_string}";
        } else {
            $where = '';
        }
        if( !empty( $pageStart ) || !empty( $numPerPage ) ) {
            $pagination = "LIMIT {$pageStart}, {$numPerPage}";
        } else {
            $pagination = null;
        }
        $sql = "SELECT * FROM `tbl_order` {$where} {$pagination}";
        return $this->selectByQuery($sql);
    }

    public function updateOrder( $dataOrder, $order_id )
    {
        return $this->update("{$this->table_order}", $dataOrder, "`order_id` = '{$order_id}'");
    }

    public function deleteOrderById( $order_id ) {
        return $this->delete("{$this->table_order}","`order_id`='{$order_id}'");
    }

    public function deleteOrderItemByOrder( $order_id )
    {
        return $this->delete( "{$this->table_orderItem}", "`orderItem_orderId`='{$order_id}'" );
    }

    public function getListOrderByCustomerId( $customer_id )
    {
        return $this->select("{$this->table_order}","","`order_customerId_ties` = '{$customer_id}'");
    }

}