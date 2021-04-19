<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Flash Sale</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php echo $base->getBaseURLAdmin(); ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thêm flash sale</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="addFlashSale_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="FlashSale">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{ if(!empty($statusActionFlashSale)) { ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionFlashSale['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionFlashSale['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionFlashSale['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php } }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm flash sale</span>
                    </h2>
                </div>
                <div class="panel_body">
                    <form action="" method="POST">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="active tab_item" href="#tab_general">Tổng quan</a>
                                <a class="tab_item" href="#tab_links">Liên kết</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle on">
                                                <input type="checkbox" name="prod_flashsale_status" <?php {{
                                                    /*----------------------------------------------------*/
                                                    echo Validation::setValue("prod_flashsale_status") == "on" ? "checked" : null;
                                                    /*----------------------------------------------------*/
                                                }} ?> id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="brand_name" class="form_label"><strong style="color: #f00;">*</strong> Nhóm khách hàng</label>
                                            <div class="form_input">
                                                <select class="form_control" name="prod_flashsale_customer_groupId" id="prod_flashsale_customer_groupId">
                                                    <?php {{
                                                        if(!empty($list_customerGroup)) {
                                                            foreach($list_customerGroup as $customerGroupItem) { ?>
                                                                <option <?php {{
                                                                    /*----------------------------------------------------*/
                                                                    echo Validation::setValue("prod_flashsale_customer_groupId") == $customerGroupItem['customerGroup_id'] ? "selected" : null;
                                                                    /*----------------------------------------------------*/
                                                                }} ?> value="<?php {{
                                                                    /*----------------------------------------------------*/
                                                                    echo $customerGroupItem['customerGroup_id'];
                                                                    /*----------------------------------------------------*/
                                                                }} ?>"><?php {{
                                                                    /*----------------------------------------------------*/
                                                                    echo $customerGroupItem['customerGroup_name'];
                                                                    /*----------------------------------------------------*/
                                                                }} ?></option>
                                                            <?php }
                                                        }
                                                    }} ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="flashsale_order" class="form_label">Độ ưu tiên lớn nhất</label>
                                            <div class="form_input">
                                                <input type="text" disabled class="form_control" id="orderMax_current" style="width: 50px; margin-bottom: 5px;" value="">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_flashsale_order" class="form_label">Độ ưu tiên</label>
                                            <div class="form_input">
                                                <input class="form_control" type="number" value="<?php {{
                                                    /*----------------------------------------------------*/
                                                    echo Validation::setValue("prod_flashsale_order");
                                                    /*----------------------------------------------------*/
                                                }} ?>" name="prod_flashsale_order" id="prod_flashsale_order" placeholder="Độ ưu tiên" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_flashsale_price" class="form_label"><strong style="color: #f00;">*</strong> Giá khuyến mãi</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" value="<?php {{
                                                    /*----------------------------------------------------*/
                                                    echo Validation::setValue("prod_flashsale_price");
                                                    /*----------------------------------------------------*/
                                                }} ?>" name="prod_flashsale_price" id="prod_flashsale_price" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("prod_flashsale_price"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_flashsale_dateStart" class="form_label"><strong style="color: #f00;">*</strong> Thời gian bắt đầu</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" value="<?php {{
                                                    /*----------------------------------------------------*/
                                                    echo Validation::setValue("prod_flashsale_dateStart");
                                                    /*----------------------------------------------------*/
                                                }} ?>" name="prod_flashsale_dateStart" id="prod_flashsale_dateStart" placeholder="" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("prod_flashsale_dateStart"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_flashsale_dateEnd" class="form_label"><strong style="color: #f00;">*</strong> Thời gian kết thúc</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" value="<?php {{
                                                    /*----------------------------------------------------*/
                                                    echo Validation::setValue("prod_flashsale_dateEnd");
                                                    /*----------------------------------------------------*/
                                                }} ?>" name="prod_flashsale_dateEnd" id="prod_flashsale_dateEnd" placeholder="" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("prod_flashsale_dateEnd"); }} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_links" style="display: block;">
                                    <div class="form_group d_flex">
                                        <label for="" class="form_label" title="Nhấn để chọn sản phẩm">
                                            <span><span style="color: #f00;">*</span> Sản phẩm</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <div class="form_list_wrap">
                                                <?php {{
                                                    if(!empty($listProd)) { ?>
                                                        <div class="list">
                                                            <?php {{
                                                                foreach($listProd as $prodItem) { ?>
                                                                    <label for="prod_<?php {{ echo $prodItem['prod_id']; }} ?>" class="item d_flex align_items_center">
                                                                        <input type="checkbox" name="prodId[]" class="prodId_checkItem" <?php {{
                                                                            /*----------------------------------------------*/
                                                                            if(!empty(Validation::setValue("prodId"))) {
                                                                                foreach(Validation::setValue("prodId") as $prodIdItem) {
                                                                                    echo $prodIdItem == $prodItem['prod_id'] ? "checked" : null;
                                                                                }
                                                                            }
                                                                            /*----------------------------------------------*/
                                                                        }} ?> value="<?php {{ echo $prodItem['prod_id']; }} ?>" id="prod_<?php {{ echo $prodItem['prod_id']; }} ?>">
                                                                        <span><?php {{ echo $prodItem['prod_name']; }} ?></span>
                                                                    </label>
                                                                <?php }
                                                            }} ?>
                                                        </div>
                                                    <?php }
                                                }} ?>
                                            </div>
                                            <?php {{ echo Validation::formError("prodId"); }} ?>
                                            <div class="list_button d_flex align_items_center">
                                                <a href="" class="btn btn_primary prodSelectAll">Chọn tất cả</a>
                                                <a href="" class="btn btn_warning prodClearAll">Bỏ chọn tất cả</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addFlashsale.ajax.js"); }} ?>"></script>
