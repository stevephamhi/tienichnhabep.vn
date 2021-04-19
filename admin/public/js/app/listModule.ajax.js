$(function() {
    var timeoutToggleAlert = undefined;
    let timeoutLoader = undefined;

    init();

    function init() {
        handleToggleStatusItem();
        handleDeleteModule();
        handleToggleStatus();
        handleSelectUrlFlashSale();
    }

    // ---------------------------------------- //
    //----- FUNCTION HANDLE TOOGLR STATUS ----- //
    // ---------------------------------------- //

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            clearTimeout(timeoutLoader);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $module_id  = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "Module/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    module_id  : $module_id
                },
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        timeoutLoader = setTimeout(() => {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('success','Cập nhật trạng thái module thành công',5000);
                        }, 200);
                    } else {
                        timeoutLoader = setTimeout(() => {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('error', 'Cập nhật trạng thái module không thành công', 5000);
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

    // ---------------------------------- //
    //-- FUNCTION HANDLE DELETE MODULE -- //
    // ---------------------------------- //

    function handleDeleteModule() {
        let btnDeleteModule  = $("#table_content table.table tr td.delete a");
        btnDeleteModule.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa module này ?")) {
                clearTimeout(timeoutToggleAlert);
                clearTimeout(timeoutLoader);
                let $module_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Module/deleteItem",
                    method: "POST",
                    data: { module_id: $module_id },
                    dataType: "json",
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    success: (data) => {
                        if(data['status'] === 'success') {
                            timeoutLoader = setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa module thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($module_id)+"']").stop().fadeOut(500);
                            }, 200);
                        } else {
                            timeoutLoader = setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('error','Xóa module không thành công',5000);
                            }, 200);
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
        let btnTotalMulti     = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxModuleIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl     = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            clearTimeout(timeoutLoader);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listModuleId = [];
                checkBoxModuleIdEl.each(function() {
                    if(this.checked) {
                        listModuleId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listModuleId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh module bạn đã chọn')) {
                            $.ajax({
                                url: "Module/multiDelete",
                                method: "POST",
                                data: {
                                    listModuleId: listModuleId
                                },
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        timeoutLoader = setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách module thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listModuleId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        }, 200);
                                    } else {
                                        timeoutLoader = setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Một vài module xóa không thành công', 5000);
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
                            url: "Module/multiChangeStatus",
                            method: "POST",
                            data: {
                                listModuleId: listModuleId,
                                statusChange: actionCurrent
                            },
                            beforeSend: () => {
                                $(".loader_wrap").addClass('open');
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    timeoutLoader = setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('success','Bạn vừa cập nhật danh sách Module thành công', 5000);
                                        listModuleId.forEach(el => {
                                            let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                            let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                            let classAdd    = actionCurrent;
                                            statusOptionEl.removeClass(classRemove);
                                            statusOptionEl.addClass(classAdd);
                                        });
                                    }, 200);
                                } else {
                                    timeoutLoader = setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('error','Một vài Module cập nhật trạng thái không thành công', 5000);
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
                    notificationAlert('error','Vui lòng chọn ít nhất một module để thực hiện tác vụ !', 5000);
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
                url: "Module/getListTotalModule",
                method: "POST",
                dataType: "json",
                success: (data) => {
                    render_Html(data['dataRecomment']);
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
                url: "Module/recommentSearch",
                method: "POST",
                data: {
                    vlSearch: vlSearch
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
            return `<li>
                        <span>${dataItem['module_name']}</span>
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
            let searchStr     = $(this).find("input[name='searchStr']").val();
            let urlCurren     = "Module/index/desc/all/1/";
            $.ajax({
                url: "Ajax/cusomizeUrlSearch",
                method: "POST",
                data: {
                    searchStr: searchStr
                },
                dataType: "json",
                success: (data) => {
                    window.location.replace(urlCurren+data['urlSearch']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    function handleSelectUrlFlashSale()
    {
        let btnChoose = $(".moduleFlashsale");
        btnChoose.click(function() {
            if(confirm("Bạn có chắc chắn chọn module này là đường dẫn cho flash sale")) {
                let $module_id = parseInt($(this).attr('data-module-id'));
                $.ajax({
                    url: "Module/updateUrlFlashsale",
                    method: "POST",
                    data: { module_id : $module_id },
                    dataType: "json",
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    success: (data) => {
                        console.log(data);
                        if(data['status'] === "success") {
                            timeoutLoader = setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Cập nhật đường dẫn flash sale thành công', 5000);
                                location.reload();
                            }, 200);
                        } else {
                            timeoutLoader = setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('error','Cập nhật đường dẫn flash sale không thành công', 5000);
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