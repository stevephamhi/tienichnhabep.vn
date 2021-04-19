<div class="user_menu_wrapper">
    <div class="user_menu_inner">
        <a href="<?php {{ echo Config::getBaseUrlClient(); }} ?>" class="u_menu_item <?php {{ echo !empty($tab) && $tab == 'home' ? 'active' : '';  }} ?>">
            <img class="img" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/home_u_icon.png"); }} ?>" alt="icon menu trang chủ user">
            <span class="text">Trang chủ</span>
        </a>
        <a href="<?php {{ echo Config::getBaseUrlClient("danh-muc-san-pham.html"); }} ?>" class="u_menu_item <?php {{ echo !empty($tab) && $tab == 'cate' ? 'active' : '';  }} ?>">
            <img class="img" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/cate_u_icon.png"); }} ?>" alt="icon menu danh mục user">
            <span class="text">Danh mục</span>
        </a>
        <a href="<?php {{ echo Config::getBaseUrlClient("don-hang-cua-toi.html"); }} ?>" class="u_menu_item <?php {{ echo !empty($tab) && $tab == 'history' ? 'active' : '';  }} ?>">
            <img class="img" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/order_u_icon.png"); }} ?>" alt="icon menu đơn hàng user">
            <span class="text">Đơn hàng</span>
        </a>
        <a href="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>" class="u_menu_item <?php {{ echo !empty($tab) && $tab == 'profile' ? 'active' : '';  }} ?>">
            <img class="img" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/user_u_icon.png"); }} ?>" alt="icon menu cá nhân user">
            <span class="text">Cá nhân</span>
        </a>
        <a href="<?php {{ echo Config::getBaseUrlClient("so-dia-chi.html"); }} ?>" class="u_menu_item <?php {{ echo !empty($tab) && $tab == 'address_store' ? 'active' : '';  }} ?>">
            <img class="img" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/address_u_icon.png"); }} ?>" alt="icon menu địa chỉ">
            <span class="text">Địa chỉ</span>
        </a>
    </div>
</div>
<style>
    
    @media screen and (min-width: 320px) {
        #fb-root { display: none; }
        .user_menu_wrapper {
            display: block;
        }
        .footer_sc { display: none; }
    }
    @media screen and (min-width: 1280px) {
         #fb-root { display: block; }
        .user_menu_wrapper {
            display: none;
        }
        .footer_sc { display: block; }
    }
    .user_menu_wrapper {
        width: 100%;
        position: fixed;
        bottom: 0;
        left: 0;
        background: #fff;
        border-top: 1px solid rgba(0,0,0,0.12);
        height: 55px;
        overflow: hidden;
    }
    .user_menu_inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
    }

    .user_menu_inner .u_menu_item.active {
        font-weight: bold;
        color: #006c95;
    }

    .user_menu_inner .u_menu_item {
        padding: 5px;
        text-align: center;
        font-size: .8rem;
        align-self: center;
        color: #5b5959;
        font-family: 'tienitnhabep-mainFont-Light';
    }
    .user_menu_inner .u_menu_item .img {
        width: 20px;
        height: 20px;
        margin: 0 auto;
        margin-bottom: 2px;
    }
</style>