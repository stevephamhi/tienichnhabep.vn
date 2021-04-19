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
                        <a href="">Thêm nhóm khách hàng</a>
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
                    <span>Thêm nhóm khách hàng</span>
                </h2>
            </div>
            <div class="panel_body">
                <form action="" method="POST">
                    <div id="table_content">
                        <div class="nav_tabs d_flex align_items_center">
                            <a class="active tab_item" href="#tab_general">Tổng quan</a>
                        </div>
                        <div class="tab_content">
                            <div class="tab_pane" id="tab_general">
                                <div class="content_group">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label"><strong style="color: #f00;">*</strong> Tên nhóm khách hàng</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Tên nhóm khách hàng" autocomplete="off" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Mô tả</label>
                                        <div class="form_input">
                                            <textarea class="form_control" name="" id="" placeholder="Mô tả" spellcheck="false"></textarea>
                                            <p class="caption">Ký tự đã dùng: 0/320</p>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label" title="Khách hàng phải được duyệt bởi người quản trị trước khi có thể đăng nhập.">
                                            <span>Duyệt khách hàng mới</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <div class="list_check">
                                                <label for="allow" class="check_item" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="radio" name="approval[]" id="allow" value="1">
                                                    <span>Có</span>
                                                </label>
                                                <label for="notAllow" class="check_item" style="padding: 0 10px; cursor: pointer;">
                                                    <input type="radio" name="approval[]" id="notAllow" value="0">
                                                    <span>Không</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="" class="form_label">Thứ tự</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="" id="" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
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