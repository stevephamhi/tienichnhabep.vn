<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) && !empty($aboutusItem) ) : ?>
        <title><?php {{ echo $aboutusItem['policy_title'] ? $aboutusItem['policy_title'] : "Trang thông tin"; }} ?></title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="<?php {{ echo !empty($aboutusItem['policy_metaDesc']) ? $aboutusItem['policy_metaDesc'] : null; }} ?>">
        <meta property="og:title" content="<?php {{ echo $aboutusItem['policy_title'] ? $aboutusItem['policy_title'] : null; }} ?>">
        <meta property="og:description" content="<?php {{ echo !empty($aboutusItem['policy_metaDesc']) ? $aboutusItem['policy_metaDesc'] : null; }} ?>">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("{$aboutusItem['policy_seoUrl']}-i{$aboutusItem['policy_id']}.html"); }} ?>">
        <meta property="og:site_name" content="<?php {{ echo $aboutusItem['policy_title'] ? $aboutusItem['policy_title'] : null; }} ?>">
        <meta property="og:image" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlClient($configInfo['config_image']) : null; }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlClient($configInfo['config_image']) : null; }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php {{ echo $aboutusItem['policy_title'] ? $aboutusItem['policy_title'] : null; }} ?>">
        <meta name="twitter:description" content="<?php {{ echo !empty($aboutusItem['policy_metaDesc']) ? $aboutusItem['policy_metaDesc'] : null; }} ?>">
        <meta name="twitter:image" content="<?php {{ echo !empty($configInfo['config_image']) ? Config::getBaseUrlClient($configInfo['config_image']) : null; }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <style>
        .main_content_wrap_append{background-color:#fff;padding:20px}.main_content_wrap_append a{display:inline-block}.main_content_wrap_append *{padding:5px 0;line-height:1.5}.main_content_wrap_append table td{border:1px solid #797979;padding:10px}
    </style>
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <?php if(!empty($aboutusItem)) : ?>
            <section class="breadcrum_wrap">
                <div class="container">
                    <ol class="breadcrum_list grid_row align_items_center">
                        <li class="breadcrum_item home d_flex align_items_center">
                            <a href="" class="breadcrum_link" title="Về trang chủ">
                                <i class="fa fa-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="breadcrum_item nav3 d_flex align_items_center position_relative">
                            <a href="" class="breadcrum_link" title="Bếp từ, Bếp lẩu">
                                <span><?php {{ echo $aboutusItem['policy_title']; }} ?></span>
                            </a>
                        </li>
                    </ol>
                </div>
            </section>
            <main class="main_sc">
                <div class="container main_content_wrap_append">
                    <?php {{ echo $aboutusItem['policy_desc']; }} ?>
                </div>
            </main>
            <?php else : ?>
                <p style="text-align: center; padding: 30px 0;">Thông tin không tồn tại !</p>
            <?php endif; ?>
            <?php {{ view("Inc.footer"); }} ?>
        </div>
    </div>
</body>
</html>