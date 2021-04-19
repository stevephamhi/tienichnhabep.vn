<?php {{ $base = new Base; }} ?>
<div class="loader_wrap">
    <div class="loader"></div>
</div>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Hỗ trợ khách hàng</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php echo $base->getBaseURLAdmin(); ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Chi tiết yêu cầu hỗ trợ</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <a class="btn_item btn_default" href="SupportCustomer">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Chi tiết thông tin</span>
                    </h2>
                </div>
                <?php if( !empty($supportcustomerItem) ) : ?>
                    <div class="panel_body">
                        <form action="" method="POST">
                            <div id="table_content">
                                <div class="nav_tabs d_flex align_items_center">
                                    <a class="tab_item active" href="#tab_general">Nội dung</a>
                                </div>
                                <div class="tab_content">
                                    <div class="tab_pane" id="tab_general">
                                        <div class="form_group status_wrap d_flex align_items_center">
                                            <label for="status_value" class="form_label">Trạng thái</label>
                                            <div class="switch_status">
                                                <label for="status_value" class="status_toogle on">
                                                    <input type="checkbox" data-id="<?php {{ echo $supportcustomerItem['sp_customer_id']; }} ?>" data-status="<?php {{ echo $supportcustomerItem['sp_customer_status']; }} ?>" <?php {{
                                                        echo $supportcustomerItem['sp_customer_status'] == "processed" ? "checked" : null;
                                                    }} ?> name="brand_status" id="status_value" class="d_none">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="sp_customer_gender" class="form_label">Danh xưng</label>
                                                <div class="form_input">
                                                    <input disabled class="form_control" value="<?php {{ echo $supportcustomerItem['sp_customer_gender'] == "male" ? "Anh" : "Chị"; }} ?>" type="text" name="sp_customer_gender" id="sp_customer_gender" value="" placeholder="Danh xưng với khách hàng" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="sp_customer_fullname" class="form_label">Tên khách hàng</label>
                                                <div class="form_input">
                                                    <input disabled class="form_control" value="<?php {{ echo $supportcustomerItem['sp_customer_fullname']; }} ?>" type="text" name="sp_customer_fullname" id="sp_customer_fullname" value="" placeholder="Tên khách hàng" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="sp_customer_phone" class="form_label">
                                                    <span>Số điện thoại</span>
                                                    <a href="tel:<?php {{ echo $supportcustomerItem['sp_customer_phone']; }} ?>" style="display: inline-block; border: 1px solid #eee; padding: 2px 5px; background-color: #00BCD4; color: #fff; border-radius: 5px;">
                                                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                                                        Gọi
                                                    </a>
                                                </label>
                                                <div class="form_input">
                                                    <input disabled class="form_control" value="<?php {{ echo $supportcustomerItem['sp_customer_phone']; }} ?>" type="text" name="sp_customer_phone" id="sp_customer_phone" value="" placeholder="Số điện thoại khách hàng" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="sp_customer_time" class="form_label">Thời gian gửi</label>
                                                <div class="form_input">
                                                    <input disabled class="form_control" value="<?php {{ echo Format::formatFullTime($supportcustomerItem['sp_customer_time']); }} ?>" type="text" name="sp_customer_time" id="sp_customer_time" value="" placeholder="Thời gian gửi" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                            <?php if(!empty($supportcustomerItem['sp_customer_time_processed'])) : ?>
                                                <div class="form_group d_flex align_items_center">
                                                    <label for="sp_customer_time_processed" class="form_label">Thời gian duyệt</label>
                                                    <div class="form_input">
                                                        <input disabled class="form_control" value="<?php {{ echo Format::formatFullTime($supportcustomerItem['sp_customer_time_processed']); }} ?>" type="text" name="sp_customer_time_processed" id="sp_customer_time_processed" value="" placeholder="Thời gian duyệt" autocomplete="off" spellcheck="false">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(!empty($userItem)) : ?>
                                                <div class="form_group d_flex align_items_center">
                                                    <label for="sp_customer_handler" class="form_label">Nhân viên xử lý</label>
                                                    <div class="form_input">
                                                        <input disabled class="form_control" value="<?php {{ echo $userItem['user_fullname']; }} ?>" type="text" name="sp_customer_handler" id="sp_customer_handler" value="" placeholder="Nhân viên xử lý" autocomplete="off" spellcheck="false">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="sp_customer_time" class="form_label">Sản phẩm quan tâm</label>
                                                <div class="form_input">
                                                    <?php if( !empty($productItem) ) : ?>
                                                        <div class="infoProduct" style="background-color: #eee; padding: 10px;">
                                                            <div class="name" style="padding: 4px 0;">
                                                                <strong>Tên sản phẩm: </strong>
                                                                <span><?php {{ echo $productItem['prod_name']; }} ?></span>
                                                            </div>
                                                            <div class="model" style="padding: 4px 0;">
                                                                <strong>Model:</strong>
                                                                <span><?php {{ echo !empty($productItem['prod_model']) ? $productItem['prod_model'] : "Không có"; }} ?></span>
                                                            </div>
                                                            <div class="price_current" style="padding: 4px 0;">
                                                                <strong>Giá đang bán:</strong>
                                                                <span><?php {{ echo Format::formatCurrency($productItem['prod_currentPrice']); }} ?></span>
                                                            </div>
                                                            <div class="price_old" style="padding: 4px 0;">
                                                                <strong>Giá catalouge:</strong>
                                                                <span><?php {{ echo !empty($productItem['prod_oldPrice']) ? Format::formatCurrency($productItem['prod_oldPrice']) : "Không có"; }} ?></span>
                                                            </div>
                                                            <a target="_blank" style="display: inline-block; border: 1px solid #eee; padding: 2px 5px; background-color: #00BCD4; color: #fff; border-radius: 5px;" href="<?php echo "Product/update/{$productItem['prod_id']}/{$productItem['prod_seoUrl']}.html"; ?>">
                                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                                <span>Chi tiết sản phẩm</span>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else : ?>
                    <p class="data_empty_notification">Yêu cầu hỗ trợ này không tồn tại !</p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/detailSupportcustomer.ajax.js"); }} ?>"></script>
