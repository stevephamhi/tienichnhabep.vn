<?php
{{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Khách hàng</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php echo $base->getBaseURLAdmin(); ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Cập nhật khách hàng</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button <?php {{
                        echo empty( $customerItem ) ? "disabled" : null;
                    }} ?> type="submit" name="updateCustomer_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Brand">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Quay về</span>
                    </a>
                </div>
            </div>
        </div>
        <?php if(!empty($statusActionCustomer)) : ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionCustomer['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionCustomer['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionCustomer['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php endif; ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Chỉnh sửa thông tin khách hàng</span>
                    </h2>
                </div>
                <?php if( !empty( $customerItem ) ) : ?>
                    <div class="panel_body">
                        <form action="" method="POST">
                            <div id="table_content">
                                <div class="nav_tabs d_flex align_items_center">
                                    <a class="tab_item active" href="#tab_general">Tổng quan</a>
                                    <a class="tab_item" href="#tab_transaction">Giao dịch</a>
                                </div>
                                <div class="tab_content">
                                    <div class="tab_pane" id="tab_general">
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="customer_status" class="form_label"><strong style="color: #f00;">*</strong> Trạng thái</label>
                                                <div class="form_input">
                                                    <select name="customer_status" id="customer_status" class="form_control">
                                                        <option <?php {{
                                                            /** ------------------------ */
                                                            if( !empty(Validation::setValue("customer_status")) )
                                                            { echo Validation::setValue("customer_status") == "active" ? "selected" : null; }
                                                            else
                                                            { echo $customerItem['customer_status'] == "active" ? "selected" : null; }
                                                            /** ------------------------ */
                                                        }} ?> value="active">Hoạt động</option>
                                                        <option <?php {{
                                                            /** ------------------------ */
                                                            if( !empty(Validation::setValue("customer_status")) )
                                                            { echo Validation::setValue("customer_status") == "pending" ? "selected" : null; }
                                                            else
                                                            { echo $customerItem['customer_status'] == "pending" ? "selected" : null; }
                                                            /** ------------------------ */
                                                        }} ?> value="pending">Chờ duyệt</option>
                                                        <option <?php {{
                                                            /** ------------------------ */
                                                            if( !empty(Validation::setValue("customer_status")) )
                                                            { echo Validation::setValue("customer_status") == "disable" ? "selected" : null; }
                                                            else
                                                            { echo $customerItem['customer_status'] == "disable" ? "selected" : null; }
                                                            /** ------------------------ */
                                                        }} ?> value="disable">Vô hiệu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="customer_fullname" class="form_label"><strong style="color: #f00;">*</strong> Họ và tên</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="customer_fullname" id="customer_fullname" value="<?php {{
                                                        /**-------------------------- */
                                                        if( !empty( Validation::setValue("customer_fullname") ) ) {
                                                            echo Validation::setValue("customer_fullname");
                                                        } else {
                                                            echo !empty($customerItem['customer_fullname']) ? $customerItem['customer_fullname'] : null;
                                                        }
                                                        /**-------------------------- */
                                                    }} ?>" placeholder="Họ và tên khách hàng" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="customer_gender" class="form_label"><strong style="color: #f00;">*</strong> Giới tính</label>
                                                <div class="form_input">
                                                    <select name="customer_gender" id="customer_gender" class="form_control">
                                                        <option <?php {{
                                                            /** -------------- */
                                                            if( !empty( Validation::setValue("customer_gender") ) ) {
                                                                echo Validation::setValue("customer_gender") == "male" ? "selected" : null;
                                                            } else {
                                                                echo $customerItem['customer_gender'] == "male" ? "selected" : null;
                                                            }
                                                            /** -------------- */
                                                        }} ?> value="male">Nam</option>
                                                        <option <?php {{
                                                            /** -------------- */
                                                            if( !empty( Validation::setValue("customer_gender") ) ) {
                                                                echo Validation::setValue("customer_gender") == "female" ? "selected" : null;
                                                            } else {
                                                                echo $customerItem['customer_gender'] == "female" ? "selected" : null;
                                                            }
                                                            /** -------------- */
                                                        }} ?> value="female">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="customer_email" class="form_label"><strong style="color: #f00;">*</strong> Email</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="customer_email" id="customer_email" value="<?php {{
                                                        /** ------------------------------ */
                                                        if( !empty( Validation::setValue("customer_email") ) ) {
                                                            echo Validation::setValue("customer_email");
                                                        } else {
                                                            echo !empty( $customerItem['customer_email'] ) ? $customerItem['customer_email'] : null;
                                                        }
                                                        /** ------------------------------ */
                                                    }} ?>" placeholder="Email khách hàng" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="customer_phone" class="form_label"><strong style="color: #f00;">*</strong> SĐT</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="customer_phone" id="customer_phone" value="<?php {{
                                                        if( !empty( Validation::setValue("customer_phone") ) ) {
                                                            echo Validation::setValue("customer_phone");
                                                        } else {
                                                            echo !empty( $customerItem['customer_phone'] ) ? $customerItem['customer_phone'] : null;
                                                        }
                                                    }} ?>" placeholder="Số điện thoại khách hàng" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="customer_createDate" class="form_label"><strong style="color: #f00;">*</strong> Ngày tham gia</label>
                                                <div class="form_input">
                                                    <input disabled class="form_control" type="text" name="customer_createDate" id="customer_createDate" value="<?php {{
                                                        echo !empty( $customerItem['customer_createDate'] ) ? Format::formatFullTime($customerItem['customer_createDate']) : null;
                                                    }} ?>" placeholder="Thời gia khách hàng tham gia" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_transaction">
                                        <div class="table_transaction">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td>STT</td>
                                                        <td>Thời gian</td>
                                                        <td>Mã đơn</td>
                                                        <td>Tổng tiền</td>
                                                        <td>Trạng thái</td>
                                                        <td>Xem</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if( !empty( $listOrder ) ) : ?>
                                                        <?php $orderRow = 1; foreach( $listOrder as $orderItem ) : ?>
                                                            <tr data-id="<?php {{ echo $orderItem['order_id']; }} ?>">
                                                                <td><?php {{ echo $orderRow ++; }} ?></td>
                                                                <td><?php {{ echo Format::formatFullTime( $orderItem['order_createDate'] ); }} ?></td>
                                                                <td><?php {{ echo $orderItem['order_code']; }} ?></td>
                                                                <td><?php {{ echo Format::formatCurrency($orderItem['order_totalPrice']); }} ?></td>
                                                                <td><?php {{ echo Format::formatStatusOrder($orderItem['order_status']); }} ?></td>
                                                                <td>
                                                                    <a target="_blank" href="<?php {{ echo "Order/detail/{$orderItem['order_id']}/{$orderItem['order_code']}"; }} ?>" class="btn btn_info d_inline">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <tr>
                                                            <td colspan="5">Chưa có đơn hàng nào !</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td style="font-weight: bold;" class="text_right" colspan="4">Tổng giao dịch</td>
                                                        <td style="font-weight: bold;" colspan="2"><?php {{ echo Format::formatCurrency($totalTransactionPrice); }} ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else : ?>
                    <p class="data_empty_notification">Không tồn tại khách hàng này !</p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addBrand.ajax.js"); }} ?>"></script>
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