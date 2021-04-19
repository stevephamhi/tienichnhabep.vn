<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Khách hàng</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Danh sách khách hàng</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_primary" href="Customer/add">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Thêm mới</span>
                </a>
                <a class="btn_item btn_default" href="<?php {{ echo "Customer/index"; }} ?>">
                    <i class="fa fa-refresh" aria-hidden="true"></i>
                    <span>Làm mới</span>
                </a>
            </div>
        </div>
        <div class="container_fluid">
            <div class="action_wrap d_flex align_items_center">
                <div class="page_action_item filter grid_column_6">
                    <div class="value d_flex align_items_center justify_content_center">
                        <a class="item <?php {{ echo $status == 'all' ? 'active' : null; }} ?>" href="<?php {{ echo "Customer/index/{$orderBy}/all/{$page}"; }} ?>">Tất cả</a>
                        <a class="item <?php {{ echo $status == 'active'  ? 'active' : null; }} ?>" href="<?php {{ echo "Customer/index/{$orderBy}/active/{$page}/"; }} {{ echo !empty($fieldName) ? $fieldName . "/" : ""; }} {{ echo !empty($strSearch) ? $strSearch . "/" : ""; }} ?>">Hoạt động</a>
                        <a class="item <?php {{ echo $status == 'pending' ? 'active' : null; }} ?>" href="<?php {{ echo "Customer/index/{$orderBy}/pending/{$page}/"; }} {{ echo !empty($fieldName) ? $fieldName . "/" : ""; }} {{ echo !empty($strSearch) ? $strSearch . "/" : ""; }} ?>">Chờ duyệt</a>
                        <a class="item <?php {{ echo $status == 'disable' ? 'active' : null; }} ?>" href="<?php {{ echo "Customer/index/{$orderBy}/disable/{$page}/"; }} {{ echo !empty($fieldName) ? $fieldName . "/" : ""; }} {{ echo !empty($strSearch) ? $strSearch . "/" : ""; }} ?>">Vô hiệu</a>
                    </div>
                </div>
                <div class="page_action_item search grid_column_6">
                    <div class="value d_flex align_items_center w_100 position_relative">
                        <form action="" class="search_module w_100">
                            <div class="form_group position_relative">
                                <select class="form_control position_absolute" style="width: 15%;" name="searchType" id="searchType">
                                    <option <?php {{ echo $fieldName == 'customer_fullname' ? 'selected' : ''; }} ?> value="customer_fullname">Tên</option>
                                    <option <?php {{ echo $fieldName == 'customer_email' ? 'selected' : ''; }} ?> value="customer_email">Email</option>
                                    <option <?php {{ echo $fieldName == 'customer_phone' ? 'selected' : ''; }} ?> value="customer_phone">Phone</option>
                                </select>
                                <input type="text" name="searchStr" style="padding-left: 120px;" class="form_control" value="<?php {{ echo $strSearch; }} ?>" placeholder="Có vẻ như chức năng search không hoạt động" autocomplete="off" spellcheck="false">
                                <button type="submit" name="searchBtn" class="form_button position_absolute">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Tìm kiếm</span>
                                </button>
                                <div class="RecommentSearch_action_listCustomer position_absolute" style="display: none;">
                                    <div class="title">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <span>Danh sách tên khách hàng</span>
                                    </div>
                                    <ul class="list"></ul>
                                </div>
                                <style>.RecommentSearch_action_listCustomer{background-color:#fff;top:100%;right:0;width:80%;z-index:10;box-shadow:0 0 12px rgba(0,0,0,.12);display:none}.RecommentSearch_action_listCustomer .title{padding:7px 10px;background-color:#eee;margin-bottom:5px}.RecommentSearch_action_listCustomer .list{height:300px;overflow:auto}.RecommentSearch_action_listCustomer .list .item{padding:5px 10px;cursor:pointer}.RecommentSearch_action_listCustomer .list .item:hover{background-color:#eee}</style>
                            </div>
                        </form>
                    </div>
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
                                <td>STT</td>
                                <td>Tên khách hàng</td>
                                <td>Email</td>
                                <td>SĐT</td>
                                <td>Sinh nhật</td>
                                <td>
                                    <a class="asc" href="Customer/index/<?php {{ echo $orderBy == 'asc' ? 'desc/' : 'asc/'; }} {{ echo !empty($status) ? $status . "/" : ""; }} {{ echo !empty($page) ? $page . "/" : ""; }} {{ echo !empty($fieldName) ? $fieldName . "/" : ""; }} {{ echo !empty($strSearch) ? $strSearch . "/" : ""; }} ?>">
                                        <span>Ngày tạo</span>
                                    </a>
                                </td>
                                <td>Trạng thái</td>
                                <td>Cập nhật</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( !empty( $listCustomer ) ) : ?>
                                <?php $orderRow = 0; foreach( $listCustomer as $customerItem ) : ?>
                                    <tr data-id="<?php {{ echo $customerItem['customer_id']; }}; ?>">
                                        <td><?php {{ echo $orderRow ++; }} ?></td>
                                        <td><?php {{ echo $customerItem['customer_fullname']; }} ?></td>
                                        <td class="info">
                                            <a href="mailTo:<?php {{ echo $customerItem['customer_email']; }} ?>" target="_blank" class="text_center"><?php {{ echo $customerItem['customer_email']; }} ?></a>
                                        </td>
                                        <td class="info">
                                            <a href="tel:<?php {{ echo $customerItem['customer_phone']; }} ?>" class="text_center"><?php {{ echo $customerItem['customer_phone']; }} ?></a>
                                        </td>
                                        <td><?php {{ echo Format::formatTime($customerItem['customer_birthday']); }} ?></td>
                                        <td><?php {{ echo Format::formatFullTime($customerItem['customer_createDate']); }} ?></td>
                                        <td><?php {{ echo Format::formatStatusCustomer( $customerItem['customer_status'] ); }} ?></td>
                                        <td class="update">
                                            <a href="<?php {{ echo "Customer/update/{$customerItem['customer_id']}/{$customerItem['customer_phone']}"; }} ?>">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="10">Chưa có khách hàng nào !</td>
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
        if($totalPage > 1) { echo Pagination::getPagination("Customer/index/{$orderBy}/{$status}/", $totalPage, $page); }
    }} ?></div>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/listCustomer.ajax.js"); }} ?>"></script>