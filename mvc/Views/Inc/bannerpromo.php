<?php
    $banner = new BannerController;
    $listBannerPromoToday = $banner->bannerpromo()['listBannerToday'];
?>
<?php if(!empty($listBannerPromoToday)) : ?>
<section class="promo_banner_container container">
    <div class="home_primary_banner_container __top__ grid_row position_relative">
        <?php foreach($listBannerPromoToday as $bannerItem) : ?>
        <div class="grid_column_3 home_primary_banner_item">
            <a target="<?php {{ echo $bannerItem['banner_target'] == 'blank' ? '_blank' : 'self'; }} ?>" href="<?php {{ echo $bannerItem['banner_link']; }} ?>" class="home_primary_banner_link thumbNail" title="" data-view-index="0">
                <img class="img_cover full_size lazy" title="<?php {{ echo $bannerItem['banner_desc']; }} ?>" data-original="<?php {{ echo Config::getBaseUrlAdmin($bannerItem['banner_imagePc']); }} ?>" alt="<?php {{ echo $bannerItem['banner_name']; }} ?>">
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>