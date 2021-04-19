<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Đăng nhập | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Đăng nhập tài khoản | Tienichnhabep.vn">
        <meta property="og:title" content="Đăng nhập tài khoản | Tienichnhabep.vn">
        <meta property="og:description" content="Đăng nhập tài khoản | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>">
        <meta property="og:site_name" content="Đăng nhập tài khoản | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Đăng nhập tài khoản | Tienichnhabep.vn">
        <meta name="twitter:description" content="Đăng nhập tài khoản | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <style>
        .hero-form-submit.handle .loader_wrap{display:block}.hero-form-submit.handle .content_btn{opacity:0}.hero-form-submit .content_btn{opacity:1}
    </style>
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
                <div class="hero">
                    <div class="hero-inner">
                        <div class="hero-text">
                            <div class="d_flex justify_content_between align_items_center">
                                <h1>ĐĂNG NHẬP</h1>
                                <div class="tab_user">
                                    <a class="tab_user_item" href="<?php {{ echo Config::getBaseUrlClient("dang-ky.html"); }} ?>">Đăng ký</a>
                                </div>
                            </div>
                            <form class="hero-form" method="POST">
                                <div class="hero-form-input">
                                    <input value="<?php {{
                                        echo Validation::setValue("customer_phone_or_email");
                                    }} ?>" class="hero-email-input" type="phone" name="customer_phone_or_email" placeholder="Email hoặc SĐT ..." autocomplete="off" spellcheck="false">
                                    <?php {{ echo Validation::formError("customer_phone_or_email"); }} ?>
                                </div>
                                <div class="hero-form-input">
                                    <div class="position_relative">
                                        <input value="<?php {{
                                            echo Validation::setValue("customer_password");
                                        }} ?>" class="hero-email-input" type="password" id="customer_password" name="customer_password" placeholder="Mật khẩu ..." autocomplete="off" spellcheck="false">
                                        <a href="" class="view_password position_absolute">Hiện</a>
                                    </div>
                                    <?php {{ echo Validation::formError("customer_password"); }} ?>
                                </div>
                                <div class="hero-form-input">
                                    <?php {{ echo Validation::formError("customer_login"); }} ?>
                                    <button type="submit" name="loginAccount_action" class="hero-form-submit position_relative">
                                        <div class="content_btn">
                                            <span>TIẾP TỤC</span>
                                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                                        </div>
                                        <div class="loader_wrap position_absolute">
                                            <div class="lds-facebook"><div></div><div></div><div></div></div>
                                        </div>
                                    </button>
                                    <a href="<?php {{ echo Config::getBaseUrlClient("quen-mat-khau.html"); }} ?>" class="forgot_password tab_user_item">Quên mật khẩu ?</a>
                                </div>
                            </form>
                        </div>
                        <div class="hero-image">
                            <img src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>" alt="">
                        </div>
                    </div>
                </div>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <script>
        let btnSendRequest = $(".hero-form-submit");
        btnSendRequest.click(function() {
            $(".hero-form-submit").addClass('handle');
        });
    </script>
    <script>
        let btnTogglePassWord = $(".view_password");
        let inputPassword = "#customer_password";
        let statusChange = undefined;
        let textStatus = undefined;
        btnTogglePassWord.click(function() {
            event.preventDefault();
            let status = $(inputPassword).attr('type');
            statusChange = status == 'password' ? 'text' : 'password';
            textStatus   = status == 'password' ? 'Ẩn' : 'Hiện';
            $(inputPassword).attr('type', statusChange);
            $(this).text(textStatus);
        });
    </script>
</body>
</html>