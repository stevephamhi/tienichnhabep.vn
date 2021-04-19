<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Nhóm banner</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thêm nhóm banner khuyến mãi</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="addGroupBanner_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="GroupBannerPromo/add">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <span>Làm mới</span>
                    </a>
                    <a class="btn_item btn_default" href="GroupBannerPromo">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{ if(!empty($statusActionGroupBanner)) { ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionGroupBanner['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionGroupBanner['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionGroupBanner['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php } }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm nhóm banner khuyến mãi</span>
                    </h2>
                </div>
                <div class="panel_body">
                    <form action="" method="POST">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="tab_item active" href="#tab_general">Tổng quan</a>
                                <a class="tab_item" href="#tab_mini_banner">Banner</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle on">
                                                <input type="checkbox" <?php {{
                                                    /*-----------------------------------------------------------------------*/
                                                    echo Validation::setValue("bannerGroup_status_promo") == "on" ? "checked" : null;
                                                    /*-----------------------------------------------------------------------*/
                                                }} ?> name="bannerGroup_status_promo" id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="bannerGroup_name_promo" class="form_label"><strong style="color: #f00;">*</strong> Tên nhóm banner</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="bannerGroup_name_promo" id="bannerGroup_name_promo" value="<?php {{
                                                    /*-----------------------------------------------------------------------*/
                                                    echo Validation::setValue("bannerGroup_name_promo");
                                                    /*-----------------------------------------------------------------------*/
                                                }} ?>" placeholder="Tên nhóm banner" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("bannerGroup_name_promo"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="bannerGroup_customerGroup_ties_promo" class="form_label"><strong style="color: #f00;">*</strong> Nhóm khách hàng</label>
                                            <div class="form_input">
                                                <select class="form_control" name="bannerGroup_customerGroup_ties_promo" id="">
                                                    <option value="1" <?php {{ echo Validation::setValue("bannerGroup_customerGroup_ties_promo") == "1" ? "checked" : null; }} ?>>Mặc định</option>
                                                    <option value="2" <?php {{ echo Validation::setValue("bannerGroup_customerGroup_ties_promo") == "2" ? "checked" : null; }} ?>>Khách hàng tìm năng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="bannerGroup_startDate_promo" class="form_label"><strong style="color: #f00;">* </strong> Ngày bắt đầu</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" name="bannerGroup_startDate_promo" id="bannerGroup_startDate_promo" value="<?php {{
                                                    /*-----------------------------------------------------------------------*/
                                                    echo Validation::setValue("bannerGroup_startDate_promo");
                                                    /*-----------------------------------------------------------------------*/
                                                }} ?>" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("bannerGroup_startDate_promo"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="bannerGroup_endDate_promo" class="form_label"><strong style="color: #f00;">* </strong> Ngày kết thúc</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" name="bannerGroup_endDate_promo" id="bannerGroup_endDate_promo" value="<?php {{
                                                    /*-----------------------------------------------------------------------*/
                                                    echo Validation::setValue("bannerGroup_endDate_promo");
                                                    /*-----------------------------------------------------------------------*/
                                                }} ?>" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("bannerGroup_endDate_promo"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="bannerGroup_order_promo" class="form_label">Sắp xếp</label>
                                            <div class="form_input">
                                                <input class="form_control" type="number" name="bannerGroup_order_promo" id="bannerGroup_order_promo" value="<?php {{
                                                    /*-----------------------------------------------------------------------*/
                                                    echo Validation::setValue("bannerGroup_order_promo");
                                                    /*-----------------------------------------------------------------------*/
                                                }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_mini_banner">
                                    <table class="table mini_banner_banner_table">
                                        <thead>
                                            <tr>
                                                <td>Tiêu đề</td>
                                                <td>Ảnh PC</td>
                                                <td>Sắp xếp</td>
                                                <td>Tác vụ</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php {{ if(!empty(Validation::setValue("listBannerPromo"))) {
                                                $orderRow = 0;
                                                foreach(Validation::setValue("listBannerPromo") as $bannerPromoItem) {
                                                ?>
                                                <tr id="bannerPromoImgRow<?php {{ echo $orderRow; }} ?>">
                                                    <td>
                                                        <div class="form_group d_flex align_items_center">
                                                            <label for="title" class="form_label grid_column_2">Tiêu đề</label>
                                                            <div class="form_input grid_column_9">
                                                                <input class="form_control" type="text" value="<?php {{ echo !empty($bannerPromoItem['title']) ? $bannerPromoItem['title'] : null; }} ?>" name="bannerPromo[<?php {{ echo $orderRow; }} ?>][title]" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                                                            </div>
                                                        </div>
                                                        <div class="form_group d_flex align_items_center">
                                                            <label for="" class="form_label grid_column_2">Mô tả</label>
                                                            <div class="form_input grid_column_9">
                                                                <input class="form_control" type="text" value="<?php {{ echo !empty($bannerPromoItem['desc']) ? $bannerPromoItem['desc'] : null; }} ?>" name="bannerPromo[<?php {{ echo $orderRow; }} ?>][desc]" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                                                            </div>
                                                        </div>
                                                        <div class="form_group d_flex align_items_center">
                                                            <label for="" class="form_label grid_column_2">Đường dẫn</label>
                                                            <div class="form_input grid_column_9">
                                                                <input class="form_control" type="text" value="<?php {{ echo !empty($bannerPromoItem['link']) ? $bannerPromoItem['link'] : null; }} ?>" name="bannerPromo[<?php {{ echo $orderRow; }} ?>][link]" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                                                            </div>
                                                        </div>
                                                        <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                                            <label for="" class="form_label grid_column_2"></label>
                                                            <div class="form_input grid_column_9">
                                                                <select class="form_control" name="bannerPromo[<?php {{ echo $orderRow; }} ?>][target]" id="">
                                                                    <option value="blank" <?php {{ echo $bannerPromoItem['target'] == "blank" ? "selected" : null; }} ?>>Hiển thị tab mới</option>
                                                                    <option value="self"  <?php {{ echo $bannerPromoItem['target'] == "self"  ? "selected" : null; }} ?>>Hiển thị tab hiện tại</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="position_relative">
                                                        <span>300x150</span>
                                                        <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 200px; display: flex;">
                                                            <img data-src-id="bannerPromoPC<?php {{ echo $orderRow; }} ?>" class="full_size img_cover" src="<?php {{
                                                                /*---------------------------------------------------------------------*/
                                                                echo !empty($bannerPromoItem['bannerPC']) ? $bannerPromoItem['bannerPC'] : "./public/images/logo/no_image-50x50.png";
                                                                /*---------------------------------------------------------------------*/
                                                            }} ?>" alt="">
                                                        </div>
                                                        <input type="hidden" name="bannerPromo[<?php {{ echo $orderRow; }} ?>][bannerPC]" value="<?php {{
                                                            /*-------------------------------------------------------------------------*/
                                                            echo !empty($bannerPromoItem['bannerPC']) ? $bannerPromoItem['bannerPC'] : null;
                                                            /*-------------------------------------------------------------------------*/
                                                        }} ?>" id="bannerPromoPC<?php {{ echo $orderRow; }} ?>">
                                                        <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                                                            <div class="popover_content d_flex align_items_center">
                                                                <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=bannerPromoPC<?php {{ echo $orderRow; }} ?>" type="button" data-id-input-image="bannerPromoPC<?php {{ echo $orderRow; }} ?>" class="button_image btn btn_primary iframe-btn" title="Thêm banner chính">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <button type="button" style="padding: 7px 12px;" data-id-clear-img="bannerPromoPC<?php {{ echo $orderRow; }} ?>" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input class="form_control" type="number" name="bannerPromo[<?php {{ echo $orderRow; }} ?>][order]" value="<?php {{
                                                            /*--------------------------------------------------------------------*/
                                                            echo !empty($bannerPromoItem['order']) ? $bannerPromoItem['order'] : null;
                                                            /*--------------------------------------------------------------------*/
                                                        }} ?>" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn_danger btnClear">
                                                            <i class="fa fa-minus-circle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                                $orderRow++;
                                                }
                                            } }} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td>
                                                    <button type="button" id="btnCreate_rowMiniBanner" class="btn btn_primary">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <?php {{ echo Validation::formError("listBannerPromo"); }} ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>
