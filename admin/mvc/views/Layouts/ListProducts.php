<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Sản phẩm</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Sản phẩm</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_success" href="">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <span>Xuất dữ liệu</span>
                </a>
                <a class="btn_item btn_primary" href="Product/add">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Thêm mới</span>
                </a>
                <a class="btn_item btn_default" href="<?php {{ echo "Product/index/{$orderBy}/{$status}/{$page}"; }} ?>">
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                    <span>Làm mới</span>
                </a>
            </div>
        </div>
        <div class="container_fluid">
            <div class="action_wrap grid_row justify_content_between align_items_center">
                <div class="page_action_item filter grid_column_4">
                    <div class="value d_flex align_items_center">
                        <div class="form_change_wrap position_relative">
                            <select name="" id="" class="form_control option_status">
                                <option value="">-- Tác vụ --</option>
                                <option value="on">Bật</option>
                                <option value="off">Tắt</option>
                                <option value="delete">Xóa</option>
                            </select>
                            <button  type="button" class="form_button position_absolute">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <span>Cập nhật</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="page_action_item filter grid_column_2">
                    <div class="value d_flex align_items_center justify_content_center">
                        <a class="item <?php {{ echo $status == 'all' ? 'active' : null; }} ?>" href="<?php {{ echo "Product/index/{$orderBy}/all/{$page}"; }} ?>">Tất cả</a>
                        <a class="item <?php {{ echo $status == 'on'  ? 'active' : null; }} ?>" href="<?php {{ echo "Product/index/{$orderBy}/on/{$page}"; }} ?>">Bật</a>
                        <a class="item <?php {{ echo $status == 'off' ? 'active' : null; }} ?>" href="<?php {{ echo "Product/index/{$orderBy}/off/{$page}"; }} ?>">Tắt</a>
                    </div>
                </div>
                <div class="page_action_item search grid_column_6">
                    <div class="value d_flex align_items_center w_100 position_relative">
                        <form action="" class="search_module w_100">
                            <div class="form_group position_relative">
                                <select class="form_control position_absolute" name="searchType" id="searchType">
                                    <option <?php {{ echo $fieldName == "prod_name"         ? "selected" : null; }} ?> value="prod_name">Theo tên</option>
                                    <option <?php {{ echo $fieldName == "prod_model"        ? "selected" : null; }} ?> value="prod_model">Theo model</option>
                                    <option <?php {{ echo $fieldName == "cateProd_name"     ? "selected" : null; }} ?> value="cateProd_name">Theo danh mục</option>
                                    <option <?php {{ echo $fieldName == "prod_currentPrice" ? "selected" : null; }} ?> value="prod_currentPrice">Theo giá</option>
                                </select>
                                <input type="text" name="searchStr" style="padding-left: 155px;" class="form_control" value="<?php {{ echo $strSearch; }} ?>" placeholder="Nhập tên sản phẩm ..." autocomplete="off" spellcheck="false">
                                <button type="submit" name="searchBtn" class="form_button position_absolute">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Tìm kiếm</span>
                                </button>
                                <div class="RecommentSearch_action_listProd position_absolute">
                                    <div class="title">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <span>Danh sách sản phẩm</span>
                                    </div>
                                    <ul class="list"></ul>
                                </div>
                                <style>.RecommentSearch_action_listProd{background-color:#fff;top:100%;right:0;width:80%;z-index:10;box-shadow:0 0 12px rgba(0,0,0,.12);display:none}.RecommentSearch_action_listProd .title{padding:7px 10px;background-color:#eee;margin-bottom:5px}.RecommentSearch_action_listProd .list{height:300px;overflow:auto}.RecommentSearch_action_listProd .list .item{padding:5px 10px;cursor:pointer}.RecommentSearch_action_listProd .list .item:hover{background-color:#eee}</style>
                            </div>
                        </form>
                        <div class="rearch_recomment position_absolute">
                            <span class="close position_absolute">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <ul class="search_recomment_wrap_list"></ul>
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
        <div class="alert  position_relative" data-status="">
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
                <div>Tổng số <strong>(<?php {{ echo $totalProd; }} ?>)</strong> Sản phẩm</div>
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
                                <td>Hình ảnh</td>
                                <td>
                                    <a class="<?php {{ echo $orderBy; }} ?>" href="<?php
                                    {{ $__orderBy__ = $orderBy == "desc" ? "asc" : "desc"; }}
                                    {{ echo "Product/index/{$__orderBy__}/{$status}/{$page}"; }} ?>"><span>Tên sản phẩm</span>
                                    </a>
                                </td>
                                <td>Model</td>
                                <td>Thanh lý</td>
                                <td>Trả góp</td>
                                <td>VAT</td>
                                <td>Giá hiện tại</td>
                                <td>Giá cũ</td>
                                <td>Số lượng</td>
                                <td>Trạng thái</td>
                                <td>Cập nhật</td>
                                <td>Xóa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php {{ if(!empty($listProd)) {
                                $orderRow = 1;
                                foreach($listProd as $prodItem) {
                                    $prodItem['url_update']     = "Product/update/{$prodItem['prod_id']}/".($prodItem['prod_seoUrl']).".html";
                                    $prodItem['url_goto_brand'] = "Brand/update/{$prodItem['prod_brand_id']}/".(Format::create_slug($prodItem['prod_brand_name'])).".html";
                                ?>
                                    <tr data-id="<?php {{ echo $prodItem['prod_id']; }} ?>">
                                        <td>
                                            <input class="checkItem" type="checkbox" name="<?php {{ echo $prodItem['prod_id']; }} ?>">
                                        </td>
                                        <td><?php {{ echo $orderRow++; }} ?></td>
                                        <td class="image">
                                            <img src="<?php {{
                                                echo !empty($prodItem['prod_avatar']) ? $prodItem['prod_avatar'] : "./public/images/logo/no_image-50x50.png";
                                            }} ?>" alt="">
                                        </td>
                                        <td class="info">
                                            <span class="name"><?php {{ echo $prodItem['prod_name']; }} ?></span>
                                            <div>
                                                <p>Xem: <?php {{ echo $prodItem['prod_view']; }} ?>, Đánh giá: [Bổ sung]</p>
                                                <a class="d_inline_block" href="<?php {{ echo $prodItem['url_goto_brand']; }} ?>">Thương hiệu: <?php {{ echo $prodItem['prod_brand_name']; }} ?></a>
                                            </div>
                                        </td>
                                        <td><?php {{ echo !empty($prodItem['prod_model']) ? $prodItem['prod_model'] : 'Chưa'; }} ?></td>
                                        <td>
                                            <label for="prod_<?php {{ echo $prodItem['prod_id']; }} ?>" class="form_button">
                                                <input type="checkbox" <?php {{ echo $prodItem['prod_liquidation'] == "1" ? "checked" : null; }} ?> data-liquidation="<?php {{ echo $prodItem['prod_liquidation']; }} ?>" class="select_prod_liquidation" id="prod_<?php {{ echo $prodItem['prod_id']; }} ?>">
                                                <span class="btn_success" style="padding: 1px 3px; border-radius: 5px;">Chọn</span>
                                            </label>
                                        </td>
                                        <td><?php {{ echo !empty($prodItem['prod_installment_rate']) ? $prodItem['prod_installment_rate']."%" : 'Không'; }} ?></td>
                                        <td><?php {{ echo $prodItem['prod_avt_tax'] == "1" ? "Đã VAT" : 'Chưa VAT'; }} ?></td>
                                        <td><?php {{ echo Format::formatCurrency($prodItem['prod_currentPrice']); }} ?></td>
                                        <td><?php {{ echo Format::formatCurrency($prodItem['prod_oldPrice']); }} ?></td>
                                        <td><?php {{ echo $prodItem['prod_amount']; }} ?></td>
                                        <td>
                                            <div class="toogle_status <?php {{ echo $prodItem['prod_status']; }} ?> position_relative">
                                                <div class="toggle_group position_absolute">
                                                    <label class="toogle_on btn">Bật</label>
                                                    <label class="toogle_off btn">Tắt</label>
                                                    <span class="toggle_handle"></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="update">
                                            <a href="<?php {{ echo $prodItem['url_update']; }} ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td class="delete">
                                            <a href="javascript:;">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } } else { ?> <td colspan="13">Chưa có sản phẩm nào !</td> <?php } }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pagination_wrap"><?php
    {{
        if($totalPage > 1) { echo Pagination::getPagination("Product/index/{$orderBy}/{$status}/", $totalPage, $page); }
    }} ?></div>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/product_list.ajax.js"); }} ?>"></script>
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