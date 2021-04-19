<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) && !empty($infoSpItem) ) : ?>
        <title><?php {{ echo !empty($infoSpItem['prodsp_metaTitle']) ? $infoSpItem['prodsp_metaTitle'] : "Thông tin hỗ trợ sản phẩm"; }} ?></title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="<?php {{ echo !empty($infoSpItem['prodsp_metaDesc']) ? $infoSpItem['prodsp_metaDesc'] : null; }} ?>">
        <meta property="og:title" content="<?php {{ echo !empty($infoSpItem['prodsp_metaTitle']) ? $infoSpItem['prodsp_metaTitle'] : null; }} ?>">
        <meta property="og:description" content="<?php {{ echo !empty($infoSpItem['prodsp_metaDesc']) ? $infoSpItem['prodsp_metaDesc'] : null; }} ?>">
        <?php if(!empty($prodItem)) : ?>
            <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("ho-tro-mua-hang/{$infoSpItem['prodsp_seoUrl']}-ip{$infoSpItem['prodsp_id']}/prod={$prodItem['prod_id']}"); }} ?>">
        <?php else : ?>
            <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("ho-tro-mua-hang/{$infoSpItem['prodsp_seoUrl']}-ip{$infoSpItem['prodsp_id']}"); }} ?>">
        <?php endif; ?>
        <meta property="og:site_name" content="<?php {{ echo !empty($infoSpItem['prodsp_metaTitle']) ? $infoSpItem['prodsp_metaTitle'] : null; }} ?>">
        <meta property="og:image" content="<?php {{ echo !empty($infoSpItem['prodsp_metaImg']) ? Config::getBaseUrlAdmin($infoSpItem['prodsp_metaImg']) : null; }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo !empty($infoSpItem['prodsp_metaImg']) ? Config::getBaseUrlAdmin($infoSpItem['prodsp_metaImg']) : null; }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php {{ echo !empty($infoSpItem['prodsp_metaTitle']) ? $infoSpItem['prodsp_metaTitle'] : null; }} ?>">
        <meta name="twitter:description" content="<?php {{ echo !empty($infoSpItem['prodsp_metaDesc']) ? $infoSpItem['prodsp_metaDesc'] : null; }} ?>">
        <meta name="twitter:image" content="<?php {{ echo !empty($infoSpItem['prodsp_metaImg']) ? Config::getBaseUrlAdmin($infoSpItem['prodsp_metaImg']) : null; }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/infosupportprod.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/flickity.min.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <?php if(!empty($infoSpItem)) : ?>
                <section class="breadcrum_wrap">
                <div class="container">
                    <ol class="breadcrum_list grid_row align_items_center">
                        <li class="breadcrum_item home d_flex align_items_center">
                            <a href="" class="breadcrum_link" title="Về trang chủ">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        </li>
                        <li class="breadcrum_item nav3 d_flex align_items_center position_relative">
                            <a href="javascript:;" class="breadcrum_link" title="Bếp từ, Bếp lẩu">
                                <span><?php {{ echo $infoSpItem['prodsp_name']; }} ?></span>
                            </a>
                        </li>
                    </ol>
                </div>
            </section>
            <main class="main_sc">
                <div class="container main_content_wrap_append">
                    <div class="grid_row" style="margin: 20px 0;">
                        <div class="grid_column_3 sidebar_left">
                            <div class="sidebox_item">
                                <div class="sidebox_title">LIÊN HỆ MUA HÀNG</div>
                                <div class="sidebox_tree">
                                    <ul class="list_tree">
                                        <li class="tree_item">
                                            <div class="support_item">
                                                <i class="fa fa-phone-square"></i>
                                                <strong>Đà Nẵng</strong>
                                                <a href="tel:0708070827" class="d_inline_block">0708 0708 27</a>
                                            </div>
                                            <div class="support_item d_flex">
                                                <span>
                                                    <i class="fa fa-home"></i>
                                                </span>
                                                <div class="txt_content">
                                                    <span>104 Lương Nhữ Hộc - Hoà Cường Bắc- Quận Hải Châu - TP Đà Nẵng</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="tree_item">
                                            <div class="support_item">
                                                <i class="fa fa-envelope"></i>
                                                <strong>Email</strong>
                                                <a class="d_inline_block" target="_blank" href="mailTo:tienichnhabep.vn@gmail.com">tienichnhabep.vn@gmail.com</a>
                                            </div>
                                        </li>
                                        <li class="tree_item">
                                            <div class="support_item">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Thời gian làm việc:</strong>
                                            </div>
                                            <div class="support_item">
                                                <div class="txt_content">Từ 8h00 - 20h00 Thứ 2 đến thứ 7</div>
                                                <div class="txt_content">Từ 8h00 - 11h00 Chủ nhật</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="grid_column_md_12 grid_column_lg_6 main_body">
                            <?php {{ view("Inc.adsProdRecomment"); }} ?>
                            <article style="padding: 10px;">
                                <?php {{
                                    echo $infoSpItem['prodsp_content'];
                                }} ?>
                            </article>
                            <?php if( !empty($prodItem) ) : ?>
                                <div class="detail_info_prod grid_row">
                                    <div class="detail_info_left grid_column_12 grid_column_lg_7">
                                        <div class="info_main">
                                            <h2 class="name_prod"><?php {{ echo $prodItem['prod_name']; }} ?></h2>
                                        </div>
                                        <a target="_blank" class="share_prod d_flex justify_content_center align_items_center" href="https://www.facebook.com/sharer/sharer.php?u=<?php {{ echo Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>">
                                            <i class="fa fa-share-square" style="margin-right: 3px;" aria-hidden="true"></i>
                                            <span>Share</span>
                                        </a>
                                        <?php if(!empty($prodItem['brand_id'])) : ?>
                                        <div class="info_rela_item">
                                            <span class="label">Thương hiệu:</span>
                                            <a href="<?php {{ echo Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}"); }} ?>" title="<?php {{ echo "Thương hiệu {$prodItem['brand_name']}"; }} ?>" class="value d_inline_block">
                                                <span><?php {{ echo $prodItem['brand_name']; }} ?></span>
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                        <div class="desc_wrap">
                                            <?php {{ echo $prodItem['prod_intro_content']; }} ?>
                                        </div>
                                        <div class="info_default">
                                            <?php if(!empty($flashSaleToday)) : ?>
                                            <a href="<?php {{ echo Config::getBaseUrlAdmin("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>" class="flash_sale_progress grid_row">
                                                <div class="sold info_item">
                                                    <span class="d_block price_current"><?php {{ echo Format::formatCurrency($flashSaleToday['prod_flashsale_price']); }} ?></span>
                                                    <div class="d_block price_market" style="margin: 4px 0;">
                                                        <span><?php {{ echo Format::promotionalPercent($flashSaleToday['prod_flashsale_price'], $prodItem['prod_oldPrice']); }} ?></span>
                                                        <strong><?php {{ echo Format::formatCurrency($prodItem['prod_oldPrice']); }} ?></strong>
                                                    </div>
                                                    <?php if($prodItem['prod_avt_tax'] == '1') : ?>
                                                        <span class="vat" style="font-size: .7rem;">(Đã gồm VAT)</span>
                                                    <?php else : ?>
                                                        <span class="vat" style="font-size: .7rem;">(Chưa bao gồm VAT)</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="countDown_time info_item d_flex align_items_end">
                                                    <span class="label">Kết thúc sau</span>
                                                    <div class="value_wrap date_flashSale_wrap" data-startDate="<?php {{ echo $flashSaleToday['prod_flashsale_dateStart']; }} ?>" data-endDate="<?php {{ echo $flashSaleToday['prod_flashsale_dateEnd']; }} ?>" data-flashprice="<?php {{ echo $flashSaleToday['prod_flashsale_price']; }} ?>">
                                                        <div>00 ngày 00:00:00</div>
                                                    </div>
                                                    <span>Còn <?php {{ echo $prodItem['prod_amount']; }} ?> sản phẩm</span>
                                                </div>
                                            </a>
                                            <?php else : ?>
                                            <div class="info_price __price_curr">
                                                <span class="label">Giá bán:</span>
                                                <span class="value" style="font-size: 1.2rem;color: #d80505;font-weight: bold;"><?php {{ echo Format::formatCurrency($prodItem['prod_currentPrice']); }} ?></span>
                                                <?php if($prodItem['prod_avt_tax'] == '1') : ?>
                                                    <span class="vat">(Đã gồm VAT)</span>
                                                <?php else : ?>
                                                    <span class="vat">(Chưa bao gồm VAT)</span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if(!empty($prodItem['prod_oldPrice'])) : ?>
                                                <div class="info_price  __price_old d_flex align_items_center ">
                                                    <span class="label" style="margin-right: 3px;">Giá cũ:</span>
                                                    <span class="value"><?php {{ echo Format::formatCurrency($prodItem['prod_oldPrice']); }} ?></span>
                                                    <div class="discount" style="margin-left: 10px;background-color: #00BCD4;color: #fff;padding: 2px 3px;border-radius: 2px;font-size: .9rem;">
                                                        <span><?php {{ echo Format::promotionalPercent($prodItem['prod_currentPrice'], $prodItem['prod_oldPrice']); }} ?></span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="button_wrap grid_row justify_content_between align_items_center">
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html?act=pay"); }} ?>" <?php {{
                                                $arrUnAllow = [2,4,5,6];
                                                if( in_array($prodItem['prod_stock_status'], $arrUnAllow) ) {
                                                    echo "disabled";
                                                }
                                            }} ?> class="btn addCart">
                                                <span class="icon">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                </span>
                                                <span class="main_title">MUA NGAY</span>
                                            </a>
                                            <a href="tel:0708070827" class="btn advisory">
                                                <span class="icon">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </span>
                                                <span class="main_title">TƯ VẤN</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="detail_info_right grid_column_12 grid_column_lg_5 position_relative">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>" class="prod_avatar">
                                            <span class="thumbNail">
                                                <img class="full_size" src="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>">
                                            </span>
                                        </a>
                                        <?php {{ echo Format::statusProdStock($prodItem['prod_stock_status']); }} ?>
                                        <?php if($prodItem['prod_installment'] == "1") : ?>
                                            <div class="installment" style="z-index: 10; font-size: 1rem;">Trả góp <?php {{ echo $prodItem['prod_installment_rate']."%"; }} ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if( !empty($prodItem['prod_specifications_content']) ) : ?>
                                        <div class="detail_info_content_desc_more grid_column_12">
                                            <div class="title">Thông số sản phẩm <?php {{ echo $prodItem['prod_name']; }} ?></div>
                                            <div class="content">
                                                <?php {{ echo $prodItem['prod_specifications_content']; }} ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if( !empty($prodItem['prod_outstanding_features']) ) : ?>
                                        <div class="detail_info_content_desc_more grid_column_12">
                                            <div class="title">Tính năng đặt biệt <?php {{ echo $prodItem['prod_name']; }} ?></div>
                                            <div class="content">
                                                <?php {{ echo $prodItem['prod_outstanding_features']; }} ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                            <?php endif; ?>
                            <?php {{ view("Inc.formsupport", [
                                "prod_id" => !empty($prodItem['prod_id']) ? $prodItem['prod_id'] : null
                            ]); }} ?>
                        </div>
                        <div class="grid_column_3 sidebar_right">
                            <div class="ads_banner">
                                <!-- <a href="" class="ads_banner_link" style="height: 300px; width: 100%;"></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php else: ?>
                <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                    <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="">
                    <p style="font-size: .9rem;">Thông tin hỗ trợ mua hàng này không tồn tại</p>
                    <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                    <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                </div>
            <?php endif; ?>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <script>
        let btnOpen = document.querySelectorAll(".open_popup_filter");
        let btnClose = document.querySelectorAll(".close_popup_filter");
        btnOpen.forEach(function(el) {
            el.addEventListener('click', function() {
                btnOpen.forEach(el=> {
                    el.parentElement.classList.remove('open');
                });
                this.classList.remove('open_popup_filter');
                this.classList.add('close_popup_filter');
                let elPopup = this.parentElement;
                if(elPopup.classList.contains('open')) {
                    elPopup.classList.remove('open');
                } else {
                    elPopup.classList.add('open');
                }
            });
        });
        btnClose.forEach(function(el) {
            el.addEventListener('click', function() {
                event.preventDefault();
                this.parentElement.parentElement.classList.remove('open');
                console.log('close');
            });
        });
    </script>
    <script>
        function makeTimer(startTimeNumber, endTimeNumber, elAppend) {
            var timeLeft = endTimeNumber - startTimeNumber;
            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
            if (hours < "10") {
                hours = "0" + hours;
            }
            if (minutes < "10") {
                minutes = "0" + minutes;
            }
            if (seconds < "10") {
                seconds = "0" + seconds;
            }
            let stringDate = days + " ngày " + hours + ":" + minutes + ":" + seconds;
            elAppend.innerHTML = (stringDate);
        }
        coutDownTime_flasSale();
        function coutDownTime_flasSale() {
            let flashSaleTime_el = document.querySelectorAll(".date_flashSale_wrap");
            flashSaleTime_el.forEach(el => {
                let endDate = parseInt(el.getAttribute("data-enddate"));
                let elAppend = el.children[0];
                handleData_flashSale(endDate, elAppend);
            });
        }
        function handleData_flashSale(endDate, elAppend) {
            let currentDate = getCurrentDate_timeStamp();
            let timerObj = {
                start: currentDate,
                end: endDate
            };
            var countTimeLoop = null;
            interValTimeDown();
            function interValTimeDown() {
                countTimeLoop = setInterval(() => {
                    setCountDownTime();
                }, 1000);
            }
            function setCountDownTime() {
                timerObj['start'] ++;
                makeTimer(timerObj['start'], timerObj['end'], elAppend);
                if(timerObj['start'] == timerObj['end']) {
                    clearInterval(countTimeLoop);
                }
            }
        }
        function getCurrentDate_timeStamp() {
            function getTimestamp(date) {
                var tp = Math.round(Date.parse(date) / 1000);
                return tp;
            }
            var time = new Date().getTime();
            var dates = new Date(time);
            return getTimestamp(dates);
        }
    </script>
</body>
</html>