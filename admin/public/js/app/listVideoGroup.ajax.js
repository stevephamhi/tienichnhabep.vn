$(function() {

    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleChangeOrder();
        handleToggleStatusItem();
        handleDeleteVideoGroup();
        handleToggleStatus();
    }

    // ---------------------------------------- //
    // -------- FUNCTION CHANGE ORDER --------- //
    // ---------------------------------------- //

    function handleChangeOrder() {
        let btnSaveVideoGroupOrder = $(".form_button.save_videoGroup_order");
        btnSaveVideoGroupOrder.click(function() {
            let videoGroupOrderCurrent  = parseInt($(this).attr('data-order'));
            let $videoGrouppOrderChange = parseInt($(this).parents('td').find('input').val());
            if(videoGroupOrderCurrent === $videoGrouppOrderChange) {
                notificationAlert("error", "Bạn chưa chọn vị trí hiển thị mới !", 5000);
            } else {
                $videoGroupID = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "VideoGroup/updateVideoGroupOrder",
                    method: "POST",
                    data: {
                        videoGrouppOrderChange: $videoGrouppOrderChange,
                        videoGroupID: $videoGroupID
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

    // --------------------------------------------- //
    //----- FUNCTION HANDLE TOOGLE STATUS ITEM ----- //
    // --------------------------------------------- //

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $videoGroup_id   = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "VideoGroup/changeStatus",
                method: "POST",
                data: {
                    statusChange  : $statusChange,
                    videoGroup_id : $videoGroup_id
                },
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === "success") {
                        setTimeout(function() {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert("success", "Cập nhật trạng thái thành công", 5000);
                        },200);
                    } else {
                        notificationAlert("success", "Cập nhật trạng thái không thành công", 5000);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    }

    // ---------------------------------------- //
    // -- FUNCTION HANDLE DELETE VIDEO GROUP -- //
    // ---------------------------------------- //

    function handleDeleteVideoGroup() {
        let btnDeleteVideoGroup  = $("#table_content table.table tr td.delete a");
        btnDeleteVideoGroup.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa nhóm video này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $videoGroup_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "VideoGroup/deleteItem",
                    method: "POST",
                    data: { videoGroup_id: $videoGroup_id },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa nhóm video thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($videoGroup_id)+"']").stop().fadeOut(500);
                            },200);
                        } else {
                            notificationAlert("success", "Xóa nhóm video không thành công", 5000);
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
        let checkBoxVideoGroupIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl       = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listVideoGroupId = [];
                checkBoxVideoGroupIdEl.each(function() {
                    if(this.checked) {
                        listVideoGroupId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listVideoGroupId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách nhóm video đã chọn')) {
                            $.ajax({
                                url: "VideoGroup/multiDelete",
                                method: "POST",
                                data: {
                                    listVideoGroupId: listVideoGroupId
                                },
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === "success") {
                                        setTimeout(function() {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách nhóm video thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listVideoGroupId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        },200);
                                    } else {
                                        notificationAlert('success','Một vài nhóm video xóa không thành công', 5000);
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
                            url: "VideoGroup/multiChangeStatus",
                            method: "POST",
                            data: {
                                listVideoGroupId: listVideoGroupId,
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
                                        notificationAlert('success','Bạn vừa cập nhật trạng thái danh sách nhóm video thành công', 5000);
                                        listVideoGroupId.forEach(el => {
                                            let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                            let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                            let classAdd    = actionCurrent;
                                            statusOptionEl.removeClass(classRemove);
                                            statusOptionEl.addClass(classAdd);
                                        });
                                    },200);
                                } else {
                                    notificationAlert('error','Bạn vừa cập nhật trạng thái danh sách nhóm video không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một nhóm video để thực hiện tác vụ !', 5000);
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
                url: "VideoGroup/getAllVideoGroup",
                method: "POST",
                dataType: "json",
                success: (data) => {
                    render_Html(data['listVideoGroup']);
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
                url: "VideoGroup/recommentSearch",
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
                        <span>${dataItem['videoGroup_name']}</span>
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
            let urlCurrent = "VideoGroup/index/desc/all/1/";
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