<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Đơn hàng</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Chi tiết đơn hàng</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_default" href="Order">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                    <span>Quay về</span>
                </a>
            </div>
        </div>
    </div>
    <?php if( !empty( $orderInfoItem ) ) : ?>
        <div class="table_content container_fluid grid_row" id="ORDER_ID_EL" data-id="<?php {{ echo $orderInfoItem['order_id']; }} ?>">
            <div class="grid_column_8" style="padding-right: 15px">
                <div class="panel_table">
                    <div class="panel_heading">
                        <h2 class="panel_title">
                            <i class="fa fa-info-circle"></i>
                            <span>Chi tiết đơn hàng</span>
                        </h2>
                    </div>
                    <div class="panel_body">
                        <div id="table_content">
                            <table class="table table-bordered" style="margin-bottom: 20px;">
                                <thead>
                                    <tr>
                                        <td style="width: 50%; padding: 7px; font-size: .8rem; color: #333; font-weight: bold;" class="text_left">Thông tin đơn</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text_left" style="font-size: .9rem; line-height: 1.9;">
                                            <p>
                                                <strong>ID Đơn hàng:</strong>
                                                <span><?php {{ echo $orderInfoItem['order_code']; }} ?></span>
                                            </p>
                                            <p>
                                                <strong>Ngày đặt:</strong>
                                                <span><?php {{ echo Format::formatFullTime($orderInfoItem['order_createDate']); }} ?></span>
                                            </p>
                                            <p>
                                                <strong>Ghi chú:</strong>
                                                <span><?php {{ echo $orderInfoItem['order_note']; }} ?></span>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered" style="margin-bottom: 20px;">
                                <thead>
                                    <tr>
                                        <td style="width: 50%; padding: 7px; font-size: .8rem; color: #333; font-weight: bold;" class="text_left">Thông tin thanh toán</td>
                                        <td style="width: 50%; padding: 7px; font-size: .8rem; color: #333; font-weight: bold;" class="text_left">Địa chỉ giao nhận</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text_left" style="font-size: .9rem; line-height: 1.9;">
                                            <p>
                                                <span><?php {{ echo $orderInfoItem['order_customer_fullname']; }} ?></span>
                                            </p>
                                            <p>
                                                <a class="d_inline_block" href="mailTo:<?php {{ echo $orderInfoItem['order_customer_email']; }} ?>"><?php {{ echo $orderInfoItem['order_customer_email']; }} ?></a>
                                            </p>
                                            <p>
                                                <a class="d_inline_block" href="tel:<?php {{ echo $orderInfoItem['order_customer_phone']; }} ?>"><?php {{ echo $orderInfoItem['order_customer_phone']; }} ?></a>
                                            </p>
                                        </td>
                                        <td class="text_left" style="font-size: .9rem; line-height: 1.9;">
                                            <p>
                                                <span><?php {{ echo $orderInfoItem['order_customer_fullname']; }} ?></span>
                                            </p>
                                            <p>
                                                <a class="d_inline_block" href="mailTo:<?php {{ echo $orderInfoItem['order_customer_email']; }} ?>"><?php {{ echo $orderInfoItem['order_customer_email']; }} ?></a>
                                            </p>
                                            <p>
                                                <a class="d_inline_block" href="tel:<?php {{ echo $orderInfoItem['order_customer_phone']; }} ?>"><?php {{ echo $orderInfoItem['order_customer_phone']; }} ?></a>
                                            </p>
                                            <p>
                                                <span>ĐC: <?php {{ echo $orderInfoItem['order_address']; }} ?></span>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if( !empty( $listOrderitem ) ) : ?>
                                <table class="info_order table">
                                    <thead>
                                        <tr>
                                            <td class="text_left" style="padding: 7px; color: #333; font-size: .9rem">Sản phẩm</td>
                                            <td class="text_right" style="padding: 7px; color: #333; font-size: .9rem">Unit Price</td>
                                            <td width="1" style="padding: 7px; color: #333; font-size: .9rem"></td>
                                            <td class="text_left" style="padding: 7px; color: #333; font-size: .9rem">SL</td>
                                            <td class="text_right" style="padding: 7px; color: #333; font-size: .9rem">Tổng</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach( $listOrderitem as $orderitem ) : ?>
                                            <tr>
                                                <td class="text_left" width="500">
                                                    <div class="d_flex align_items_center">
                                                        <img width="80" style="margin-right: 10px;" src="<?php {{ echo $orderitem['prodInfo']['prod_avatar']; }} ?>">
                                                        <strong><a style="font-size: .9rem; color: #107cd2; font-weight: bold;" href="Product/update/<?php {{ echo $orderitem['prodInfo']['prod_id']; }} ?>/<?php {{ echo $orderitem['prodInfo']['prod_seoUrl']; }} ?>" target="_blank"><?php {{ echo $orderitem['prodInfo']['prod_name']; }} ?></a></strong>
                                                    </div>
                                                </td>
                                                <td class="text_right"><?php {{
                                                    echo Format::formatCurrency( (int)$orderitem['orderItem_price'] / (int)$orderitem['orderItem_amount'] );
                                                }} ?></td>
                                                <td width="1" class="hidden-sm hidden-xs">×</td>
                                                <td class="text_left"><?php {{ echo $orderitem['orderItem_amount']; }} ?></td>
                                                <td class="text_right">
                                                    <?php {{
                                                        echo Format::formatCurrency($orderitem['orderItem_price']);
                                                    }} ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4" class="text_right" style="color: #333; font-size: .9rem;">Thành tiền</td>
                                            <td class="text_right"><?php {{ echo Format::formatCurrency($orderInfoItem['order_totalPrice']); }} ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text_right" colspan="5">
                                                <h4 style="margin-bottom: 10px;">Phí vận chuyển và lắp đặt</h4>
                                                <span style="display:block;font-size:.8rem">Miễn phí giao hàng cho đơn hàng từ <strong>500.000 ₫</strong> (Áp dụng trong nội thành)</span>
                                                <span style="display:block;font-size:.8rem">Phí giao hàng toàn quốc 15.000 ₫</span>
                                                <span style="display:block;font-size:.8rem">Sản phẩm chưa bao gồm phí giá trị gia tăng (VAT)</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text_right" style="color: #333; font-size: .9rem;">Tổng số</td>
                                            <td class="text_right"><?php {{ echo Format::formatCurrency($orderInfoItem['order_totalPrice']); }} ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="panel_footer">
                        <div class="grid_row">
                            <div class="grid_column_1 d_flex align_items_center"><i style="font-size: 1.8rem;" class="fa fa-truck fa-fw"></i></div>
                            <div class="grid_column_8 d_flex align_items_center">
                                <h3 class="panel_title" style="font-size: 1rem; font-weight: 100; color: #333;">Phí vận chuyển Toàn Quốc</h3>
                            </div>
                            <div class="grid_column_3 text_right">
                                <button type="button" class="btn btn_primary" data-btn-modal="delivery_modal">Giao hàng</button>
                            </div>
                        </div>
                    </div>
                    <div id="table_content" style="margin-top: 20px; padding: 0 20px;">
                        <div class="nav_tabs d_flex align_items_center" style="margin: 0;">
                            <a class="active tab_item" href="#tab_general">Tổng quan</a>
                        </div>
                        <div class="tab_content" style="padding: 20px 0;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td style="font-size: .9rem; color: #333; padding: 10px 5px;">Ngày đặt hàng</td>
                                        <td style="font-size: .9rem; color: #333; padding: 10px 5px;">Chú thích</td>
                                        <td style="font-size: .9rem; color: #333; padding: 10px 5px;">Trạng thái</td>
                                        <td style="font-size: .9rem; color: #333; padding: 10px 5px;">Thông báo khách hàng</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php {{ echo Format::formatFullTime($orderInfoItem['order_createDate']); }} ?></td>
                                        <td><?php {{ echo $orderInfoItem['order_note']; }} ?></td>
                                        <td><?php {{ echo Format::formatStatusOrder($orderInfoItem['order_status']); }} ?></td>
                                        <td>Không</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid_column_4" style="padding-left: 15px">
                <style>
                    table.info_customer {
                        width: 100%;
                    }
                    table.info_customer tr{
                        font-family: "tienichnhabep-mainFont-Light";
                        padding: 7px 10px;
                        display: block;
                        border-bottom: 1px solid #E5E5E5;
                    }
                </style>
                <div class="panel_table">
                    <div class="panel_heading">
                        <h2 class="panel_title">
                            <i class="fa fa-info-circle"></i>
                            <span>Thông tin khách hàng</span>
                        </h2>
                    </div>
                    <div class="panel_body" style="padding: 0;">
                        <table class="table info_customer">
                            <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn_info" style="margin-right: 10px; padding: 3px;">
                                            <i class="fa fa-user fa-fw"></i>
                                        </button>
                                    </td>
                                    <td><?php {{ echo $orderInfoItem['order_customer_fullname']; }} ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn_info" style="margin-right: 10px; padding: 3px;">
                                            <i class="fa fa-group fa-fw"></i>
                                        </button>
                                    </td>
                                    <?php if( !empty($orderInfoItem['order_customerId_ties']) ) : ?>
                                        <td>Đã đăng ký tài khoản <a target="_blank" href="<?php {{ echo "Customer/history/{$orderInfoItem['order_customerId_ties']}/{$orderInfoItem['order_customer_phone']}"; }} ?>" class="d_inline" style="color: #107cd2; border-bottom: 1px solid;">Truy cập >></a></td>
                                    <?php else : ?>
                                        <td>Chưa đăng ký tài khoản</td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn_info" style="margin-right: 10px; padding: 3px;">
                                            <i class="fa fa-envelope-o fa-fw"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="mailTo:<?php {{ echo $orderInfoItem['order_customer_email']; }} ?>" target="_blank" style="color:#107cd2"><?php {{ echo $orderInfoItem['order_customer_email']; }} ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn_info" style="margin-right: 10px; padding: 3px;">
                                            <i class="fa fa-phone fa-fw"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="tel:<?php {{ echo $orderInfoItem['order_customer_phone']; }} ?>" style="color:#107cd2"><?php {{ echo $orderInfoItem['order_customer_phone']; }} ?></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel_table" style="margin-top: 15px;">
                    <div class="panel_heading">
                        <h2 class="panel_title">
                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                            <span>Gửi thông báo tới khách hàng</span>
                        </h2>
                    </div>
                    <div class="panel_body" style="padding: 5px;">
                        <textarea id="order_notification" style="width: 100%; height: 100px; border: 1px solid rgba(0,0,0,0.12); padding: 5px; font-family: 'tienichnhabep-mainFont-Light'; font-size: .9rem;" spellcheck="false" placeholder="Gửi thông báo tới khách hàng ( Chỉ hiển thị với khách hàng đã đăng nhập ), Xóa đi thông báo bằng cách gửi thông báo rỗng"><?php {{
                            echo $orderInfoItem['order_notification'];
                        }} ?></textarea>
                        <button type="button" id="send_notification_btn" style="width: 100%; padding: 4px 0; cursor: pointer;">Gửi thông báo</button>
                    </div>
                </div>
                <div class="panel_table" style="margin-top: 20px;">
                    <div class="loader_wrap loader_update_status">
                        <div class="loader"></div>
                    </div>
                    <div class="panel_heading">
                        <h2 class="panel_title">
                            <i class="fa fa-info-circle"></i>
                            <span>Xử lý đơn hàng</span>
                        </h2>
                    </div>
                    <div class="panel_body" style="padding: 5px;">
                        <div class="alert_wrap" style="margin-top: 2px; padding: 0;">
                            <div class="alert  position_relative" data-status="">
                                <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                                <span></span>
                                <button type="button" class="close position_absolute">x</button>
                            </div>
                        </div>
                        <select name="" class="form_control w_100" id="statusOrder_el">
                            <option <?php {{ echo $orderInfoItem['order_status'] == 'finish' ? "selected" : null; }} ?> value="finish">Hoàn thành</option>
                            <option <?php {{ echo $orderInfoItem['order_status'] == 'refund' ? "selected" : null; }} ?> value="refund">Hoàn Tiền</option>
                            <option <?php {{ echo $orderInfoItem['order_status'] == 'refuse' ? "selected" : null; }} ?> value="refuse">Từ chối nhận</option>
                            <option <?php {{ echo $orderInfoItem['order_status'] == 'canceled' ? "selected" : null; }} ?> value="canceled">Bị hủy bỏ</option>
                            <option <?php {{ echo $orderInfoItem['order_status'] == 'shipping' ? "selected" : null; }} ?> value="shipping">Đang vận chuyển</option>
                            <option <?php {{ echo $orderInfoItem['order_status'] == 'processing' ? "selected" : null; }} ?> value="processing">Đang xử lý</option>
                            <option <?php {{ echo $orderInfoItem['order_status'] == 'return' ? "selected" : null; }} ?> value="return">Trả về</option>
                        </select>
                    </div>
                    <div class="panel_body" style="padding: 5px;">
                        <button class="form_button w_100" id="btnUpdateStatusOrder">Cập nhật trạng thái</button>
                        <style>
                            #btnUpdateStatusOrder {
                                padding: 7px 0;
                                font-size: 1rem;
                                background: #5bc0de;
                                border: 1px solid #5bc0de;
                                color: #fff;
                                border-radius: 3px;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
    <p>Đơn hàng không tồn tại</p>
    <?php endif; ?>
