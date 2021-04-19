const imgConfig = "./public/images/logo/no_image-50x50.png";

// ========== ########## START MAIN BANNER ########## ========== //
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

var dataCreateRowMainBanner = {
    btnCreate : document.getElementById('btnCreate_rowMainBanner'),
    placeAppendData: document.querySelector('table.main_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.main_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowMainBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImagesDesc(dataCreateRowMainBanner['rowOrderCurrent']);
    dataCreateRowMainBanner['htmlEl'][dataCreateRowMainBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowMainBanner['rowOrderCurrent'] === 0) {
        dataCreateRowMainBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.main_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowMainBanner['btnClear'] = document.querySelectorAll("table.main_banner_table.table button.btnClear");
    dataCreateRowMainBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowMainBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('mainBannerImgRow')[1]);
            (dataCreateRowMainBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.main_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowMainBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImagesDesc(order)
{
    return `<tr id="mainBannerImgRow${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="mainBanner[${order}]['title']" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="mainBanner[${order}]['desc']" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="mainBanner[${order}]['link']" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="mainBanner[${order}]['target']" id="">
                                <option value="">Hiển thị tab mới</option>
                                <option value="">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>600X400</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 200px; display: flex;">
                        <img data-src-id="mainBanner${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="mainBanner[${order}]['image']" id="mainBanner${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=mainBanner${order}" type="button" data-id-input-image="mainBanner${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner chính">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="mainBanner${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="mainBanner[${order}][order]" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// ========== ########## END MAIN BANNER ########## ========== //
// ========== ########## START SUB BANNER ########## ========== //

var dataCreateRowSubBanner = {
    btnCreate : document.getElementById('btnCreate_rowSubBanner'),
    placeAppendData: document.querySelector('table.sub_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.sub_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowSubBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImagesDesc(dataCreateRowSubBanner['rowOrderCurrent']);
    dataCreateRowSubBanner['htmlEl'][dataCreateRowSubBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowSubBanner['rowOrderCurrent'] === 0) {
        dataCreateRowSubBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.sub_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowSubBanner['btnClear'] = document.querySelectorAll("table.sub_banner_table.table button.btnClear");
    dataCreateRowSubBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowSubBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('mainBannerImgRow')[1]);
            (dataCreateRowSubBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.sub_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowSubBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImagesDesc(order)
{
    return `<tr id="subBannerImgRow${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="subBanner[${order}]['title']" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="subBanner[${order}]['desc']" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="subBanner[${order}]['link']" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="subBanner[${order}]['target']" id="">
                                <option value="">Hiển thị tab mới</option>
                                <option value="">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>300x150</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 150px; display: flex;">
                        <img data-src-id="subBanner${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="subBanner[${order}]['image']" id="subBanner${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=subBanner${order}" type="button" data-id-input-image="subBanner${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner phụ">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="subBanner${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="subBanner[${order}][order]" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// ========== ########## END SUB BANNER ########## ========== //

// ========== ########## START RIGHT BANNER ########## ========== //

var dataCreateRowRightBanner = {
    btnCreate : document.getElementById('btnCreate_rowRightBanner'),
    placeAppendData: document.querySelector('table.right_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.right_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowRightBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImagesDesc(dataCreateRowRightBanner['rowOrderCurrent']);
    dataCreateRowRightBanner['htmlEl'][dataCreateRowRightBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowRightBanner['rowOrderCurrent'] === 0) {
        dataCreateRowRightBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.right_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowRightBanner['btnClear'] = document.querySelectorAll("table.right_banner_table.table button.btnClear");
    dataCreateRowRightBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowRightBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('mainBannerImgRow')[1]);
            (dataCreateRowRightBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.right_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowRightBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImagesDesc(order)
{
    return `<tr id="rightBannerImgRow${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="rightBanner[${order}]['title']" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="rightBanner[${order}]['desc']" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2">Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="rightBanner[${order}]['link']" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="rightBanner[${order}]['target']" id="">
                                <option value="">Hiển thị tab mới</option>
                                <option value="">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>300x150</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 300px; height: 150px; display: flex;">
                        <img data-src-id="rightBanner${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="rightBanner[${order}]['image']" id="rightBanner${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=rightBanner${order}" type="button" data-id-input-image="rightBanner${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner phụ">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="rightBanner${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="rightBanner[${order}][order]" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// ========== ########## END RIGHT BANNER ########## ========== //

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
