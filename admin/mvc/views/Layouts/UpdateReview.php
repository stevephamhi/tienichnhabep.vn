<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Đánh giá</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="Home">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Cập nhật đánh giá</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($reviewItem) ? "disable" : null; }} ?> name="updateReview_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Review">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{
            if(!empty($statusActionReview)) { ?>
                <div class="alert_wrap">
                    <div class="alert alert_<?php {{ echo $statusActionReview['status']; }}
                        ?> position_relative" data-status="<?php {{
                            if(!empty($statusActionReview['status']))
                            { echo "true"; }; }}
                        ?>">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span><?php {{ echo $statusActionReview['notifiTxt']; }} ?></span>
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
                <?php {{ if(!empty($reviewItem)) { ?>
                <div class="panel_body">
                    <div id="table_content">
                        <div class="nav_tabs d_flex align_items_center">
                            <a class="tab_item active" href="#tab_general">Tổng quan</a>
                            <a class="tab_item" href="#tab_images">Hình ảnh</a>
                        </div>
                        <div class="tab_content">
                            <div class="tab_pane" id="tab_general">
                                <div class="form_group status_wrap d_flex align_items_center">
                                    <label for="status_value" class="form_label">Trạng thái</label>
                                    <div class="switch_status">
                                        <label for="status_value" class="status_toogle on">
                                            <input type="checkbox" <?php {{
                                                /*----------------------------------------------------------*/
                                                if(!empty(Validation::setValue("review_status")))
                                                { echo Validation::setValue("review_status") == "on" ? "checked" : null; }
                                                else
                                                { echo $reviewItem['review_status'] == "on" ? "checked" : null; }
                                                /*----------------------------------------------------------*/
                                            }} ?> name="review_status" id="status_value" class="d_none">
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="content_group">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="review_customerFullname" class="form_label"><strong style="color: #f00;">*</strong> Khách hàng</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="review_customerFullname" id="review_customerFullname" value="<?php {{
                                                /*---------------------------------------------*/
                                                if(!empty(Validation::setValue("review_customerFullname")))
                                                { echo Validation::setValue("review_customerFullname"); }
                                                else
                                                { echo !empty($reviewItem['review_customerFullname']) ? $reviewItem['review_customerFullname'] : null; }
                                                /*---------------------------------------------*/
                                            }} ?>" placeholder="Tên khách hàng" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("review_customerFullname"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Sản phẩm</label>
                                        <div class="form_input">
                                            <div class="form_group d_flex">
                                                <div class="form_input">
                                                    <div class="form_list_wrap">
                                                    <?php {{
                                                        if(!empty($listProd)) { ?>
                                                            <div class="list">
                                                                <?php {{
                                                                    foreach($listProd as $prodItem) { ?>
                                                                        <label for="prod_<?php {{ echo $prodItem['prod_id']; }} ?>" class="item d_flex align_items_center">
                                                                            <input type="radio" name="prodId[]" class="prodId_checkItem" <?php {{
                                                                                /*----------------------------------------------*/
                                                                                if(!empty(Validation::setValue("prodId"))) {
                                                                                    foreach(Validation::setValue("prodId") as $prodIdItem) {
                                                                                        echo $prodIdItem == $prodItem['prod_id'] ? "checked" : null;
                                                                                    }
                                                                                } else {
                                                                                    if(!empty($reviewItem['review_prodId_ties'])) {
                                                                                        echo $reviewItem['review_prodId_ties'] == $prodItem['prod_id'] ? "checked" : null;
                                                                                    } else { echo null; }
                                                                                }
                                                                                /*----------------------------------------------*/
                                                                            }} ?> value="<?php {{ echo $prodItem['prod_id']; }} ?>" id="prod_<?php {{ echo $prodItem['prod_id']; }} ?>">
                                                                            <span><?php {{ echo $prodItem['prod_name']; }} ?></span>
                                                                        </label>
                                                                    <?php }
                                                                }} ?>
                                                            </div>
                                                        <?php }
                                                    }} ?>
                                                    </div>
                                                    <div class="list_button d_flex align_items_center">
                                                        <a href="" class="btn btn_warning prodClearAll">Bỏ chọn tất cả</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("prodId"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="review_content" class="form_label"><strong style="color: #f00;">*</strong> Nội dung</label>
                                        <div class="form_input">
                                            <textarea class="form_control" style="width: 100%; height: 100px;" name="review_content" id="review_content" placeholder="Nội dung đánh giá" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                if(!empty(Validation::setValue("review_content")))
                                                { echo Validation::setValue("review_content"); }
                                                else
                                                { echo !empty($reviewItem['review_content']) ? $reviewItem['review_content'] : null; }
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <?php {{ echo Validation::formError("review_content"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Đã mua hàng</label>
                                        <div class="form_input">
                                            <div class="list_check">
                                                <label for="purchased" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="checkbox" <?php {{
                                                        /*------------------------------------------*/
                                                        if(!empty(Validation::setValue("purchased")))
                                                        { echo Validation::setValue("purchased") == "1" ? "checked" : 'ok'; }
                                                        else
                                                        { echo $reviewItem['purchased'] == "1" ? "checked" : null; }
                                                        /*------------------------------------------*/
                                                    }} ?> name="purchased" id="purchased" value="1">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="cateProdMetaTitle" class="form_label">Đánh giá</label>
                                        <div class="form_input">
                                            <div class="list_check">
                                                <label for="1star" class="check_item" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="radio" name="rating[]" id="1star" <?php {{
                                                        /*------------------------------------------*/
                                                        if(!empty(Validation::setValue("rating"))) {
                                                            echo Validation::setValue("rating")[0] == "1" ? "checked" : null;
                                                        } else {
                                                            if(!empty($reviewItem['review_rating'])) {
                                                                echo $reviewItem['review_rating'] == "1" ? "checked" : null;
                                                            } else { echo null; }
                                                        }
                                                        /*------------------------------------------*/
                                                    }} ?> value="1">
                                                    <span>1 <i class="fa fa-star start_color" aria-hidden="true"></i></span>
                                                </label>
                                                <label for="2star" class="check_item" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="radio" name="rating[]" id="2star" <?php {{
                                                        /*------------------------------------------*/
                                                        if(!empty(Validation::setValue("rating"))) {
                                                            echo Validation::setValue("rating")[0] == "2" ? "checked" : null;
                                                        } else {
                                                            if(!empty($reviewItem['review_rating'])) {
                                                                echo $reviewItem['review_rating'] == "2" ? "checked" : null;
                                                            } else { echo null; }
                                                        }
                                                        /*------------------------------------------*/
                                                    }} ?> value="2">
                                                    <span>2 <i class="fa fa-star start_color" aria-hidden="true"></i></span>
                                                </label>
                                                <label for="3star" class="check_item" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="radio" name="rating[]" id="3star" <?php {{
                                                        /*------------------------------------------*/
                                                        if(!empty(Validation::setValue("rating"))) {
                                                            echo Validation::setValue("rating")[0] == "3" ? "checked" : null;
                                                        } else {
                                                            if(!empty($reviewItem['review_rating'])) {
                                                                echo $reviewItem['review_rating'] == "3" ? "checked" : null;
                                                            } else { echo null; }
                                                        }
                                                        /*------------------------------------------*/
                                                    }} ?> value="3">
                                                    <span>3 <i class="fa fa-star start_color" aria-hidden="true"></i></span>
                                                </label>
                                                <label for="4star" class="check_item" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="radio" name="rating[]" id="4star" <?php {{
                                                        /*------------------------------------------*/
                                                        if(!empty(Validation::setValue("rating"))) {
                                                            echo Validation::setValue("rating")[0] == "4" ? "checked" : null;
                                                        } else {
                                                            if(!empty($reviewItem['review_rating'])) {
                                                                echo $reviewItem['review_rating'] == "4" ? "checked" : null;
                                                            } else { echo null; }
                                                        }
                                                        /*------------------------------------------*/
                                                    }} ?> value="4">
                                                    <span>4 <i class="fa fa-star start_color" aria-hidden="true"></i></span>
                                                </label>
                                                <label for="5star" class="check_item" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="radio" name="rating[]" id="5star" <?php {{
                                                        /*------------------------------------------*/
                                                        if(!empty(Validation::setValue("rating"))) {
                                                            echo Validation::setValue("rating")[0] == "5" ? "checked" : null;
                                                        } else {
                                                            if(!empty($reviewItem['review_rating'])) {
                                                                echo $reviewItem['review_rating'] == "5" ? "checked" : null;
                                                            } else { echo null; }
                                                        }
                                                        /*------------------------------------------*/
                                                    }} ?> value="5">
                                                    <span>5 <i class="fa fa-star start_color" aria-hidden="true"></i></span>
                                                </label>
                                            </div>
                                            <?php {{ echo Validation::formError("rating"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Ngày thêm</label>
                                        <div class="form_input">
                                            <input class="form_control" type="date" name="review_createDate" id="review_createDate" value="<?php {{
                                                /*------------------------------------------*/
                                                if(!empty(Validation::setValue("review_createDate")))
                                                { echo Validation::setValue("review_createDate"); }
                                                else
                                                { echo !empty($reviewItem['review_createDate']) ? Format::formatTimeDateInput($reviewItem['review_createDate']) : null; }
                                                /*------------------------------------------*/
                                            }} ?>" placeholder="Ngày thêm" autocomplete="off" spellcheck="false">
                                            <?php {{ echo Validation::formError("review_createDate"); }} ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_pane" id="tab_images" style="display: block;">
                                <div class="table_images_wrap">
                                    <table class="table_images table">
                                        <thead>
                                            <tr>
                                                <td>Hình ảnh reivew</td>
                                                <td>Tác vụ</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php {{
                                                if(!empty(Validation::setValue("reviewImg"))) {
                                                    $numRow = 0;
                                                    foreach(Validation::setValue("reviewImg") as $reviewImgItem) {
                                                        ?>
                                                        <tr id="image_row<?php {{ echo $numRow; }} ?>">
                                                            <td class="position_relative">
                                                                <div class="thumbNail">
                                                                    <img data-src-id="input_image<?php {{ echo $numRow; }} ?>" src="<?php {{
                                                                        /*------------------------------------------------*/
                                                                        echo !empty($reviewImgItem) ? $reviewImgItem : "./public/images/logo/no_image-50x50.png";
                                                                        /*------------------------------------------------*/
                                                                    }} ?>" alt="">
                                                                </div>
                                                                <div class="popover position_absolute">
                                                                    <div class="popover_content d_flex align_items_center">
                                                                        <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=<?php {{ echo $numRow; }} ?>&field_id=input_image<?php {{ echo $numRow; }} ?>" type="button" data-id-input-image="input_image<?php {{ echo $numRow; }} ?>" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh mô tả">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                        <button type="button" data-id-clear-img="input_image<?php {{ echo $numRow; }} ?>" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                            <i class="fa fa-trash-o"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="reviewImg[]" id="input_image<?php {{ echo $numRow; }} ?>" value="<?php {{
                                                                    /*------------------------------------------------*/
                                                                    echo !empty($reviewImgItem) ? $reviewImgItem : null;
                                                                    /*------------------------------------------------*/
                                                                }} ?>" >
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn_danger btnClear">
                                                                    <i class="fa fa-minus-circle"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $numRow ++;
                                                    }
                                                } else {
                                                    if(!empty($listImgReview)) {
                                                        foreach($listImgReview as $imgReviewItem) {
                                                            $numRow = 0;
                                                            ?>
                                                                <tr id="image_row<?php {{ echo $numRow; }} ?>">
                                                                <td class="position_relative">
                                                                    <div class="thumbNail">
                                                                        <img data-src-id="input_image<?php {{ echo $numRow; }} ?>" src="<?php {{
                                                                            /*------------------------------------------------*/
                                                                            echo !empty($imgReviewItem['review_img_src']) ? $imgReviewItem['review_img_src'] : "./public/images/logo/no_image-50x50.png";
                                                                            /*------------------------------------------------*/
                                                                        }} ?>" alt="">
                                                                    </div>
                                                                    <div class="popover position_absolute">
                                                                        <div class="popover_content d_flex align_items_center">
                                                                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=<?php {{ echo $numRow; }} ?>&field_id=input_image<?php {{ echo $numRow; }} ?>" type="button" data-id-input-image="input_image<?php {{ echo $numRow; }} ?>" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh mô tả">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </a>
                                                                            <button type="button" data-id-clear-img="input_image<?php {{ echo $numRow; }} ?>" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="reviewImg[]" id="input_image<?php {{ echo $numRow; }} ?>" value="<?php {{
                                                                        /*------------------------------------------------*/
                                                                        echo !empty($imgReviewItem['review_img_src']) ? $imgReviewItem['review_img_src'] : null;
                                                                        /*------------------------------------------------*/
                                                                    }} ?>" >
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn_danger btnClear">
                                                                        <i class="fa fa-minus-circle"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $numRow ++;
                                                        }
                                                    }
                                                }
                                            }} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="1"></td>
                                                <td>
                                                    <button type="button" id="btnCreate_rowImage" class="btn btn_primary">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else { ?> <p class="">Review này không tồn tại !</p> <?php } }} ?>
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

