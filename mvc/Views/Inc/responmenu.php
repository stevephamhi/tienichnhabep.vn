<?php
    $flashSale        = new FlashsaleController;
    $moduleFlashsale  = $flashSale->getModuleFlashsaleUrl()['moduleFlashsale'];
    $customer = new Customer;
?>
<div class="mobile_size">
    <div class="mobile_mn_wrap">
        <div class="mobile_mn_header d_flex align_items_center justify_content_between">
            <?php if( Auth::isLogin() ) : ?>
                <a href="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>" class="mobile_mn_user d_flex align_items_center w_100">
                    <div class="icon_group">
                        <span style="margin-right: 4px; width: 40px; height: 40px; display: block; border-radius: 100%; overflow: hidden;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient($customer->getInfoCustomer("customer_avatar", Session::get("isLgTP_set"))); }} ?>" alt="<?php {{ echo $customer->getInfoCustomer("customer_fullname", Session::get("isLgTP_set")); }} ?>">
                        </span>
                    </div>
                    <div class="title_group">
                        <span class="main_title d_block"><?php {{ echo $customer->getInfoCustomer("customer_fullname", Session::get("isLgTP_set")); }} ?></span>
                        <span class="sub_title d_block">Thông tin cá nhân</span>
                    </div>
                </a>
                <i class="mobile_mn_iconUser fa fa-angle-right" aria-hidden="true"></i>
            <?php else : ?>
                <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" class="mobile_mn_user d_flex align_items_center w_100">
                    <div class="icon_group">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="title_group">
                        <span class="main_title d_block">Đăng nhập</span>
                        <span class="sub_title d_block">Nhận nhiều ưu đãi hơn</span>
                    </div>
                </a>
                <i class="mobile_mn_iconUser fa fa-angle-right" aria-hidden="true"></i>
            <?php endif; ?>
        </div>
        <div class="mobile_mn_body">
            <div class="mn_boby_content_item">
                <ul class="mn_list">
                    <li class="mn_item">
                        <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="mn_view_link">
                            <i class="icon fa fa-home" aria-hidden="true"></i>
                            <span class="label">Trang chủ</span>
                        </a>
                    </li>
                    <li class="mn_item">
                        <a href="<?php {{ echo Config::getBaseUrlClient("danh-muc-san-pham.html"); }} ?>" id="" class="mn_view_link">
                            <i class="icon fa fa-list" aria-hidden="true"></i>
                            <span class="label">Danh sách ngành hàng</span>
                        </a>
                    </li>
                    <li class="mn_item">
                        <a href="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>" class="mn_view_link">
                            <i class="icon fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="label">Giỏ hàng</span>
                            (<span class="value_numOrder_cart"><?php {{
                                echo Session::check("cart") ? Session::get("cart")['info']['numOrder'] : "0";
                            }} ?></span>)
                        </a>
                    </li>
                    <li class="mn_item">
                        <a href="<?php {{ echo Config::getBaseUrlClient("san-pham-thanh-ly-gia-re"); }} ?>" class="mn_view_link d_flex align_items_center">
                            <span class="label">Sản phẩm thanh lý</span>
                        </a>
                    </li>
                </ul>
                <ul class="mn_list">
                    <?php if( Auth::isLogin() ) : ?>
                        <li class="mn_item">
                            <a href="<?php {{ echo Config::getBaseUrlClient("don-hang-cua-toi.html"); }} ?>" class="mn_view_link d_flex align_items_center">
                                <span class="label">Quản lý đơn hàng</span>
                            </a>
                        </li>
                        <li class="mn_item">
                            <a href="<?php {{ echo Config::getBaseUrlClient("so-dia-chi.html"); }} ?>" class="mn_view_link d_flex align_items_center">
                                <span class="label">Sổ địa chỉ</span>
                            </a>
                        </li>
                        <li class="mn_item">
                            <a href="<?php {{ echo Config::getBaseUrlClient("dang-xuat.html"); }} ?>" class="mn_view_link d_flex align_items_center">
                                <span class="label" style="margin-right: 5px">Đăng xuất</span>
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                            </a>
                        </li>
                    <?php else : ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="mn_boby_content_item">
                <div class="mn_body_title_top">KHUYẾN MÃI HOT</div>
                <div class="mn_body_content">
                    <ul class="mn_list">
                        <?php if( !empty($moduleFlashsale) ) : ?>
                            <li class="mn_item">
                                <a href="<?php {{ echo Config::getBaseUrlClient(Format::create_slug($moduleFlashsale['module_name']) . "/m" . $moduleFlashsale['module_id'] . "/" . $moduleFlashsale['module_seoUrl'] . ".html#tab=flash-sale"); }} ?>" class="mn_view_link">
                                    <span class="label">Flash sale</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="mn_boby_content_item">
                <div class="mn_body_title_top">HỖ TRỢ</div>
                <div class="mn_body_content">
                    <ul class="mn_list">
                        <li class="mn_item">
                            <a href="tel:0708070827" class="mn_view_link">
                                <span class="label">HOTLINE: 0708 0708 27</span>
                            </a>
                        </li>
                        <li class="mn_item">
                            <a href="tel:0708070827" class="mn_view_link">
                                <span class="label">Hỗ trợ khách hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>