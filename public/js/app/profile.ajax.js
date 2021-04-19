$(function() {

    __construct();

    function __construct() {
        handleAvatarCustomer();
        handleAdd_address();
        handleDeleteAddress();
        handleEditAddress();
    }

    function handleEditAddress()
    {
        let editAddressData = {
            "btnShow" : ".form_group.list_address .action .edit_address",
            "btnSave" : ".address_info .edit .save_address",
            "baseURL_ajax" : "?controller=Customer&action=update_customerAddress"
        };
        $(editAddressData['btnShow']).click(function() {
            $(this).parents('.address_item').find('.address_info').toggleClass('active');
        });
        $(editAddressData['btnSave']).click(function() {
            let fullnameNew  = $(this).parents('.edit').find('.fullname_new').val();
            let addressNew   = $(this).parents('.edit').find('.address_new').val();
            let phoneNew     = $(this).parents('.edit').find('.phone_new').val();
            let $customer_id = parseInt($(this).parents('.edit').find('.address_new').attr('data-id'));
            let $address_id = parseInt($(this).parents('.address_item').attr('data-id'));
            let error = [];
            if( fullnameNew.length === 0 ) {
                $(this).parents("[data-address-id='" + $address_id + "']").find('.fullname_new_error').text('* Vui lòng nhập họ tên');
                error['fullname'] = true;
            } else {
                $(this).parents("[data-address-id='" + $address_id + "']").find('.fullname_new_error').text('');
                error['fullname'] = false;
            }
            if( addressNew.length === 0 ) {
                $(this).parents("[data-address-id='" + $address_id + "']").find('.address_new_error').text('* Vui lòng nhập địa chỉ Email');
                error['address'] = true;
            } else {
                $(this).parents("[data-address-id='" + $address_id + "']").find('.address_new_error').text('');
                error['address'] = false;
            }

            if( phoneNew.length === 0 ) {
                $(this).parents("[data-address-id='" + $address_id + "']").find('.phone_new_error').text('* Vui lòng nhập SĐT');
                error['phone'] = true;
            } else {
                if( !checkPhone(phoneNew) ) {
                    $(this).parents("[data-address-id='" + $address_id + "']").find('.phone_new_error').text('* SĐT không hợp lệ');
                    error['phone'] = true;
                } else {
                    $(this).parents("[data-address-id='" + $address_id + "']").find('.phone_new_error').text('');
                    error['phone'] = false;
                }
            }

            if( !error['address'] && !error['phone'] && !error['fullname'] ) {
                let $isDefault = undefined;
                if( ($(this).parents('.edit').find('.address_default_value')).prop('checked') ) {
                    $isDefault = '1';
                } else {
                    $isDefault =  '0';
                }
                $.ajax({
                    url: editAddressData['baseURL_ajax'],
                    method: "POST",
                    data: {
                        address_id : $address_id,
                        isDefault : $isDefault,
                        fullname_value : fullnameNew,
                        address_value : addressNew,
                        phone_value : phoneNew,
                        customer_id : $customer_id
                    },
                    dataType: "json",
                    success(data) {
                        if( data['status'] == 'success' ) {
                            location.reload();
                        } else {
                            alert('Cập nhật không thành công');
                        }
                    },
                    error(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                })
            }

        });
    }

    function handleDeleteAddress()
    {
        let deleteAddressData = {
            "btnDelete" : ".form_group.list_address .action .delete_address",
            "baseURL_ajax" : "?controller=Customer&action=handleDeleteAddress"
        };
        $(deleteAddressData['btnDelete']).click(function() {
            if( confirm('Bạn có thực sự muốn xóa địa chỉ này ?') ) {
                $address_id = parseInt($(this).parents('.address_item').attr('data-id'));
                $.ajax({
                    url: deleteAddressData['baseURL_ajax'],
                    method: "POST",
                    data: { address_id : $address_id },
                    dataType: 'json',
                    success: (data) => {
                        if( data['status'] === 'success' ) {
                            location.reload();
                        } else {
                            alert('Xóa địa chỉ không thành công');
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                })
            }
        });
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

    function handleAdd_address()
    {
        let addressData = {
            "btnADD"       : "#add_address_action",
            "fullnameValue": "#customer_fullname",
            "addressValue" : "#customer_address",
            "phoneValue"   : "#customer_phone",
            "defaultValue" : "#setAddress_default",
            "baseURL_ajax" : "?controller=Customer&action=add_customerAddress",
        };

        $(addressData['btnADD']).click(function() {
            let fullnameError = $(".customer_fullname_error");
            let addressError  = $(".customer_address_error");
            let phoneError    = $(".customer_phone_error");
            let customer_fullname = $(addressData['fullnameValue']).val();
            let customer_address  = $(addressData['addressValue']).val();
            let customer_phone    = $(addressData['phoneValue']).val();
            let error = [];

            if( customer_fullname.length === 0 ) {
                fullnameError.text('* Vui lòng nhập họ tên');
                error['fullname'] = true;
            } else {
                fullnameError.text('');
                error['fullname'] = false;
            }
            if( customer_address.length === 0 ) {
                addressError.text('* Vui lòng nhập địa chỉ của bạn');
                error['address'] = true;
            } else {
                addressError.text('');
                error['address'] = false;
            }
            if( customer_phone.length === 0 ) {
                phoneError.text('* Vui lòng nhập số điện thoại');
                error['phone'] = true;
            } else {
                if( !checkPhone(customer_phone) ) {
                    phoneError.text('* Số điện thoại không hợp lệ');
                    error['phone'] = true;
                } else {
                    phoneError.text('');
                    error['phone'] = false;
                }
            }

            if( !error['address'] && !error['phone'] && !error['fullname'] ) {
                let customer_id = parseInt($(addressData['addressValue']).attr('data-id'));
                let isDefault = undefined;
                if( $(addressData['defaultValue']).prop("checked") ) {
                    isDefault = '1';
                } else {
                    isDefault = '0';
                }
                $.ajax({
                    url: addressData['baseURL_ajax'],
                    method: "POST",
                    data: {
                        customer_address : customer_address,
                        customer_phone : customer_phone,
                        customer_fullname : customer_fullname,
                        isDefault : isDefault,
                        customer_id : customer_id
                    },
                    dataType: "json",
                    success(data) {
                        if( data['status'] === 'success' ) {
                            location.reload();
                        } else {
                            addressError.text(data['txtErr']);
                        }
                    },
                    error(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
    }

    function handleAvatarCustomer() {
        /**
         * b1: bắt sự kiện click nút thêm ảnh
         * b2: lấy đường dẫn ảnh
         * b3: gửi lên server
         * b4: xử lý trên server và gửi về
         * b5: đổ ra giao diện
         */
        let customerAvatarData = {
            "btnFile" : "#customer_avatar_file",
            "inputFile" : "#customer_avatar",
            "extendAllow" : ['jpg','jpeg','svg','gif','png'],
            "fileSize"       : 26750 /** (Byte) = 5 MB */,
            "spaceAppendImg" : "#brand_logo_append",
            "inputFileVl"    : "#customer_avatar_file_value",
            "imgDefault" : "./public/images/icon/default-avatar-male.png",
            "baseURL_ajax" : "?controller=User&action=uploadAvatarCustomer"
        };

        $(customerAvatarData['btnFile']).change( function() {
            handleInputFileBrandLogo( this );
        } );

        function handleInputFileBrandLogo(objFileInput) {
            if (objFileInput.files[0]) {
                let fileObj = objFileInput.files[0];
                if( checkExtendFileImg(fileObj.name) ) {
                    if( checkSizeFileImg(fileObj.size) ) {
                        let fileReader = new FileReader();
                        let formData = new FormData();
                        formData.append('file', objFileInput.files[0]);
                        fileReader.onload = function(e) {
                            $(customerAvatarData['spaceAppendImg']).attr('src',e.currentTarget.result);
                            $(customerAvatarData['inputFileVl']).attr('value', e.currentTarget.result);
                            notificationAlert('success', 'Thêm ảnh đại diện thành công', 5000);
                            appendImgURLtoInputHidden(formData);
                        }
                        fileReader.readAsDataURL(objFileInput.files[0]);
                    } else {
                        notificationAlert('error', 'File size quá lớn, yêu cầu nhỏ hơn ' + customerAvatarData['fileSize'] + ' Byte', 5000);
                        resetFileImg();
                    }
                } else {
                    notificationAlert('error', 'Tên file không hợp lệ, chỉ chấp nhận '  + customerAvatarData['extendAllow'].join(", ") +  '', 5000);
                    resetFileImg();
                }
            }
        }

        function appendImgURLtoInputHidden(formData) {
            $.ajax({
                url: customerAvatarData['baseURL_ajax'],
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $(customerAvatarData['inputFile']).val( JSON.stringify(data) );
                },
                error: function( xhr, ajaxOptions, thrownError ) {
                    console.log( xhr.status );
                    console.log( thrownError );
                }
            });
        }

        function resetFileImg() {
            $(customerAvatarData['btnFile']).val('');
            $(customerAvatarData['spaceAppendImg']).attr('src', customerAvatarData['imgDefault']);
        }

        function checkSizeFileImg( fSize ) {
            if( fSize > customerAvatarData['fileSize'] ) {
                return false;
            } return true;
        }

        function checkExtendFileImg( fileName ) {
            /**
             * Sử dụng hàm $.inArray() của jquery để kiễm tra extend file có tồn tại trong extend file arr hay không
             *  -> -1 không có trong extend file arr
             */
            let extendFile = fileName.split( '.' ).pop().toLowerCase();

            if( $.inArray( extendFile, customerAvatarData['extendAllow']) == -1  ) {
                return false;
            } return true;

        }
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
