$(function () {

    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleChangeOrder();
        handleToggleStatusItem();
        handleDeleteBackground();
        handleToggleStatus();
    }

    // ---------------------------------------- //
    // -------- FUNCTION CHANGE ORDER --------- //
    // ---------------------------------------- //

    function handleChangeOrder() {
        let btnSaveBackgroundOrder = $(".form_button.save_background_order");
        btnSaveBackgroundOrder.click(function() {
            let backgroundOrderCurrent  = parseInt($(this).attr('data-order'));
            let $backgroundOrderChange = parseInt($(this).parents('td').find('input').val());
            if(backgroundOrderCurrent === $backgroundOrderChange) {
                notificationAlert("error", "Bạn chưa chọn vị trí hiển thị mới !", 5000);
            } else {
                $background_ID = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Background/updateBackgroundOrder",
                    method: "POST",
                    data: {
                        backgroundOrderChange: $backgroundOrderChange,
                        background_ID: $background_ID
                    },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert("success", "Cập nhật vị trí hiển thị thành công", 5000);
                            },200);
                        } else {
                            notificationAlert("success", "Cập nhật vị trí hiển thị không thành công", 5000);
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

    // ----------------------------------------//
    //----- FUNCTION HANDLE TOOGLR STATUS -----//
    // ----------------------------------------//

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            console.log('ok');
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $background_id      = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "Background/changeStatus",
                method: "POST",
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                data: {
                    statusChange  : $statusChange,
                    background_id : $background_id
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        setTimeout(() => {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('success','Cập nhật trạng thái background thành công',5000);
                        }, 200);
                    } else {
                        setTimeout(() => {$(".loader_wrap").addClass('open');
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('error', 'Cập nhật trạng thái background không thành công', 5000);
                        }, 200);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    }

    // --------------------------------------- //
    // -- FUNCTION HANDLE DELETE BACKGROUND -- //
    // --------------------------------------- //

    function handleDeleteBackground() {
        let btnDeleteBackground  = $("#table_content table.table tr td.delete a");
        btnDeleteBackground.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa background này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $background_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Background/deleteItem",
                    method: "POST",
                    data: { background_id: $background_id },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa background thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($background_id)+"']").stop().fadeOut(500);
                            },200);
                        } else {
                            notificationAlert("success", "Xóa background không thành công", 5000);
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
        let checkBoxBackgroundIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl      = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listBackgroundId = [];
                checkBoxBackgroundIdEl.each(function() {
                    if(this.checked) {
                        listBackgroundId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listBackgroundId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách Background bạn đã chọn')) {
                            $.ajax({
                                url: "Background/multiDelete",
                                method: "POST",
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                data: {
                                    listBackgroundId: listBackgroundId
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách Background thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listBackgroundId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        }, 200);
                                    } else {
                                        setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Một vài Background xóa không thành công', 5000);
                                        }, 200);
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
                            url: "Background/multiChangeStatus",
                            method: "POST",
                            beforeSend: () => {
                                $(".loader_wrap").addClass('open');
                            },
                            data: {
                                listBackgroundId: listBackgroundId,
                                statusChange: actionCurrent
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('success','Bạn vừa cập nhật danh sách Background thành công', 5000);
                                        listBackgroundId.forEach(el => {
                                            let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                            let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                            let classAdd    = actionCurrent;
                                            statusOptionEl.removeClass(classRemove);
                                            statusOptionEl.addClass(classAdd);
                                        });
                                    }, 200);
                                } else {
                                    setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('error','Một vài Background cập nhật trạng thái không thành công', 5000);
                                    }, 200);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một Background để thực hiện tác vụ !', 5000);
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
                url: "Background/getAllBackground",
                method: "POST",
                dataType: "json",
                success: (data) => {
                    render_Html(data['listBackground']);
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
                url: "Background/recommentSearch",
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
                        <span>${dataItem['background_name']}</span>
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
            let urlCurrent = "Background/index/desc/all/1/";
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