$(function() {

    __construct();

    let __settimeout__ = undefined;

    function __construct() {
        handleRecommentOrderCode();
        handleRecommentCustomer();
        handleRecommentTotalPrice();
        handleFilterOrder();

        handleDeleteOrder();
        handleDeleteListOrder();
    }
    function handleRecommentTotalPrice() {
        let dataTotalPrice = {
            ajaxFocus     : "Order/getFieldOrderByFieldGet",
            ajaxSearch    : "Order/searchFieldOrder",
            input         : "#filter_total_price",
            boxRecomment  : "#recommentTotalPriceOrder",
            recommentItem : "#recommentTotalPriceOrder ul.list li",
            fieldGet      : "order_totalPrice"
        };

        // focus action
        $("body").delegate(dataTotalPrice['input'], "focus", function() {
            let strInp = $(this).val();
            if( strInp.length == 0 ) {
                handleFocusRecomment(dataTotalPrice['ajaxFocus'], dataTotalPrice['fieldGet'], dataTotalPrice['boxRecomment']);
            } else {
                handleSearchRecomment(dataTotalPrice['ajaxSearch'], strInp, dataTotalPrice['fieldGet'], dataTotalPrice['boxRecomment']);
            }
        });

        // search action
        $("body").delegate(dataTotalPrice['input'], "keyup", function() {
            let strInp = $(this).val();
            handleSearchRecomment(dataTotalPrice['ajaxSearch'], strInp, dataTotalPrice['fieldGet'], dataTotalPrice['boxRecomment']);
        });

        // blur action
        $("body").delegate(dataTotalPrice['input'], "blur", function() {
            handleBlurRecommet(dataTotalPrice['boxRecomment']);
        });

        // select item
        $("body").delegate(dataTotalPrice['recommentItem'], "click", function() {
            let txtData = $(this).text();
            handleSelectRecomment(txtData, dataTotalPrice['input']);
        });
    }

    function handleRecommentCustomer() {
        let dataCustomer = {
            ajaxFocus     : "Order/getFieldCustomerByFieldGet",
            ajaxSearch    : "Order/getFieldCustomer",
            input         : "#filter_customer",
            boxRecomment  : "#recommentCustomer",
            recommentItem : "#recommentCustomer ul.list li",
            fieldGet      : "customer_fullname"
        };

        // focus action
        $("body").delegate(dataCustomer['input'], "focus", function() {
            let strInp = $(this).val();
            if( strInp.length == 0 ) {
                handleFocusRecomment(dataCustomer['ajaxFocus'], dataCustomer['fieldGet'], dataCustomer['boxRecomment']);
            } else {
                handleSearchRecomment(dataCustomer['ajaxSearch'], strInp, dataCustomer['fieldGet'], dataCustomer['boxRecomment']);
            }
        });

        // search action
        $("body").delegate(dataCustomer['input'], "keyup", function() {
            let strInp = $(this).val();
            handleSearchRecomment(dataCustomer['ajaxSearch'], strInp, dataCustomer['fieldGet'], dataCustomer['boxRecomment']);
        });

        // blur action
        $("body").delegate(dataCustomer['input'], "blur", function() {
            handleBlurRecommet(dataCustomer['boxRecomment']);
        });

        // select item
        $("body").delegate(dataCustomer['recommentItem'], "click", function() {
            let txtData = $(this).text();
            handleSelectRecomment(txtData, dataCustomer['input']);
        });
    }

    function handleRecommentOrderCode() {
        let dataOrderCode = {
            ajaxFocus     : "Order/getFieldOrderByFieldGet",
            ajaxSearch    : "Order/searchFieldOrder",
            input         : "#filter_order_code",
            boxRecomment  : "#recommentOrderCode",
            recommentItem : "#recommentOrderCode ul.list li",
            fieldGet      : "order_code"
        };

        // focus action
        $("body").delegate(dataOrderCode['input'], "focus", function() {
            let strInp = $(this).val();
            if( strInp.length == 0 ) {
                handleFocusRecomment(dataOrderCode['ajaxFocus'], dataOrderCode['fieldGet'], dataOrderCode['boxRecomment']);
            } else {
                handleSearchRecomment(dataOrderCode['ajaxSearch'], strInp, dataOrderCode['fieldGet'], dataOrderCode['boxRecomment']);
            }
        });

        // search action
        $("body").delegate(dataOrderCode['input'], "keyup", function() {
            let strInp = $(this).val();
            handleSearchRecomment(dataOrderCode['ajaxSearch'], strInp, dataOrderCode['fieldGet'], dataOrderCode['boxRecomment']);
        });

        // blur action
        $("body").delegate(dataOrderCode['input'], "blur", function() {
            handleBlurRecommet(dataOrderCode['boxRecomment']);
        });

        // select item
        $("body").delegate(dataOrderCode['recommentItem'], "click", function() {
            let txtData = $(this).text();
            handleSelectRecomment(txtData, dataOrderCode['input']);
        });
    }

    function handleFocusRecomment(ajaxUrl, fieldGet, boxRecommentContent) {
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: { fieldGet: fieldGet },
            dataType: "json",
            success: (data) => {
                if(data['data'].length > 0) {
                    render_html(data['data'], fieldGet, boxRecommentContent);
                } else {
                    $(boxRecommentContent).stop().hide();
                }
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

    function handleSearchRecomment(ajaxUrl, strSearch, fieldSearch, boxRecommentContent) {
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: {
                strSearch : strSearch,
                fieldSearch : fieldSearch
            },
            dataType: "json",
            success: (data) => {
                if(data['data'].length > 0) {
                    render_html(data['data'], fieldSearch, boxRecommentContent);
                } else {
                    $(boxRecommentContent).stop().hide();
                }
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }

    function handleBlurRecommet(boxRecommentContent) {
        clearTimeout(__settimeout__);
        __settimeout__ = setTimeout(function() {
            $(boxRecommentContent).attr('style','');
            $(boxRecommentContent).stop().hide();
            $(boxRecommentContent).find('ul.list').html('');
        }, 500);
    }

    function handleSelectRecomment(txtData, input) {
        $(input).val(txtData);
    }

    function render_html(data, fieldData, boxRecommentContent) {
        if(data.length > 8) {
            $(boxRecommentContent).attr('style', 'height: 250px');
        } else {
            $(boxRecommentContent).attr('style', 'height: auto;');
        }
        $(boxRecommentContent).stop().show();
        let htmls = data.map(function(item) {
            return `<li>${item[fieldData]}</li>`;
        });
        $(boxRecommentContent).find('ul.list').html(htmls.join(''));
    }

    function handleFilterOrder() {
        let urlCurrent = $("#baseURL_order").attr('data-url');
        let filterButtonAct = $(".page_header .filter_wrap #button_filter");
        filterButtonAct.click(function() {
            let dataFilter = {
                "code"       : $("#filter_order_code").val(),
                "status"     : $("#filter_order_status").val(),
                "createDate" : $("#filter_order_date").val(),
                "customer"   : $("#filter_customer").val(),
                "totalPrice" : $("#filter_total_price").val(),
                "updateDate" : $("#filter_update_date").val()
            }
            let filter_order_code   = dataFilter['code'].length       == 0 ? '' : "&filter_order_code="   + dataFilter['code'];
            let filter_order_status = dataFilter['status'].length     == 0 ? '' : "&filter_order_status=" + dataFilter['status'];
            let filter_order_date   = dataFilter['createDate'].length == 0 ? '' : "&filter_order_date="   + dataFilter['createDate'];
            let filter_total_price  = dataFilter['totalPrice'].length == 0 ? '' : "&filter_total_price="  + dataFilter['totalPrice'];
            let filter_update_date  = dataFilter['updateDate'].length == 0 ? '' : "&filter_update_date="  + dataFilter['updateDate'];
            $.ajax({
                url: "Order/getCustomerIdByCustomerFullname",
                method: "POST",
                data: {
                    customer_fullname: dataFilter['customer']
                },
                dataType: "json",
                success: data => {
                    let filter_customer_id = data['customer_id'];
                    let filter_customer    = filter_customer_id.length   == 0 ? '' : "&filter_customer=" + filter_customer_id;
                    let urlFilter = urlCurrent + filter_order_code + filter_order_status + filter_order_date + filter_customer + filter_total_price + filter_update_date;
                    handleAppendURL(urlFilter);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    function handleAppendURL(url) {
        window.location.replace(url);
    }

    function handleCustomer($customer_fullname) {
        console.log($customer_fullname);

    }

    function handleDeleteOrder() {
        let btnDeleteOrder = $("#table_content table.table tr td.delete a");
        btnDeleteOrder.click(function() {
            event.preventDefault();
            if( confirm("Bạn có chắt chắn muốn xóa đơn hàng này ?") ) {
                clearTimeout( __settimeout__ );
                let $order_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Order/deleteItem",
                    method: "POST",
                    data: { order_id: $order_id },
                    beforeSend() {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa đơn hàng thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($order_id)+"']").stop().fadeOut(500);
                            },200);
                        } else {
                            notificationAlert("success", "Xóa đơn hàng không thành công", 5000);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                })
            }
        });
    }

    function handleDeleteListOrder() {
        let btnTotalMulti     = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxOrderIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl     = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(__settimeout__);
            let actionCurrent = valueActionEl[0].value;
            if( actionCurrent.length !== 0 ) {
                let listIdOrder = [];
                checkBoxOrderIdEl.each(function() {
                    if(this.checked) {
                        listIdOrder.push(parseInt($(this).attr('name')));
                    }
                });
                if( listIdOrder.length !== 0 ) {
                    console.log(listIdOrder);
                    if( confirm( 'Xác nhận xóa danh sách đơn hàng đã chọn' ) ) {
                        $.ajax({
                            url: "Order/multiDelete",
                            method: "POST",
                            data: {
                                listIdOrder : listIdOrder
                            },
                            beforeSend() {
                                $('.loader_wrap').addClass('open');
                            },
                            dataType: "json",
                            success: data => {
                                if(data['status'] === "success") {
                                    setTimeout(function() {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('success','Bạn vừa xóa một danh sách đơn hàng thành công', 5000);
                                        let timeDelayDelete = 500;
                                        listIdOrder.forEach(function(el) {
                                            $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                            timeDelayDelete += 200;
                                        });
                                    },200);
                                } else {
                                    notificationAlert('success','Một vài đơn hàng xóa không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                alert(xhr.status);
                                alert(thrownError);
                            }
                        })
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một đơn hàng để thực hiện tác vụ !', 5000);
                }
            } else {
                notificationAlert('error','Bạn chưa chọn tác vụ hành động nào !',5000);
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