<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Thông tin hỗ trợ sản phẩm</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="Home">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Cập nhật thông tin hỗ trợ</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($infoSpProdItem) ? "disabled" : null; }} ?> name="updateProductsp_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Cập nhật</span>
                    </button>
                    <a class="btn_item btn_default" href="Productsp">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{ if(!empty($statusActionProdsp)) { ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionProdsp['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionProdsp['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionProdsp['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php } }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm thông tin hỗ trợ</span>
                    </h2>
                </div>
                <?php if( !empty($infoSpProdItem) ) : ?>
                    <div class="panel_body">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="active tab_item" href="#tab_general">Tổng quan</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle">
                                                <input type="checkbox" name="prodsp_status" <?php {{
                                                    /*--------------------------------------------------*/
                                                    if(!empty(Validation::setValue("prodsp_status")))
                                                    { echo Validation::setValue("prodsp_status") == "on" ? "checked" : null; }
                                                    else
                                                    { echo $infoSpProdItem['prodsp_status'] == "on" ? "checked" : null; }
                                                    /*--------------------------------------------------*/
                                                }} ?> id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_image" class="form_label"><strong style="color: #f00;">*</strong> Mini icon</label>
                                            <div class="form_input">
                                                <label for="prodsp_image">
                                                    <input type="hidden" id="prodsp_image" value="<?php {{
                                                        /*-----------------------------------------*/
                                                        if(!empty(Validation::setValue("prodsp_image")))
                                                        { echo Validation::setValue("prodsp_image"); }
                                                        else
                                                        { echo !empty($infoSpProdItem['prodsp_image']) ? $infoSpProdItem['prodsp_image'] : null; }
                                                        /*-----------------------------------------*/
                                                    }} ?>" name="prodsp_image">
                                                    <span class="thumbNail small">
                                                        <img class="img_cover full_size" data-src-id="prodsp_image" src="<?php {{
                                                            /*-----------------------------------------*/
                                                            if(!empty(Validation::setValue("prodsp_image")))
                                                            { echo Validation::setValue("prodsp_image"); }
                                                            else
                                                            { echo !empty($infoSpProdItem['prodsp_image']) ? $infoSpProdItem['prodsp_image'] : "./public/images/logo/no_image-50x50.png"; }
                                                            /*-----------------------------------------*/
                                                        }} ?>" alt="">
                                                    </span>
                                                </label>
                                                <div class="popover" style="transform: translate(0)">
                                                    <div class="popover_content d_flex align_items_center">
                                                        <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=prodsp_image" type="button" data-id-input-image="prodsp_image" class=" btn btn_primary iframe-btn" title="Thêm ảnh icon thông tin hỗ trợ sản phẩm">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button type="button" data-id-clear-img="prodsp_image" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php {{ echo Validation::formError("prodsp_image"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_name" class="form_label"><strong style="color: #f00;">*</strong> Tên thông tin</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="prodsp_name" id="prodsp_name" value="<?php {{
                                                /*-----------------------------------------*/
                                                if(!empty(Validation::setValue("prodsp_name")))
                                                { echo Validation::setValue("prodsp_name"); }
                                                else
                                                { echo !empty($infoSpProdItem['prodsp_name']) ? $infoSpProdItem['prodsp_name'] : null; }
                                                /*-----------------------------------------*/
                                                }} ?>" placeholder="Tên thông tin hỗ trợ" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("prodsp_name"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_order" class="form_label">Thứ tự lớn nhất</label>
                                            <div class="form_input">
                                                <input type="text" disabled class="form_control" id="orderMax_current" style="width: 50px; margin-bottom: 5px;" value="">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_order" class="form_label">Số thứ tự</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="prodsp_order" id="prodsp_order" value="<?php {{
                                                /*-----------------------------------------*/
                                                if(!empty(Validation::setValue("prodsp_order")))
                                                { echo Validation::setValue("prodsp_order"); }
                                                else
                                                { echo !empty($infoSpProdItem['prodsp_order']) ? $infoSpProdItem['prodsp_order'] : null; }
                                                /*-----------------------------------------*/
                                                }} ?>" placeholder="Thứ tự hiển thị (Mặc định là 0)" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_content" class="form_label"><strong style="color: #f00;">*</strong> Nội dung</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="prodsp_content" id="prodsp_content" style="height: 300px;" placeholder="Nội dung thông tin hỗ trợ" spellcheck="false"><?php {{
                                                /*-----------------------------------------*/
                                                if(!empty(Validation::setValue("prodsp_content")))
                                                { echo Validation::setValue("prodsp_content"); }
                                                else
                                                { echo !empty($infoSpProdItem['prodsp_content']) ? $infoSpProdItem['prodsp_content'] : null; }
                                                /*-----------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("prodsp_content"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_metaImg" class="form_label"><strong style="color: #f00;">*</strong> Meta ảnh</label>
                                            <div class="form_input">
                                                <label for="prodsp_metaImg">
                                                    <input type="hidden" id="prodsp_metaImg" value="<?php {{
                                                        /*-----------------------------------------*/
                                                        if(!empty(Validation::setValue("prodsp_metaImg")))
                                                        { echo Validation::setValue("prodsp_metaImg"); }
                                                        else
                                                        { echo !empty($infoSpProdItem['prodsp_metaImg']) ? $infoSpProdItem['prodsp_metaImg'] : null; }
                                                        /*-----------------------------------------*/
                                                    }} ?>" name="prodsp_metaImg">
                                                    <span class="thumbNail small" style="width: 300px; height: 300px;">
                                                        <img class="img_cover full_size" data-src-id="prodsp_metaImg" src="<?php {{
                                                            /*-----------------------------------------*/
                                                            if(!empty(Validation::setValue("prodsp_metaImg")))
                                                            { echo Validation::setValue("prodsp_metaImg"); }
                                                            else
                                                            { echo !empty($infoSpProdItem['prodsp_metaImg']) ? $infoSpProdItem['prodsp_metaImg'] : "./public/images/logo/no_image-50x50.png"; }
                                                            /*-----------------------------------------*/
                                                        }} ?>" alt="">
                                                    </span>
                                                </label>
                                                <div class="popover" style="transform: translate(0)">
                                                    <div class="popover_content d_flex align_items_center">
                                                        <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=prodsp_metaImg" type="button" data-id-input-image="prodsp_metaImg" class=" btn btn_primary iframe-btn" title="Thêm meta image thông tin hỗ trợ">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button type="button" data-id-clear-img="prodsp_metaImg" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php {{ echo Validation::formError("prodsp_metaImg"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_metaTitle" class="form_label"><strong style="color: #f00;">*</strong> Thẻ tiêu đề (Meta title)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="prodsp_metaTitle" id="prodsp_metaTitle" value="<?php {{
                                                    /*-----------------------------------------*/
                                                    if(!empty(Validation::setValue("prodsp_metaTitle")))
                                                    { echo Validation::setValue("prodsp_metaTitle"); }
                                                    else
                                                    { echo !empty($infoSpProdItem['prodsp_metaTitle']) ? $infoSpProdItem['prodsp_metaTitle'] : null; }
                                                    /*-----------------------------------------*/
                                                }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("prodsp_metaTitle"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prodsp_metaDesc" class="form_label"><strong style="color: #f00;">*</strong> Thẻ mô tả (Meta desc)</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="prodsp_metaDesc" id="prodsp_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                    /*-----------------------------------------*/
                                                    if(!empty(Validation::setValue("prodsp_metaDesc")))
                                                    { echo Validation::setValue("prodsp_metaDesc"); }
                                                    else
                                                    { echo !empty($infoSpProdItem['prodsp_metaDesc']) ? $infoSpProdItem['prodsp_metaDesc'] : null; }
                                                    /*-----------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("prodsp_metaDesc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                            <div class="form_input">
                                                <div class="google_title"><?php {{
                                                    /*-------------------------------*/
                                                    if(!empty(Validation::setValue("prodsp_metaTitle")))
                                                    { echo Validation::setValue("prodsp_metaTitle"); }
                                                    else
                                                    { echo !empty($infoSpProdItem['prodsp_metaTitle']) ? $infoSpProdItem['prodsp_metaTitle'] : null; }
                                                    /*-------------------------------*/
                                                }} ?></div>
                                                <div class="google_url">
                                                    <span class="default"><?php {{
                                                        /*----------------------------------------------*/
                                                        echo $base->getBaseURLClient();
                                                        /*----------------------------------------------*/
                                                    }} ?></span><span class="url"><?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("prodsp_seoUrl")))
                                                        { echo Validation::setValue("prodsp_seoUrl"); }
                                                        else
                                                        { echo !empty($infoSpProdItem['prodsp_seoUrl']) ? $infoSpProdItem['prodsp_seoUrl'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?></span>
                                                </div>
                                                <div class="google_desc"><?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("prodsp_metaDesc")))
                                                    { echo Validation::setValue("prodsp_metaDesc"); }
                                                    else
                                                    { echo !empty($infoSpProdItem['prodsp_metaDesc']) ? $infoSpProdItem['prodsp_metaDesc'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?></div>
                                            </div>
                                        </div>
                                        <div class="form_group seoUrl d_flex align_items_center">
                                            <label for="prodsp_seoUrl" class="form_label"><strong style="color: #f00;">*</strong> Đường dẫn SEO</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" id="prodsp_seoUrl" value="<?php {{
                                                    /*---------------------------------------*/
                                                    if(!empty(Validation::setValue("prodsp_seoUrl")))
                                                    { echo Validation::setValue("prodsp_seoUrl"); }
                                                    else
                                                    { echo !empty($infoSpProdItem['prodsp_seoUrl']) ? $infoSpProdItem['prodsp_seoUrl'] : null; }
                                                    /*---------------------------------------*/
                                                }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                <input type="hidden" name="prodsp_seoUrl" value="<?php {{
                                                    /*---------------------------------------*/
                                                    if(!empty(Validation::setValue("prodsp_seoUrl")))
                                                    { echo Validation::setValue("prodsp_seoUrl"); }
                                                    else
                                                    { echo !empty($infoSpProdItem['prodsp_seoUrl']) ? $infoSpProdItem['prodsp_seoUrl'] : null; }
                                                    /*---------------------------------------*/
                                                }} ?>">
                                                <?php {{ echo Validation::formError("prodsp_seoUrl"); }} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="data_empty_notification">Thông tin hỗ trợ này không tồn tại</p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/plugins/Ckeditor/ckeditor/ckeditor.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" ></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addProdsp.ajax.js"); }} ?>" ></script>
