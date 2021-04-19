$(function() {

    let timeoutToggleAlert = undefined;

    init();

    function init()
    {
        handleDeleteSupportcustomer();
        handleToggleStatus();
    }

    // ----------------------------------------- //
    // -- FUNCTION HANDLE DELETE CATE PRODUCT -- //
    // ----------------------------------------- //

    function handleDeleteSupportcustomer()
    {
        let btnDeleteSupportcustomer  = $("#table_content table.table tr td.delete a");
        btnDeleteSupportcustomer.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa yêu cầu hỗ trợ này ?")) {
                clearTimeout(timeoutToggleAlert)
                let $sp_customer_id  = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "SupportCustomer/deleteItem",
                    method: "POST",
                    data: { sp_customer_id : $sp_customer_id  },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa yêu cầu hỗ trợ thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($sp_customer_id )+"']").stop().fadeOut(500);
                            }, 200);
                        } else {
                            setTimeout(function() {
                                notificationAlert('error','Xóa yêu cầu hỗ trợ không thành công',5000);
                            }, 200);
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

    // ----------------------------------- //
    // -- FUNCTION HANDLE TOGGLE STATUS -- //
    // ----------------------------------- //

    function handleToggleStatus() {
        let btnTotalMulti        = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxSupportcustomerIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl        = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listSupportcustomerId = [];
                checkBoxSupportcustomerIdEl.each(function() {
                    if(this.checked) {
                        listSupportcustomerId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listSupportcustomerId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách danh yêu cầu hỗ trợ đã chọn')) {
                            $.ajax({
                                url: "SupportCustomer/multiDelete",
                                method: "POST",
                                data: {
                                    listSupportcustomerId: listSupportcustomerId
                                },
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        setTimeout(function() {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách yêu cầu hỗ trợ thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listSupportcustomerId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        }, 200);
                                    } else {
                                        setTimeout(() => {
                                            notificationAlert('success','Một vài yêu cầu hỗ trợ xóa không thành công', 5000);
                                        }, 200);
                                    }
                                },
                                error: (xhr, ajaxOptions, thrownError) => {
                                    console.log(xhr.status);
                                    console.log(thrownError);
                                }
                            });
                        }
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một danh mục sản phẩm để thực hiện tác vụ !', 5000);
                }
            } else {
                notificationAlert('error','Bạn chưa chọn tác vụ hành động nào !',5000);
            }
        });
    }

    // ---------------------------------- //
    // -------- FUNCTION NOTIFI --------- //
    // ---------------------------------- //

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
    }
    searchByName();
    function searchByName() {
        let data = {
            "placeholder" : "Nhập tên khách hàng",
            "title" : "Danh sách khách hàng",
            "fieldName" : "sp_customer_fullname",
            "ajaxUrl" : "SupportCustomer/loadListSupportcustomerByField"
        }

        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }
    function searchByPhone() {
        let data = {
            "placeholder" : "Nhập số điện thoại khách hàng",
            "title" : "Danh sách số điện thoại",
            "fieldName" : "sp_customer_phone",
            "ajaxUrl" : "SupportCustomer/loadListSupportcustomerByField"
        }
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }
    function loadDataSearchByOptionSearch( ajaxUrl, fieldName )
    {
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: {
                fieldName : fieldName
            },
            dataType: "json",
            success: (data) => {
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
            case "sp_customer_fullname" : {
                searchByName();
                break;
            }
            case "sp_customer_phone" : {
                searchByPhone();
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
        let ajaxUrl = "SupportCustomer/searchRecommentByFile";
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
        })
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
        let urlCurrent = `SupportCustomer/index/asc/all/1/${searchOption}/`;
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