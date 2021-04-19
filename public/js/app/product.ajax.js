$(function() {

    let baseURL = $("#baseURL").attr('data-url');

    let timeOut__modalBox = undefined;
    let timeOut__showBox  = undefined;
    let hrefToCart        = $(".bottom_info_wrap .button_wrap .payNow").attr('href');

    __construct();

    function __construct()
    {
        handleAddCart();
        handlePayNow();
        handlePayUseUrl();
        handlePayNowPopup();
    }

    function handleAddCart()
    {
        let cartInfo   = {
            "wrapper"   : "body",
            "btnAdd"    : ".bottom_info_wrap .button_wrap .addCart",
            "baseURL"   : "?controller=Cart&action=handleAddCart",
            "treeInfo"  : "#info_product",
            "amountInp" : "#amount"
        };

        $(cartInfo['wrapper']).delegate(cartInfo['btnAdd'], "click", function() {
            let $cart_prod_id = parseInt( $(cartInfo['treeInfo']).attr('data-id') );
            let $cart_num_qty = parseInt( $(cartInfo['amountInp']).val() );
            $.ajax({
                url: baseURL + cartInfo['baseURL'],
                method: "POST",
                data: {
                    cart_prod_id : $cart_prod_id,
                    cart_num_qty : $cart_num_qty
                },
                dataType: "json",
                beforeSend: () => {
                    $(".modal_loader").addClass('open');
                },
                success: (data) => {
                    if(data['status'] === "success") {
                        timeOut__modalBox = setTimeout(() => {
                            $(".modal_loader").removeClass('open');
                            handleScrollTop();
                            handleShowBoxNotificationCart(data['prodCart']);
                            handleUpdateNumOrder(data['dataResult']['totalOrder']);
                        }, 300);
                    }
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    console.log(xhr.status);
                    console.log(thrownError);
                }
            })
        });
    }

    function handlePayNow()
    {
        let payNowBtn  = ".bottom_info_wrap .button_wrap .payNow";
        let addCartBtn = ".bottom_info_wrap .button_wrap .addCart";
        $(payNowBtn).click(function() {
            event.preventDefault();
            $(addCartBtn).click();
            window.location.replace(hrefToCart);
        });
    }

    function handlePayUseUrl()
    {
        let url = window.location.href;
        if(url.search("act=pay") !== -1 ) {
            $(".bottom_info_wrap .button_wrap .addCart").click();
            window.location.replace(hrefToCart);
        }
    }

    function handlePayNowPopup()
    {
        let payNowBtn  = ".list_content_installment table .btn.buy";
        let addCartBtn = ".bottom_info_wrap .button_wrap .addCart";
        $(payNowBtn).click(function() {
            event.preventDefault();
            $(addCartBtn).click();
            window.location.replace(hrefToCart);
        });
    }

    function handleScrollTop()
    {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
    }

    function handleShowBoxNotificationCart(prodCart)
    {
        clearTimeout(timeOut__modalBox);
        clearTimeout(timeOut__showBox);

        let data = {
            "popup"    : ".addCart_notification",
            "image"    : ".addCart_notification .product .prod_image img",
            "name"     : ".addCart_notification .product .prod_name",
            "url"      : ".addCart_notification .product",
            "closeBtn" : ".addCart_notification .btn_close"
        };
        $(data['image']).attr('src', prodCart['prod_avatar']);
        $(data['name']).text(prodCart['prod_name']);
        $(data['url']).attr("href", prodCart['prod_url']);
        $(data['popup']).addClass('open');
        timeOut__showBox = setTimeout(function() {
            $(data['popup']).removeClass('open');
        }, 5000);
        $(data['closeBtn']).click(function() {
            event.preventDefault();
            $(data['popup']).removeClass('open');
            clearTimeout(timeOut__showBox);
        });
    }

    function handleUpdateNumOrder(numOrder)
    {
        let numOrderEl = ".middle_right_container .user_infomation_cart .user_infomation_cart_view";
        let numOrderMbEL = ".value_numOrder_cart";
        $(numOrderEl).find(".value").text(numOrder);
        $(numOrderMbEL).text(numOrder);
    }

});