<div id="order_pc">
    <table class="table_list_order">
        <thead>
            <tr>
                <td>Mã đơn hàng</td>
                <td>Sản phẩm</td>
                <td>Giá</td>
                <td>Ngày đặt mua</td>
                <td>Trạng thái</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $listHistoryOrder as $orderItem ) : ?>
                <tr>
                    <td>
                        <a href="<?php {{ echo Config::getBaseUrlClient("chi-tiet-don-hang.html?donhangID={$orderItem['order_code']}"); }} ?>" class="order_code"><?php {{ echo $orderItem['order_code']; }} ?></a>
                    </td>
                    <td class="d_flex">
                        <div class="order_prod" style="width: 60px; height: 60px;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlAdmin($orderItem['prodInfo']['prod_avatar']); }} ?>" alt="<?php {{ echo $orderItem['prodInfo']['prod_name']; }} ?>">
                        </div>
                        <div>
                            <p class="order_prodName"><?php {{ echo $orderItem['prodInfo']['prod_name']; }} ?></p>
                            <div class="detail_order d_flex align_items_center">
                                <a href="<?php {{ echo Config::getBaseUrlClient("chi-tiet-don-hang.html?donhangID={$orderItem['order_code']}"); }} ?>" class="view_detail">Xem chi tiết</a>
                                <a href="javascript:;" od-id="<?php {{ echo $orderItem['order_id']; }} ?>" class="delete deleteOrderHistory_btn">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    <span>Xóa</span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="price"><?php {{ echo Format::formatCurrency($orderItem['order_totalPrice']); }} ?></td>
                    <td><?php {{ echo Format::formatTime($orderItem['order_createDate']); }} ?></td>
                    <td class="status <?php {{ echo $orderItem['order_status']; }} ?>"><?php {{ echo Format::formatOrder($orderItem['order_status']); }} ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>