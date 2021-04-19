<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Thay đổi mật khẩu ? | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Thay đổi mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:title" content="Thay đổi mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:description" content="Thay đổi mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("thay-doi-mat-khau.html"); }} ?>">
        <meta property="og:site_name" content="Thay đổi mật khẩu ? | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Thay đổi mật khẩu ? | Tienichnhabep.vn">
        <meta name="twitter:description" content="Thay đổi mật khẩu ? | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <style>
        .hero-form-submit.handle .loader_wrap{display:block}.hero-form-submit.handle .content_btn{opacity:0}.hero-form-submit .content_btn{opacity:1}.sendAgainRequest{text-align:center;width:100%;background-color:#02ddbd;color:#fff;font-size:1.3rem;font-family:tienitnhabep-mainFont-Light;border:none;padding:7px 18px;border-radius:3px;cursor:pointer;margin-top:5px}
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
                            <?php if( !empty( $customerItem ) ) : ?>
                                <div>
                                    <h1>THAY ĐỔI MẬT KHẨU</h1>
                                    <div class="d_flex" style="font-family: 'tienitnhabep-mainFont-Light'">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" style="color: #02ddbd;">Đăng nhập</a>
                                        <span style="color: #02ddbd; padding: 0 3px;">|</span>
                                        <a href="<?php {{ echo Config::getBaseUrlClient("dang-ky.html"); }} ?>" style="color: #02ddbd;">Đăng Ký</a>
                                    </div>
                                </div>
                                <form class="hero-form" method="POST">
                                    <div class="hero-form-input">
                                        <input disabled value="<?php {{
                                            echo $customerItem['customer_email'];
                                        }} ?>" class="hero-email-input" type="phone" name="customer_phone_or_email" placeholder="Email hoặc SĐT ..." autocomplete="off" spellcheck="false">
                                    </div>
                                    <div class="hero-form-input">
                                        <div class="position_relative">
                                            <input <?php {{
                                                echo !empty($errorConfirmTokenForgot) ? "disabled" : '';
                                            }} ?> class="hero-email-input" type="password" id="customer_password" name="customer_password" placeholder="Mật khẩu mới ..." autocomplete="off" spellcheck="false">
                                            <a href="" class="view_password position_absolute">Hiện</a>
                                        </div>
                                        <?php {{ echo Validation::formError("customer_password"); }} ?>
                                    </div>
                                    <div class="validity_period" data-startdate="<?php {{ echo $customerItem['customer_time_start_forgotPass']; }} ?>" data-enddate="<?php {{ echo $customerItem['customer_time_forgotPass_validity_period']; }} ?>">
                                        <?php if( empty($errorConfirmTokenForgot) ) : ?>
                                            Thời gian còn lại
                                            <span>00:00:00</span>
                                            <script>function makeTimer(e,t,a){var r=t-e,n=Math.floor(r/86400),l=Math.floor((r-86400*n)/3600),o=Math.floor((r-86400*n-3600*l)/60),i=Math.floor(r-86400*n-3600*l-60*o);l<"10"&&(l="0"+l),o<"10"&&(o="0"+o),i<"10"&&(i="0"+i);let d=l+":"+o+":"+i;a.innerHTML=d}function coutDownTime_flasSale(){document.querySelectorAll(".validity_period").forEach(e=>{handleData_flashSale(parseInt(e.getAttribute("data-enddate")),e.children[0])})}function handleData_flashSale(e,t){let a={start:getCurrentDate_timeStamp(),end:e};var r=null;r=setInterval(()=>{a.start++,makeTimer(a.start,a.end,t),a.start==a.end&&(clearInterval(r),location.reload())},1e3)}function getCurrentDate_timeStamp(){var e,t=(new Date).getTime(),a=new Date(t);return e=a,Math.round(Date.parse(e)/1e3)}coutDownTime_flasSale();</script>
                                        <?php else : ?>
                                            Yêu cầu hết hiệu lực
                                        <?php endif; ?>
                                    </div>
                                    <div class="hero-form-input">
                                        <?php if( empty($errorConfirmTokenForgot) ) : ?>
                                            <?php {{ echo Validation::formError("customer_login"); }} ?>
                                            <button type="submit" name="changePassword_action" class="hero-form-submit position_relative">
                                                <div class="content_btn">
                                                    <span>LƯU THAY ĐỔI</span>
                                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                                </div>
                                                <div class="loader_wrap position_absolute">
                                                    <div class="lds-facebook"><div></div><div></div><div></div></div>
                                                </div>
                                            </button>
                                        <?php else : ?>
                                            <a href="<?php {{ echo Config::getBaseUrlClient("quen-mat-khau.html?email={$customerItem['customer_email']}"); }} ?>" class="sendAgainRequest">
                                                <span>Gửi Lại Yêu Cầu</span>
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            <?php else : ?>
                                <h1>Gửi yêu cầu thay đổi mật khẩu không thành công !</h1>
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