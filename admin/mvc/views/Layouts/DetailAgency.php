<?php {{ $base = new Base; }} ?>
<div class="loader_wrap">
    <div class="loader"></div>
</div>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Đăng ký đại lý</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php echo $base->getBaseURLAdmin(); ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thông tin chi tiết</a>
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
                                                <input type="checkbox" data-id="<?php {{ echo $agencyItem['agency_id']; }} ?>" data-status="<?php {{ echo $agencyItem['agency_status']; }} ?>" <?php {{
                                                    echo $agencyItem['agency_status'] == "processed" ? "checked" : null;
                                                }} ?> name="agency_status" id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="agency_fullname" class="form_label">Tên người đăng ký</label>
                                            <div class="form_input">
                                                <input disabled class="form_control" value="<?php {{
                                                    /*------------------------------------------------------*/
                                                    echo !empty($agencyItem['agency_fullname']) ? $agencyItem['agency_fullname'] : null;
                                                    /*------------------------------------------------------*/
                                                }} ?>" type="text" name="agency_fullname" id="agency_fullname" value="" placeholder="Tên người đăng ký" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="agency_company" class="form_label">Tên công ty</label>
                                            <div class="form_input">
                                                <input disabled class="form_control" value="<?php {{
                                                    /*------------------------------------------------------*/
                                                    echo !empty($agencyItem['agency_company']) ? $agencyItem['agency_company'] : null;
                                                    /*------------------------------------------------------*/
                                                }} ?>" type="text" name="agency_company" id="agency_company" value="" placeholder="Tên công ty" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="agency_phone" class="form_label">
                                                <span>Số điện thoại</span>
                                                <a href="tel:<?php {{
                                                    /*------------------------------------------------------*/
                                                    echo !empty($agencyItem['agency_phone']) ? $agencyItem['agency_phone'] : null;
                                                    /*------------------------------------------------------*/
                                                }} ?>" style="display: inline-block; border: 1px solid #eee; padding: 2px 5px; background-color: #00BCD4; color: #fff; border-radius: 5px;">
                                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                                    Gọi
                                                </a>
                                            </label>
                                            <div class="form_input">
                                                <input disabled class="form_control" value="<?php {{
                                                    /*------------------------------------------------------*/
                                                    echo !empty($agencyItem['agency_phone']) ? $agencyItem['agency_phone'] : null;
                                                    /*------------------------------------------------------*/
                                                }} ?>" type="text" name="agency_phone" id="agency_phone" value="" placeholder="Số điện thoại đăng ký" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="agency_email" class="form_label">
                                                <span>Email đăng ký</span>
                                                <a href="mailTo:<?php {{
                                                    /*------------------------------------------------------*/
                                                    echo !empty($agencyItem['agency_email']) ? $agencyItem['agency_email'] : null;
                                                    /*------------------------------------------------------*/
                                                }} ?>" style="display: inline-block; border: 1px solid #eee; padding: 2px 5px; background-color: #00BCD4; color: #fff; border-radius: 5px;">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    Soạn mail
                                                </a>
                                            </label>
                                            <div class="form_input">
                                                <input disabled class="form_control" value="<?php {{
                                                    /*------------------------------------------------------*/
                                                    echo !empty($agencyItem['agency_email']) ? $agencyItem['agency_email'] : null;
                                                    /*------------------------------------------------------*/
                                                }} ?>" type="text" name="agency_email" id="agency_email" value="" placeholder="Email đăng ký" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="agency_createDate" class="form_label">Thời gian gửi</label>
                                            <div class="form_input">
                                                <input disabled class="form_control" value="<?php {{
                                                    /*------------------------------------------------------*/
                                                    echo !empty($agencyItem['agency_createDate']) ? Format::formatTime($agencyItem['agency_createDate']) : null;
                                                    /*------------------------------------------------------*/
                                                }} ?>" type="text" name="agency_createDate" id="agency_createDate" value="" placeholder="Thời gian đăng ký" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <?php if( !empty($agencyItem['agency_time_processed']) ) : ?>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="agency_time_processed" class="form_label">Thời gian duyệt</label>
                                                <div class="form_input">
                                                    <input disabled class="form_control" value="<?php {{
                                                        /*------------------------------------------------------*/
                                                        echo !empty($agencyItem['agency_time_processed']) ? Format::formatTime($agencyItem['agency_time_processed']) : null;
                                                        /*------------------------------------------------------*/
                                                    }} ?>" type="text" name="agency_time_processed" id="agency_time_processed" value="" placeholder="Thời gian duyệt" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if( !empty($userItem) ) : ?>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="sp_customer_handler" class="form_label">Nhân viên xử lý</label>
                                                <div class="form_input">
                                                    <input disabled class="form_control" value="<?php {{
                                                        /*------------------------------------------------------*/
                                                        echo !empty($userItem['user_fullname']) ? $userItem['user_fullname'] : null;
                                                        /*------------------------------------------------------*/
                                                    }} ?>" type="text" name="user_fullname" id="user_fullname" value="" placeholder="Nhân viên xử lý" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/agencyDetail.ajax.js"); }} ?>"></script>
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