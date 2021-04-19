<?php

class OrderModel extends Database
{
    const TABLE_ORDER      = "tbl_order";
    const TABLE_ORDER_ITEM = "tbl_orderitem";

    public function addOrderNew($dataOrder)
    {
        return $this->insert(self::TABLE_ORDER,$dataOrder);
    }

    public function addOrderItemNew($dataOrderItem)
    {
        return $this->insert(self::TABLE_ORDER_ITEM,$dataOrderItem);
    }

    public function getOrderByOrderCode($order_code)
    {
        $sql = "SELECT * FROM ". self::TABLE_ORDER ." WHERE `order_code` = '{$order_code}'";
        return $this->selectRow($sql);
    }

    public function getListOrderItemByOrderId($order_id)
    {
        $sql = "SELECT * FROM ". self::TABLE_ORDER_ITEM ." WHERE `orderItem_orderId` = '{$order_id}'";
        return $this->selectByQuery($sql);
    }

    public function updateOrderById($dataOrder, $order_id)
    {
        return $this->update(self::TABLE_ORDER, $dataOrder, "`order_id` = '{$order_id}'");
    }

    public function getListOrderByCustomerId($customer_id)
    {
        return $this->selectAll(self::TABLE_ORDER,"`order_customerId_ties` = '{$customer_id}' AND `order_is_delete` = '0' ORDER BY `order_createDate` desc");
    }

    public function getListHistoryOrderByPagination( $customer_id, $pageStart, $numPerPage )
    {
        $sql = "SELECT * FROM ". self::TABLE_ORDER ." WHERE `order_customerId_ties` = '{$customer_id}' AND `order_is_delete` = '0' ORDER BY `order_createDate` desc LIMIT {$pageStart}, {$numPerPage}";
        return $this->selectByQuery($sql);
    }

    public function updateOrder($dataOrder, $order_id)
    {
        return $this->update(self::TABLE_ORDER, $dataOrder, "`order_id` = '{$order_id}'");
    }
}