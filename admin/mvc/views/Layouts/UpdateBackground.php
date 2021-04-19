<?php {{ print_r($backgroundItem); }} ?>
<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Update background</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="Home">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="">Update background</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="updateBackground_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Background">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{
            if(!empty($statusActionBackground)) { ?>
                <div class="alert_wrap">
                    <div class="alert alert_<?php {{ echo $statusActionBackground['status']; }}
                        ?> position_relative" data-status="<?php {{
                            if(!empty($statusActionBackground['status']))
                            { echo "true"; }; }}
                        ?>">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span><?php {{ echo $statusActionBackground['notifiTxt']; }} ?></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
        <?php }  }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm background</span>
                    </h2>
                </div>
                <div class="panel_body">
                    <form action="" method="POST">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="active tab_item" href="#tab_general">Tổng quan</a>
                                <a class="tab_item" href="#tab_data">Dữ liệu</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle on">
                                                <input type="checkbox" id="status_value" <?php {{
                                                    /*------------------------------------------------------------------------*/
                                                   if(!empty(Validation::setValue("background_status")))
                                                   {  echo !empty(Validation::setValue("background_status")) == "on" ? "checked" : null; }
                                                   else
                                                   { echo $backgroundItem['background_status'] = "on" ? "checked" : null; }
                                                    /*------------------------------------------------------------------------*/
                                                }} ?> name="background_status" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="background_name" class="form_label"><strong style="color: #f00;">*</strong> Tên sự kiện</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="background_name" id="background_name" value="<?php {{
                                                    /*------------------------------------------------------------------------*/
                                                    if( !empty(Validation::setValue("background_name")) )
                                                    { echo Validation::setValue("background_name"); }
                                                    else
                                                    { echo !empty($backgroundItem["background_name"]) ? $backgroundItem["background_name"] : null; }
                                                    /*------------------------------------------------------------------------*/
                                                }} ?>" placeholder="Tên sự kiện" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("background_name"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="background_startDate" class="form_label"><strong style="color: #f00;">*</strong> Ngày bắt đầu</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" name="background_startDate" id="background_startDate" value="<?php {{
                                                    /*------------------------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("background_startDate")))
                                                    { echo Validation::setValue("background_startDate"); }
                                                    else
                                                    { echo !empty($backgroundItem["background_startDate"]) ? Format::formatTimeDateInput($backgroundItem["background_startDate"]) : null; }
                                                    /*------------------------------------------------------------------------*/
                                                }} ?>" placeholder="Ngày bắt đầu" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("background_startDate"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="background_endDate" class="form_label"><strong style="color: #f00;">*</strong> Ngày kết thúc</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" name="background_endDate" id="background_endDate" value="<?php {{
                                                    /*------------------------------------------------------------------------*/
                                                    if( !empty(Validation::setValue("background_endDate")) )
                                                    { echo Validation::setValue("background_endDate"); }
                                                    else
                                                    { echo !empty($backgroundItem["background_endDate"]) ? Format::formatTimeDateInput($backgroundItem["background_endDate"]) : null; }
                                                    /*------------------------------------------------------------------------*/
                                                }} ?>" placeholder="Ngày kết thúc" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("background_endDate"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="background_order" class="form_label">Thứ tự hiển thị</label>
                                            <div class="form_input">
                                                <input class="form_control" type="number" name="background_order" id="background_order" value="<?php {{
                                                    /*------------------------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("background_order")))
                                                    {  echo Validation::setValue("background_order"); }
                                                    else
                                                    { echo !empty($backgroundItem["background_order"]) ? $backgroundItem["background_order"] : null; }
                                                    /*------------------------------------------------------------------------*/
                                                }} ?>" placeholder="Số thứ tự" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_data">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="background_image" class="form_label"><strong style="color: #f00;">*</strong> Ảnh nền</label>
                                        <div class="form_input">
                                            <label for="background_image">
                                                <input type="hidden" id="background_image" name="background_image" value="<?php {{
                                                    /*--------------------------------------------------------------*/
                                                    if(!empty(Validation::setValue("background_image")))
                                                    { Validation::setValue("background_image"); }
                                                    else
                                                    { echo !empty($backgroundItem['background_image']) ? $backgroundItem['background_image'] : null; }
                                                    /*--------------------------------------------------------------*/
                                                }} ?>">
                                                <span class="thumbNail banner __PC" style="height: 1000px;width: 100%;">
                                                    <img class="img_cover full_size" src="<?php {{
                                                        if(!empty(Validation::setValue("background_image")))
                                                        { echo Validation::setValue("background_image"); }
                                                        else
                                                        { echo !empty($backgroundItem['background_image']) ? $backgroundItem['background_image'] : "./public/images/logo/no_image-50x50.png"; }
                                                    }} ?>" data-src-id="background_image" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=background_image" type="button" data-id-input-image="background_image" class="button_image btn btn_primary iframe-btn" title="ảnh hình nền">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="background_image" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("background_image"); }} ?>
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
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/plugins/Ckeditor/ckeditor/ckeditor.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>"></script>
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
<!-- ========== ############################### ========== -->
<!-- ========== ########## APP STYLE ########## ========== -->
<!-- ========== ############################### ========== -->
<script type="text/javascript" class="app_style">
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

//========= ##### handle keyup word and append ##### ==========//
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