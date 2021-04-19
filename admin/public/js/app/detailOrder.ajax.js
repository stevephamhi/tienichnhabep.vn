$(function() {


    __construct();

    let __setTimeout__ = undefined;

    function __construct() {
        handleSaveUnitShipping();
        handleUpdateStatus();
        handleSendNotification();
    }

    function handleSendNotification() {
        let btnSend = $("#send_notification_btn");
        btnSend.click(function() {
            let txtNotifi = $("#order_notification").val() || null;
            let order_id = parseInt($("#ORDER_ID_EL").attr('data-id'));
            $.ajax({
                url: "Order/sendMessageNotificationOrder",
                method: "POST",
                data: { txtNotifi: txtNotifi, order_id: order_id },
                dataType: "json",
                beforeSend() {
                    $(".loader_update_status").addClass('open');
                },
                success: (data) => {
                    if(data['status'] == 'success') {
                        __setTimeout__ = setTimeout(function() {
                            $(".loader_update_status").removeClass('open');
                            notificationAlert('success','Gửi thành công',5000);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }, 100);
                    } else {
                        __setTimeout__ = setTimeout(function() {
                            $(".loader_update_status").removeClass('open');
                            notificationAlert('error','Gửi không thành công',5000);
                            location.reload();
                        }, 500);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    __setTimeout__ = setTimeout(function() {
                        $(".loader_update_status").removeClass('open');
                        notificationAlert('error','Gửi không thành công',5000);
                        location.reload();
                    }, 500);
                    alert(xhr.status);
                    alert(thrownError);
                }
            })
        });
    }

    function handleUpdateStatus()
    {
        let btnUpdate = $("#btnUpdateStatusOrder");
        btnUpdate.click(function() {
            let $statusVl = $("#statusOrder_el").val();
            let $order_id = parseInt($("#ORDER_ID_EL").attr('data-id'));
            $.ajax({
                url: "Order/updateStatusOrder",
                method: "POST",
                data: {
                    statusVl : $statusVl,
                    order_id : $order_id
                },
                dataType: "json",
                beforeSend() {
                    $(".loader_update_status").addClass('open');
                },
                success: (data) => {
                    if( data['status'] === 'success' ) {
                        __setTimeout__ = setTimeout(function() {
                            $(".loader_update_status").removeClass('open');
                            notificationAlert('success','Cập nhật thành công',5000);
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        }, 100);
                    } else {
                        __setTimeout__ = setTimeout(function() {
                            $(".loader_update_status").removeClass('open');
                            notificationAlert('error','Cập nhật không thành công',5000);
                            location.reload();
                        }, 500);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            })
        });
    }

    function handleSaveUnitShipping() {
        let btnSave = "#saveShippingUnitBtn";
        $("body").delegate(btnSave,"click", function() {
            event.preventDefault();
            let $shippingUnitVl   = $("#shipping_unit").val();
            let $billLadingCodeVl = $("#bill_lading_code").val();
            let $shippingCodeVl   = $("#shipping_code").val();
            let $transportFee     = $("#order_transport_fee").val();

            if( $shippingUnitVl.length > 0 || $billLadingCodeVl.length > 0 || $shippingCodeVl.length > 0 || $transportFee > 0) {
                let $order_id = parseInt($("#ORDER_ID_EL").attr('data-id'));
                clearTimeout(__setTimeout__);
                $.ajax({
                    url: "Order/saveOrderShippingUnit",
                    method: "POST",
                    data: {
                        shippingUnitVl   : $shippingUnitVl,
                        billLadingCodeVl : $billLadingCodeVl,
                        shippingCodeVl   : $shippingCodeVl,
                        order_id         : $order_id,
                        transportFee     : $transportFee
                    },
                    dataType: "json",
                    beforeSend() {
                        $(".loader_wrap").addClass('open');
                    },
                    success: (data) => {
                        if( data['status'] === 'success' ) {
                            __setTimeout__ = setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Cập nhật thành công',5000);
                            }, 500);
                        } else {
                            __setTimeout__ = setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('error','Cập nhật không thành công',5000);
                                location.reload();
                            }, 500);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                })
            } else {
                notificationAlert("success","Chưa có sự thay đổi", 5000);
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