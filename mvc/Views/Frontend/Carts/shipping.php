<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Thông tin giao hàng | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Thông tin giao hàng | Tienichnhabep.vn">
        <meta property="og:title" content="Thông tin giao hàng | Tienichnhabep.vn">
        <meta property="og:description" content="Thông tin giao hàng | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>">
        <meta property="og:site_name" content="Thông tin giao hàng | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Thông tin giao hàng | Tienichnhabep.vn">
        <meta name="twitter:description" content="Thông tin giao hàng | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/cart.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
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
                                    <div class="fill_color"></div>
                                </div>
                                <div class="circle">2</div>
                            </div>
                            <div class="process_step_item step_3">
                                <div class="text">Thanh toán & Đặt mua</div>
                                <div class="bar">
                                    <div class="fill_color"></div>
                                </div>
                                <div class="circle">3</div>
                            </div>
                        </div>
                    </div>
                    <div class="header_content container">
                        <div class="address_heading">
                            <div class="address_heading_inner">
                                <h3 class="title">2. Địa chỉ giao hàng</h3>
                                <h5 class="address_list_text">Chọn địa chỉ giao hàng có sẵn bên dưới:</h5>
                            </div>
                        </div>
                        <?php if( !empty($listAddress) ) : ?>
                            <div class="address_list grid_row">
                                <?php foreach( $listAddress as $addressItem ) : ?>
                                    <div class="address_item <?php {{ echo $addressItem['address_default'] == '1' ? "default" : ''; }}?> grid_column_12 grid_column_lg_6">
                                        <div class="address_inner">
                                            <div class="show">
                                                <p class="name">
                                                    <span class="name_value"><?php {{ echo $addressItem['address_fullname']; }} ?></span>
                                                    <?php if( $addressItem['address_default'] == '1' ) : ?>
                                                        <span class="address_default">Mặc định</span>
                                                    <?php endif; ?>
                                                </p>
                                                <p class="address" title="38 đường số 45, Phường 14, Quận Gò Vấp, Hồ Chí Minh">Địa chỉ: <?php {{ echo $addressItem['address_value']; }} ?></p>
                                                <p class="phone">Điện thoại: <?php {{ echo Format::formatPhone($addressItem['address_phone']); }} ?></p>
                                                <div class="action">
                                                    <button type="button" class="btn saving_address" add-id="<?php {{ echo $addressItem['address_id']; }} ?>">Giao đến địa chỉ này</button>
                                                    <button type="button" class="btn edit_address">Sửa</button>
                                                </div>
                                            </div>
                                            <div class="edit" address-id="<?php {{ echo $addressItem['address_id']; }} ?>" u-id="<?php {{ echo $customerItem['customer_id']; }} ?>">
                                                <div class="form_edit_group">
                                                    <input type="text" class="form_control" id="address_fullname" value="<?php {{ echo $addressItem['address_fullname']; }} ?>" placeholder="Nhập họ tên mới" autocomplete="off" spellcheck="false">
                                                    <p class="error address_fullname_error"></p>
                                                </div>
                                                <div class="form_edit_group">
                                                    <input type="text" class="form_control" id="address_value" value="<?php {{ echo $addressItem['address_value']; }} ?>" placeholder="Nhập địa chỉ mới" autocomplete="off" spellcheck="false">
                                                    <p class="error address_value_error"></p>
                                                </div>
                                                <div class="form_edit_group">
                                                    <input type="text" class="form_control" id="address_phone" value="<?php {{ echo $addressItem['address_phone']; }} ?>" placeholder="Nhập số điện thoại mới" autocomplete="off" spellcheck="false">
                                                    <p class="error address_phone_error"></p>
                                                </div>
                                                <div class="form_edit_group default_select">
                                                    <input type="checkbox" <?php {{ echo $addressItem['address_default'] == '1' ? "checked" : null; }} ?> id="address_default_<?php {{ echo $addressItem['address_id']; }} ?>" class="address_default">
                                                    <label for="address_default_<?php {{ echo $addressItem['address_id']; }} ?>">Đặt làm mặc định</label>
                                                </div>
                                                <div class="form_edit_group">
                                                    <button type="button" class="btn saving">Lưu</button>
                                                    <button type="button" class="btn cancel">Hủy</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="add_address">
                            <div class="form_group user_address">
                                <label for="customer_address_checkbox" class="add_address label_fake">
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                    <span>Thêm địa chỉ nhận hàng</span>
                                </label>
                                <input type="checkbox" id="customer_address_checkbox" class="d_none customer_address_checkbox">
                                <div class="address_form">
                                    <div class="form_address_group">
                                        <input data-uid="<?php {{ echo $customerItem['customer_id']; }} ?>" type="text" class="form_control" name="customer_fullname" id="customer_fullname" autocomplete="off" spellcheck="false" placeholder="Họ và tên ( VD: Nguyễn Văn A )">
                                        <p class="error customer_fullname_error"></p>
                                    </div>
                                    <div class="form_address_group">
                                        <input data-uid="<?php {{ echo $customerItem['customer_id']; }} ?>" type="text" class="form_control" name="customer_address" id="customer_address" autocomplete="off" spellcheck="false" placeholder="Địa chỉ cụ thể, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố">
                                        <p class="error customer_address_error"></p>
                                    </div>
                                    <div class="form_address_group">
                                        <input data-uid="<?php {{ echo $customerItem['customer_id']; }} ?>" type="text" class="form_control" name="customer_phone" id="customer_phone" autocomplete="off" spellcheck="false" placeholder="SĐT ( VD: 0708 0708 27 )">
                                        <p class="error customer_phone_error"></p>
                                    </div>
                                    <div style="font-family: 'tienitnhabep-mainFont-Light'; margin-top: 5px;" class="d_flex align_items_center">
                                        <input type="checkbox" name="setAddress_default" id="setAddress_default">
                                        <label for="setAddress_default" style="cursor: pointer;">Đặt làm địa chỉ mặt định</label>
                                    </div>
                                    <button id="add_address_action" class="w_100" style="font-size: 1.1rem; padding: 5px 0;">Thêm địa chỉ mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
            <?php {{ view("Frontend.Users.menu"); }} ?>
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