<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Nhóm khách hàng</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Danh sách nhóm khách hàng</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
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
                                        <span>Tên nhóm khách hàng</span>
                                    </a>
                                </td>
                                <td>Thứ tự</td>
                                <td>Ngày tạo</td>
                                <td>Cập nhật</td>
                                <td>Xóa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="checkItem" type="checkbox" name="">
                                </td>
                                <td>Bếp hồng ngoại</td>
                                <td>1</td>
                                <td>22/10/2001</td>
                                <td class="update">
                                    <a href="">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="delete">
                                    <a href="">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
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