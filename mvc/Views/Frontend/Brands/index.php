<!DOCTYPE html>
<html lang="en">

<head>
    <?php if( !empty($configInfo) && !empty($brandItem) ) : ?>
        <title><?php {{ echo !empty($brandItem['brand_metaTitle']) ? $brandItem['brand_metaTitle'] : "Thương hiệu sản phẩm"; }} ?></title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="<?php {{ echo !empty($brandItem['brand_metaDesc']) ? $brandItem['brand_metaDesc'] : null; }} ?>">
        <meta name="keywords" content="<?php {{ echo !empty($brandItem['brand_keywords']) ? $brandItem['brand_keywords'] : null; }} ?>">
        <meta property="og:title" content="<?php {{ echo !empty($brandItem['brand_metaTitle']) ? $brandItem['brand_metaTitle'] : null; }} ?>">
        <meta property="og:description" content="<?php {{ echo !empty($brandItem['brand_metaDesc']) ? $brandItem['brand_metaDesc'] : null; }} ?>">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient(Format::create_slug($brandItem['brand_name']) . "-b{$brandItem['brand_id']}.html" ); }} ?>">
        <meta property="og:site_name" content="<?php {{ echo !empty($brandItem['brand_metaTitle']) ? $brandItem['brand_metaTitle'] : null; }} ?>">
        <meta property="og:image" content="<?php {{ echo !empty($brandItem['brand_metaImg']) ? Config::getBaseUrlAdmin($brandItem['brand_metaImg']) : null; }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient(Format::create_slug($brandItem['brand_name']) . "-b{$brandItem['brand_id']}.html" ); }} ?>">
        <meta property="og:keywords" content="<?php {{ echo !empty($brandItem['brand_keywords']) ? $brandItem['brand_keywords'] : null; }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php {{ echo !empty($brandItem['brand_metaTitle']) ? $brandItem['brand_metaTitle'] : null; }} ?>">
        <meta name="twitter:description" content="<?php {{ echo !empty($brandItem['brand_metaDesc']) ? $brandItem['brand_metaDesc'] : null; }} ?>">
        <meta name="twitter:image" content="<?php {{ echo !empty($brandItem['brand_metaImg']) ? Config::getBaseUrlAdmin($brandItem['brand_metaImg']) : null; }} ?>">
        <meta name="twitter:keywords" content="<?php {{ echo !empty($brandItem['brand_keywords']) ? $brandItem['brand_keywords'] : null; }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/cateProd.css"); }} ?>">
</head>

