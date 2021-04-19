<!DOCTYPE html>
<html lang="en">
<head>
    <title>Giỏ hàng - Có <?php echo !empty($totalOrder) ? $totalOrder." sản phẩm" : "0 sản phẩm" ?> trong giỏ hàng</title>
    <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
    <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="vi">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="website">
    <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
    <meta name="description" content="<?php {{ echo !empty($configInfo['config_metaDesc']) ? $configInfo['config_metaDesc'] : null; }} ?>">
    <meta name="keywords" content="<?php {{ echo !empty($configInfo['config_metaKeyword']) ? $configInfo['config_metaKeyword'] : null; }} ?>">
    <meta property="og:title" content="Giỏ hàng - Có <?php echo !empty($totalOrder) ? $totalOrder." sản phẩm" : "0 sản phẩm" ?> trong giỏ hàng">
    <meta property="og:description" content="<?php {{ echo !empty($configInfo['config_metaDesc']) ? $configInfo['config_metaDesc'] : null; }} ?>">
    <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>">
    <meta property="og:site_name" content="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>">
    <meta property="og:image" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlClient($configInfo['config_image']) : null; }} ?>">
    <meta property="og:image:secure_url" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlClient($configInfo['config_image']) : null; }} ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Giỏ hàng - Có <?php echo !empty($totalOrder) ? $totalOrder." sản phẩm" : "0 sản phẩm" ?> trong giỏ hàng">
    <meta name="twitter:description" content="<?php {{ echo !empty($configInfo['config_metaDesc']) ? $configInfo['config_metaDesc'] : null; }} ?>">
    <meta name="twitter:image" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlClient($configInfo['config_image']) : null; }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/cart.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <section class="breadcrum_wrap">
                <div class="container">
                    <ol class="breadcrum_list grid_row align_items_center">
                        <li class="breadcrum_item home d_flex align_items_center">
                            <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="breadcrum_link" title="Về trang chủ">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="breadcrum_item nav3 d_flex align_items_center position_relative">
                            <a href="" class="breadcrum_link" title="">
                                <span>Giỏ hàng</span>
                            </a>
                        </li>
                    </ol>
                </div>
            </section>
            <main class="main_sc">
                <?php if( !empty($listProdCartStore) ) : ?>
                    <section class="checkout_info_wrap">
                        <div class="container">
                            <div class="grid_row">
                                <div class="grid_column_12">
                                    <h4 class="cart_products_title">
                                        <span>Giỏ hàng</span>
                                        <span class="cart_products_count">( <b class="value_numOrder_cart" style="font-weight: 100;"><?php {{ echo $totalOrder; }} ?></b> sản phẩm ) / Tổng: <b class="value_numTotal_price" style="font-weight: 100;"><?php {{ echo Format::formatCurrency($totalPriceCart); }} ?></b></span>
                                    </h4>
                                    <small class="cart_products_note">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        <span>Nhấn vào ô vuông để chọn sản phẩm đặt hàng</span>
                                    </small>
                                </div>
                                <div class="cart_inner grid_column_12 grid_column_lg_9">
                                    <div class="cart_products">
                                        <div class="alert_wrap" style="padding: 0; margin-bottom: 10px;">
                                            <div class="alert alert_success position_relative" data-status="true">
                                                <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                                                <span></span>
                                                <button type="button" class="close position_absolute">x</button>
                                            </div>
                                        </div>
                                        <div class="cart_products_inner">
                                            <?php foreach( $listProdCartStore as $cartStoreItem ) : ?>
                                                <?php {{ $cartStoreItem['prod_url']  = Config::getBaseUrlClient("{$cartStoreItem['prod_seoUrl']}-p{$cartStoreItem['prod_id']}.html"); }} ?>
                                                <?php {{ $cartStoreItem['brand_url'] = Config::getBaseUrlClient(Format::create_slug($cartStoreItem['brand_name']) . "-b{$cartStoreItem['brand_id']}.html"); }} ?>
                                                <div class="cart_products_group" p-id="<?php {{ echo $cartStoreItem['prod_id']; }} ?>">
                                                    <?php if( ($cartStoreItem['prod_installment'] == "1") || !empty($cartStoreItem['prod_discout_content']) || !empty($cartStoreItem['prod_deliveryPromo']) ) : ?>
                                                        <div class="cart_seller_discount d_flex align_items_center">
                                                            <div class="title">ƯU ĐÃI:</div>
                                                            <div class="list d_flex align_items_center">
                                                                <?php if($cartStoreItem['prod_installment'] == "1") : ?>
                                                                    <div class="cart_installment d_flex align_items_center">
                                                                        <span>Trả góp <?php {{ echo $cartStoreItem['prod_installment_rate']."%"; }} ?></div></span>
                                                                <?php endif; ?>
                                                                <?php if(!empty($cartStoreItem['prod_discout_content'])) : ?>
                                                                    <div class="cart_promo_wrap">
                                                                        <a target="_blank" href="<?php {{ echo $cartStoreItem['prod_url']; }} ?>" class="cart_promo_link d_flex align_items_center">
                                                                            <span>Quà tặng hấp dẫn</span>
                                                                        </a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if(!empty($cartStoreItem['prod_deliveryPromo'])) : ?>
                                                                    <div class="cart_freeship_sale"><?php {{ echo $cartStoreItem['prod_deliveryPromo']; }} ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="cart_products_info">
                                                        <div class="cart_products_img">
                                                            <a href="<?php {{ echo $cartStoreItem['prod_url']; }} ?>">
                                                                <img src="<?php {{ echo Config::getBaseUrlAdmin($cartStoreItem['prod_avatar']); }} ?>" alt="<?php {{ echo $cartStoreItem['prod_name']; }} ?>">
                                                            </a>
                                                        </div>
                                                        <div class="cart_products_content">
                                                            <div class="cart_products_desc">
                                                                <a href="<?php {{ echo $cartStoreItem['prod_url']; }} ?>" class="cart_products_name"><?php {{ echo $cartStoreItem['prod_name']; }} ?></a>
                                                                <a href="<?php {{ echo $cartStoreItem['brand_url']; }} ?>" class="cart_products_brand"><?php {{ echo $cartStoreItem['brand_name']; }} ?></a>
                                                                <p class="cart_products_actions">
                                                                    <span class="cart_btn__delete">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>Xóa
                                                                    </span>
                                                                </p>
                                                            </div>
                                                            <div class="cart_products_detail">
                                                                <?php if( !empty($cartStoreItem['flashSale']) ) : ?>
                                                                    <div class="cart_products_pricess">
                                                                        <p class="real_price"><?php {{ echo Format::formatCurrency($cartStoreItem['flashSale'][0]['prod_flashsale_price']); }} ?></p>
                                                                        <p class="discount_prices">
                                                                            <del><?php {{ echo Format::formatCurrency($cartStoreItem['prod_oldPrice']); }} ?></del>
                                                                            <?php if( (int) $cartStoreItem['flashSale'][0]['prod_flashsale_price'] < (int) $cartStoreItem['prod_oldPrice'] ) : ?>
                                                                                <span class="percent_prices"><?php {{ echo Format::promotionalPercent( $cartStoreItem['flashSale'][0]['prod_flashsale_price'], $cartStoreItem['prod_oldPrice'] ); }} ?></span>
                                                                            <?php endif; ?>
                                                                        </p>
                                                                    </div>
                                                                <?php else : ?>
                                                                    <div class="cart_products_pricess">
                                                                        <p class="real_price"><?php {{ echo Format::formatCurrency($cartStoreItem['prod_currentPrice']); }} ?></p>
                                                                        <p class="discount_prices">
                                                                            <del><?php {{ echo Format::formatCurrency($cartStoreItem['prod_oldPrice']); }} ?></del>
                                                                            <?php if( (int)$cartStoreItem['prod_currentPrice'] < (int)$cartStoreItem['prod_oldPrice'] ) : ?>
                                                                                <span class="percent_prices"><?php {{ echo Format::promotionalPercent( $cartStoreItem['prod_currentPrice'], $cartStoreItem['prod_oldPrice'] ); }} ?></span>
                                                                            <?php endif; ?>
                                                                        </p>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="cart_products_qty">
                                                                    <div class="amout_wrap d_flex align_items_center">
                                                                        <button type="button" class="btn_item minus">-</button>
                                                                        <input type="text" disabled="disabled" name="amount" class="cart_num_qty" value="<?php {{ echo $cartStoreItem['cart_num_qty']; }} ?>" autocomplete="off" spellcheck="false" data-max="<?php {{ echo $cartStoreItem['prod_amount']; }} ?>">
                                                                        <button type="button" class="btn_item plus">+</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart_total_prices grid_column_12 grid_column_lg_3">
                                    <div class="cart_total_inner">
                                        <?php if( Auth::isLogin() ) : ?>
                                            <div class="shipping_address">
                                                <p class="heading">
                                                    <span class="text">Địa chỉ nhận hàng</span>
                                                    <a href="<?php {{ echo Config::getBaseUrlClient("dia-chi-thanh-toan.html"); }} ?>" class="link">Thay đổi</a>
                                                </p>
                                                <?php if( !empty($addressOrder) ) : ?>
                                                    <div class="title">
                                                        <div class="d_flex title_line">
                                                            <p class="name"><?php {{ echo $addressOrder['address_fullname']; }} ?></p>
                                                            <p class="phone"><?php {{ echo Format::formatPhone($addressOrder['address_phone']); }} ?></p>
                                                        </div>
                                                        <p class="email"><?php {{ echo $customerItem['customer_email']; }} ?></p>
                                                    </div>
                                                    <p class="address"><?php {{ echo $addressOrder['address_value']; }} ?></p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="cart_coupon">
                                            <p class="headding">Khuyến mãi</p>
                                            <label for="coupon_code_discount_check" class="show_box_input">
                                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                                <span>Nhập mã khuyến mãi</span>
                                            </label>
                                            <input type="checkbox" class="d_none" id="coupon_code_discount_check">
                                            <div class="coupon_code_discount_box">
                                                <input type="text" class="form_control" id="coupon_code_discount" placeholder="Nhập mã khuyến mãi" autocomplete="off" spellcheck="false">
                                                <button type="button" class="check_coupon_code_discount_btn">Áp dụng</button>
                                            </div>
                                        </div>
                                        <div class="cart_prices">
                                            <div class="tab_prices">
                                                <p class="title">Tạm tính</p>
                                                <p class="value value_numTotal_price"><?php {{ echo Format::formatCurrency($totalPriceCart); }} ?></p>
                                            </div>
                                            <div class="tab_prices">
                                                <p class="title">Phí vận chuyển</p>
                                                <p class="value delivery_charges">
                                                    <?php {{ echo $totalPriceCart >= 500000 ? "0₫" : "Chúng tôi sẽ liên hệ lại với bạn"; }} ?>
                                                </p>
                                            </div>
                                            <div class="tab_prices total_price">
                                                <p class="title">Thành tiền</p>
                                                <p class="value value_numTotal_price"><?php {{ echo Format::formatCurrency($totalPriceCart); }} ?></p>
                                            </div>
                                        </div>
                                        <a href="<?php {{ echo Config::getBaseUrlClient("phuong-thuc-thanh-toan.html"); }} ?>" type="button" class="cart_submit text_center">Tiến hành đặt hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php else : ?>
                    <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                        <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                        <p style="font-size: .9rem;">Không có sản phẩm nào trong giỏ hàng</p>
                        <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                        <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                    </div>
                <?php endif; ?>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <div class="modal_mail">
        <div class="modal_mail_mask"></div>
        <div class="modal_mail_content">
            <div class="modal_mail_header d_flex justify_content_center align_items_center">
                <i class="fa fa-check icon" aria-hidden="true"></i>
                <span class="text">Đặt hàng thành công</span>
            </div>
            <div class="modal_mail_body">
                <a target="_blank" href="" class="btn_mail" style="font-size: .9rem; text-align:center;">
                    <span class="d_block">TRUY CẬP E.MAIL</span>
                </a>
            </div>
        </div>
    </div>
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
</body>
</html>