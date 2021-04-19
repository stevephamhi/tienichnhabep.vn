<?php if($listProductByIdCate) : ?>
<section class="product_box container_bg_sc">
    <div class="option_box_wrap grid_row justify_content_between align_items_center">
        <div class="sort_box_holder d_flex align_items_center">
            <strong class="">Lọc theo: </strong>
            <ul class="list_sort d_flex">
                <li class="sort_item">
                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdUrl}{$brandUrl}{$priceUrl}/sort=lastest{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "lastest" ? "active" : ''; }} ?>">Hàng mới</a>
                </li>
                <li class="sort_item">
                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdUrl}{$brandUrl}{$priceUrl}/sort=bestsellers{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "bestsellers" ? "active" : ''; }} ?>">Bán chạy nhất</a>
                </li>
                <li class="sort_item">
                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdUrl}{$brandUrl}{$priceUrl}/sort=priceasc{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "priceasc" ? "active" : ''; }} ?>">Giá tăng dần</a>
                </li>
                <li class="sort_item">
                    <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdUrl}{$brandUrl}{$priceUrl}/sort=pricedesc{$pageUrl}"); }} ?>" class="sort_view_link <?php {{ echo $sort_vl == "pricedesc" ? "active" : ''; }} ?>">Giá giảm dần</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="wrap-list-product-catalog grid_row">
        <?php foreach($listProductByIdCate as $prodItem) : ?>
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
        if($totalPage > 1) { echo Pagination::getPagination("{$cateProdUrl}{$brandUrl}{$priceUrl}{$sortUrl}/page=", $totalPage, $page); }
    }} ?></div>
</section>
<?php else: ?>
    <p class="empty_product_notifi">Không có sản phẩm nào !</p>
<?php endif; ?>