<?php
    $cateProd = new CateProductModel;
    $listCateProdHot = $cateProd->getCateProdHot();
?>
<?php if(!empty($listCateProdHot)) : ?>
    <section class="container_sc_item_wrap container">
        <div class="home_recomment container_space category_hot container_bg_sc">
            <div class="container_sc_header">
                <h2 class="sc_header_title">NGÀNH HÀNG QUAN TÂM</h2>
            </div>
            <div class="container_sc_body">
                <div class="recomment_list">
                    <?php foreach($listCateProdHot as $cateProdItem) : ?>
                        <div class="recomment_item carousel-cell">
                            <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}.html"); }} ?>" class="recomment_view_link container_bg_sc d_flex flex_column align_items_center">
                                <span class="thumbNail">
                                    <img src="" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($cateProdItem['cateProd_image']); }} ?>" class="full_size carousel-cell-image" alt="<?php {{ echo $cateProdItem['cateProd_name']; }} ?>">
                                </span>
                                <span class="title"><?php {{ echo $cateProdItem['cateProd_name']; }} ?></span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>