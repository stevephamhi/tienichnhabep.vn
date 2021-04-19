<?php
    $banner = new BannerController;
    $listBannerMainToday = $banner->bannermain()['listBannerToday'];
?>
<?php if(!empty($listBannerMainToday)) : ?>
<div class="banner_main_item_top">
    <?php foreach($listBannerMainToday as $bannerItem) : ?>
    <a target="<?php {{ echo $bannerItem['banner_target'] == 'blank' ? '_blank' : 'self'; }} ?>" href="<?php {{ echo $bannerItem['banner_link']; }} ?>" class="banner_slide_link thumbNail w_100 h_100">
        <img title="<?php {{ echo $bannerItem['banner_desc']; }} ?>" class="full_size carousel-cell-image" data-flickity-lazyload="<?php {{ echo Config::getBaseUrlAdmin($bannerItem['banner_imagePc']); }} ?>" alt="<?php {{ echo $bannerItem['banner_name']; }} ?>">
    </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>