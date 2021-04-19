<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Module</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php {{ echo $base->getBaseURLAdmin(); }} ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thêm module</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="addModule_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Module/add">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <span>Làm mới</span>
                    </a>
                    <a class="btn_item btn_default" href="Module">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{ if(!empty($statusActionModule)) { ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionModule['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionModule['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionModule['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php } }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm module</span>
                    </h2>
                </div>
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
                                            <input type="checkbox" name="module_status" <?php {{
                                                /*--------------------------------------------*/
                                                echo Validation::setValue("module_status") == "on" ? "checked" : null;
                                                /*--------------------------------------------*/
                                            }} ?> id="status_value" class="d_none">
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="content_group">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="module_name" class="form_label"><strong style="color: #f00;">*</strong> Tên module</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="module_name" id="module_name" value="<?php {{
                                                /*----------------------------------------------------*/
                                                echo Validation::setValue("module_name");
                                                /*----------------------------------------------------*/
                                            }} ?>" placeholder="Nhập tên module" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("module_name"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="module_bg_title" class="form_label"><strong style="color: #f00;">*</strong> Background tab control</label>
                                        <div class="form_input">
                                            <input class="form_control" style="width: 100px; height: 100px;" type="color" name="module_bg_title" id="module_bg_title" value="<?php {{
                                                /*----------------------------------------------------*/
                                                echo Validation::setValue("module_bg_title");
                                                /*----------------------------------------------------*/
                                            }} ?>" placeholder="Nhập màu nền tab điều khiển" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("module_bg_title"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="module_bg_body" class="form_label"><strong style="color: #f00;">*</strong> Background body</label>
                                        <div class="form_input">
                                            <input class="form_control" style="width: 100px; height: 100px;" type="color" name="module_bg_body" id="module_bg_body" value="<?php {{
                                                /*------------------------*/
                                                echo Validation::setValue("module_bg_body");
                                                /*------------------------*/
                                            }} ?>" placeholder="Nhập màu nền nội dung" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("module_bg_body"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="module_metaTitle" class="form_label"><strong style="color: #f00;">*</strong> Thẻ tiêu đề (Meta title)</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" value="<?php {{
                                                /*------------------------------------*/
                                                echo Validation::setValue("module_metaTitle");
                                                /*------------------------------------*/
                                            }} ?>" name="module_metaTitle" id="module_metaTitle" placeholder="Thẻ tiêu đề ( Meta title )" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("module_metaTitle"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="module_metaDesc" class="form_label"><strong style="color: #f00;">*</strong> Thẻ mô tả (Meta desc)</label>
                                        <div class="form_input">
                                            <textarea class="form_control" name="module_metaDesc" id="module_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_metaDesc");
                                                /*--------------------------------------*/
                                            }} ?></textarea>
                                            <?php {{ echo Validation::formError("module_metaDesc"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="module_keyword" class="form_label"><strong style="color: #f00;">*</strong> Từ khóa</label>
                                        <div class="form_input">
                                            <textarea class="form_control" name="module_keyword" id="module_keyword" placeholder="Từ khóa về module" spellcheck="false"><?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_keyword");
                                                /*--------------------------------------*/
                                            }} ?></textarea>
                                            <?php {{ echo Validation::formError("module_keyword"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                        <div class="form_input">
                                            <div class="google_title"><?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_metaTitle");
                                                /*--------------------------------------*/
                                            }} ?></div>
                                            <div class="google_url">
                                                <span class="default"><?php {{
                                                    /*----------------------------------------------*/
                                                    echo $base->getBaseURLClient();
                                                    /*----------------------------------------------*/
                                                }} ?></span><span class="url"><?php {{
                                                    /*--------------------------------------*/
                                                    echo Validation::setValue("module_seoUrl");
                                                    /*--------------------------------------*/
                                                }} ?></span>
                                            </div>
                                            <div class="google_desc"><?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_metaDesc");
                                                /*--------------------------------------*/
                                            }} ?></div>
                                        </div>
                                    </div>
                                    <div class="form_group seoUrl d_flex align_items_center">
                                        <label for="module_seoUrl" class="form_label"><strong style="color: #f00;">*</strong> Đường dẫn SEO</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" id="module_seoUrl" value="<?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_seoUrl");
                                                /*--------------------------------------*/
                                            }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                            <input type="hidden" name="module_seoUrl" value="<?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_seoUrl");
                                                /*--------------------------------------*/
                                            }} ?>">
                                            <?php {{ echo Validation::formError("module_seoUrl"); }} ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_pane" id="tab_data">
                                <div class="form_group d_flex align_items_center">
                                    <label for="module_bannerPc" class="form_label"><strong style="color: #f00;">*</strong> Banner PC</label>
                                    <div class="form_input">
                                        <label for="module_bannerPc">
                                            <input type="hidden" id="module_bannerPc" name="module_bannerPc" value="<?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_bannerPc");
                                                /*--------------------------------------*/
                                            }} ?>">
                                            <span class="thumbNail banner __PC">
                                                <img class="img_cover full_size" src="<?php {{
                                                    /*--------------------------------------*/
                                                    echo !empty(Validation::setValue("module_bannerPc")) ? Validation::setValue("module_bannerPc") : "./public/images/logo/no_image-50x50.png";
                                                    /*--------------------------------------*/
                                                }} ?>" data-src-id="module_bannerPc" alt="">
                                            </span>
                                        </label>
                                        <div class="popover" style="transform: translate(0)">
                                            <div class="popover_content d_flex align_items_center">
                                                <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=module_bannerPc" type="button" data-id-input-image="module_bannerPc" class="button_image btn btn_primary iframe-btn" title="Thêm banner module PC">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <button type="button" data-id-clear-img="module_bannerPc" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <?php {{ echo Validation::formError("module_bannerPc"); }} ?>
                                    </div>
                                </div>
                                <div class="form_group d_flex align_items_center">
                                    <label for="module_bannerMb" class="form_label"><strong style="color: #f00;">*</strong> Banner Mobile</label>
                                    <div class="form_input">
                                        <label for="module_bannerMb">
                                            <input type="hidden" id="module_bannerMb" name="module_bannerMb" value="<?php {{
                                                /*--------------------------------------*/
                                                echo Validation::setValue("module_bannerMb");
                                                /*--------------------------------------*/
                                            }} ?>">
                                            <span class="thumbNail banner __mobile">
                                                <img class="img_cover full_size" data-src-id="module_bannerMb" src="<?php {{
                                                    /*--------------------------------------*/
                                                    echo !empty(Validation::setValue("module_bannerMb")) ? Validation::setValue("module_bannerMb") : "./public/images/logo/no_image-50x50.png";
                                                    /*--------------------------------------*/
                                                }} ?>" alt="">
                                            </span>
                                        </label>
                                        <div class="popover" style="transform: translate(0)">
                                            <div class="popover_content d_flex align_items_center">
                                                <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=module_bannerMb" type="button" data-id-input-image="module_bannerMb" class="button_image btn btn_primary iframe-btn" title="Thêm banner module banner MB">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <button type="button" data-id-clear-img="module_bannerMb" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <?php {{ echo Validation::formError("module_bannerMb"); }} ?>
                                    </div>
                                </div>
                                <div class="form_group d_flex align_items_center">
                                    <label for="brand_order" class="form_label">Thứ tự lớn hiện tại</label>
                                    <div class="form_input">
                                        <input type="text" disabled="" class="form_control" id="orderMax_current" style="width: 50px; margin-bottom: 5px;" value="">
                                    </div>
                                </div>
                                <div class="form_group d_flex align_items_center">
                                    <label for="module_order" class="form_label">Thứ tự</label>
                                    <div class="form_input">
                                        <input class="form_control" type="number" name="module_order" id="module_order" value="<?php {{
                                            /*--------------------------------------*/
                                            echo Validation::setValue("module_order");
                                            /*--------------------------------------*/
                                        }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" ></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addModule.ajax.js"); }} ?>" ></script>
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

var metaTitleEl = document.querySelector("#module_metaTitle");
var metaDescEl  = document.querySelector("#module_metaDesc");
var seoUrlEl    = document.querySelector("#module_seoUrl");

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
    document.querySelector("[name='module_seoUrl']").value = slug_string(vl);
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