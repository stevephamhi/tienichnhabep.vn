<?php
    $aboutus = new AboutusModel;
    $listAboutus = $aboutus->getListAboutUs();
    $config = new ConfigController;
    $configInfo = ($config->getConfig()[0]);
?>
<footer class="footer_sc">
    <div class="footer_container_new_letter" style="padding: 5px 0;">
        <div class="container">
            <div class="line_top">
                
                <p class="copy-right" style="margin-top: 3px; font-size: .9rem">Tienichnhabep.vn - Trang thương mại điện tử mang đến cho người tiêu dùng các sản phẩm thiết bị nhà bếp thông minh</p>
            </div>
        </div>
    </div>
    <div class="footer_container_total_info">
        <div class="total_info_list container grid_row justify_content_center">
            <div class="total_info_item">
                <h4 class="title_top" style="margin-bottom: 8px;font-family: 'tienitnhabep-mainFont-Bold';">Chăm Sóc Khách Hàng</h4>
                <div class="list_bottom">
                    <div>
                        <strong style="font-family: 'tienitnhabep-mainFont-Bold'; color: #ffbc00; font-size: .9rem;">Hotline chăm sóc khách hàng: 0708 0708 27</strong>
                        <p>( 24/24 - Tất cả các ngày trong tuần )</p>
                    </div>
                </div>
            </div>
            <?php if(!empty($listAboutus)) : ?>
            <div class="total_info_item">
                <h4 class="title_top" style="margin-bottom: 8px;font-family: 'tienitnhabep-mainFont-Bold';">Về Tienichnhabep.vn</h4>
                <div class="list_bottom">
                    <?php foreach($listAboutus as $aboutusItem) : ?>
                    <a href="<?php {{ echo Config::getBaseUrlClient("{$aboutusItem['policy_seoUrl']}-i{$aboutusItem['policy_id']}.html"); }} ?>" rel="noreferrer" target="_blank" style="padding: 5px 0; font-size: .9rem; color: #fff;" class="link_view"><?php {{ echo $aboutusItem['policy_title']; }} ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="total_info_item">
                <h4 class="title_top" style="margin-bottom: 8px;font-family: 'tienitnhabep-mainFont-Bold';">Phương Thức Thanh Toán</h4>
                <div class="list_bottom">
                    <p class="grid_row" style="width: 70%;">
                        <span class="grid_column_4" style="display: block; width: 54px; padding: 2px;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/visa.svg"); }} ?>" alt="">
                        </span>
                        <span class="grid_column_4" style="display: block; width: 54px; padding: 2px;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/mastercard.svg"); }} ?>" alt="">
                        </span>
                        <span class="grid_column_4" style="display: block; width: 54px; padding: 2px;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/jcb.svg"); }} ?>" alt="">
                        </span>
                        <span class="grid_column_4" style="display: block; width: 54px; padding: 2px;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/cash.svg"); }} ?>" alt="">
                        </span>
                        <span class="grid_column_4" style="display: block; width: 54px; padding: 2px;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/internet-banking.svg"); }} ?>" alt="">
                        </span>
                        <span class="grid_column_4" style="display: block; width: 54px; padding: 2px;">
                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/installment.svg"); }} ?>" alt="">
                        </span>
                    </p>
                </div>
            </div>
            <div class="total_info_item">
                <h4 class="title_top" style="margin-bottom: 8px;font-family: 'tienitnhabep-mainFont-Bold';">Kết Nối Với Chúng Tôi</h4>
                <div class="list_bottom grid_row">
                    <a href="https://www.facebook.com/tienichnhabep.vn/" target="_blank" rel="noreferrer" title="facebook" style="width: 45px; height: 45px;">
                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/facebook_icon.png"); }} ?>" alt="facebook icon">
                    </a>
                    <a href="https://zalo.me/0708070827" target="_blank" rel="noreferrer" title="zalo" style="width: 45px; height: 45px; margin-left: 5px;">
                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/zalo_icon.png"); }} ?>" alt="zalo icon">
                    </a>
                    <a href="#" target="_blank" rel="noreferrer" title="zalo" style="width: 45px; height: 45px; margin-left: 5px;">
                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/youtube_icon.png"); }} ?>" alt="zalo icon">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_container_certification">
        <div class="certification_list_info container grid_row">
            <div class="certification_left certification_item grid_column_12 grid_column_lg_6">
                <div class="info_config_footer">
                    <?php if(!empty($configInfo['config_address_company'])) : ?>
                        <div class='info_item'><strong style="font-family:'tienitnhabep-mainFont-Bold'; font-size: .9rem;">Địa chỉ:</strong> <?php {{ echo $configInfo['config_address_company']; }} ?></div>
                        <p class='info_item'>Tiện ích nhà bếp nhận đặt hàng trực tuyến và giao hàng tận nơi, Miễn phí giao hàng cho đơn hàng từ 500k áp dụng Toàn Quốc</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_container_copyright">
        <div class="container">
            <div class="copyright_list_info">
                <p class="info_item">© 2000 - Bản quyền website thuộc về Công Ty Tiến Phát - tienichnhabep.vn</p>
            </div>
        </div>
    </div>
