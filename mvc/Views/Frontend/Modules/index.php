<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) && !empty($module) ) : ?>
        <title><?php {{ echo !empty($module['module_metaTitle']) ? $module['module_metaTitle'] : "Không tồn tại module này"; }} ?></title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="<?php {{ echo !empty($module['module_metaDesc']) ? $module['module_metaDesc'] : null; }} ?>">
        <meta name="keywords" content="<?php {{ echo !empty($module['module_keyword']) ? $module['module_keyword'] : null; }} ?>">
        <meta property="og:title" content="<?php {{ echo !empty($module['module_metaTitle']) ? $module['module_metaTitle'] : null; }} ?>">
        <meta property="og:description" content="<?php {{ echo !empty($module['module_metaDesc']) ? $module['module_metaDesc'] : null; }} ?>">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient(Format::create_slug($module['module_name'])) . "/m" . $module['module_id'] . "/" . $module['module_seoUrl'] . ".html"; }} ?>">
        <meta property="og:site_name" content="<?php {{ echo Config::getBaseUrlClient(Format::create_slug($module['module_name'])) . "/m" . $module['module_id'] . "/" . $module['module_seoUrl'] . ".html"; }} ?>">
        <meta property="og:image" content="<?php {{ echo !empty($module['module_bannerMb']) ? Config::getBaseUrlAdmin($module['module_bannerMb']) : null; }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo !empty($module['module_bannerMb']) ? Config::getBaseUrlAdmin($module['module_bannerMb']) : null; }} ?>">
        <meta property="og:keywords" content="<?php {{ echo !empty($module['module_keyword']) ? $module['module_keyword'] : null; }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php {{ echo !empty($module['module_metaTitle']) ? $module['module_metaTitle'] : null; }} ?>">
        <meta name="twitter:description" content="<?php {{ echo !empty($module['module_metaDesc']) ? $module['module_metaDesc'] : null; }} ?>">
        <meta name="twitter:image" content="<?php {{ echo !empty($module['module_bannerMb']) ? Config::getBaseUrlAdmin($module['module_bannerMb']) : null; }} ?>">
        <meta name="twitter:keywords" content="<?php {{ echo !empty($module['module_keyword']) ? $module['module_keyword'] : null; }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/module.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <?php if( !empty($module) ) : ?>
                <main class="main_sc">
                    <div id="module_wrap">
                        <div class="tabbar_menu_control">
                            <ul class="list_menu_control d_flex align_items_center" style="background-color: <?php {{ echo $module['module_bg_title']; }} ?>">
                                <li class="menu_control_main">
                                    <span class="promo_tab_text title"><?php {{ echo $module['module_name']; }} ?></span>
                                </li>
                                <?php if(!empty($listModuleitem)) : ?>
                                    <?php foreach($listModuleitem as $moduleitem_item) : ?>
                                        <li class="menu_control_item">
                                            <a href="#tab=<?php {{ echo Format::create_slug($moduleitem_item['moduleitem_nametap']); }} ?>" class="promo_tab_text control_link">
                                                <span><?php {{ echo $moduleitem_item['moduleitem_nametap']; }} ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php if( !empty($listModuleitem) ) : ?>
                            <div class="module_content">
                                <div class="module_banner_wrap">
                                    <div class="thumbImg">
                                        <img class="module_banner module_bannerPc" src="<?php {{ echo Config::getBaseUrlAdmin($module['module_bannerPc']); }} ?>" alt="<?php {{ echo $module['module_name']; }} ?>">
                                        <img class="module_banner module_bannerMb" src="<?php {{ echo Config::getBaseUrlAdmin($module['module_bannerMb']); }} ?>" alt="<?php {{ echo $module['module_name']; }} ?>">
                                    </div>
                                </div>
                                <?php foreach($listModuleitem as $moduleitem_item) : ?>
                                    <section class="moduleitem_wrap" id="<?php {{ echo Format::create_slug($moduleitem_item['moduleitem_nametap']); }} ?>">
                                        <div class="moduleitem_header">
                                            <?php if( !empty($moduleitem_item['moduleitem_title_img']) ) : ?>
                                                <div class="moduleitem_img">
                                                    <img class="lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($moduleitem_item['moduleitem_title_img']); }} ?>" alt="<?php {{ echo $moduleitem_item['moduleitem_title_txt']; }} ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php if( !empty($moduleitem_item['module_banner']) ) : ?>
                                                <div class="container">
                                                    <div class="moduleitem_banner grid_row justify_content_center">
                                                        <?php foreach($moduleitem_item['module_banner'] as $bannerPromoItem) : ?>
                                                            <div class="grid_column_6 grid_column_lg_4 moduleitem_bannerItem">
                                                                <a href="<?php {{ echo $bannerPromoItem['modulebannerPromo_link']; }} ?>" target="<?php {{ echo $bannerPromoItem['modulebannerPromo_target']; }} ?>">
                                                                    <img class="full_size lazy" title="<?php {{ echo $bannerPromoItem['modulebannerPromo_desc']; }} ?>" data-original="<?php {{ echo Config::getBaseUrlAdmin($bannerPromoItem['modulebannerPromo_src']); }} ?>" alt="<?php {{ echo $bannerPromoItem['modulebannerPromo_title']; }} ?>">
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="moduleitem_body">
                                            <div class="moduleitem_listProd" style="background-color: <?php echo $moduleitem_item['moduleitem_bg_body'] !== "#000000" ? $moduleitem_item['moduleitem_bg_body'] . "; box-shadow: 0 0 10px rgba(0,0,0,0.12);" : "initial"; ?>">
                                                <div class="moduleitem_listProd_title">
                                                    <h4 class="title"><?php {{ echo $moduleitem_item['moduleitem_title_txt']; }} ?></h4>
                                                </div>
                                                <div class="moduleitem_listProd_body grid_row justify_content_center">
                                                    <?php if( !empty($moduleitem_item['list_prod']) ) : ?>
                                                        <?php foreach($moduleitem_item['list_prod'] as $prodItem) : ?>
                                                            <?php {{ $prodItem['prod_url']  = Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>
                                                            <?php {{ $prodItem['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}.html"); }} ?>
                                                            <div class="grid_column_6 grid_column_md_4 grid_column_lg_tp prod_item_box">
                                                                <div class="prod_item_wrap">
                                                                    <?php {{ echo Format::statusProdStock($prodItem['prod_stock_status']); }} ?>
                                                                    <?php if(!empty($prodItem['flashSale'])) : ?>
                                                                        <?php if((int) $prodItem['flashSale'][0]['prod_flashsale_price'] < (int) $prodItem['prod_currentPrice']) : ?>
                                                                            <div class="prod_discount" style="background: var(--main-color);"><?php {{ echo Format::promotionalPercent($prodItem['flashSale'][0]['prod_flashsale_price'], $prodItem['prod_oldPrice']); }} ?></div>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <?php if((int) $prodItem['prod_currentPrice'] < (int) $prodItem['prod_oldPrice']) : ?>
                                                                            <div class="prod_discount"><?php {{ echo Format::promotionalPercent($prodItem['prod_currentPrice'], $prodItem['prod_oldPrice']); }} ?></div>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <div class="prod_image position_relative">
                                                                        <?php if(!empty($prodItem['prod_discout_content'])) : ?>
                                                                            <div class="promo_wrap">
                                                                                <a href="<?php {{ echo $prodItem['prod_url']; }} ?>" class="promo_link">
                                                                                    <i class="icon_gift"></i>
                                                                                </a>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if(!empty($prodItem['prod_deliveryPromo'])) : ?>
                                                                            <div class="freeship_sale">
                                                                                <span><?php {{ echo $prodItem['prod_deliveryPromo']; }} ?></span>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <a href="<?php {{ echo $prodItem['prod_url']; }} ?>" title="<?php {{ echo $prodItem['prod_name']; }} ?>" class="thumbNail">
                                                                            <img class="lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>" width="200" height="200">
                                                                        </a>
                                                                        <?php if($prodItem['prod_installment'] == "1") : ?>
                                                                            <div class="installment">Trả góp <?php {{ echo $prodItem['prod_installment_rate']."%"; }} ?></div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="prod_info">
                                                                        <div class="prod_info_name">
                                                                            <a href="<?php {{ echo $prodItem['prod_url']; }} ?>" title="<?php {{ echo $prodItem['prod_name']; }} ?>"><?php {{ echo $prodItem['prod_name']; }} ?></a>
                                                                        </div>
                                                                        <div class="prod_info_brand">
                                                                            <a href="<?php {{ echo $prodItem['brand_url']; }} ?>" title="<?php {{ echo "Thương hiệu {$prodItem['brand_name']}"; }} ?>"><?php {{ echo $prodItem['brand_name']; }} ?></a>
                                                                        </div>
                                                                        <?php if(!empty($prodItem['flashSale'])) : ?>
                                                                            <a href="<?php {{ echo $prodItem['prod_url']; }} ?>" class="flash_sale_progress grid_row">
                                                                                <div class="sold info_item">
                                                                                    <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($prodItem['flashSale'][0]['prod_flashsale_price']); }} ?></span>
                                                                                    <span class="prod_info_price_market"><?php {{ echo Format::formatCurrency($prodItem['prod_oldPrice']); }} ?></span>
                                                                                </div>
                                                                                <div class="countDown_time info_item d_flex align_items_end">
                                                                                    <span class="label">Kết thúc sau</span>
                                                                                    <div class="value_wrap date_flashSale_wrap" data-startDate="<?php {{ echo $prodItem['flashSale'][0]['prod_flashsale_dateStart']; }} ?>" data-endDate="<?php {{ echo $prodItem['flashSale'][0]['prod_flashsale_dateEnd']; }} ?>" data-flashprice="<?php {{ echo $prodItem['flashSale'][0]['prod_flashsale_price']; }} ?>">
                                                                                        <div>00 ngày 00:00:00</div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        <?php else: ?>
                                                                            <a href="<?php {{ echo $prodItem['prod_url']; }} ?>" class="grid_row">
                                                                                <div class="prod_info_price grid_column_6">
                                                                                    <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($prodItem['prod_currentPrice']); }} ?></span>
                                                                                    <span class="prod_info_price_market"><?php {{ echo Format::formatCurrency($prodItem['prod_oldPrice']); }} ?></span>
                                                                                </div>
                                                                                <div class="prod_info_rate grid_column_6 d_flex flex_column align_items_end">
                                                                                    <div class="rating_box" title="Tuyệt vời">
                                                                                        <span class="fa fa-star rated"></span>
                                                                                        <span class="fa fa-star rated"></span>
                                                                                        <span class="fa fa-star rated"></span>
                                                                                        <span class="fa fa-star rated"></span>
                                                                                        <span class="fa fa-star rated"></span>
                                                                                    </div>
                                                                                    <div class="amout_rate">(10 đánh giá)</div>
                                                                                </div>
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="prod_button d_flex justify_content_center">
                                                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html?act=pay"); }} ?>" class="payNow_btn">MUA NGAY</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if( !empty($moduleitem_item['moduleitem_cateProd_id_ties']) ) : ?>
                                            <div class="moduleitem_button d_flex justify_content_center">
                                                <a href="<?php echo Config::getBaseUrlClient("{$moduleitem_item['cateProd_seoUrl']}-c{$moduleitem_item['moduleitem_cateProd_id_ties']}.html"); ?>" class="see_more">Xem thêm</a>
                                            </div>
                                        <?php endif; ?>
                                    </section>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </main>
                <style>
                    #module_wrap {
                        background-color: <?php {{ echo $module['module_bg_body']; }} ?>!important;
                        padding-bottom: 1px;
                    }
                    #module_wrap .module_content .module_banner_wrap .module_banner {
                        max-width: 100%;
                        height: auto;
                    }
                    @media screen and (min-width: 320px) {
                        #module_wrap .module_content .module_banner_wrap .module_bannerPc {
                            display: none;
                        }
                        #module_wrap .module_content .module_banner_wrap .module_bannerMb {
                            display: block;
                        }
                    }
                    @media screen and (min-width: 1280px) {
                        #module_wrap .module_content .module_banner_wrap .module_bannerPc {
                            display: block;
                        }
                        #module_wrap .module_content .module_banner_wrap .module_bannerMb {
                            display: none;
                        }
                    }
                </style>
            <?php else: ?>
                <div class="cart_empty" style="margin: 50px auto; text-align: center;">
                    <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/trang-khong-ton-tai.png"); }} ?>" alt="Trang này không tồn tại">
                    <p style="font-size: .9rem;">Trang này hiện không tồn tại, hoặc đã bị xóa bỏ !</p>
                    <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 90px; font-size: .95rem; border-radius: 5px;">VỀ TRANG CHỦ</a>
                    <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                </div>
            <?php endif; ?>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/app/module.js"); }} ?>"></script>
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