$(function() {
    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleToggleStatusItem();
        handleDeletePolicyItem();
        handleToggleStatus();
    }

    // ---------------------------------------- //
    // ---- FUNCTION HANDLE TOOGLR STATUS ----- //
    // ---------------------------------------- //

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $policy_id      = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "Policy/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    policy_id    : $policy_id
                },
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        setTimeout(function() {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('success','Cập nhật trạng thái chính sách thành công',5000);
                        }, (200));
                    } else {
                        setTimeout(function() {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('error', 'Cập nhật trạng thái chính sách không thành công', 5000);
                        }, (200));
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    // ----------------------------------------- //
    // -- FUNCTION HANDLE DELETE POLICY GROUP -- //
    // ----------------------------------------- //

    function handleDeletePolicyItem() {
        let btnDeletePolicy  = $("#table_content table.table tr td.delete a");
        btnDeletePolicy.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa chính sách này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $policy_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Policy/deleteItem",
                    method: "POST",
                    data: { policy_id: $policy_id },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa chính sách thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($policy_id)+"']").stop().fadeOut(500);
                            },200);
                        } else {
                            notificationAlert("success", "Xóa chính sách không thành công", 5000);
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
        let checkBoxPolicyIdEl  = $("#table_content table.table tr .checkItem");
        let valueActionEl       = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listPolicyId = [];
                checkBoxPolicyIdEl.each(function() {
                    if(this.checked) {
                        listPolicyId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listPolicyId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách chính sách đã chọn')) {
                            $.ajax({
                                url: "Policy/multiDelete",
                                method: "POST",
                                data: {
                                    listPolicyId: listPolicyId
                                },
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === "success") {
                                        setTimeout(function() {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách chính sách thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listPolicyId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        },200);
                                    } else {
                                        notificationAlert('success','Một vài chính sách xóa không thành công', 5000);
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
                            url: "Policy/multiChangeStatus",
                            method: "POST",
                            data: {
                                listPolicyId: listPolicyId,
                                statusChange: actionCurrent
                            },
                            beforeSend: () => {
                                $(".loader_wrap").addClass('open');
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] === "success") {
                                    setTimeout(function() {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('success','Bạn vừa cập nhật trạng thái danh sách chính sách thành công', 5000);
                                        listPolicyId.forEach(el => {
                                            let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                            let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                            let classAdd    = actionCurrent;
                                            statusOptionEl.removeClass(classRemove);
                                            statusOptionEl.addClass(classAdd);
                                        });
                                    },200);
                                } else {
                                    notificationAlert('error','Bạn vừa cập nhật trạng thái danh sách chính sách không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một chính sách để thực hiện tác vụ !', 5000);
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
                url: "Policy/getAllPolicy",
                dataType: "json",
                success: (data) => {
                    render_Html(data['listPolicy']);
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
                url: "Policy/recommentSearch",
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
                        <span>${dataItem['policy_title']}</span>
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
            let urlCurrent = "Policy/index/desc/all/1/";
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