<script class="handle_show_tab_pane">
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
    console.log(field_id);
    handleClearImage();
}

function handleClearImage() {
    let listBtnClearSrcImg = document.querySelectorAll("[data-id-clear-img]");
    listBtnClearSrcImg.forEach(btnEl => {
        btnEl.addEventListener('click', function() {
            console.log('ok');
            let field_id = btnEl.getAttribute('data-id-clear-img');
            let imgElClear = document.querySelector("[data-src-id='"+(field_id)+"']");
            let inputElClear = document.getElementById(""+(field_id)+"");
            imgElClear.setAttribute('src',imgConfig);
            inputElClear.setAttribute('value','');
        });
    });
}

//========= ##### handle keyup word and append ##### ==========//

var metaTitleEl = document.querySelector("#prodsp_metaTitle");
var metaDescEl  = document.querySelector("#prodsp_metaDesc");
var seoUrlEl    = document.querySelector("#prodsp_seoUrl");

metaTitleEl.addEventListener('keyup', function() {
    let vl = this.value;
    let spaceAppend = document.querySelector(".google_title");
    appendKeyWord(vl, spaceAppend);
});

metaDescEl.addEventListener('keyup', function() {
    let vl = this.value;
    let spaceAppend = document.querySelector(".google_desc");
    appendKeyWord(vl, spaceAppend);
});


seoUrlEl.addEventListener('keyup', function() {
    let vl = this.value;
    let spaceAppend = document.querySelector(".google_url .url");
    document.querySelector("[name='prodsp_seoUrl']").value = slug_string(vl);
    appendKeyWord(slug_string(vl), spaceAppend);
});


function appendKeyWord(keyWord, placeAppend)
{
    placeAppend.innerText = keyWord;
}

function slug_string(str)
{
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
    str = str.replace(/-+-/g, "-");
    str = str.replace(/^\-+|\-+$/g, "");
    if (str === undefined) {
        return false;
    } else {
        return str;
    }
}

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