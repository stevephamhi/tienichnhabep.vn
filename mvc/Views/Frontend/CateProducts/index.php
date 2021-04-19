<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) && !empty($cateProdItem) ) : ?>
        <title><?php {{ echo !empty($cateProdItem['cateProd_metaTitle']) ? $cateProdItem['cateProd_metaTitle'] : "Danh mục sản phẩm"; }} ?></title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="<?php {{ echo !empty($cateProdItem['cateProd_metaDesc']) ? $cateProdItem['cateProd_metaDesc'] : null; }} ?>">
        <meta name="keywords" content="<?php {{ echo !empty($cateProdItem['cateProd_keyword']) ? $cateProdItem['cateProd_keyword'] : null; }} ?>">
        <meta property="og:title" content="<?php {{ echo !empty($cateProdItem['cateProd_metaTitle']) ? $cateProdItem['cateProd_metaTitle'] : null; }} ?>">
        <meta property="og:description" content="<?php {{ echo !empty($cateProdItem['cateProd_metaDesc']) ? $cateProdItem['cateProd_metaDesc'] : null; }} ?>">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}.html"); }} ?>">
        <meta property="og:site_name" content="<?php {{ echo !empty($cateProdItem['cateProd_metaTitle']) ? $cateProdItem['cateProd_metaTitle'] : null; }} ?>">
        <meta property="og:image" content="<?php {{ echo !empty($cateProdItem['cateProd_bannerMb']) ? Config::getBaseUrlAdmin($cateProdItem['cateProd_bannerMb']) : null; }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo !empty($cateProdItem['cateProd_bannerMb']) ? Config::getBaseUrlAdmin($cateProdItem['cateProd_bannerMb']) : null; }} ?>">
        <meta property="og:keywords" content="<?php {{ echo !empty($cateProdItem['cateProd_keyword']) ? $cateProdItem['cateProd_keyword'] : null; }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php {{ echo !empty($cateProdItem['cateProd_metaTitle']) ? $cateProdItem['cateProd_metaTitle'] : null; }} ?>">
        <meta name="twitter:description" content="<?php {{ echo !empty($cateProdItem['cateProd_metaDesc']) ? $cateProdItem['cateProd_metaDesc'] : null; }} ?>">
        <meta name="twitter:image" content="<?php {{ echo !empty($cateProdItem['cateProd_bannerMb']) ? Config::getBaseUrlAdmin($cateProdItem['cateProd_bannerMb']) : null; }} ?>">
        <meta name="twitter:keywords" content="<?php {{ echo !empty($cateProdItem['cateProd_keyword']) ? $cateProdItem['cateProd_keyword'] : null; }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/home.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/cateProd.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/flickity.min.css"); }} ?>">
</head>

