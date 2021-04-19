$(function() {
    __construct();
    let timeOutSet__ = undefined;
    function __construct() {
        handleUpdateNumQtyOrder();
        handleUpdateAddress();
        handleAdd_address();
        handleDeleteCart();
        handleSelectAddressOrder();
        handleOrder();
        handleCancelOrder();
        handleDeleteOrder();
    }

    function handleDeleteOrder()
    {
        let orderData = {
            "btnDelete" : ".deleteOrderHistory_btn",
            "baseURL_ajax" : "?controller=Order&action=handleDeleteItem"
        }
        $(orderData['btnDelete']).click(function() {
            if(confirm('Xác nhận xóa đơn hàng ?')) {
                let $order_id = parseInt($(this).attr('od-id'));
                $.ajax({
                    url: orderData['baseURL_ajax'],
                    method: "POST",
                    data: { order_id : $order_id },
                    dataType: "json",
                    success: function(data) {
                        if(data['status'] === 'success') {
                            location.reload();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                })
            }
        });
    }

    function handleCancelOrder()
    {
        let orderData = {
            "btnCancel" : ".confirm_cancel_order_action",
            "baseURL_ajax" : "?controller=Cart&action=handleCancelOrder"
        };
        $(orderData['btnCancel']).click(function() {
            let error = [];
            let select_reason_error = $(".select_reason_error");
            let detail_reason_error = $(".detail_reason_error");
            let select_reason_value = $("#reason_cancel_order").val();
            let detail_reason_value = $("#detail_reason_cancel").val();

            if(select_reason_value.length === 0) {
                select_reason_error.text('* Vui lòng chọn lý do hủy đơn');
                error['select'] = true;
            } else {
                select_reason_error.text('');
                error['select'] = false;
            }

            if(detail_reason_value.length === 0) {
                detail_reason_error.text('* Vui lòng điền lý do chi tiết');
                error['detail'] = true;
            } else {
                detail_reason_error.text('');
                error['detail'] = false;
            }

            if( !error['select'] && !error['detail'] ) {
                let order_id = parseInt($(this).attr('od-id'));
                $.ajax({
                    url : orderData['baseURL_ajax'],
                    method: "POST",
                    data: {
                        order_reason_cancel  : select_reason_value,
                        order_detail_cancel : detail_reason_value,
                        order_id : order_id
                    },
                    dataType: "json",
                    success(data) {
                        if(data['status'] === 'success') {
                            location.reload();
                        } else {
                            alert('Hủy đơn hàng không thành công');
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

    function handleOrder()
    {
        let orderData = {
            "btnOrder" : "#order_action_button",
            "baseURL_ajax" : "?controller=Cart&action=handleOrderFromCustomer",
        };
        $(orderData['btnOrder']).click(function() {
            let whoLogin = $(this).parents('.ShippingAddress').find('[data-log]').attr('data-log');
            let infoCustomer = null;
            let error = [];
            if( whoLogin === 'cLog' ) {
                let fullname = handleCustomerFullnameOrder();
                let phone    = handleCustomerPhoneOrder();
                let email    = handleCustomerEmailOrder();
                let address  = handleCustomerAddressOrder();
                if( fullname !== undefined && phone !== undefined && email !== undefined && address !== undefined ) {
                    infoCustomer = { fullname, phone, email, address };
                    error['customer_info']  = false;
                    error['address_select'] = false;
                } else {
                    error['customer_info'] = true;
                }
            } else {
                error['customer_info'] = false;
                let addressSelect = $(this).parents('.ShippingAddress').find('[data-s-address]').attr('data-s-address');
                if(addressSelect === 'not_selected') {
                    error['address_select'] = true;
                    $(".select_address_error").text('* Vui lòng chọn địa chỉ giao hàng');
                } else {
                    error['address_select'] = false;
                }
                infoCustomer = null;
            }

            if( !error['customer_info'] && !error['address_select'] ) {
                let paymentMethod = $(".select_payment_method:checked").attr('data-vnTitle');
                let customer_note = $("#customer_note").val() || null;
                $.ajax({
                    url: orderData['baseURL_ajax'],
                    method: "POST",
                    data: { infoCustomer : infoCustomer, paymentMethod: paymentMethod, customer_note : customer_note },
                    beforeSend() {
                        $(".modal_loader").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            window.location.replace(data['baseURL_orderSuccess']);
                        } else {
                            $(".modal_loader").removeClass('open');
                            notificationAlert('error', 'Đặt hàng không thành công, vui lòng thử lại', 5000);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        $(".modal_loader").removeClass('open');
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
    }

    function checkEmail(email_vl) {
        let reg = /^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/;
        if (reg.test(email_vl)) return true;
        return false;
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

    function handleCustomerAddressOrder() {
        let address_error = $(".customer_address_error");
        let address_value = $("#customer_address").val();
        if(address_value.length === 0) {
            address_error.text('* Vui lòng nhập địa chỉ');
            return undefined;
        } else {
            address_error.text('');
            return address_value;
        }
    }


    function handleCustomerPhoneOrder() {
        let phone_error = $(".customer_phone_error");
        let phone_value = $("#customer_phone").val();
        if(phone_value.length === 0) {
            phone_error.text('* Vui lòng nhập SĐT');
            return undefined;
        } else {
            if(!checkPhone(phone_value)) {
                phone_error.text('*SĐT không hợp lệ');
                return undefined
            } else {
                phone_error.text('');
                return phone_value;
            }
        }
    }

    function handleCustomerEmailOrder() {
        let email_error = $(".customer_email_error");
        let email_value = $("#customer_email").val();
        if( email_value.length === 0 ) {
            email_error.text('* Vui lòng nhập email');
            return undefined;
        } else {
            if(!checkEmail(email_value)) {
                email_error.text('* Email sai định dạng');
                return undefined;
            } else {
                email_error.text('');
                return email_value;
            }
        }
    }

    function handleCustomerFullnameOrder() {
        let fullname_error = $(".customer_fullname_error");
        let fullname_value = $("#customer_fullname").val();
        if(fullname_value.length === 0) {
            fullname_error.text('*Vui lòng nhập họ và tên');
            return undefined;
        } else {
            fullname_error.text('');
            return fullname_value;
        }
    }


    function handleSelectAddressOrder() {
        let dataSelectAddressOrder = {
            "btnSelect" : ".address_list .address_item .address_inner .saving_address",
            "baseURL_ajax" : "?controller=Customer&action=handleSelectAddressOrder"
        };
        $(dataSelectAddressOrder['btnSelect']).click(function() {
            $address_id = parseInt($(this).attr('add-id'));
            $.ajax({
                url: dataSelectAddressOrder['baseURL_ajax'],
                method: 'POST',
                data: { address_id : $address_id },
                dataType: 'json',
                success: (data) => {
                    if(data['status'] == 'success') {
                        window.location.replace(data['nextSite']);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }
    function handleDeleteCart() {
        let dataDeleteCart = {
            "btn" : ".cart_products_actions .cart_btn__delete",
            "baseURL_ajax" : "?controller=Cart&action=deleteCart"
        };
        $(dataDeleteCart['btn']).click(function() {
            let $prod_id = parseInt($(this).parents('.cart_products_group').attr('p-id'));
            clearTimeout(timeOutSet__);
            $.ajax({
                url: dataDeleteCart['baseURL_ajax'],
                method: "POST",
                data: {
                    prod_id : $prod_id
                },
                dataType: "json",
                beforeSend: function() {
                    $(".modal_loader").addClass('open');
                },
                success: (data) => {
                    if(data['status'] === 'success') {
                        timeOutSet__ = setTimeout(function() {
                            $(".modal_loader").removeClass('open');
                            handleUpdateInfoCart();
                            $(".cart_products_group[p-id='"+$prod_id+"']").stop().fadeOut(500);
                        },200);
                    } else {
                        $(".modal_loader").removeClass('open');
                        notificationAlert('error', 'Xóa giỏ hàng không thành công', 5000);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr);
                    console.log(thrownError);
                }
            });
        });
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
                let customer_id = parseInt($(addressData['addressValue']).attr('data-uid'));
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
    function handleUpdateAddress() {
        let editAddressData = {
            "btnSave" : ".address_inner .edit .saving",
            "baseURL_ajax" : "?controller=Customer&action=update_customerAddress"
        };
        $(editAddressData['btnSave']).click(function() {
            let address_fullname = $(this).parents('.edit').find('#address_fullname').val();
            let address_value    = $(this).parents('.edit').find('#address_value').val();
            let address_phone    = $(this).parents('.edit').find('#address_phone').val();
            let $customer_id     = parseInt($(this).parents('.edit').attr('u-id'));
            let $address_id      = parseInt($(this).parents('.edit').attr('address-id'));
            let error = [];

            let fullname_error = $(this).parents('.edit').find('.address_fullname_error');
            let value_error = $(this).parents('.edit').find('.address_value_error');
            let phone_error = $(this).parents('.edit').find('.address_phone_error');

            if(address_fullname.length === 0) {
                fullname_error.text('* Vui lòng nhập họ tên');
                error['fullname'] = true;
            } else {
                fullname_error.text('');
                error['fullname'] = false;
            }

            if(address_value.length === 0) {
                value_error.text('* Vui lòng nhập địa chỉ');
                error['value'] = true;
            } else {
                value_error.text('');
                error['value'] = false;
            }

            if(address_phone.length === 0) {
                phone_error.text('* Vui lòng nhập số điện thoại');
                error['phone'] = true;
            } else {
                if( !checkPhone(address_phone) ) {
                    phone_error.text('* Số điện thoại không hợp lệ');
                    error['phone'] = true;
                } else {
                    phone_error.text('');
                    error['phone'] = false;
                }
            }

            if( !error['fullname'] && !error['value'] && !error['phone'] ) {
                let $isDefault = undefined;
                if( ($(this).parents('.edit').find('.address_default')).prop('checked') ) {
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
                        fullname_value : address_fullname,
                        address_value : address_value,
                        phone_value : address_phone,
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
                });
            }
        });
    }

    function handleUpdateNumQtyOrder() {
        let dataQtyOrder = {
            "btnPlus"  : ".cart_products_detail .cart_products_qty .btn_item.plus",
            "btnMinus" : ".cart_products_detail .cart_products_qty .btn_item.minus",
            "inputVL"  : ".cart_num_qty",
            "baseURL_ajax" : "?controller=Cart&action=handleUpdateNumQtyOrder"
        };
        $("body").delegate(dataQtyOrder['btnPlus'], "click", function() {
            let inputEL    = $(this).parents('.amout_wrap').find(dataQtyOrder['inputVL']);
            let qtyMax     = parseInt(inputEL.attr('data-max')) || 0;
            let $qtyCurrent = parseInt(inputEL.val()) || 0;
            let $prod_id    = parseInt($(this).parents('.cart_products_group').attr('p-id'));
            if( $qtyCurrent < qtyMax ) {
                $qtyCurrent ++;
                updateNumQtyOrderUseAjax($qtyCurrent, $prod_id, inputEL);
            } else {
                alert('Số lượng trong kho chỉ còn ' + qtyMax + ' sản phẩm');
            }
        });
        $("body").delegate(dataQtyOrder['btnMinus'], "click", function() {
            let inputEL    = $(this).parents('.amout_wrap').find(dataQtyOrder['inputVL']);
            let $qtyCurrent = parseInt(inputEL.val()) || 0;
            let $prod_id    = parseInt($(this).parents('.cart_products_group').attr('p-id'));
            if( $qtyCurrent > 1 ) {
                $qtyCurrent --;
                updateNumQtyOrderUseAjax($qtyCurrent, $prod_id, inputEL);
            } else {
                alert('Phải có ít nhất 1 sản phẩm');
            }
        });

        function updateNumQtyOrderUseAjax($qtyCurrent, $prod_id, inputEL)
        {
            clearTimeout(timeOutSet__);
            $.ajax({
                url: dataQtyOrder['baseURL_ajax'],
                method: "POST",
                data: {
                    qtyCurrent : $qtyCurrent,
                    prod_id    : $prod_id
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                            $(".modal_loader").removeClass('open');
                            inputEL.val($qtyCurrent);
                            handleUpdateInfoCart();
                    } else {
                        timeOutSet__ = setTimeout(function() {
                            $(".modal_loader").removeClass('open');
                            notificationAlert('error', data['errTxt'], 5000);
                        }, 300);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        }
    }

    function handleUpdateInfoCart() {
        $.ajax({
            url: "?controller=Cart&action=handleGetAllInfoCart",
            method: "POST",
            dataType: "json",
            success(data) {
                $(".value_numOrder_cart").text(data['allInfoCart']['totalOrder'] || 0);
                $("#value_numOrder").text(data['allInfoCart']['totalOrder'] || 0);
                $(".value_numTotal_price").text(data['totalPrice'] || 0);
                $(".delivery_charges").text( data['allInfoCart']['totalPriceCart'] >= 500000 ? "0₫" : "Chúng tôi sẽ liên hệ lại với bạn" );
                if(data['allInfoCart']['totalOrder'] == null) {
                    location.reload();
                }
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
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