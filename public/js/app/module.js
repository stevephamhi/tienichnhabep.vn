$(function() {

    __construct();

    function  __construct()
    {
        handleScroll();
    }

    function handleScroll()
    {
        var url = window.location.href;
        scrollTo__URL(getIdEl(url));
        clickButtonScroll();
    }

    function clickButtonScroll()
    {
        let listBtn = $(".tabbar_menu_control .list_menu_control .promo_tab_text");
        listBtn.click(function() {
            event.preventDefault();
            tabName = "#" + ($(this).attr('href').split("#tab="))[1];
            scrollTo__URL(tabName);
        });
    }

    function scrollTo__URL(tabName) {
        if( tabName != undefined ) {
            let locationTab = $(tabName).offset().top;
            $("html, body").animate({
                scrollTop: locationTab - 60
            }, 1000);
        }
    }

    function getIdEl(url) {
        let replace = url.split("#tab=");
        if (replace[1] != undefined) {
            let idEl = replace[1];
            return "#" + idEl;
        }
    }

});