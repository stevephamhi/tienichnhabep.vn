<div class="filter_brands sidebar_box_wrap">
    <div class="sidebar_item_box_header_mobile open_popup_filter d_flex align_items_center">
        <span class="title">Thương hiệu</span>
        <i class="fa" aria-hidden="true"></i>
    </div>
    <div class="sidebar_item_box_header">
        <h4 class="title">THƯƠNG HIỆU</h4>
    </div>
    <div class="mask">
        <a href="" class="close_popup_filter position_absolute">Đóng</a>
    </div>
    <div class="sidebar_item_box_body">
        <div class="filter_body">
            <ul class="list_filter">
                <?php foreach($listBrand as $brandItem) : ?>
                <li class="filter_item">
                    <label for="chk_brand_<?php {{ echo $brandItem['id']; }} ?>" class="chk_filter_item d_flex align_items_center position_relative">
                        <a href="<?php {{ echo Config::getBaseUrlClient("{$liquidationUrl}/brand={$brandItem['name']}-{$brandItem['id']}{$priceUrl}{$sortUrl}"); }} ?>" title="<?php {{ echo $brandItem['name']; }} ?>" class="filter_link">
                            <input type="checkbox" <?php {{
                                echo $brandItem['id'] == $brand_id ? "checked" : null;
                             }} ?> id="chk_brand_<?php {{ echo $brandItem['id']; }} ?>" value="<?php {{ echo $brandItem['id']; }} ?>" class="d_none">
                            <span title="sunhouse" class="filter_chek"></span>
                            <span><?php {{ echo $brandItem['name']; }} ?></span>
                        </a>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
            <a href="<?php {{ echo Config::getBaseUrlClient( "{$liquidationUrl}{$priceUrl}{$sortUrl}" ); }} ?>" class="clearFilter">Làm mới</a>
        </div>
    </div>
</div>