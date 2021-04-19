$(function() {
    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleToggleStatusItem();
        handleDeleteProd();
        handleToggleStatus();
        handleSelectProd_liquidation();
    }

    function handleSelectProd_liquidation()
    {
        let btnSelectProd_liquidation = $(".select_prod_liquidation");
        btnSelectProd_liquidation.click(function() {
            let $prod_id = parseInt($(this).parents('tr').attr('data-id'));
            let $option_prod_liquidation = undefined;
            if($(this).attr('data-liquidation') == '1') {
                $option_prod_liquidation = "2";
            } else {
                $option_prod_liquidation = "1";
            }
            $.ajax({
                url: "Product/selectToggleProdLiquidation",
                method: "POST",
                data: {
                    option_prod_liquidation : $option_prod_liquidation,
                    prod_id : $prod_id
                },
                dataType: "json",
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                success: (data) => {
                    if(data['status'] === "success") {
                        setTimeout(function() {
                            $(".loader_wrap").removeClass('open');
                            $("label[for='prod_"+($prod_id)+"']").find('input').attr('data-liquidation', $option_prod_liquidation);
                            notificationAlert("success", "Thêm sản phẩm thanh lý thành công !", 5000);
                        },200);
                    } else {
                        notificationAlert("success", "Thêm sản phẩm thanh lý không thành công !", 5000);
                    }
                },
                error: (xhr,ajaxOptions ,thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    // -----------------------------------------
    //----- FUNCTION HANDLE TOOGLR STATUS -----//
    // -----------------------------------------

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $prod_id      = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "Product/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    prod_id      : $prod_id
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        notificationAlert('success','Cập nhật trạng thái sản phẩm thành công',5000);
                    } else {
                        notificationAlert('error', 'Cập nhật trạng thái sản phẩm không thành công', 5000);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    // ----------------------------------
    //-- FUNCTION HANDLE DELETE Prod --//
    // ----------------------------------

    function handleDeleteProd() {
        let btnDeleteProd  = $("#table_content table.table tr td.delete a");
        btnDeleteProd.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa sản phẩm này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $prod_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Product/deleteItem",
                    method: "POST",
                    data: { prod_id: $prod_id },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            notificationAlert('success','Xóa sản phẩm thành công !',5000);
                            $("#table_content tbody tr[data-id='"+($prod_id)+"']").stop().fadeOut(500);
                        } else {
                            notificationAlert('error','Xóa sản phẩm không thành công',5000);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
    }

    // -----------------------------------
    // -- FUNCTION HANDLE TOGGLE STATUS --
    // -----------------------------------

    function handleToggleStatus() {
        let btnTotalMulti        = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxProdIdEl     = $("#table_content table.table tr .checkItem");
        let valueActionEl        = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listProdId = [];
                checkBoxProdIdEl.each(function() {
                    if(this.checked) {
                        listProdId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listProdId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách sản phẩm bạn đã chọn')) {
                            $.ajax({
                                url: "Product/multiDelete",
                                method: "POST",
                                data: {
                                    listProdId: listProdId
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        notificationAlert('success','Bạn vừa xóa một danh sách sản phẩm thành công', 5000);
                                        let timeDelayDelete = 500;
                                        listProdId.forEach(function(el) {
                                            $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                            timeDelayDelete += 200;
                                        });
                                    } else {
                                        notificationAlert('success','Một vài sản phẩm xóa không thành công', 5000);
                                    }
                                },
                                error: (xhr, ajaxOptions, thrownError) => {
                                    console.log(xhr.status);
                                    console.log(thrownError);
                                }
                            });
                        }
                    } else {
                        // handle change
                        $.ajax({
                            url: "Product/multiChangeStatus",
                            method: "POST",
                            data: {
                                listProdId: listProdId,
                                statusChange: actionCurrent
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    notificationAlert('success','Bạn vừa cập nhật danh sách sản phẩm thành công', 5000);
                                    listProdId.forEach(el => {
                                        let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                        let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                        let classAdd    = actionCurrent;
                                        statusOptionEl.removeClass(classRemove);
                                        statusOptionEl.addClass(classAdd);
                                    });
                                } else {
                                    notificationAlert('error','Một vài sản phẩm cập nhật trạng thái không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                console.log(xhr.status);
                                console.log(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một sản phẩm để thực hiện tác vụ !', 5000);
                }
            } else {
                notificationAlert('error','Bạn chưa chọn tác vụ hành động nào !',5000);
            }
        });
    }

    // ----------------------------------
    // -------- FUNCTION NOTIFI ---------
    // ----------------------------------

    function notificationAlert(status = 'error', txtNotifi = 'Bạn chưa tạo thông báo cho chức năng', timeDelay = 2000) {
        $(".alert").addClass('alert_'+(status)+'');
        $(".alert").addClass('open');
        $(".alert span").text(txtNotifi);
        timeoutToggleAlert = setTimeout(function() {
            $(".alert").removeClass('open');
            $(".alert").removeClass('alert_error');
            $(".alert span").text('');
        }, timeDelay);
        let closeAlertEl = $(".alert .close");
        closeAlertEl.click(function() {
            $(".alert").removeClass('open');
            $(".alert span").text('');
        });
    }
});



// ==================================================== //
// ========== FUNCTION HANDLE SEARCH PRODUCT ========== //
// ==================================================== //

$(function() {
    let timeoutValue = undefined;
    let searchConfig = {
        "searchWrapper": "body",
        "searchRecommentBox" : ".RecommentSearch_action_listProd",
        "searchSpaceAppend": ".RecommentSearch_action_listProd .list",
        "searchRecommentItem" : ".RecommentSearch_action_listProd .list .item",
        "optionSearch": "[name='searchType']",
        "searchInput": ".page_action_item.search input[name='searchStr']",
        "searchForm": ".page_action_item.search .search_module",
        "searchButton": ".page_action_item.search name='searchBtn'",
        "searchTitle": ".RecommentSearch_action_listProd .title span"
    };

    searchProd();
    function searchProd() {
        let data  = {
            "placeholder": "Nhập tên sản phẩm",
            "title": "Danh sách tên sản phẩm",
            "fieldName": "prod_name",
            "ajaxUrl": "Product/loadProductByField"
        };

        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch(data['ajaxUrl'], data['fieldName']);
    }

    function searchModel() {
        let data = {
            "placeholder": "Nhập mã model sản phẩm",
            "title": "Danh sách model sản phẩm",
            "fieldName": "prod_model",
            "ajaxUrl": "Product/loadProductByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch(data['ajaxUrl'], data['fieldName']);
    }

    function searchCate() {
        let data  = {
            "placeholder": "Nhập danh mục sản phẩm",
            "title": "Danh sách danh mục sản phẩm",
            "fieldName": "cateProd_name",
            "ajaxUrl": "CateProduct/loadCateByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch(data['ajaxUrl'], data['fieldName']);
    }

    function searchPrice() {
        let data = {
            "placeholder": "Nhập giá sản phẩm",
            "title": "Danh sách giá sản phẩm",
            "fieldName": "prod_currentPrice",
            "ajaxUrl": "Product/loadProductByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch(data['ajaxUrl'], data['fieldName']);
    }

    function loadDataSearchByOptionSearch(ajaxUrl, fieldName) {
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: {
                fieldName: fieldName
            },
            dataType: "json",
            success: function(data) {
                appendDataByOptionSearch(data['listData'], fieldName);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    }

    function appendDataByOptionSearch(listData, fieldName)
    {
        let htmls = listData.map(function(dataItem) {
            return `<li class="item">${dataItem[fieldName]}</li>`;
        });
        $(searchConfig['searchSpaceAppend']).html(htmls.join(" "));
    }

    // change option search
    $(searchConfig['searchWrapper']).delegate(searchConfig['optionSearch'], "change", function() {
        let optionSearchCurrent = $(this).val();
        $(searchConfig['searchInput']).val('');
        switch(optionSearchCurrent)
        {
            case "prod_name" : {
                searchProd();
                break;
            }
            case "prod_model" : {
                searchModel();
                break;
            }
            case "cateProd_name" : {
                searchCate();
                break;
            }
            case "prod_currentPrice" : {
                searchPrice();
                break;
            }
        }
    });

    // Focus input search
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchInput'], "focus", function() {
        $(searchConfig['searchRecommentBox']).stop().fadeIn(0);
    });

    // Blur input search
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchInput'], "blur", function() {
        clearTimeout(timeoutValue);
        timeoutValue = setTimeout(function() {
            $(searchConfig['searchRecommentBox']).stop().fadeOut(0);
        }, 500);
    });

    // Keyup input search (search recomment)
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchInput'], "keyup", function() {
        let $searchValue = $(this).val();
        let $fieldName  = $(searchConfig['optionSearch']).val();
        let ajaxUrl = undefined;
        if($fieldName === 'cateProd_name') {
            ajaxUrl = "CateProduct/searchRecommentByFile";
        } else {
            ajaxUrl = "Product/searchRecommentByFileAjax";
        }
        console.log(ajaxUrl);
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: {
                searchValue: $searchValue,
                fieldName: $fieldName
            },
            dataType: "json",
            success: (data) => {
                appendDataByOptionSearch(data['searchData'], $fieldName);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    // Click recomment item
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchRecommentItem'], "click", function() {
        let textNode = $(this).text();
        $(searchConfig['searchInput']).val(textNode);
    });

    // Search action submit
    $(searchConfig['searchWrapper']).delegate(searchConfig['searchForm'], "submit", function() {
        let searchStr    = $(searchConfig['searchInput']).val();
        let searchOption = $(searchConfig['optionSearch']).val();
        let urlCurrent = `Product/index/asc/all/1/${searchOption}/`;
        $.ajax({
            url: "Ajax/cusomizeUrlSearch",
            method: "POST",
            data: {
                searchStr: searchStr
            },
            dataType: "json",
            success: (data) => {
                let urlNew = urlCurrent+data['urlSearch'];
                window.location.replace(urlNew);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    });
});