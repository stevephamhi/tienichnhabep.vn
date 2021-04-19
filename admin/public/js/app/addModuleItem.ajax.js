$(function() {

    let config = {
        wrapper : "body",
    };

    //------------------------------------------------------------------------------//
    //------------------------- RECOMMENT PRODUCT NORMAL ---------------------------//
    //------------------------------------------------------------------------------//

    let getListProd_ties = [];
    let listProd_ties_existsEL = document.querySelectorAll("#block_prod_ties .form_list_wrap .list_content .item");
    listProd_ties_existsEL.forEach(el => {
        let obj = {
            id: el.children[2].value,
            name: el.children[3].value
        }
        getListProd_ties.push(obj);
    });

    let prod_ties = {
        wrapper              : "#block_prod_ties",
        selectOption         : "[name='select_prod_ties']",
        listValue            : getListProd_ties,
        spaceAppendRecomment : "#block_prod_ties .form_list_wrap .list",
        spaceAppendValue     : "#block_prod_ties .form_list_wrap .list_content",
        btnClear             : "#block_prod_ties .form_list_wrap .list_content .close",
        fieldRender          : { id : "prod_id", field : "prod_name" },
        fieldValue           : "block_prod_ties",
        urlAjaxRecomment     : "Product/recommentProductByCateProdId",
        cateRecommentItem    : "#block_prod_ties .form_list_wrap .list [data-option-item]",
    };

    $(config['wrapper']).delegate(prod_ties['selectOption'], "change", function() {
        let idSelect = $(this).val();
        if(idSelect === "flashsale") {
            $.ajax({
                url: "Product/recommentProductFlashsaleToday",
                method: "POST",
                dataType: "json",
                success: (data) => {
                    let htmls = data.map(function(re_item) {
                        return `
                        <label for="${prod_ties['fieldValue']}_${re_item[prod_ties['fieldRender']['id']]}" class="item d_flex align_items_center">
                            <input type="checkbox" data-option-item="${prod_ties['fieldValue']}" value="${re_item[prod_ties['fieldRender']['id']]}" id="${prod_ties['fieldValue']}_${re_item[prod_ties['fieldRender']['id']]}">
                            <span>${re_item[prod_ties['fieldRender']['field']]}</span>
                        </label>`;
                    });
                    $(prod_ties['spaceAppendRecomment']).html(htmls.join(" "));
                    selectRecomment(prod_ties['fieldValue'] , prod_ties['cateRecommentItem'], prod_ties['listValue'], prod_ties['spaceAppendValue'], prod_ties['btnClear']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        } else {
            let data = {
                cateId : parseInt(idSelect)
            }
            render_html_recomment(prod_ties['fieldValue'] ,prod_ties['urlAjaxRecomment'], data, prod_ties['fieldRender'], prod_ties['spaceAppendRecomment']);
            selectRecomment(prod_ties['fieldValue'] , prod_ties['cateRecommentItem'], prod_ties['listValue'], prod_ties['spaceAppendValue'], prod_ties['btnClear']);
        }

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
        });
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


$(function() {

    __construct();


    function __construct()
    {
        handleGetOrderMax();
    }

    function handleGetOrderMax()
    {
        $.ajax({
            url: "Moduleitem/handleGetOrderMax",
            method: "POST",
            dataType: "json",
            success: (data) => {
                data['orderMax'] = data['orderMax'] == null ? 0 : data['orderMax'];
                $("#orderMax_current").attr('value', parseInt(data['orderMax']));
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

});