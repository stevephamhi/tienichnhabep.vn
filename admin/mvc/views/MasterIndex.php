<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php {{ echo $base->getBaseURLAdmin(); }} ?>" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php {{ echo $base->getBaseURLAdmin("public/css/config/helper.css"); }} ?>">
    <link rel="stylesheet" href="<?php {{ echo $base->getBaseURLAdmin("public/css/style/layout.css"); }} ?>">
    <?php {{ $base->getCss($css); }} ?>
    <title><?php {{ echo !empty($title) ? $title : "Chưa thêm title"; }} ?></title>
</head>
<body>
    <div id="dashboardApp" class="position_relative">
        <?php {{ $base->getLayOut("Header"); }} ?>
        <?php {{ $base->getLayOut("Sidebar"); }} ?>
        <?php {{ $base->getLayOut($layOut, $data); }} ?>
        <?php {{ $base->getLayOut("Footer"); }} ?>
    </div>
<script class="pp_notification">
let btnOpen = document.querySelector(".action_label.notification");
let popupEl = document.querySelector(".list_action_app .action_app_item .dropdown_menu");
let maskDropdown = document.querySelector(".mask_dropdown");
maskDropdown.addEventListener('click', function() {
    popupEl.classList.remove('open');
    this.classList.remove('open');
});
btnOpen.addEventListener('click', function() {
    event.preventDefault();
    if(popupEl.classList.contains('open')) {
        popupEl.classList.remove('open');
        maskDropdown.classList.remove('open');
    } else {
        popupEl.classList.add('open');
        maskDropdown.classList.add('open');
    }
});
</script>
<script class="pp_menu_aside">
let menuItemButton = document.querySelectorAll("aside.aside .menu li a.parent");
menuItemButton.forEach(function(el) {
    el.addEventListener('click', function () {
        event.preventDefault();
        let menuDr = this.parentElement.children[1];
        if(menuDr.classList.contains('open')) {
            menuDr.classList.remove('open');
        } else {
            menuDr.classList.add('open');
        }
    });
});
</script>
<script class="pp_toogle_aside">
let toogleAsideButton = document.querySelector(".navbar_header_left .navIcon_aside_toggle");
let appWrapEl = document.getElementById("dashboardApp");
let localStoreAside = localStorage.getItem("asideShow");
if(localStoreAside !== null) {
    appWrapEl.classList.add('showAside');
    toogleAsideButton.children[0].classList.remove('fa-indent');
    toogleAsideButton.children[0].classList.add('fa-outdent');
} else {
    appWrapEl.classList.remove('showAside');
    toogleAsideButton.children[0].classList.remove('fa-outdent');
    toogleAsideButton.children[0].classList.add('fa-indent');
}
toogleAsideButton.addEventListener('click', function() {
    event.preventDefault();
    if(appWrapEl.classList.contains('showAside')) {
        appWrapEl.classList.remove('showAside');
        this.children[0].classList.remove('fa-outdent');
        this.children[0].classList.add('fa-indent');
        localStorage.removeItem('asideShow');
    } else {
        appWrapEl.classList.add('showAside');
        this.children[0].classList.remove('fa-indent');
        this.children[0].classList.add('fa-outdent');
        localStorage.setItem('asideShow',true);
    }
});
</script>
</body>
</html>