$(function() {

    init();

    function init() {
        handleGetOrderMax();
    }

    function handleGetOrderMax() {
        $.ajax({
            url: "Brand/handleGetOrderMax",
            method: "POST",
            dataType: "json",
            success: (data) => {
                data['orderMax'] = data['orderMax'] == null ? 0 : data['orderMax'];
                $("#orderMax_current").attr('value', parseInt(data['orderMax']));
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    }
});