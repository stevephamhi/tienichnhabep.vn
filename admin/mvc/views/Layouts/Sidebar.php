<?php
    $helper = new Helper;
    $base   = new Base;
?>
<aside class="aside scroll_custom">
    <div class="profile d_flex align_items_center">
        <div class="logo_user">
            <img width="50" src="./public/images/logo/logo_small.png" alt="">
        </div>
        <div class="info_user">
            <h3 class="user_fullName"><?php {{ echo $helper->infoUser("user_fullname"); }} ?></h3>
            <small class="user_title"><?php {{ echo $helper->infoUser("user_title"); }} ?></small>
        </div>
    </div>
    <ul class="menu">
        <li class="menu-dashboard">
            <a href="">
                <i class="fa fa-dashboard"></i>
                <span>Bảng điều kiển</span>
            </a>
        </li>
        <li class="menu-catalog">
            <a href="" class="parent">
                <i class="fa fa-tags"></i>
                <span>Sản phẩm</span>
            </a>
            <ul class="dropdown_menu" data-panel="san_pham">
                <li class="active">
                    <a href="CateProduct" class="module_name" data-tab="san_pham">
                        <i class="fa fa-angle-right"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="Product" class="module_name" data-tab="san_pham">
                        <i class="fa fa-angle-right"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="FlashSale" class="module_name" data-tab="san_pham">
                        <i class="fa fa-angle-right"></i>
                        <span>Flash sale</span>
                    </a>
                </li>
                <li>
                    <a href="Brand" class="module_name" data-tab="san_pham">
                        <i class="fa fa-angle-right"></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a href="Review" class="module_name" data-tab="san_pham">
                        <i class="fa fa-angle-right"></i>
                        <span>Đánh giá</span>
                    </a>
                </li>
                <li>
                    <a href="Productsp" class="module_name" data-tab="san_pham">
                        <i class="fa fa-angle-right"></i>
                        <span>Thông tin hỗ trợ</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-sale">
            <a href="" class="parent">
                <i class="fa fa-shopping-basket"></i>
                <span>Bán hàng</span>
            </a>
            <ul class="dropdown_menu" data-panel="ban_hang">
                <li class="active">
                    <a href="Customer" class="module_name" data-tab="ban_hang">
                        <i class="fa fa-angle-right"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="Order" class="module_name" data-tab="ban_hang">
                        <i class="fa fa-angle-right"></i>
                        <span>Đơn Hàng</span>
                    </a>
                </li>
                <li>
                    <a href="SupportCustomer" class="module_name" data-tab="ban_hang">
                        <i class="fa fa-angle-right"></i>
                        <span>Đăng ký hỗ trợ</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-sale">
            <a href="" class="parent">
                <i class="fa fa-user-plus"></i>
                <span>Đại lý</span>
            </a>
            <ul class="dropdown_menu" data-panel="dai_ly">
                <li class="active">
                    <a href="Agency" class="module_name" data-tab="dai_ly">
                        <i class="fa fa-angle-right"></i>
                        <span>Đại lý</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-sale">
            <a href="" class="parent">
                <i class="fa fa-window-maximize"></i>
                <span>Banner</span>
            </a>
            <ul class="dropdown_menu" data-panel="banner">
                <li class="active">
                    <a href="GroupBannerMain" class="module_name" data-tab="banner">
                        <i class="fa fa-angle-right"></i>
                        <span>Banner chính</span>
                    </a>
                </li>
                <li>
                    <a href="GroupBannerBottom" class="module_name" data-tab="banner">
                        <i class="fa fa-angle-right"></i>
                        <span>Banner phụ dưới</span>
                    </a>
                </li>
                <li>
                    <a href="GroupBannerRight" class="module_name" data-tab="banner">
                        <i class="fa fa-angle-right"></i>
                        <span>Banner phụ phải</span>
                    </a>
                </li>
                <li>
                    <a href="GroupBannerPromo" class="module_name" data-tab="banner">
                        <i class="fa fa-angle-right"></i>
                        <span>Banner khuyến mãi</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-news">
            <a href="" class="parent">
                <i class="fa fa-newspaper-o"></i>
                <span>Tin tức</span>
            </a>
            <ul class="dropdown_menu" data-panel="tin_tuc">
                <li class="active">
                    <a href="CateNews" class="module_name" data-tab="tin_tuc">
                        <i class="fa fa-angle-right"></i>
                        <span>Danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="News" class="module_name" data-tab="tin_tuc">
                        <i class="fa fa-angle-right"></i>
                        <span>Tin tức</span>
                    </a>
                </li>
                <li>
                    <a href="CommentNews" class="module_name" data-tab="tin_tuc">
                        <i class="fa fa-angle-right"></i>
                        <span>Bình luận</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-design">
            <a href="" class="parent">
                <i class="fa fa-television"></i>
                <span>Website</span>
            </a>
            <ul class="dropdown_menu" data-panel="website">
                <li class="active">
                    <a href="Display" class="module_name" data-tab="website">
                        <i class="fa fa-angle-right"></i>
                        <span>Bố cục</span>
                    </a>
                </li>
                <li>
                    <a href="Background" class="module_name" data-tab="website">
                        <i class="fa fa-angle-right"></i>
                        <span>Ảnh nền</span>
                    </a>
                </li>
                <li>
                    <a href="Policy" class="module_name" data-tab="website">
                        <i class="fa fa-angle-right"></i>
                        <span>Chính sách</span>
                    </a>
                </li>
                <li>
                    <a href="" class="module_name" data-tab="website">
                        <i class="fa fa-angle-right"></i>
                        <span>Trang Thông tin</span>
                    </a>
                </li>
                <li>
                    <a href="VideoGroup" class="module_name" data-tab="website">
                        <i class="fa fa-angle-right"></i>
                        <span>Video</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-design">
            <a href="" class="parent">
                <i class="fa fa-plus-square"></i>
                <span>Module</span>
            </a>
            <ul class="dropdown_menu" data-panel="module">
                <li class="active">
                    <a href="Module" class="module_name" data-tab="module">
                        <i class="fa fa-angle-right"></i>
                        <span>Module</span>
                    </a>
                </li>
                <li class="active">
                    <a href="Moduleitem" class="module_name" data-tab="module">
                        <i class="fa fa-angle-right"></i>
                        <span>Tab module</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-system">
            <a href="" class="parent">
                <i class="fa fa-cog"></i>
                <span>Cấu hình</span>
            </a>
            <ul class="dropdown_menu" data-panel="cau_hinh">
                <li class="active">
                    <a href="Config" class="module_name" data-tab="cau_hinh">
                        <i class="fa fa-angle-right"></i>
                        <span>Cấu hình chung</span>
                    </a>
                </li>
                <li>
                    <a href="" class="module_name" data-tab="cau_hinh">
                        <i class="fa fa-angle-right"></i>
                        <span>Quản lý Tài khoản</span>
                    </a>
                </li>
                <li>
                    <a href="" class="module_name" data-tab="cau_hinh">
                        <i class="fa fa-angle-right"></i>
                        <span>Cài đặt Địa lý</span>
                    </a>
                </li>
                <li>
                    <a href="" class="module_name" data-tab="cau_hinh">
                        <i class="fa fa-angle-right"></i>
                        <span>Phí vận chuyển</span>
                    </a>
                </li>
                <li>
                    <a href="" class="module_name" data-tab="cau_hinh">
                        <i class="fa fa-angle-right"></i>
                        <span>Tùy chỉnh URL</span>
                    </a>
                </li>
                <li>
                    <a href="" class="module_name" data-tab="cau_hinh">
                        <i class="fa fa-angle-right"></i>
                        <span>Chuyển hướng 301</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<div id="baseURL" data-url="<?php {{ echo $base->getBaseURLAdmin(); }} ?>"></div>
<script>
    let url = window.location.href;
    let baseURL = document.getElementById("baseURL").getAttribute('data-url');
    let controller = url.split(baseURL)[1];
    let listSidebarTab = document.querySelectorAll(".module_name");
    let elTabCurrent = undefined;
    listSidebarTab.forEach(el => {
        let elTabName = el.getAttribute('href');
        if( elTabName.length > 0 ) {
            if( elTabName === controller ) {
                elTabCurrent = el;
            }
        }
    });
    if( elTabCurrent !== undefined ){
        elTabCurrent.classList.add('active');
        let tab_panel = document.querySelector("[data-panel='" + elTabCurrent.getAttribute('data-tab') +  "']").classList.add('open');
    }
</script>