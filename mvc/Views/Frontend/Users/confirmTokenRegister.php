<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Xác nhận đăng ký tài khoản | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Xác nhận đăng ký tài khoản | Tienichnhabep.vn">
        <meta property="og:title" content="Xác nhận đăng ký tài khoản | Tienichnhabep.vn">
        <meta property="og:description" content="Xác nhận đăng ký tài khoản | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("xac-nhan-dang-ky.html.html"); }} ?>">
        <meta property="og:site_name" content="Xác nhận đăng ký tài khoản | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Xác nhận đăng ký tài khoản | Tienichnhabep.vn">
        <meta name="twitter:description" content="Xác nhận đăng ký tài khoản | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <style>
        .hero-form-submit.handle .loader_wrap{display:block}.hero-form-submit.handle .content_btn{opacity:0}.hero-form-submit .content_btn{opacity:1}.notification_confirm_email{font-size:.9rem;color:#959595;font-family:tienitnhabep-mainFont-Light;margin-top:3px}.notification_confirm_email a{color:#ff6f6f;font-family:tienitnhabep-mainFont-Bold}
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
                            <?php if( !empty($customerItem) ) : ?>
                                <div>
                                    <h1>XÁC NHẬN ĐĂNG KÝ</h1>
                                    <div class="d_flex" style="font-family: 'tienitnhabep-mainFont-Light'">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" style="color: #02ddbd;">Đăng nhập</a>
                                        <span style="color: #02ddbd; padding: 0 3px;">|</span>
                                        <a href="<?php {{ echo Config::getBaseUrlClient("quen-mat-khau.html"); }} ?>" style="color: #02ddbd;">Quên mật khẩu</a>
                                    </div>
                                </div>
                                <div>
                                    <p class="notification_confirm_email">Mã được gửi đến <a target="_blank" href="mailTo:<?php {{ echo $customerItem['customer_email']; }} ?>" class="d_inline"><?php {{ echo $customerItem['customer_email']; }} ?></a></p>
                                </div>
                                <form class="hero-form" method="POST">
                                    <div class="hero-form-input">
                                        <input <?php {{
                                            echo !empty($errorConfirmTokenRegister) ? "disabled" : null;
                                        }} ?> value="<?php {{ echo Validation::SetValue("customer_confirm_register_code"); }} ?>" class="hero-email-input number_hidden" id="customer_confirm_register_code" name="customer_confirm_register_code" type="number" min="1" placeholder="<?php {{ echo !empty($errorConfirmTokenRegister) ? "Mã xác nhận đã hết hiệu lực" : "Nhập mã gồm 6 chữ số"; }} ?>" autocomplete="off" spellcheck="false">
                                        <?php {{ echo Validation::formError("customer_confirm_register_code"); }} ?>
                                        <div class="validity_period" data-startdate="<?php {{ echo $customerItem['customer_createDate']; }} ?>" data-enddate="<?php {{ echo $customerItem['customer_time_register_validity_period']; }} ?>">
                                            <?php if( empty($errorConfirmTokenRegister) ) : ?>
                                                Thời gian còn lại
                                                <span>00:00:00</span>
                                                <script>function makeTimer(e,t,a){var r=t-e,n=Math.floor(r/86400),l=Math.floor((r-86400*n)/3600),o=Math.floor((r-86400*n-3600*l)/60),i=Math.floor(r-86400*n-3600*l-60*o);l<"10"&&(l="0"+l),o<"10"&&(o="0"+o),i<"10"&&(i="0"+i);let d=l+":"+o+":"+i;a.innerHTML=d}function coutDownTime_flasSale(){document.querySelectorAll(".validity_period").forEach(e=>{handleData_flashSale(parseInt(e.getAttribute("data-enddate")),e.children[0])})}function handleData_flashSale(e,t){let a={start:getCurrentDate_timeStamp(),end:e};var r=null;r=setInterval(()=>{a.start++,makeTimer(a.start,a.end,t),a.start==a.end&&(clearInterval(r),location.reload())},1e3)}function getCurrentDate_timeStamp(){var e,t=(new Date).getTime(),a=new Date(t);return e=a,Math.round(Date.parse(e)/1e3)}coutDownTime_flasSale();</script>
                                            <?php else: ?>
                                                <div class="modal_loader">
                                                    <div class="loader_img position_relative">
                                                        <span class="thumbNail">
                                                            <img class="full_size" src="http://localhost/tienichnhabep.vn/public/images/icon/logo_mini.png" alt="">
                                                        </span>
                                                        <div class="loader_move position_absolute">
                                                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="" class="send_again" id="btnSendConfirmRegisterCode">Gửi lại
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if( empty($errorConfirmTokenRegister) ) : ?>
                                        <div class="hero-form-input">
                                            <button type="submit" class="hero-form-submit position_relative" name="confirmRegisterCode_action">
                                                <div class="content_btn">
                                                    <span>TIẾP TỤC</span>
                                                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                                                </div>
                                                <div class="loader_wrap position_absolute">
                                                    <div class="lds-facebook"><div></div><div></div><div></div></div>
                                                </div>
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </form>
                            <?php else : ?>
                                <h1>Gửi yêu cầu xác nhận đăng ký không thành công !</h1>
                                <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style="color: #02ddbd; border: 1px solid rgba(1,1,1,.12); font-size: .9rem; display: inline-block; border: 1px solid #02ddbd; padding: 5px; border-radius: 3px; margin-top: 5px;">Về trang chủ</a>
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
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/app/confirmTokenRegister.ajax.js"); }} ?>"></script>
    <script>
        let btnSendRequest = $(".hero-form-submit");
        btnSendRequest.click(function() {
            $(".hero-form-submit").addClass('handle');
        });
    </script>
</body>
</html>