<script type="text/javascript" class="handle__js__app">
const imgConfig = "./public/images/logo/no_image-50x50.png";

// ========== ########## START MAIN BANNER ########## ========== //

var dataCreateRowMiniBanner = {
    btnCreate : document.getElementById('btnCreate_rowMiniBanner'),
    placeAppendData: document.querySelector('table.mini_banner_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.mini_banner_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowMiniBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByMiniBanner(dataCreateRowMiniBanner['rowOrderCurrent']);
    dataCreateRowMiniBanner['htmlEl'][dataCreateRowMiniBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowMiniBanner['rowOrderCurrent'] === 0) {
        dataCreateRowMiniBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.mini_banner_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowMiniBanner['btnClear'] = document.querySelectorAll("table.mini_banner_banner_table.table button.btnClear");
    dataCreateRowMiniBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowMiniBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('miniBannerImgRow')[1]);
            (dataCreateRowMiniBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.mini_banner_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowMiniBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByMiniBanner(order)
{
    return `<tr id="bannerPromoImgRow${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="bannerPromo[${order}][title]" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="bannerPromo[${order}][desc]" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="bannerPromo[${order}][link]" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="bannerPromo[${order}][target]" id="">
                                <option value="">Hiển thị tab mới</option>
                                <option value="">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>300x150</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 200px; display: flex;">
                        <img data-src-id="bannerPromoPC${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="bannerPromo[${order}][bannerPC]" id="bannerPromoPC${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=bannerPromoPC${order}" type="button" data-id-input-image="bannerPromoPC${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner chính">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="bannerPromoPC${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="bannerPromo[${order}][order]" value="${order+1}" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// ========== ########## END MAIN BANNER ########## ========== //

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