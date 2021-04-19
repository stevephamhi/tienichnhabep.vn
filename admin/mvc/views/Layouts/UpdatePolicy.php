<?php
{{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Chính sách</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="">Cập nhật chính sách</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($policyItem) ? "disabled" : null; }} ?> name="updatePolicy_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Cập nhật</span>
                    </button>
                    <a class="btn_item btn_default" href="Policy">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{
            if(!empty($statusActionPolicy)) { ?>
                <div class="alert_wrap">
                    <div class="alert alert_<?php {{ echo $statusActionPolicy['status']; }}
                        ?> position_relative" data-status="<?php {{
                            if(!empty($statusActionPolicy['status']))
                            { echo "true"; }; }}
                        ?>">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span><?php {{ echo $statusActionPolicy['notifiTxt']; }} ?></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
        <?php }  }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Cập nhật chính sách</span>
                    </h2>
                </div>
                <?php if(!empty($policyItem)) : ?>
                <div class="panel_body">
                    <form action="" method="POST">
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
                                                <input type="checkbox" name="policy_status" <?php {{
                                                    /*----------------------------------------*/
                                                    if(!empty(Validation::setValue("policy_status")))
                                                    { echo Validation::setValue("policy_status") == "on" ? "checked" : null; }
                                                    else
                                                    { echo $policyItem['policy_status'] == "on" ? "checked" : null; }
                                                    /*----------------------------------------*/
                                                }} ?> id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="policy_title" class="form_label"><span style="color: #f00;">*</span> Tiêu đề</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="policy_title" id="policy_title" value="<?php {{
                                                    /*----------------------------------------*/
                                                    if(!empty(Validation::setValue("")))
                                                    { echo Validation::setValue("policy_title"); }
                                                    else
                                                    { echo !empty($policyItem['policy_title']) ? $policyItem['policy_title'] : null; }
                                                    /*----------------------------------------*/
                                                }} ?>" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("policy_title"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="policy_desc" class="form_label"><span style="color: #f00;">*</span>Mô tả</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="policy_desc" id="policy_desc" placeholder="Mô tả" spellcheck="false"><?php {{
                                                    /*----------------------------------------*/
                                                    if(!empty(Validation::setValue("policy_desc")))
                                                    { echo Validation::setValue("policy_desc"); }
                                                    else
                                                    { echo !empty($policyItem['policy_desc']) ? $policyItem['policy_desc'] : null; }
                                                    /*----------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("policy_desc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="policy_metaTitle" class="form_label"><span style="color: #f00;">*</span>Thẻ tiêu đề (Meta title)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="policy_metaTitle" id="policy_metaTitle" value="<?php {{
                                                    /*----------------------------------------*/
                                                    if( !empty(Validation::setValue("policy_metaTitle")) )
                                                    { echo Validation::setValue("policy_metaTitle"); }
                                                    else
                                                    { echo !empty($policyItem['policy_metaTitle']) ? $policyItem['policy_metaTitle'] : null; }
                                                    /*----------------------------------------*/
                                                }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("policy_metaTitle"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="policy_metaDesc" class="form_label"><span style="color: #f00;">*</span>Thẻ mô tả (Meta desc)</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="policy_metaDesc" id="policy_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                    /*----------------------------------------*/
                                                    if( !empty(Validation::setValue("policy_metaDesc")) )
                                                    { echo Validation::setValue("policy_metaDesc"); }
                                                    else
                                                    { echo !empty($policyItem['policy_metaDesc']) ? $policyItem['policy_metaDesc'] : null; }
                                                    /*----------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("policy_metaDesc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                            <div class="form_input">
                                                <div class="google_title"><?php {{
                                                    /*----------------------------------------------*/
                                                    if( !empty(Validation::setValue("policy_metaTitle")) )
                                                    { echo Validation::setValue("policy_metaTitle"); }
                                                    else
                                                    { echo !empty($policyItem['policy_metaTitle']) ? $policyItem['policy_metaTitle'] : null; }
                                                    /*--------------------------------------------*/
                                                }} ?></div>
                                                <div class="google_url">
                                                    <span class="default"><?php {{ echo $base->getBaseURLClient(); }} ?></span>
                                                    <span class="url"><?php {{
                                                        /*--------------------------------------------*/
                                                        if( !empty(Validation::setValue("policy_seoUrl")) )
                                                        { echo Validation::setValue("policy_seoUrl"); }
                                                        else
                                                        { echo !empty($policyItem['policy_seoUrl']) ? $policyItem['policy_seoUrl'] : null; }
                                                        /*--------------------------------------------*/
                                                    }} ?></span>
                                                </div>
                                                <div class="google_desc"><?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("policy_metaDesc")))
                                                    { echo Validation::setValue("policy_metaDesc"); }
                                                    else
                                                    { echo !empty($policyItem['policy_metaDesc']) ? $policyItem['policy_metaDesc'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?></div>
                                            </div>
                                        </div>
                                        <div class="form_group cateProd_seo_url d_flex align_items_center">
                                            <label for="policy_seoUrl" class="form_label"><span style="color: #f00;">*</span>Đường dẫn SEO</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" id="policy_seoUrl" value="<?php {{
                                                    /*----------------------------------------*/
                                                    if( !empty(Validation::setValue("policy_seoUrl")) )
                                                    { echo Validation::setValue("policy_seoUrl"); }
                                                    else
                                                    { echo !empty($policyItem['policy_seoUrl']) ? $policyItem['policy_seoUrl'] : null; }
                                                    /*----------------------------------------*/
                                                }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("policy_seoUrl"); }} ?>
                                                <input type="hidden" name="policy_seoUrl" value="<?php {{
                                                    /*----------------------------------------*/
                                                    if( !empty(Validation::setValue("policy_seoUrl")) )
                                                    { echo Validation::setValue("policy_seoUrl"); }
                                                    else
                                                    { echo !empty($policyItem['policy_seoUrl']) ? $policyItem['policy_seoUrl'] : null; }
                                                    /*----------------------------------------*/
                                                }} ?>">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="policy_order" class="form_label"><span style="color: #f00;">*</span>Thứ tự</label>
                                            <div class="form_input">
                                                <input class="form_control" type="number" min="0" name="policy_order" id="policy_order" value="<?php {{
                                                    /*----------------------------------------*/
                                                    if( !empty(Validation::setValue("policy_order")) )
                                                    { echo Validation::setValue("policy_order"); }
                                                    else
                                                    { echo !empty($policyItem['policy_order']) ? $policyItem['policy_order'] : null; }
                                                    /*----------------------------------------*/
                                                }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php else : ?>
                    <p class="data_empty_notification">Không tồn tại chính sách này !</p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
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
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/plugins/Ckeditor/ckeditor/ckeditor.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>"></script>

<!-- ====================================================== -->
<!-- ========== ########## APP CONFIG ########## ========== -->
<!-- ====================================================== -->

<script type="text/javascript">
//========= ##### handle keyup word and append ##### ==========//

var metaTitleEl = document.querySelector("#policy_metaTitle");
var metaDescEl  = document.querySelector("#policy_metaDesc");
var seoUrlEl    = document.querySelector("#policy_seoUrl");

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
    document.querySelector("[name='policy_seoUrl']").value = slug_string(vl);
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
// handle notification status add new
var alertStatusAddEl = document.querySelector('.alert');
if(alertStatusAddEl !== null) {
    var buttonCloseAlertEl   = document.querySelector(".alert .close");
    if(alertStatusAddEl.getAttribute('data-status') === 'true') {
        alertStatusAddEl.classList.add('open');
        setTimeout(function() {
            alertStatusAddEl.classList.remove('open');
        },5000);
    }

    buttonCloseAlertEl.addEventListener('click', function() {
        alertStatusAddEl.classList.remove('open');
    });
}
</script>