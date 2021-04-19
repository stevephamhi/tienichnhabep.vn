$(function() {

    let config = {
        wrapper : "body",
    };

    //-------------------------------------------------------------------------//
    //------------------------- RECOMMENT CATE MAIN ---------------------------//
    //-------------------------------------------------------------------------//
    let getListCateProd_rela = [];
    let listCateProd_existsEL = document.querySelectorAll("#block_cateProd_relay .form_list_wrap .list_content .item");
    listCateProd_existsEL.forEach(el => {
        let obj = {
            id: el.children[2].value,
            name: el.children[3].value
        }
        getListCateProd_rela.push(obj);
    });

    let cateProd_rela = {
        wrapper              : "#block_cateProd_relay",
        selectOption         : "[name='select_cateProd_rela']",
        listValue            : getListCateProd_rela,
        spaceAppendRecomment : "#block_cateProd_relay .form_list_wrap .list",
        spaceAppendValue     : "#block_cateProd_relay .form_list_wrap .list_content",
        btnClear             : "#block_cateProd_relay .form_list_wrap .list_content .close",
        fieldRender          : { id : "cateProd_id", field : "cateProd_name" },
        fieldValue           : "cateProd_rela",
        urlAjaxRecomment     : "CateProduct/recommentCateProdByCateProdParentId",
        cateRecommentItem    : "#block_cateProd_relay .form_list_wrap .list [data-option-item]",
    };

    $(config['wrapper']).delegate(cateProd_rela['selectOption'], "change", function() {
        let data = {
            cateId : parseInt($(this).val())
        }
        render_html_recomment(cateProd_rela['fieldValue'] ,cateProd_rela['urlAjaxRecomment'], data, cateProd_rela['fieldRender'], cateProd_rela['spaceAppendRecomment']);
        selectRecomment(cateProd_rela['fieldValue'] , cateProd_rela['cateRecommentItem'], cateProd_rela['listValue'], cateProd_rela['spaceAppendValue'], cateProd_rela['btnClear']);
    });

    //---------------------------------------------------------------------------------//
    //------------------------- RECOMMENT PRODUCT HIGHLIGHT ---------------------------//
    //---------------------------------------------------------------------------------//
    let getListProd_highlight = [];
    let listProd_highlight_existsEL = document.querySelectorAll("#block_prod_highlight .form_list_wrap .list_content .item");
    listProd_highlight_existsEL.forEach(el => {
        let obj = {
            id: el.children[2].value,
            name: el.children[3].value
        }
        getListProd_highlight.push(obj);
    });

    let prod_highlight = {
        wrapper              : "#block_prod_highlight",
        selectOption         : "[name='select_prod_highlight']",
        listValue            : getListProd_highlight,
        spaceAppendRecomment : "#block_prod_highlight .form_list_wrap .list",
        spaceAppendValue     : "#block_prod_highlight .form_list_wrap .list_content",
        btnClear             : "#block_prod_highlight .form_list_wrap .list_content .close",
        fieldRender          : { id : "prod_id", field : "prod_name" },
        fieldValue           : "prod_highlight",
        urlAjaxRecomment     : "Product/recommentProductByCateProdId",
        cateRecommentItem    : "#block_prod_highlight .form_list_wrap .list [data-option-item]",
    };

    $(config['wrapper']).delegate(prod_highlight['selectOption'], "change", function() {
        let data = {
            cateId : parseInt($(this).val())
        }
        render_html_recomment(prod_highlight['fieldValue'] ,prod_highlight['urlAjaxRecomment'], data, prod_highlight['fieldRender'], prod_highlight['spaceAppendRecomment']);
        selectRecomment(prod_highlight['fieldValue'] , prod_highlight['cateRecommentItem'], prod_highlight['listValue'], prod_highlight['spaceAppendValue'], prod_highlight['btnClear']);
    });

    //------------------------------------------------------------------------------//
    //------------------------- RECOMMENT PRODUCT NORMAL ---------------------------//
    //------------------------------------------------------------------------------//

    let getListProd_normal = [];
    let listProd_normal_existsEL = document.querySelectorAll("#block_prod_normal .form_list_wrap .list_content .item");
    listProd_normal_existsEL.forEach(el => {
        let obj = {
            id: el.children[2].value,
            name: el.children[3].value
        }
        getListProd_normal.push(obj);
    });

    let prod_normal = {
        wrapper              : "#block_prod_normal",
        selectOption         : "[name='select_prod_normal']",
        listValue            : getListProd_normal,
        spaceAppendRecomment : "#block_prod_normal .form_list_wrap .list",
        spaceAppendValue     : "#block_prod_normal .form_list_wrap .list_content",
        btnClear             : "#block_prod_normal .form_list_wrap .list_content .close",
        fieldRender          : { id : "prod_id", field : "prod_name" },
        fieldValue           : "prod_normal",
        urlAjaxRecomment     : "Product/recommentProductByCateProdId",
        cateRecommentItem    : "#block_prod_normal .form_list_wrap .list [data-option-item]",
    };

    $(config['wrapper']).delegate(prod_normal['selectOption'], "change", function() {
        let data = {
            cateId : parseInt($(this).val())
        }
        render_html_recomment(prod_normal['fieldValue'] ,prod_normal['urlAjaxRecomment'], data, prod_normal['fieldRender'], prod_normal['spaceAppendRecomment']);
        selectRecomment(prod_normal['fieldValue'] , prod_normal['cateRecommentItem'], prod_normal['listValue'], prod_normal['spaceAppendValue'], prod_normal['btnClear']);
    });

    //------------------------------------------------------------------------------//
    //------------------------- RECOMMENT PRODUCT MOBILE ---------------------------//
    //------------------------------------------------------------------------------//
    let getListProd_mobile = [];
    let listProd_mobile_existsEL = document.querySelectorAll("#block_prod_mobile .form_list_wrap .list_content .item");
    listProd_mobile_existsEL.forEach(el => {
        let obj = {
            id: el.children[2].value,
            name: el.children[3].value
        }
        getListProd_mobile.push(obj);
    });

    let prod_mobile = {
        wrapper              : "#block_prod_mobile",
        selectOption         : "[name='select_prod_mobile']",
        listValue            : getListProd_mobile,
        spaceAppendRecomment : "#block_prod_mobile .form_list_wrap .list",
        spaceAppendValue     : "#block_prod_mobile .form_list_wrap .list_content",
        btnClear             : "#block_prod_mobile .form_list_wrap .list_content .close",
        fieldRender          : { id : "prod_id", field : "prod_name" },
        fieldValue           : "prod_mobile",
        urlAjaxRecomment     : "Product/recommentProductByCateProdId",
        cateRecommentItem    : "#block_prod_mobile .form_list_wrap .list [data-option-item]",
    };

    $(config['wrapper']).delegate(prod_mobile['selectOption'], "change", function() {
        let data = {
            cateId : parseInt($(this).val())
        }
        render_html_recomment(prod_mobile['fieldValue'] ,prod_mobile['urlAjaxRecomment'], data, prod_mobile['fieldRender'], prod_mobile['spaceAppendRecomment']);
        selectRecomment(prod_mobile['fieldValue'] , prod_mobile['cateRecommentItem'], prod_mobile['listValue'], prod_mobile['spaceAppendValue'], prod_mobile['btnClear']);
    });

    function render_html_recomment(fieldValue, urlAjaxRecomment, data, fieldRender, spaceAppendRecomment)
    {
        $.ajax({
            url: urlAjaxRecomment,
            method: "POST",
            data: { data: data },
            dataType: "json",
            success: (data) => {
                let htmls = data['dataRecomment'].map(function(re_item) {
                    return `
                    <label for="${fieldValue}_${re_item[fieldRender['id']]}" class="item d_flex align_items_center">
                        <input type="checkbox" data-option-item="${fieldValue}" value="${re_item[fieldRender['id']]}" id="${fieldValue}_${re_item[fieldRender['id']]}">
                        <span>${re_item[fieldRender['field']]}</span>
                    </label>`;
                });
                $(spaceAppendRecomment).html(htmls.join(" "));
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    }

    function selectRecomment(fieldValue, cateRecommentItem, listValue, spaceAppendValue, btnClear) {
        $(config['wrapper']).delegate(cateRecommentItem, "change", function() {
            if(this.checked) {
                let id = $(this).val();
                if(!checkRecommentExist(id, listValue)) {
                    let obj = {
                        "id"   : $(this).val(),
                        "name" : $(this).parent().find('span').text()
                    };
                    listValue.push(obj);
                }
            } else {
                let id = $(this).val();
                listValue.forEach((el, index) => {
                    if(el['id'] === id) {
                       listValue.splice(index,1);
                    }
                });
            }
            /*-------------------------------------------------------*/
            render_html_value(fieldValue, listValue, spaceAppendValue, btnClear);
            /*-------------------------------------------------------*/
        });
    }

    function checkRecommentExist(id, listValue) {
        let numExists = 0;
        listValue.forEach(el => {
            if(el['id'] === id) {
                numExists ++;
            }
        });
        if(numExists === 0) return false;
        return true;
    }

    function render_html_value(fieldValue, listValue, spaceAppendValue, btnClear) {
        let orderRow = 0;
        let htmls = listValue.map(function(re_item) {
            orderRow ++;
            return `
            <li class="item">
                <span>${re_item['name']}</span>
                <span class="close" data-name="${fieldValue}" data-id="${re_item['id']}"></span>
                <input type="hidden" name="${fieldValue}[${orderRow}][id]" value="${re_item['id']}">
                <input type="hidden" name="${fieldValue}[${orderRow}][name]" value="${re_item['name']}">
            </li>`;
        });
        $(spaceAppendValue).html(htmls.join(" "));
        clear_html_value_item(listValue, btnClear, fieldValue, spaceAppendValue);
    }

    function clear_html_value_item(listValue, btnClear, fieldValue, spaceAppendValue) {
        $(config['wrapper']).delegate(btnClear, "click", function() {
            let id = parseInt($(this).attr('data-id'));
            listValue.forEach((el, index) => {
                if(parseInt(el['id']) === id) {
                    listValue.splice(index,1);
                    let idElCheckbox = $("#"+$(this).attr('data-name') + `_${id}`)[0];
                    if(idElCheckbox !== undefined) {
                        idElCheckbox.checked = false;
                    }
                }
            });
            render_html_value(fieldValue, listValue, spaceAppendValue, btnClear)
        });
    }
});