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
                            "tabActive" => "profile",
                            "customerItem" => $customerItem
                        ]); }} ?>
                        <div class="grid_column_12 grid_column_lg_9">
                            <div id="history_order">
                                <div class="box_wrap">
                                    <b>Thông tin cá nhân</b>
                                    <form method="POST">
                                        <?php if(!empty($statusActionCustomer)) : ?>
                                            <div class="alert_wrap" style="padding: 0; margin-bottom: 10px;">
                                                <div class="alert alert_<?php {{ echo $statusActionCustomer['status']; }}
                                                    ?> position_relative" data-status="<?php {{
                                                        if(!empty($statusActionCustomer['status']))
                                                        { echo "true"; }; }}
                                                    ?>">
                                                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                                                    <span><?php {{ echo $statusActionCustomer['notifiTxt']; }} ?></span>
                                                    <button type="button" class="close position_absolute">x</button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="grid_row">
                                            <div class="form_info_box __right grid_column_12 grid_column_lg_7">
                                                <div class="form_group">
                                                    <div class="group_item align_items_center">
                                                        <label for="customer_fullname" class="label_title">Họ tên:</label>
                                                        <input type="text" class="form_control" name="customer_fullname" id="customer_fullname" value="<?php {{
                                                            if( !empty(Validation::setValue("customer_fullname")) ){
                                                                echo Validation::setValue("customer_fullname");
                                                            } else {
                                                                echo $customerItem['customer_fullname'];
                                                            }
                                                        }} ?>" placeholder="Họ và tên" autocomplete="off" spellcheck="false">
                                                    </div>
                                                    <div class="group_item align_items_center">
                                                        <label for="" class="label_title_error"></label>
                                                        <?php {{ echo Validation::formError("customer_fullname"); }} ?>
                                                    </div>
                                                </div>
                                                <div class="form_group">
                                                    <div class="group_item align_items_center">
                                                        <label for="customer_email" class="label_title">Email:</label>
                                                        <input type="text" class="form_control" name="customer_email" id="customer_email" value="<?php {{
                                                            if( !empty(Validation::setValue("customer_email")) ) {
                                                                echo Validation::setValue("customer_email");
                                                            } else {
                                                                echo $customerItem['customer_email'];
                                                            }
                                                        }} ?>" placeholder="Địa chỉ Email" autocomplete="off" spellcheck="false">
                                                    </div>
                                                    <div class="group_item align_items_center">
                                                        <label for="" class="label_title_error"></label>
                                                        <?php {{ echo Validation::formError("customer_email"); }} ?>
                                                    </div>
                                                </div>
                                                <div class="form_group">
                                                    <div class="group_item align_items_center">
                                                        <label for="customer_phone" class="label_title">SĐT:</label>
                                                        <input type="text" class="form_control" name="customer_phone" id="customer_phone" value="<?php {{
                                                            if( !empty(Validation::setValue("customer_phone")) ) {
                                                                echo Validation::setValue("customer_phone");
                                                            } else {
                                                                echo $customerItem['customer_phone'];
                                                            }
                                                        }} ?>" placeholder="Số điện thoại" autocomplete="off" spellcheck="false">
                                                    </div>
                                                    <div class="group_item align_items_center">
                                                        <label for="" class="label_title_error"></label>
                                                        <?php {{ echo Validation::formError("customer_phone"); }} ?>
                                                    </div>
                                                </div>
                                                <div class="form_group group_item align_items_center">
                                                    <label for="customer_birthday" class="label_title">Ngày sinh:</label>
                                                    <div>
                                                        <?php if( !empty($customerItem['customer_birthday']) ) {
                                                            $date  = getdate($customerItem['customer_birthday']);
                                                            $__day   = $date['mday'];
                                                            $__month = $date['mon'];
                                                            $__year  = $date['year'];
                                                        } ?>
                                                        <select class="form_birthday" name="customer_birthday_dayOfDate" id="customer_birthday_dayOfDate">
                                                            <option value="">Ngày</option>
                                                            <?php for( $day = 1; $day <= 31; $day ++ ) : ?>
                                                                <option <?php {{
                                                                    if( !empty(Validation::setValue("customer_birthday_dayOfDate")) ) {
                                                                        echo Validation::setValue("customer_birthday_dayOfDate") == $day ? "selected" : null;
                                                                    } else {
                                                                        if( !empty($__day) ) { echo $__day == $day ? "selected" : null; }
                                                                    }
                                                                }} ?> value="<?php {{ echo $day; }} ?>"><?php {{ echo $day; }} ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                        <select class="form_birthday" name="customer_birthday_monthOfDate" id="customer_birthday_monthOfDate">
                                                            <option value="">Tháng</option>
                                                            <?php for( $month = 1; $month <= 12; $month ++ ) : ?>
                                                                <option <?php {{
                                                                    if( !empty(Validation::setValue("customer_birthday_monthOfDate"))) {
                                                                        echo Validation::setValue("customer_birthday_monthOfDate") == $month ? "selected" : null;
                                                                    } else {
                                                                        if( !empty($__month) ) { echo $__month == $month ? "selected" : null; }
                                                                    }
                                                                }} ?> value="<?php {{ echo $month; }} ?>"><?php {{ echo $month; }} ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                        <select class="form_birthday" name="customer_birthday_yearOfDate" id="customer_birthday_yearOfDate">
                                                            <option value="">Năm</option>
                                                            <?php for( $year = date("Y"); $year >= 1920; $year -- ) : ?>
                                                                <option <?php {{
                                                                    if( !empty(Validation::setValue("customer_birthday_yearOfDate")) ) {
                                                                        echo Validation::setValue("customer_birthday_yearOfDate") == $year ? "selected" : null;
                                                                    } else {
                                                                        if( !empty($__year) ) { echo $__year == $year ? "selected" : null; }
                                                                    }
                                                                }} ?> value="<?php {{ echo $year; }} ?>"><?php {{ echo $year; }} ?></option>
                                                            <?php endfor; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form_group group_item align_items_center">
                                                    <label for="customer_gender" class="label_title">Danh xưng:</label>
                                                    <div>
                                                        <label for="male">
                                                            <input <?php {{
                                                                if( !empty(Validation::setValue("customer_gender")) ) {
                                                                    echo Validation::setValue("customer_gender") == "male" ? "checked" : null;
                                                                } else {
                                                                    echo $customerItem['customer_gender'] == "male" ? "checked" : null;
                                                                }
                                                            }} ?> type="radio" name="customer_gender[]" value="male" id="male">
                                                            <span>Anh</span>
                                                        </label>
                                                        <label for="female">
                                                            <input <?php {{
                                                                if( !empty(Validation::setValue("customer_gender")) ) {
                                                                    echo Validation::setValue("customer_gender") == "female" ? "checked" : null;
                                                                } else {
                                                                    echo $customerItem['customer_gender'] == "female" ? "checked" : null;
                                                                }
                                                            }} ?> type="radio" name="customer_gender[]" value="female" id="female">
                                                            <span>Chị</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form_group group_item align_items_center">
                                                        <label for="customer_gender" class="label_title"></label>
                                                        <a href="javascript:;" class="toggleBoxChangePass" style="font-size: .9rem;color: #085372;">Thay đổi mật khẩu</a>
                                                    </div>
                                                    <div class="form_group align_items_center change_password_box <?php  {{ echo !empty(Validation::formError("customer_password")) ? "show" : null; }} ?>">
                                                        <div class="group_item">
                                                            <label for="" class="label_title">Mật khẩu:</label>
                                                            <div>
                                                                <input value="<?php {{
                                                                    echo Validation::setValue("customer_password_old");
                                                                }} ?>" type="password" name="customer_password_old" id="customer_password_old" class="form_control" placeholder="Nhập mật khẩu hiện tại ..." autocomplete="off" spellcheck="false" style="margin-bottom: 5px;">
                                                                <input value="<?php {{
                                                                    echo Validation::setValue("customer_password_new");
                                                                }} ?>" type="password" name="customer_password_new" id="customer_password_new" class="form_control" placeholder="Nhập mật khẩu mới ..." autocomplete="off" spellcheck="false" style="margin-bottom: 5px;">
                                                                <input value="<?php {{
                                                                    echo Validation::setValue("customer_password_confirm");
                                                                }} ?>" type="password" name="customer_password_confirm" id="customer_password_confirm" class="form_control" placeholder="Nhập lại mật khẩu mới ..." autocomplete="off" spellcheck="false" style="margin-bottom: 5px;">
                                                            </div>
                                                            <script>document.querySelector(".toggleBoxChangePass").addEventListener("click",function(){document.querySelector(".change_password_box").classList.contains("show")?(document.querySelector(".change_password_box").classList.remove("show"),document.querySelector("#customer_password_old").value="",document.querySelector("#customer_password_new").value="",document.querySelector("#customer_password_confirm").value=""):document.querySelector(".change_password_box").classList.add("show")});</script>
                                                        </div>
                                                    </div>
                                                    <div class="form_group d_flex align_items_center">
                                                        <label for="" class="label_title_error"></label>
                                                        <?php {{ echo Validation::formError("customer_password"); }} ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_info_box __left grid_column_12 grid_column_lg_5">
                                                <div class="customer_avatar_wrap">
                                                    <div class="upload_avatar_picture_iframe">
                                                        <label for="customer_avatar_file" class="d_block picture_iframe">
                                                            <img id="brand_logo_append" class="avatar_demo full_size" src="<?php {{
                                                                if(!empty(Validation::setValue("customer_avatar"))) {
                                                                    echo Validation::setValue("customer_avatar_file");
                                                                } else {
                                                                    echo !empty($customerItem['customer_avatar']) ? $customerItem['customer_avatar'] : Config::getBaseUrlClient("public/images/icon/default-avatar-male.png");
                                                                }
                                                            }} ?>" alt="">
                                                            <input type="hidden" name="customer_avatar_file" id="customer_avatar_file_value" value="<?php {{
                                                                if( !empty(Validation::setValue("customer_avatar_file")) ) {
                                                                    echo Validation::setValue("customer_avatar_file");
                                                                } else {
                                                                    echo $customerItem['customer_avatar'];
                                                                }
                                                            }} ?>">
                                                            <input type="file" class="d_none" id="customer_avatar_file">
                                                            <input type="hidden" id="customer_avatar" value="<?php {{
                                                                if( !empty(Validation::setValue("customer_avatar")) ) {
                                                                    echo Validation::setValue("customer_avatar");
                                                                } else {
                                                                    echo $customerItem['customer_avatar'];
                                                                }
                                                            }} ?>" name="customer_avatar">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_info_box grid_column_12 d_flex justify_content_center">
                                                <button class="update_info_customer" name="updateInfoCustomer_action" type="submit">Cập nhật</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
            <?php {{ view("Frontend.Users.menu", ['tab' => 'profile']); }} ?>
        </div>
    </div>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/app/profile.ajax.js"); }} ?>"></script>
    <script>
        var alertStatusAddEl = document.querySelector('.alert');
        if(alertStatusAddEl !== null) {
            var buttonCloseAlertEl   = document.querySelector(".alert .close");
            if(alertStatusAddEl.getAttribute('data-status') === 'true') {
                alertStatusAddEl.classList.add('open');
                setTimeout(function() {
                    alertStatusAddEl.classList.remove('open');
                },5000);
            }
            buttonCloseAlertEl.addEventListener('click', function() {
                alertStatusAddEl.classList.remove('open');
            });
        }
    </script>
</body>
</html>