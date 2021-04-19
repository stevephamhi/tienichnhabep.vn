<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Trạng thái đơn hàng | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Trạng thái đơn hàng | Tienichnhabep.vn">
        <meta property="og:title" content="Trạng thái đơn hàng | Tienichnhabep.vn">
        <meta property="og:description" content="Trạng thái đơn hàng | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>">
        <meta property="og:site_name" content="Trạng thái đơn hàng | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Trạng thái đơn hàng | Tienichnhabep.vn">
        <meta name="twitter:description" content="Trạng thái đơn hàng | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/cart.css"); }} ?>">
    <style>
		.pyro>.after,.pyro>.before{position:absolute;width:5px;height:5px;border-radius:50%;-webkit-box-shadow:0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff;box-shadow:0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff,0 0 #fff;-webkit-animation:1s bang ease-out infinite backwards,1s gravity ease-in infinite backwards,5s position linear infinite backwards;animation:1s bang ease-out infinite backwards,1s gravity ease-in infinite backwards,5s position linear infinite backwards}.pyro>.after{-webkit-animation-delay:1.25s,1.25s,1.25s;animation-delay:1.25s,1.25s,1.25s;-webkit-animation-duration:1.25s,1.25s,6.25s;animation-duration:1.25s,1.25s,6.25s}@-webkit-keyframes bang{to{-webkit-box-shadow:-23px 61.3333333333px #ff00e6,-76px 49.3333333333px #006aff,-118px -236.6666666667px #02f,-234px -56.6666666667px #e6ff00,-70px -412.6666666667px #ff0095,10px -55.6666666667px #ff0095,-151px -243.6666666667px #fb0,-138px -284.6666666667px #00ff1e,-123px 68.3333333333px #0026ff,-149px 13.3333333333px #bfff00,85px -81.6666666667px #4dff00,13px -233.6666666667px #ffd500,162px -215.6666666667px #006fff,134px -12.6666666667px #8c00ff,-159px .3333333333px #ff2b00,-196px -367.6666666667px #4800ff,-136px -127.6666666667px #30f,28px -372.6666666667px #00b3ff,-135px -270.6666666667px #0091ff,91px -299.6666666667px #005eff,-237px -190.6666666667px #f40,-176px -211.6666666667px #f0d,115px 7.3333333333px #05f,16px -41.6666666667px #00ffea,179px -158.6666666667px #bf00ff,168px -106.6666666667px #ffd000,141px -32.6666666667px #ff007b,103px -303.6666666667px #ff4800,48px -1.6666666667px #f0c,96px -34.6666666667px #b3ff00,101px -139.6666666667px #0400ff,113px -252.6666666667px #00ff1a,-87px -48.6666666667px #37ff00,86px -191.6666666667px #0dff00,21px -51.6666666667px #15ff00,28px -331.6666666667px #08f,48px -185.6666666667px #d000ff,238px -333.6666666667px #ff00a6,-73px -43.6666666667px #ff007b,53px 56.3333333333px #40f,188px -80.6666666667px #ff001e,-120px -40.6666666667px #0009ff,175px -352.6666666667px #f0e,-51px 61.3333333333px #00ffae,-223px -44.6666666667px #ff001a,-184px -391.6666666667px #9500ff,-78px -199.6666666667px #ffb300,242px 82.3333333333px #006aff,-28px -181.6666666667px #00ff51,-132px -243.6666666667px #6fff00,-81px -302.6666666667px #40ff00;box-shadow:-23px 61.3333333333px #ff00e6,-76px 49.3333333333px #006aff,-118px -236.6666666667px #02f,-234px -56.6666666667px #e6ff00,-70px -412.6666666667px #ff0095,10px -55.6666666667px #ff0095,-151px -243.6666666667px #fb0,-138px -284.6666666667px #00ff1e,-123px 68.3333333333px #0026ff,-149px 13.3333333333px #bfff00,85px -81.6666666667px #4dff00,13px -233.6666666667px #ffd500,162px -215.6666666667px #006fff,134px -12.6666666667px #8c00ff,-159px .3333333333px #ff2b00,-196px -367.6666666667px #4800ff,-136px -127.6666666667px #30f,28px -372.6666666667px #00b3ff,-135px -270.6666666667px #0091ff,91px -299.6666666667px #005eff,-237px -190.6666666667px #f40,-176px -211.6666666667px #f0d,115px 7.3333333333px #05f,16px -41.6666666667px #00ffea,179px -158.6666666667px #bf00ff,168px -106.6666666667px #ffd000,141px -32.6666666667px #ff007b,103px -303.6666666667px #ff4800,48px -1.6666666667px #f0c,96px -34.6666666667px #b3ff00,101px -139.6666666667px #0400ff,113px -252.6666666667px #00ff1a,-87px -48.6666666667px #37ff00,86px -191.6666666667px #0dff00,21px -51.6666666667px #15ff00,28px -331.6666666667px #08f,48px -185.6666666667px #d000ff,238px -333.6666666667px #ff00a6,-73px -43.6666666667px #ff007b,53px 56.3333333333px #40f,188px -80.6666666667px #ff001e,-120px -40.6666666667px #0009ff,175px -352.6666666667px #f0e,-51px 61.3333333333px #00ffae,-223px -44.6666666667px #ff001a,-184px -391.6666666667px #9500ff,-78px -199.6666666667px #ffb300,242px 82.3333333333px #006aff,-28px -181.6666666667px #00ff51,-132px -243.6666666667px #6fff00,-81px -302.6666666667px #40ff00}}@keyframes bang{to{-webkit-box-shadow:-23px 61.3333333333px #ff00e6,-76px 49.3333333333px #006aff,-118px -236.6666666667px #02f,-234px -56.6666666667px #e6ff00,-70px -412.6666666667px #ff0095,10px -55.6666666667px #ff0095,-151px -243.6666666667px #fb0,-138px -284.6666666667px #00ff1e,-123px 68.3333333333px #0026ff,-149px 13.3333333333px #bfff00,85px -81.6666666667px #4dff00,13px -233.6666666667px #ffd500,162px -215.6666666667px #006fff,134px -12.6666666667px #8c00ff,-159px .3333333333px #ff2b00,-196px -367.6666666667px #4800ff,-136px -127.6666666667px #30f,28px -372.6666666667px #00b3ff,-135px -270.6666666667px #0091ff,91px -299.6666666667px #005eff,-237px -190.6666666667px #f40,-176px -211.6666666667px #f0d,115px 7.3333333333px #05f,16px -41.6666666667px #00ffea,179px -158.6666666667px #bf00ff,168px -106.6666666667px #ffd000,141px -32.6666666667px #ff007b,103px -303.6666666667px #ff4800,48px -1.6666666667px #f0c,96px -34.6666666667px #b3ff00,101px -139.6666666667px #0400ff,113px -252.6666666667px #00ff1a,-87px -48.6666666667px #37ff00,86px -191.6666666667px #0dff00,21px -51.6666666667px #15ff00,28px -331.6666666667px #08f,48px -185.6666666667px #d000ff,238px -333.6666666667px #ff00a6,-73px -43.6666666667px #ff007b,53px 56.3333333333px #40f,188px -80.6666666667px #ff001e,-120px -40.6666666667px #0009ff,175px -352.6666666667px #f0e,-51px 61.3333333333px #00ffae,-223px -44.6666666667px #ff001a,-184px -391.6666666667px #9500ff,-78px -199.6666666667px #ffb300,242px 82.3333333333px #006aff,-28px -181.6666666667px #00ff51,-132px -243.6666666667px #6fff00,-81px -302.6666666667px #40ff00;box-shadow:-23px 61.3333333333px #ff00e6,-76px 49.3333333333px #006aff,-118px -236.6666666667px #02f,-234px -56.6666666667px #e6ff00,-70px -412.6666666667px #ff0095,10px -55.6666666667px #ff0095,-151px -243.6666666667px #fb0,-138px -284.6666666667px #00ff1e,-123px 68.3333333333px #0026ff,-149px 13.3333333333px #bfff00,85px -81.6666666667px #4dff00,13px -233.6666666667px #ffd500,162px -215.6666666667px #006fff,134px -12.6666666667px #8c00ff,-159px .3333333333px #ff2b00,-196px -367.6666666667px #4800ff,-136px -127.6666666667px #30f,28px -372.6666666667px #00b3ff,-135px -270.6666666667px #0091ff,91px -299.6666666667px #005eff,-237px -190.6666666667px #f40,-176px -211.6666666667px #f0d,115px 7.3333333333px #05f,16px -41.6666666667px #00ffea,179px -158.6666666667px #bf00ff,168px -106.6666666667px #ffd000,141px -32.6666666667px #ff007b,103px -303.6666666667px #ff4800,48px -1.6666666667px #f0c,96px -34.6666666667px #b3ff00,101px -139.6666666667px #0400ff,113px -252.6666666667px #00ff1a,-87px -48.6666666667px #37ff00,86px -191.6666666667px #0dff00,21px -51.6666666667px #15ff00,28px -331.6666666667px #08f,48px -185.6666666667px #d000ff,238px -333.6666666667px #ff00a6,-73px -43.6666666667px #ff007b,53px 56.3333333333px #40f,188px -80.6666666667px #ff001e,-120px -40.6666666667px #0009ff,175px -352.6666666667px #f0e,-51px 61.3333333333px #00ffae,-223px -44.6666666667px #ff001a,-184px -391.6666666667px #9500ff,-78px -199.6666666667px #ffb300,242px 82.3333333333px #006aff,-28px -181.6666666667px #00ff51,-132px -243.6666666667px #6fff00,-81px -302.6666666667px #40ff00}}@-webkit-keyframes gravity{to{transform:translateY(200px);-moz-transform:translateY(200px);-webkit-transform:translateY(200px);-o-transform:translateY(200px);-ms-transform:translateY(200px);opacity:0}}@keyframes gravity{to{transform:translateY(200px);-moz-transform:translateY(200px);-webkit-transform:translateY(200px);-o-transform:translateY(200px);-ms-transform:translateY(200px);opacity:0}}@-webkit-keyframes position{0%,19.9%{margin-top:10%;margin-left:40%}20%,39.9%{margin-top:40%;margin-left:30%}40%,59.9%{margin-top:20%;margin-left:70%}60%,79.9%{margin-top:30%;margin-left:20%}80%,99.9%{margin-top:30%;margin-left:80%}}@keyframes position{0%,19.9%{margin-top:10%;margin-left:40%}20%,39.9%{margin-top:40%;margin-left:30%}40%,59.9%{margin-top:20%;margin-left:70%}60%,79.9%{margin-top:30%;margin-left:20%}80%,99.9%{margin-top:30%;margin-left:80%}}
    </style>
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
                <?php if( !empty($orderItem) ) : ?>
                    <?php if($viewOrderStatus) : ?>
                        <div class="main_content_wrap_append">
                            <div class="order_status_wrap">
                                <div class="order_status_section_item">
                                    <div class="thank_you_order_success">
                                        <div class="thank_you_heading d_flex align_items_center">
                                            <span style="width: 40px; height: 40px; display: block;">
                                                <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/order_success.png"); }} ?>" alt="">
                                            </span>
                                            <h4 class="success_title"><?php {{ echo Format::formatOrder($orderItem['order_status']); }} ?></h4>
                                        </div>
                                        <div class="pyro">
                                            <div class="before"></div>
                                            <div class="after"></div>
                                        </div>
                                        <div class="ntf_order_code">
                                            <div class="order_code item">Mã đơn hàng của bạn <span class="code_order_value"><?php {{ echo $orderItem['order_code']; }} ?></span></div>
                                            <div class="order_time item">Đơn hàng được đặt vào <?php {{ echo Format::formatTimeOrder($orderItem['order_createDate']); }} ?></div>
                                            <div class="order_view item">Xem chi tiết đơn hàng tại <a href="<?php {{ echo Config::getBaseUrlClient("chi-tiet-don-hang.html?donhangID={$orderItem['order_code']}"); }} ?>" class="d_inline view_my_order">đơn hàng của tôi</a></div>
                                            <div class="order_note item">
                                                <p>Thông tin chi tiết về đơn hàng đã được gửi đến địa chỉ mail <a href="mailTo:<?php {{ echo $orderItem['order_customer_email']; }} ?>" class="d_inline view_my_email"><?php {{ echo $orderItem['order_customer_email']; }} ?>.</a></p>
                                                <p>Nếu không tìm thấy vui lòng kiểm tra trong hộp thoại thư <strong>Spam</strong> hoặc <strong>Junk Folder</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order_status_section_item">
                                    <div class="payment_amount">
                                        <div class="pa_title">Tổng giá trị đơn hàng</div>
                                        <div class="pa_value"><?php {{ echo Format::formatCurrency($orderItem['order_totalPrice']); }} ?></div>
                                    </div>
                                    <div class="package_delivery">
                                        <div class="title">Sản phẩm trong đơn hàng</div>
                                        <div class="list_prod">
                                            <?php if( !empty($listOrderItem) ) : ?>
                                                <?php foreach($listOrderItem as $orderItem_item) : ?>
                                                    <div class="prod_item">
                                                        <div class="image">
                                                            <img class="full_size" src="<?php {{ echo Config::getBaseUrlAdmin($orderItem_item['prodInfo']['prod_avatar']); }} ?>" alt="<?php {{ echo $orderItem_item['prodInfo']['prod_name']; }} ?>">
                                                        </div>
                                                        <div class="content">
                                                            <p class="name"><?php {{ echo $orderItem_item['prodInfo']['prod_name']; }} ?></p>
                                                            <div class="price_inner">
                                                                <p>
                                                                    <span class="qty"><?php {{ echo $orderItem_item['orderItem_amount']; }} ?> x</span>
                                                                    <span class="price"><?php {{ echo Format::formatCurrency((int) $orderItem_item['orderItem_price'] / (int) $orderItem_item['orderItem_amount']); }} ?></span>
                                                                </p>
                                                                <span class="totalPrice"><?php {{
                                                                    echo Format::formatCurrency((int) $orderItem_item['orderItem_amount'] * ((int) $orderItem_item['orderItem_price'] / (int) $orderItem_item['orderItem_amount']));
                                                                }} ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                                                    <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                                                    <p style="font-size: .9rem;">Không có sản phẩm nào trong đơn hàng</p>
                                                    <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                                                    <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="button_inner">
                                            <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="btn_order">Tiếp tục mua hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                            <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                            <p style="font-size: .9rem;">Đơn hàng này không phải của bạn</p>
                            <a href="<?php {{ echo Config::getBaseUrlClient("dang-nhap.html"); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 30px; font-size: .95rem; border-radius: 5px;">ĐĂNG NHẬP ĐỂ XEM ĐƠN HÀNG</a>
                            <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                        <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Không có sản phẩm nào trong giỏ hàng">
                        <p style="font-size: .9rem;">Đơn hàng không tồn tại</p>
                        <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                        <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                    </div>
                <?php endif; ?>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
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