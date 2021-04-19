<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Phương thức thanh toán | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="TPhương thức thanh toán | Tienichnhabep.vn">
        <meta property="og:title" content="TPhương thức thanh toán | Tienichnhabep.vn">
        <meta property="og:description" content="TPhương thức thanh toán | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>">
        <meta property="og:site_name" content="TPhương thức thanh toán | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="TPhương thức thanh toán | Tienichnhabep.vn">
        <meta name="twitter:description" content="TPhương thức thanh toán | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/cart.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="modal_loader">
            <div class="loader_img position_relative">
                <span class="thumbNail">
                    <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/logo_mini.png"); }} ?>" alt="">
                </span>
                <div class="loader_move position_absolute">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                </div>
            </div>
        </div>
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
                <?php if( !empty($listProdCartStore) ) : ?>
                    <div class="main_content_wrap_append">
                        <div class="header_order">
                            <div class="process_order">
                                <div class="process_step_item step_1">
                                    <div class="text">Chọn sản phẩm</div>
                                    <div class="bar">
                                        <div class="fill_color"></div>
                                    </div>
                                    <div class="circle">1</div>
                                </div>
                                <div class="process_step_item step_2">
                                    <div class="text">Địa chỉ giao hàng</div>
                                    <div class="bar">
                                        <div class="fill_color" style="width: 100%;"></div>
                                    </div>
                                    <div class="circle">2</div>
                                </div>
                                <div class="process_step_item step_3">
                                    <div class="text">Thanh toán & Đặt mua</div>
                                    <div class="bar">
                                        <div class="fill_color" style="width: 100%;"></div>
                                    </div>
                                    <div class="circle">3</div>
                                </div>
                            </div>
                        </div>
                        <div class="header_content container">
                            <div class="address_heading">
                                <h3 class="title">3. Thanh toán & Đặt mua</h3>
                                <h5 class="address_list_text">Chọn phương thức thanh toán và đặt mua bên dưới</h5>
                                <h5 class="note">Miễn phí vận chuyển cho đơn hàng từ 500K</h5>
                            </div>
                            <div class="address_content grid_row">
                                <div class="grid_column_12 grid_column_lg_7 PaymentMethods">
                                    <div class="list_prod_order">
                                        <div class="heading">Danh sách sản phẩm</div>
                                        <div class="body">
                                            <?php foreach( $listProdCartStore as $cartStoreItem ) : ?>
                                                <div class="prod_order_item">
                                                    <div class="image">
                                                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlAdmin($cartStoreItem['prod_avatar']); }} ?>" alt="<?php {{ echo $cartStoreItem['prod_name']; }} ?>">
                                                    </div>
                                                    <div class="content">
                                                        <p class="name"><?php {{ echo $cartStoreItem['prod_name']; }} ?></p>
                                                        <p class="action">
                                                            <span class="qty">SL: x <strong><?php {{ echo $cartStoreItem['cart_num_qty']; }} ?></strong></span>
                                                            <?php if( !empty($cartStoreItem['flashSale']) ) : ?>
                                                                <span class="price"><?php {{ echo Format::formatCurrency($cartStoreItem['flashSale'][0]['prod_flashsale_price']); }} ?></span>
                                                            <?php else : ?>
                                                                <span class="price"><?php {{ echo Format::formatCurrency($cartStoreItem['prod_currentPrice']); }} ?></span>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="list_payment_method">
                                        <div class="heading">Chọn phương thức thanh toán</div>
                                        <div class="d_flex">
                                            <div class="payment_item">
                                                <input type="radio" checked class="d_none select_payment_method" data-vnTitle="Thanh toán khi nhận hàng" name="payment_method" id="cod_method">
                                                <label for="cod_method" class="payment_item_inner">
                                                    <span class="image">
                                                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/cod.png"); }} ?>" alt="">
                                                    </span>
                                                    <span class="text">Thanh toán khi nhận hàng</span>
                                                </label>
                                            </div>
                                            <div class="payment_item">
                                                <input type="radio" class="d_none select_payment_method" data-vnTitle="Thẻ ATM nội địa/ Internet Banking" name="payment_method" id="cod_ATM">
                                                <label for="cod_ATM" class="payment_item_inner">
                                                    <span class="image">
                                                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/card_bank.png"); }} ?>" alt="">
                                                    </span>
                                                    <span class="text">Thẻ ATM nội địa/ Internet Banking</span>
                                                </label>
                                            </div>
                                        </divc>
                                    </div>
                                </div>
                            </div>
                            <div class="grid_column_12 grid_column_lg_5 ShippingAddress">
                                <div class="info_customer_inner">
                                    <?php if( Auth::isLogin() ) : ?>
                                        <div class="form_info" data-log="uLog">
                                            <div class="heading d_flex justify_content_between">
                                                <span>Địa chỉ giao hàng</span>
                                                <a href="<?php {{ echo Config::getBaseUrlClient("dia-chi-thanh-toan.html"); }} ?>" class="edit_address_order">Sửa</a>
                                            </div>
                                            <?php if( !empty($addressOrder) ) : ?>
                                                <div class="body">
                                                    <p class="name"><?php {{ echo $addressOrder['address_fullname']; }} ?></p>
                                                    <p class="address">
                                                        <span class="label">Địa chỉ: </span>
                                                        <span><?php {{ echo $addressOrder['address_value']; }} ?></span>
                                                    </p>
                                                    <p class="phone">
                                                        <span class="label">Điện thoại: </span>
                                                        <span><?php {{ echo $addressOrder['address_phone']; }} ?></span>
                                                    </p>
                                                    <div class="note_order">
                                                        <textarea id="customer_note" class="form_control" placeholder="Chú thích đơn hàng..." spellcheck="false" style="width: 100%; height: 50px;"></textarea>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="body" data-s-address="not_selected">
                                                    <p class="not_select_address">Chưa chọn địa chỉ giao hàng</p>
                                                    <p class="error select_address_error"></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="form_info" data-log="cLog">
                                            <div class="heading">Thông tin mua hàng</div>
                                            <div class="body">
                                                <div class="form_info_group">
                                                    <label for="customer_fullname">Họ và tên</label>
                                                    <input type="text" class="form_control" name="customer_fullname" id="customer_fullname" placeholder="Họ và tên..." autocomplete="off" spellcheck="false">
                                                    <p class="error customer_fullname_error"></p>
                                                </div>
                                                <div class="form_info_group">
                                                    <label for="customer_phone">Số điện thoại</label>
                                                    <input type="text" class="form_control" name="customer_phone" id="customer_phone" placeholder="Số điện thoại..." autocomplete="off" spellcheck="false">
                                                    <p class="error customer_phone_error"></p>
                                                </div>
                                                <div class="form_info_group">
                                                    <label for="customer_phone">Địa chỉ Email</label>
                                                    <input type="text" class="form_control" name="customer_email" id="customer_email" placeholder="Địa chỉ email..." autocomplete="off" spellcheck="false">
                                                    <p class="error customer_email_error"></p>
                                                </div>
                                                <div class="form_info_group">
                                                    <label for="customer_address">Địa chỉ nhận hàng</label>
                                                    <input type="text" class="form_control" name="customer_address" id="customer_address" placeholder="Địa chỉ nhận hàng..." autocomplete="off" spellcheck="false">
                                                    <p class="error customer_address_error"></p>
                                                </div>
                                                <div class="note_order">
                                                    <textarea id="customer_note" class="form_control" placeholder="Chú thích đơn hàng..." spellcheck="false" style="width: 100%; height: 50px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="info_cart_inner">
                                    <div class="form_info">
                                        <div class="heading">
                                            <span class="info_cart">Đơn hàng ( <?php {{ echo $totalOrder; }} ?> sản phẩm)</span>
                                            <a href="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>" class="edit_cart">Sửa</a>
                                        </div>
                                        <div class="body">
                                            <div class="cart">
                                                <div class="products">
                                                    <?php foreach( $listProdCartStore as $cartStoreItem ) : ?>
                                                        <?php {{ $cartStoreItem['prod_url'] = Config::getBaseUrlClient("{$cartStoreItem['prod_seoUrl']}-p{$cartStoreItem['prod_id']}.html"); }} ?>
                                                        <div class="products_item">
                                                            <div class="info">
                                                                <strong class="qty"><?php {{ echo $cartStoreItem['cart_num_qty']; }} ?> x</strong>
                                                                <a href="<?php {{ echo $cartStoreItem['prod_url']; }} ?>" class="name"><?php {{ echo $cartStoreItem['prod_name']; }} ?></a>
                                                            </div>
                                                            <?php if( !empty($cartStoreItem['flashSale']) ) : ?>
                                                                <div class="price"><?php {{ echo Format::formatCurrency($cartStoreItem['flashSale'][0]['prod_flashsale_price']); }} ?></div>
                                                            <?php else : ?>
                                                                <div class="price"><?php {{ echo Format::formatCurrency($cartStoreItem['prod_currentPrice']); }} ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="price_summary">
                                                    <div class="price_info_item">
                                                        <div class="label">Tạm tính</div>
                                                        <div class="value"><?php {{ echo Format::formatCurrency($totalPriceCart); }} ?></div>
                                                    </div>
                                                    <div class="price_info_item">
                                                        <div class="label">Phí vận chuyển</div>
                                                        <div class="value"><?php {{ echo $totalPriceCart >= 500000 ? "0₫" : "Chúng tôi sẽ liên hệ lại với bạn"; }} ?></div>
                                                    </div>
                                                    <div class="price_total">
                                                        <div class="name">Thành tiền: </div>
                                                        <div class="value">
                                                            <p class="price"><?php {{ echo Format::formatCurrency($totalPriceCart); }} ?></p>
                                                            <i>(Đã bao gồm VAT nếu có)</i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order_action_button_inner">
                                    <button type="button" class="order_action" id="order_action_button">TIẾN HÀNH ĐẶT MUA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                        <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                        <p style="font-size: .9rem;">Bạn chưa thêm sản phẩm nào vào giỏ hàng</p>
                        <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                        <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                    </div>
                <?php endif; ?>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <script>
        let btnOpen  = $(".address_list .address_item .address_inner .edit_address");
        let btnClose = $(".address_inner .edit .cancel")
        btnOpen.click(function() {
            $(this).parents('.address_inner').addClass('edit');
        });
        btnClose.click(function() {
            $(this).parents('.address_inner').removeClass('edit');
        });
    </script>
</body>
</html>