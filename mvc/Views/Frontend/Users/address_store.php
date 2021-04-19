<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Thông tin các nhân | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Thông tin các nhân khách hàng | Tienichnhabep.vn">
        <meta property="og:title" content="Thông tin các nhân khách hàng | Tienichnhabep.vn">
        <meta property="og:description" content="Thông tin các nhân khách hàng | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>">
        <meta property="og:site_name" content="Thông tin các nhân khách hàng | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Thông tin các nhân khách hàng | Tienichnhabep.vn">
        <meta name="twitter:description" content="Thông tin các nhân khách hàng | Tienichnhabep.vn">
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
                        <?php {{ view("Frontend.Users.sidebar", [
                            "tabActive" => "address_store",
                            "customerItem" => $customerItem
                        ]); }} ?>
                        <div class="grid_column_12 grid_column_lg_9">
                            <div id="history_order">
                                <div class="box_wrap">
                                    <b>Sổ địa chỉ</b>
                                    <div class="address_store_box">
                                        <div class="form_group user_address">
                                            <label for="customer_address_checkbox" class="add_address label_fake">
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                                <span>Thêm địa chỉ nhận hàng</span>
                                            </label>
                                            <input type="checkbox" id="customer_address_checkbox" class="d_none customer_address_checkbox">
                                            <div class="address_form">
                                                <div class="form_address_group">
                                                    <input data-id="<?php {{ echo $customerItem['customer_id']; }} ?>" type="text" class="form_control" name="customer_fullname" id="customer_fullname" autocomplete="off" spellcheck="false" placeholder="Họ và tên ( VD: Nguyễn Văn A )">
                                                    <p class="error customer_fullname_error"></p>
                                                </div>
                                                <div class="form_address_group">
                                                    <input data-id="<?php {{ echo $customerItem['customer_id']; }} ?>" type="text" class="form_control" name="customer_address" id="customer_address" autocomplete="off" spellcheck="false" placeholder="Địa chỉ cụ thể, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố">
                                                    <p class="error customer_address_error"></p>
                                                </div>
                                                <div class="form_address_group">
                                                    <input data-id="<?php {{ echo $customerItem['customer_id']; }} ?>" type="text" class="form_control" name="customer_phone" id="customer_phone" autocomplete="off" spellcheck="false" placeholder="SĐT ( VD: 0708 0708 27 )">
                                                    <p class="error customer_phone_error"></p>
                                                </div>
                                                <div style="font-family: 'tienitnhabep-mainFont-Light'; margin-top: 5px;" class="d_flex align_items_center">
                                                    <input type="checkbox" name="setAddress_default" id="setAddress_default">
                                                    <label for="setAddress_default" style="cursor: pointer;">Đặt làm địa chỉ mặt định</label>
                                                </div>
                                                <button id="add_address_action">Thêm địa chỉ mới</button>
                                            </div>
                                        </div>
                                        <?php if( !empty($listAddress) ) : ?>
                                            <div class="form_group list_address">
                                                <?php foreach( $listAddress as $addressItem ) : ?>
                                                    <div class="address_item grid_row justify_content_between" style="<?php {{ echo $addressItem['address_default'] == '1' ? "order: -1;" : ''; }} ?>" data-id="<?php {{ echo $addressItem['address_id']; }} ?>">
                                                        <div class="address_info grid_column_12 grid_column_lg_8">
                                                            <div class="show">
                                                                <div class="address_value d_flex">
                                                                    <h4 class="name"><?php {{ echo $addressItem['address_fullname']; }} ?></h4>
                                                                    <?php if( $addressItem['address_default'] == '1' ) : ?>
                                                                        <p class="default_status">
                                                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                                                            <span>Địa chỉ mặc định</span>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="address_value">
                                                                    <span class="title">Địa chỉ: </span>
                                                                    <span class="value"><?php {{ echo $addressItem['address_value']; }} ?></span>
                                                                </div>
                                                                <div class="address_value">
                                                                    <span class="title">Điện thoại: </span>
                                                                    <span class="value"><?php {{ echo Format::formatPhone($addressItem['address_phone']); }} ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="edit">
                                                                <div class="grid_row" data-address-id="<?php {{ echo $addressItem['address_id']; }} ?>">
                                                                    <div class="grid_column_12">
                                                                        <input class="form_control fullname_new w_100" data-id="<?php {{ echo $customerItem['customer_id']; }} ?>" value="<?php {{ echo $addressItem['address_fullname']; }} ?>" placeholder="Đặt họ tên mới ..." type="text" autocomplete="off" spellcheck="false">
                                                                        <p class="error fullname_new_error"></p>
                                                                    </div>
                                                                    <div class="grid_column_12">
                                                                        <input class="form_control address_new w_100" data-id="<?php {{ echo $customerItem['customer_id']; }} ?>" value="<?php {{ echo $addressItem['address_value']; }} ?>" placeholder="Đặt địa chỉ mới ..." type="text" autocomplete="off" spellcheck="false">
                                                                        <p class="error address_new_error"></p>
                                                                    </div>
                                                                    <div class="grid_column_12">
                                                                        <input class="form_control phone_new w_100" data-id="<?php {{ echo $customerItem['customer_id']; }} ?>" value="<?php {{ echo $addressItem['address_phone']; }} ?>" placeholder="Đặt số điện thoại mới ..." type="text" autocomplete="off" spellcheck="false">
                                                                        <p class="error phone_new_error"></p>
                                                                    </div>
                                                                    <div class="address_box d_flex align_items_center">
                                                                        <input <?php {{
                                                                            echo $addressItem['address_default'] == '1' ? 'checked' : null;
                                                                        }} ?> class="address_default_value" type="checkbox" id="address_default_<?php {{ echo $addressItem['address_id']; }} ?>">
                                                                        <label style="cursor: pointer;" for="address_default_<?php {{ echo $addressItem['address_id']; }} ?>">Đặt địa chỉ mặt định</label>
                                                                    </div>
                                                                    <button class="save_address w_100">
                                                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                                        <span>Lưu</span>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="action grid_column_12 grid_column_lg_4 d_flex justify_content_end align_items_start">
                                                            <div class="d_flex align_items_center">
                                                                <a href="javascript:;" class="edit_address d_flex align_items_center">
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                                    <span>Sửa</span>
                                                                </a>
                                                                <a href="javascript:;" class="delete_address d_flex align_items_center">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    <span>Xóa</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
            <?php {{ view("Frontend.Users.menu", ['tab' => 'address_store']); }} ?>
        </div>
    </div>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/app/profile.ajax.js"); }} ?>"></script>
</body>
</html>