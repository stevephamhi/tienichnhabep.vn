$(function() {

    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleChangeOrder();
        handleToggleStatusItem();
        handleDeleteDisplay();
        handleToggleStatus();
    }


    // ----------------------------------------//
    //----- FUNCTION HANDLE CHANGE STATUS -----//
    // ----------------------------------------//

    function handleChangeOrder() {
        let btnSaveDisplayOrder = $(".form_button.save_display_order");
        btnSaveDisplayOrder.click(function() {
            let dispOrderCurrent = parseInt($(this).attr('data-order'));
            let $dispOrderChange = parseInt($(this).parents('td').find('input').val());
            if(dispOrderCurrent === $dispOrderChange) {
                notificationAlert("error", "Bạn chưa chọn vị trí hiển thị mới !", 5000);
            } else {
                $displayID = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Display/updateDisplayOrder",
                    method: "POST",
                    data: {
                        dispOrderChange: $dispOrderChange,
                        displayID: $displayID
                    },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert("success", "Cập nhật thành công !", 5000);
                            },200);
                        } else {
                            notificationAlert("success", "Cập nhật không thành công !", 5000);
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

    // ---------------------------------------- //
    //----- FUNCTION HANDLE TOOGLR STATUS ----- //
    // ---------------------------------------- //

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $display_id   = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "Display/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    display_id      : $display_id
                },
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        setTimeout(() => {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('success','Cập nhật bố cục thành công',5000);
                        },200);
                    } else {
                        notificationAlert('error', 'Cập nhật bố cục không thành công', 5000);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    }

    // -----------------------------------//
    //-- FUNCTION HANDLE DELETE DISPLAY --//
    // -----------------------------------//

    function handleDeleteDisplay() {
        let btnDeleteDisplay  = $("#table_content table.table tr td.delete a");
        btnDeleteDisplay.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa bố cục này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $display_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Display/deleteItem",
                    method: "POST",
                    data: { display_id: $display_id },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa bố cục thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($display_id)+"']").stop().fadeOut(500);
                            }, (200));
                        } else {
                            notificationAlert('error','Xóa bố cục không thành công',5000);
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
        let btnTotalMulti       = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxDisplayIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl       = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listDisplayId = [];
                checkBoxDisplayIdEl.each(function() {
                    if(this.checked) {
                        listDisplayId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listDisplayId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách bố cục bạn đã chọn')) {
                            $.ajax({
                                url: "Display/multiDelete",
                                method: "POST",
                                data: {
                                    listDisplayId: listDisplayId
                                },
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách bản tin thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listDisplayId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        }, (200));
                                    } else {
                                        notificationAlert('success','Một vài bản tin xóa không thành công', 5000);
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
                            url: "Display/multiChangeStatus",
                            method: "POST",
                            data: {
                                listDisplayId: listDisplayId,
                                statusChange: actionCurrent
                            },
                            beforeSend: () => {
                                $(".loader_wrap").addClass('open');
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('success','Bạn vừa cập nhật danh sách bản tin thành công', 5000);
                                        listDisplayId.forEach(el => {
                                            let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                            let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                            let classAdd    = actionCurrent;
                                            statusOptionEl.removeClass(classRemove);
                                            statusOptionEl.addClass(classAdd);
                                        }, (200));
                                    });
                                } else {
                                    notificationAlert('error','Một vài bản tin tức cập nhật trạng thái không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một bản tin tức để thực hiện tác vụ !', 5000);
                }
            } else {
                notificationAlert('error','Bạn chưa chọn tác vụ hành động nào !',5000);
            }
        });
    }

    // -------------------------------------------- //
    // -------- FUNCTION RECOMMENT SEARCH --------- //
    // -------------------------------------------- //

    recommentSearchData();
    function recommentSearchData() {
        $("body").delegate(".action_wrap .page_action_item.search input[name='searchStr']", "focus", function() {
            $.ajax({
                url: "Display/getAllDisplay",
                method: "POST",
                dataType: "json",
                success: (data) => {
                    render_Html(data['listDisplay']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
        $("body").delegate(".action_wrap .page_action_item.search input[name='searchStr']","keyup", function() {
            let vlSearch = $(this).val();
            $.ajax({
                url: "Display/recommentSearch",
                method: "POST",
                data: {
                    vlSearch: vlSearch
                },
                dataType: "json",
                success: (data) => {
                    render_Html(data['searchData']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    }

    function render_Html(datas) {
        let spaceAppendData = $(".search_recomment_wrap_list");
        let htmls = datas.map(function(dataItem) {
            return `<li>
                        <span>${dataItem['display_title']}</span>
                    <li/>`;
        });
        spaceAppendData.html(htmls);
        handleChooseKeyWord();
    }

    function handleChooseKeyWord() {
        let recommentSearchItem = $(".search_recomment_wrap_list li span");
        recommentSearchItem.click(function() {
            let valueTextSearch = $(this).text();
            $(".action_wrap .page_action_item.search input[name='searchStr']").val(valueTextSearch);
        });
    }

    // --------------------------------------------- //
    // -------- FUNCTION HANDLE URL SEARCH --------- //
    // --------------------------------------------- //

    customizeURLsearh();
    function customizeURLsearh() {
        let formSearch = $(".action_wrap .page_action_item.search .search_module");
        formSearch.submit(function() {
            let searchStr = $(this).find("input[name='searchStr']").val();
            let urlCurrent = "Display/index/asc/all/1/";
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
            });
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