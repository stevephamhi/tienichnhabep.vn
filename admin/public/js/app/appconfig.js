// ========== ########## CREATE IMAGES DESC ########## ========== //
$(function() {
    var createImagesDesc = {
        wrapperEl : $("body"),
        btnCreate : "#btnCreate_rowImage",
        placeAppendData: $('table.table_images.table tbody'),
        rowOrderCurrent: $('table.table_images.table tbody tr:last-child').index() + 1,
        btnClear: "table.table_images.table tbody .btnClear",
        btnOpenFileManager : ".popover_content .button_image"
    };

    (createImagesDesc['wrapperEl']).delegate(createImagesDesc['btnOpenFileManager'], 'click', function() {
        let $input_id = $(this).parents('td').find("input[type='hidden']").attr('id');
        let html =
        `<div id="modal_filemanager">
            <iframe id="fancybox-frame1606273874780" name="fancybox-frame1606273874780" class="fancybox-iframe" allowfullscreen="allowfullscreen" allow="autoplay; fullscreen" src="./public/plugins/filemanager/dialog.php?type=0&amp;field_id=${$input_id}" scrolling="auto"></iframe>
        </div>`;
        createImagesDesc['wrapperEl'].prepend(html);
    });

    function responsive_filemanager_callback(field_id){
        var url = $('#'+field_id).val();
        $("#prod_avatar_src").attr('src',url);
    }

    (createImagesDesc['wrapperEl']).delegate(createImagesDesc['btnClear'], 'click', function() {
        $(this).parents('tr').remove();
        let numRow = $('table.table_images.table tbody tr:last-child').index() + 1;
        if(numRow === 0) {
            createImagesDesc['rowOrderCurrent'] = 0;
        }
    });
    (createImagesDesc['wrapperEl']).delegate(createImagesDesc['btnCreate'],'click', function() {
        event.preventDefault();
        let htmlEl = createHtmlElRow(createImagesDesc['rowOrderCurrent']);
        if(createImagesDesc['rowOrderCurrent'] == 0) {
            createImagesDesc['placeAppendData'].append(htmlEl);
        } else {
            createImagesDesc['placeAppendData'].find('tr:last-child').after(htmlEl);
        }
        createImagesDesc['rowOrderCurrent'] ++;
    });

    function createHtmlElRow(order) {
        return `<tr id="image_row${order}">
                    <td class="position_relative">
                        <div class="thumbNail">
                            <img src="./public/images/logo/no_image-50x50.png" alt="">
                        </div>
                        <div class="popover position_absolute">
                            <div class="popover_content">
                                <button type="button" class="button_image btn btn_primary" title="Thêm ảnh mô tả">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="prod_image_desc[${order}][image]" id="input_image${order}">
                    </td>
                    <td>
                        <input type="number" min="0" name="prod_image_desc[${order}][sort_order]" placeholder="Sắp xếp" class="form_control">
                    </td>
                    <td>
                        <button type="button" class="btn btn_danger btnClear">
                            <i class="fa fa-minus-circle"></i>
                        </button>
                    </td>
                </tr>
                `;
    }
});


// ========== ########## CREATE SPECIAL ########## ========== //
$(function() {
    var createFlashSale = {
        wrapperEl : $("body"),
        btnCreate : "#btnCreate_rowFlashSale",
        placeAppendData: $('table.flash_sale tbody'),
        rowOrderCurrent: $('table.flash_sale tbody tr:last-child').index() + 1,
        btnClear: "table.flash_sale tbody .btnClear",
    };

    (createFlashSale['wrapperEl']).delegate(createFlashSale['btnClear'], 'click', function() {
        $(this).parents('tr').remove();
        let numRow = $('table.flash_sale tbody tr:last-child').index() + 1;
        if(numRow === 0) {
            createImagesDesc['rowOrderCurrent'] = 0;
        }
    });

    (createFlashSale['wrapperEl']).delegate(createFlashSale['btnCreate'],'click', function() {
        event.preventDefault();
        let htmlEl = createHtmlElRow(createFlashSale['rowOrderCurrent']);
        if(createFlashSale['rowOrderCurrent'] == 0) {
            createFlashSale['placeAppendData'].append(htmlEl);
        } else {
            createFlashSale['placeAppendData'].find('tr:last-child').after(htmlEl);
        }
        createFlashSale['rowOrderCurrent'] ++;
    });

    function createHtmlElRow(order) {
        return `<tr>
        <td id="flashSale_row${order}">
            <select class="form_control" name="prod_flashSale[0][customer_group_id]">
                <option value="">Mặc định</option>
                <option value="">Khách hàng tìm năng</option>
            </select>
        </td>
        <td>
            <input class="form_control" type="text" name="prod_flashSale[${order}][priority]" placeholder="Độ ưu tiên" autocomplete="off" spellcheck="false">
        </td>
        <td>
            <input class="form_control" type="number" name="prod_flashSale[${order}][price]" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
        </td>
        <td>
            <div class="input_group">
                <input class="form_control dateStart_value" type="date" name="prod_flashSale[${order}][date_start]" placeholder="Thời gian bắt đầu" autocomplete="off" spellcheck="false">
            </div>
        </td>
        <td>
            <div class="input_group">
                <input class="form_control dateEnd_value" type="date" name="prod_flashSale[${order}][date_end]" placeholder="Thời gian kết thúc" autocomplete="off" spellcheck="false">
            </div>
        </td>
        <td>
            <button type="button" class="btn btn_danger btnClear">
                <i class="fa fa-minus-circle"></i>
            </button>
        </td>
    </tr>`;
    }
});

