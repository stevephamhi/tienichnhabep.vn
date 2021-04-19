<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Bài viết</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Danh sách chính sách</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_primary" href="Policy/add">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Thêm mới</span>
                </a>
                <a class="btn_item btn_default" href="<?php {{ echo "Policy/index/{$orderBy}/{$status}/{$page}"; }} ?>">
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                    <span>Làm mới</span>
                </a>
            </div>
        </div>
        <div class="container_fluid">
            <div class="action_wrap d_flex align_items_center">
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
                <div class="page_action_item filter grid_column_4">
                    <div class="value d_flex align_items_center justify_content_center">
                        <a class="item <?php {{ echo $status == 'all' ? 'active' : null; }} ?>" href="<?php {{ echo "Policy/index/{$orderBy}/all/{$page}"; }} ?>">Tất cả</a>
                        <a class="item <?php {{ echo $status == 'on'  ? 'active' : null; }} ?>" href="<?php {{ echo "Policy/index/{$orderBy}/on/{$page}"; }} ?>">Bật</a>
                        <a class="item <?php {{ echo $status == 'off' ? 'active' : null; }} ?>" href="<?php {{ echo "Policy/index/{$orderBy}/off/{$page}"; }} ?>">Tắt</a>
                    </div>
                </div>
                <div class="page_action_item search grid_column_4">
                    <div class="value d_flex align_items_center w_100 position_relative">
                        <form action="" class="search_module w_100">
                            <div class="form_group position_relative">
                                <input type="text" name="searchStr" class="form_control" value="<?php {{ echo $strSearch; }} ?>" placeholder="Nhập tên chính sách ..." autocomplete="off" spellcheck="false">
                                <button type="submit" name="" class="form_button position_absolute">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Tìm kiếm</span>
                                </button>
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
                <div>Tổng số <strong>(<?php {{ echo $totalPolicy; }} ?>)</strong> Chính sách</div>
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
                                <td>Tên chính sách</td>
                                <td class="text_left" style="padding: 0 10px;">
                                    <a class="<?php {{ echo $orderBy; }} ?>" href="<?php
                                    {{ $__orderBy__ = $orderBy == "desc" ? "asc" : "desc"; }}
                                    {{ echo "Policy/index/{$__orderBy__}/{$status}/{$page}"; }} ?>"><span>VT ưu tiên</span>
                                    </a>
                                </td>
                                <td>Trạng thái</td>
                                <td>Cập nhật</td>
                                <td>Xóa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($listPolicy)) : ?>
                                <?php $orderRow = 1; foreach($listPolicy as $policyItem) : ?>
                                <?php $policyItem['url_update'] = "Policy/update/{$policyItem['policy_id']}/{$policyItem['policy_seoUrl']}.html"; ?>
                                <tr data-id="<?php {{ echo $policyItem['policy_id']; }} ?>">
                                    <td>
                                        <input class="checkItem" type="checkbox" name="<?php {{ echo $policyItem['policy_id']; }} ?>">
                                    </td>
                                    <td><?php {{ echo $orderRow ++; }} ?></td>
                                    <td><?php {{ echo $policyItem['policy_title']; }} ?></td>
                                    <td>
                                        <input class="form_control" style="width: 40px; text-align: center;" type="text" value="<?php {{ echo $policyItem['policy_order']; }} ?>" autocomplete="off" spellcheck="false">
                                        <button type="button" class="form_button save_videoGroup_order" data-order="<?php {{ echo $policyItem['policy_order']; }} ?>">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <div class="toogle_status <?php {{ echo $policyItem['policy_status']; }} ?> position_relative">
                                            <div class="toggle_group position_absolute">
                                                <label class="toogle_on btn">Bật</label>
                                                <label class="toogle_off btn">Tắt</label>
                                                <span class="toggle_handle"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="update">
                                        <a href="<?php {{ echo $policyItem['url_update']; }} ?>">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="delete">
                                        <a href="javascript:;">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <td colspan="9">Hiện tại chưa có bất kỳ chính sách nào !</td>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pagination_wrap"><?php
    {{
        if($totalPage > 1) { echo Pagination::getPagination("Policy/index/{$orderBy}/{$status}/", $totalPage, $page); }
    }} ?></div>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/listPolicy.ajax.js"); }} ?>"></script>
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

<script type="text/javascript" class="handle_recomment_search">
    // ========== ########## HANDLE RECOMMENT SEARCH ########## ========== //
    let inputFocusSearchEL  = document.querySelector(".action_wrap .page_action_item.search input[name='searchStr']");
    let recommentSearchEl   = document.querySelector(".rearch_recomment");
    let btnCloseRecommentEl = document.querySelector(".rearch_recomment .close");
    let listRecommentItemEL = document.querySelectorAll(".rearch_recomment .search_recomment_wrap_list li span");
    inputFocusSearchEL.addEventListener('focus', function() {
        recommentSearchEl.style.display = "block";
    });
    btnCloseRecommentEl.addEventListener('click', function() {
        recommentSearchEl.style.display = "none";
    });
    listRecommentItemEL.forEach(el => {
        el.addEventListener('click', function() {
            inputFocusSearchEL.value = el.textContent;
        });
    });
</script>