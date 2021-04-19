$(function() {


    let baseURL = $("#baseURL").attr('data-url');

    __construct();

    function __construct()
    {
        handleRegisAgency();
    }

    function handleRegisAgency()
    {

        let dataRegisAgencyCompanyName = $("#form_register_agency");


        let agencyData = {
            "formEl" : "#form_register_agency",
            "fullname" : "#form_register_agency #fullname_agency",
            "company" : "#form_register_agency #company_name_agency",
            "phone" : "#form_register_agency #phone_agency",
            "email" : "#form_register_agency #email_agency",
            "baseURL" : "?controller=Agency&action=regisMember",
        };

        $("body").delegate(agencyData['formEl'], "submit", function() {
            event.preventDefault();
            // if( (dataRegisAgencyCompanyName.attr('data-regis-companyname').length) === 0 ) {
                let $fullname = handleFullname(agencyData['fullname']);
                let $company = handleCompany(agencyData['company']);
                let $phone = handlePhone(agencyData['phone']);
                let $email = handleEmail(agencyData['email']);

                if( $fullname !== undefined && $company !== undefined && $phone !== undefined && $email !== undefined ) {
                    $.ajax({
                        url: baseURL + agencyData['baseURL'],
                        method: "POST",
                        data: {
                            fullname : $fullname,
                            company  : $company,
                            phone    : $phone,
                            email    : $email
                        },
                        dataType: "json",
                        beforeSend: () => {
                            $(".modal_loader").addClass('open');
                        },
                        success: (data) => {
                            if(data['status'] === 'success') {
                                $(".modal_loader").removeClass('open');
                                handleShowPopupSendEmailSuccess(data['dataAgency']);
                            }
                        },
                        error: (xhr, ajaxOptions, thrownError) => {
                            console.log(xhr.status)
                            console.log(thrownError);
                        }
                    })
                }
            // } else {
            //     alert("Bạn vừa đăng ký hợp tác trở thành đại lý thành công !");
            // }
        });

        function handleShowPopupSendEmailSuccess(dataAgency)
        {
            let popupNotificationMail    = $(".modal_mail");
            let btnCloseNotificationMail = $(".modal_mail .modal_mail_mask");
            let emailValueEl             = $(".modal_mail .modal_mail_content .modal_mail_body .btn_mail");
            emailValueEl.attr('href', "mailTo: "+(dataAgency['agency_email'])+"");
            popupNotificationMail.addClass('open');
            timeOut__modalMail = setTimeout(function() {
                popupNotificationMail.removeClass('open');
                window.location.replace(baseURL);
                emailValueEl.attr('href', "");
            }, 10000);
            btnCloseNotificationMail.click(function() {
                popupNotificationMail.removeClass('open');
                clearTimeout(timeOut__modalMail);
                window.location.replace(baseURL);
                emailValueEl.attr('href', "");
            });
        }
    }

    function handleCompany( companyEl )
    {
        let company_el       = $(companyEl);
        let company_vl       = company_el.val();
        let company_error_el = ".company_error";

        if( company_vl.length === 0 ) {
            $(company_error_el).text( 'Vui lòng nhập tên công ty' );
            return undefined;
        } else {
            $(company_error_el).text( '' );
            return company_vl;
        }
    }

    function handleFullname( fullnameEl )
    {
        let fullname_el       = $(fullnameEl);
        let fullname_vl       = fullname_el.val();
        let fullname_error_el = ".fullname_error";

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
        let phone_error_el = ".phone_error";

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

    function handleEmail( emailEl )
    {
        let email_el       = $(emailEl);
        let email_vl       = email_el.val();
        let email_error_el = ".email_error";

        if(email_vl.length === 0) {
            $(email_error_el).text( 'Vui lòng nhập địa chỉ email' );
            return undefined;
        } else {
            if( !checkEmail(email_vl) ) {
                $(email_error_el).text( 'Email không hợp lệ' );
                return undefined;
            } else {
                $(email_error_el).text( '' );
                return email_vl;
            }
        }
    }

    function checkEmail(email_vl) {
        let reg = /^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/;
        if (reg.test(email_vl)) return true;
        return false;
    }
});