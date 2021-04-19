<?php
    $config = new ConfigController;
    $configInfo = ($config->getConfig()[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Đăng ký trở thành đại lý cùng TIẾN PHÁT</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="<?php {{ echo !empty($configInfo['config_metaDesc']) ? $configInfo['config_metaDesc'] : null; }} ?>">
        <meta name="keywords" content="<?php {{ echo !empty($configInfo['config_metaKeyword']) ? $configInfo['config_metaKeyword'] : null; }} ?>">
        <meta property="og:title" content="<?php {{ echo !empty($configInfo['config_metaTitle']) ? $configInfo['config_metaTitle'] : null; }} ?>">
        <meta property="og:description" content="<?php {{ echo !empty($configInfo['config_metaDesc']) ? $configInfo['config_metaDesc'] : null; }} ?>">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <meta property="og:site_name" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta property="og:image" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlAdmin($configInfo['config_image']) : null; }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlAdmin($configInfo['config_image']) : null; }} ?>">
        <meta property="og:keywords" content="<?php {{ echo !empty($configInfo['config_metaKeyword']) ? $configInfo['config_metaKeyword'] : null; }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php {{ echo !empty($configInfo['config_metaTitle']) ? $configInfo['config_metaTitle'] : null; }} ?>">
        <meta name="twitter:description" content="<?php {{ echo !empty($configInfo['config_metaDesc']) ? $configInfo['config_metaDesc'] : null; }} ?>">
        <meta name="twitter:image" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlAdmin($configInfo['config_image']) : null; }} ?>">
        <meta name="twitter:keywords" content="<?php {{ echo !empty($configInfo['config_metaKeyword']) ? $configInfo['config_metaKeyword'] : null; }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/agency.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <div class="header_page_regis_agency">
                <div class="header_top container">
                    <div class="grid_row justify_content_between align_items_center">
                        <ul class="contact_us d_flex justify_content_between align_items_center">
                            <li>
                                <a target="_blank" href="mailTo:tienichnhabep.vn@gmail.com">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>tienichnhabep.vn@gmail.com</span>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.google.com/maps/dir//104+L%C6%B0%C6%A1ng+Nh%E1%BB%AF+H%E1%BB%99c,+Ho%C3%A0+C%C6%B0%E1%BB%9Dng+B%E1%BA%AFc,+H%E1%BA%A3i+Ch%C3%A2u,+%C4%90%C3%A0+N%E1%BA%B5ng+550000,+Vi%E1%BB%87t+Nam/@16.0390476,108.2093113,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x3142199571997481:0x81d9ab6662b46f12!2m2!1d108.21153!2d16.0413105!3e0?hl=vi-VN">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>104 Lương Nhữ Hộc - Hoà Cường Bắc- Quận Hải Châu - TP Đà Nẵng</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header_bottom">
                    <div class="container">
                        <div class="elementor_row grid_row align_items_center">
                            <div class="elementor_column left grid_column_6 grid_column_lg_3">
                                <a href="" class="logo">
                                    <img width="150" src="<?php {{ echo !empty($configInfo['config_logo']) ? Config::getBaseUrlAdmin($configInfo['config_logo']) : null; }} ?>" alt="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
                                </a>
                            </div>
                            <div class="elementor_column midde d_flex align_items_center  grid_column_6 grid_column_lg_3">
                                <div class="icon">
                                    <img src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/call-home-three.png"); }} ?>" alt="Icon liên hệ Tiến Phát">
                                </div>
                                <div class="info">
                                    <p class="label">Hotline</p>
                                    <a href="tel:0708070827" class="phone">0708 0708 27</a>
                                </div>
                            </div>
                            <div class="elementor_column right grid_column_12 grid_column_lg_3">
                                <nav class="menu_list">
                                    <ul>
                                        <li>
                                            <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">Trang chủ >></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <main class="main_sc">
                <div class="banner_top" style="background: url('<?php {{ echo Config::getBaseUrlClient("public/images/banner/banner-dai-ly.png"); }} ?>');">
                    <div class="content container">
                        <h4>Đăng lý trở thành đại lý cùng TIẾN PHÁT</h4>
                        <p>THIẾT BỊ NHÀ BẾP THÔNG MINH – Cơ hội kinh doanh hấp dẫn</p>
                        <a href="" class="btn_regis">Đăng ký ngay !</a>
                    </div>
                </div>
                <section class="sec_info_1">
                    <div class="container">
                        <div class="grid_row">
                            <div class="grid_column_12 grid_column_lg_6 image">
                                <div class="thumbNail">
                                    <img class="w_100 h_100" src="<?php {{ echo Config::getBaseUrlClient("public/images/banner/1-san-nha-lat-gach-gia-go-tien-ich.jpg"); }} ?>" alt="">
                                </div>
                            </div>
                            <div class="grid_column_12 grid_column_lg_6 content">
                                <div class="content_list">
                                    <h3>VỀ TIẾN PHÁT</h3>
                                    <h2>LÀ ĐƠN VỊ CHUYÊN PHÂN PHỐI CÁC SẢN PHẨM THIẾT BỊ NHÀ BẾP, ĐỒ DÙNG TIỆN ÍCH, VỚI HÀNG TRĂM ĐẠI LÝ TRÊN TOÀN QUỐC.</h2>
                                    <h4>CƠ HỘI PHÁT TRIỂN VÀ GIA TĂNG LỢI NHUẬN TRONG TẦM TAY >></h4>
                                    <ul class="TP_list_feature">
                                        <li>Nhu cầu của thị trường ngày càng cao (Nhà phố, căn hộ, chung cư, khách sạn, văn phòng…)</li>
                                        <li>Lợi nhuận cao và ổn định (bao gồm lợi nhuận từ thiết bị, linh kiện và lắp đặt)</li>
                                        <li>Sản phẩm đơn giản, không yêu cầu nền tảng kiến thức, kinh nghiệm…</li>
                                        <li>Lắp đặt nhanh chóng, dễ dàng, gần như không cần bảo hành trừ trường hợp khách sử dụng không đúng cách.</li>
                                        <li>Dễ dàng kết hợp kinh doanh các sản phẩm khác như thiết bị điện, thiết bị vệ sinh, trang trí nội thất....</li>
                                        <li>Được hỗ trợ trưng bày, bảng hiệu led, tư vấn và hướng dẫn về sản phẩm một cách chuyên nghiệp.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sec_info_2" style="background: url('<?php {{ echo COnfig::getBaseUrlClient("public/images/banner/banner-dai-ly-2.png"); }} ?>');">
                    <div class="container form_regis_wrap d_flex justify_content_center flex_column align_items_center">
                        <div class="contant_title text_center">
                            <p>CÙNG TIẾN PHÁT</p>
                            <h2>GIA TĂNG THU NHẬP NGAY HÔM NAY</h2>
                        </div>
                        <form action="" id="form_register_agency" data-regis-companyname="<?php {{ echo !empty($_COOKIE['regisAgencyTime']) ? $_COOKIE['regisAgencyTime'] : null; }} ?>">
                            <h2 class="title">Đăng ký trở thành đại lý</h2>
                            <div class="form_inner">
                                <div class="form_group">
                                    <input type="text" class="form_control w_100" name="fullname_agency" id="fullname_agency" placeholder="Họ và tên" autocomplete="off" spellcheck="false">
                                    <span class="fullname_error error_form"></span>
                                </div>
                                <div class="form_group">
                                    <input type="text" class="form_control w_100" name="company_name_agency" id="company_name_agency" placeholder="Tên công ty / Đơn vị" autocomplete="off" spellcheck="false">
                                    <span class="company_error error_form"></span>
                                </div>
                                <div class="form_group">
                                    <input type="text" class="form_control w_100" name="phone_agency" id="phone_agency" placeholder="Số điện thoại" autocomplete="off" spellcheck="false">
                                    <span class="phone_error error_form"></span>
                                </div>
                                <div class="form_group">
                                    <input type="text" class="form_control w_100" name="email_agency" id="email_agency" placeholder="Email liên hệ" autocomplete="off" spellcheck="false">
                                    <span class="email_error error_form"></span>
                                </div>
                                <div class="form_group">
                                    <button type="submit" class="form_button w_100">ĐĂNG KÝ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <div class="info_footer">
                    <a href="mailTo:tienichnhabep.vn@gmail.com">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span>tienichnhabep.vn@gmail.com</span>
                    </a>
                    <a href="https://www.google.com/maps/dir//104+L%C6%B0%C6%A1ng+Nh%E1%BB%AF+H%E1%BB%99c,+Ho%C3%A0+C%C6%B0%E1%BB%9Dng+B%E1%BA%AFc,+H%E1%BA%A3i+Ch%C3%A2u,+%C4%90%C3%A0+N%E1%BA%B5ng+550000,+Vi%E1%BB%87t+Nam/@16.0390476,108.2093113,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x3142199571997481:0x81d9ab6662b46f12!2m2!1d108.21153!2d16.0413105!3e0?hl=vi-VN">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>104 Lương Nhữ Hộc - Hoà Cường Bắc- Quận Hải Châu - TP Đà Nẵng</span>
                    </a>
                </div>
            </main>
            <div class="modal_mail">
                <div class="modal_mail_mask"></div>
                <div class="modal_mail_content">
                    <div class="modal_mail_header d_flex justify_content_center align_items_center">
                        <i class="fa fa-check icon" aria-hidden="true"></i>
                        <span class="text">Đăng ký thành công</span>
                    </div>
                    <div class="modal_mail_body">
                        <a target="_blank" href="" class="btn_mail" style="font-size: .9rem; text-align:center;">
                            <span class="d_block">TRUY CẬP E.MAIL</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal_loader">
                <div class="loader_img position_relative">
                    <span class="thumbNail">
                        <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/logo_mini.png"); }} ?>" alt="">
                    </span>
                    <div class="loader_move position_absolute">
                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d_none" id="baseURL" data-url="<?php {{ echo Config::getBaseUrlClient(); }} ?>"></div>
    <script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/config/jquery.min.js"); }} ?>"></script>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/app/agency.js"); }} ?>"></script>
</body>
</html>