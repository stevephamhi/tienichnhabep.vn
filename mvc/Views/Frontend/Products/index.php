<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) && !empty($prodItem) ) : ?>
        <title><?php {{ echo !empty($prodItem['prod_metaTitle']) ? $prodItem['prod_metaTitle'] : "Trang sản phẩm"; }} ?></title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="<?php {{ echo !empty($prodItem['prod_metaDesc']) ? $prodItem['prod_metaDesc'] : null; }} ?>">
        <meta name="keywords" content="<?php {{ echo !empty($prodItem['prod_keywords']) ? $prodItem['prod_keywords'] : null; }} ?>">
        <meta property="og:title" content="<?php {{ echo !empty($prodItem['prod_metaTitle']) ? $prodItem['prod_metaTitle'] : null; }} ?>">
        <meta property="og:description" content="<?php {{ echo !empty($prodItem['prod_metaDesc']) ? $prodItem['prod_metaDesc'] : null; }} ?>">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>">
        <meta property="og:site_name" content="<?php {{ echo !empty($prodItem['prod_metaTitle']) ? $prodItem['prod_metaTitle'] : null; }} ?>">
        <meta property="og:image" content="<?php {{ echo !empty($prodItem['prod_avatar']) ? Config::getBaseUrlAdmin($prodItem['prod_avatar']) : null; }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo !empty($prodItem['prod_avatar']) ? Config::getBaseUrlAdmin($prodItem['prod_avatar']) : null; }} ?>">
        <meta property="og:keywords" content="<?php {{ echo !empty($prodItem['prod_keywords']) ? $prodItem['prod_keywords'] : null; }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php {{ echo !empty($prodItem['prod_metaTitle']) ? $prodItem['prod_metaTitle'] : null; }} ?>">
        <meta name="twitter:description" content="<?php {{ echo !empty($prodItem['prod_metaDesc']) ? $prodItem['prod_metaDesc'] : null; }} ?>">
        <meta name="twitter:image" content="<?php {{ echo !empty($prodItem['prod_avatar']) ? Config::getBaseUrlAdmin($prodItem['prod_avatar']) : null; }} ?>">
        <meta name="twitter:keywords" content="<?php {{ echo !empty($prodItem['prod_keywords']) ? $prodItem['prod_keywords'] : null; }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/detailProd.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/flickity.min.css"); }} ?>">
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <?php if(!empty($prodItem)) : ?>
            <section class="breadcrum_wrap">
                <div class="container">
                    <ol class="breadcrum_list grid_row align_items_center">
                        <li class="breadcrum_item home d_flex align_items_center">
                            <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="breadcrum_link" title="Về trang chủ">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="breadcrum_item nav3 d_flex align_items_center position_relative">
                            <a href="<?php {{ echo Config::getBaseUrlClient("{$listCateProdTies[0]['cateProd_seoUrl']}-c{$listCateProdTies[0]['cateProd_id']}.html"); }} ?>" class="breadcrum_link" title="<?php {{ echo $listCateProdTies[0]['cateProd_name']; }} ?>">
                                <span><?php {{ echo $listCateProdTies[0]['cateProd_name']; }} ?></span>
                            </a>
                        </li>
                        <li class="breadcrum_item nav4 d_flex align_items_center">
                            <a href="javascript:;" class="breadcrum_link" title="Nồi lẩu điện">
                                <span><?php {{ echo $prodItem['prod_name']; }} ?></span>
                            </a>
                        </li>
                    </ol>
                </div>
            </section>
            <main class="main_sc">
                <section class="view_products_info">
                    <div class="container">
                        <div class="view_product_wrap">
                            <div class="grid_row">
                                <div class="grid_column_12 grid_column_lg_12">
                                    <div class="view_detail_product">
                                        <div class="grid_row">
                                            <div class="view_detail_left grid_column_12 grid_column_md_5 grid_column_lg_4">
                                                <div class="view_images position_relative">
                                                    <?php {{ echo Format::statusProdStock($prodItem['prod_stock_status']); }} ?>
                                                    <?php if($prodItem['prod_installment'] == "1") : ?>
                                                        <div class="installment" style="z-index: 10; font-size: 1rem;">Trả góp <?php {{ echo $prodItem['prod_installment_rate']."%"; }} ?></div>
                                                    <?php endif; ?>
                                                    <div class="carousel carousel-main" data-flickity>
                                                        <?php if(!empty($prodItem['prod_avatar'])) : ?>
                                                        <div class="carousel-cell">
                                                            <div class="img_prod_item thumbNail position_relative">
                                                                <img class="image_zoom image_set_zoom" src="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>">
                                                                <span class="mask_zoom d_block"></span>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if(!empty($listImagesTies)) : ?>
                                                            <?php foreach($listImagesTies as $imageTiesItem) : ?>
                                                            <div class="carousel-cell">
                                                                <div class="img_prod_item thumbNail">
                                                                    <img class="image_zoom image_set_zoom position_relative" src="<?php {{ echo Config::getBaseUrlAdmin($imageTiesItem['prod_listImg_ties_src']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>">
                                                                    <span class="mask_zoom d_block"></span>
                                                                </div>
                                                            </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if( !empty($listImagesTies) ) : ?>
                                                    <div class="prod_slide_btn">
                                                        <div class="grid_row">
                                                            <div class="slide_recomment" style="width: 80%;">
                                                                <div class="carousel carousel-nav" data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
                                                                    <?php if(!empty($prodItem['prod_avatar'])) : ?>
                                                                        <div class="carousel-cell">
                                                                            <div class="img_prod_item thumbNail">
                                                                                <img src="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>">
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php foreach($listImagesTies as $imageTiesItem) : ?>
                                                                        <div class="carousel-cell">
                                                                            <div class="img_prod_item thumbNail">
                                                                                <img src="<?php {{ echo Config::getBaseUrlAdmin($imageTiesItem['prod_listImg_ties_src']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>">
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                            <div class="slide_num" style="width: 20%;">
                                                                <a href="javascript:;" class="w_100 h_100 position_relative">
                                                                    <img class="full_size" src="<?php {{ echo Config::getBaseUrlAdmin($prodItem['prod_avatar']); }} ?>" alt="<?php {{ echo $prodItem['prod_name']; }} ?>">
                                                                    <span class="info position_absolute">Tổng <?php {{ echo count($listImagesTies) + 1; }} ?> ảnh sản phẩm</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif ?>
                                                    <div class="view_more_relative">
                                                        <div class="grid_row justify_content_center w_100">
                                                            <?php if(!empty($listImagesTies)) : ?>
                                                            <?php endif; ?>
                                                            <?php if(!empty($prodItem['prod_video'])) : ?>
                                                            <div class="view_more_item">
                                                                <a href="javascript:;" data-open-modal-video='true' class="pop_gallery d_flex flex_column justify_content_between">
                                                                    <div class="icon_space">
                                                                        <img src="<?php {{  echo Config::getBaseUrlClient("public/images/icon/video_icon.png"); }} ?>" alt="">
                                                                    </div>
                                                                    <div class="text_space">Xem </br> video</div>
                                                                </a>
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if(!empty($prodItem['prod_specifications_content'])) : ?>
                                                            <div class="view_more_item">
                                                                <a href="" data-scroll-to="specifications" class="pop_gallery d_flex flex_column justify_content_between">
                                                                    <div class="icon_space">
                                                                        <img src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/thong-so-icon.png"); }} ?>" alt="">
                                                                    </div>
                                                                    <div class="text_space">Thông số kỹ thuật</div>
                                                                </a>
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if(!empty($prodItem['prod_outstanding_features'])) : ?>
                                                            <div class="view_more_item">
                                                                <a href="" data-scroll-to="outstanding_features" class="pop_gallery d_flex flex_column justify_content_between">
                                                                    <div class="icon_space">
                                                                        <img src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/tinh-nang-logo.png"); }} ?>" alt="">
                                                                    </div>
                                                                    <div class="text_space">Tính năng nổi bật</div>
                                                                </a>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="view_detail_right grid_column_12 grid_column_md_7 grid_column_lg_8">
                                                <div class="grid_row">
                                                    <div class="grid_column_12">
                                                        <div class="view_info">
                                                            <div id="info_product" data-id="<?php {{ echo $prodItem['prod_id']; }} ?>" data-min-amount="<?php {{ echo $prodItem['prod_minimun_amount']; }} ?>" data-max-amount="<?php {{ echo $prodItem['prod_amount']; }} ?>"></div>
                                                            <div class="top_info_wrap">
                                                                <div class="group_title grid_row">
                                                                    <div class="grid_column_12 grid_column_lg_8">
                                                                        <h1 class="title_prod"><?php {{ echo $prodItem['prod_name']; }} ?></h1>
                                                                        <p class="desc_prod"><?php {{ echo $prodItem['prod_desc']; }} ?></p>
                                                                    </div>
                                                                    <div class="grid_column_12 grid_column_lg_4">
                                                                        <a target="_blank" class="share_prod d_flex justify_content_center align_items_center" href="https://www.facebook.com/sharer/sharer.php?u=<?php {{ echo Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>" class="share">
                                                                            <i class="fa fa-share-square" style="margin-right: 3px;" aria-hidden="true"></i>
                                                                            <span>Share fb</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="group_info_rela">
                                                                    <?php if(!empty($listCateProdTies)) : ?>
                                                                    <div class="info_rela_item">
                                                                        <span class="label">Danh mục:</span>
                                                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$listCateProdTies[0]['cateProd_seoUrl']}-c{$listCateProdTies[0]['cateProd_id']}.html"); }} ?>" class="value d_inline_block"><?php {{ echo $listCateProdTies[0]['cateProd_name']; }} ?></a>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <?php if(!empty($prodItem['brand_id'])) : ?>
                                                                    <div class="info_rela_item">
                                                                        <span class="label">Thương hiệu:</span>
                                                                        <a href="<?php {{ echo Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}"); }} ?>" title="<?php {{ echo "Thương hiệu {$prodItem['brand_name']}"; }} ?>" class="value d_inline_block">
                                                                            <span><?php {{ echo $prodItem['brand_name']; }} ?></span>
                                                                            <span>|</span>
                                                                            <span><?php {{ echo $listCateProdTies[0]['cateProd_name'] ." ". $prodItem['brand_name']; }} ?></span>
                                                                        </a>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="bottom_info_wrap">
                                                                <div class="grid_row">
                                                                    <div class="grid_column_12 grid_column_lg_8 pr_0 pr_lg_4">
                                                                        <div class="info_default">
                                                                            <?php if(!empty($flashSaleToday)) : ?>
                                                                            <a href="javascript:;" class="flash_sale_progress grid_row">
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
                                                                                <span class="value"><?php {{ echo Format::formatCurrency($prodItem['prod_currentPrice']); }} ?></span>
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
                                                                                    <div class="discount">
                                                                                        <span><small style='font-size: .9rem;'>Tiếp kiệm</small>: <?php {{ echo Format::promotionalPercent($prodItem['prod_currentPrice'], $prodItem['prod_oldPrice']); }} ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <?php if( $prodItem['prod_for_agents'] == '1' ) : ?>
                                                                            <div class='prod_for_agents' style="background: #f7f7f7; padding: 4px 6px; border-radius: 5px; font-size: .9rem;">
                                                                                <p>Nếu bạn là đại lý LH với chúng tôi:</p>
                                                                                <p class="d_flex align_items_center phone_regis_agents"><i class="fa fa-phone-square" aria-hidden="true"></i><a style="color: #f00;margin-left: 3px;" href='tel:0708070827'>0708 0708 27</a></p>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if(!empty($prodItem['prod_deliveryPromo'])) : ?>
                                                                            <div class="delivery_option"><?php {{ echo $prodItem['prod_deliveryPromo']; }} ?></div>
                                                                        <?php endif; ?>
                                                                        <?php if(!empty($prodItem['prod_intro_content'])) : ?>
                                                                        <div class="info_more">
                                                                            <?php {{ echo $prodItem['prod_intro_content']; }} ?>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                        <div class="info_amout d_flex align_items_center">
                                                                            <div class="choose_amout d_flex align_items_center">
                                                                                <span class="title">Chọn Số Lượng: </span>
                                                                                <div style="margin: 2px 0;" class="amout_wrap d_flex align_items_center">
                                                                                    <button type="button" class="btn_item btn_minus">-</button>
                                                                                    <input type="number" name="amount" disabled id="amount" value="<?php {{ echo $prodItem['prod_minimun_amount']; }} ?>" autocomplete="off" spellcheck="false" min="<?php {{ echo $prodItem['prod_minimun_amount']; }} ?>" max="<?php {{ echo $prodItem['prod_amount']; }} ?>">
                                                                                    <button type="button" class="btn_item btn_plus">+</button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="statusProd d_flex align_items_center">
                                                                                <span class="icon-space">
                                                                                    <img src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/Cart-Y.png"); }} ?>" width="30" height="30" alt="">
                                                                                </span>
                                                                                <?php if($prodItem['prod_amount'] > 0) : ?>
                                                                                <span class="text-space">Còn hàng</span>
                                                                                <?php else: ?>
                                                                                <span class="text-space">Hết hàng</span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <?php if(!empty($prodItem['prod_discout_content'])) : ?>
                                                                        <div class="promotion_wrap">
                                                                            <?php {{ echo $prodItem['prod_discout_content']; }} ?>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                        <div class="button_wrap">
                                                                            <div class="button_top grid_row">
                                                                                <a href="<?php {{ echo Config::getBaseUrlClient("gio-hang.html"); }} ?>" <?php {{
                                                                                    $arrUnAllow = [2,4,5,6];
                                                                                    if( in_array($prodItem['prod_stock_status'], $arrUnAllow) ) {
                                                                                        echo "disabled";
                                                                                    }
                                                                                 }} ?> class="btn payNow d_flex flex_column align_items_center">
                                                                                    <span class="main_title">Mua Ngay</span>
                                                                                    <span class="sub_title">Giao hàng tận nơi hoặc nhận tại siêu thị</span>
                                                                                </a>
                                                                            </div>
                                                                            <div class="button_bottom grid_row justify_content_between">
                                                                                <a href="javascript:;" <?php {{
                                                                                    $arrUnAllow = [2,4,5,6];
                                                                                    if( in_array($prodItem['prod_stock_status'], $arrUnAllow) ) {
                                                                                        echo "disabled";
                                                                                    }
                                                                                 }} ?> class="btn addCart">
                                                                                    <span class="icon">
                                                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                                                    </span>
                                                                                    <span class="main_title">Thêm giỏ hàng</span>
                                                                                </a>
                                                                                <a href="tel:0708070827" class="btn advisory">
                                                                                    <span class="icon">
                                                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                                                    </span>
                                                                                    <span class="main_title">Tư vấn</span>
                                                                                </a>
                                                                            </div>
                                                                            <?php if($prodItem['prod_installment'] == "1") : ?>
                                                                            <div class="button_top grid_row">
                                                                                <a href="javascript:;" class="btn installment_btn d_flex flex_column align_items_center">
                                                                                    <span class="main_title">HƯỚNG DẪN MUA TRẢ GÓP</span>
                                                                                    <span class="sub_title">Xem chi tiết</span>
                                                                                </a>
                                                                            </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid_column_12 grid_column_lg_4">
                                                                        <aside class="view_detail_right">
                                                                            <div class="box_detail care_detail">
                                                                                <?php if(!empty($prodItem['prod_old_content_ties'])) : ?>
                                                                                <div class="old_prod_relative san_pham_cu">
                                                                                    <h3 class="title">Sản phẩm cũ hơn</h3>
                                                                                    <div class="prod_old_view_link">
                                                                                        <?php {{ echo $prodItem['prod_old_content_ties']; }} ?>
                                                                                    </div>
                                                                                </div>
                                                                                <?php endif; ?>
                                                                                <div class="box_detail_body detail_info_wrap">
                                                                                    <div class="care_box_detail">
                                                                                        <?php if( !empty($listProdsp) ) : ?>
                                                                                        <h4 class="box_detail_title d_flex justify_content_between">
                                                                                            <span>Thông tin hữu ích</span>
                                                                                            <span class="close_popup" id="close_modal_info_more">
                                                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                                                            </span>
                                                                                        </h4>
                                                                                        <?php foreach( $listProdsp as $prodspItem ) : ?>
                                                                                        <div class="care_detail_item">
                                                                                            <a href="<?php {{ echo Config::getBaseUrlClient("ho-tro-mua-hang/{$prodspItem['prodsp_seoUrl']}-ip{$prodspItem['prodsp_id']}/prod={$prodItem['prod_id']}"); }} ?>" class="care_view d_flex align_items_center">
                                                                                                <span class="care_icon thumbNail">
                                                                                                    <img width="25" src="<?php {{ echo Config::getBaseUrlAdmin($prodspItem['prodsp_image']); }} ?>" alt="<?php {{ echo $prodspItem['prodsp_name']; }} ?>">
                                                                                                </span>
                                                                                                <span class="txt"><?php {{ echo $prodspItem['prodsp_name']; }} ?></span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <?php endforeach; ?>
                                                                                        <?php endif; ?>
                                                                                        <?php if( !empty($listNewsTutorial) ) : ?>
                                                                                        <div class="care_detail_box blog_huu_ich">
                                                                                            <h3 class="title">Hướng dẫn sử dụng</h3>
                                                                                            <div class="list_blog">
                                                                                                <ul>
                                                                                                    <?php foreach($listNewsTutorial as $newsItem) : ?>
                                                                                                    <li>
                                                                                                        <a target="_blank" href="<?php {{ echo Config::getBaseUrlClient("{$newsItem['news_seoUrl']}-n{$newsItem['news_id']}.html"); }} ?>" class="blog_view_item" title="<?php {{ echo $newsItem['news_name']; }} ?>"><?php {{ echo $newsItem['news_name']; }} ?></a>
                                                                                                    </li>
                                                                                                    <?php endforeach; ?>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </aside>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="view_product_content">
                    <div class="container">
                        <div class="view_product_wrap container_bg_sc">
                            <div class="grid_row">
                                <div class="view_prod_content_left grid_column_12 grid_column_lg_8">
                                    <?php if(!empty($prodItem['prod_content'])) : ?>
                                    <div class="characteristics">
                                        <h4 class="characteristics_header">
                                            <span>MÔ TẢ SẢN PHẨM</span>
                                            <span style='font-size: .8rem; display: block;'><?php {{ echo $prodItem['prod_name']; }} ?></h2>
                                        </h2>
                                    </div>
                                    <?php if($prodItem['prod_content']) : ?>
                                    <div class="boxArticle">
                                        <article class="area_article overflow_hidden" style="height: 500px;">
                                            <?php {{ echo $prodItem['prod_content']; }} ?>
                                        </article>
                                        <div class="show_all d_flex justify_content_center">
                                            <div class="d_flex justify_content_center">
                                                <a href="javascript:;" class="readMore">
                                                    <span>Đọc thêm</span>
                                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <section class="comment_wrap">
                                        <p style="text-align: center; padding: 10px 0;">TÍNH NĂNG BÌNH LUẬN ĐANG ĐƯỢC ĐỘI NGŨ TIỆN ÍCH NHÀ BẾP HOÀN THÀNH</p>
                                        <div class="analysis_comment_wrap">
                                            <h4 class="title_top">ĐÁNH GIÁ VÀ BÌNH LUẬN</h4>
                                            <div class="analysis_wrap justify_content_center grid_row">
                                                <div class="result_rated_box rated_box_left">
                                                    <div class="star_rated" data-filterstar="5">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="txt_rated">
                                                        <span class="txt_1 d_block">Đánh giá trung bình</span>
                                                        <span class="txt_2 d_block">(Có 0 đánh giá)</span>
                                                    </div>
                                                    <div class="medium_score_rated">0.0</div>
                                                </div>
                                                <div class="result_rated_box rated_box_right">
                                                    <div class="row_rate_item d_flex align_items_center">
                                                        <div class="num_star">5</div>
                                                        <div class="star_item">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="process_rate">
                                                            <div class="process-inner"></div>
                                                        </div>
                                                        <div class="quantum_star">
                                                            <span data-filterstar="5">0 đáng giá</span>
                                                        </div>
                                                    </div>
                                                    <div class="row_rate_item d_flex align_items_center">
                                                        <div class="num_star">4</div>
                                                        <div class="star_item">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="process_rate">
                                                            <div class="process-inner"></div>
                                                        </div>
                                                        <div class="quantum_star">
                                                            <span data-filterstar="5">0 đáng giá</span>
                                                        </div>
                                                    </div>
                                                    <div class="row_rate_item d_flex align_items_center">
                                                        <div class="num_star">3</div>
                                                        <div class="star_item">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="process_rate">
                                                            <div class="process-inner"></div>
                                                        </div>
                                                        <div class="quantum_star">
                                                            <span data-filterstar="5">0 đáng giá</span>
                                                        </div>
                                                    </div>
                                                    <div class="row_rate_item d_flex align_items_center">
                                                        <div class="num_star">2</div>
                                                        <div class="star_item">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="process_rate">
                                                            <div class="process-inner"></div>
                                                        </div>
                                                        <div class="quantum_star">
                                                            <span data-filterstar="5">0 đáng giá</span>
                                                        </div>
                                                    </div>
                                                    <div class="row_rate_item d_flex align_items_center">
                                                        <div class="num_star">1</div>
                                                        <div class="star_item">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="process_rate">
                                                            <div class="process-inner"></div>
                                                        </div>
                                                        <div class="quantum_star">
                                                            <span data-filterstar="5">0 đáng giá</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail_comment_wrap">
                                            <div class="share_box_comment" data-scroll-space="comment">
                                                <h4 class="title_top">Chia sẻ nhận xét của bạn</h4>
                                                <form id="rate_form" action="">
                                                    <div class="box_share_comment">
                                                        <div class="comment_star d_flex align_items_center">
                                                            <div class="txt_box_share">Đánh giá của bạn</div>
                                                            <div class="list_star_share">
                                                                <fieldset class="rating_star">
                                                                    <div class="d_flex align_items_center">
                                                                        <div class="rating_star_item" data-id-star="1">
                                                                            <input type="radio" class="rate_point d_none" data-point="1" id="star1" name="rating" value="1">
                                                                            <label for="star1" class="full" title="1 sao: Không thích">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                        </label>
                                                                        </div>
                                                                        <div class="rating_star_item" data-id-star="2">
                                                                            <input type="radio" class="rate_point d_none" data-point="2" id="star2" name="rating" value="2">
                                                                            <label for="star2" class="full" title="2 sao: Tạm được">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                        </label>
                                                                        </div>
                                                                        <div class="rating_star_item" data-id-star="3">
                                                                            <input type="radio" class="rate_point d_none" data-point="3" id="star3" name="rating" value="3">
                                                                            <label for="star3" class="full" title="3 sao: Bình thường">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                        </label>
                                                                        </div>
                                                                        <div class="rating_star_item" data-id-star="4">
                                                                            <input type="radio" class="rate_point d_none" data-point="4" id="star4" name="rating" value="4">
                                                                            <label for="star4" class="full" title="4 sao: Hài lòng">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                        </label>
                                                                        </div>
                                                                        <div class="rating_star_item" data-id-star="5">
                                                                            <input type="radio" class="rate_point d_none" data-point="5" id="star5" name="rating" value="5">
                                                                            <label for="star5" class="full" title="5 sao: Tuyệt vời">
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                        </label>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <p class="desc_highlight">Bạn đang băn khoăn cần tư vấn? Vui lòng để lại số điện thoại hoặc lời nhắn, tienichnhabep.vn sẽ liên hệ trả lời bạn sớm nhất.</p>
                                                        <div class="input_content_comment">
                                                            <div class="comment_content">
                                                                <div class="comment_txt">
                                                                    <textarea name="comment_txt" id="comment_txt" class="d_none"></textarea>
                                                                    <div data-placeholer="Nhập câu hỏi / bình luận / nhận xét tại đây ..." contenteditable="true" spellcheck="false" title="Hãy cho biết nhận xét đánh giá của bạn" class="rc_editer"></div>
                                                                </div>
                                                                <div class="comment_img">
                                                                    <input type="file" name="images_prod_comment" multiple id="images_prod_comment" class="d_none">
                                                                    <label for="images_prod_comment" class="comment_img_icon">
                                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                                        <span>Gửi ảnh</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form_complete_comment" id="popup_comment">
                                                                <div class="form_comment_inner">
                                                                    <div class="form_comment_row grid_row justify_content_between align_items_center">
                                                                        <div class="txt_form_field">
                                                                            <div class="txt_form_item">
                                                                                <input type="text" name="fullname" id="fullname" autocomplete="off" spellcheck="false" title="* Vui lòng nhập tên" placeholder="Nhập tên của bạn">
                                                                            </div>
                                                                        </div>
                                                                        <div class="button_form_field">
                                                                            <button type="submit" class="btn_form_send_comment" id="btn_comment">Gửi đánh giá</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="list-comment">
                                            <div class="title_top filter-comment d_flex align_items_center">
                                                <button type="button" class="filter-item active" title="Danh sách bình luận hay nhất">Bình luận hay nhất</button>
                                                <button type="button" class="filter-item" title="Danh sách bình luận mới nhất">Mới nhất</button>
                                            </div>
                                            <div class="customer-comment_wrap-list"></div>
                                        </div>
                                    </section>
                                </div>
                                <aside class="view_prod_content_right grid_column_12 grid_column_lg_4">
                                    <?php if(!empty($prodItem['prod_specifications_content'])) : ?>
                                    <div class="specifications" data-scroll-space="specifications">
                                        <h4 class="title_top">Thông số kỹ thuật</h4>
                                        <div class="content_bottom">
                                            <?php {{ echo $prodItem['prod_specifications_content']; }} ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($prodItem['prod_outstanding_features'])) : ?>
                                    <div class="specifications outstanding_features" data-scroll-space="outstanding_features">
                                        <h4 class="title_top">Tính năng đặt biệt</h4>
                                        <div class="content_bottom">
                                            <?php {{ echo $prodItem['prod_outstanding_features']; }} ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($listNewsIntro)) : ?>
                                    <div class="newslist">
                                        <h4 class="title_top d_flex align_items_center">
                                            <span>Tin tức về Laptop</span>
                                            <a href="" class="view_more">
                                                <span>Xem</span>
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </a>
                                        </h4>
                                        <div class="content_bottom __custom">
                                            <?php foreach($listNewsIntro as $newsItem) : ?>
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$newsItem['news_seoUrl']}-n{$newsItem['news_id']}.html"); }} ?>" class="newsItem d_flex">
                                                <img src="<?php {{ echo Config::getBaseUrlAdmin($newsItem['news_image']); }} ?>" class="thumbNail_this full_size img_cover" alt="<?php {{ echo $newsItem['news_name']; }} ?>">
                                                <p class="title"><?php {{ echo $newsItem['news_name']; }} ?></p>
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!empty($listProductTies)) : ?>
                                    <div class="accessories">
                                        <h4 class="title_top d_flex align_items_center">
                                            <span>Sản phẩm thường mua kèm</span>
                                            <a href="" class="view_more">
                                                <span>Xem</span>
                                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                            </a>
                                        </h4>
                                        <div class="content_bottom __custom">
                                            <?php foreach($listProductTies as $prodTiesItem) : ?>
                                            <a href="<?php {{ echo Config::getBaseUrlClient("{$prodTiesItem['prod_seoUrl']}-p{$prodTiesItem['prod_id']}.html"); }} ?>" class="accessories_item d_flex flex position_relative">
                                                <img src="<?php {{ echo Config::getBaseUrlAdmin($prodTiesItem['prod_avatar']); }} ?>" class="thumbNail_this full_size img_cover" alt="<?php {{ echo $prodTiesItem['prod_name']; }} ?>" title="<?php {{ echo $prodTiesItem['prod_name']; }} ?>">
                                                <?php {{ echo Format::statusProdStock($prodTiesItem['prod_stock_status']); }} ?>
                                                <div class="info">
                                                    <h4 class="title"><?php {{ echo $prodTiesItem['prod_name']; }} ?></h4>
                                                    <span class="price d_block"><?php {{ echo Format::formatCurrency($prodTiesItem['prod_currentPrice']); }} ?></span>
                                                </div>
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </aside>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
            <?php endif; ?>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
        <div class="modal_popup">
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
            <?php if(!empty($prodItem['prod_video'])) : ?>
            <div class="modal_popup_video">
                <div class="modal_content position_relative">
                    <a href="javascript:;" class="modal_close position_absolute">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <div class="iframe_video_wrap w_100 h_100">
                        <iframe width="100%" height="100%" src="<?php {{ echo $prodItem['prod_video']; }} ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if( $prodItem['prod_installment'] == 1 ) : ?>
                <?php {{ view("Frontend.Products.installment", [
                    "prodItem" => $prodItem
                ]); }} ?>
            <?php endif; ?>
        </div>
    </div>
    <script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/config/slide.js"); }} ?>"></script>
    <script type="text/javascript" src="<?php {{ echo Config::getBaseUrlClient("public/js/config/flickity.min.js"); }} ?>"></script>
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
    <script>
        var modal_video = {
            buttonOpen: document.querySelectorAll("[data-open-modal-video='true']"),
            buttonClose: document.querySelector(".modal_popup .modal_popup_video .modal_close"),
            modelEl: document.querySelector(".modal_popup .modal_popup_video"),
            iframeEl: document.querySelector(".iframe_video_wrap"),
        };
        modal_video["buttonOpen"].forEach((el) => {
            el.addEventListener("click", () => {
                modal_video["modelEl"].style = "display: flex";
                event.preventDefault();
            });
        });
        if(modal_video["buttonClose"] !== null) {
                modal_video["buttonClose"].addEventListener("click", () => {
                modal_video["modelEl"].style = "display: none";
                stopVideo(modal_video["iframeEl"]);
            });
        }
        var stopVideo = function (el) {
            var iframe = el.querySelector("iframe");
            var video = el.querySelector("video");
            if (iframe !== null) {
                var iframeSrc = iframe.src;
                iframe.src = iframeSrc;
            }
            if (video !== null) {
                video.pause();
            }
        };
    </script>
    <script>
        var boxDescribe = { btnOpen: document.querySelector('.view_prod_content_left .boxArticle .show_all .readMore'), boxDescribeEl: document.querySelector('.boxArticle .area_article'), maskEl: document.querySelector('.view_prod_content_left .boxArticle .show_all'),
        }; boxDescribe['btnOpen'].addEventListener('click', () => { boxDescribe['boxDescribeEl'].style = "height: auto"; boxDescribe['maskEl'].style = "display: none"; });
    </script>
    <script>
        let scrollElement = { dataScrollTo: $('[data-scroll-to]'), dataScrollSpace: $('[data-scroll-space]') }; scrollElement['dataScrollTo'].click(function() { event.preventDefault(); let scrollSpaceName = $(this).attr('data-scroll-to'); let scrollSpaceEl =
        $("[data-scroll-space='" + (scrollSpaceName) + "']"); let offsetSpaceEl = scrollSpaceEl.offset().top; $('body, html').animate({ scrollTop: offsetSpaceEl - 60 }, 1000); });
    </script>
    <script>
        let btnOpen = document.querySelectorAll(".view_prod_content_right .title_top .view_more");
        btnOpen.forEach(el => {
            el.addEventListener('click', function() {
                event.preventDefault();
                let popupEl = this.parentElement.parentElement.children[1];
                console.log(popupEl);
                if(popupEl.classList.contains('open')) {
                    popupEl.classList.remove('open');
                    (this.children)[0].innerText = 'Hiện';
                } else {
                    popupEl.classList.add('open');
                    (this.children)[0].innerText = 'Ẩn';
                }
            });
        });
    </script>
    <script>
        let btnPlusEl    = document.querySelector(".btn_plus");
        let btnMinusEl   = document.querySelector(".btn_minus");
        let amoutInputEl = document.querySelector("#amount");
        let minValue     = parseInt(amoutInputEl.getAttribute('min'));
        let maxValue     = parseInt(amoutInputEl.getAttribute('max'));
        let currentValue = parseInt(amoutInputEl.value);
        amoutInputEl.addEventListener('keyup', function() {
            console.log(this);
        });
        btnPlusEl.addEventListener('click', function () {
            if(currentValue < maxValue) {
                currentValue ++;
            } else {
                alert("Số lượng trong chỉ còn "+(maxValue)+" sản phẩm");
            }
            amoutInputEl.value = currentValue;
        });
        btnMinusEl.addEventListener('click', function () {
            if(currentValue > minValue) {
                currentValue --;
            } else {
                alert("Số lượng phải lớn hơn hoặc bằng "+(minValue)+"");
            }
            amoutInputEl.value = currentValue;
        });
    </script>
    <script>
        let tabControlButton = document.querySelectorAll(".installment_intro .tab_control .tab_list li a");
        let tabContentList   = document.querySelectorAll(".installment_intro .tab_content .handbook");
        tabControlButton.forEach(function(el) {
            el.addEventListener("click", function() {
                event.preventDefault();
                let tabContent = this.getAttribute("href");
                tabControlButton.forEach(function(el) {
                    el.parentElement.classList.remove('active');
                });
                this.parentElement.classList.add('active');
                tabContentList.forEach(function(el) {
                    el.classList.remove('active');
                });
                document.querySelector(""+( tabContent )+"").classList.add('active');
            });
        });
        let tabMonthButton  = document.querySelectorAll(".list_months_installment [data-month] a");
        let tabMonthContent = document.querySelectorAll(".table_content_installment");
        tabMonthButton.forEach(function(el) {
            el.addEventListener("click", function() {
                event.preventDefault();
                let tabContent = this.getAttribute("href");
                tabMonthButton.forEach(function(el) {
                    el.parentElement.classList.remove('active');
                });
                this.parentElement.classList.add('active');
                tabMonthContent.forEach(function(el) {
                    el.classList.remove('active');
                });
                document.querySelector(""+(tabContent)+"").classList.add('active');
            });
        });
    </script>
</body>
</html>