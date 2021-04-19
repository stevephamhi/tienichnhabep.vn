$(function() {

    __construct();

    function __construct() {
        handleLoadNumOrderCart();
    }

    function handleLoadNumOrderCart() {
        $.ajax({
            url: "?controller=Cart&action=handleGetNumTotalOrderCart",
            method: "POST",
            dataType: "json",
            success(data) {
                let numOrderEl = ".middle_right_container .user_infomation_cart .user_infomation_cart_view";
                let numOrderMbEL = ".value_numOrder_cart";
                $(numOrderEl).find(".value").text(parseInt(data['totalOrder']));
                $(numOrderMbEL).text(parseInt(data['totalOrder']));
            },
            error(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
});