<?php

class ProductspModel extends Database
{
    const TABLE_PRODUCTSP = "tbl_prodsp";

    public function getListProdsp()
    {
        return $this->selectAll(self::TABLE_PRODUCTSP,"`prodsp_status` = 'on' ORDER BY `prodsp_order`");
    }

    public function getProdspItemById($prodsp_id)
    {
        return $this->selectRow("SELECT * FROM " . self::TABLE_PRODUCTSP . " WHERE `prodsp_id` = '{$prodsp_id}' AND `prodsp_status` = 'on'");
    }

}