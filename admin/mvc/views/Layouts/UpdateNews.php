<?php
{{ $base = new Base; }} ?>
<main class="main_content" data-layout="addNews">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Tin tức</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="Home">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Cập nhật tin tức</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($newsItem) ? "disable" : null; }} ?> name="updateNews_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="News">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{
            if(!empty($statusActionNews)) { ?>
                <div class="alert_wrap">
                    <div class="alert alert_<?php {{ echo $statusActionNews['status']; }}
                        ?> position_relative" data-status="<?php {{
                            if(!empty($statusActionNews['status']))
                            { echo "true"; }; }}
                        ?>">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span><?php {{ echo $statusActionNews['notifiTxt']; }} ?></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
            <?php }
        }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Cập nhật tin tức</span>
                    </h2>
                </div>
                <?php {{ if(!empty($newsItem)) { ?>
                <div class="panel_body">
                    <form action="" method="POST">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="active tab_item" href="#tab_general">Tổng quan</a>
                                <a class="tab_item" href="#tab_data">Dữ liệu</a>
                                <a class="tab_item" href="#tab_links">Liên kết</a>
                                <a class="tab_item" href="#tab_additional">Bổ sung</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle">
                                                <input type="checkbox" name="news_status" id="status_value" <?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_status")))
                                                    { echo Validation::setValue("news_status") == 'on' ? "checked" : null; }
                                                    else
                                                    { echo $newsItem['news_status'] == 'on' ? 'checked' : null; }
                                                    /*------------------------------------------------*/
                                                }} ?> class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="news_name" class="form_label"><span style="color: #f00;">*</span> Tên tin tức</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="news_name" id="news_name" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_name")))
                                                    { echo Validation::setValue("news_name"); }
                                                    else
                                                    { echo !empty($newsItem['news_name']) ? $newsItem['news_name'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>" placeholder="Tên tin tức" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("news_name"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="news_desc" class="form_label"><span style="color: #f00;">*</span>Mô tả ngắn</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="news_desc" id="news_desc" placeholder="Mô tả ngắn" spellcheck="false"><?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_desc")))
                                                    { echo Validation::setValue("news_desc"); }
                                                    else
                                                    { echo !empty($newsItem['news_desc']) ? $newsItem['news_desc'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("news_desc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="news_content" class="form_label"><span style="color: #f00;">*</span>Nội dung</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="news_content" id="news_content"  placeholder="Nội dung" spellcheck="false"><?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_content")))
                                                    { echo Validation::setValue("news_content"); }
                                                    else
                                                    { echo !empty($newsItem['news_content']) ? $newsItem['news_content'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("news_content"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="news_metaTitle" class="form_label"><span style="color: #f00;">*</span>Thẻ tiêu đề (Meta title)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="news_metaTitle" id="news_metaTitle" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_metaTitle")))
                                                    { echo Validation::setValue("news_metaTitle"); }
                                                    else
                                                    { echo !empty($newsItem['news_metaTitle']) ? $newsItem['news_metaTitle'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("news_metaTitle"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="news_metaDesc" class="form_label"><span style="color: #f00;">*</span>Thẻ mô tả (Meta desc)</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="news_metaDesc" id="news_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_metaDesc")))
                                                    { echo Validation::setValue("news_metaDesc"); }
                                                    else
                                                    { echo !empty($newsItem['news_metaDesc']) ? $newsItem['news_metaDesc'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("news_metaDesc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="news_keywords" class="form_label">Từ khóa (tags)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="news_keywords" id="news_keywords" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_keywords")))
                                                    { echo Validation::setValue("news_keywords"); }
                                                    else
                                                    { echo !empty($newsItem['news_keywords']) ? $newsItem['news_keywords'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>" placeholder="Tabs key words" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                            <div class="form_input">
                                                <div class="google_title"><?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_metaTitle")))
                                                    { echo Validation::setValue("news_metaTitle"); }
                                                    else
                                                    { echo !empty($newsItem['news_metaTitle']) ? $newsItem['news_metaTitle'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?></div>
                                                <div class="google_url">
                                                    <span class="default"><?php {{ echo $base->getBaseURLClient(); }} ?>/</span>
                                                    <span class="url"><?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(validation::setValue("news_seoUrl")))
                                                        { echo validation::setValue("news_seoUrl"); }
                                                        else
                                                        { echo !empty($newsItem['news_seoUrl']) ? $newsItem['news_seoUrl'] : null; }
                                                        /*----------------------------------------------*/
                                                    }} ?></span>
                                                </div>
                                                <div class="google_desc"><?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_metaDesc")))
                                                    { echo Validation::setValue("news_metaDesc"); }
                                                    else
                                                    { echo !empty($newsItem['news_metaDesc']) ? $newsItem['news_metaDesc'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?></div>
                                            </div>
                                        </div>
                                        <div class="form_group cateProd_seo_url d_flex align_items_center">
                                            <label for="news_seoUrl" class="form_label"><span style="color: #f00;">*</span>Đường dẫn SEO</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" id="news_seoUrl" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_seoUrl")))
                                                    { echo Validation::setValue("news_seoUrl"); }
                                                    else
                                                    { echo !empty($newsItem['news_seoUrl']) ? $newsItem['news_seoUrl'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("news_seoUrl"); }} ?>
                                                <input type="hidden" name="news_seoUrl" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_seoUrl")))
                                                    { echo Validation::setValue("news_seoUrl"); }
                                                    else
                                                    { echo !empty($newsItem['news_seoUrl']) ? $newsItem['news_seoUrl'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_data">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="news_image" class="form_label"><span style="color: #f00;">*</span>Hình ảnh</label>
                                        <div class="form_input">
                                            <label for="news_image">
                                                <input type="hidden" name="news_image" id="news_image" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_image")))
                                                    { echo Validation::setValue("news_image"); }
                                                    else
                                                    { echo !empty($newsItem['news_image']) ? $newsItem['news_image'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>">
                                                <span>300px x 170px</span>
                                                <span class="thumbNail small" style="width: 300px; height: 170px;">
                                                    <img data-src-id="news_image" class="img_cover full_size" src="<?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("news_image")))
                                                        { echo Validation::setValue("news_image"); }
                                                        else
                                                        { echo !empty($newsItem['news_image']) ? $newsItem['news_image'] : "/public/images/logo/no_image-50x50.png"; }
                                                        /*----------------------------------------------*/
                                                    }} ?>" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 4.5px 10px 4px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=news_image" type="button" data-id-input-image="news_image" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh bài viết">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="news_image" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("news_image"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="news_bannerPc" class="form_label">Banner PC</label>
                                        <div class="form_input">
                                            <label for="news_bannerPc">
                                                <input type="hidden" id="news_bannerPc" name="news_bannerPc" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_bannerPc")))
                                                    { echo Validation::setValue("news_bannerPc"); }
                                                    else
                                                    { echo !empty($newsItem['news_bannerPc']) ? $newsItem['news_bannerPc'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>">
                                                <span class="thumbNail banner __PC">
                                                    <img class="img_cover full_size" src="<?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("news_bannerPc")))
                                                        { echo Validation::setValue("news_bannerPc"); }
                                                        else
                                                        { echo !empty($newsItem['news_bannerPc']) ? $newsItem['news_bannerPc'] : "./public/images/logo/no_image-50x50.png"; }
                                                        /*----------------------------------------------*/
                                                    }} ?>" data-src-id="news_bannerPc" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 4.5px 10px 4px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=news_bannerPc" type="button" data-id-input-image="news_bannerPc" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh tin tức">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="news_bannerPc" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="news_bannerMb" class="form_label">Banner Mobile</label>
                                        <div class="form_input">
                                            <label for="news_bannerMb">
                                                <input type="hidden" id="news_bannerMb" name="news_bannerMb" value="<?php {{
                                                    /*----------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_bannerMb")))
                                                    { echo Validation::setValue("news_bannerMb"); }
                                                    else
                                                    { echo !empty($newsItem['news_bannerMb']) ? $newsItem['news_bannerMb'] : null; }
                                                    /*----------------------------------------------*/
                                                }} ?>">
                                                <span class="thumbNail banner __mobile">
                                                    <img class="img_cover full_size" data-src-id="news_bannerMb" src="<?php {{
                                                        /*----------------------------------------------*/
                                                        if(!empty(Validation::setValue("news_bannerMb")))
                                                        { echo Validation::setValue("news_bannerMb"); }
                                                        else
                                                        { echo !empty($newsItem['news_bannerMb']) ? $newsItem['news_bannerMb'] : "./public/images/logo/no_image-50x50.png"; }
                                                        /*----------------------------------------------*/
                                                    }} ?>" alt="">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 4.5px 10px 4px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=news_bannerMb" type="button" data-id-input-image="news_bannerMb" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh tin tức">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="news_bannerMb" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="news_video" class="form_label">Video</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="news_video" id="news_video" value="<?php {{
                                                /*----------------------------------------------*/
                                                if(!empty(Validation::setValue("news_video")))
                                                { echo Validation::setValue("news_video"); }
                                                else
                                                { echo !empty($newsItem['news_video']) ? $newsItem['news_video'] : null; }
                                                /*----------------------------------------------*/
                                            }} ?>" placeholder="Copy iframe video từ youtube" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"></label>
                                        <div class="form_input">
                                            <select class="form_control" name="news_target" id="news_target">
                                                <option value="blank" <?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_target")))
                                                    { echo Validation::setValue("news_target") == 'blank' ? "selected" : null; }
                                                    else
                                                    { echo $newsItem['news_target'] == 'blank' ? 'selected' : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>>Mở tab mới khi xem video</option>
                                                <option value="self" <?php {{
                                                    /*------------------------------------------------*/
                                                    if(!empty(Validation::setValue("news_target")))
                                                    { echo Validation::setValue("news_target") == 'self' ? "selected" : null; }
                                                    else
                                                    { echo $newsItem['news_target'] == 'self' ? 'selected' : null; }
                                                    /*------------------------------------------------*/
                                                }} ?>>Hiển thị tab hiện tại khi xem video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="news_order" class="form_label">Số thứ tự</label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="news_order" id="news_order" value="<?php {{
                                                /*----------------------------------------------*/
                                                if(!empty(Validation::setValue("news_order")))
                                                { echo Validation::setValue("news_order"); }
                                                else
                                                { echo !empty($newsItem['news_order']) ? $newsItem['news_order'] : null; }
                                                /*----------------------------------------------*/
                                            }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_links">
                                    <div class="form_group d_flex">
                                        <label for="" class="form_label" title="Nhấn để chọn danh mục">
                                            <span style="color: #f00;">*</span>
                                            <span>Danh mục</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <div class="form_list_wrap">
                                                <?php {{ if(!empty($listTotalCateNews)) {
                                                    ?>
                                                        <div class="list">
                                                            <?php
                                                                {{
                                                                    foreach($listTotalCateNews as $cateNewsItem) {
                                                                        ?>
                                                                            <label for="cateNews_<?php {{ echo $cateNewsItem['cateNews_id']; }} ?>" class="item d_flex align_items_center">
                                                                                <input type="checkbox" name="cateNewsId[]" <?php {{
                                                                                    /*----------------------------------------------*/
                                                                                    if(!empty(Validation::setValue("cateNewsId")))
                                                                                    {
                                                                                        foreach(Validation::setValue("cateNewsId") as $__cateNewsItem) {
                                                                                            echo $__cateNewsItem == $cateNewsItem['cateNews_id'] ? "checked" : null;
                                                                                        }
                                                                                    } else
                                                                                    {
                                                                                        foreach($listCateNewsByNewsItem as $__cateNewsItem) {
                                                                                            echo $__cateNewsItem == $cateNewsItem['cateNews_id'] ? "checked" : null;
                                                                                        }
                                                                                    }
                                                                                    /*----------------------------------------------*/
                                                                                }} ?> value="<?php {{
                                                                                    /*----------------------------------------------*/
                                                                                    echo $cateNewsItem['cateNews_id'];
                                                                                    /*----------------------------------------------*/
                                                                                }} ?>" id="cateNews_<?php {{ echo $cateNewsItem['cateNews_id']; }} ?>">
                                                                                <span><?php {{ echo str_repeat("-----", $cateNewsItem['level']); }} {{ echo $cateNewsItem['cateNews_name']; }} ?></span>
                                                                            </label>
                                                                        <?php
                                                                    }
                                                                }}
                                                            ?>
                                                        </div>
                                                    <?php
                                                } else { ?> <p class="data_empty_notification">Không tồn tại bản tin này !</p> <?php } }} ?>
                                            </div>
                                            <?php {{ echo Validation::formError("cateNewsId"); }} ?>
                                            <div class="list_button d_flex align_items_center">
                                                <a href="" class="btn btn_primary btnSelectAll">Chọn tất cả</a>
                                                <a href="" class="btn btn_warning btnClearAll">Bỏ chọn tất cả</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_additional">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="news_views" class="form_label">Số lượng xem mặc định</label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="news_views" id="news_views" value="<?php {{
                                                /*----------------------------------------------*/
                                                if(!empty(Validation::setValue("news_views")))
                                                { echo Validation::setValue("news_views"); }
                                                else
                                                { echo !empty($newsItem['news_views']) ? $newsItem['news_views'] : 0; }
                                                /*----------------------------------------------*/
                                            }} ?>" placeholder="Số lượt xem mặt định" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="news_likes" class="form_label">Số lượt like mặc định</label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="news_likes" id="news_likes" value="<?php {{
                                                /*----------------------------------------------*/
                                                if(!empty(Validation::setValue("news_likes")))
                                                { echo Validation::setValue("news_likes"); }
                                                else
                                                { echo !empty($newsItem['news_likes']) ? $newsItem['news_likes'] : 0; }
                                                /*----------------------------------------------*/
                                            }} ?>" placeholder="Số lượt thích mặt định" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } else { ?> <p class="data_empty_notification">Bản tin tức này không tồn tại</p> <?php } }} ?>
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
<script type="text/javascript" class="handle_selectAll_clearAll">
    let btnSelectAll  = document.querySelector(".btnSelectAll");
    let btnClearAll   = document.querySelector(".btnClearAll");
    let listDataCheck = document.querySelectorAll("input[name='cateNewsId[]']");
    btnSelectAll.addEventListener('click', function() {
        event.preventDefault();
        listDataCheck.forEach(el => {
            el.checked = true;
        });
    });
    btnClearAll.addEventListener('click', function() {
        event.preventDefault();
        listDataCheck.forEach(el => {
            el.checked = false;
        });
    });
</script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/newsAjax.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/plugins/Ckeditor/ckeditor/ckeditor.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>

<!-- ====================================================== -->
<!-- ========== ########## APP CONFIG ########## ========== -->
<!-- ====================================================== -->

<script type="text/javascript">
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

var metaTitleEl = document.querySelector("#news_metaTitle");
var metaDescEl  = document.querySelector("#news_metaDesc");
var seoUrlEl    = document.querySelector("#news_seoUrl");

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
    document.querySelector("[name='news_seoUrl']").value = slug_string(vl);
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