$(function() {

    let timeoutToggleAlert = undefined;

    init();

    function init()
    {
        handleDeleteAgency();
        handleToggleStatus();
    }

    function handleDeleteAgency()
    {
        let btnDeleteAgency  = $("#table_content table.table tr td.delete a");
        btnDeleteAgency.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa đại lý này ?")) {
                clearTimeout(timeoutToggleAlert)
                let $agency_id  = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Agency/deleteItem",
                    method: "POST",
                    data: { agency_id : $agency_id  },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa đại lý thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($agency_id )+"']").stop().fadeOut(500);
                            }, 200);
                        } else {
                            setTimeout(function() {
                                notificationAlert('error','Xóa đại lý không thành công',5000);
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

    function handleToggleStatus()
    {
        let btnTotalMulti        = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBox_Agency_id_El = $("#table_content table.table tr .checkItem");
        let valueActionEl        = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let list_agency_id = [];
                checkBox_Agency_id_El.each(function() {
                    if(this.checked) {
                        list_agency_id.push(parseInt($(this).attr('name')));
                    }
                });
                if(list_agency_id.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách đại lý')) {
                            $.ajax({
                                url: "Agency/multiDelete",
                                method: "POST",
                                data: {
                                    list_agency_id: list_agency_id
                                },
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        setTimeout(function() {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách dại lý thành công', 5000);
                                            let timeDelayDelete = 500;
                                            list_agency_id.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        }, 200);
                                    } else {
                                        setTimeout(() => {
                                            notificationAlert('success','Một vài đại lý xóa không thành công', 5000);
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
        "searchRecommentBox" : ".RecommentSearch_action_listAgency",
        "searchSpaceAppend": ".RecommentSearch_action_listAgency .list",
        "searchRecommentItem" : ".RecommentSearch_action_listAgency .list .item",
        "optionSearch": "[name='searchType']",
        "searchInput": ".page_action_item.search input[name='searchStr']",
        "searchForm": ".page_action_item.search .search_module",
        "searchButton": ".page_action_item.search name='searchBtn'",
        "searchTitle": ".RecommentSearch_action_listAgency .title span"
    }
    searchByFullname();
    function searchByFullname() {
        let data = {
            "placeholder" : "Nhập tên người đăng ký",
            "title" : "Danh sách tên người đăng ký",
            "fieldName" : "agency_fullname",
            "ajaxUrl" : "Agency/LoadListAgencyByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }
    function searchByCompany() {
        let data = {
            "placeholder" : "Nhập công ty đã đăng ký",
            "title" : "Danh sách công ty",
            "fieldName" : "agency_company",
            "ajaxUrl" : "Agency/LoadListAgencyByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }
    function searchByPhone() {
        let data = {
            "placeholder" : "Nhập số điện thoại đăng ký",
            "title" : "Danh sách số điện thoại",
            "fieldName" : "agency_phone",
            "ajaxUrl" : "Agency/LoadListAgencyByField"
        };
        $(searchConfig['searchInput']).attr('placeholder', data['placeholder']);
        $(searchConfig['searchTitle']).text(data['title']);
        loadDataSearchByOptionSearch( data['ajaxUrl'], data['fieldName'] );
    }
    function searchByEmail() {
        let data = {
            "placeholder" : "Nhập email đăng ký",
            "title" : "Danh sách email",
            "fieldName" : "agency_email",
            "ajaxUrl" : "Agency/LoadListAgencyByField"
        };
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
        });
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
            case "agency_fullname" : {
                searchByFullname();
                break;
            }
            case "agency_company" : {
                searchByCompany();
                break;
            }
            case "agency_phone" : {
                searchByPhone();
                break;
            }
            case "agency_email" : {
                searchByEmail();
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
        let ajaxUrl = "Agency/searchRecommentByFile";
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
        let urlCurrent = `Agency/index/desc/all/1/${searchOption}/`;
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
        });
    });
});