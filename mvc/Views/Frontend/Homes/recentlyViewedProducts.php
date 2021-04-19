<?php
    $listProd_recently_viewedResult = !empty(Cookie::get("prod_recently_viewed")) ? json_decode(Cookie::get("prod_recently_viewed"), true) : [];
    $listProd_recently_viewed = [];

    foreach ( $listProd_recently_viewedResult as $resultItem ) {
        $listProd_recently_viewed[] = $resultItem;
    }

    $temp = [];

    for ( $i = 0 ; $i < count($listProd_recently_viewed) - 1 ; $i++ ) {
        for( $j = $i + 1 ; $j < count($listProd_recently_viewed) ; $j ++ ) {
            if ( $listProd_recently_viewed[$i]['timeViewed'] < $listProd_recently_viewed[$j]['timeViewed'] ) {
                $temp                         = $listProd_recently_viewed[$i];
                $listProd_recently_viewed[$i] = $listProd_recently_viewed[$j];
                $listProd_recently_viewed[$j] = $temp;
            }
        }
    }
?>
<?php if(!empty($listProd_recently_viewed)) : ?>
    <section class="container_sc_item_wrap container prod_recently_viewed">
        <div class="home_product container_bg_sc container_space">
            <div class="container_sc_header d_flex align_items_center justify_content_between">
                <h2 class="sc_header_title">SẢN PHẨM BẠN VỪA XEM</h2>
            </div>
            <?php if(!empty($listProd_recently_viewed)) : ?>
                <div class="container_sc_body">
                    <div class="flash_sale_products_slider">
                        <?php foreach($listProd_recently_viewed as $prodItem) : ?>
                            <?php {{ $prodItem['prod_url']  = Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>
                            <?php {{ $prodItem['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}.html"); }} ?>
                            <div class="prod_item_wrap carousel-cell">
                                <?php {{ echo Format::statusProdStock($prodItem['prod_stock_status']); }} ?>
                                <?php if((int) $prodItem['prod_price'] < (int) $prodItem['prod_oldPrice']) : ?>
                                    <div class="prod_discount"><?php {{ echo Format::promotionalPercent($prodItem['prod_price'], $prodItem['prod_oldPrice']); }} ?></div>
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
                                    <a href="<?php {{ echo $prodItem['prod_url']; }} ?>" class="grid_row">
                                        <div class="prod_info_price grid_column_6">
                                            <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($prodItem['prod_price']); }} ?></span>
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
                                </div>
                                <div class="prod_button d_flex justify_content_center">
                                    <a href="<?php {{ echo Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html?act=pay"); }} ?>" class="payNow_btn">MUA NGAY</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
<style>
.prod_recently_viewed .prod_item_wrap .prod_button {
    position: absolute;
    bottom: 3%;
    left: 50%;
    -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
            transform: translateX(-50%);
    width: 100%;
}

.prod_recently_viewed .prod_item_wrap {
    height: 320px;
}

.prod_recently_viewed .prod_item_wrap .prod_button .payNow_btn {
    margin-top: 5px;
    display: block;
    background: #0a76a2;
    color: #fff;
    padding: 5px 15px;
    font-family: 'tienitnhabep-mainFont-Bold';
    border-radius: 3px;
}
</style>