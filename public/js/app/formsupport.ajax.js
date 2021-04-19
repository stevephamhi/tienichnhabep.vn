$(function() {

    let baseURL = $("#baseURL").attr('data-url');
    let time_out_set_regis  = undefined;
    let time_out_set_notifi = undefined;

    __construct();

    function __construct()
    {
        handleSendInfoSupport();
    }

    function handleSendInfoSupport()
    {
        let supportPhoneData = {
            "formEl"        : ".box_support_phone .box_support_body .form_data_support_customer",
            "genderEl"      : ".box_support_phone .box_support_body .form_data_support_customer .gender_support",
            "fullnameEl"    : ".box_support_phone .box_support_body .form_data_support_customer input[name='fullname_support']",
            "phoneEl"       : ".box_support_phone .box_support_body .form_data_support_customer input[name='phone_support']",
            "prodIdEl"      : ".box_support_phone .box_support_body .form_data_support_customer #prod_id_tis_sp_ctm",
            "baseURL"       : "?controller=Customer&action=customersSskingForSupport",
            "notifiEl"      : ".modal_notification_process_regis",
            "closeNotifiEl" : ".modal_notification_mask"
        };

        $("body").delegate(supportPhoneData['formEl'], "submit", function() {
            event.preventDefault();
            clearTimeout(time_out_set_regis);
            clearTimeout(time_out_set_notifi);
            let $gender_vl   = handleGender( supportPhoneData['genderEl'] );
            let $fullname_vl = handleFullname( supportPhoneData['fullnameEl'] );
            let $phone_vl    = handlePhone( supportPhoneData['phoneEl'] );
            let $prod_id     = handleProdId( supportPhoneData['prodIdEl'] );
            if( $gender_vl !== undefined && $fullname_vl !== undefined && $phone_vl !== undefined ) {
                $.ajax({
                    url: baseURL + supportPhoneData['baseURL'],
                    method: "POST",
                    data: {
                        gender_vl   : $gender_vl,
                        fullname_vl : $fullname_vl,
                        phone_vl    : $phone_vl,
                        prod_id     : $prod_id
                    },
                    dataType: "json",
                    beforeSend : () => {
                        $(".modal_loader").addClass('open');
                    },
                    success: (data) => {
                        if(data['status'] === "success") {
                            time_out_set_regis = setTimeout(function () {
                                $(".modal_loader").removeClass('open');
                                handleShowNotification();
                            }, 500);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });

        function handleShowNotification()
        {
            $(supportPhoneData['notifiEl']).addClass('open');
            let time_out_set_notifi = setTimeout(function() {
                $(supportPhoneData['notifiEl']).removeClass('open');
                clearTimeout(time_out_set_notifi);
            }, 10000);

            $(supportPhoneData['closeNotifiEl']).click(function () {
                $(supportPhoneData['notifiEl']).removeClass('open');
                clearTimeout(time_out_set_notifi);
            });
        }

    }

    function handleProdId( prodIdEl )
    {
        let prodId_el = $(prodIdEl);
        let prodId_vl = parseInt(prodId_el.attr('data-id'));
        if( isNaN(prodId_vl) ) {
            return undefined;
        } else {
            return prodId_vl;
        }
    }

    function handleGender( genderEl )
    {
        let gender_el       = $(genderEl);
        let gender_vl       = undefined;
        let gender_error_el = ".gender_sp_error";
        gender_el.each(el => {
            if( gender_el[el].checked ) {
                gender_vl = $(gender_el[el]).val();
            }
        });

        if(gender_vl === undefined) {
            $(gender_error_el).text( 'Vui lòng chọn danh xưng' );
            return undefined;
        } else {
            $(gender_error_el).text( '' );
            return gender_vl;
        }

    }

    function handleFullname( fullnameEl )
    {
        let fullname_el       = $(fullnameEl);
        let fullname_vl       = fullname_el.val();
        let fullname_error_el = ".fullname_sp_error";

        if( fullname_vl.length === 0 ) {
            $(fullname_error_el).text( 'Vui lòng nhập họ và tên' );
            return undefined;
        } else {
            $(fullname_error_el).text( '' );
            return fullname_vl;
        }
    }

    function handlePhone( phoneEl )
    {
        let phone_el       = $(phoneEl);
        let phone_vl       = phone_el.val();
        let phone_error_el = ".phone_sp_error";

        if(phone_vl.length === 0) {
            $(phone_error_el).text( 'Vui lòng nhập số điện thoại' );
            return undefined;
        } else {
            if( !checkPhone(phone_vl) ) {
                $(phone_error_el).text( 'Số điện thoại không hợp lệ' );
                return undefined;
            } else {
                $(phone_error_el).text( '' );
                return phone_vl;
            }
        }
    }

    function checkPhone(phone_vl) {
        if (phone_vl.length !== 10) {
            return false;
        } else {
            let numFirst = parseInt(phone_vl[0]);
            if (numFirst !== 0) {
                return false;
            }
        }
        return true;
    }
});