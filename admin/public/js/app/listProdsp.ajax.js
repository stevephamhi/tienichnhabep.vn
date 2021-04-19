$(function() {

    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleChangeOrder();
        handleToggleStatusItem();
        handleDeleteProdsp();
        handleToggleStatus();
    }

    // ----------------------------------------//
    //----- FUNCTION HANDLE CHANGE STATUS -----//
    // ----------------------------------------//

    function handleChangeOrder() {
        let btnSaveProdspOrder = $(".form_button.save_prodsp_order");
        btnSaveProdspOrder.click(function() {
            let inputOrderEl  = $(this).parents('td').find('input');
            let buttonOrderEl = $(this);
            let prodspOrderCurrent = parseInt($(this).attr('data-order'));
            let $prodspOrderChange = parseInt($(this).parents('td').find('input').val());
            if(prodspOrderCurrent === $prodspOrderChange) {
                notificationAlert("error", "Bạn chưa chọn vị trí hiển thị mới !", 5000);
            } else {
                $prodspID = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Productsp/updateProdspOrder",
                    method: "POST",
                    data: {
                        prodspOrderChange: $prodspOrderChange,
                        prodspID: $prodspID
                    },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                $(inputOrderEl[0]).attr('value', $prodspOrderChange);
                                $(buttonOrderEl[0]).attr('data-order', $prodspOrderChange);
                                notificationAlert("success", "Cập nhật thành công !", 5000);
                            },200);
                        } else {
                            notificationAlert("success", "Cập nhật không thành công !", 5000);
                        }
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
    }

    // ---------------------------------------- //
    //----- FUNCTION HANDLE TOOGLR STATUS ----- //
    // ---------------------------------------- //

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $prodsp_id   = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "Productsp/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    prodsp_id    : $prodsp_id
                },
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        setTimeout(() => {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('success','Cập nhật trạng thái thông tin thành công',5000);
                        },200);
                    } else {
                        notificationAlert('error', 'Cập nhật trạng thái thông tin không thành công', 5000);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    }


    // ----------------------------------//
    //-- FUNCTION HANDLE DELETE PRODSP --//
    // ----------------------------------//

    function handleDeleteProdsp() {
        let btnDeleteProdsp  = $("#table_content table.table tr td.delete a");
        btnDeleteProdsp.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa thông tin ?")) {
                clearTimeout(timeoutToggleAlert);
                let $prodsp_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Productsp/deleteItem",
                    method: "POST",
                    data: { prodsp_id: $prodsp_id },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa thông tin thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($prodsp_id)+"']").stop().fadeOut(500);
                            }, (200));
                        } else {
                            notificationAlert('error','Xóa thông tin không thành công',5000);
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

    // ----------------------------------- //
    // -- FUNCTION HANDLE TOGGLE STATUS -- //
    // ----------------------------------- //

    function handleToggleStatus() {
        let btnTotalMulti      = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxProdspIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl      = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listProdspId = [];
                checkBoxProdspIdEl.each(function() {
                    if(this.checked) {
                        listProdspId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listProdspId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách thông tin bạn đã chọn')) {
                            $.ajax({
                                url: "Productsp/multiDelete",
                                method: "POST",
                                data: {
                                    listProdspId: listProdspId
                                },
                                beforeSend: () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách thông tin thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listProdspId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        }, (200));
                                    } else {
                                        notificationAlert('success','Một vài thông tin xóa không thành công', 5000);
                                    }
                                },
                                error: (xhr, ajaxOptions, thrownError) => {
                                    console.log(xhr.status);
                                    console.log(thrownError);
                                }
                            });
                        }
                    } else {
                        // handle change
                        $.ajax({
                            url: "Productsp/multiChangeStatus",
                            method: "POST",
                            data: {
                                listProdspId: listProdspId,
                                statusChange: actionCurrent
                            },
                            beforeSend: () => {
                                $(".loader_wrap").addClass('open');
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('success','Bạn vừa cập nhật danh sách trạng thái thông tin thành công', 5000);
                                        listProdspId.forEach(el => {
                                            let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                            let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                            let classAdd    = actionCurrent;
                                            statusOptionEl.removeClass(classRemove);
                                            statusOptionEl.addClass(classAdd);
                                        }, (200));
                                    });
                                } else {
                                    notificationAlert('error','Một vài bản thông tin cập nhật trạng thái không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                console.log(xhr.status);
                                console.log(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một bản tin tức để thực hiện tác vụ !', 5000);
                }
            } else {
                notificationAlert('error','Bạn chưa chọn tác vụ hành động nào !',5000);
            }
        });
    }

    // -------------------------------------------- //
    // -------- FUNCTION RECOMMENT SEARCH --------- //
    // -------------------------------------------- //

    recommentSearchData();
    function recommentSearchData() {
        $("body").delegate(".action_wrap .page_action_item.search input[name='searchStr']", "focus", function() {
            $.ajax({
                url: "Productsp/getAllProdsp",
                method: "POST",
                dataType: "json",
                success: (data) => {
                    render_Html(data['listProdsp']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
        $("body").delegate(".action_wrap .page_action_item.search input[name='searchStr']","keyup", function() {
            let vlSearch = $(this).val();
            $.ajax({
                url: "Productsp/recommentSearch",
                method: "POST",
                data: {
                    vlSearch: vlSearch
                },
                dataType: "json",
                success: (data) => {
                    render_Html(data['searchData']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });
    }

    function render_Html(datas) {
        let spaceAppendData = $(".search_recomment_wrap_list");
        let htmls = datas.map(function(dataItem) {
            return `<li>
                        <span>${dataItem['prodsp_name']}</span>
                    <li/>`;
        });
        spaceAppendData.html(htmls);
        handleChooseKeyWord();
    }

    function handleChooseKeyWord() {
        let recommentSearchItem = $(".search_recomment_wrap_list li span");
        recommentSearchItem.click(function() {
            let valueTextSearch = $(this).text();
            $(".action_wrap .page_action_item.search input[name='searchStr']").val(valueTextSearch);
        });
    }

    // --------------------------------------------- //
    // -------- FUNCTION HANDLE URL SEARCH --------- //
    // --------------------------------------------- //

    customizeURLsearh();
    function customizeURLsearh() {
        let formSearch = $(".action_wrap .page_action_item.search .search_module");
        formSearch.submit(function() {
            let searchStr = $(this).find("input[name='searchStr']").val();
            let urlCurrent = "Productsp/index/asc/all/1/";
            $.ajax({
                url: "Ajax/cusomizeUrlSearch",
                method: "POST",
                data: {
                    searchStr: searchStr
                },
                dataType: "json",
                success: (data) => {
                    let urlNew = urlCurrent+data['urlSearch'];
                    window.location.replace(urlNew);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
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