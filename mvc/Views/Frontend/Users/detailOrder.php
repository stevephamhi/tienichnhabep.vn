<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Chi tiết đơn hàng <?php {{ echo !empty($orderItem['order_code']) ? $orderItem['order_code'] : ''; }} ?> | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Chi tiết đơn hàng <?php {{ echo !empty($orderItem['order_code']) ? $orderItem['order_code'] : ''; }} ?> | Tienichnhabep.vn">
        <meta property="og:title" content="Chi tiết đơn hàng <?php {{ echo !empty($orderItem['order_code']) ? $orderItem['order_code'] : ''; }} ?> | Tienichnhabep.vn">
        <meta property="og:description" content="Chi tiết đơn hàng <?php {{ echo !empty($orderItem['order_code']) ? $orderItem['order_code'] : ''; }} ?> | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("lich-su-mua-hang.html"); }} ?>">
        <meta property="og:site_name" content="Chi tiết đơn hàng <?php {{ echo !empty($orderItem['order_code']) ? $orderItem['order_code'] : ''; }} ?> | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Chi tiết đơn hàng <?php {{ echo !empty($orderItem['order_code']) ? $orderItem['order_code'] : ''; }} ?> | Tienichnhabep.vn">
        <meta name="twitter:description" content="Chi tiết đơn hàng <?php {{ echo !empty($orderItem['order_code']) ? $orderItem['order_code'] : ''; }} ?> | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/user.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
                <div class="container main_content_wrap_append" id="info_user_wrap">
                    <div class="grid_row">
                        <?php if( Auth::isLogin() ) : ?>
                            <?php {{ view("Frontend.Users.sidebar", [
                            "tabActive"       => "",
                            "customerItem"    => $customerItem,
                        ]); }} ?>
                        <?php else : ?>
                            <div class="grid_column_3 tab_control_user">
                                <div class="tab_control">
                                    <div class="tab_user d_flex align_items_center">
                                        <div class="avatar">
                                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/user-male.png"); }} ?>" alt="">
                                        </div>
                                        <div class="info">
                                            <p class="title">Tài khoản của</p>
                                            <p class="name">Khách</p>
                                        </div>
                                    </div>
                                    <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" class="tab_item d_flex align_items_center active">
                                        <i style="font-size: 1.5rem; margin-right: 5px;" class="fa fa-sign-in" aria-hidden="true"></i>
                                        <span>Đăng nhập</span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="grid_column_12 grid_column_lg_9">
                            <?php if( !empty($orderItem) ) : ?>
                                <?php if($viewOrderStatus) : ?>
                                    <div id="view_order_detail">
                                        <div class="heading">
                                            <span>Chi tiết đơn hàng</span>
                                            <span class="split">-</span>
                                            <span class="status <?php {{ echo $orderItem['order_status']; }} ?>"><?php {{ echo Format::formatOrder($orderItem['order_status']); }} ?></span>
                                        </div>
                                        <div class="create-date">Đơn hàng được đặt vào <?php {{ echo Format::formatTimeOrder($orderItem['order_createDate']); }} ?></div>
                                        <?php if( !empty($orderItem['order_notification']) ) : ?>
                                            <div class="notification">
                                                <div class="notification_inner">
                                                    <div class="title">THÔNG BÁO # <span class="time_send">Gửi vào <?php {{ echo Format::formatFullTime($orderItem['order_time_notification']); }} ?></span></div>
                                                    <div class="content d_flex align_items_start">
                                                        <p class="desc"><?php {{ echo $orderItem['order_notification']; }} ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                        <?php endif; ?>
                                        <div class="head_section_group grid_row">
                                            <div class="hs_item grid_column_12 grid_column_lg_6">
                                                <div class="title">ĐỊA CHỈ NGƯỜI NHẬN</div>
                                                <div class="content">
                                                    <p class="name"><?php {{ echo $orderItem['order_customer_fullname']; }} ?></p>
                                                    <p class="address">
                                                        <span class="label">Địa chỉ: </span>
                                                        <span class="value"><?php {{ echo $orderItem['order_address']; }} ?></span>
                                                    </p>
                                                    <p class="phone">
                                                        <span class="label">Điện thoại: </span>
                                                        <span class="value"><?php {{ echo $orderItem['order_customer_phone']; }} ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="hs_item grid_column_12 grid_column_lg_6">
                                                <div class="title">HÌNH THỨC THANH TOÁN</div>
                                                <div class="content">
                                                    <div class="image">
                                                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/cod.png"); }} ?>" alt="">
                                                    </div>
                                                    <p class="payment_method"><?php {{ echo $orderItem['order_payment_method']; }} ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list_products">
                                            <div class="title">DANH SÁCH SẢN PHẨM</div>
                                            <div class="table_products">
                                                <?php if( !empty($listOrderItem) ) : ?>
                                                    <?php foreach($listOrderItem as $orderItem_item) : ?>
                                                        <?php {{ $orderItem_item['prod_url'] = Config::getBaseUrlClient("{$orderItem_item['prodInfo']['prod_seoUrl']}-p{$orderItem_item['prodInfo']['prod_id']}.html"); }} ?>
                                                        <div class="prod_item">
                                                            <img class="prod_avatar" src="<?php {{ echo Config::getBaseUrlAdmin($orderItem_item['prodInfo']['prod_avatar']); }} ?>" alt="<?php {{ echo $orderItem_item['prodInfo']['prod_name']; }} ?>">
                                                            <div class="content">
                                                                <a href="<?php {{ echo $orderItem_item['prod_url']; }} ?>" class="prod_name"><?php {{ echo $orderItem_item['prodInfo']['prod_name']; }} ?></a>
                                                                <p class="prod_info">
                                                                    <span class="qty"><?php {{ echo $orderItem_item['orderItem_amount']; }} ?> x</span>
                                                                    <span class="price"><?php {{ echo Format::formatCurrency((int) $orderItem_item['orderItem_price'] / (int) $orderItem_item['orderItem_amount']); }} ?></span>
                                                                    <span class="total_price"><?php {{ echo Format::formatCurrency((int) $orderItem_item['orderItem_amount'] * ((int) $orderItem_item['orderItem_price'] / (int) $orderItem_item['orderItem_amount'])); }} ?></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="info_order">
                                                        <div class="i_order_item">
                                                            <div class="title">Tạm tính:</div>
                                                            <div class="value"><?php {{ echo Format::formatCurrency($orderItem['order_totalPrice']); }} ?></div>
                                                        </div>
                                                        <div class="i_order_item">
                                                            <div class="title">Phí vận chuyển:</div>
                                                            <div class="value">
                                                                <p class="i_tm">Từ 500K miễn phí vận chuyển</p>
                                                                <p class="i_tm">Dưới 500K chúng tôi sẽ liên hệ lại với bạn</p>
                                                                <p class="i_tm">Chưa bao gồm thuế VAT (Thuế giá trị gia tăng)</p>
                                                            </div>
                                                        </div>
                                                        <div class="i_order_item total">
                                                            <div class="title">Tổng cộng:</div>
                                                            <div class="value"><?php {{ echo Format::formatCurrency($orderItem['order_totalPrice']); }} ?></div>
                                                        </div>
                                                        <?php if( $orderItem['order_status'] == "processing" ) : ?>
                                                            <div class="i_order_item total">
                                                                <input type="checkbox" class="d_none" id="confirm_tFSCancel_order">
                                                                <label for="confirm_tFSCancel_order" type="button" class="cancel_order_button">Hủy đơn hàng</label>
                                                                <div class="reason_cancel">
                                                                    <div class="form_reason_group">
                                                                        <select name="" id="reason_cancel_order">
                                                                            <option value="">--- Chọn lý do hủy đơn ---</option>
                                                                            <option value="1">Đổi hình thức thanh toán</option>
                                                                            <option value="2">Đặt trùng</option>
                                                                            <option value="3">Thời gian giao hàng quá lâu/sớm</option>
                                                                            <option value="4">Không còn nhu cầu</option>
                                                                            <option value="5">Thay đổi địa chỉ giao hàng</option>
                                                                            <option value="6">Thêm/bớt sản phẩm</option>
                                                                            <option value="7">Khác</option>
                                                                        </select>
                                                                        <p class="error select_reason_error"></p>
                                                                    </div>
                                                                    <div class="form_reason_group">
                                                                        <textarea name="" id="detail_reason_cancel" placeholder="Chi tiết lý do bạn muốn hủy đơn" spellcheck="false"></textarea>
                                                                        <p class="error detail_reason_error"></p>
                                                                    </div>
                                                                    <div class="form_reason_group d_flex align_items_center justify_content_between">
                                                                        <button type="type" class="confirm_cancel_order_action" od-id="<?php {{ echo $orderItem['order_id']; }} ?>">Xác nhận hủy đơn</button>
                                                                        <label for="confirm_tFSCancel_order" class="cancel_cancel_order">Hủy</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php else : ?>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                                                        <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                                                        <p style="font-size: .9rem;">Không có sản phẩm nào trong đơn hàng</p>
                                                        <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                                                        <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <a href="<?php {{ echo Config::getBaseUrlClient("don-hang-cua-toi.html"); }} ?>" class="view_list_order"><< Tới danh sách đơn hàng</a>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                                        <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                                        <p style="font-size: .9rem;">Đơn hàng này không phải của bạn</p>
                                        <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 30px; font-size: .95rem; border-radius: 5px;">ĐĂNG NHẬP ĐỂ XEM ĐƠN HÀNG</a>
                                        <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                                    </div>
                                <?php endif; ?>
                            <?php else : ?>
                                <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                                    <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                                    <p style="font-size: .9rem;">Đơn hàng không tồn tại</p>
                                    <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                                    <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
            <?php {{ view("Frontend.Users.menu"); }} ?>
        </div>
    </div>
</body>
</html>