<script type="text/javascript" class="handle_show_tab_pane">
    activePageTab();
    function activePageTab() {
        let elActive = document.querySelector("#table_content .nav_tabs .tab_item.active");
        let idPane = (elActive.getAttribute('href')).split("#")[1];
        let elPane = document.getElementById(idPane);
        (document.querySelectorAll(".tab_pane")).forEach(el => {
            el.style.display = "none";
        });
        elPane.style.display = "block";
    }
    let listBtnEl = document.querySelectorAll("#table_content .nav_tabs .tab_item");
    listBtnEl.forEach(el => {
        el.addEventListener('click', function() {
            event.preventDefault();
            listBtnEl.forEach(el => {
                el.classList.remove('active');
            });
            this.classList.add('active');
            activePageTab();
        });
    });
</script>

<script>
// handle notification status add cate new
var alertStatusAddCateEl = document.querySelector('.alert');
if(alertStatusAddCateEl !== null) {
    var buttonCloseAlertEl   = document.querySelector(".alert .close");
    if(alertStatusAddCateEl.getAttribute('data-status') === 'true') {
        alertStatusAddCateEl.classList.add('open');
        setTimeout(function() {
            alertStatusAddCateEl.classList.remove('open');
        },5000);
    }

    buttonCloseAlertEl.addEventListener('click', function() {
        alertStatusAddCateEl.classList.remove('open');
    });
}
</script>
<script>
    const imgConfig = "./public/images/logo/no_image-50x50.png";
    handleOpenFilemana();
    function handleOpenFilemana() {
    $('.iframe-btn').fancybox({
        'width'		: 900,
        'height'	: 600,
        'type'		: 'iframe',
        'autoScale'	: false
    });
    }

    function responsive_filemanager_callback(field_id){
    var url = jQuery('#'+field_id).val();
    $("[data-src-id='"+(field_id)+"']").attr('src', url);
    handleClearImage();
    }

    function handleClearImage() {
    let listBtnClearSrcImg = document.querySelectorAll("[data-id-clear-img]");
    listBtnClearSrcImg.forEach(btnEl => {
        btnEl.addEventListener('click', function() {
            let field_id = btnEl.getAttribute('data-id-clear-img');
            let imgElClear = document.querySelector("[data-src-id='"+(field_id)+"']");
            let inputElClear = document.getElementById(""+(field_id)+"");
            imgElClear.setAttribute('src',imgConfig);
            inputElClear.setAttribute('value','');
        });
    });
    }
</script>