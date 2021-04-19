<?php $base = new Base; ?>
<main class="main_content" id="baseURL_order" data-url="<?php {{ echo $base->getBaseURLAdmin("Order/index/"); }} ?>">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Quản lý đơn hàng</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Danh sách đơn hàng</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_success" href="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <span>Xuất dữ liệu</span>
                </a>
                <a class="btn_item btn_primary" href="<?php echo "Order/index"; ?>">
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                    <span>Làm mới</span>
                </a>
            </div>
        </div>
        <div class="container_fluid">
            <div class="grid_row filter_wrap">
                <div class="grid_column_12 d_flex justify_content_between">
                    <div class="form_group grid_column_4 position_relative" style="padding-right: 20px;">
                        <label for="" class="form_label d_block">Mã đơn hàng</label>
                        <input class="form_control" type="text" value="<?php {{
                            /** /------------------/ */
                            echo $filter_value['code'];
                            /** /------------------/ */
                        }} ?>" name="filter_order_code" placeholder="Mã đơn hàng" id="filter_order_code" autocomplete="off" spellcheck="false">
                        <div id="recommentOrderCode" class="recomment_data_list position_absolute">
                            <ul class="list"></ul>
                        </div>
                    </div>
                    <div class="form_group grid_column_4" style="padding: 0 10px;">
                        <label for="" class="form_label d_block">Trạng thái đơn hàng</label>
                        <select class="form_control" name="filter_order_status" id="filter_order_status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option <?php {{ echo $filter_value['status'] == "all" ? "selected" : null; }} ?> value="all">Tất cả</option>
                            <option <?php {{ echo $filter_value['status'] == "finish" ? "selected" : null; }} ?> value="finish">Hoàn thành</option>
                            <option <?php {{ echo $filter_value['status'] == "refund" ? "selected" : null; }} ?> value="refund">Hoàn Tiền</option>
                            <option <?php {{ echo $filter_value['status'] == "refuse" ? "selected" : null; }} ?> value="refuse">Từ chối</option>
                            <option <?php {{ echo $filter_value['status'] == "canceled" ? "selected" : null; }} ?> value="canceled">Hủy đơn</option>
                            <option <?php {{ echo $filter_value['status'] == "shipping" ? "selected" : null; }} ?> value="shipping">Đang giao</option>
                            <option <?php {{ echo $filter_value['status'] == "processing" ? "selected" : null; }} ?> value="processing">Đang xử lý</option>
                            <option <?php {{ echo $filter_value['status'] == "return" ? "selected" : null; }} ?> value="return">Trả về</option>
                        </select>
                    </div>
                    <div class="form_group grid_column_4" style="padding-left: 20px;">
                        <label for="" class="form_label d_block">Ngày đặt hàng</label>
                        <input class="form_control" type="date" name="filter_order_date" value="<?php {{ echo $filter_value['createDate']; }} ?>" placeholder="Ngày đặt hàng" id="filter_order_date" autocomplete="off" spellcheck="false">
                    </div>
                </div>
                <div class="grid_column_12 d_flex justify_content_between">
                    <div class="form_group grid_column_4 position_relative" style="padding-right: 20px;">
                        <label for="" class="form_label d_block">Tên khách hàng</label>
                        <input class="form_control" type="text" name="filter_customer" value="<?php {{ echo $filter_value['customer']; }} ?>" placeholder="Tên khách hàng" id="filter_customer" autocomplete="off" spellcheck="false">
                        <div id="recommentCustomer" class="recomment_data_list position_absolute">
                            <ul class="list"></ul>
                        </div>
                    </div>
                    <div class="form_group grid_column_4 position_relative" style="padding: 0 10px;">
                        <label for="" class="form_label d_block">Giá trị đơn hàng</label>
                        <input class="form_control" type="text" name="filter_total_price" value="<?php {{ echo $filter_value['totalPrice']; }} ?>" placeholder="Giá trị đơn hàng" id="filter_total_price" autocomplete="off" spellcheck="false">
                        <div id="recommentTotalPriceOrder" class="recomment_data_list position_absolute">
                            <ul class="list"></ul>
                        </div>
                    </div>
                    <div class="form_group grid_column_4" style="padding-left: 20px;">
                        <label for="" class="form_label d_block">Ngày cập nhật</label>
                        <input class="form_control" type="date" value="<?php {{ echo $filter_value['updateDate']; }} ?>" name="filter_update_date" placeholder="Ngày cập nhật" id="filter_update_date" autocomplete="off" spellcheck="false">
                    </div>
                </div>
                <div class="grid_column_12 d_flex justify_content_end">
                    <button type="button" id="button_filter" class="btn_primary">
                        <i class="fa fa-filter"></i>
                        <span>Lọc</span>
                    </button>
                </div>
            </div>
            <div class="action_wrap d_flex align_items_center">
                <div class="page_action_item filter grid_column_4">
                    <div class="value d_flex align_items_center">
                        <div class="form_change_wrap position_relative">
                            <select name="" id="" class="form_control option_status">
                                <option value="">-- Tác vụ --</option>
                                <option value="delete">Xóa</option>
                            </select>
                            <button type="button" class="form_button position_absolute">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <span>Cập nhật</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loader_wrap">
        <div class="loader"></div>
    </div>
    <div class="alert_wrap">
        <div class="alert position_relative" data-status="">
            <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
            <span></span>
            <button type="button" class="close position_absolute">x</button>
        </div>
    </div>
    <div class="table_content container_fluid">
        <div class="panel_table">
            <div class="panel_heading d_flex justify_content_between align-center">
                <h2 class="panel_title">
                    <i class="fa fa-list"></i>
                    <span>Danh sách</span>
                </h2>
                <div>Tổng số <strong>(<?php {{ echo $totalOrder; }} ?>)</strong> Đơn hàng</div>
            </div>
            <div class="panel_body">
                <div id="table_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>
                                    <input class="checkAllButton" type="checkbox" name="">
                                </td>
                                <td>STT</td>
                                <td>
                                    <a class="asc" href="">
                                        <span>Mã đơn hàng</span>
                                    </a>
                                </td>
                                <td>Khách hàng</td>
                                <td>Trạng thái</td>
                                <td>Tổng tiền</td>
                                <td>Ngày đặt hàng</td>
                                <td>Ngày cập nhật</td>
                                <td>Xem</td>
                                <td>Cập nhật</td>
                                <td>Xóa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( !empty($listOrder) ) : ?>
                                <?php $orderRow = 1; foreach( $listOrder as $orderItem ) : ?>
                                    <tr data-id="<?php {{ echo $orderItem['order_id']; }} ?>">
                                        <td>
                                            <input class="checkItem" type="checkbox" name="<?php {{ echo $orderItem['order_id']; }} ?>">
                                        </td>
                                        <td><?php {{ echo $orderRow ++; }} ?></td>
                                        <td><?php {{ echo $orderItem['order_code']; }} ?></td>
                                        <td><?php {{ echo $orderItem['order_customer_fullname']; }} ?></td>
                                        <td><?php {{ echo Format::formatStatusOrder( $orderItem['order_status'] ); }} ?></td>
                                        <td><?php {{ echo Format::formatCurrency( $orderItem['order_totalPrice'] ); }} ?></td>
                                        <td><?php {{ echo Format::formatFullTime( $orderItem['order_createDate'] ); }} ?></td>
                                        <td><?php {{ echo Format::formatFullTime( $orderItem['order_updateDate'] ); }} ?></td>
                                        <td class="view">
                                            <a href="<?php {{ echo "Order/detail/{$orderItem['order_id']}/{$orderItem['order_code']}"; }} ?>" class="btn btn_info d_inline">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="update">
                                            <a href="<?php {{ echo "Order/update/{$orderItem['order_id']}/{$orderItem['order_code']}"; }} ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="delete">
                                            <a href="javascript:;">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="11">Không có đơn hàng nào ?</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pagination_wrap"><?php
    {{
        if($totalPage > 1) { echo Pagination::getPagination("Order/index/{$filter['code']}{$filter['status']}{$filter['createDate']}{$filter['customer']}{$filter['totalPrice']}{$filter['updateDate']}&page=", $totalPage, $page); }
    }} ?></div>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/listOrder.ajax.js"); }} ?>"></script>
