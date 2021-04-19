<?php
    $banner = new BannerController;
    $listBannerBottomToday = $banner->bannerbottom()['listBannerToday'];
?>
<?php if(!empty($listBannerBottomToday)) : ?>
<div class="banner_main_item_bottom grid_row">
    <?php foreach($listBannerBottomToday as $bannerItem) : ?>
    <div class="grid_column_6 banner_small_item" style="height: auto; padding-top: 3px;">
        <a target="<?php {{ echo $bannerItem['banner_target'] == 'blank' ? '_blank' : 'self'; }} ?>" href="<?php {{ echo $bannerItem['banner_link']; }} ?>" class="banner_small_item_link thumbNail full_size">
            <img class="img_cover full_size lazy" title="<?php {{ echo $bannerItem['banner_desc']; }} ?>" data-original="<?php {{ echo Config::getBaseUrlAdmin($bannerItem['banner_imagePc']); }} ?>" alt="<?php {{ echo $bannerItem['banner_name']; }} ?>">
        </a>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>