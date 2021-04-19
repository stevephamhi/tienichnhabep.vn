$(function() {

    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleToggleStatusItem();
        handleDeleteGroupBanner();
        handleToggleStatus();
    }

    // -----------------------------------------
    //----- FUNCTION HANDLE TOOGLR STATUS -----//
    // -----------------------------------------

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $groupBanner_id      = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "GroupBannerMain/changeStatus",
                method: "POST",
                data: {
                    statusChange   : $statusChange,
                    groupBanner_id : $groupBanner_id,
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        notificationAlert('success','Cập nhật group banner thành công',5000);
                    } else {
                        notificationAlert('error', 'Cập nhật group banner không thành công', 5000);
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
    //-- FUNCTION HANDLE DELETE GroupBanner --//
    // ----------------------------------

    function handleDeleteGroupBanner() {
        let btnDeleteGroupBanner  = $("#table_content table.table tr td.delete a");
        btnDeleteGroupBanner.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa group banner này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $GroupBanner_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "GroupBannerMain/deleteItem",
                    method: "POST",
                    data: { GroupBanner_id: $GroupBanner_id },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            notificationAlert('success','Xóa group banner thành công !',5000);
                            $("#table_content tbody tr[data-id='"+($GroupBanner_id)+"']").stop().fadeOut(500);
                        } else {
                            notificationAlert('error','Xóa group banner không thành công',5000);
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
        let btnTotalMulti           = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxGroupBannerIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl           = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listGroupBannerId = [];
                checkBoxGroupBannerIdEl.each(function() {
                    if(this.checked) {
                        listGroupBannerId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listGroupBannerId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách group banner bạn đã chọn')) {
                            $.ajax({
                                url: "GroupBannerMain/multiDelete",
                                method: "POST",
                                data: {
                                    listGroupBannerId: listGroupBannerId
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        notificationAlert('success','Bạn vừa xóa một danh sách group banner thành công', 5000);
                                        let timeDelayDelete = 500;
                                        listGroupBannerId.forEach(function(el) {
                                            $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                            timeDelayDelete += 200;
                                        });
                                    } else {
                                        notificationAlert('success','Một vài group banner xóa không thành công', 5000);
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
                            url: "GroupBannerMain/multiChangeStatus",
                            method: "POST",
                            data: {
                                listGroupBannerId: listGroupBannerId,
                                statusChange: actionCurrent
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    notificationAlert('success','Bạn vừa cập nhật danh sách froup banner thành công', 5000);
                                    listGroupBannerId.forEach(el => {
                                        let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                        let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                        let classAdd    = actionCurrent;
                                        statusOptionEl.removeClass(classRemove);
                                        statusOptionEl.addClass(classAdd);
                                    });
                                } else {
                                    notificationAlert('error','Một vài group banner cập nhật trạng thái không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                console.log(xhr.status);
                                console.log(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một group banner tức để thực hiện tác vụ !', 5000);
                }
            } else {
                notificationAlert('error','Bạn chưa chọn tác vụ hành động nào !',5000);
            }
        });
    }

    // --------------------------------------------
    // -------- FUNCTION RECOMMENT SEARCH ---------
    // --------------------------------------------

    recommentSearchData();
    function recommentSearchData() {
        // focus
        $("body").delegate(".action_wrap .page_action_item.search input[name='searchStr']","focus", function() {
            let $groupType = $(this).parents('form').attr('data-type');
            console.log($groupType);
            $.ajax({
                url: "GroupBanner"+($groupType)+"/loadTotalGroupBanner",
                method: "POST",
                data: { groupType: $groupType },
                dataType: "json",
                success: (data) => {
                    render_Html(data['recommentData']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        });
        // keyup
        $("body").delegate(".action_wrap .page_action_item.search input[name='searchStr']","keyup", function() {
            let $vlSearch = $(this).val();
            let $groupType = $(this).parents('form').attr('data-type');
            $.ajax({
                url: "GroupBanner"+($groupType)+"/recommentSearch",
                method: "POST",
                data: {
                    vlSearch: $vlSearch,
                    groupType: $groupType
                },
                dataType: "json",
                success: (data) => {
                    render_Html(data['searchData']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }


    function render_Html(datas) {
        let spaceAppendData = $(".search_recomment_wrap_list");
        let htmls = datas.map(function(dataItem) {
            return `
            <li>
                <span>${dataItem['bannerGroup_name']}</span>
            <li/>`;
        });
        spaceAppendData.html(htmls);
        handleChooseKeyWord();
    }

    // ---------------------------------------------
    // -------- FUNCTION HANDLE URL SEARCH ---------
    // ---------------------------------------------

    customizeURLsearh();
    function customizeURLsearh() {
        let formSearch = $(".action_wrap .page_action_item.search .search_module");
        formSearch.submit(function() {
            let searchStr = $(this).find("input[name='searchStr']").val();
            let $groupType = $(this).attr('data-type');
            let urlCurrent = "GroupBanner"+($groupType)+"/index/asc/all/1/";
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
    }

    function handleChooseKeyWord() {
        let recommentSearchItem = $(".search_recomment_wrap_list li span");
        recommentSearchItem.click(function() {
            let valueTextSearch = $(this).text();
            $(".action_wrap .page_action_item.search input[name='searchStr']").val(valueTextSearch);
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

})