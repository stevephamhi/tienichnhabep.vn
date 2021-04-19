<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Banner giảm giá</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Banner giảm giá</a>
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
                    <span>Banner giảm giá</span>
                </h2>
            </div>
            <div class="panel_body">
                <form action="" method="POST">
                    <div id="table_content">
                        <div class="nav_tabs d_flex align_items_center">
                            <a class="active tab_item" href="#tab_mini_banner">Mini banner</a>
                            <a class="tab_item" href="#tab_header_banner">Đầu trang web</a>
                            <a class="tab_item" href="#tab_content_banner">Trong nội dung</a>
                        </div>
                        <div class="tab_content">
                            <div class="tab_pane" id="tab_mini_banner">
                                <table class="table mini_banner_banner_table">
                                    <thead>
                                        <tr>
                                            <td>Tiêu đề</td>
                                            <td>Ảnh</td>
                                            <td>Sắp xếp</td>
                                            <td>Tác vụ</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <button type="button" id="btnCreate_rowMiniBanner" class="btn btn_primary">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab_pane" id="tab_header_banner">
                                <table class="table header_banner_table">
                                    <thead>
                                        <tr>
                                            <td>Tiêu đề</td>
                                            <td>Ảnh</td>
                                            <td>Sắp xếp</td>
                                            <td>Tác vụ</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <button type="button" id="btnCreate_rowHeaderBanner" class="btn btn_primary">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab_pane" id="tab_content_banner">
                                <table class="table content_banner_table">
                                    <thead>
                                        <tr>
                                            <td>Tiêu đề</td>
                                            <td>Ảnh</td>
                                            <td>Sắp xếp</td>
                                            <td>Tác vụ</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <button type="button" id="btnCreate_rowContentBanner" class="btn btn_primary">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
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
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/banner_promo.js"); }} ?>"></script>