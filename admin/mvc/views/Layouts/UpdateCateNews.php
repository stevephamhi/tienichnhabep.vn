<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Danh mục tin tức</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php {{ echo $base->getBaseURLAdmin(); }} ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Cập nhật danh mục tin tức</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($cateNewsItem) ? "disabled" : null; }} ?> name="updateCateNews_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="CateNews">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{
            if(!empty($statusActionCateNews)) { ?>
                <div class="alert_wrap">
                    <div class="alert alert_<?php {{ echo $statusActionCateNews['status']; }}
                        ?> position_relative" data-status="<?php {{
                            if(!empty($statusActionCateNews['status']))
                            { echo "true"; }; }}
                        ?>">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span><?php {{ echo $statusActionCateNews['notifiTxt']; }} ?></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
        <?php }  }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Cập nhật danh mục tin tức</span>
                    </h2>
                </div>
                <?php {{ if(!empty($cateNewsItem)) { ?>
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
                                                <input type="checkbox" id="status_value" name="cateNews_status" <?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_status")))
                                                    { echo Validation::setValue("cateNews_status") == 'on' ? "checked" : null; }
                                                    else
                                                    { echo $cateNewsItem['cateNews_status'] == 'on' ? 'checked' : null; }
                                                    /*------------------------------------------------*/
                                                }} ?> class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateNews_name" class="form_label"><strong style="color: #f00;">*</strong> Tên danh mục</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="cateNews_name" id="cateNews_name" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_name")))
                                                    { echo Validation::setValue("cateNews_name"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_name']) ? $cateNewsItem['cateNews_name'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>" placeholder="Nhập tên danh mục" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("cateNews_name"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateNews_desc" class="form_label">Mô tả</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="cateNews_desc" id="cateNews_desc" style="height: 300px;" placeholder="Mô tả danh mục" spellcheck="false"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_desc")))
                                                    { echo Validation::setValue("cateNews_desc"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_desc']) ? $cateNewsItem['cateNews_desc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateNews_metaTitle" class="form_label"><strong style="color: #f00;">*</strong> Thẻ tiêu đề (Meta title)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="cateNews_metaTitle" id="cateNews_metaTitle" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_metaTitle")))
                                                    { echo Validation::setValue("cateNews_metaTitle"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_metaTitle']) ? $cateNewsItem['cateNews_metaTitle'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("cateNews_metaTitle"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="cateNews_metaDesc" class="form_label"><strong style="color: #f00;">*</strong> Thẻ mô tả (Meta desc)</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="cateNews_metaDesc" id="cateNews_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_metaDesc")))
                                                    { echo Validation::setValue("cateNews_metaDesc"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_metaDesc']) ? $cateNewsItem['cateNews_metaDesc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("cateNews_metaDesc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                            <div class="form_input">
                                                <div class="google_title"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_metaTitle")))
                                                    { echo Validation::setValue("cateNews_metaTitle"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_metaTitle']) ? $cateNewsItem['cateNews_metaTitle'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></div>
                                                <div class="google_url">
                                                    <span class="default"><?php {{
                                                    /*----------------------------------------------*/
                                                    echo $base->getBaseURLClient();
                                                    /*----------------------------------------------*/
                                                    }} ?>/</span>
                                                    <span class="url"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_seoUrl")))
                                                    { echo Validation::setValue("cateNews_seoUrl"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_seoUrl']) ? $cateNewsItem['cateNews_seoUrl'] : null; }
                                                    /*------------------------------------------------*/
                                                    }} ?></span>
                                                </div>
                                                <div class="google_desc"><?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_metaDesc")))
                                                    { echo Validation::setValue("cateNews_metaDesc"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_metaDesc']) ? $cateNewsItem['cateNews_metaDesc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?></div>
                                            </div>
                                        </div>
                                        <div class="form_group seoUrl d_flex align_items_center">
                                            <label for="cateNews_seoUrl" class="form_label"><strong style="color: #f00;">*</strong> Đường dẫn SEO</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" id="cateNews_seoUrl" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_seoUrl")))
                                                    { echo Validation::setValue("cateNews_seoUrl"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_seoUrl']) ? $cateNewsItem['cateNews_seoUrl'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                <input type="hidden" name="cateNews_seoUrl" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_seoUrl")))
                                                    { echo Validation::setValue("cateNews_seoUrl"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_seoUrl']) ? $cateNewsItem['cateNews_seoUrl'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>">
                                                <?php {{ echo Validation::formError("cateNews_seoUrl"); }} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_data">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateNews_parentId" class="form_label">Danh mục cha</label>
                                        <div class="form_input">
                                            <select class="form_control" name="cateNews_parentId" id="cateNews_parentId">
                                                <?php {{
                                                    if(!empty($listCateNews))
                                                    { ?>
                                                        <option value="">--- Chọn ---</option>
                                                    <?php
                                                    foreach($listCateNews as $__cateNewsItem__) { ?>
                                                        <option <?php {{
                                                            /*---------------- Select status -----------------*/
                                                            if(!empty(Validation::setValue("cateNews_parentId")))
                                                            { echo Validation::setValue("cateNews_parentId") == $__cateNewsItem__['cateNews_id'] ? "selected" : null; }
                                                            else
                                                            { echo $__cateNewsItem__['cateNews_id'] == $cateNewsItem['cateNews_parentId'] ? "selected" : null; }
                                                            /*--------------------- Value --------------------*/
                                                        }} ?> value="<?php {{
                                                            /*------------------------------------------------*/
                                                            echo $__cateNewsItem__['cateNews_id'];
                                                            /*------------------------------------------------*/
                                                        }} ?>"><?php {{
                                                            /*-------------------- Content -------------------*/
                                                            echo str_repeat("-----", $__cateNewsItem__['level']).' '.$__cateNewsItem__['cateNews_name'];
                                                            /*------------------------------------------------*/
                                                        }} ?></option>
                                                    <?php }
                                                    }  else { ?>
                                                        <option value="">--- Chưa có danh mục tin tức ---</option>
                                                    <?php } }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateNews_bannerPc" class="form_label">Banner PC</label>
                                        <div class="form_input">
                                            <label for="cateNews_bannerPc">
                                                <input type="hidden" id="cateNews_bannerPc" name="cateNews_bannerPc" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_bannerPc")))
                                                    { echo Validation::setValue("cateNews_bannerPc"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_bannerPc']) ? $cateNewsItem['cateNews_bannerPc'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>">
                                                <span class="thumbNail banner __PC">
                                                    <img data-src-id="cateNews_bannerPc" class="img_cover full_size" src="<?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("cateNews_bannerPc")))
                                                        { echo Validation::setValue("cateNews_bannerPc"); }
                                                        else
                                                        { echo !empty($cateNewsItem['cateNews_bannerPc']) ? $cateNewsItem['cateNews_bannerPc'] : "./public/images/logo/no_image-50x50.png"; }
                                                        /*------------------------------------------------*/
                                                    }} ?>" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=cateNews_bannerPc" type="button" data-id-input-image="cateNews_bannerPc" class="button_image btn btn_primary iframe-btn" title="Thêm banner PC cho danh mục bài viết">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="cateNews_bannerPc" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateNews_bannerMb" class="form_label">Banner Mobile</label>
                                        <div class="form_input">
                                            <label for="cateNews_bannerMb">
                                                <input type="hidden" id="cateNews_bannerMb" name="cateNews_bannerMb" value="<?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("cateNews_bannerMb")))
                                                    { echo Validation::setValue("cateNews_bannerMb"); }
                                                    else
                                                    { echo !empty($cateNewsItem['cateNews_bannerMb']) ? $cateNewsItem['cateNews_bannerMb'] : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>">
                                                <span class="thumbNail banner __mobile">
                                                    <img class="img_cover full_size" data-src-id="cateNews_bannerMb" src="<?php {{
                                                        /*------------------------------------------------*/
                                                        if(!empty(Validation::setValue("cateNews_bannerMb")))
                                                        { echo Validation::setValue("cateNews_bannerMb"); }
                                                        else
                                                        { echo !empty($cateNewsItem['cateNews_bannerMb']) ? $cateNewsItem['cateNews_bannerMb'] : "./public/images/logo/no_image-50x50.png"; }
                                                        /*------------------------------------------------*/
                                                    }} ?>" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=cateNews_bannerMb" type="button" data-id-input-image="cateNews_bannerMb" class="button_image btn btn_primary iframe-btn" title="Thêm banner mobile cho danh mục bài viết">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="cateNews_bannerMb" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateNews_order" class="form_label">Thứ tự</label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="cateNews_order" id="cateNews_order" value="<?php {{
                                                /*------------------------------------------------*/
                                                if(!empty(Validation::setValue("cateNews_order")))
                                                { echo Validation::setValue("cateNews_order"); }
                                                else
                                                { echo !empty($cateNewsItem['cateNews_order']) ? $cateNewsItem['cateNews_order'] : null; }
                                                /*------------------------------------------------*/
                                            }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                            <span class="note">* Mặc định lấy số thứ tự lớn nhất trong dữ liệu cộng thêm 1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } else { ?> <p class="data_empty_notification">Danh mục tin tức này không tồn tại</p> <?php } }} ?>
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
<script type="text/javascript" class="filemanager">
    tinymce.init({
        selector: 'textarea#cateNews_desc',
        plugins: 'insertdatetime a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments',
        toolbar: 'insertdatetime undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullpage | ' +
                'forecolor backcolor emoticons | help',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        menubar: 'favs file edit view insert format tools table help',
        menu: {
            file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
            edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
            view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
            insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
            tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
            table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
            help: { title: 'Help', items: 'help' }
        },
        formats: {
            alignleft: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
            aligncenter: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
            alignright: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
            alignjustify: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
            bold: {inline : 'span', 'classes' : 'bold'},
            italic: {inline : 'span', 'classes' : 'italic'},
            underline: {inline : 'span', 'classes' : 'underline', exact : true},
            strikethrough: {inline : 'del'},
            forecolor: {inline : 'span', classes : 'forecolor', styles : {color : '%value'}},
            hilitecolor: {inline : 'span', classes : 'hilitecolor', styles : {backgroundColor : '%value'}},
            custom_format: {block : 'h1', attributes : {title : 'Header'}, styles : {color : 'red'}}
        },
        insertdatetime_dateformat: '%Y-%m-%d'
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

var metaTitleEl = document.querySelector("#cateNews_metaTitle");
var metaDescEl  = document.querySelector("#cateNews_metaDesc");
var seoUrlEl    = document.querySelector("#cateNews_seoUrl");

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
    document.querySelector("[name='cateNews_seoUrl']").value = slug_string(vl);
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