</footer>
<div class="d_none" id="baseURL" data-url="<?php {{ echo Config::getBaseUrlClient(); }} ?>"></div>
<script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/config/lazyLoad.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/app/search.ajax.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/app/product.ajax.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/app/cart.ajax.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/app/global.ajax.js"); }} ?>"></script>
<script>
    let url_tab_h = ((window.location.href).split("tab_h="))[1];
    if(url_tab_h !== undefined) {
        let data_tab_el = document.querySelector("[data-tab-h='"+(url_tab_h)+"']");
        data_tab_el.classList.add('active');
    }
</script>
<script>
    window.onscroll = function() {myFunction()};
    var navbar = document.querySelector(".list_menu_control");
    var sticky = navbar.offsetTop;
    function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
    }
</script>
<script>
    $(function() {
        $("img.lazy").show().lazyload();
        $("img.lazy").lazyload({
            threshold : 200,
            effect : "fadeIn",
        });
    });
</script>
<!-- #////////////// -->
<script>
    $(function () {
        $(window).scroll(function () {
            let widthScreenCurrent = $(window).width() + 17;
            if (widthScreenCurrent < 1280) {
                let distanceScrollTop = $(window).scrollTop();
                if (distanceScrollTop > 100) {
                    $(".header_sc").addClass("scrolling");
                } else {
                    $(".header_sc").removeClass("scrolling");
                }
            }
        });
    });
</script>
<!-- #////////////// -->
<script>
    $(function() {
        let buttonEl = $(".middle_full_container .menu_button_custom");
        let maskFullScreen = $(".mask_full_screen");
        let homePage = $(".home_page");
        let menuMainCustom = $(".middle_full_container .main_navigation_menu");
        buttonEl.click(function() {
            let widthScreenCurrent = $(window).width() + 17;
            if (widthScreenCurrent < 1280) {
                homePage.addClass('respon');
            }
        });
        maskFullScreen.click(function() {
            let widthScreenCurrent = $(window).width() + 17;
            if (widthScreenCurrent < 1280) {
                homePage.removeClass('respon');
            }
        });
        buttonEl.hover(function() {
            let widthScreenCurrent = $(window).width() + 17;
            if (widthScreenCurrent < 1280) {
                menuMainCustom.stop().hide();
            }
        }, function() {});
    });
</script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
    FB.init({
            xfbml   : true,
            version : 'v9.0'
        });
    };
    (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Your Chat Plugin code -->
<div class="fb-customerchat" attribution=setup_tool page_id="102709655073257" theme_color="#13cf13" logged_in_greeting="Chào bạn, Tiện tích nhà bếp có thể giúp gì cho bạn ạ !" logged_out_greeting="Chào bạn, Tiện tích nhà bếp có thể giúp gì cho bạn ạ !"></div>