const imgConfig = "./public/images/logo/no_image-50x50.png";
// ========== ########## --------------------------- ########## ========== //
// ========== ########## START HANDLE CLIENT PRODUCT ########## ========== //
// ========== ########## --------------------------- ########## ========== //
var dataCreateRowImagesDesc = {
    btnCreate : document.getElementById('btnCreate_rowImage'),
    placeAppendData: document.querySelector('table.table_images.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.table_images.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowImagesDesc['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImagesDesc(dataCreateRowImagesDesc['rowOrderCurrent']);
    dataCreateRowImagesDesc['htmlEl'][dataCreateRowImagesDesc['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowImagesDesc['rowOrderCurrent'] === 0) {
        dataCreateRowImagesDesc['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.table_images.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowImagesDesc['btnClear'] = document.querySelectorAll("table.table_images.table button.btnClear");
    dataCreateRowImagesDesc['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowImagesDesc['btnClear']);
    handleOpenFilemana();
});


function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('image_row')[1]);
            (dataCreateRowImagesDesc['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.table_images.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowImagesDesc['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImagesDesc(order)
{
    return `<tr id="image_row${order}">
                <td class="position_relative">
                    <div class="thumbNail">
                        <img data-src-id="input_image${order}" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <div class="popover position_absolute">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=input_image${order}" type="button" data-id-input-image="input_image${order}" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh mô tả">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" data-id-clear-img="input_image${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="reviewImg[]" id="input_image${order}">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}

//
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

<script>
let btnClearAllProd  = document.querySelector(".prodClearAll");
let listAllProd      = document.querySelectorAll(".prodId_checkItem");
btnClearAllProd.addEventListener('click', function() {
    listAllProd.forEach(el => {
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