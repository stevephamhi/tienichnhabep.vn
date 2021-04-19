<?php
    $banner = new BannerController;
    $listBannerRightToday = $banner->bannerright()['listBannerToday'];
?>
<?php if(!empty($listBannerRightToday)) : ?>
<div class="banner_main_item right_item grid_row">
    <?php foreach($listBannerRightToday as $bannerItem) : ?>
    <div class="banner_small_item grid_column_6" style="height: 183.333333333px; padding: 3px;">
        <a target="<?php {{ echo $bannerItem['banner_target'] == 'blank' ? '_blank' : 'self'; }} ?>" href="<?php {{ echo $bannerItem['banner_link']; }} ?>" class="banner_small_item_link thumbNail full_size">
            <img class="full_size lazy" title="<?php {{ echo $bannerItem['banner_desc']; }} ?>" data-original="<?php {{ echo Config::getBaseUrlAdmin($bannerItem['banner_imagePc']); }} ?>" alt="<?php {{ echo $bannerItem['banner_name']; }} ?>">
        </a>
    </div>
    <?php endforeach; ?>
</div>
<?php endif ; ?>