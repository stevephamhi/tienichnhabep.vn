<?php

class Mail
{
    public static function RetureListProdCartInfo($listProdCartStore)
    {
        $htmls = "";
        foreach ( $listProdCartStore as $prodCartItem ) {
            $htmls .= '<tr>
            <td align="left" style="padding:3px 9px" valign="top"><span>'. $prodCartItem['prod_name'] .'</span><br></td>
            <td align="left" style="padding:3px 9px; white-space: nowrap;" valign="top"><span>'. Format::formatCurrency($prodCartItem['price_cart']) .'</span></td>
            <td align="left" style="padding:3px 9px" valign="top">'. $prodCartItem['cart_num_qty'] .'</td>
            <td align="left" style="padding:3px 9px" valign="top"><span>0đ</span></td>
            <td align="right" style="padding:3px 9px" valign="top"><span>'. Format::formatCurrency($prodCartItem['totalPrice_cart']) .'</span></td>
        </tr>';
        }
        return $htmls;
    }
}