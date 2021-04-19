<main class="main_content">
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
                <a class="btn_item btn_primary" href="">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Thêm mới</span>
                </a>
                <a class="btn_item btn_danger" href="">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                    <span>Xóa</span>
                </a>
            </div>
        </div>
        <div class="container_fluid">
            <div class="grid_row filter_wrap">
                <div class="grid_column_12 d_flex justify_content_between">
                    <div class="form_group grid_column_4" style="padding-right: 20px;">
                        <label for="" class="form_label d_block">Mã đơn hàng</label>
                        <input class="form_control" type="text" name="" placeholder="Mã đơn hàng" id="" autocomplete="off" spellcheck="false">
                    </div>
                    <div class="form_group grid_column_4" style="padding: 0 10px;">
                        <label for="" class="form_label d_block">Trạng thái đơn hàng</label>
                        <select class="form_control" name="" id="">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="">Đơn hàng lòng hỏng</option>
                            <option value="">Chờ xử lý</option>
                            <option value="">Hết hạn</option>
                            <option value="">Hoàn thành</option>
                            <option value="">Hoàn tiền</option>
                            <option value="">Thất bại</option>
                            <option value="">Từ chối</option>
                            <option value="">Đã hủy bỏ</option>
                            <option value="">Đã vận chuyển</option>
                            <option value="">Đã xử lý</option>
                            <option value="">Đang xử lý</option>
                            <option value="">Đổi trả</option>
                        </select>
                    </div>
                    <div class="form_group grid_column_4" style="padding-left: 20px;">
                        <label for="" class="form_label d_block">Ngày đặt hàng</label>
                        <input class="form_control" type="date" name="filter_model" placeholder="Ngày đặt hàng" id="" autocomplete="off" spellcheck="false">
                    </div>
                </div>
                <div class="grid_column_12 d_flex justify_content_between">
                    <div class="form_group grid_column_4" style="padding-right: 20px;">
                        <label for="" class="form_label d_block">Tên khách hàng</label>
                        <input class="form_control" type="text" name="" placeholder="Tên khách hàng" id="" autocomplete="off" spellcheck="false">
                    </div>
                    <div class="form_group grid_column_4" style="padding: 0 10px;">
                        <label for="" class="form_label d_block">Giá trị đơn hàng</label>
                        <input class="form_control" type="text" name="" placeholder="Giá trị đơn hàng" id="" autocomplete="off" spellcheck="false">
                    </div>
                    <div class="form_group grid_column_4" style="padding-left: 20px;">
                        <label for="" class="form_label d_block">Ngày cập nhật</label>
                        <input class="form_control" type="date" name="" placeholder="Ngày cập nhậ" id="" autocomplete="off" spellcheck="false">
                    </div>
                </div>
                <div class="grid_column_12 d_flex justify_content_between">
                    <div class="form_group grid_column_4" style="padding-right: 20px;">
                        <label for="" class="form_label d_block">Sản phẩm</label>
                        <input class="form_control" type="text" name="" placeholder="Sản phẩm" id="" autocomplete="off" spellcheck="false">
                    </div>
                    <div class="form_group grid_column_4" style="padding: 0 10px;">
                        <label for="" class="form_label d_block">Hãng sản xuất</label>
                        <input class="form_control" type="text" name="" placeholder="Hãng sản xuất" id="" autocomplete="off" spellcheck="false">
                    </div>
                    <div class="form_group grid_column_4" style="padding-left: 20px;">
                        <label for="" class="form_label d_block">Danh mục</label>
                        <input class="form_control" type="text" name="" placeholder="Danh mục" id="" autocomplete="off" spellcheck="false">
                    </div>
                </div>
                <div class="grid_column_12 d_flex justify_content_end">
                    <button type="button" id="button_filter" class="btn_primary">
                        <i class="fa fa-filter"></i>
                        <span>Lọc</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="table_content container_fluid">
        <div class="panel_table">
            <div class="panel_heading">
                <h2 class="panel_title">
                    <i class="fa fa-list"></i>
                    <span>Danh sách</span>
                </h2>
            </div>
            <div class="panel_body">
                <div id="table_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>
                                    <input class="checkAllButton" type="checkbox" name="">
                                </td>
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
                                <td>Cập nhật</td>
                                <td>Xem</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="checkItem" type="checkbox" name="">
                                </td>
                                <td>10</td>
                                <td>Phạm Đình Hùng</td>
                                <td>Chờ xử lý</td>
                                <td>12.000.000đ</td>
                                <td>22/10/2020</td>
                                <td>22/10/2020</td>
                                <td class="update">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="view">
                                    <a href="" class="btn btn_info d_inline">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="checkItem" type="checkbox" name="">
                                </td>
                                <td>10</td>
                                <td>Phạm Đình Hùng</td>
                                <td>Chờ xử lý</td>
                                <td>12.000.000đ</td>
                                <td>22/10/2020</td>
                                <td>22/10/2020</td>
                                <td class="update">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="view">
                                    <a href="" class="btn btn_info d_inline">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="checkItem" type="checkbox" name="">
                                </td>
                                <td>10</td>
                                <td>Phạm Đình Hùng</td>
                                <td>Chờ xử lý</td>
                                <td>12.000.000đ</td>
                                <td>22/10/2020</td>
                                <td>22/10/2020</td>
                                <td class="update">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="view">
                                    <a href="" class="btn btn_info d_inline">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="checkItem" type="checkbox" name="">
                                </td>
                                <td>10</td>
                                <td>Phạm Đình Hùng</td>
                                <td>Chờ xử lý</td>
                                <td>12.000.000đ</td>
                                <td>22/10/2020</td>
                                <td>22/10/2020</td>
                                <td class="update">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="view">
                                    <a href="" class="btn btn_info d_inline">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="checkItem" type="checkbox" name="">
                                </td>
                                <td>10</td>
                                <td>Phạm Đình Hùng</td>
                                <td>Chờ xử lý</td>
                                <td>12.000.000đ</td>
                                <td>22/10/2020</td>
                                <td>22/10/2020</td>
                                <td class="update">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="view">
                                    <a href="" class="btn btn_info d_inline">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
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