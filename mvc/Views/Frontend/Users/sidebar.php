<div class="grid_column_3 tab_control_user">
    <div class="tab_control">
        <div class="tab_user d_flex align_items_center">
            <div class="avatar">
                <img class="full_size" src="<?php {{
                    if(!empty(Validation::setValue("customer_avatar"))) {
                        echo Validation::setValue("customer_avatar");
                    } else {
                        echo !empty($customerItem['customer_avatar']) ? Config::getBaseUrlClient($customerItem['customer_avatar']) : Config::getBaseUrlClient("public/images/icon/default-avatar-male.png");
                    }
                }} ?>" alt="">
            </div>
            <div class="info">
                <p class="title">Tài khoản của</p>
                <p class="name"><?php {{
                    if( !empty(Validation::setValue("customer_gender")) ) {
                        echo Format::formatGender(Validation::setValue("customer_gender"));
                    } else {
                        echo Format::formatGender($customerItem['customer_gender']);
                    }
                    echo " ";
                    if(!empty(Validation::setValue("customer_fullname"))) {
                        echo Validation::setValue("customer_fullname");
                    } else {
                        echo $customerItem['customer_fullname'];
                    }
                }} ?></p>
            </div>
        </div>
        <a href="<?php {{ echo Config::getBaseUrlClient("don-hang-cua-toi.html"); }} ?>" class="tab_item d_flex align_items_center <?php {{ echo $tabActive == "history" ? "active" : null; }}?>">
            <span class="d_block" style="width:30px; height: 30px; margin-right: 5px;">
                <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/danh-sach-don-hang-da-mua.png"); }} ?>" alt="">
            </span>
            <span>Quản lý đơn hàng</span>
        </a>
        <a href="<?php {{ echo Config::getBaseUrlClient("thong-tin-ca-nhan.html"); }} ?>" class="tab_item d_flex align_items_center <?php {{ echo $tabActive == "profile" ? "active" : null; }}?>">
            <span class="d_block" style="width:30px; height: 30px; margin-right: 5px;">
                <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/profile_icon.png"); }} ?>" alt="">
            </span>
            <span>Thông tin các nhân</span>
        </a>
        <a href="<?php {{ echo Config::getBaseUrlClient("so-dia-chi.html"); }} ?>" class="tab_item d_flex align_items_center <?php {{ echo $tabActive == "address_store" ? "active" : null; }}?>">
            <span class="d_block" style="width:30px; height: 30px; margin-right: 5px;">
                <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/so-dia-chi.png"); }} ?>" alt="">
            </span>
            <span>Sổ địa chỉ</span>
        </a>
    </div>
</div>