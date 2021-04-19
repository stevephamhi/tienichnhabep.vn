$(function() {
    __construct();

    function __construct() {
        handleSendAgainConfirmRegisterCode();
    }

    function handleSendAgainConfirmRegisterCode() {
        let btnSend = $("#btnSendConfirmRegisterCode");
        btnSend.click(function() {
            event.preventDefault();
            let baseUrl = window.location.href;
            let $token  = baseUrl.split("?token=")[1];
            $.ajax({
                url: "?controller=User&action=sendAgainConfirmRegisterCode",
                method: "POST",
                data: { token: $token },
                beforeSend() {
                    $(".modal_loader").addClass("open");
                },
                dataType: "json",
                success: data => {
                    if(data['status'] === 'success') {
                        $(".modal_loader").removeClass("open");
                        location.reload();
                    }
                },
                error: function(xhr, AjaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        });
    }
});