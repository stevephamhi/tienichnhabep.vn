//========== ########## RECOMMENT BRANDS ########## ========== //
$(function() {
    handleLoadVideoByIframe();
    function handleLoadVideoByIframe() {
        let btnLoad = $(".GetURL_iframe");
        btnLoad.click(function() {
            let vl_iframe = $(".valueLoadIframe").val();
            if(vl_iframe[0].length === 0) {
                notificationAlert("error", "Vui lòng gán iframe video từ youtobe", 5000);
            } else {
                let srcIframe = $(vl_iframe).attr('src');
                let htmls = `<iframe src="${srcIframe}" frameborder="0"></iframe>`;
                $("#prod_video").val(srcIframe);
                $("[name='prod_video']").val(srcIframe);
                $(".video_intro_box .iframe_box").html(htmls);
            }
        });
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

$(function() {
    let inputRecommentBrand   = "#prod_ties_brand_id";
    let popupRecommentBrandEL = $("#content_recomment_brand");

    $("body").delegate(inputRecommentBrand, "focus", function() {
        $.ajax({
            url: "Brand/getListTotalBrandByStatus",
            method: "POST",
            data: {
                status : "all"
            },
            dataType: "json",
            success: (data) => {
                appendDataBrand(data['listBrand']);
                handleOpenPopupRecommentBrand();
                handleClosePopupRecommentBrand();
                handeSelectRecommentBrandItem();
                handleSearchRecommentBrand();
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });

    function appendDataBrand(listBrand) {
        let spaceAppendBrand = $("#content_recomment_brand .list");
        let htmls = listBrand.map(function(brandItem) {
            return `
            <li class="item" data-id="${brandItem['brand_id']}">${brandItem['brand_name']}</li>
            `;
        });
        spaceAppendBrand.html(htmls.join(" "));
    }

    function handleOpenPopupRecommentBrand() {
        popupRecommentBrandEL.stop().fadeIn(0);
    }

    function handleClosePopupRecommentBrand() {
        let __timeout__set__ = undefined;
        $("body").delegate(inputRecommentBrand, "blur", function() {
            clearTimeout(__timeout__set__);
            __timeout__set__ = setTimeout(function() {
                popupRecommentBrandEL.stop().fadeOut(0);
            }, 500);
        });
    }

    function handeSelectRecommentBrandItem() {
        let btnSelectItem = $("#content_recomment_brand .item");
        btnSelectItem.click(function() {
            let brandId   = parseInt( $(this).attr('data-id'));
            let brandName = $(this).text();
            $(inputRecommentBrand).val(brandName);
            $("#table_content .tab_content .form_group input[name='prod_ties_brand_id']").val(brandId);
        });
    }

    function handleSearchRecommentBrand() {
        $("body").delegate(inputRecommentBrand, "keyup", function() {
            let $vlSearch = $(this).val();
            if($vlSearch.length === 0) {
                $("[name='prod_ties_brand_id']").val('');
            }
            $.ajax({
                url: "Brand/recommentSearch",
                method: "POST",
                data: { vlSearch: $vlSearch },
                dataType: "json",
                success: (data) => {
                    appendDataBrand(data['searchData']);
                    handeSelectRecommentBrandItem();
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError)
                }
            });
        });
    }
});


//========== ########## RECOMMENT PRODUCTS ########## ========== //

$(function() {
    let inputRecommentProd = "#prod_listId_recomment";
    let popupRecommentProdEl = $("#content_recomment_products");
    let spaceAppendProd = $("#content_recomment_products .list");
    let listRecommentProdHtmls = [];
    let listRecommentProdHadEl = $(".form_list_wrap .list_content .item");
    let arrMask = [];
    for(let i=0 ;i<listRecommentProdHadEl.length; i++) {
        let __obj__ = {
            prodId   : parseInt($(listRecommentProdHadEl[i]).find('span.close')[0].attributes[1].nodeValue),
            prodName : $(listRecommentProdHadEl[i]).context.innerText,
        }
        arrMask.push(__obj__);
    }

    if(arrMask !== 0) {
        listRecommentProdHtmls = arrMask;
    }

    $("body").delegate(inputRecommentProd, "focus", function() {
        $.ajax({
            url: "Product/getListTotalProductByField",
            method: "POST",
            dataType: "json",
            success: (data) => {
                appendDataProd(data['listProd']);
                handleOpenPopupRecommentProd();
                handleClosePopupRecommentProd();
                handleSelectRecommentProdItem();
                handleSearchRecommentProd();

            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        })
    });

    function appendDataProd(listProd) {
        let htmls = listProd.map(function(prodItem) {
            return `
            <li class="item" data-id="${prodItem['prod_id']}">
                <span>${prodItem['prod_name']}</span>
                <input type="hidden" name="prodRecommentId[]" value="${prodItem['prod_id']}">
            </li>
            `;
        });
        spaceAppendProd.html(htmls.join(" "));
    }

    function handleOpenPopupRecommentProd() {
        popupRecommentProdEl.stop().fadeIn(0);
    }

    function handleClosePopupRecommentProd() {
        let __timeout__set__ = undefined;
        $("body").delegate(inputRecommentProd, "blur", function() {
            clearTimeout(__timeout__set__);
            __timeout__set__ = setTimeout(function() {
                popupRecommentProdEl.stop().fadeOut(0);
            }, 500);
        });
    }

    function handleSelectRecommentProdItem() {
        let recommentItem = $("#content_recomment_products .list .item");
        recommentItem.click(function() {
            let obj = {
                "prodId"   : parseInt($(this).attr('data-id')),
                "prodName" : $(this).find('span').text()
            };
            if( !(checkRecommentProdItemExists(obj['prodId'], listRecommentProdHtmls)) ) {
                listRecommentProdHtmls.push(obj);
                render_HtmlsRecommentProd(listRecommentProdHtmls);
            }
        });
    }

    function checkRecommentProdItemExists(prodId, listRecommentProdHtmls) {
        let numExists = 0;
        listRecommentProdHtmls.forEach(el => {
            if(el['prodId'] === prodId) {
                numExists ++;
            }
        });
        if(numExists === 0) return false;
        return true;
    }

    function render_HtmlsRecommentProd(listRecommentProdHtmls) {
        let spaceAppendRecommentProd = $(".form_list_wrap .list_content");
        let numRow = 0;
        let htmls = listRecommentProdHtmls.map(function(prodItem) {
            numRow++;
            return `
            <li class='item'>
                <span>${prodItem['prodName']}</span>
                <span class='close' data-id='${prodItem['prodId']}'></span>
                <input type="hidden" name="prod_listId_recomment[${numRow-1}][prod_id]" value="${prodItem['prodId']}" />
                <input type="hidden" name="prod_listId_recomment[${numRow-1}][prod_name]" value="${prodItem['prodName']}" />
            </li>
            `;
        });
        spaceAppendRecommentProd.html(htmls.join(" "));
        handleClearRecommentHtml();
    }

    function handleSearchRecommentProd() {
        $("body").delegate(inputRecommentProd, "keyup", function() {
            let $vlSearch = $(this).val();
            $.ajax({
                url: "Product/recommentSearch",
                method: "POST",
                data: { vlSearch: $vlSearch },
                dataType: "json",
                success: (data) => {
                    appendDataProd(data['searchData']);
                    handleSelectRecommentProdItem();
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        });
    }

    function handleClearRecommentHtml() {
        let btnClearRecomment = $(".form_list_wrap .item .close");
        btnClearRecomment.click(function() {
            let idRecommentClear = parseInt($(this).attr('data-id'));
            listRecommentProdHtmls.forEach((el, index) => {
                if(el['prodId'] === idRecommentClear) {
                    listRecommentProdHtmls.splice(index, 1);
                    render_HtmlsRecommentProd(listRecommentProdHtmls);
                }
            });
        });
    }
});