<!DOCTYPE html>
<html lang="en">
<head>
    <?php if( !empty($configInfo) ) : ?>
        <title>Đơn hàng của tôi | Tienichnhabep.vn</title>
        <base href="<?php {{ echo Config::getBaseUrlClient(); }} ?>">
        <link rel="shortcut icon" href="<?php {{ echo Config::getBaseUrlAdmin($configInfo['config_icon']); }} ?>">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="vi">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:type" content="website">
        <meta property="author" content="<?php {{ echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }} ?>">
        <meta name="description" content="Đơn hàng của tôi | Tienichnhabep.vn">
        <meta property="og:title" content="Đơn hàng của tôi | Tienichnhabep.vn">
        <meta property="og:description" content="Đơn hàng của tôi | Tienichnhabep.vn">
        <meta property="og:url" content="<?php {{ echo Config::getBaseUrlClient("lich-su-mua-hang.html"); }} ?>">
        <meta property="og:site_name" content="Đơn hàng của tôi | Tienichnhabep.vn">
        <meta property="og:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta property="og:image:secure_url" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="Đơn hàng của tôi | Tienichnhabep.vn">
        <meta name="twitter:description" content="Đơn hàng của tôi | Tienichnhabep.vn">
        <meta name="twitter:image" content="<?php {{ echo Config::getBaseUrlClient("public/images/icon/login_bg.png"); }} ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo Config::getBaseUrlClient("public/css/style/user.css"); }} ?>">
    <style>
        .pagination_wrap{padding:20px 0}.pagination_wrap a.pagination_item{border:1px solid #dcdcdc;padding:5px;margin:0 2px;color:#545454}.pagination_wrap a.pagination_item.next,.pagination_wrap a.pagination_item.prev{padding:5px 10px}.pagination_wrap a.pagination_item.active{background-color:var(--main-color);color:#fff;border:1px solid var(--main-color)}.pagination_wrap a.pagination_item.normal{padding:5px 10px}@media screen and (min-width:320px){.pagination_wrap a.pagination_item span{display:none}}@media screen and (min-width:600px){.pagination_wrap a.pagination_item span{display:inline-block}}.pagination_wrap{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.pagination_wrap .countPage,.pagination_wrap .current,.pagination_wrap a{margin-right:10px;border:1px solid #00bcd4;display:block;padding:5px 10px;background-color:#00bcd4;color:#fff}.pagination_wrap a{padding:5px 10px;background-color:#fff;color:#00bcd4!important}
    </style>
</head>
<body>
    <div class="home_page">
        <div class="mask_full_screen"></div>
        <?php {{ view("Inc.responmenu"); }} ?>
        <div class="pc_size">
            <?php {{ view("Inc.header"); }} ?>
            <main class="main_sc">
                <div class="container main_content_wrap_append" id="info_user_wrap">
                    <div class="grid_row">
                        <?php {{ view("Frontend.Users.sidebar", [
                            "tabActive" => "history",
                            "customerItem" => $customerItem
                        ]); }} ?>
                        <div class="grid_column_12 grid_column_lg_9">
                            <div id="history_order">
                                <div class="list_order">
                                    <div class="title">Đơn hàng gần đây</div>
                                    <?php if( !empty($listHistoryOrder) ) : ?>
                                        <?php {{ view("Frontend.Users.history_pc", ['listHistoryOrder' => $listHistoryOrder]); }} ?>
                                        <?php {{ view("Frontend.Users.history_mb", ['listHistoryOrder' => $listHistoryOrder]); }} ?>
                                        <div class="pagination_wrap">
                                            <?php if($totalPage > 1) { echo Pagination::getPagination(Config::getBaseUrlClient("don-hang-cua-toi.html{$pageUrl}"), $totalPage, $page); } ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="cart_empty" style="margin: 10px auto; text-align: center; background: #fff; padding: 20px; border-radius: 3px;">
                                            <img width="150" style="margin: 0 auto;" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/empty-cart.png"); }} ?>" alt="Bạn chưa có đơn hàng nào">
                                            <p style="font-size: .9rem;">Bạn chưa có đơn hàng nào</p>
                                            <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" style=" border: 1px solid #03A9F4; margin: 8px 0; font-weight: bold; color: #03A9F4; display: inline-block; padding: 6px 30px; font-size: .95rem; border-radius: 5px;">MUA NGAY NÀO</a>
                                            <p style="font-size: .9rem;">Khi cần trợ giúp vui lòng gọi <a href="tel:0708070827" class="d_inline" style="color: #03A9F4;">0708.0708.27</a> (8h00 - 20h00)</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php {{ view("Inc.footer"); }} ?>
            <?php {{ view("Frontend.Users.menu", ['tab' => 'history']); }} ?>
        </div>
    </div>
</body>
</html>