<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <?php if(!empty($brandItem)) : ?>
            <section class="breadcrum_wrap">
                <div class="container">
                    <ol class="breadcrum_list grid_row align_items_center">
                        <li class="breadcrum_item home d_flex align_items_center">
                            <a href="<?php echo Config::getBaseUrlClient(); ?>" class="breadcrum_link" title="Về trang chủ">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="breadcrum_item nav3 d_flex align_items_center position_relative">
                            <a href="" class="breadcrum_link" title="<?php {{ echo $brandItem['brand_name']; }} ?>">
                                <span><?php {{ echo "Thương hiệu ".$brandItem['brand_name']; }} ?></span>
                            </a>
                        </li>
                    </ol>
                </div>
            </section>
            <main class="main_sc">
                <div class="cate_view_content container grid_row">
                    <aside class="cate_content_sidebar">
                        <style>
                            @media screen and ( min-width: 320px ) {
                                .filter_brands { display: none; }
                            }
                            @media screen and ( min-width: 1280px ) {
                                .filter_brands { display: block; }
                            }
                        </style>
                        <div class="filter_brands sidebar_box_wrap">
                            <div class="sidebar_item_box_header_mobile open_popup_filter d_flex align_items_center">
                                <span class="title">Thương hiệu</span>
                                <i class="fa" aria-hidden="true"></i>
                            </div>
                            <div class="sidebar_item_box_header">
                                <h4 class="title">THƯƠNG HIỆU</h4>
                            </div>
                            <div class="sidebar_item_box_body">
                                <div class="logo_brand">
                                    <span class="thumbNail">
                                        <img class="full_size img_contain lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($brandItem['brand_image']); }} ?>" alt="<?php {{ echo $brandItem['brand_name']; }} ?>">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php if( !empty($menuMultiCateProd) ) : ?>
                        <div class="category_menu sidebar_box_wrap">
                            <div class="sidebar_item_box_header_mobile open_popup_filter d_flex align_items_center">
                                <span class="title">Loại</span>
                                <i class="fa" aria-hidden="true"></i>
                            </div>
                            <div class="sidebar_item_box_header">
                                <h4 class="title">TÌM THEO DANH MỤC</h4>
                            </div>
                            <div class="mask">
                                <a href="" class="close_popup_filter position_absolute">Đóng</a>
                            </div>
                            <div class="sidebar_item_box_body">
                                <?php {{ echo $menuMultiCateProd; }} ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php {{ view("Frontend.Brands.priceFilter", [
                            "brandUrl" => $brandUrl,
                            "sortUrl"  => $sortUrl,
                            "priceArr" => $priceArr
                        ]); }} ?>
                        <div class="banner_ads">
                            <a href="" class="ads_link_view position_relative">
                                <i class="position_absolute fa fa-times" style="color: #333;top: 1%;right: 1%;width: 20px;height: 20px;text-align: center;line-height: 20px;border-radius: 100%;background-color: #fff;font-size: .9rem;"></i>
                                <div style="height: 400px; background-repeat: no-repeat; background-position: center center; background-size: cover; background-image: url(./public/images/sanphammau/THUMBVIVO-380x215.gif);"></div>
                            </a>
                        </div>
                    </aside>
                    <div class="cate_content_main">
                        <?php if(!empty($brandItem['brand_banner'])) : ?>
                        <section class="home_cate_slidershow">
                            <div class="cate_slideshow_wrap pc_size">
                                <div class="cate_slideshow_item carousel-cell">
                                    <a href="" class="cate_slideshow_view_link" title="<?php {{ echo $brandItem['brand_name']; }} ?>">
                                        <img class="img_cover full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($brandItem['brand_banner']); }} ?>" alt="<?php {{ echo $brandItem['brand_name']; }} ?>">
                                    </a>
                                </div>
                            </div>
                        </section>
                        <?php endif; ?>
                        <?php if(!empty($listCateProd)) : ?>
                        <section class="home_cate_child">
                            <div class="cate_child_header">
                                <h3 class="cate_child_title"><?php {{ echo "Thương hiệu ".$brandItem['brand_name']; }} ?> <span>(<?php {{ echo $numProdByBrand; }} ?> sản phẩm)</span></h3>
                            </div>
                            <?php if( !empty($listCateProdLevel2) ) : ?>
                            <div class="cate_child_body">
                                <div class="cate_child_list grid_row">
                                    <?php foreach( $listCateProdLevel2 as $cateProdLevel2_Item ) : ?>
                                    <div class="cate_child_item">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdLevel2_Item['cateProd_seoUrl']}-c{$cateProdLevel2_Item['cateProd_id']}.html") ; }} ?>" class="cate_child_view_link">
                                            <div class="cate_icon">
                                                <img class="img_contain full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($cateProdLevel2_Item['cateProd_image']); }} ?>" alt="<?php {{ echo $cateProdLevel2_Item['cateProd_name']; }} ?>">
                                            </div>
                                            <h3 class="cate_title"><?php {{ echo $cateProdLevel2_Item['cateProd_name']; }} ?></h3>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </section>
                        <?php endif; ?>
                        <?php if( !empty($listProdByBrand) ) : ?>
                        <section class="product_box container_bg_sc">
                            <div class="option_box_wrap grid_row justify_content_between align_items_center">
                                <div class="sort_box_holder d_flex align_items_center">
                                    <strong class="">Lọc theo: </strong>
                                    <ul class="list_sort d_flex">
                                        <li class="sort_item">
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}{$priceUrl}/sort=lastest{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "lastest" ? "active" : ''; }} ?>">Hàng mới</a>
                                        </li>
                                        <li class="sort_item">
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}{$priceUrl}/sort=bestsellers{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "bestsellers" ? "active" : ''; }} ?>">Bán chạy nhất</a>
                                        </li>
                                        <li class="sort_item">
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}{$priceUrl}/sort=priceasc{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "priceasc" ? "active" : ''; }} ?>">Giá tăng dần</a>
                                        </li>
                                        <li class="sort_item">
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$brandUrl}{$priceUrl}/sort=pricedesc{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "pricedesc" ? "active" : ''; }} ?>">Giá giảm dần</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="wrap-list-product-catalog grid_row">
                                <?php foreach($listProdByBrand as $prodItem) : ?>
                                <?php {{ $prodItem['prod_url']  = Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>
                                <?php {{ $prodItem['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}.html"); }} ?>
                                <div class="grid_column_6 grid_column_sm_4 grid_column_lg_3">
                                    <div class="prod_item_wrap">
                                        <?php {{ echo Format::statusProdStock($prodItem['prod_stock_status']); }} ?>
                                        <?php if(!empty($prodItem['flashSale'])) : ?>
                                            <?php if((int) $prodItem['flashSale'][0]['prod_flashsale_price'] < (int) $prodItem['prod_oldPrice']) : ?>
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
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="pagination_wrap"><?php
                            {{
                                if($totalPage > 1) { echo Pagination::getPagination("{$brandUrl}{$priceUrl}{$sortUrl}/page=", $totalPage, $page); }
                            }} ?></div>
                        </section>
                        <?php else: ?>
                            <p class="empty_product_notifi">Không có sản phẩm nào !</p>
                        <?php endif; ?>
                        <?php {{ view("Inc.bannervideo"); }} ?>
                    </div>
                </div>
                <div class="container" style="margin-top: 20px;">
                    <div class="banner_ads">
                        <a href="" class="ads_link_view position_relative">
                            <i class="position_absolute fa fa-times" style="color: #333;top: 1%;right: 1%;width: 20px;height: 20px;text-align: center;line-height: 20px;border-radius: 100%;background-color: #fff;font-size: .9rem;"></i>
                            <div style="height: 400px; background-repeat: no-repeat; background-position: center center; background-size: cover; background-image: url(./public/images/banner/1e7c9965881bac811928396203f061d2.jpg);"></div>
                        </a>
                    </div>
                </div>
            </main>
            <?php else: ?>
                <p>Không tồn tại thương hiệu sản phẩm này !</p>
            <?php endif; ?>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <script class="handle_open_filter" data-type="javascript">
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