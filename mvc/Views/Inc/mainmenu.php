<?php
    $cateProd  = new CateProductModel;
    $parent_id = 0;
?>
<div class="main_navigation_menu position_relative">
    <ul class="navigation_menu_list">
        <?php foreach($cateProd->getAll() as $cateProdItem) : ?>
            <?php if($cateProdItem['cateProd_parentId'] == $parent_id) : ?>
                <?php {{ $cateProdItem['url'] = Config::getBaseUrlClient("{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}.html"); }} ?>
                <li class="menu_item">
                    <a href="<?php {{ echo $cateProdItem['url']; }} ?>" class="MenuItem_MenuLink d_flex align_items_center position_relative">
                        <span class="icon_wp" style="display: block; background-image: url(<?php {{ echo Config::getBaseUrlAdmin($cateProdItem['cateProd_image']); }} ?>); object-fit: contain; background-size: contain; background-position: center center; width: 25px; height: 25px; margin-right: 10px;"></span>
                        <span class="text"><?php {{ echo $cateProdItem['cateProd_name']; }} ?></span>
                        <?php if($cateProd->checkListCateProdChildExistsByCateProdId($cateProdItem['cateProd_id'])) : ?>
                            <i class="fa fa-caret-right icon_menu" aria-hidden="true"></i>
                        <?php endif; ?>
                    </a>
                    <?php if($cateProd->checkListCateProdChildExistsByCateProdId($cateProdItem['cateProd_id'])) : ?>
                        <div class="submenu_wrap position_absolute">
                            <ul class="list_submenu">
                                <?php foreach($cateProd->getAll() as $cateProdItem_2) : ?>
                                    <?php {{ $cateProdItem_2['url'] = Config::getBaseUrlClient("{$cateProdItem_2['cateProd_seoUrl']}-c{$cateProdItem_2['cateProd_id']}.html"); }} ?>
                                    <?php if($cateProdItem_2['cateProd_parentId'] == $cateProdItem['cateProd_id']) : ?>
                                        <li class="submenuBox_item">
                                            <a href="<?php {{ echo $cateProdItem_2['url']; }} ?>" class="MenuItem_MenuLink navlink2"><?php {{ echo $cateProdItem_2['cateProd_name']; }} ?></a>
                                            <?php if($cateProd->checkListCateProdChildExistsByCateProdId($cateProdItem_2['cateProd_id'])) : ?>
                                                <ul class="submenu_children">
                                                    <?php foreach($cateProd->getAll() as $cateProdItem_3) : ?>
                                                        <?php {{ $cateProdItem_3['url'] = Config::getBaseUrlClient("{$cateProdItem_3['cateProd_seoUrl']}-c{$cateProdItem_3['cateProd_id']}.html"); }} ?>
                                                        <?php if($cateProdItem_3['cateProd_parentId'] == $cateProdItem_2['cateProd_id']) : ?>
                                                            <li class="submenuBox_item">
                                                                <a href="<?php {{ echo $cateProdItem_3['url']; }} ?>" class="MenuItem_MenuLink navlink3"><?php {{ echo $cateProdItem_3['cateProd_name']; }} ?></a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
