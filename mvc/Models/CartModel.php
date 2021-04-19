<?php

class CartModel extends Database
{

    const TABLE_CART = 'tbl_cart';

    public function checkCartExists($prod_id, $customer_id) {
        $sql = "SELECT * FROM ". self::TABLE_CART ." WHERE `cart_prod_id` = '{$prod_id}' AND `cart_customer_id` = '{$customer_id}'";
        $cartItem = $this->selectRow($sql);
        if(!empty($cartItem)) {
            return [
                "status"   => true,
                "cartInfo" => $cartItem
            ];
        }
        return [
            "status" => false
        ];
    }

    public function updateCart($dataCart, $cart_id)
    {
        return $this->update(self::TABLE_CART, $dataCart, "`cart_id` = '{$cart_id}'");
    }

    public function addCartNew($dataCart) {
        return $this->insert(self::TABLE_CART, $dataCart);
    }


    public function getTotalOrderByCustomerId($customer_id)
    {
        $sql = "SELECT `cart_num_qty` FROM ". self::TABLE_CART ." WHERE `cart_customer_id` = '{$customer_id}'";
        $listCart = $this->selectByQuery($sql);
        $totalOrder = 0;
        foreach( $listCart as $cartItem ) {
            $totalOrder += (int)$cartItem['cart_num_qty'];
        }
        return $totalOrder;
    }

    public function getListCartBuyCustomerId($customer_id)
    {
        return $this->selectAll(self::TABLE_CART, "`cart_customer_id` = '{$customer_id}'");
    }

    public function deleteCartByProdIdAndCustomer($prod_id, $customer_id)
    {
        return $this->delete(self::TABLE_CART, "`cart_prod_id` = '{$prod_id}' AND `cart_customer_id` = '{$customer_id}'");
    }

    public function deleteCartByCustomerId($customer_id)
    {
        return $this->delete(self::TABLE_CART, "`cart_customer_id` = '{$customer_id}'");
    }

}