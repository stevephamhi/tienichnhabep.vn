$(function() {

    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleToggleStatusItem();
        handleDeleteItem();
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
            let $flashSale_id      = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "FlashSale/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    flashSale_id : $flashSale_id
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        notificationAlert('success','Cập nhật flashSale thành công',5000);
                    } else {
                        notificationAlert('error', 'Cập nhật flashSale không thành công', 5000);
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
        let btnDelete_flashSale  = $("#table_content table.table tr td.delete a");
        btnDelete_flashSale.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa flashSale tin này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $flashSale_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "FlashSale/deleteItem",
                    method: "POST",
                    data: { flashSale_id: $flashSale_id },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            notificationAlert('success','Xóa flashSale thành công !',5000);
                            $("#table_content tbody tr[data-id='"+($flashSale_id)+"']").stop().fadeOut(500);
                        } else {
                            notificationAlert('error','Xóa flashSale không thành công',5000);
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

    // -----------------------------------
    // -- FUNCTION HANDLE TOGGLE STATUS --
    // -----------------------------------

    function handleToggleStatus() {
        let btnTotalMulti        = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxflashSaleIdEl     = $("#table_content table.table tr .checkItem");
        let valueActionEl        = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listFlashSaleId = [];
                checkBoxflashSaleIdEl.each(function() {
                    if(this.checked) {
                        listFlashSaleId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listFlashSaleId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách flashSale bạn đã chọn')) {
                            $.ajax({
                                url: "FlashSale/multiDelete",
                                method: "POST",
                                data: {
                                    listFlashSaleId: listFlashSaleId
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        notificationAlert('success','Bạn vừa xóa một danh sách flashSale thành công', 5000);
                                        let timeDelayDelete = 500;
                                        listFlashSaleId.forEach(function(el) {
                                            $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                            timeDelayDelete += 200;
                                        });
                                    } else {
                                        notificationAlert('success','Một vài flashSale xóa không thành công', 5000);
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
                            url: "FlashSale/multiChangeStatus",
                            method: "POST",
                            data: {
                                listFlashSaleId: listFlashSaleId,
                                statusChange: actionCurrent
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    notificationAlert('success','Bạn vừa cập nhật danh sách flashSale thành công', 5000);
                                    listFlashSaleId.forEach(el => {
                                        let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                        let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                        let classAdd    = actionCurrent;
                                        statusOptionEl.removeClass(classRemove);
                                        statusOptionEl.addClass(classAdd);
                                    });
                                } else {
                                    notificationAlert('error','Một vài flashSale cập nhật trạng thái không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một flashSale để thực hiện tác vụ !', 5000);
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