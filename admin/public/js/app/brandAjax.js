$(function() {
    var timeoutToggleAlert = undefined;
    let timeoutLoader = undefined;

    init();

    function init() {
        handleToggleStatusItem();
        handleDeleteBrand();
        handleToggleStatus();
    }


    // ----------------------------------------- //
    // ----- FUNCTION HANDLE TOOGLR STATUS ----- //
    // ----------------------------------------- //

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            clearTimeout(timeoutToggleAlert);
            clearTimeout(timeoutLoader);
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $brand_id  = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "Brand/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    brand_id  : $brand_id
                },
                beforeSend : () => {
                    $(".loader_wrap").addClass('open');
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        timeoutLoader = setTimeout(() => {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('success','Cập nhật trạng thái thương hiệu thành công',5000);
                        }, 200);
                    } else {
                        timeoutLoader = setTimeout(() => {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert('error', 'Cập nhật trạng thái thương hiệu không thành công', 5000);
                        }, 200);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    // --------------------------------- //
    //-- FUNCTION HANDLE DELETE BRAND -- //
    // --------------------------------- //

    function handleDeleteBrand() {
        let btnDeleteBrand  = $("#table_content table.table tr td.delete a");
        btnDeleteBrand.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa thương hiệu này ?")) {
                clearTimeout(timeoutToggleAlert);
                let $brand_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "Brand/deleteItem",
                    method: "POST",
                    data: { brand_id: $brand_id },
                    beforeSend : () => {
                        $(".loader_wrap").addClass('open');
                    },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            timeoutLoader = setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('success','Xóa thương hiệu thành công !',5000);
                                $("#table_content tbody tr[data-id='"+($brand_id)+"']").stop().fadeOut(500);
                            }, 200);
                        } else {
                            timeoutLoader = setTimeout(() => {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert('error','Xóa thương hiệu không thành công',5000);
                            }, 200);
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

    // ----------------------------------- //
    // -- FUNCTION HANDLE TOGGLE STATUS -- //
    // ----------------------------------- //

    function handleToggleStatus() {
        let btnTotalMulti     = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxBrandIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl     = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listBrandId = [];
                checkBoxBrandIdEl.each(function() {
                    if(this.checked) {
                        listBrandId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listBrandId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách thương hiệu bạn đã chọn')) {
                            $.ajax({
                                url: "Brand/multiDelete",
                                method: "POST",
                                data: {
                                    listBrandId: listBrandId
                                },
                                beforeSend : () => {
                                    $(".loader_wrap").addClass('open');
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        timeoutLoader = setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Bạn vừa xóa một danh sách thương hiệu thành công', 5000);
                                            let timeDelayDelete = 500;
                                            listBrandId.forEach(function(el) {
                                                $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                                timeDelayDelete += 200;
                                            });
                                        }, 200);
                                    } else {
                                        timeoutLoader = setTimeout(() => {
                                            $(".loader_wrap").removeClass('open');
                                            notificationAlert('success','Một vài thương hiệu xóa không thành công', 5000);
                                        }, 200);
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
                            url: "Brand/multiChangeStatus",
                            method: "POST",
                            data: {
                                listBrandId: listBrandId,
                                statusChange: actionCurrent
                            },
                            beforeSend : () => {
                                $(".loader_wrap").addClass('open');
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    timeoutLoader = setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('success','Bạn vừa cập nhật danh sách thương hiệu thành công', 5000);
                                        listBrandId.forEach(el => {
                                            let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                            let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                            let classAdd    = actionCurrent;
                                            statusOptionEl.removeClass(classRemove);
                                            statusOptionEl.addClass(classAdd);
                                        });
                                    }, 200);
                                } else {
                                    timeoutLoader = setTimeout(() => {
                                        $(".loader_wrap").removeClass('open');
                                        notificationAlert('error','Một vài thương hiệu cập nhật trạng thái không thành công', 5000);
                                    }, 200);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                console.log(xhr.status);
                                console.log(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một thương hiệu để thực hiện tác vụ !', 5000);
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
        $("body").delegate(".action_wrap .page_action_item.search input[name='searchStr']","keyup", function() {
            let vlSearch = $(this).val();
            $.ajax({
                url: "Brand/recommentSearch",
                method: "POST",
                data: {
                    vlSearch: vlSearch
                },
                dataType: "json",
                success: (data) => {
                    render_Html(data['searchData']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    function render_Html(datas) {
        let spaceAppendData = $(".search_recomment_wrap_list");
        let htmls = datas.map(function(dataItem) {
            return `<li>
                        <span>${dataItem['brand_name']}</span>
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

    // ---------------------------------------------
    // -------- FUNCTION HANDLE URL SEARCH ---------
    // ---------------------------------------------

    customizeURLsearh();
    function customizeURLsearh() {
        let formSearch = $(".action_wrap .page_action_item.search .search_module");
        formSearch.submit(function() {
            let searchStr = $(this).find("input[name='searchStr']").val();
            let urlCurren = "Brand/index/asc/all/1/";
            $.ajax({
                url: "Ajax/cusomizeUrlSearch",
                method: "POST",
                data: {
                    searchStr: searchStr
                },
                dataType: "json",
                success: (data) => {
                    window.location.replace(urlCurren+data['urlSearch']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
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