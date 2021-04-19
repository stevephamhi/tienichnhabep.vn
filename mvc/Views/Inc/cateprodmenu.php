<?php
    $cateProd  = new CateProductModel;
    $listCate  = $cateProd->getByParentId(0);
?>
<?php if(!empty($listCate)) : ?>
<section class="cate_list_mobile container">
    <div class="home_mobile_cate_wrap">
        <div class="home_mobile_scroll_fullWidth d_flex">
            <?php foreach($listCate as $cateItem) : ?>
            <div class="home_mobile_cate_item">
                <a href="<?php {{ echo Config::getBaseUrlClient("{$cateItem['cateProd_seoUrl']}-c{$cateItem['cateProd_id']}.html"); }} ?>" class="home_mobile_cate_link">
                    <img class="icon img_cover radius_circle" width="50" height="50" src="<?php {{ echo Config::getBaseUrlAdmin($cateItem['cateProd_image']); }} ?>" alt="<?php {{ echo $cateItem['cateProd_name']; }} ?>">
                    <span class="title"><?php {{ echo $cateItem['cateProd_name']; }} ?></span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>