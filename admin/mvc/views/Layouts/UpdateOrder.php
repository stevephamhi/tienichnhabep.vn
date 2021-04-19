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
                        <a href="">Quản lý đơn hàng</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_primary" href="">
                    <i class="fa fa-save" aria-hidden="true"></i>
                    <span>Lưu</span>
                </a>
                <a class="btn_item btn_default" href="">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                    <span>Hủy</span>
                </a>
            </div>
        </div>
    </div>
    <div class="table_content container_fluid">
        <div class="panel_table">
            <div class="panel_heading">
                <h2 class="panel_title">
                    <i class="fa fa-pencil"></i>
                    <span>Cập nhật đơn hàng</span>
                </h2>
            </div>
            <div class="panel_body">
                <form action="" method="POST">
                    <div id="table_content">
                        <div class="nav_tabs d_flex align_items_center">
                            <a class="tab_item" href="#tab_customer">1. Chi tiết khách hàng</a>
                            <a class="tab_item" href="#tab_cart">2. Sản phẩm</a>
                            <a class=" tab_item" href="#tab_payment">3. Chi tiết thanh toán</a>
                            <a class="tab_item" href="#tab_shipping">4. Địa chỉ giao hàng</a>
                            <a class="active tab_item" href="#tab_total">5. Tổng số</a>
                        </div>
                        <div class="tab_content">
                            <div class="tab_pane" id="tab_customer">
                                <div class="content_group">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Khách hàng</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Khách hàng" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Nhóm khách hàng</label>
                                        <div class="form_input">
                                            <select class="form_control" name="" id="">
                                                <option value="">Mặc định</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Họ và tên đệm</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Họ và tên đệm" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Ngày sinh</label>
                                        <div class="form_input">
                                            <input class="form_control" type="date" name="" id="" placeholder="Ngày sinh" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Email</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Email" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Số điện thoại</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Số điện thoại" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Số Fax</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Số Fax" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_pane" id="tab_cart">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Sản phẩm</td>
                                            <td>Mã sản phẩm</td>
                                            <td>Số lượng</td>
                                            <td>Unit Price</td>
                                            <td>Tổng</td>
                                            <td>Hành động</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>
                                                <div class="input_group">
                                                    <input class="form_control" style="width: 100px;" min="1" type="number" name="prod[0][quantity]" value="1" placeholder="Số lượng" autocomplete="off" spellcheck="false">
                                                    <button type="submit" class="form_button btn btn_primary" title="Làm mới" data-loading-text="Đang xử lý...">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>799.000đ</td>
                                            <td>799.999đ</td>
                                            <td>
                                                <button type="button" data-loading-text="Đang xử lý..." class="btn btn_danger" data-original-title="Xóa">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>
                                                <div class="input_group">
                                                    <input class="form_control" style="width: 100px;" min="1" type="number" name="prod[0][quantity]" value="1" placeholder="Số lượng" autocomplete="off" spellcheck="false">
                                                    <button type="submit" class="form_button btn btn_primary" title="Làm mới" data-loading-text="Đang xử lý...">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>799.000đ</td>
                                            <td>799.999đ</td>
                                            <td>
                                                <button type="button" data-loading-text="Đang xử lý..." class="btn btn_danger" data-original-title="Xóa">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>
                                                <div class="input_group">
                                                    <input class="form_control" style="width: 100px;" min="1" type="number" name="prod[0][quantity]" value="1" placeholder="Số lượng" autocomplete="off" spellcheck="false">
                                                    <button type="submit" class="form_button btn btn_primary" title="Làm mới" data-loading-text="Đang xử lý...">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>799.000đ</td>
                                            <td>799.999đ</td>
                                            <td>
                                                <button type="button" data-loading-text="Đang xử lý..." class="btn btn_danger" data-original-title="Xóa">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>
                                                <div class="input_group">
                                                    <input class="form_control" style="width: 100px;" min="1" type="number" name="prod[0][quantity]" value="1" placeholder="Số lượng" autocomplete="off" spellcheck="false">
                                                    <button type="submit" class="form_button btn btn_primary" title="Làm mới" data-loading-text="Đang xử lý...">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>799.000đ</td>
                                            <td>799.999đ</td>
                                            <td>
                                                <button type="button" data-loading-text="Đang xử lý..." class="btn btn_danger" data-original-title="Xóa">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>
                                                <div class="input_group">
                                                    <input class="form_control" style="width: 100px;" min="1" type="number" name="prod[0][quantity]" value="1" placeholder="Số lượng" autocomplete="off" spellcheck="false">
                                                    <button type="submit" class="form_button btn btn_primary" title="Làm mới" data-loading-text="Đang xử lý...">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>799.000đ</td>
                                            <td>799.999đ</td>
                                            <td>
                                                <button type="button" data-loading-text="Đang xử lý..." class="btn btn_danger" data-original-title="Xóa">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>
                                                <div class="input_group">
                                                    <input class="form_control" style="width: 100px;" min="1" type="number" name="prod[0][quantity]" value="1" placeholder="Số lượng" autocomplete="off" spellcheck="false">
                                                    <button type="submit" class="form_button btn btn_primary" title="Làm mới" data-loading-text="Đang xử lý...">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>799.000đ</td>
                                            <td>799.999đ</td>
                                            <td>
                                                <button type="button" data-loading-text="Đang xử lý..." class="btn btn_danger" data-original-title="Xóa">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <fieldset>
                                    <legend>Thêm sản phẩm</legend>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Chọn sản phẩm</label>
                                        <div class="form_input">
                                            <input type="text" name="prod" value="" class="form_control" placeholder="Chọn sản phẩm" autocomplete="off" spellcheck="false">
                                            <input type="hidden" name="prod_id" value="100">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                        <label for="" class="form_label">Số lượng</label>
                                        <div class="form_input">
                                            <input type="number" value="1" name="" value="" class="form_control" placeholder="Số lượng" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="text_right" style="margin-top: 5px;">
                                        <button type="button" class="btn btn_primary">
                                            <i class="fa fa-plus-circle"></i>
                                            <span>Thêm sản phẩm</span>
                                        </button>
                                    </div>
                                    <style>
                                        fieldset {
                                            margin-top: 20px;
                                        }
                                        fieldset legend {
                                            padding: 10px 0;
                                        }
                                    </style>
                                </fieldset>
                            </div>
                            <div class="tab_pane" id="tab_payment">
                                <div class="content_group">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Địa chỉ</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Địa chỉ" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Họ và tên đệm</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Họ và tên đệm" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Tên</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Tên" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Số điện thoại</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Số điện thoại" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Công ty</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Công ty" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Địa chỉ dòng 1</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Địa chỉ dòng 1" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Địa chỉ dòng 2</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Địa chỉ dòng 2" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Thành phố</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Thành phố" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Mã bưu điện</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Mã bưu điện" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Tỉnh/Thành phố</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Tỉnh/Thành phố" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_pane" id="tab_shipping">
                                <div class="content_group">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Địa chỉ</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Địa chỉ" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Họ và tên đệm</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Họ và tên đệm" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Tên</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Tên" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Số điện thoại</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Số điện thoại" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Công ty</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Công ty" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Địa chỉ dòng 1</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Địa chỉ dòng 1" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Địa chỉ dòng 2</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Địa chỉ dòng 2" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Thành phố</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Thành phố" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Mã bưu điện</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Mã bưu điện" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Tỉnh/Thành phố</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Tỉnh/Thành phố" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_pane" id="tab_total">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>Sản phẩm</td>
                                            <td>Mã sản phẩm</td>
                                            <td>Số lượng</td>
                                            <td class="text_right" style="padding: 0 10px;">Unit Price</td>
                                            <td class="text_right" style="padding: 0 10px;">Tổng</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>1</td>
                                            <td class="text_right">799.000đ</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>1</td>
                                            <td class="text_right">799.000đ</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>1</td>
                                            <td class="text_right">799.000đ</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>1</td>
                                            <td class="text_right">799.000đ</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                        <tr>
                                            <td>Áo khoát AK2</td>
                                            <td>SM-14</td>
                                            <td>1</td>
                                            <td class="text_right">799.000đ</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text_right">Thành tiền</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text_right">Phí giao hàng tận nơi</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text_right">Tổng số</td>
                                            <td class="text_right">799.999đ</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <fieldset>
                                    <legend>Thông tin đơn hàng</legend>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Phương thức vận chuyển</label>
                                        <div class="form_input d_flex">
                                            <select class="form_control" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" name="" id="">
                                                <option value="">-- Chọn --</option>
                                                <optgroup label="Phí giao hàng tận nơi"></optgroup>
                                                <option value="">Phí vận chuyển toàn quốc - 35.000đ</option>
                                            </select>
                                            <button type="button" style="width: 100px; border: 1px solid #1e91cf; border-top-right-radius: 3px; border-bottom-right-radius: 3px;" data-loading-text="Đang xử lý..." class="btn btn_primary">Áp dụng</button>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                        <label for="" class="form_label">Phương thức thanh toán</label>
                                        <div class="form_input d_flex">
                                            <select class="form_control" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" name="" id="">
                                                <option value="">-- Chọn --</option>
                                                <option value="">Chuyển khoảng</option>
                                                <option value="">Thu tiền tại nhà (COD)</option>
                                            </select>
                                            <button type="button" style="width: 100px; border: 1px solid #1e91cf; border-top-right-radius: 3px; border-bottom-right-radius: 3px;" data-loading-text="Đang xử lý..." class="btn btn_primary">Áp dụng</button>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                        <label for="" class="form_label">Mã giảm giá</label>
                                        <div class="form_input d_flex">
                                            <input type="text" name="" value="" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" class="form_control" placeholder="Mã giảm giá" autocomplete="off" spellcheck="false">
                                            <button type="button" style="width: 100px; border: 1px solid #1e91cf; border-top-right-radius: 3px; border-bottom-right-radius: 3px;" data-loading-text="Đang xử lý..." class="btn btn_primary">Áp dụng</button>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                        <label for="" class="form_label">Trạng thái đơn hàng</label>
                                        <div class="form_input">
                                            <select class="form_control" name="" id="">
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
                                    </div>
                                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                        <label for="" class="form_label">Ghi chú</label>
                                        <div class="form_input">
                                            <textarea name="" id="" class="form_control" style="width: 100%; height: 100px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="text_right" style="margin-top: 5px;">
                                        <button type="button" class="btn btn_warning">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        <button type="button" class="btn btn_primary">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Lưu</span>
                                        </button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="grid_row" style="margin-top: 20px;">
                            <div class="grid_column_6 text_left">
                                <button type="button" class="btn btn_default" style="font-size: .9rem; border-radius: 3px;">
                                    <i class="fa fa-arrow-left"></i>
                                    <span>Quay lại</span>
                                </button>
                            </div>
                            <div class="grid_column_6 text_right">
                                <button type="button" class="btn btn_primary" style="font-size: .9rem; border-radius: 3px;">
                                    <span>Tiếp tục</span>
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
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
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>