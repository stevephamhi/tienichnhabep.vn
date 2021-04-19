<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Thiết lập</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php echo $base->getBaseURLAdmin(); ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thiết lập thông tin website</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="saveConfig_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Brand">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <?php if(!empty($statusActionConfig)) : ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionConfig['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionConfig['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionConfig['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php endif; ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Cập nhật thiết lập chung</span>
                    </h2>
                </div>
                <div class="panel_body">
                    <form action="" method="POST">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="tab_item active" href="#tab_general">Tổng quan</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_logo" class="form_label"><strong style="color: #f00;">*</strong> Logo</label>
                                            <div class="form_input position_relative">
                                                <label for="prod_avatar">
                                                    <input type="hidden" id="config_logo" name="config_logo" value="<?php {{
                                                        /*-----------------------------------------------------------*/
                                                        if(!empty(Validation::setValue("config_logo")))
                                                        { echo Validation::setValue("config_logo"); }
                                                        else
                                                        { echo !empty($configInfo['config_logo']) ? $configInfo['config_logo'] : null; }
                                                        /*-----------------------------------------------------------*/
                                                    }} ?>">
                                                    <span class="thumbNail small">
                                                        <img id="prod_avatar_src" data-src-id="config_logo" class="img_cover full_size" src="<?php {{
                                                            /*------------------------------------------------------------*/
                                                            if(!empty(Validation::setValue("config_logo")))
                                                            { echo Validation::setValue("config_logo"); }
                                                            else
                                                            { echo !empty($configInfo['config_logo']) ? $configInfo['config_logo'] : "./public/images/logo/no_image-50x50.png"; }
                                                            /*------------------------------------------------------------*/
                                                        }} ?>" alt="">
                                                    </span>
                                                    <div class="popover position_absolute" style="left: 155px;">
                                                        <div class="popover_content d_flex align_items_center">
                                                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=config_logo" type="button" data-id-input-image="config_logo" class="button_image btn btn_primary iframe-btn" title="Thêm logo">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <button type="button" data-id-clear-img="config_logo" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </label>
                                                <?php {{ echo Validation::formError("config_logo"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_icon" class="form_label"><strong style="color: #f00;">*</strong> Icon</label>
                                            <div class="form_input position_relative">
                                                <label for="prod_avatar">
                                                    <input type="hidden" id="config_icon" name="config_icon" value="<?php {{
                                                        /*-----------------------------------------------------------*/
                                                        if(!empty(Validation::setValue("config_icon")))
                                                        { echo Validation::setValue("config_icon"); }
                                                        else
                                                        { echo !empty($configInfo['config_icon']) ? $configInfo['config_icon'] : null; }
                                                        /*-----------------------------------------------------------*/
                                                    }} ?>">
                                                    <span class="thumbNail small">
                                                        <img id="prod_avatar_src" data-src-id="config_icon" class="img_cover full_size" src="<?php {{
                                                            /*------------------------------------------------------------*/
                                                            if(!empty(Validation::setValue("config_icon")))
                                                            { echo Validation::setValue("config_icon"); }
                                                            else
                                                            { echo !empty($configInfo['config_icon']) ? $configInfo['config_icon'] : "./public/images/logo/no_image-50x50.png"; }
                                                            /*------------------------------------------------------------*/
                                                        }} ?>" alt="">
                                                    </span>
                                                    <div class="popover position_absolute" style="left: 155px;">
                                                        <div class="popover_content d_flex align_items_center">
                                                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=config_icon" type="button" data-id-input-image="config_icon" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh icon">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <button type="button" data-id-clear-img="config_icon" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </label>
                                                <?php {{ echo Validation::formError("config_icon"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_name_company" class="form_label"><strong style="color: #f00;">*</strong> Tên công ty</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_name_company" id="config_name_company" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_name_company")))
                                                    { echo Validation::setValue("config_name_company"); }
                                                    else
                                                    { echo !empty($configInfo['config_name_company']) ? $configInfo['config_name_company'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Tên công ty" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_name_company"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_address_company" class="form_label"><strong style="color: #f00;">*</strong> Địa chỉ công ty</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_address_company" id="config_address_company" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_address_company")))
                                                    { echo Validation::setValue("config_address_company"); }
                                                    else
                                                    { echo !empty($configInfo['config_address_company']) ? $configInfo['config_address_company'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Địa chỉ công ty" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_address_company"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_taxcode" class="form_label"><strong style="color: #f00;">*</strong> Mã số thuế</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_taxcode" id="config_taxcode" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_taxcode")))
                                                    { echo Validation::setValue("config_taxcode"); }
                                                    else
                                                    { echo !empty($configInfo['config_taxcode']) ? $configInfo['config_taxcode'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Mã số thuế" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_taxcode"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_image" class="form_label"><strong style="color: #f00;">*</strong> Hình ảnh</label>
                                            <div class="form_input position_relative">
                                                <label for="prod_avatar">
                                                    <input type="hidden" id="config_image" name="config_image" value="<?php {{
                                                        /*--------------------------------------------------------*/
                                                        if(!empty(Validation::setValue("config_image")))
                                                        { echo Validation::setValue("config_image"); }
                                                        else
                                                        { echo !empty($configInfo['config_image']) ? $configInfo['config_image'] : null; }
                                                        /*--------------------------------------------------------*/
                                                    }} ?>">
                                                    <span class="thumbNail small" style="width: 250px; height: 250px;">
                                                        <img id="prod_avatar_src" data-src-id="config_image" class="img_cover full_size" src="<?php {{
                                                            /*-------------------------------------------------------*/
                                                            if(!empty(Validation::setValue("config_image")))
                                                            { echo Validation::setValue("config_image"); }
                                                            else
                                                            { echo !empty($configInfo['config_image']) ? $configInfo['config_image'] : "./public/images/logo/no_image-50x50.png"; }
                                                            /*-------------------------------------------------------*/
                                                        }} ?>" alt="">
                                                    </span>
                                                    <div class="popover position_absolute" style="left: 255px;">
                                                        <div class="popover_content d_flex align_items_center">
                                                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=config_image" type="button" data-id-input-image="config_image" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh đại diện công ty">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <button type="button" data-id-clear-img="config_image" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </label>
                                                <?php {{ echo Validation::formError("config_image"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_metaTitle" class="form_label"><strong style="color: #f00;">*</strong> Meta title</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_metaTitle" id="config_metaTitle" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_metaTitle")))
                                                    { echo Validation::setValue("config_metaTitle"); }
                                                    else
                                                    { echo !empty($configInfo['config_metaTitle']) ? $configInfo['config_metaTitle'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Thông tin tiêu đề" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_metaTitle"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_metaDesc" class="form_label"><strong style="color: #f00;">*</strong> Meta description </label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_metaDesc" id="config_metaDesc" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_metaDesc")))
                                                    { echo Validation::setValue("config_metaDesc"); }
                                                    else
                                                    { echo !empty($configInfo['config_metaDesc']) ? $configInfo['config_metaDesc'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Thông tin mô tả" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_metaDesc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_metaKeyword" class="form_label">
                                                <span>Từ khóa</span>
                                                <i class="fa fa-question-circle" title="Không sử dụng khoảng trống, nếu cần hãy sử dụng dấu - , Ví dụ: Apple." style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_metaKeyword" id="config_metaKeyword" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_metaKeyword")))
                                                    { echo Validation::setValue("config_metaKeyword"); }
                                                    else
                                                    { echo !empty($configInfo['config_metaKeyword']) ? $configInfo['config_metaKeyword'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Từ khóa" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_metaKeyword"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_hotline" class="form_label"><strong style="color: #f00;">*</strong> Hotline</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_hotline" id="config_hotline" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_hotline")))
                                                    { echo Validation::setValue("config_hotline"); }
                                                    else
                                                    { echo !empty($configInfo['config_hotline']) ? $configInfo['config_hotline'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Hotline công ty" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_hotline"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="config_placeholder_search" class="form_label"><strong style="color: #f00;">*</strong> Tiêu đề search</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="config_placeholder_search" id="config_placeholder_search" value="<?php {{
                                                    /*--------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("config_placeholder_search")))
                                                    { echo Validation::setValue("config_placeholder_search"); }
                                                    else
                                                    { echo !empty($configInfo['config_placeholder_search']) ? $configInfo['config_placeholder_search'] : null; }
                                                    /*--------------------------------------------------------*/
                                                }} ?>" placeholder="Tiêu đề ô search" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("config_placeholder_search"); }} ?>
                                            </div>
                                        </div>
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