<script type="text/javascript" class="handle_show_tab_pane">
    activePageTab();
    function activePageTab() {
        let elActive = document.querySelector("#table_content .nav_tabs .tab_item.active");
        let idPane = (elActive.getAttribute('href')).split("#")[1];
        let elPane = document.getElementById(idPane);
        (document.querySelectorAll(".tab_pane")).forEach(el => {
            el.style.display = "none";
        });
        elPane.style.display = "block";
    }
    let listBtnEl = document.querySelectorAll("#table_content .nav_tabs .tab_item");
    listBtnEl.forEach(el => {
        el.addEventListener('click', function() {
            event.preventDefault();
            listBtnEl.forEach(el => {
                el.classList.remove('active');
            });
            this.classList.add('active');
            activePageTab();
        });
    });
</script>

<script>
// handle notification status add cate new
var alertStatusAddCateEl = document.querySelector('.alert');
if(alertStatusAddCateEl !== null) {
    var buttonCloseAlertEl   = document.querySelector(".alert .close");
    if(alertStatusAddCateEl.getAttribute('data-status') === 'true') {
        alertStatusAddCateEl.classList.add('open');
        setTimeout(function() {
            alertStatusAddCateEl.classList.remove('open');
        },5000);
    }

    buttonCloseAlertEl.addEventListener('click', function() {
        alertStatusAddCateEl.classList.remove('open');
    });
}
</script>

<script>
let btnSelectAllProd = document.querySelector(".prodSelectAll");
let btnClearAllProd  = document.querySelector(".prodClearAll");
let listAllProd      = document.querySelectorAll(".prodId_checkItem");
btnSelectAllProd.addEventListener('click', function() {
    listAllProd.forEach(el => {
        el.checked = true;
    });
    event.preventDefault();
});
btnClearAllProd.addEventListener('click', function() {
    listAllProd.forEach(el => {
        el.checked = false;
    });
    event.preventDefault();
});
</script>