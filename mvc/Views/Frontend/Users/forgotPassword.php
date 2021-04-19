<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Quên mật khẩu ? | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Quên mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:title" content="Quên mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:description" content="Quên mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("quen-mat-khau.html"); }} ?>">
        <meta property="og:site_name" content="Quên mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Quên mật khẩu ? | Tienichnhabep.vn">
        <meta name="twitter:description" content="Quên mật khẩu ? | Tienichnhabep.vn">
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
                            <div>
                                <h1>QUÊN MẬT KHẨU</h1>
                                <div class="d_flex" style="font-family: 'tienitnhabep-mainFont-Light'">
                                    <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" style="color: #02ddbd;">Đăng nhập</a>
                                    <span style="color: #02ddbd; padding: 0 3px;">|</span>
                                    <a href="<?php {{ echo Config::getBaseUrlClient("dang-ky.html"); }} ?>" style="color: #02ddbd;">Đăng Ký</a>
                                </div>
                            </div>
                            <?php if( empty($emailSent) ) : ?>
                                <form class="hero-form" method="POST">
                                    <div class="hero-form-input">
                                        <input value="<?php {{
                                            if( !empty(Validation::setValue("customer_email")) ) {
                                                echo Validation::setValue("customer_email");
                                            } else {
                                                echo $emailSendAgain;
                                            }
                                        }} ?>" class="hero-email-input" type="phone" name="customer_email" placeholder="Nhập địa chỉ email ..." autocomplete="off" spellcheck="false">
                                        <?php {{ echo Validation::formError("customer_email"); }} ?>
                                    </div>
                                    <div class="hero-form-input">
                                        <?php {{ echo Validation::formError("customer_login"); }} ?>
                                        <button data-error="<?php {{ echo !empty(Validation::formError("customer_email")) ? "error" : ''; }} ?>" type="submit" name="forgetPassword_action" class="hero-form-submit position_relative">
                                            <div class="content_btn">
                                                <span>GỬI YÊU CẦU</span>
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                            </div>
                                            <div class="loader_wrap position_absolute">
                                                <div class="lds-facebook"><div></div><div></div><div></div></div>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            <?php else : ?>
                                <a target="_blank" href="mailTo:<?php {{ echo $emailSent; }} ?>" class="send_again">Truy cập Email <b style="font-family: 'tienitnhabep-mainFont-Bold';">phamdinhhung212@gmail</b> để đặt lại mật khẩu</a>
                                <a class="forgot_password" href="<?php {{ echo Config::getBaseUrlClient("quen-mat-khau.html"); }} ?>">Thử tài khoảng khác</a>
                            <?php endif; ?>
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