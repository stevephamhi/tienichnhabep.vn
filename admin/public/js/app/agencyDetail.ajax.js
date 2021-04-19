$(function() {
    init();

    function init()
    {
        handleUpdateStatusAgency();
    }

    function handleUpdateStatusAgency() {
        let btnUpdate = $("#status_value");
        btnUpdate.change(function() {
            let statusCurrent = $(this).attr("data-status");
            let $statusChange = undefined;
            if(statusCurrent === "no_process") {
                $statusChange   = "processed";
            } else {
                $statusChange   = "no_process";
            }
            let $agency_id = parseInt($(this).attr('data-id'));
            $.ajax({
                url: "Agency/updateStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    agency_id : $agency_id
                },
                beforeSend: function() {
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
                }
            });
        });
    }
});