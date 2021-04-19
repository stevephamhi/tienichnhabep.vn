<div id="order_mb">
    <div class="table_order">
        <?php foreach( $listHistoryOrder as $orderItem ) : ?>
            <div class="order_item">
                <div class="order_info_top">
                    <p>Đơn hàng: <a href="<?php {{ echo Config::getBaseUrlClient("chi-tiet-don-hang.html?donhangID={$orderItem['order_code']}"); }} ?>" class="d_inline_block"><?php {{ echo $orderItem['order_code']; }} ?></a></p>
                </div>
                <div class="order_info_content d_flex justify_content_between">
                    <div class="d_flex">
                        <div class="image">
                            <div style="width: 60px; height: 60px;">
                                <img class="full_size" src="<?php {{ echo Config::getBaseUrlAdmin($orderItem['prodInfo']['prod_avatar']); }} ?>" alt="<?php {{ echo $orderItem['prodInfo']['prod_name']; }} ?>">
                            </div>
                        </div>
                        <div class="info_prod">
                            <h3 class="prod_name d_block"><?php {{ echo $orderItem['prodInfo']['prod_name']; }} ?></h3>
                            <span class="order_date d_block">Ngày đặt: <?php {{ echo Format::formatTime($orderItem['order_createDate']); }} ?></span>
                            <div class="detail_order d_flex align_items_center">
                                <a href="<?php {{ echo Config::getBaseUrlClient("chi-tiet-don-hang.html?donhangID={$orderItem['order_code']}"); }} ?>" class="view_detail">Xem chi tiết</a>
                                <a href="javascript:;" class="delete deleteOrderHistory_btn" od-id="<?php {{ echo $orderItem['order_id']; }} ?>">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    <span>Xóa</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="order_status text_right">
                        <span class="price d_block"><?php {{ echo Format::formatCurrency($orderItem['order_totalPrice']); }} ?></span>
                        <span class="status finish d_block"><?php {{ echo Format::formatOrder($orderItem['order_status']); }} ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>