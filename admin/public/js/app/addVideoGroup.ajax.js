$(function() {


    init();



    function init() {
        handleLoadVideoByIframe();
        handleLoadProd();
    }

    function handleLoadVideoByIframe() {
        let btnLoad = $(".btnLoadIframe");
        btnLoad.click(function() {
            let vl_iframe = $(".valueLoadIfram").val();
            if(vl_iframe.length === 0) {
                notificationAlert("error", "Vui lòng gán iframe video từ youtobe", 5000);
            } else {
                let srcIframe = $(vl_iframe).attr('src');
                let htmls = `<iframe src="${srcIframe}" frameborder="0"></iframe>`;
                $(".valueLoadIfram").val(srcIframe);
                $("[name='video_iframe']").val(srcIframe);
                $(".video_intro_box .iframe_box").html(htmls);
            }
        });
    }

    function handleLoadProd() {
        video1Action();
        video2Action();
        video3Action();
        video4Action();
    }

    function video1Action() {
        let data = {
            "input" : "#video_prodId_ties_1",
            "recommentBox": "#spaceAppend_video_prodId_ties_1",
            "spaceAppend" : "#spaceAppend_video_prodId_ties_1 .list",
            "recommentItem": "#spaceAppend_video_prodId_ties_1 .list .item",
            "spaceAppend_id": ".video_prodId_ties_1_id",
            "spaceAppend_name": ".video_prodId_ties_1_name",
            "spaceAppend_image": ".video_prodId_ties_1_image",
            "spaceAppend_src": ".video_prodId_ties_1_src",
            "spaceAppend_nameText": ".video_prodId_ties_1_nameText"
        };
        handleFocus(data['input'], data['spaceAppend'], data['recommentBox']);
        handleKeyup(data['input'], data['spaceAppend']);
        handleBlur(data['input'], data['recommentBox']);
        handleClick(data['recommentItem'], data['spaceAppend_nameText'] ,data['spaceAppend_src'], data['spaceAppend_id'], data['spaceAppend_name'], data['spaceAppend_image'])
    }

    function video2Action() {
        let data = {
            "input" : "#video_prodId_ties_2",
            "recommentBox": "#spaceAppend_video_prodId_ties_2",
            "spaceAppend" : "#spaceAppend_video_prodId_ties_2 .list",
            "recommentItem": "#spaceAppend_video_prodId_ties_2 .list .item",
            "spaceAppend_id": ".video_prodId_ties_2_id",
            "spaceAppend_name": ".video_prodId_ties_2_name",
            "spaceAppend_image": ".video_prodId_ties_2_image",
            "spaceAppend_src": ".video_prodId_ties_2_src",
            "spaceAppend_nameText": ".video_prodId_ties_2_nameText"
        };
        handleFocus(data['input'], data['spaceAppend'], data['recommentBox']);
        handleKeyup(data['input'], data['spaceAppend']);
        handleBlur(data['input'], data['recommentBox']);
        handleClick(data['recommentItem'], data['spaceAppend_nameText'], data['spaceAppend_src'], data['spaceAppend_id'], data['spaceAppend_name'], data['spaceAppend_image'])
    }

    function video3Action() {
        let data = {
            "input" : "#video_prodId_ties_3",
            "recommentBox": "#spaceAppend_video_prodId_ties_3",
            "spaceAppend" : "#spaceAppend_video_prodId_ties_3 .list",
            "recommentItem": "#spaceAppend_video_prodId_ties_3 .list .item",
            "spaceAppend_id": ".video_prodId_ties_3_id",
            "spaceAppend_name": ".video_prodId_ties_3_name",
            "spaceAppend_image": ".video_prodId_ties_3_image",
            "spaceAppend_src": ".video_prodId_ties_3_src",
            "spaceAppend_nameText": ".video_prodId_ties_3_nameText"
        };
        handleFocus(data['input'], data['spaceAppend'], data['recommentBox']);
        handleKeyup(data['input'], data['spaceAppend']);
        handleBlur(data['input'], data['recommentBox']);
        handleClick(data['recommentItem'], data['spaceAppend_nameText'], data['spaceAppend_src'], data['spaceAppend_id'], data['spaceAppend_name'], data['spaceAppend_image'])
    }

    function video4Action() {
        let data = {
            "input" : "#video_prodId_ties_4",
            "recommentBox": "#spaceAppend_video_prodId_ties_4",
            "spaceAppend" : "#spaceAppend_video_prodId_ties_4 .list",
            "recommentItem": "#spaceAppend_video_prodId_ties_4 .list .item",
            "spaceAppend_id": ".video_prodId_ties_4_id",
            "spaceAppend_name": ".video_prodId_ties_4_name",
            "spaceAppend_image": ".video_prodId_ties_4_image",
            "spaceAppend_src": ".video_prodId_ties_4_src",
            "spaceAppend_nameText": ".video_prodId_ties_4_nameText"
        };
        handleFocus(data['input'], data['spaceAppend'], data['recommentBox']);
        handleKeyup(data['input'], data['spaceAppend']);
        handleBlur(data['input'], data['recommentBox']);
        handleClick(data['recommentItem'], data['spaceAppend_nameText'], data['spaceAppend_src'], data['spaceAppend_id'], data['spaceAppend_name'], data['spaceAppend_image'])
    }

    function handleClick(recommentItem, spaceAppend_nameText, spaceAppend_src, spaceAppend_id, spaceAppend_name, spaceAppend_image) {
        $("body").delegate(recommentItem, "click", function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            let image = $(this).attr('data-image');

            $(spaceAppend_id).val(id);
            $(spaceAppend_name).val(name);
            $(spaceAppend_image).val(image);
            $(spaceAppend_src).attr('src',image);
            $(spaceAppend_nameText).text(name);
        });
    }

    function handleBlur(input, recommentBox) {
        $("body").delegate(input, "blur", function() {
            setTimeout(function() {
                $(recommentBox).stop().hide(0);
            },300);
        });
    }

    function handleFocus(input, spaceAppend, recommentBox) {
        $("body").delegate(input, "focus", function() {
            $.ajax({
                url: "Product/getListTotalProductByField",
                method: "POST",
                data: { status: "all" },
                dataType: "json",
                success: (data) => {
                    $(recommentBox).stop().show(0);
                    render_htmlData(data['listProd'], spaceAppend);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        });
    }

    function handleKeyup(input, spaceAppend) {
        $("body").delegate(input, "keyup", function() {
            let $searchValue = $(this).val();
            $.ajax({
                url: "Product/searchRecommentByFileAjax",
                method: "POST",
                dataType: "json",
                data: {
                    searchValue: $searchValue,
                    fieldName: "prod_name"
                },
                success: (data) => {
                    render_htmlData(data['searchData'], spaceAppend);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    function render_htmlData(data, spaceAppend) {
        let htmls = data.map(function(item) {
            return `
            <li class="item" data-id="${item['prod_id']}" data-name="${item['prod_name']}" data-image="${item['prod_avatar']}">${item['prod_name']}</li>
            `;
        });

        $(spaceAppend).html(htmls.join(" "));
    }

    // ----------------------------------
    // -------- FUNCTION NOTIFI ---------
    // ----------------------------------

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