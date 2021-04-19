$(function() {
    var timeoutToggleAlert = undefined;

    init();

    function init() {
        handleDeleteCateProd();
        handleToggleStatus();
        handleToggleStatusItem();
    }

    // ----------------------------------------- //
    //----- FUNCTION HANDLE TOOGLR STATUS ------ //
    // ----------------------------------------- //

    function handleToggleStatusItem() {
        let btnToggleStatus = $("#table_content table.table tr .toogle_status");
        btnToggleStatus.click(function() {
            let $statusChange = $(this).hasClass('on') ? 'on' : 'off';
            let $cateProd_id  = parseInt($(this).parents("tr").attr('data-id'));
            $.ajax({
                url: "CateProduct/changeStatus",
                method: "POST",
                data: {
                    statusChange : $statusChange,
                    cateProd_id  : $cateProd_id
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === 'success') {
                        notificationAlert('success','Cập nhật trạng thái danh mục thành công',5000);
                    } else {
                        notificationAlert('error', 'Cập nhật trạng thái không thành công', 5000);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }


    // ----------------------------------------- //
    // -- FUNCTION HANDLE DELETE CATE PRODUCT -- //
    // ----------------------------------------- //

    function handleDeleteCateProd() {
        let btnDeleteCateProd  = $("#table_content table.table tr td.delete a");
        btnDeleteCateProd.click(function() {
            event.preventDefault();
            if(confirm("Bạn có chắt muốn xóa danh mục sản phẩm này ?")) {
                clearTimeout(timeoutToggleAlert)
                let $cateProd_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "CateProduct/deleteItem",
                    method: "POST",
                    data: { cateProd_id: $cateProd_id },
                    dataType: "json",
                    success: (data) => {
                        if(data['status'] === 'success') {
                            notificationAlert('success','Xóa danh mục sản phẩm thành công !',5000);
                            $("#table_content tbody tr[data-id='"+($cateProd_id)+"']").stop().fadeOut(500);
                        } else {
                            notificationAlert('error','Xóa danh mục sản phẩm không thành công',5000);
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
        let btnTotalMulti        = $(".action_wrap .page_action_item .form_change_wrap .form_button");
        let checkBoxCateProdIdEl = $("#table_content table.table tr .checkItem");
        let valueActionEl        = $(".action_wrap .page_action_item .form_change_wrap .option_status");
        btnTotalMulti.click(function() {
            clearTimeout(timeoutToggleAlert);
            let actionCurrent  = valueActionEl[0].value;
            if(actionCurrent.length !== 0) {
                let listCateProdId = [];
                checkBoxCateProdIdEl.each(function() {
                    if(this.checked) {
                        listCateProdId.push(parseInt($(this).attr('name')));
                    }
                });
                if(listCateProdId.length !== 0) {
                    if(actionCurrent === 'delete') {
                        // handle delete
                        if(confirm('Xác nhận xóa danh sách danh mục sản phẩm bạn đã chọn')) {
                            $.ajax({
                                url: "CateProduct/multiDelete",
                                method: "POST",
                                data: {
                                    listCateProdId: listCateProdId
                                },
                                dataType: "json",
                                success: (data) => {
                                    if(data['status'] === 'success') {
                                        notificationAlert('success','Bạn vừa xóa một danh sách danh mục sản phẩm thành công', 5000);
                                        let timeDelayDelete = 500;
                                        listCateProdId.forEach(function(el) {
                                            $("#table_content tbody tr[data-id='"+(el)+"']").stop().fadeOut(timeDelayDelete);
                                            timeDelayDelete += 200;
                                        });
                                    } else {
                                        notificationAlert('success','Một vài danh mục sản phẩm xóa không thành công', 5000);
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
                            url: "CateProduct/multiChangeStatus",
                            method: "POST",
                            data: {
                                listCateProdId: listCateProdId,
                                statusChange: actionCurrent
                            },
                            dataType: "json",
                            success: (data) => {
                                if(data['status'] = 'success') {
                                    notificationAlert('success','Bạn vừa cập nhật danh sách danh mục sản phẩm thành công', 5000);
                                    listCateProdId.forEach(el => {
                                        let statusOptionEl = $("#table_content table tr[data-id='"+(el)+"']").find('.toogle_status');
                                        let classRemove = actionCurrent === 'on' ? 'off' : 'on';
                                        let classAdd    = actionCurrent;
                                        statusOptionEl.removeClass(classRemove);
                                        statusOptionEl.addClass(classAdd);
                                    });
                                } else {
                                    notificationAlert('error','Một vài danh mục sản phẩm cập nhật trạng thái không thành công', 5000);
                                }
                            },
                            error: (xhr, ajaxOptions, thrownError) => {
                                console.log(xhr.status);
                                console.log(thrownError);
                            }
                        });
                    }
                } else {
                    notificationAlert('error','Vui lòng chọn ít nhất một danh mục sản phẩm để thực hiện tác vụ !', 5000);
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
                url: "CateProduct/getListTotalCateProd",
                method: "POST",
                dataType: "json",
                success: (data) => {
                    render_Html(data['dataRecomment']);
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
                url: "CateProduct/recommentSearch",
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
                        <span>${dataItem['cateProd_name']}</span>
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
            let searchStr     = $(this).find("input[name='searchStr']").val();
            let actionCurrent = $(this).attr('data-action');
            let urlCurren     = "CateProduct/"+(actionCurrent)+"/asc/all/1/";
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

    changeCateProdHot();
    function changeCateProdHot() {
        let btnSave = $(".select_cateProd_hot");
        let $checkValue = undefined;
        btnSave.change(function() {
            if($(this)[0].checked) {
                $checkValue = 1;
            } else {
                $checkValue = 2;
            }
            let $cateProd_id = parseInt($(this).parents('tr').attr('data-id'));
            $.ajax({
                url: "CateProduct/changeCateProdHot",
                method: "POST",
                data: {
                    cateProd_id: $cateProd_id,
                    checkValue: $checkValue
                },
                beforeSend: () => {
                    $(".loader_wrap").addClass('open');
                },
                dataType: "json",
                success: (data) => {
                    if(data['status'] === "success") {
                        setTimeout(function() {
                            $(".loader_wrap").removeClass('open');
                            notificationAlert("success", "Thêm danh mục nổi bậc thành công", 5000);
                        },200);
                    } else {
                        setTimeout(function() {
                            notificationAlert("success", "Thêm danh mục nổi bậc không thành công", 5000);
                        });
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        });
    }

    changeNumViewsCateProd();
    function changeNumViewsCateProd() {
        let btnSave = $(".saveNumViewCateProd");
        btnSave.click(function() {
            let numViewsCurrent = parseInt($(this).parents('td').find('input').attr('data-value'));
            let $numViewsNew     = parseInt($(this).parents('td').find('input').val());
            if($numViewsNew <= numViewsCurrent) {
                notificationAlert("error","Lượt xem bạn thay đổi không hợp lệ, vui lòng kiễm tra lại", 5000);
            } else {
                $cateProd_id = parseInt($(this).parents('tr').attr('data-id'));
                $.ajax({
                    url: "CateProduct/changeNumViews",
                    method: "POST",
                    dataType: "json",
                    data: {
                        numViewsNew: $numViewsNew,
                        cateProd_id: $cateProd_id
                    },
                    beforeSend: () => {
                        $(".loader_wrap").addClass('open');
                    },
                    success: (data) => {
                        if(data['status'] === "success") {
                            setTimeout(function() {
                                $(".loader_wrap").removeClass('open');
                                notificationAlert("success", "Cập nhật lượt views thành công");
                            },200);
                        } else {
                            notificationAlert("success", "Cập nhật lượt views không thành công");
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