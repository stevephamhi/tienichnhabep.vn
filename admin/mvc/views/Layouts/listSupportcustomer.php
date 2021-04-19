<main class="main_content">
    <div class="page_header">
        <div class="container_fluid d_flex justify_content_between align_items_center">
            <div class="d_flex align_items_end">
                <h1>Hỗ trợ khách hàng</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="?">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="javascript:;">Danh sách yêu cầu hỗ trợ</a>
                    </li>
                </ol>
            </div>
            <div class="d_flex align_items_center">
                <a class="btn_item btn_default" href="<?php {{ echo "SupportCustomer/index/{$orderBy}/{$status}/{$page}"; }} ?>">
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
                        <a class="item <?php {{ echo $status == 'all'        ? 'active' : null; }} ?>" href="<?php {{ echo "SupportCustomer/index/{$orderBy}/all/{$page}"; }} ?>">Tất cả</a>
                        <a class="item <?php {{ echo $status == 'processed'  ? 'active' : null; }} ?>" href="<?php {{ echo "SupportCustomer/index/{$orderBy}/processed/{$page}"; }} ?>">Đã xử lý</a>
                        <a class="item <?php {{ echo $status == 'no_process' ? 'active' : null; }} ?>" href="<?php {{ echo "SupportCustomer/index/{$orderBy}/no_process/{$page}"; }} ?>">Chưa xử lý</a>
                    </div>
                </div>
                <div class="page_action_item search grid_column_6">
                    <div class="value d_flex align_items_center w_100 position_relative">
                        <form action="" class="search_module w_100">
                            <div class="form_group position_relative">
                                <select class="form_control position_absolute" name="searchType" id="searchType">
                                    <option value="sp_customer_fullname">Tên khách hàng</option>
                                    <option value="sp_customer_phone">Số điện thoại</option>
                                </select>
                                <input type="text" name="searchStr" style="padding-left: 150px;" class="form_control" value="" placeholder="Nhập tên khách hàng" autocomplete="off" spellcheck="false">
                                <button type="submit" name="searchBtn" class="form_button position_absolute">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Tìm kiếm</span>
                                </button>
                                <div class="RecommentSearch_action_listAgency position_absolute" style="display: none;">
                                    <div class="title">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <span>Danh sách tên khách hàng</span>
                                    </div>
                                    <ul class="list"><li class="item">Báº¿p Ä‘iá»‡n tá»« Ä‘Ã´i Capri CR-826KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-828KT</li> <li class="item">Báº¿p há»“ng ngoáº¡i Ä‘Ã´i Capri CR-827KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-829KT</li> <li class="item">Báº¿p tá»« Ä‘a Ä‘iá»ƒm 3 vÃ¹ng náº¥u Capri CR-831KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i 3 vÃ¹ng náº¥u Capri CR-832KT</li> <li class="item">Báº¿p tá»« 3 vÃ¹ng náº¥u Capri CR-833KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘a Ä‘iá»ƒm 3 vÃ¹ng náº¥u Capri CR-836KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i 3 vÃ¹ng náº¥u Capri CR-837KT</li> <li class="item">Báº¿p tá»« 3 vÃ¹ng náº¥u Capri CR-838KT</li> <li class="item">Báº¿p tá»« Ä‘a Ä‘iá»ƒm 3 vÃ¹ng náº¥u Capri CR-839KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i 3 vÃ¹ng náº¥u Grasso GS-306R</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-801KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-802KT</li> <li class="item">Báº¿p há»“ng ngoáº¡i Ä‘Ã´i Capri CR-803KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-804KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-804HI</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-808KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i 3 vÃ¹ng náº¥u Capri CR-810KT</li> <li class="item">Báº¿p há»“ng ngoáº¡i Ä‘Ã´i Capri CR-805KT</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-806KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-807KT</li> <li class="item">Báº¿p há»“ng ngoáº¡i Ä‘Ã´i Capri CR-809KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-800HI</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-800I</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-801KI</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-901 Plus</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-902KT</li> <li class="item">Báº¿p tá»« Ä‘Æ¡n Capri CR-108KT</li> <li class="item">Báº¿p há»“ng ngoáº¡i Ä‘Æ¡n Capri CR-108KT</li> <li class="item">Báº¿p Domino 2 há»“ng ngoáº¡i Capri CR-168KT</li> <li class="item">Báº¿p Domino 2 tá»« Capri CR-168I</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i 3 vÃ¹ng náº¥u Capri CR-810KT (Cháº¥m bi)</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-812KT</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-668HI</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-626I</li> <li class="item">Báº¿p tá»« - há»“ng ngoáº¡i Ä‘Ã´i Capri CR-707HI</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-669I</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-666I</li> <li class="item">Báº¿p tá»« Ä‘Ã´i Capri CR-737I</li> <li class="item">Báº¿p há»“ng ngoáº¡i Ä‘Ã´i Capri CR-800H</li> <li class="item">Báº¿p gas Ã¢m kÃ&shy;nh 2 lÃ² Capri CR-217KT</li> <li class="item">Báº¿p gas Ã¢m kÃ&shy;nh 2 lÃ² Capri CR-272KT</li> <li class="item">Báº¿p gas Ã¢m kÃ&shy;nh 2 lÃ² Capri CR-27KT</li> <li class="item">Báº¿p gas Ã¢m kÃ&shy;nh 2 lÃ² Capri CR-208KT (Black)</li> <li class="item">Báº¿p gas Ã¢m kÃ&shy;nh 2 lÃ² Capri CR-208KT (Red)</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-607H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-626H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-629H</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ä‘á»™c láº&shy;p Capri CR-999H</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-601B</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-701B</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ã¢m tá»§ Capri CR-602HP</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ã¢m tá»§ Capri CR-602H</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ã¢m tá»§ Capri CR-702H</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ã¢m tá»§ Capri CR-702G</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ã¢m tá»§ Capri CR-602G</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-60P</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-60S</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-70S</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-60B</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-70B</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-170B</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-170I</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-290I</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-290B</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-270B</li> <li class="item">MÃ¡y hÃºt mÃ¹i cá»• Ä‘iá»ƒn Capri CR-270I</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-608H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-636H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-637H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-638H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-639H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-888H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-678H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-600H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-901H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-788H</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-988H</li> <li class="item">MÃ¡y hÃºt mÃ¹i cáº£m á»©ng váº«y tay Capri CR-788S (7T)</li> <li class="item">MÃ¡y hÃºt mÃ¹i cáº£m á»©ng váº«y tay Capri CR-788S (9T)</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-8930</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i Capri CR-8931</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i H82.9W</li> <li class="item">MÃ¡y hÃºt mÃ¹i hiá»‡n Ä‘áº¡i H81.9SB</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ä‘á»™c láº&shy;p Capri CR-91.9S</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ä‘á»™c láº&shy;p Capri CR-ISO90 A</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ä‘á»™c láº&shy;p Capri CR-608E</li> <li class="item">MÃ¡y hÃºt mÃ¹i Ä‘á»™c láº&shy;p Capri CR-408E</li></ul>
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
                <div>Tổng số <strong>(<?php {{ echo $totalSupportcustomer; }} ?>)</strong> yêu cầu</div>
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
                                <td>Tên khách hàng</td>
                                <td>Danh xưng</td>
                                <td>Số điện thoại</td>
                                <td>
                                    <a class="<?php {{ echo $orderBy; }} ?>" href="<?php
                                    {{ $__orderBy__ = $orderBy == "desc" ? "asc" : "desc"; }}
                                    {{ echo "SupportCustomer/index/{$__orderBy__}/{$status}/{$page}"; }} ?>"><span>Thời gian</span>
                                    </a>
                                </td>
                                <td>Ngày xử lý</td>
                                <td>Trạng thái</td>
                                <td>Chi tiết</td>
                                <td>Xóa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if( !empty( $listSupportCustomer ) ) : ?>
                                <?php $orderRow = 1; foreach( $listSupportCustomer as $supportCustomerItem ) : ?>
                                    <tr data-id="<?php {{ echo $supportCustomerItem['sp_customer_id']; }} ?>">
                                        <td>
                                            <input class="checkItem" type="checkbox" name="<?php {{ echo $supportCustomerItem['sp_customer_id']; }} ?>">
                                        </td>
                                        <td><?php {{ echo $orderRow ++; }} ?></td>
                                        <td><?php {{ echo $supportCustomerItem['sp_customer_fullname']; }} ?></td>
                                        <td><?php {{ echo $supportCustomerItem['sp_customer_gender'] == "male" ? "Anh" : "Chị"; }} ?></td>
                                        <td>
                                            <a href="tel:<?php {{ echo $supportCustomerItem['sp_customer_phone']; }} ?>">
                                                <span><?php {{ echo $supportCustomerItem['sp_customer_phone']; }} ?></span>
                                                <span style="border: 1px solid #eee; padding: 2px 5px; background-color: #00BCD4; color: #fff; border-radius: 5px;">
                                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                                    Gọi
                                                </span>
                                            </a>
                                        </td>
                                        <td><?php {{ echo Format::formatFullTime( $supportCustomerItem['sp_customer_time'] ); }} ?></td>
                                        <td><?php {{ echo Format::formatFullTime( $supportCustomerItem['sp_customer_time_processed'] ); }} ?></td>
                                        <td><?php {{ echo $supportCustomerItem['sp_customer_status'] == "no_process" ? "chưa xử lý" : "Đã xử lý"; }} ?></td>
                                        <td class="update">
                                            <a href="SupportCustomer/detail/<?php {{ echo $supportCustomerItem['sp_customer_id']; }} ?>/<?php {{ echo "khach-hang-" . Format::create_slug($supportCustomerItem['sp_customer_fullname']); }} ?>.html">
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
                                <tr>
                                    <td colspan="10">Chưa có yêu cầu hỗ trợ nào !</td>
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
        if($totalPage > 1) { echo Pagination::getPagination("SupportCustomer/index/{$orderBy}/{$status}/", $totalPage, $page); }
    }} ?></div>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/supportcustomer.ajax.js"); }} ?>"></script>
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