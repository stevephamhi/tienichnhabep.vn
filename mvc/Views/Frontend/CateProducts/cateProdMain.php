<?php if(!empty($listCateProdChild)) : ?>
    <?php foreach($listCateProdChild as $cateProdChildItem) : ?>
        <?php if(!empty($cateProdChildItem['listProd'])) : ?>
        <section class="container_sc_item_wrap container">
            <div class="home_product container_bg_sc container_space">
                <div class="container_sc_header d_flex align_items_center justify_content_between">
                    <h2 class="sc_header_title" style="flex: 0 0 40%; max-width: 40%;"><?php {{ echo $cateProdChildItem['cateProd_name']; }} ?></h2>
                    <div class="sc_header_view_recomment_list" style="flex: 0 0 60%; max-width: 60%;">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdChildItem['cateProd_seoUrl']}-c{$cateProdChildItem['cateProd_id']}.html"); }} ?>" class="view_recomment_item">
                            <span>Xem tất cả sản phẩm</span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <?php if(!empty($cateProdChildItem['listProd'])) : ?>
                <div class="container_sc_body">
                    <div class="cateProd_products_slider">
                        <?php foreach($cateProdChildItem['listProd'] as $prodItem) : ?>
                        <?php {{ $prodItem['prod_url']  = Config::getBaseUrlClient("{$prodItem['prod_seoUrl']}-p{$prodItem['prod_id']}.html"); }} ?>
                        <?php {{ $prodItem['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($prodItem['brand_name'])."-b{$prodItem['brand_id']}.html"); }} ?>
                        <div class="prod_item_wrap carousel-cell">
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
<?php else: ?>
    <p class="empty_product_notifi">Không có sản phẩm nào !</p>
<?php endif; ?>