<script type="text/javascript" class="checked_list">
    let btnCheckAllBtn = document.querySelector("input[type='checkbox'].checkAllButton");
    let listBtnCheck   = document.querySelectorAll("input[type='checkbox'].checkItem");
    btnCheckAllBtn.addEventListener('click', function() {
        if(this.checked) {
            listBtnCheck.forEach(el=> {
                el.checked = true;
            });
        } else {
            listBtnCheck.forEach(el=> {
                el.checked = false;
            });
        }
    });
</script>
<script type="text/javascript" class="handle_toggle_input_status">
    let btnToggle = document.querySelectorAll("#table_content table.table tr .toogle_status");
    btnToggle.forEach(el => {
        el.addEventListener('click', function() {
            if(this.classList.contains('on')) {
                this.classList.remove('on');
                this.classList.add('off');
            } else {
                this.classList.remove('off');
                this.classList.add('on');
            }
        });
    });
</script>
<style>
    .recomment_data_list {
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,.12);
        width: 100%;
        border-radius: 3px;
        top: 100%;
        overflow: auto;
        display: none;
        z-index: 10;
    }

    .recomment_data_list ul.list li {
        padding: 5px 10px;
        font-size: .9rem;
        cursor: pointer;
    }
    .recomment_data_list ul.list li:hover {
        background: #eeeeee;
    }
</style>