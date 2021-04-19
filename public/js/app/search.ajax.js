$(function() {
    let baseURL = $("#baseURL").attr('data-url');

    init();

    function init()
    {
        handleActionActiveRecommentItem();
        hanldeSearchRecomment();
        handleSearchActionForm();
    }

    function handleActionActiveRecommentItem()
    {
        let recommentItem = $(".search_action_recomment .ac_list li");
        $("body").delegate(".search_action_recomment .ac_list li","mousemove", function() {
            recommentItem.removeClass('active');
            $(this).addClass('active');
        });
    }

    function hanldeSearchRecomment()
    {
        $("body").delegate(".formSearch_input","blur", function() {
            setTimeout(function() {
                $(".search_action_recomment").removeClass("open");
            }, 500);
        });

        $("body").delegate(".formSearch_input","keyup", function() {
            let $strSearch = $(this).val();
            $.ajax({
                url: baseURL + "?controller=search&action=recommentSearch",
                method: "POST",
                data: { strSearch: $strSearch },
                dataType: "json",
                success: (data) => {
                    handleBoxRecomment(data['listProd'], data['list']);
                    if(data['type'] === "brand") {
                        render_html_brand(data['list']);
                    }
                    if(data['type'] === "cateProduct") {
                        render_html_cateProd(data['list']);
                    }
                    if(data['type'] === "product") {
                        render_html_cateProd(data['list']);
                    }
                    render_html_product(data['listProd']);
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            });
        })
    }

    function handleBoxRecomment(listProd, list)
    {
        let formSearchRecoment = $(".search_action_recomment");

        if( listProd === undefined && list === undefined ) {
            formSearchRecoment.removeClass('open');
        } else {
            formSearchRecoment.addClass('open');
            if( listProd.length > 6 || list.length > 2 ) {
                formSearchRecoment.attr("style","height: 380px;");
                if(listProd.length == 0 && list.length < 10) {
                    formSearchRecoment.attr("style","height: auto;");
                }
            } else {
                formSearchRecoment.attr("style","height: auto;");
            }
        }
    }

    function render_html_brand(listBrand)
    {
        if(listBrand != undefined) {
            let htmls = listBrand.map(function(item) {
                return `
                <li class="">
                    <a href="${slug_string(item['brand_name'])}-b${item['brand_id']}.html" class="recoment_top">
                        <span>Thương hiệu</span>
                        <strong>${item['brand_name']}</strong>
                    </a>
                </li>`;
            });
            $("#ac_search_list_another").empty();
            $("#ac_search_list_another").html(htmls);
        } else {
            $("#ac_search_list_another").empty();
        }
    }

    function render_html_cateProd(listCateProd)
    {
        if(listCateProd != undefined) {
            let htmls = listCateProd.map(function(item) {
                return `
                <li class="">
                    <a href="${item['cateProd_seoUrl']}-c${item['cateProd_id']}.html" class="recoment_top">
                        <span>Danh mục</span>
                        <strong>${item['cateProd_name']}</strong>
                    </a>
                </li>`;
            });
            $("#ac_search_list_another").empty();
            $("#ac_search_list_another").html(htmls);
        } else {
            $("#ac_search_list_another").empty();
        }
    }

    function render_html_product(listProd)
    {
        if(listProd != undefined) {
            let htmls = listProd.map(function(item) {
                return `<li> <table border="0" style="width: 100%;" cellpadding="0" cellspacing="0"> <tbody> <tr>
                        <td class="ac_img">
                            <a href="${item['prod_seoUrl']}-p${item['prod_id']}.html">
                                <img src="admin/${item['prod_avatar']}" width="42" height="42" alt="">
                            </a>
                        </td>
                        <td class="ac_name w_100">
                            <a href="${item['prod_seoUrl']}-p${item['prod_id']}.html">
                                <span>${item['prod_name']}</span>
                            </a>
                        </td>
                        <td class="ac_price">
                            <a href="${item['prod_seoUrl']}-p${item['prod_id']}.html">
                                <span>${currencyFormat(item['prod_currentPrice'])}</span>
                            </a>
                        </td> </tr> </tbody> </table> </li>`;
            });
            $("#ac_search_list_prod").empty();
            $("#ac_search_list_prod").html(htmls.join(''));
            handleActionActiveRecommentItem();
        } else {
            $("#ac_search_list_prod").empty();
        }
    }

    function slug_string(str)
    {
        str = str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
        str = str.replace(/-+-/g, "-");
        str = str.replace(/^\-+|\-+$/g, "");
        if (str === undefined) {
            return false;
        } else {
            return str;
        }
    }

    function currencyFormat(number)
    {
        return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(number);
    }

    function handleSearchActionForm()
    {
        let formSearch = ".formSearch_root .formSearch_form_sc form";
        let inputGet   = ".formSearch_root .formSearch_form_sc form .formSearch_input";
        $(inputGet).focus(function() {
            $(inputGet).attr("placeholder", "Tìm sản phẩm, danh mục hay thương hiệu mong muốn ...");
        });
        $("body").delegate(formSearch, "submit", function() {
            event.preventDefault();
            let $strSearch = $(inputGet).val();
            if( $strSearch.length == 0)
            {
                $(inputGet).attr("placeholder", "Bạn chưa nhập từ khóa để tìm kiếm !");
                $(inputGet).blur();
            }
            else
            {
                $.ajax({
                    url: "?controller=search&action=cusomizeUrlSearch",
                    method: "POST",
                    data: { strSearch : $strSearch },
                    dataType: "json",
                    success: (data) => {
                        let urlSearch = baseURL+data['url'];
                        window.location.replace(urlSearch);
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        console.log(xhr.status);
                        console.log(thrownError);
                    }
                });
            }
        });
    }
});