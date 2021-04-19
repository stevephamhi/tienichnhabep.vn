<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlClient("public/images/icon/logo_mini.png"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/menuCateProd_mobile.css"); }} ?>">
    <title>Danh mục sản phẩm</title>
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
                <div class="menuCateProd_mobile">
                    <div class="grid_row">
                        <?php if(!empty($listCateProdHot)) : ?>
                        <div class="recomment_cateProd_hot grid_column_3">
                            <div class="recomment_list">
                                <ul>
                                    <li>
                                        <div class="recomment_cateProd_item icon_header">
                                            <span class="img_icon">
                                                <data-originalclass="full_size lazy" data-original="<?php {{ echo Config::getBaseUrlClient("public/images/icon/cateProd_hot_icon.png"); }} ?>" alt="Danh mục hot">
                                            </span>
                                            <span class="text">Danh mục hot</span>
                                        </div>
                                    </li>
                                    <?php foreach($listCateProdHot as $cateProdHotItem) : ?>
                                    <li>
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdHotItem['cateProd_seoUrl']}-c{$cateProdHotItem['cateProd_id']}.html"); }} ?>" class="recomment_cateProd_item">
                                            <span class="img_icon">
                                                <img class="full_size lazy" src="<?php {{ echo Config::getBaseUrlAdmin($cateProdHotItem['cateProd_image']); }} ?>" alt="<?php {{ echo $cateProdHotItem['cateProd_name']; }} ?>">
                                            </span>
                                            <span class="text"><?php {{ echo $cateProdHotItem['cateProd_name']; }} ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if( !empty($listCateProd) ) : ?>
                        <div class="listCateProd_menu grid_column_9">
                            <div class="listCateProd_menu_wrap">
                                <span class="cateProd_menu_title">Danh mục sản phẩm</span>
                                <ul class="grid_row">
                                    <?php foreach($listCateProd as $cateProdItem) : ?>
                                    <li class="grid_column_4">
                                        <a href="<?php {{ echo Config::getBaseUrlClient("{$cateProdItem['cateProd_seoUrl']}-c{$cateProdItem['cateProd_id']}.html"); }} ?>" class="cateProd_menu_item">
                                            <span class="img_icon">
                                                <img class="full_size lazy" src="<?php {{ echo Config::getBaseUrlAdmin($cateProdItem['cateProd_image']); }} ?>" alt="<?php {{ echo $cateProdItem['cateProd_name']; }} ?>">
                                            </span>
                                            <span class="text"><?php {{ echo $cateProdItem['cateProd_name']; }} ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
            <?php {{ view("Frontend.Users.menu", ['tab' => 'cate']); }} ?>
        </div>
    </div>
    <style>
        .middle_full_container .menu_button { pointer-events: none!important; }
        .middle_full_container .main_navigation_menu {display: none!important;}
    </style>
</body>
</html>