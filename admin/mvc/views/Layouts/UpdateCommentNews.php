<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Đánh giá</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="">Cập nhật đánh giá</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($commentnewsItem) ? "disable" : null; }} ?> name="updateCommentNews_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="CommentNews">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{
            if(!empty($statusActionCommentNews)) { ?>
                <div class="alert_wrap">
                    <div class="alert alert_<?php {{ echo $statusActionCommentNews['status']; }}
                        ?> position_relative" data-status="<?php {{
                            if(!empty($statusActionCommentNews['status']))
                            { echo "true"; }; }}
                        ?>">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span><?php {{ echo $statusActionCommentNews['notifiTxt']; }} ?></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
        <?php }  }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm đánh giá</span>
                    </h2>
                </div>
                <div class="panel_body">
                    <div id="table_content">
                        <div class="nav_tabs d_flex align_items_center">
                            <a class="tab_item active" href="#tab_general">Tổng quan</a>
                        </div>
                        <div class="tab_content">
                            <div class="tab_pane" id="tab_general">
                                <div class="form_group status_wrap d_flex align_items_center">
                                    <label for="status_value" class="form_label">Trạng thái</label>
                                    <div class="switch_status">
                                        <label for="status_value" class="status_toogle on">
                                            <input type="checkbox" <?php {{
                                                /*-------------------------------------------------------------*/
                                                if(!empty(Validation::setValue("commentnews_status")))
                                                { echo Validation::setValue("commentnews_status") == "on" ? "checked" : null; }
                                                else
                                                { echo $commentnewsItem['commentnews_status'] == "on" ? "checked" : null; }
                                                /*-------------------------------------------------------------*/
                                            }} ?> name="commentnews_status" id="status_value" class="d_none">
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="content_group">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="commentnews_customerFullname" class="form_label"><strong style="color: #f00;">*</strong> Khách hàng</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="commentnews_customerFullname" id="commentnews_customerFullname" value="<?php {{
                                                /*---------------------------------------------*/
                                                if(!empty(Validation::setValue("commentnews_customerFullname")))
                                                { echo Validation::setValue("commentnews_customerFullname"); }
                                                else
                                                { echo !empty($commentnewsItem['commentnews_customerFullname']) ? $commentnewsItem['commentnews_customerFullname'] : null; }
                                                /*---------------------------------------------*/
                                            }} ?>" placeholder="Tên khách hàng" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("commentnews_customerFullname"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Bài viết</label>
                                        <div class="form_input">
                                            <div class="form_group d_flex">
                                                <div class="form_input">
                                                    <div class="form_list_wrap">
                                                    <?php {{
                                                        if(!empty($listNews)) { ?>
                                                            <div class="list">
                                                                <?php {{
                                                                    foreach($listNews as $newsItem) { ?>
                                                                        <label for="news_<?php {{ echo $newsItem['news_id']; }} ?>" class="item d_flex align_items_center">
                                                                            <input type="radio" name="newsId[]" class="newsId_checkItem" <?php {{
                                                                                /*----------------------------------------------*/
                                                                                if(!empty(Validation::setValue("newsId"))) {
                                                                                    foreach(Validation::setValue("newsId") as $newsIdItem) {
                                                                                        echo $newsIdItem == $newsItem['news_id'] ? "checked" : null;
                                                                                    }
                                                                                } else {
                                                                                    echo $commentnewsItem['commentnews_newsId_ties'] == $newsItem['news_id'] ? "checked" : null;
                                                                                }
                                                                                /*----------------------------------------------*/
                                                                            }} ?> value="<?php {{ echo $newsItem['news_id']; }} ?>" id="news_<?php {{ echo $newsItem['news_id']; }} ?>">
                                                                            <span><?php {{ echo $newsItem['news_name']; }} ?></span>
                                                                        </label>
                                                                    <?php }
                                                                }} ?>
                                                            </div>
                                                        <?php }
                                                    }} ?>
                                                    </div>
                                                    <div class="list_button d_flex align_items_center">
                                                        <a href="" class="btn btn_warning newsClearAll">Bỏ chọn tất cả</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("newsId"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="commentnews_content" class="form_label"><strong style="color: #f00;">*</strong> Nội dung</label>
                                        <div class="form_input">
                                            <textarea class="form_control" style="width: 100%; height: 100px;" name="commentnews_content" id="commentnews_content" placeholder="Nội dung comment" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                if(!empty(Validation::setValue("commentnews_content")))
                                                { echo Validation::setValue("commentnews_content"); }
                                                else
                                                { echo !empty($commentnewsItem['commentnews_content']) ? $commentnewsItem['commentnews_content'] : null; }
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <?php {{ echo Validation::formError("commentnews_content"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="commentnews_createDate" class="form_label">Ngày thêm</label>
                                        <div class="form_input">
                                            <input class="form_control" type="date" name="commentnews_createDate" id="commentnews_createDate" value="<?php {{
                                                /*------------------------------------------*/
                                                if(!empty(Validation::setValue("commentnews_createDate")))
                                                { echo Validation::setValue("commentnews_createDate"); }
                                                else
                                                { echo !empty($commentnewsItem['commentnews_createDate']) ? Format::formatTimeDateInput($commentnewsItem['commentnews_createDate']) : null; }
                                                /*------------------------------------------*/
                                            }} ?>" placeholder="Ngày thêm" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("commentnews_createDate"); }} ?>
                                        </div>
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
let btnClearAllNews  = document.querySelector(".newsClearAll");
let listAllNews      = document.querySelectorAll(".newsId_checkItem");

btnClearAllNews.addEventListener('click', function() {
    listAllNews.forEach(el => {
        el.checked = false;
    });
    event.preventDefault();
});
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