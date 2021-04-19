<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Danh mục sản phẩm</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php {{ echo $base->getBaseURLAdmin(); }} ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thêm danh mục</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="addCateProd_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="CateProduct/add">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <span>Làm mới</span>
                    </a>
                    <a class="btn_item btn_default" href="CateProduct">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{ if(!empty($statusActionCateProd)) { ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionCateProd['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionCateProd['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionCateProd['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php } }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm danh mục</span>
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
                                            <input type="checkbox" name="cateProd_status" <?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_status") == 'on' ? "checked" :  null;
                                                /*----------------------------------------------*/
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
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_name");
                                                /*----------------------------------------------*/
                                            }} ?>" placeholder="Nhập tên danh mục" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("cateProd_name"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_desc" class="form_label">Mô tả</label>
                                        <div class="form_input">
                                            <textarea class="form_control ckeditor" name="cateProd_desc" id="cateProd_desc" style="height: 300px;" placeholder="Mô tả danh mục" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_desc");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <?php {{ echo Validation::formError("cateProd_desc"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_keyword" class="form_label"><strong style="color: #f00;">*</strong> Từ khóa danh mục</label>
                                        <div class="form_input">
                                            <textarea class="form_control" name="cateProd_keyword" id="cateProd_keyword" placeholder="Từ khóa cho danh mục" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_keyword");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <?php {{ echo Validation::formError("cateProd_keyword"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_metaTitle" class="form_label"><strong style="color: #f00;">*</strong> Thẻ tiêu đề (Meta title)</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="cateProd_metaTitle" id="cateProd_metaTitle" value="<?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_metaTitle");
                                                /*----------------------------------------------*/
                                            }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("cateProd_metaTitle"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProd_metaDesc" class="form_label"><strong style="color: #f00;">*</strong> Thẻ mô tả (Meta desc)</label>
                                        <div class="form_input">
                                            <textarea class="form_control" name="cateProd_metaDesc" id="cateProd_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_metaDesc");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <?php {{ echo Validation::formError("cateProd_metaDesc"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                        <div class="form_input">
                                            <div class="google_title"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_metaTitle");
                                                /*----------------------------------------------*/
                                            }} ?></div>
                                            <div class="google_url">
                                                <span class="default"><?php {{
                                                    /*----------------------------------------------*/
                                                    echo $base->getBaseURLClient();
                                                    /*----------------------------------------------*/
                                                }} ?></span><span class="url"><?php {{
                                                    /*----------------------------------------------*/
                                                    echo Validation::setValue("cateProd_seoUrl");
                                                    /*----------------------------------------------*/
                                                }} ?></span>
                                            </div>
                                            <div class="google_desc"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_metaDesc");
                                                /*----------------------------------------------*/
                                            }} ?></div>
                                        </div>
                                    </div>
                                    <div class="form_group seoUrl d_flex align_items_center">
                                        <label for="cateProd_seoUrl" class="form_label"><strong style="color: #f00;">*</strong> Đường dẫn SEO</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" id="cateProd_seoUrl" value="<?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_seoUrl");
                                                /*----------------------------------------------*/
                                            }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                            <input type="hidden" name="cateProd_seoUrl" value="<?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("cateProd_seoUrl");
                                                /*----------------------------------------------*/
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
                                            <?php if(!empty($listCateProd)) : ?>
                                                <option value="">--- Chọn danh mục cha ---</option>
                                                <?php foreach($listCateProd as $cateProdItem) : ?>
                                                    <option <?php {{
                                                                /*--------------- Checked status ---------------*/
                                                                echo Validation::setValue("cateProd_parentId") == $cateProdItem['cateProd_id'] ? "selected" :  null;
                                                                /*----------------------------------------------*/
                                                            }} ?> value="<?php {{
                                                                /*------------------ Value ---------------------*/
                                                                echo $cateProdItem['cateProd_id'];
                                                                /*----------------------------------------------*/
                                                            }} ?>"><?php {{
                                                                /*------------------ Content--------------------*/
                                                                echo str_repeat("-----", $cateProdItem['level']).' '.$cateProdItem['cateProd_name'];
                                                                /*----------------------------------------------*/
                                                            }} ?></option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option value="">--- Chưa có danh mục sản phẩm ---</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form_group d_flex align_items_center">
                                    <label for="cateProd_image" class="form_label"><strong style="color: #f00;">*</strong> Mini icon</label>
                                    <div class="form_input">
                                        <label for="cateProd_image">
                                            <input type="hidden" id="cateProd_image" value="<?php {{
                                                /*-----------------------------------------*/
                                                echo Validation::setValue("cateProd_image");
                                                /*-----------------------------------------*/
                                            }} ?>" name="cateProd_image">
                                            <span class="thumbNail small">
                                                <img class="img_cover full_size" data-src-id="cateProd_image" src="<?php {{
                                                    /*-----------------------------------------*/
                                                    echo !empty(Validation::setValue("cateProd_image")) ? Validation::setValue("cateProd_image") : "./public/images/logo/no_image-50x50.png";
                                                    /*-----------------------------------------*/
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
                                    <label for="cateProd_bannerPc" class="form_label"><strong style="color: #f00;">*</strong> Banner PC</label>
                                    <div class="form_input">
                                        <label for="cateProd_bannerPc">
                                            <input type="hidden" id="cateProd_bannerPc" name="cateProd_bannerPc" value="<?php {{
                                                /*------------------------------------------*/
                                                echo Validation::setValue("cateProd_bannerPc");
                                                /*------------------------------------------*/
                                            }} ?>">
                                            <span class="thumbNail banner __PC">
                                                <img class="img_cover full_size" src="<?php {{
                                                    /*------------------------------------------*/
                                                    echo !empty(Validation::setValue("cateProd_bannerPc")) ? Validation::setValue("cateProd_bannerPc") : "./public/images/logo/no_image-50x50.png";
                                                    /*------------------------------------------*/
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
                                    <label for="cateProd_bannerMb" class="form_label"><strong style="color: #f00;">*</strong> Banner Mobile</label>
                                    <div class="form_input">
                                        <label for="cateProd_bannerMb">
                                            <input type="hidden" id="cateProd_bannerMb" name="cateProd_bannerMb" value="<?php {{
                                                /*------------------------------------------*/
                                                echo Validation::setValue("cateProd_bannerMb");
                                                /*------------------------------------------*/
                                            }} ?>">
                                            <span class="thumbNail banner __mobile">
                                                <img class="img_cover full_size" data-src-id="cateProd_bannerMb" src="<?php {{
                                                    /*------------------------------------------*/
                                                    echo !empty(Validation::setValue("cateProd_bannerMb")) ? Validation::setValue("cateProd_bannerMb") : "./public/images/logo/no_image-50x50.png";
                                                    /*------------------------------------------*/
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
                                            /*-----------------------------------------*/
                                            echo Validation::setValue("cateProd_order");
                                            /*-----------------------------------------*/
                                        }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                        <span class="note">* Mặc định lấy số thứ tự lớn nhất trong dữ liệu cộng thêm 1</span>
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