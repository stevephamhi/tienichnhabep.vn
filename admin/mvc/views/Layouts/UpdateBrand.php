<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Thương hiệu</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php echo $base->getBaseURLAdmin(); ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Cập nhật thương hiệu</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="updateBrand_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Cập nhật</span>
                    </button>
                    <a class="btn_item btn_default" href="Brand">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <?php if(!empty($statusActionBrand)) : ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionBrand['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionBrand['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionBrand['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php endif; ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Cập nhật thương hiệu</span>
                    </h2>
                </div>
                <?php if(!empty($brandItem)) : ?>
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
                                                    <input type="checkbox" id="status_value" name="brand_status" <?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_status")))
                                                        { echo Validation::setValue("brand_status") == 'on' ? "checked" : null; }
                                                        else
                                                        { echo $brandItem['brand_status'] == 'on' ? 'checked' : null; }
                                                        /*------------------------------------------------*/
                                                    }} ?> class="d_none">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_name" class="form_label"><strong style="color: #f00;">*</strong> Tên hãng sản xuất</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="brand_name" id="brand_name" value="<?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_name")))
                                                        { echo Validation::setValue("brand_name"); }
                                                        else
                                                        { echo !empty($brandItem['brand_name']) ? $brandItem['brand_name'] : null; }
                                                        /*------------------------------------------------*/
                                                    }} ?>" placeholder="Tên hãng sản xuất [ Thương hiệu ]" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("brand_name"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_keywords" class="form_label">
                                                    <span>Từ khóa</span>
                                                    <i class="fa fa-question-circle" title="Không sử dụng khoảng trống, nếu cần hãy sử dụng dấu - , Ví dụ: Apple." style="color: #1E91CF;" aria-hidden="true"></i>
                                                </label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="brand_keywords" id="brand_keywords" value="<?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_keywords")))
                                                        { echo Validation::setValue("brand_keywords"); }
                                                        else
                                                        { echo !empty($brandItem['brand_keywords']) ? $brandItem['brand_keywords'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?>" placeholder="Từ khóa" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("brand_keywords"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_image" class="form_label"><strong style="color: #f00;">*</strong> Hình ảnh</label>
                                                <div class="form_input position_relative">
                                                    <label for="prod_avatar">
                                                        <input type="hidden" id="brand_image" name="brand_image" value="<?php {{
                                                            /*------------------------------------------------*/
                                                            if(!empty(Validation::setValue("brand_image")))
                                                            { echo Validation::setValue("brand_image"); }
                                                            else
                                                            { echo !empty($brandItem['brand_image']) ? $brandItem['brand_image'] : null; }
                                                            /*------------------------------------------------*/
                                                        }} ?>">
                                                        <span class="thumbNail small">
                                                            <img data-src-id="brand_image" class="img_cover full_size" src="<?php {{
                                                                /*------------------------------------------------*/
                                                                if(!empty(Validation::setValue("brand_image")))
                                                                { echo Validation::setValue("brand_image"); }
                                                                else
                                                                { echo !empty($brandItem['brand_image']) ? $brandItem['brand_image'] : "./public/images/logo/no_image-50x50.png"; }
                                                                /*------------------------------------------------*/
                                                            }} ?>" alt="">
                                                        </span>
                                                        <div class="popover position_absolute" style="left: 155px;">
                                                            <div class="popover_content d_flex align_items_center">
                                                                <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=brand_image" type="button" data-id-input-image="brand_image" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh hãnh sản xuất">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <button type="button" data-id-clear-img="brand_image" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <?php {{ echo Validation::formError("brand_image"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_order" class="form_label">Thứ tự lớn nhất</label>
                                                <div class="form_input">
                                                    <input type="text" disabled class="form_control" id="orderMax_current" style="width: 50px; margin-bottom: 5px;" value="">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_order" class="form_label">Sắp xếp</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="number" name="brand_order" id="brand_order" value="<?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_order")))
                                                        { echo Validation::setValue("brand_order"); }
                                                        else
                                                        { echo !empty($brandItem['brand_order']) ? $brandItem['brand_order'] : null; }
                                                        /*------------------------------------------------*/
                                                    }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_metaImg" class="form_label"><strong style="color: #f00;">*</strong> Thẻ meta hình ảnh</label>
                                                <div class="form_input position_relative">
                                                    <label for="prod_avatar">
                                                        <input type="hidden" id="brand_metaImg" name="brand_metaImg" value="<?php {{
                                                            /*----------------------------------------------*/
                                                            if(!empty(Validation::setValue("brand_metaImg")))
                                                            { echo Validation::setValue("brand_metaImg"); }
                                                            else
                                                            { echo !empty($brandItem['brand_metaImg']) ? $brandItem['brand_metaImg'] : null; }
                                                            /*----------------------------------------------*/
                                                        }} ?>">
                                                        <span>300x300</span>
                                                        <span class="thumbNail small" style="width: 300px; height: 300px;">
                                                            <img id="prod_avatar_src" data-src-id="brand_metaImg" class="img_cover full_size" src="<?php {{
                                                                /*----------------------------------------------*/
                                                                if(!empty(Validation::setValue("brand_metaImg")))
                                                                { echo Validation::setValue("brand_metaImg"); }
                                                                else
                                                                { echo !empty($brandItem['brand_metaImg']) ? $brandItem['brand_metaImg'] : "/public/images/logo/no_image-50x50.png"; }
                                                                /*----------------------------------------------*/
                                                            }} ?>" alt="">
                                                        </span>
                                                        <div class="popover position_absolute" style="left: 300px;">
                                                            <div class="popover_content d_flex align_items_center">
                                                                <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=brand_metaImg" type="button" data-id-input-image="brand_metaImg" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh hãnh sản xuất">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <button type="button" data-id-clear-img="brand_metaImg" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <?php {{ echo Validation::formError("brand_metaImg"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_metaTitle" class="form_label"><strong style="color: #f00;">*</strong> Thẻ tiêu đề (Meta title)</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="brand_metaTitle" id="brand_metaTitle" value="<?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_metaTitle")))
                                                        { echo Validation::setValue("brand_metaTitle"); }
                                                        else
                                                        { echo !empty($brandItem['brand_metaTitle']) ? $brandItem['brand_metaTitle'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("brand_metaTitle"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_metaDesc" class="form_label"><strong style="color: #f00;">*</strong> Thẻ mô tả (Meta desc)</label>
                                                <div class="form_input">
                                                    <textarea class="form_control" name="brand_metaDesc" id="brand_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_metaDesc")))
                                                        { echo Validation::setValue("brand_metaDesc"); }
                                                        else
                                                        { echo !empty($brandItem['brand_metaDesc']) ? $brandItem['brand_metaDesc'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?></textarea>
                                                    <?php {{ echo Validation::formError("brand_metaDesc"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                                <div class="form_input">
                                                    <div class="google_title"><?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_metaTitle")))
                                                        { echo Validation::setValue("brand_metaTitle"); }
                                                        else
                                                        { echo !empty($brandItem['brand_metaTitle']) ? $brandItem['brand_metaTitle'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?></div>
                                                    <div class="google_url">
                                                        <span class="default"><?php {{
                                                            /*----------------------------------------------*/
                                                            echo $base->getBaseURLClient();
                                                            /*----------------------------------------------*/
                                                        }} ?></span><span class="url"><?php {{
                                                            /*----------------------------------------------*/
                                                            if(!empty(Validation::setValue('brand_seoUrl')))
                                                            { echo Validation::setValue("brand_seoUrl"); }
                                                            else
                                                            { echo !empty($brandItem['brand_seoUrl']) ? $brandItem['brand_seoUrl'] : null; }
                                                            /*----------------------------------------------*/
                                                        }} ?></span>
                                                    </div>
                                                    <div class="google_desc"><?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_metaDesc")))
                                                        { echo Validation::setValue("brand_metaDesc"); }
                                                        else
                                                        { echo !empty($brandItem['brand_metaDesc']) ? $brandItem['brand_metaDesc'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?></div>
                                                </div>
                                            </div>
                                            <div class="form_group seoUrl d_flex align_items_center">
                                                <label for="brand_seoUrl" class="form_label"><strong style="color: #f00;">*</strong> Đường dẫn SEO</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" id="brand_seoUrl" value="<?php {{
                                                        /*----------------------------------------------*/
                                                       if(!empty(Validation::setValue("brand_seoUrl")))
                                                       {  echo Validation::setValue("brand_seoUrl"); }
                                                       else
                                                       { echo !empty($brandItem['brand_seoUrl']) ? $brandItem['brand_seoUrl'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                    <input type="hidden" name="brand_seoUrl" value="<?php {{
                                                        /*----------------------------------------------*/
                                                       if(!empty(Validation::setValue("brand_seoUrl")))
                                                       {  echo Validation::setValue("brand_seoUrl"); }
                                                       else
                                                       { echo !empty($brandItem['brand_seoUrl']) ? $brandItem['brand_seoUrl'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?>">
                                                    <?php {{ echo Validation::formError("brand_seoUrl"); }} ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_data">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="brand_banner" class="form_label">Banner PC</label>
                                            <div class="form_input">
                                                <span>970 x 285 (px)</span>
                                                <label for="brand_banner">
                                                    <input type="hidden" id="brand_banner" name="brand_banner" value="<?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("brand_banner")))
                                                        { echo Validation::setValue("brand_banner"); }
                                                        else
                                                        { echo !empty($brandItem['brand_banner']) ? $brandItem['brand_banner'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?>">
                                                    <span class="thumbNail banner __PC">
                                                        <img class="img_cover full_size" src="<?php {{
                                                            /*----------------------------------------------*/
                                                            if(!empty(Validation::setValue("brand_banner"))) {
                                                                echo Validation::setValue("brand_banner");
                                                            } else {
                                                                echo !empty($brandItem['brand_banner']) ? $brandItem['brand_banner'] : "./public/images/logo/no_image-50x50.png";
                                                            }
                                                            /*----------------------------------------------*/
                                                        }} ?>" data-src-id="brand_banner" alt="">
                                                    </span>
                                                </label>
                                                <div class="popover" style="transform: translate(0)">
                                                    <div class="popover_content d_flex align_items_center">
                                                        <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=brand_banner" type="button" data-id-input-image="brand_banner" class="button_image btn btn_primary iframe-btn" title="Thêm banner thương hiệu">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <button type="button" data-id-clear-img="brand_banner" class="button_clear btn btn_danger" title="Xóa banner này">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else : ?>
                    <p class="data_empty_notification">Thương hiệu này không tồn tại</p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addBrand.ajax.js"); }} ?>"></script>
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

//========= ##### handle keyup word and append ##### ==========//
var metaTitleEl = document.querySelector("#brand_metaTitle");
var metaDescEl  = document.querySelector("#brand_metaDesc");
var seoUrlEl    = document.querySelector("#brand_seoUrl");

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
    document.querySelector("[name='brand_seoUrl']").value = slug_string(vl);
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