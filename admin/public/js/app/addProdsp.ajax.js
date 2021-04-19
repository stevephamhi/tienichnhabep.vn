$(function() {

    init();

    function init() {
        handleGetOrderMax();
    }

    function handleGetOrderMax() {
        $.ajax({
            url: "Productsp/handleGetOrderMax",
            method: "POST",
            dataType: "json",
            success: (data) => {
                if(data['orderMax'] == null) {
                    $("#orderMax_current").attr('value', 0);
                } else {
                    $("#orderMax_current").attr('value', parseInt(data['orderMax']));
                }
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
});