
function focusRecommentData() {
    focusRecommentOrderCode();
}

function focusRecommentOrderCode() {
    let inputFocus = "#orderCode_filter";
    let boxRecommentContent = "#recommentOrderCode";
    let __settimeout = undefined;
    let fieldGet = "order_code";
    let ajaxUrl = "Order/getFieldOrderByFieldGet";

    $("body").delegate(inputFocus, "focus", function() {
        handleFocusRecomment(inputFocus, ajaxUrl, fieldGet, boxRecommentContent);
    });

    handleBlurRecommet(inputFocus, __settimeout, boxRecommentContent);
}

function handleBlurRecommet(inputFocus, __settimeout, boxRecommentContent) {
    $("body").delegate(inputFocus, "blur", function() {
        clearTimeout(__settimeout);
        __settimeout = setTimeout(function() {
            $(boxRecommentContent).attr('style','');
            $(boxRecommentContent).stop().hide();
            $(boxRecommentContent).find('ul.list').html('');
        }, 500);
    });
}

function handleFocusRecomment(inputFocus, ajaxUrl, fieldGet, boxRecommentContent) {
    $("body").delegate(inputFocus, "focus", function() {
        let strSearch = $(inputFocus).val();
        if( strSearch.length === 0 ) {
            $.ajax({
                url: ajaxUrl,
                method: "POST",
                data: { fieldGet: fieldGet },
                dataType: "json",
                success : (data) => {
                    let numData = data['data'].length;
                    if( numData > 0 ) {
                        if( numData > 8 ) {
                            $(boxRecommentContent).attr('style','height: 250px;');
                        } else {
                            $(boxRecommentContent).attr('style','height: auto;');
                        }
                        $(boxRecommentContent).stop().show();
                        render_html(data['data'], boxRecommentContent, fieldGet);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        } else {

        }
    });
}

function searchRecommentData() {
    searchRecommentOrderCode();
}

function searchRecommentOrderCode() {
    let inputSearch         = "#orderCode_filter";
    let boxRecommentContent = "#recommentOrderCode";
    let ajaxUrl             = "Order/searchFieldOrder";
    let $fieldSearch        = "order_code";
    let recommentItem       = "#recommentOrderCode ul.list li";
    handleSearchRecomment(inputSearch, ajaxUrl, boxRecommentContent, $fieldSearch, recommentItem);
}

function handleSearchRecomment(inputSearch, ajaxUrl, spaceAppend, $fieldSearch, recommentItem) {
    $("body").delegate(inputSearch,"keyup", function() {
        let $strSearch = $(inputSearch).val();
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: {
                strSearch : $strSearch,
                fieldSearch : $fieldSearch
            },
            dataType: "json",
            success: (data) => {
                if((data['data'].length) > 0) {
                    render_html(data['data'], spaceAppend, $fieldSearch);
                    handleChooseRecomment(recommentItem, inputSearch);
                }
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    });
}

function handleChooseRecomment(recommentItem, inputSearch)
{
    $(recommentItem).click(function() {
        let txtData = $(this).text();
        $(inputSearch).val(txtData);
    });
}

function render_html(data, spaceAppend, fieldData) {
    let htmls = data.map(function(item) {
        return `<li>${item[fieldData]}</li>`;
    });
    $(spaceAppend).find('ul.list').html(htmls.join(''));
}