<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <?php if(!empty($cateProdItem)) : ?>
            <section class="breadcrum_wrap">
                <div class="container">
                    <ol class="breadcrum_list grid_row align_items_center">
                        <li class="breadcrum_item home d_flex align_items_center">
                            <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="breadcrum_link" title="Về trang chủ">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        <?php if(!empty($cateProdParentItem)) : ?>
                        <li class="breadcrum_item nav4 d_flex align_items_center">
                            <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdParentItem['cateProd_seoUrl']}-c{$cateProdParentItem['cateProd_id']}.html"); }} ?>" class="breadcrum_link" title="<?php {{ echo $cateProdParentItem['cateProd_name']; }} ?>">
                                <span><?php {{ echo $cateProdParentItem['cateProd_name']; }} ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="breadcrum_item nav3 d_flex align_items_center position_relative">
                            <a href="javascript:;" class="breadcrum_link" title="<?php {{ echo $cateProdItem['cateProd_name']; }} ?>">
                                <span><?php {{ echo $cateProdItem['cateProd_name']; }} ?></span>
                            </a>
                            <?php if(!empty($listCateProdChild)) : ?>
                            <div class="recomment_breadcrum_list position_absolute">
                                <?php foreach($listCateProdChild as $cateProdChildItem) : ?>
                                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdChildItem['cateProd_seoUrl']}-c{$cateProdChildItem['cateProd_id']}.html"); }} ?>" class="recomment_item"><?php {{ echo $cateProdChildItem['cateProd_name']; }} ?></a>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </li>
                    </ol>
                </div>
            </section>
            <main class="main_sc">
                <div class="cate_view_content container grid_row">
                    <aside class="cate_content_sidebar">
                        <div class="category_menu sidebar_box_wrap">
                            <div class="sidebar_item_box_header_mobile open_popup_filter d_flex align_items_center">
                                <span class="title">Loại</span>
                                <i class="fa" aria-hidden="true"></i>
                            </div>
                            <div class="sidebar_item_box_header">
                                <h4 class="title"><?php {{ echo $cateProdItem['cateProd_name']; }} ?></h4>
                            </div>
                            <div class="mask">
                                <a href="" class="close_popup_filter position_absolute">Đóng</a>
                            </div>
                            <div class="sidebar_item_box_body">
                                <?php {{ echo $menuMulticateProd; }} ?>
                            </div>
                        </div>
                        <?php {{
                            if(!empty($listBrand)) {
                                view("Frontend.CateProducts.brandFilter", [
                                    "listBrand"   => $listBrand,
                                    "cateProdUrl" => $cateProdUrl,
                                    "brand_id"    => $brand_id,
                                    "priceUrl"    => $priceUrl,
                                    "sortUrl"     => $sortUrl,
                                ]);
                            }
                        }} ?>
                        <?php {{ view("Frontend.CateProducts.priceFilter", [
                            "brandUrl"    => $brandUrl,
                            "sortUrl"     => $sortUrl,
                            "cateProdUrl" => $cateProdUrl,
                            "priceArr"    => $priceArr,
                            "sortUrl"     => $sortUrl
                        ]); }} ?>
                        <div class="banner_ads">
                            <a href="" class="ads_link_view position_relative">
                                <i class="position_absolute fa fa-times" style="color: #333;top: 1%;right: 1%;width: 20px;height: 20px;text-align: center;line-height: 20px;border-radius: 100%;background-color: #fff;font-size: .9rem;"></i>
                                <div style="height: 400px; background-repeat: no-repeat; background-position: center center; background-size: cover; background-image: url(./public/images/sanphammau/THUMBVIVO-380x215.gif);"></div>
                            </a>
                        </div>
                    </aside>
                    <div class="cate_content_main">
                        <section class="home_cate_slidershow">
                            <!-- START MB SIZE -->
                            <div class="cate_slideshow_wrap mb_size">
                                <div class="cate_slideshow_item carousel-cell" style="height: 160px;">
                                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}.html"); }} ?>" class="cate_slideshow_view_link" title="<?php {{ $cateProdItem['cateProd_name']; }} ?>">
                                        <img src="" class="full_size carousel-cell-image" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($cateProdItem['cateProd_bannerMb']); }} ?>" alt="<?php {{ $cateProdItem['cateProd_name']; }} ?>">
                                    </a>
                                </div>
                                <?php if(!empty($listCateProdChild)) : ?>
                                    <?php foreach($listCateProdChild as $cateProdChildItem) : ?>
                                    <div class="cate_slideshow_item carousel-cell" style="height: 160px;">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdChildItem['cateProd_seoUrl']}-c{$cateProdChildItem['cateProd_id']}.html"); }} ?>" class="cate_slideshow_view_link" title="<?php {{ echo $cateProdChildItem['cateProd_name']; }} ?>">
                                            <img src="" class="full_size carousel-cell-image" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($cateProdChildItem['cateProd_bannerMb']); }} ?>" alt="<?php {{ echo $cateProdChildItem['cateProd_name']; }} ?>">
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!-- END MB SIZE -->
                            <!-- START PC SIZE -->
                            <div class="cate_slideshow_wrap pc_size">
                                <div class="cate_slideshow_item carousel-cell">
                                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}.html"); }} ?>" class="cate_slideshow_view_link" title="<?php {{ echo $cateProdItem['cateProd_name']; }} ?>">
                                        <img src="" class="full_size carousel-cell-image" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($cateProdItem['cateProd_bannerPc']); }} ?>" alt="<?php {{ echo $cateProdItem['cateProd_name']; }} ?>">
                                    </a>
                                </div>
                                <?php if(!empty($listCateProdChild)) : ?>
                                    <?php foreach($listCateProdChild as $cateProdChildItem) : ?>
                                    <div class="cate_slideshow_item carousel-cell">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdChildItem['cateProd_seoUrl']}-c{$cateProdChildItem['cateProd_id']}.html"); }} ?>" class="cate_slideshow_view_link" title="<?php {{ echo $cateProdChildItem['cateProd_name']; }} ?>">
                                            <img src="" class="full_size carousel-cell-image" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($cateProdChildItem['cateProd_bannerPc']); }} ?>" alt="<?php {{ echo $cateProdChildItem['cateProd_name']; }} ?>">
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!-- END PC SIZE -->
                        </section>
                        <?php if(!empty($listCateProdChild)) : ?>
                        <section class="home_cate_child">
                            <div class="cate_child_header">
                                <h3 class="cate_child_title"><?php {{ echo $cateProdItem['cateProd_name']; }} ?> <span>(<?php {{ echo count($listProductByIdCate); }} ?> sản phẩm)</span></h3>
                            </div>
                            <div class="cate_child_body">
                                <div class="cate_child_list grid_row">
                                    <?php foreach($listCateProdChild as $cateProdChildItem) : ?>
                                    <div class="cate_child_item">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdChildItem['cateProd_seoUrl']}-c{$cateProdChildItem['cateProd_id']}.html"); }} ?>" class="cate_child_view_link">
                                            <div class="cate_icon">
                                                <img class="img_contain full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($cateProdChildItem['cateProd_image']); }} ?>" alt="<?php {{ echo $cateProdChildItem['cateProd_name']; }} ?>">
                                            </div>
                                            <h3 class="cate_title"><?php {{ echo $cateProdChildItem['cateProd_name']; }} ?></h3>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                        <?php endif; ?>
                        <?php if($pageCateProd == "main") : ?>
                            <?php {{ view("Frontend.CateProducts.cateProdMain", [ "listCateProdChild" => $listCateProdChild ]); }} ?>
                        <?php else : ?>
                            <?php {{ view("Frontend.CateProducts.cateProdChild", [
                                "listProductByIdCate" => $listProductByIdCate,
                                "cateProdUrl"         => $cateProdUrl,
                                "brandUrl"            => $brandUrl,
                                "priceUrl"            => $priceUrl,
                                "sort_vl"             => $sort_vl,
                                "totalPage"           => $totalPage,
                                "page"                => $page,
                                "sortUrl"             => $sortUrl,
                                "pageUrl"             => $pageUrl
                            ]); }} ?>
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
            <?php else : ?>
                <p>Danh mục sản phẩm này không tồn tại !</p>
            <?php endif; ?>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/config/slide.js"); }} ?>"></script>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/config/flickity.min.js"); }} ?>"></script>
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