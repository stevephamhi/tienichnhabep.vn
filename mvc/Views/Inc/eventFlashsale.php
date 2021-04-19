<?php
    $flashSale = new FlashsaleController;
    $listFlashsale = $flashSale->getListFlashSaleProduct()['listFalShsale'];
    $moduleFlashsale  = $flashSale->getModuleFlashsaleUrl()['moduleFlashsale'];
?>
<?php if(!empty($listFlashsale)) : ?>
    <section class="container_sc_item_wrap container">
        <div class="home_deal_flash_sale container_bg_sc container_space">
            <div class="container_sc_header position_relative" style="background: none;">
                <div class="sc_header_title">
                    <div class="flash_sale_img_wrap d_flex align_items_center">
                        <img class="full_size __text_img_1 lazy" data-original="<?php {{ echo Config::getBaseUrlClient("public/images/icon/giasoc.svg"); }} ?>" alt="Icon giá sốc tại tiện ích nhà bếp">
                        <img class="full_size __img_img lazy" data-original="<?php {{ echo Config::getBaseUrlClient("public/images/icon/flash.gif"); }} ?>" alt="Icon flash sale tại tiện ích nhà bếp">
                        <img class="full_size __text_img_2 lazy" data-original="<?php {{ echo Config::getBaseUrlClient("public/images/icon/homnay.svg"); }} ?>" alt="Icon giá sốc tại tiện ích nhà bếp">
                    </div>
                </div>
                <?php if(!empty($moduleFlashsale)) : ?>
                    <div class="sc_header_action">
                        <a href="<?php {{ echo Config::getBaseUrlClient(Format::create_slug($moduleFlashsale['module_name']) . "/m" . $moduleFlashsale['module_id'] . "/" . $moduleFlashsale['module_seoUrl'] . ".html#tab=flash-sale"); }} ?>" class="see_more position_absolute">
                            <span>Xem tất cả</span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="container_sc_body flashSale_body">
                <div class="flash_sale_products_slider">
                    <?php foreach($listFlashsale as $flashSaleItem) : ?>
                        <?php {{ $flashSaleItem['prod_url'] = Config::getBaseUrlClient("{$flashSaleItem['prod_seoUrl']}-p{$flashSaleItem['prod_id']}.html"); }} ?>
                        <?php {{ $flashSaleItem['brand_url'] = Config::getBaseUrlClient("".Format::create_slug($flashSaleItem['brand_name'])."-b{$flashSaleItem['brand_id']}.html"); }} ?>
                        <div class="prod_item_wrap carousel-cell">
                            <?php {{ echo Format::statusProdStock($flashSaleItem['prod_stock_status']); }} ?>
                            <?php if((int) $flashSaleItem['prod_flashsale_price'] < (int) $flashSaleItem['prod_oldPrice']) : ?>
                                <div class="prod_discount" style="background: #108fc2;"><?php {{ echo Format::promotionalPercent($flashSaleItem['prod_flashsale_price'], $flashSaleItem['prod_oldPrice']); }} ?></div>
                            <?php endif; ?>
                            <div class="prod_image position_relative">
                                <?php if(!empty($flashSaleItem['prod_discout_content'])) : ?>
                                    <div class="promo_wrap">
                                        <a href="<?php {{ echo $flashSaleItem['prod_url']; }} ?>" class="promo_link">
                                            <i class="icon_gift"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($flashSaleItem['prod_deliveryPromo'])) : ?>
                                    <div class="freeship_sale">
                                        <span><?php {{ echo $flashSaleItem['prod_deliveryPromo']; }} ?></span>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php {{ echo $flashSaleItem['prod_url']; }} ?>" title="<?php {{ echo $flashSaleItem['prod_name']; }} ?>" class="thumbNail">
                                    <img src="" class="carousel-cell-image" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($flashSaleItem['prod_avatar']); }} ?>" srcset="<?php {{ echo Config::getBaseUrlAdmin($flashSaleItem['prod_avatar']); }} ?>" alt="<?php {{ echo $flashSaleItem['prod_name']; }} ?>" width="200" height="200">
                                </a>
                                <?php if($flashSaleItem['prod_installment'] == "1") : ?>
                                    <div class="installment">Trả góp <?php {{ echo $flashSaleItem['prod_installment_rate']."%"; }} ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="prod_info">
                                <div class="prod_info_name">
                                    <a href="<?php {{ echo $flashSaleItem['prod_url']; }} ?>" title="<?php {{ echo $flashSaleItem['prod_name']; }} ?>"><?php {{ echo $flashSaleItem['prod_name']; }} ?></a>
                                </div>
                                <div class="prod_info_brand">
                                    <a href="<?php {{ echo $flashSaleItem['brand_url']; }} ?>" title="<?php {{ echo "Thương hiệu ".$flashSaleItem['brand_name']; }} ?>"><?php {{ echo $flashSaleItem['brand_name']; }} ?></a>
                                </div>
                                <a href="<?php {{ echo $flashSaleItem['prod_url']; }} ?>" class="flash_sale_progress grid_row">
                                    <div class="sold info_item">
                                        <span class="prod_info_price_shop"><?php {{ echo Format::formatCurrency($flashSaleItem['prod_flashsale_price']); }} ?></span>
                                        <span class="prod_info_price_market"><?php {{ echo Format::formatCurrency($flashSaleItem['prod_oldPrice']); }} ?></span>
                                    </div>
                                    <div class="countDown_time info_item d_flex align_items_end">
                                        <span class="label">Kết thúc sau</span>
                                        <div class="value_wrap date_flashSale_wrap" data-startDate="<?php {{ echo $flashSaleItem['prod_flashsale_dateStart']; }} ?>" data-endDate="<?php {{ echo $flashSaleItem['prod_flashsale_dateEnd']; }} ?>" data-flashprice="<?php {{ echo $flashSaleItem['prod_flashsale_price']; }} ?>">
                                            <div>00 ngày 00:00:00</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>