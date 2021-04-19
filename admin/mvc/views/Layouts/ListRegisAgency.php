<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1></h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="?">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="javascript:;">Danh sách đăng ký đại lý</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_default" href="">
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                    <span>Làm mới</span>
                </a>
            </div>
        </div>
        <div class="container_fluid">
            <div class="action_wrap d_flex align_items_center">
                <div class="page_action_item filter grid_column_3">
                    <div class="value d_flex align_items_center">
                        <div class="form_change_wrap position_relative">
                            <select name="" id="" class="form_control option_status">
                                <option value="">-- Tác vụ --</option>
                                <option value="delete">Xóa</option>
                            </select>
                            <button  type="button" class="form_button position_absolute">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <span>Cập nhật</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="page_action_item filter grid_column_3">
                    <div class="value d_flex align_items_center justify_content_center">
                        <a class="item <?php {{ echo $status == 'all'        ? 'active' : null; }} ?>" href="<?php {{ echo "Agency/index/{$orderBy}/all/{$page}"; }} ?>">Tất cả</a>
                        <a class="item <?php {{ echo $status == 'processed'  ? 'active' : null; }} ?>" href="<?php {{ echo "Agency/index/{$orderBy}/processed/{$page}"; }} ?>">Đã xử lý</a>
                        <a class="item <?php {{ echo $status == 'no_process' ? 'active' : null; }} ?>" href="<?php {{ echo "Agency/index/{$orderBy}/no_process/{$page}"; }} ?>">Chưa xử lý</a>
                    </div>
                </div>
                <div class="page_action_item search grid_column_6">
                    <div class="value d_flex align_items_center w_100 position_relative">
                        <form action="" class="search_module w_100">
                            <div class="form_group position_relative">
                                <select class="form_control position_absolute" name="searchType" id="searchType">
                                    <option value="agency_fullname">Tên khách hàng</option>
                                    <option value="agency_company">Tên công ty</option>
                                    <option value="agency_phone">Số điện thoại</option>
                                    <option value="agency_email">Email</option>
                                </select>
                                <input type="text" name="searchStr" style="padding-left: 175px;" class="form_control" value="" placeholder="Có vẻ như chức năng search không hoạt động" autocomplete="off" spellcheck="false">
                                <button type="submit" name="searchBtn" class="form_button position_absolute">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Tìm kiếm</span>
                                </button>
                                <div class="RecommentSearch_action_listAgency position_absolute" style="display: none;">
                                    <div class="title">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <span>Danh sách tên khách hàng</span>
                                    </div>
                                    <ul class="list"></ul>
                                </div>
                                <style>.RecommentSearch_action_listAgency{background-color:#fff;top:100%;right:0;width:80%;z-index:10;box-shadow:0 0 12px rgba(0,0,0,.12);display:none}.RecommentSearch_action_listAgency .title{padding:7px 10px;background-color:#eee;margin-bottom:5px}.RecommentSearch_action_listAgency .list{height:300px;overflow:auto}.RecommentSearch_action_listAgency .list .item{padding:5px 10px;cursor:pointer}.RecommentSearch_action_listAgency .list .item:hover{background-color:#eee}</style>
                            </div>
                        </form>
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
                <div>Tổng số <strong>()</strong> yêu cầu</div>
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
                                <td>Người đăng ký</td>
                                <td>Tên công ty</td>
                                <td>Số điện thoại</td>
                                <td>Email</td>
                                <td>
                                    <a class="<?php {{ echo $orderBy; }} ?>" href="<?php
                                    {{ $__orderBy__ = $orderBy == "desc" ? "asc" : "desc"; }}
                                    {{ echo "SupportCustomer/index/{$__orderBy__}/{$status}/{$page}"; }} ?>"><span>Ngày đăng ký</span>
                                    </a>
                                </td>
                                <td>Ngày xử lý</td>
                                <td>Trạng thái</td>
                                <td>Chi tiết</td>
                                <td>Xóa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( !empty($listAgency) ) : ?>
                                <?php $orderRow = 1; foreach($listAgency as $agency) : ?>
                                    <tr data-id="<?php {{ echo $agency['agency_id']; }} ?>">
                                        <td>
                                            <input class="checkItem" type="checkbox" name="<?php {{ echo $agency['agency_id']; }} ?>">
                                        </td>
                                        <td><?php {{ echo $orderRow ++; }} ?></td>
                                        <td><?php {{ echo $agency['agency_fullname']; }} ?></td>
                                        <td><?php {{ echo $agency['agency_company']; }} ?></td>
                                        <td>
                                            <a href="tel:<?php {{ echo $agency['agency_phone']; }} ?>">
                                                <span><?php {{ echo $agency['agency_phone']; }} ?></span>
                                                <span style="border: 1px solid #eee; padding: 2px 5px; background-color: #00BCD4; color: #fff; border-radius: 5px;">
                                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                                    Gọi
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="mailTo:<?php {{ echo $agency['agency_email']; }} ?>">
                                                <span class="d_block" style="margin-bottom: 5px;"><?php {{ echo $agency['agency_email']; }} ?></span>
                                                <span style="border: 1px solid #eee; padding: 2px 5px; background-color: #00BCD4; color: #fff; border-radius: 5px;">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    Mở mail
                                                </span>
                                            </a>
                                        </td>
                                        <td><?php {{ echo Format::formatTime($agency['agency_createDate']); }} ?></td>
                                        <td></td>
                                        <td><?php {{ echo $agency['agency_status'] == "no_process" ? "chưa xử lý" : "Đã xử lý"; }} ?></td>
                                        <td class="update">
                                            <a target="_blank" href="Agency/detail/<?php {{ echo $agency['agency_id']; }} ?>">
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
                            <?php else : ?>
                                <tr>
                                    <td colspan="10">Chưa có đơn vị nào đăng ký đại lý !</td>
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
        if($totalPage > 1) { echo Pagination::getPagination("Agency/index/{$orderBy}/{$status}/", $totalPage, $page); }
    }} ?></div>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/agency.ajax.js"); }} ?>"></script>
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