// ========== ########## CREATE SPECIAL ########## ========== //
$(function() {
    var createSpecial = {
        wrapperEl : $("body"),
        btnCreate : "#btnCreate_rowSpecial",
        placeAppendData: $('table.special.content tbody'),
        rowOrderCurrent: $('table.special.content tbody tr:last-child').index() + 1,
        btnClear: "table.special.content tbody .btnClear",
    };

    (createSpecial['wrapperEl']).delegate(createSpecial['btnClear'], 'click', function() {
        $(this).parents('tr').remove();
        let numRow = $('table.special.content tbody tr:last-child').index() + 1;
        if(numRow === 0) {
            createSpecial['rowOrderCurrent'] = 0;
        }
    });

    (createSpecial['wrapperEl']).delegate(createSpecial['btnCreate'],'click', function() {
        event.preventDefault();
        let htmlEl = createHtmlElRow(createSpecial['rowOrderCurrent']);
        if(createSpecial['rowOrderCurrent'] == 0) {
            createSpecial['placeAppendData'].append(htmlEl);
        } else {
            createSpecial['placeAppendData'].find('tr:last-child').after(htmlEl);
        }
        createSpecial['rowOrderCurrent'] ++;
    });

    function createHtmlElRow(order) {
        return `
        <tr id="special_row${order}">
            <td>
                <input class="form_control" type="text" name="prod_special[${order}]['title']" placeholder="Tiêu đề khuyến mãi" autocomplete="off" spellcheck="false">
            </td>
            <td>
                <input class="form_control" type="number" name="prod_special[${order}]['order']" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
            </td>
            <td>
                <input class="form_control" type="text" name="prod_special[${order}]['link']" placeholder="Link liên kết" autocomplete="off" spellcheck="false">
            </td>
            <td>
                <button type="button" class="btn btn_danger btnClear">
                    <i class="fa fa-minus-circle"></i>
                </button>
            </td>
        </tr>
        `;
    }
});


// ========== ########## CREATE IMAGES SPECAIL ########## ========== //
$(function() {
    var createSpecial = {
        wrapperEl : $("body"),
        btnCreate : "#btnCreate_rowSpecialImg",
        placeAppendData: $('table.special.images tbody'),
        rowOrderCurrent: $('table.special.images tbody tr:last-child').index() + 1,
        btnClear: "table.special.images tbody .btnClear",
    };

    (createSpecial['wrapperEl']).delegate(createSpecial['btnClear'], 'click', function() {
        $(this).parents('tr').remove();
        let numRow = $('table.special.images tbody tr:last-child').index() + 1;
        if(numRow === 0) {
            createSpecial['rowOrderCurrent'] = 0;
        }
    });

    (createSpecial['wrapperEl']).delegate(createSpecial['btnCreate'],'click', function() {
        event.preventDefault();
        let htmlEl = createHtmlElRow(createSpecial['rowOrderCurrent']);
        if(createSpecial['rowOrderCurrent'] == 0) {
            createSpecial['placeAppendData'].append(htmlEl);
        } else {
            createSpecial['placeAppendData'].find('tr:last-child').after(htmlEl);
        }
        createSpecial['rowOrderCurrent'] ++;
    });

    function createHtmlElRow(order) {
        return `
        <tr id="specialImg_row${order}">
            <td>
                <span class="thumbNail">
                    <img class="img_cover full_size" src="./public/images/logo/no_image-50x50.png" alt="">
                </span>
            </td>
            <td>
                <input class="form_control" type="text" name="prod_specialImg[${order}][price]" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
            </td>
            <td>
                <input class="form_control" type="number" name="prod_specialImg[${order}][price]" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
            </td>
            <td>
                <input class="form_control" type="text" name="prod_specialImg[${order}][price]" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
            </td>
            <td>
                <button type="button" class="btn btn_danger btnClear">
                    <i class="fa fa-minus-circle"></i>
                </button>
            </td>
        </tr>
        `;
    }
});


