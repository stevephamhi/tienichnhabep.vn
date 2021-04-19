<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title><?php {{ echo !empty($configInfo['config_metaTitle']) ? $configInfo['config_metaTitle'] : "Trang chủ"; }} ?></title>
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
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/home.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/flickity.min.css"); }} ?>">
    <style>
       .middle_full_container .menu_button{pointer-events:none!important}@media screen and (min-width:320px){.list_menu_control.middle_full_container.sticky .menu_button{pointer-events:none!important}.list_menu_control.middle_full_container.sticky .menu_button_custom:hover .main_navigation_menu{display:none!important}}@media screen and (min-width:1280px){.list_menu_control.middle_full_container.sticky .menu_button{pointer-events:auto!important}.list_menu_control.middle_full_container.sticky .menu_button_custom:hover .main_navigation_menu{display:block!important}}.middle_full_container .main_navigation_menu{display:none!important}
    </style>
</head>
<body>
    <?php if(!empty($listBackgroundEventHome)) : ?>
        <?php foreach($listBackgroundEventHome as $backgroundEventHomeItem) : ?>
            <div style="position:fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: -1;">
                <img id="bg_event_home" src="<?php {{ echo Config::getBaseUrlAdmin($backgroundEventHomeItem['background_image']); }} ?>"/>
            </div>
        <?php endforeach; ?>
        <style>@media screen and (min-width:320px){#bg_event_home{background-size:cover;width:auto;height:auto}}@media screen and (min-width:1280px){#bg_event_home{background-size:initial;width:100%;height:100%}}</style>
    <?php endif; ?>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
                <section class="container_banner container">
                    <div class="grid_row">
                        <?php {{ view("Inc.mainmenu"); }} ?>
                        <?php {{ view("Inc.bannerhome"); }} ?>
                    </div>
                </section>
                <?php {{ view("Inc.bannerpromo"); }} ?>
                <?php {{ view("Inc.cateprodmenu"); }} ?>
                <?php {{ view("Inc.eventFlashsale"); }} ?>
                <?php if(!empty($listDisplayHome)) : ?>
                    <?php foreach($listDisplayHome as $displayItem) : ?>
                        <?php if($displayItem['display_type'] == "normal") : ?>
                            <?php
                                $breckPoint      = 3;
                                $templateItem    = [];
                                $listDataDisplay = [];
                                $temp            = 0;
                                if( count($displayItem['listProdHighlight']) >= 1 ) {
                                    foreach($displayItem['listProdHighlight'] as $prodHighlightItem) {
                                        $templateItem['prodHighlight'] = $prodHighlightItem;
                                        for($i=$breckPoint-3 ; $i<$breckPoint; $i++) {
                                            if(!empty($displayItem['listProdNormal'][$i])) {
                                                $templateItem['prodNormal'][] = $displayItem['listProdNormal'][$i];
                                            }
                                        }
                                        $breckPoint += 3;
                                        if(!empty($displayItem['listProdMobile'][$temp])) {
                                            $templateItem['prodMobile'] = $displayItem['listProdMobile'][$temp];
                                            $temp++;
                                        }
                                        $listDataDisplay[] = $templateItem;
                                        unset($templateItem);
                                    }
                                }
                            ?>
                            <section class="container_sc_item_wrap container">
                                <div class="home_product container_bg_sc container_space">
                                    <div class="container_sc_header d_flex align_items_center justify_content_between">
                                        <h2 class="sc_header_title"><?php {{ echo $displayItem['display_title']; }} ?></h2>
                                        <div class="sc_header_view_recomment_list">
                                            <?php if(!empty($displayItem['listCateProdRela'])) : ?>
                                                <?php foreach($displayItem['listCateProdRela'] as $cateProdRelaItem) : ?>
                                                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdRelaItem['cateProd_seoUrl']}-c{$cateProdRelaItem['cateProd_id']}.html"); }} ?>" class="view_recomment_item">
                                                        <span><?php {{ echo $cateProdRelaItem['cateProd_name']; }} ?></span>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php if(!empty($displayItem['cateProdMain'])) : ?>
                                                <a class="view_recomment_item" style='flex-direction: row;' href="<?php {{ echo Config::getBaseUrlClient("{$displayItem['cateProdMain']['cateProd_seoUrl']}-c{$displayItem['cateProdMain']['cateProd_id']}.html"); }} ?>" class="view_recomment_item">
                                                    <span>Xem tất cả</span>
                                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="container_sc_body">
                                        <div class="container_prod_list grid_row">
                                            <?php if(!empty($listDataDisplay)) : ?>
                                                <?php foreach($listDataDisplay as $dataDisplayItem) : ?>
                                                    <?php if(!empty($dataDisplayItem['prodHighlight'])) : ?>
                                                        <?php {{ $dataDisplayItem['prodHighlight']['prod_url']  = Config::getBaseUrlClient("{$dataDisplayItem['prodHighlight']['prod_seoUrl']}-p{$dataDisplayItem['prodHighlight']['prod_id']}.html"); }} ?>
                                                        <?php {{ $dataDisplayItem['prodHighlight']['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($dataDisplayItem['prodHighlight']['brand_name'])."-b{$dataDisplayItem['prodHighlight']['brand_id']}.html"); }} ?>
                                                        <div class="container_prod_item prod_item_wrap item" data-view-type="highlight">
                                                            <?php {{ echo Format::statusProdStock($dataDisplayItem['prodHighlight']['prod_stock_status']); }} ?>
                                                            <?php if(!empty($dataDisplayItem['prodHighlight']['flashSale'])) : ?>
                                                            <?php if((int) $dataDisplayItem['prodHighlight']['flashSale'][0]['prod_flashsale_price'] < (int) $dataDisplayItem['prodHighlight']['prod_currentPrice']) : ?>
                                                                <div class="prod_discount" style="background: var(--main-color);"><?php {{ echo Format::promotionalPercent($dataDisplayItem['prodHighlight']['flashSale'][0]['prod_flashsale_price'], $dataDisplayItem['prodHighlight']['prod_oldPrice']); }} ?></div>
                                                            <?php endif; ?>
                                                            <?php else : ?>
                                                                <?php if((int) $dataDisplayItem['prodHighlight']['prod_currentPrice'] < (int) $dataDisplayItem['prodHighlight']['prod_oldPrice']) : ?>
                                                                    <div class="prod_discount"><?php {{ echo Format::promotionalPercent($dataDisplayItem['prodHighlight']['prod_currentPrice'], $dataDisplayItem['prodHighlight']['prod_oldPrice']); }} ?></div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <div class="prod_image position_relative">
                                                                <?php if(!empty($dataDisplayItem['prodHighlight']['prod_discout_content'])) : ?>
                                                                    <div class="promo_wrap">
                                                                        <a href="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_url']; }} ?>" class="promo_link">
                                                                            <i class="icon_gift"></i>
                                                                        </a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if($dataDisplayItem['prodHighlight']['prod_installment'] == "1") : ?>
                                                                    <div class="installment">Trả góp <?php {{ echo $dataDisplayItem['prodHighlight']['prod_installment_rate']."%"; }} ?></div>
                                                                <?php endif; ?>
                                                                <a href="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_url']; }} ?>" title="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_name']; }} ?>" class="thumbNail">
                                                                    <?php if( !empty($dataDisplayItem['prodHighlight']['prod_banner']) ) : ?>
                                                                        <img class="img_cover full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodHighlight']['prod_banner']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodHighlight']['prod_banner']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodHighlight']['prod_banner']); }} ?>" alt="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_name']; }} ?>">
                                                                    <?php else : ?>
                                                                        <img class="img_cover full_size lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodHighlight']['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodHighlight']['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodHighlight']['prod_avatar']); }} ?>" alt="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_avatar']; }} ?>">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <?php if(!empty($dataDisplayItem['prodHighlight']['prod_deliveryPromo'])) : ?>
                                                                <div class="freeship_sale">
                                                                    <span><?php {{ echo $dataDisplayItem['prodHighlight']['prod_deliveryPromo']; }} ?></span>
                                                                </div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="prod_info">
                                                                <div class="prod_info_name">
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_url']; }} ?>" title="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_name']; }} ?>"><?php {{ echo $dataDisplayItem['prodHighlight']['prod_name']; }} ?></a>
                                                                </div>
                                                                <div class="prod_info_brand">
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodHighlight']['brand_url']; }} ?>" title="<?php {{ echo "Thương hiệu {$dataDisplayItem['prodHighlight']['brand_name']}"; }} ?>"><?php {{ echo $dataDisplayItem['prodHighlight']['brand_name']; }} ?></a>
                                                                </div>
                                                                <?php if(!empty($dataDisplayItem['prodHighlight']['flashSale'])) : ?>
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_url']; }} ?>" class="flash_sale_progress grid_row">
                                                                        <div class="sold info_item">
                                                                            <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodHighlight']['flashSale'][0]['prod_flashsale_price']); }} ?></span>
                                                                            <span class="prod_info_price_market"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodHighlight']['prod_oldPrice']); }} ?></span>
                                                                        </div>
                                                                        <div class="countDown_time info_item d_flex align_items_end">
                                                                            <span class="label">Kết thúc sau</span>
                                                                            <div class="value_wrap date_flashSale_wrap" data-startDate="<?php {{ echo $dataDisplayItem['prodHighlight']['flashSale'][0]['prod_flashsale_dateStart']; }} ?>" data-endDate="<?php {{ echo $dataDisplayItem['prodHighlight']['flashSale'][0]['prod_flashsale_dateEnd']; }} ?>" data-flashprice="<?php {{ echo $dataDisplayItem['prodHighlight']['flashSale'][0]['prod_flashsale_price']; }} ?>">
                                                                                <div>00 ngày 00:00:00</div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_url']; }} ?>" class="grid_row">
                                                                        <div class="prod_info_price grid_column_6">
                                                                            <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodHighlight']['prod_currentPrice']); }} ?></span>
                                                                            <span class="prod_info_price_market"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodHighlight']['prod_oldPrice']); }} ?></span>
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
                                                    <?php endif; ?>
                                                    <?php if(!empty($dataDisplayItem['prodNormal'])) : ?>
                                                        <?php foreach($dataDisplayItem['prodNormal'] as $prodItem) : ?>
                                                            <?php {{ $prodItem['prod_url']  = Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>
                                                            <?php {{ $prodItem['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}.html"); }} ?>
                                                            <div class="container_prod_item prod_item_wrap item" data-view-index="0" data-view-type="normal">
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
                                                                    <?php if($prodItem['prod_installment'] == "1") : ?>
                                                                        <div class="installment">Trả góp <?php {{ echo $prodItem['prod_installment_rate']."%"; }} ?> </div>
                                                                    <?php endif; ?>
                                                                    <a href="<?php {{ echo $prodItem['prod_url']; }} ?>" title="<?php {{ echo $prodItem['prod_name']; }} ?>" class="thumbNail">
                                                                        <img class="lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>" width="200" height="200">
                                                                    </a>
                                                                    <?php if(!empty($prodItem['prod_deliveryPromo'])) : ?>
                                                                        <div class="freeship_sale">
                                                                            <span><?php {{ echo $prodItem['prod_deliveryPromo']; }} ?></span>
                                                                        </div>
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
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <?php if(!empty($dataDisplayItem['prodMobile'])) : ?>
                                                        <?php {{ $dataDisplayItem['prodMobile']['prod_url']  = Config::getBaseUrlClient("{$dataDisplayItem['prodMobile']['prod_seoUrl']}-p{$dataDisplayItem['prodMobile']['prod_id']}.html"); }} ?>
                                                        <?php {{ $dataDisplayItem['prodMobile']['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($dataDisplayItem['prodMobile']['brand_name'])."-b{$dataDisplayItem['prodMobile']['brand_id']}.html"); }} ?>
                                                        <div class="container_prod_item prod_item_wrap item mobile" data-view-type="normal">
                                                            <?php {{ echo Format::statusProdStock($dataDisplayItem['prodMobile']['prod_stock_status']); }} ?>
                                                            <?php if(!empty($dataDisplayItem['prodMobile']['flashSale'])) : ?>
                                                            <?php if((int) $dataDisplayItem['prodMobile']['flashSale'][0]['prod_flashsale_price'] < (int) $dataDisplayItem['prodMobile']['prod_currentPrice']) : ?>
                                                                <div class="prod_discount" style="background: var(--main-color);"><?php {{ echo Format::promotionalPercent($dataDisplayItem['prodMobile']['flashSale'][0]['prod_flashsale_price'], $dataDisplayItem['prodMobile']['prod_oldPrice']); }} ?></div>
                                                            <?php endif; ?>
                                                            <?php else : ?>
                                                                <?php if((int) $dataDisplayItem['prodMobile']['prod_currentPrice'] < (int) $dataDisplayItem['prodMobile']['prod_oldPrice']) : ?>
                                                                    <div class="prod_discount"><?php {{ echo Format::promotionalPercent($dataDisplayItem['prodMobile']['prod_currentPrice'], $dataDisplayItem['prodMobile']['prod_oldPrice']); }} ?></div>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <div class="prod_image position_relative">
                                                                <?php if(!empty($dataDisplayItem['prodMobile']['prod_discout_content'])) : ?>
                                                                    <div class="promo_wrap">
                                                                        <a href="<?php {{ echo $dataDisplayItem['prodMobile']['prod_url']; }} ?>" class="promo_link">
                                                                            <i class="icon_gift"></i>
                                                                        </a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if(!empty($dataDisplayItem['prodMobile']['prod_deliveryPromo'])) : ?>
                                                                    <div class="freeship_sale">
                                                                        <span><?php {{ echo $dataDisplayItem['prodMobile']['prod_deliveryPromo']; }} ?></span>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <a href="<?php {{ echo $dataDisplayItem['prodMobile']['prod_url']; }} ?>" title="<?php {{ echo $dataDisplayItem['prodMobile']['prod_name']; }} ?>" class="thumbNail">
                                                                    <img class="lazy" data-original="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodMobile']['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodMobile']['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($dataDisplayItem['prodHighlight']['prod_avatar']); }} ?>" class="img_cover full_size" alt="<?php {{ echo $dataDisplayItem['prodHighlight']['prod_name']; }} ?>">
                                                                </a>
                                                                <?php if($dataDisplayItem['prodMobile']['prod_installment'] == "1") : ?>
                                                                    <div class="installment">Trả góp <?php {{ echo $dataDisplayItem['prodMobile']['prod_installment_rate']; }} ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="prod_info">
                                                                <div class="prod_info_name">
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodMobile']['prod_url']; }} ?>" title="<?php {{ echo $dataDisplayItem['prodMobile']['prod_name']; }} ?>"><?php {{ echo $dataDisplayItem['prodMobile']['prod_name']; }} ?></a>
                                                                </div>
                                                                <div class="prod_info_brand">
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodMobile']['brand_url']; }} ?>" title="<?php {{ echo "Thương hiệu {$dataDisplayItem['prodMobile']['brand_name']}"; }} ?>"><?php {{ echo $dataDisplayItem['prodMobile']['brand_name']; }} ?></a>
                                                                </div>
                                                                <?php if(!empty($dataDisplayItem['prodMobile']['flashSale'])) : ?>
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodMobile']['prod_url']; }} ?>" class="flash_sale_progress grid_row">
                                                                        <div class="sold info_item">
                                                                            <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodMobile']['flashSale'][0]['prod_flashsale_price']); }} ?></span>
                                                                            <span class="prod_info_price_market"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodMobile']['prod_oldPrice']); }} ?></span>
                                                                        </div>
                                                                        <div class="countDown_time info_item d_flex align_items_end">
                                                                            <span class="label">Kết thúc sau</span>
                                                                            <div class="value_wrap date_flashSale_wrap" data-startDate="<?php {{ echo $dataDisplayItem['prodMobile']['flashSale'][0]['prod_flashsale_dateStart']; }} ?>" data-endDate="<?php {{ echo $dataDisplayItem['prodMobile']['flashSale'][0]['prod_flashsale_dateEnd']; }} ?>" data-flashprice="<?php {{ echo $dataDisplayItem['prodMobile']['flashSale'][0]['prod_flashsale_price']; }} ?>">
                                                                                <div>00 ngày 00:00:00</div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a href="<?php {{ echo $dataDisplayItem['prodMobile']['prod_url']; }} ?>" class="grid_row">
                                                                        <div class="prod_info_price grid_column_6">
                                                                            <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodMobile']['prod_currentPrice']); }} ?></span>
                                                                            <span class="prod_info_price_market"><?php {{ echo Format::formatCurrency($dataDisplayItem['prodMobile']['prod_oldPrice']); }} ?></span>
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
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if(!empty($displayItem['cateProdMain'])) : ?>
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$displayItem['cateProdMain']['cateProd_seoUrl']}-c{$displayItem['cateProdMain']['cateProd_id']}.html"); }} ?>" class="show_more_prod">Xem tất cả sản phẩm</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>
                        <?php if($displayItem['display_type'] == "carousel") : ?>
                            <section class="container_sc_item_wrap container">
                                <div class="home_product container_bg_sc container_space">
                                    <div class="container_sc_header d_flex align_items_center justify_content_between">
                                        <h2 class="sc_header_title"><?php {{ echo $displayItem['display_title']; }} ?></h2>
                                        <div class="sc_header_view_recomment_list">
                                            <?php if(!empty($displayItem['listCateProdRela'])) : ?>
                                                <?php foreach($displayItem['listCateProdRela'] as $cateProdRelaItem) : ?>
                                                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdRelaItem['cateProd_seoUrl']}-c{$cateProdRelaItem['cateProd_id']}.html"); }} ?>" class="view_recomment_item">
                                                        <span class="item"><?php {{ echo $cateProdRelaItem['cateProd_name']; }} ?></span>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php if(!empty($displayItem['cateProdMain'])) : ?>
                                                <a href="<?php {{ echo Config::getBaseUrlClient("{$displayItem['cateProdMain']['cateProd_seoUrl']}-c{$displayItem['cateProdMain']['cateProd_id']}.html"); }} ?>" class="view_recomment_item">
                                                    <span>Xem tất cả</span>
                                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php if(!empty($displayItem['listProdNormal'])) : ?>
                                        <div class="container_sc_body">
                                            <div class="flash_sale_products_slider">
                                                <?php foreach($displayItem['listProdNormal'] as $prodItem) : ?>
                                                    <?php {{ $prodItem['prod_url']  = Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>
                                                    <?php {{ $prodItem['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}.html"); }} ?>
                                                    <div class="prod_item_wrap carousel-cell">
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
                                                                <img src="" class="carousel-cell-image" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>" width="200" height="200">
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
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php {{ view("Frontend.Homes.recentlyViewedProducts"); }} ?>
                <?php {{ view("Inc.categoryhot"); }} ?>
                <?php {{ view("Inc.bannervideo"); }} ?>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/config/slide.js"); }} ?>"></script>
    <script src="<?php {{ echo Config::getBaseUrlClient("public/js/config/flickity.min.js"); }} ?>"></script>
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