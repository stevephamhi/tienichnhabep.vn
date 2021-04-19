<?php
    $base = new Base;
?>
<header class="header">
    <div class="header_wrap d_flex align_items_center justify_content_between">
        <div class="navbar_header_left d_flex align_items_center">
            <a href="" class="navbar_h_item navIcon_aside_toggle">
                <i class="fa fa-outdent" aria-hidden="true"></i>
            </a>
            <a href="" class="navbar_h_item logoTop_header">
                <img width="120" src="./public/images/logo/logo_full.png" alt="LOGO CÔNG TY TIẾN PHÁT">
            </a>
        </div>
        <div class="navbar_header_right">
            <div class="mask_dropdown"></div>
            <ul class="list_action_app d_flex align_items_center">
                <li class="action_app_item position_relative">
                    <a href="" class="action_label notification position_relative" title="Thông báo">
                        <span class="value label_danger text_white position_absolute">0</span>
                        <i class="fa fa-bell" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown_menu position_absolute">
                        <li class="dropdown_header">Nâng cấp</li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Yêu cầu cập nhật</span>
                                <span class="label_warning value">0</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown_header">Đơn đặt hàng</li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Đang xử lý</span>
                                <span class="label_warning value">0</span>
                            </a>
                        </li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Đã xử lý</span>
                                <span class="label_success value">0</span>
                            </a>
                        </li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Đổi / Trả hàng</span>
                                <span class="label_danger value">0</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown_header">Khách hàng</li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Đang truy cập</span>
                                <span class="label_success value">0</span>
                            </a>
                        </li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Chờ duyệt</span>
                                <span class="label_danger value">0</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown_header">Sản phẩm</li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Hết hàng</span>
                                <span class="label_danger value">0</span>
                            </a>
                        </li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Nhận xét</span>
                                <span class="label_danger value">0</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown_header">Cộng tác viên</li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Chờ duyệt</span>
                                <span class="label_danger value">0</span>
                            </a>
                        </li>
                        <li class="dropdown_menu_vl_item">
                            <a href="" class="d_flex justify_content_between align_items_center">
                                <span class="label">Yêu cầu rút tiền</span>
                                <span class="label_danger value">0</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="action_app_item">
                    <a target="_blank" href="<?php {{ echo $base->getBaseURLClient(); }} ?>" class="action_label" title="Cửa hàng">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="action_app_item">
                    <a href="<?php {{ echo $base->getBaseURLAdmin("User/logout"); }} ?>" class="action_label" title="Đăng xuất">
                        <span class="title">Thoát</span>
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>