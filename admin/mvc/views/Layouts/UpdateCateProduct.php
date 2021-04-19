<?php {{ $base =  new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Danh mục sản phẩm</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="Home">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Cập nhật danh mục</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($cateProdItem) ? "disabled" : null ; }} ?> name="updateCateProd_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Cập nhật</span>
                    </button>
                    <a class="btn_item btn_default" href="CateProduct">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="alert_wrap">
            <div class="alert alert_<?php {{ echo $statusActionCateProd['status']; }}
                ?> position_relative" data-status="<?php {{
                    if(!empty($statusActionCateProd['status']))
                    { echo "true"; };
                }} ?>">
                <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                <span><?php {{ echo $statusActionCateProd['notifiTxt']; }} ?></span>
                <button type="button" class="close position_absolute">x</button>
            </div>
        </div>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Cập nhật danh mục</span>
                    </h2>
                </div>
                <?php if( !empty($cateProdItem) ) : ?>
                    <div class="panel_body">
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
                                            <label for="status_value" class="status_toogle">
                                                <input type="checkbox" name="cateProd_status"<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_status")))
                                                    { echo Validation::setValue("cateProd_status") == 'on' ? "checked" : null; }
                                                    else
                                                    { echo $cateProdItem['cateProd_status'] == 'on' ? 'checked' : null; }
                                                    /*------------------------------------------------*/
                                                }} ?> id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateProd_name" class="form_label"><strong style="color: #f00;">*</strong> Tên danh mục</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="cateProd_name" id="cateProd_name" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_name")))
                                                    { echo Validation::setValue("cateProd_name"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_name']) ? $cateProdItem['cateProd_name'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>" placeholder="Nhập tên danh mục" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("cateProd_name"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateProd_desc" class="form_label">Mô tả</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="cateProd_desc" id="cateProd_desc" style="height: 300px;" placeholder="Mô tả danh mục" spellcheck="false"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_desc")))
                                                    { echo Validation::setValue("cateProd_desc"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_desc']) ? $cateProdItem['cateProd_desc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateProd_keyword" class="form_label"><strong style="color: #f00;">*</strong> Từ khóa danh mục</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="cateProd_keyword" id="cateProd_keyword" placeholder="Từ khóa cho danh mục" spellcheck="false"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_keyword")))
                                                    { echo Validation::setValue("cateProd_keyword"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_keyword']) ? $cateProdItem['cateProd_keyword'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("cateProd_keyword"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateProd_metaTitle" class="form_label">Thẻ tiêu đề (Meta title)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="cateProd_metaTitle" id="cateProd_metaTitle" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_metaTitle")))
                                                    { echo Validation::setValue("cateProd_metaTitle"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_metaTitle']) ? $cateProdItem['cateProd_metaTitle'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("cateProd_metaTitle"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateProd_metaDesc" class="form_label">Thẻ mô tả (Meta desc)</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="cateProd_metaDesc" id="cateProd_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_metaDesc")))
                                                    { echo Validation::setValue("cateProd_metaDesc"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_metaDesc']) ? $cateProdItem['cateProd_metaDesc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("cateProd_metaDesc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                            <div class="form_input">
                                                <div class="google_title"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_metaTitle")))
                                                    { echo Validation::setValue("cateProd_metaTitle"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_metaTitle']) ? $cateProdItem['cateProd_metaTitle'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></div>
                                                <div class="google_url">
                                                    <span class="default"><?php {{
                                                    /*------------------------------------------------*/
                                                    echo $base->getBaseURLClient();
                                                    /*------------------------------------------------*/
                                                    }} ?></span>
                                                    <span class="url"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_seoUrl")))
                                                    { echo Validation::setValue("cateProd_seoUrl"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_seoUrl']) ? $cateProdItem['cateProd_seoUrl'] : null; }
                                                    /*------------------------------------------------*/
                                                    }} ?></span>
                                                </div>
                                                <div class="google_desc"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_metaDesc")))
                                                    { echo Validation::setValue("cateProd_metaDesc"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_metaDesc']) ? $cateProdItem['cateProd_metaDesc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></div>
                                            </div>
                                        </div>
                                        <div class="form_group cateProd_seo_url d_flex align_items_center">
                                            <label for="cateProd_seoUrl" class="form_label">Đường dẫn SEO</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" id="cateProd_seoUrl" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_seoUrl")))
                                                    { echo Validation::setValue("cateProd_seoUrl"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_seoUrl']) ? $cateProdItem['cateProd_seoUrl'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                <input type="hidden" name="cateProd_seoUrl" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_seoUrl")))
                                                    { echo Validation::setValue("cateProd_seoUrl"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_seoUrl']) ? $cateProdItem['cateProd_seoUrl'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>">
                                                <?php {{ echo Validation::formError("cateProd_seoUrl"); }} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_data">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_parentId" class="form_label">Danh mục cha</label>
                                        <div class="form_input">
                                            <select class="form_control" name="cateProd_parentId" id="cateProd_parentId">
                                                <?php {{
                                                    if(!empty($listCateProd))
                                                    { ?>
                                                        <option value="">--- Chọn ---</option>
                                                    <?php
                                                    foreach($listCateProd as $__cateProdItem__) { ?>
                                                        <option <?php {{
                                                            /*---------------- Select status -----------------*/
                                                            if(!empty(Validation::setValue("cateProd_parentId")))
                                                            { echo Validation::setValue("cateProd_parentId") == $__cateProdItem__['cateProd_id'] ? "selected" : null; }
                                                            else
                                                            { echo $__cateProdItem__['cateProd_id'] == $cateProdItem['cateProd_parentId'] ? "selected" : null; }
                                                            /*--------------------- Value --------------------*/
                                                        }} ?> value="<?php {{
                                                            /*------------------------------------------------*/
                                                            echo $__cateProdItem__['cateProd_id'];
                                                            /*------------------------------------------------*/
                                                        }} ?>"><?php {{
                                                            /*-------------------- Content -------------------*/
                                                            echo str_repeat("-----", $__cateProdItem__['level']).' '.$__cateProdItem__['cateProd_name'];
                                                            /*------------------------------------------------*/
                                                        }} ?></option>
                                                    <?php }
                                                    }  else { ?>
                                                        <option value="">--- Chưa có danh mục sản phẩm ---</option>
                                                    <?php } }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_image" class="form_label">Mini icon</label>
                                        <div class="form_input">
                                            <label for="cateProd_image">
                                                <input type="hidden" id="cateProd_image" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_image")))
                                                    { echo Validation::setValue("cateProd_image"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_image']) ? $cateProdItem['cateProd_image'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>" name="cateProd_image">
                                                <span class="thumbNail small">
                                                    <img class="img_cover full_size" data-src-id="cateProd_image" src="<?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("cateProd_image")))
                                                        { echo Validation::setValue("cateProd_image"); }
                                                        else
                                                        { echo !empty($cateProdItem['cateProd_image']) ? $cateProdItem['cateProd_image'] : "./public/images/logo/no_image-50x50.png"; }
                                                        /*------------------------------------------------*/
                                                    }} ?>" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=cateProd_image" type="button" data-id-input-image="cateProd_image" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh hãnh sản xuất">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="cateProd_image" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("cateProd_image"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_bannerPc" class="form_label">Banner PC</label>
                                        <div class="form_input">
                                            <label for="cateProd_bannerPc">
                                                <input type="hidden" id="cateProd_bannerPc" name="cateProd_bannerPc" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_bannerPc")))
                                                    { echo Validation::setValue("cateProd_bannerPc"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_bannerPc']) ? $cateProdItem['cateProd_bannerPc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>">
                                                <span class="thumbNail banner __PC">
                                                    <img class="img_cover full_size" src="<?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("cateProd_bannerPc")))
                                                        { echo Validation::setValue("cateProd_bannerPc"); }
                                                        else
                                                        { echo !empty($cateProdItem['cateProd_bannerPc']) ? $cateProdItem['cateProd_bannerPc'] : "./public/images/logo/no_image-50x50.png"; }
                                                        /*------------------------------------------------*/
                                                    }} ?>" data-src-id="cateProd_bannerPc" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=cateProd_bannerPc" type="button" data-id-input-image="cateProd_bannerPc" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh hãnh sản xuất">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="cateProd_bannerPc" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("cateProd_bannerPc"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_bannerMb" class="form_label">Banner Mobile</label>
                                        <div class="form_input">
                                            <label for="cateProd_bannerMb">
                                                <input type="hidden" id="cateProd_bannerMb" name="cateProd_bannerMb" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateProd_bannerMb")))
                                                    { echo Validation::setValue("cateProd_bannerMb"); }
                                                    else
                                                    { echo !empty($cateProdItem['cateProd_bannerMb']) ? $cateProdItem['cateProd_bannerMb'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>">
                                                <span class="thumbNail banner __mobile">
                                                    <img class="img_cover full_size" data-src-id="cateProd_bannerMb" src="<?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("cateProd_bannerMb")))
                                                        { echo Validation::setValue("cateProd_bannerMb"); }
                                                        else
                                                        { echo !empty($cateProdItem['cateProd_bannerMb']) ? $cateProdItem['cateProd_bannerMb'] : "./public/images/logo/no_image-50x50.png"; }
                                                        /*------------------------------------------------*/
                                                    }} ?>" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=cateProd_bannerMb" type="button" data-id-input-image="cateProd_bannerMb" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh hãnh sản xuất">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="cateProd_bannerMb" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("cateProd_bannerMb"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_order" class="form_label">Thứ tự</label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="cateProd_order" id="cateProd_order" value="<?php {{
                                                /*------------------------------------------------*/
                                                if(!empty(Validation::setValue("cateProd_order")))
                                                { echo Validation::setValue("cateProd_order"); }
                                                else
                                                { echo !empty($cateProdItem['cateProd_order']) ? $cateProdItem['cateProd_order'] : null; }
                                                /*------------------------------------------------*/
                                            }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                            <span class="note">* Mặc định lấy số thứ tự lớn nhất trong dữ liệu cộng thêm 1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <p class="data_empty_notification">Danh mục sản phẩm này không tồn tại</p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/plugins/Ckeditor/ckeditor/ckeditor.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" ></script>

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

var metaTitleEl = document.querySelector("#cateProd_metaTitle");
var metaDescEl  = document.querySelector("#cateProd_metaDesc");
var seoUrlEl    = document.querySelector("#cateProd_seoUrl");

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
    document.querySelector("[name='cateProd_seoUrl']").value = slug_string(vl);
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