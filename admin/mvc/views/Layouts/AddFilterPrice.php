<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Nhóm lọc giá</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Thêm nhóm lọc giá</a>
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
                    <span>Thêm nhóm lọc giá</span>
                </h2>
            </div>
            <div class="panel_body">
                <form action="" method="POST">
                    <div class="grid_row" id="table_content">
                        <div class="grid_column_6" style="padding-right: 10px;">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="active tab_item" href="#tab_general" style="pointer-events: none;">Tổng quan</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle on">
                                                <input type="checkbox" checked name="" id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="brand_name" class="form_label"><strong style="color: #f00;">*</strong> Tên nhóm lọc giá</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="brand_name" id="brand_name" placeholder="Têm nhóm lọc giá" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="" class="form_label" class="Giá bắt đầu cho một nhóm lọc">
                                                <span>Giá từ</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input">
                                                <input class="form_control" type="number" name="" id="" placeholder="Giá từ" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="" class="form_label" class="Giá kết thúc cho một nhóm lọc">
                                                <span>Đến</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input">
                                                <input class="form_control" type="number" name="" id="" placeholder="Đến" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="" class="form_label">Sắp xếp</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="" id="" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid_column_6" style="padding-left: 10px;">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="active tab_item" href="#tab_relative" style="pointer-events: none;">
                                    <i class="fa fa-thumb-tack"></i>
                                    <span>Áp dụng cho danh mục sản phẩm</span>
                                </a>
                            </div>
                            <div class="tab_content">
                                <div class="form_list_wrap">
                                    <div class="search_help d_flex align_items_center">
                                        <div class="form_search_fake position_relative">
                                            <input type="text" name="strSearch" class="form_control" placeholder="Nhập tên danh mục" autocomplete="off" spellcheck="false">
                                            <button type="button" class="form_button position_absolute">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                                <span>Tìm kiếm</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="list">
                                        <label for="__1" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__1">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__2" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__2">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__3" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__3">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__4" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__4">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__5" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__5">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__6" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__6">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__7" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__7">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__8" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__8">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__9" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__9">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__10" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__10">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__3" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__3">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__11" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__11">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__12" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__12">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__13" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__13">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__14" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__14">
                                            <span>Bếp điện từ</span>
                                        </label>
                                        <label for="__15" class="item d_flex align_items_center">
                                            <input type="checkbox" name="cateProds[]" id="__15">
                                            <span>Bếp điện từ</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="list_button d_flex align_items_center">
                                    <a href="" class="btn btn_primary cateProdSelectAll">Chọn tất cả</a>
                                    <a href="" class="btn btn_warning cateProdClearAll">Bỏ chọn tất cả</a>
                                </div>
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
<script type="text/javascript" class="handle_selectAll_clearAll">
let btnSelectAllCateProd = document.querySelector(".cateProdSelectAll");
let btnClearCateProd     = document.querySelector(".cateProdClearAll");
let listProdCates        = document.querySelectorAll("input[name='cateProds[]']");
let listBlogs            = document.querySelectorAll("input[name='blogs[]']");
btnSelectAllCateProd.addEventListener('click', function() {
    event.preventDefault();
    listProdCates.forEach(el => {
        el.checked = true;
    });
});
btnClearCateProd.addEventListener('click', function() {
    event.preventDefault();
    listProdCates.forEach(el => {
        el.checked = false;
    });
});
</script>