$(function() {
    init();

    function init()
    {
        handleUpdateStatusSupport();
    }

    function handleUpdateStatusSupport() {
        let btnUpdate = $("#status_value");
        btnUpdate.change(function() {
            let statusCurrent = $(this).attr("data-status");
            let $statusChange = undefined;
            if(statusCurrent === "no_process") {
                $statusChange   = "processed";
            } else {
                $statusChange   = "no_process";
            }
            let $sp_customer_id = parseInt($(this).attr('data-id'));
                $.ajax({
                    url: "SupportCustomer/updateStatus",
                    method: "POST",
                    data: {
                        statusChange : $statusChange,
                        sp_customer_id : $sp_customer_id
                    },
                    beforeSend: (data) => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status']) {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                location.reload();
                            }, 500);
                        } else {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('error','Cập nhật trạng thái không thành công !',5000);
                            }, 1000);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                })
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