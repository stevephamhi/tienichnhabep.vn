<?php
    $config = new ConfigController;
    $configInfo = ($config->getConfig()[0]);
    $customer = new Customer;
?>
<style> .lazy { display: none; } </style>
<?php {{ view("Inc.analysisScript"); }} ?>
<div class="header_mask"></div>
<header class="header_sc grid_row">
    <div class="header_promo grid_column_12">
        <div class="container">
            <div class="promo_quick_right d_flex align_items_center justify_content_end">
                <a href="0708070827" class="promo_quick_item d_inline_flex align_items_center" rel="nofollow" data-view-index="0">
                    <img style="margin-right: 4px;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/phone_icon.png"); }} ?>" alt="Liên hệ với nhân viên của tiện ích nhà bếp" width="18">
                    <span>0708 0708 27</span>
                </a>
                <a href="https://www.facebook.com/tienichnhabep.vn" target="_blank" class="promo_quick_item d_inline_flex align_items_center" rel="nofollow" data-view-index="0">
                    <img style="margin-right: 4px;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/fb_icon.png"); }} ?>" alt="Kênh fanpage của tiện ích nhà bếp" width="18">
                    <span>fb/tienichnhabep.vn</span>
                </a>
                <a href="mailTo:tienichnhabep.vn@gmail.com" target="_blank" class="promo_quick_item d_inline_flex align_items_center" rel="nofollow" data-view-index="0">
                    <img style="margin-right: 4px;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/email_icon.png"); }} ?>" alt="Liên hệ với tiện ích nhà bếp qua email" width="25">
                    <span>tienichnhabep.vn@gmail.com</span>
                </a>
                <a href="https://www.youtube.com/channel/UCEwo6dzxlTZwV9A8FnTRvzA?guided_help_flow=5" target="_blank" class="promo_quick_item d_inline_flex align_items_center" rel="nofollow" data-view-index="0">
                    <img style="margin-right: 4px;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/youtobe.png"); }} ?>" alt="Kênh youtube của tiện ích nhà bếp" width="19">
                    <span>youtube/Tiện ích nhà bếp</span>
                </a>
            </div>
        </div>
    </div>
    <div class="header_container_top grid_column_12">
        <div class="container">
            <div class="middle_wrap_header grid_row position_relative align_items_center">
                <div class="middle_left_container grid_column_12 grid_column_lg_7 d_flex align_items_center justify_content_between">
                    <div class="logo_root grid_column_3 align_items_center">
                        <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="header_main_logo">
                            <img src="<?php {{ echo !empty($configInfo['config_logo']) ? Config::getBaseUrlAdmin($configInfo['config_logo']) : null; }} ?>" width="170" alt="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
                        </a>
                    </div>
                    <div class="formSearch_root grid_column_12 grid_column_lg_9">
                        <div class="formSearch_form_sc w_100 d_flex justify_content_center position_relative">
                            <form data-form-action="no_action" class="position_relative" method="GET">
                                <input type="text" value="" class="formSearch_input w_100" placeholder="<?php {{ echo !empty($configInfo['config_placeholder_search']) ? $configInfo['config_placeholder_search'] : "Tìm sản phẩm, danh mục hay thương hiệu mong muốn ..."; }} ?>" autocomplete="off" spellcheck="false">
                                <button class="formSearch_button hover_pointer position_absolute">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Tìm kiếm</span>
                                </button>
                            </form>
                            <div class="search_action_recomment position_absolute">
                                <div class="search_action_recomment_wrap">
                                    <ul class="ac_list" id="ac_search_list_another"></ul>
                                    <ul class="ac_list" id="ac_search_list_prod"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="middle_right_container grid_column_5 align_items_center justify_content_start position_relative">
                    <div class="user_infomation_cart position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>" class="user_infomation_cart_view w_auto user_title d_inline_flex align_items_center">
                            <img class="icon_image" width="23" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/cart-logo.png"); }} ?>" alt="">
                            <span class="title">Giỏ hàng</span>
                            <span class="value value_numOrder_cart">0</span>
                        </a>
                        <div class="addCart_notification">
                            <a href="" class="btn_close">
                                <i class="fa fa-times"></i>
                            </a>
                            <p class="status">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                                <span>Thêm vào giỏ hàng thành công!</span>
                            </p>
                            <a class="product d_flex" href="">
                                <span class="prod_image">
                                    <img class="full_size img_contain" src="http://localhost/TIENICHNHABEP_SITE/tienichnhabep/admin/public/plugins/source/Bep_dien_tu/bep-tu-hong-ngoai-doi-Capri-cr-828kt.jpg" alt="">
                                </span>
                                <span class="prod_name">Báº¿p tá»« Ä‘a Ä‘iá»ƒm 3 vÃ¹ng náº¥u Capri CR-831KT</span>
                            </a>
                            <a href="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>" class="btn_view_cart">XEM GIỎ HÀNG</a>
                        </div>
                    </div>
                    <ul class="d_flex align_items_center h_100">
                        <li class="user_infomation_item">
                            <?php if( Auth::isLogin() ) : ?>
                                <a href="<?php {{ echo Config::getBaseUrlClient("don-hang-cua-toi.html"); }} ?>" class="user_infomation_item_link">LỊCH SỬ MUA HÀNG</a>
                            <?php else : ?>
                                <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" class="user_infomation_item_link">LỊCH SỬ MUA HÀNG</a>
                            <?php endif; ?>
                        </li>
                        <?php if( Auth::isLogin() ) : ?>
                            <li class="user_infomation_item position_relative">
                                <a style="width: 135px;" href="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>" class="user_infomation_item_link d_flex align_items_center">
                                    <?php if( !empty($customer->getInfoCustomer("customer_avatar", Session::get("isLgTP_set"))) ) : ?>
                                        <span style="display: block; flex: 0 0 30px; height: 30px; border-radius: 100%; overflow: hidden; margin-right: 2px;">
                                            <img class="full_size" style="object-fit: cover;" src="<?php {{ echo $customer->getInfoCustomer("customer_avatar", Session::get("isLgTP_set")); }} ?>" alt="">
                                        </span>
                                    <?php else : ?>
                                        <i style="font-size: 1.5rem; margin-right: 4px;" class="fa fa-user-o" aria-hidden="true"></i>
                                    <?php endif; ?>
                                    <div style="text-transform: capitalize; text-align: left; font-family:'tienitnhabep-mainFont-Light';">
                                        <p style="font-size: .7rem;">Tài khoảng</p>
                                        <p style="white-space: nowrap;">
                                            <span><?php {{ echo $customer->getInfoCustomer("customer_fullname", Session::get("isLgTP_set")); }} ?></span>
                                            <i style="transform: translateY(-2.5px); font-size: .5rem;" class="fa fa-sort-desc" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                </a>
                                <div class="user_option_dropdown position_absolute">
                                    <div class="list_menu">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("don-hang-cua-toi.html"); }} ?>" class="u_option_item">
                                            <i class="fa fa-history" aria-hidden="true"></i>
                                            <span>Đơn hàng của tôi</span>
                                        </a>
                                        <a href="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>" class="u_option_item">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            <span>Tài khoảng của tôi</span>
                                        </a>
                                        <a href="<?php {{ echo Config::getBaseUrlClient("dang-xuat.html"); }} ?>" class="u_option_item">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            <span>Thoát tài khoản</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="user_infomation_item">
                                <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" class="user_infomation_item_link d_flex align_items_center">
                                    <span>ĐĂNG NHẬP</span>
                                    <i style="font-size: 1.3rem;" class="fa fa-sign-in" aria-hidden="true"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="list_menu_control middle_full_container menu_wrapper_sc grid_column_12">
        <div class="container d_flex align_items_center justify_content_between">
            <div class="menu_button_custom">
                <a class="menu_button d_flex align_items_center">
                    <i class="fa fa-bars" style="font-size: 1.4rem; margin-right: 10px;" aria-hidden="true"></i>
                    <span style="margin-top: 2px;">DANH MỤC SẢN PHẨM</span>
                </a>
                <?php {{ view("Inc.mainmenu"); }} ?>
            </div>
            <div class="wrap_nav">
                <a href="<?php {{ echo Config::getBaseUrlClient("san-pham-thanh-ly-gia-re")."/tab_h=thanhly"; }} ?>" class="nav_link_view" data-tab-h="thanhly">
                    <span>Thanh lý - giá rẻ</span>
                </a>
                <a href="<?php {{ echo Config::getBaseUrlClient("dai-ly")."/tab_h=daily"; }} ?>" class="nav_link_view" data-tab-h="daily">
                    <span>Đại lý</span>
                </a>
            </div>
            <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="mobile_menu_respon">
                <img src="<?php {{ echo !empty($configInfo['config_logo']) ? Config::getBaseUrlAdmin($configInfo['config_logo']) : null; }} ?>" width="140" alt="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
            </a>
            <div class="list_icon_user_act_respon align_items_center">
                <a href="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>" style="padding: 0 6px;" class="d_flex icon_user_act_respon_item user_infomation_cart_view">
                    <span class='d_block' style='width: 26px; height: 26px;'>
                        <img style='width: 100%; height: 100%;' src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/cart-logo.png"); }} ?>" alt="">
                    </span>
                    <span class="numCart d_flex justify_content_center align_items_center value_numOrder_cart">0</span>
                </a>
            </div>
        </div>
    </div>
</header>