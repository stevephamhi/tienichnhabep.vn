$(function() {
    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleToggleStatusItem();
        handleDeleteItem();
        handleToggleStatus();
    }

    // ----------------------------------------//
    //----- FUNCTION HANDLE TOOGLR STATUS -----//
    // ----------------------------------------//

    function handleToggleStatusItem()
    {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $review_id      = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "review/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    review_id    : $review_id
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        notificationAlert('success','Cập nhật trạng thái review thành công',5000);
                    } else {
                        notificationAlert('error', 'Cập nhật trạng thái review không thành công', 5000);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    }

    // --------------------------------//
    //-- FUNCTION HANDLE DELETE ITEM --//
    // --------------------------------//

    function handleDeleteItem() {
        let btnDelete_review  = $("#table_content table.table tr td.delete a");
        btnDelete_review.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa review này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $review_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Review/deleteItem",
                    method: "POST",
                    data: { review_id: $review_id },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            notificationAlert('success','Xóa review thành công !',5000);
                            $("#table_content tbody tr[data-id='"+($review_id)+"']").stop().fadeOut(500);
                        } else {
                            notificationAlert('error','Xóa review không thành công',5000);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
            }
        });
    }

    // ----------------------------------- //
    // -- FUNCTION HANDLE TOGGLE STATUS -- //
    // ----------------------------------- //

    function handleToggleStatus() {
        let btnTotalMulti      = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxReviewIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl      = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listReviewId = [];
                checkBoxReviewIdEl.each(function() {
                    if(this.checked) {
                        listReviewId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listReviewId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách review bạn đã chọn')) {
                            $.ajax({
                                url: "Review/multiDelete",
                                method: "POST",
                                data: {
                                    listReviewId: listReviewId
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        notificationAlert('success','Bạn vừa xóa một danh sách review thành công', 5000);
                                        let timeDelayDelete = 500;
                                        listReviewId.forEach(function(el) {
                                            $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                            timeDelayDelete += 200;
                                        });
                                    } else {
                                        notificationAlert('success','Một vài review xóa không thành công', 5000);
                                    }
                                },
                                error: (xhr, ajaxOptions, thrownError) => {
                                    alert(xhr.status);
                                    alert(thrownError);
                                }
                            });
                        }
                    } else {
                        // handle change
                        $.ajax({
                            url: "Review/multiChangeStatus",
                            method: "POST",
                            data: {
                                listReviewId: listReviewId,
                                statusChange: actionCurrent
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    notificationAlert('success','Bạn vừa cập nhật danh sách review thành công', 5000);
                                    listReviewId.forEach(el => {
                                        let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                        let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                        let classAdd    = actionCurrent;
                                        statusOptionEl.removeClass(classRemove);
                                        statusOptionEl.addClass(classAdd);
                                    });
                                } else {
                                    notificationAlert('error','Một vài review cập nhật trạng thái không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một review để thực hiện tác vụ !', 5000);
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

// =================================================== //
// ========== FUNCTION HANDLE SEARCH REVIEW ========== //
// =================================================== //

$(function() {
    let timeoutValue = undefined;
    let searchConfig = {
        "searchWrapper": "body",
        "searchRecommentBox" : ".RecommentSearch_action_listReview",
        "searchSpaceAppend": ".RecommentSearch_action_listReview .list",
        "searchRecommentItem" : ".RecommentSearch_action_listReview .list .item",
        "optionSearch": "[name='searchType']",
        "searchInput": ".page_action_item.search input[name='searchStr']",
        "searchForm": ".page_action_item.search .search_module",
        "searchButton": ".page_action_item.search name='searchBtn'",
        "searchTitle": ".RecommentSearch_action_listReview .title span"
    };

    searchNameCustomer();
    function searchNameCustomer() {
        let data = {
            "placeholder": "Nhập tên khách hàng",
            "title": "Danh sách tên khách hàng",
            "fieldName": "review_customerFullname",
            "ajaxUrl": "Review/loadReviewByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch(data['ajaxUrl'], data['fieldName']);
    }

    function searchContentReview() {
        let data = {
            "placeholder": "Nhập nội dung review",
            "title": "Danh sách nội dung content",
            "fieldName": "review_content",
            "ajaxUrl": "Review/loadReviewByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch(data['ajaxUrl'], data['fieldName']);
    }

    function searchNameProd() {
        let data = {
            "placeholder": "Nhập tên sản phẩm",
            "title": "Danh sách sản phẩm",
            "fieldName": "prod_name",
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
            success: (data) => {
                appendDataByOptionSearch(data['listData'], fieldName);
                console.log(data);
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

    function appendDataByOptionSearch(listData, fieldName)
    {
        let htmls = listData.map(function(dataItem) {
            return `<li class="item">${dataItem[fieldName]}</li>`;
        });
        $(searchConfig['searchSpaceAppend']).html(htmls.join(" "));
    }

    $(searchConfig['searchWrapper']).delegate(searchConfig['optionSearch'], "change", function() {
        let optionSearchCurrent = $(this).val();
        $(searchConfig['searchInput']).val('');
        switch(optionSearchCurrent)
        {
            case "review_customerFullname" : {
                searchNameCustomer();
                break;
            }
            case "prod_name" : {
                searchNameProd();
                break;
            }
            case "review_content" : {
                searchContentReview();
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
        if($fieldName === 'prod_name') {
            ajaxUrl = "Product/searchRecommentByFile";
        } else {
            ajaxUrl = "Review/searchRecommentByFile";
        }
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
                alert(xhr.status);
                alert(thrownError);
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
        let urlCurrent = `Review/index/asc/all/1/${searchOption}/`;
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
                alert(xhr.status);
                    alert(thrownError);
            }
        })
    });

});