</main>
<div class="modal" id="delivery_modal">
    <div class="modal_mask" data-dismiss-modal="delivery_modal"></div>
    <div class="modal_dialog">
        <div class="modal_content">
            <form action="" method="POST">
                <div class="modal_header d_flex justify_content_between align_items_center">
                    <h4>Giao hàng</h4>
                    <span class="close" data-dismiss-modal="delivery_modal"><i class="fa fa-times" aria-hidden="true"></i></span>
                </div>
                <div class="alert_wrap" style="margin-top: 5px; padding: 0;">
                    <div class="alert  position_relative" data-status="">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
                <div class="loader_wrap">
                    <div class="loader"></div>
                </div>
                <?php if( !empty($listOrderitem) ) : ?>
                    <div class="modal_body">
                        <input type="hidden" name="order_id" value="100">
                        <div style="height: 190px; overflow: auto;">
                            <table class="table info_order">
                                <thead>
                                    <tr>
                                        <td>Ảnh</td>
                                        <td>Sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td>Unit Price</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach( $listOrderitem as $orderitem ) : ?>
                                        <tr>
                                            <td>
                                                <img src="<?php {{ echo $orderitem['prodInfo']['prod_avatar']; }} ?>" width="80" alt="">
                                            </td>
                                            <td width="400">
                                                <a href="" style="color: #107cd2;"><?php {{ echo $orderitem['prodInfo']['prod_name']; }} ?></a>
                                            </td>
                                            <td><?php {{ echo $orderitem['orderItem_amount']; }} ?> x <?php {{
                                                echo Format::formatCurrency( (int)$orderitem['orderItem_price'] / (int)$orderitem['orderItem_amount'] );
                                            }} ?></td>
                                            <td><?php {{ echo Format::formatCurrency($orderitem['orderItem_price']); }} ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <table class="table carrier">
                            <tbody>
                                <tr>
                                    <td>Hãng vận chuyển</td>
                                    <td>
                                        <input type="text" value="<?php {{ echo $orderInfoItem['order_shipping_unit']; }} ?>" id="shipping_unit" class="form_control" placeholder="Hãng vận chuyển" autocomplete="off" spellcheck="false">
                                    </td>
                                    <td>Mã vận đơn</td>
                                    <td><input type="text" value="<?php {{ echo $orderInfoItem['order_bill_lading_code']; }} ?>" id="bill_lading_code" class="form_control" placeholder="Mã vận đơn" autocomplete="off" spellcheck="false"></td>
                                </tr>
                                <tr>
                                    <td>Phí vận chuyển</td>
                                    <td><input type="text" value="<?php {{ echo $orderInfoItem['order_transport_fee']; }} ?>" id="order_transport_fee" class="form_control" placeholder="Phí vận chuyển" autocomplete="off" spellcheck="false"></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Ghi chú</b>
                                    </td>
                                    <td colspan="3">
                                        <textarea class="form_control" name="note" id="shipping_code" style="width: 100%; height: 100px;" placeholder="Ghi chú"><?php {{
                                            echo $orderInfoItem['order_shipping_note'];
                                        }} ?></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <div class="modal_footer d_flex justify_content_end align_items_center">
                    <button type="button" class="btn btn_default" data-dismiss-modal="delivery_modal">Hủy</button>
                    <button type="submit" class="btn btn_primary" id="saveShippingUnitBtn">Lưu</button>
                </div>
            </form>
        </div>
    </div>
    <style>#delivery_modal .modal_header{background-color:#eee;border-bottom:1px solid #e5e5e5;padding:0 20px}#delivery_modal .modal_header h4{font-weight:100;font-size:1.1rem;color:#585858}#delivery_modal .modal_body{padding:20px}#delivery_modal .modal_body table.table{width:100%}#delivery_modal .modal_body table.table tr td{border-bottom:1px solid #e5e5e5;padding:10px 5px;vertical-align:middle;font-size:.9rem}#delivery_modal .modal_body table.table .form_control{width:200px}#delivery_modal .modal_footer{padding:10px 20px}#delivery_modal .modal_footer button.btn{font-family:tienichnhabep-mainFont-Light;margin-left:10px;border-radius:5px}</style>
</div>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/detailOrder.ajax.js"); }} ?>"></script>
<script type="text/javascript" class="handle_modal">
    document.querySelectorAll("[data-btn-modal]").forEach(el => {
        el.addEventListener('click', function() {
            event.preventDefault();
            let modal = document.getElementById(this.getAttribute('data-btn-modal'));
            modal.classList.add('open');
        });
    });
    document.querySelectorAll("[data-dismiss-modal]").forEach(el => {
        el.addEventListener('click', function() {
            event.preventDefault();
            let modal = document.getElementById(this.getAttribute('data-dismiss-modal'));
            modal.classList.remove('open');
        });
    })
</script>