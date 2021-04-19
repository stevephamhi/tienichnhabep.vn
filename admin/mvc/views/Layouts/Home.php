<main class="main_content">
    <div class="page_header">
        <div class="container_fluid">
            <div class="d_flex align_items_end">
                <h1>Bảng Điều Khiển</h1>
                <ol class="breadcrumb d_flex align_items_center">
                    <li>
                        <a href="">Trang chủ</a>
                    </li>
                    <li class="active">
                        <a href="">Bảng Điều khiển</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="page_content container_fluid">
        <div class="page_row_item grid_row">
            <div class="box_content_item grid_column_3">
                <div class="box_wrap">
                    <div class="heading d_flex justify_content_between align_items_center">
                        <span class="title">TỔNG SỐ ĐƠN HÀNG</span>
                        <span class="value">0%</span>
                    </div>
                    <div class="body d_flex justify_content_between align_items_center">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="value"><?php {{ echo !empty($dataNotifiHome['totalOrder']) ? $dataNotifiHome['totalOrder'] : 0; }} ?></span>
                    </div>
                    <div class="footer">
                        <a href="Order" target="_blank">Xem thêm...</a>
                    </div>
                </div>
            </div>
            <div class="box_content_item grid_column_3">
                <div class="box_wrap">
                    <div class="heading d_flex justify_content_between align_items_center">
                        <span class="title">DOANH SỐ</span>
                        <span class="value">0%</span>
                    </div>
                    <div class="body d_flex justify_content_center align_items_center">
                        <span class="value"><?php {{ echo !empty($dataNotifiHome['totalSales']) ? Format::formatCurrency($dataNotifiHome['totalSales']) : 0; }} ?></span>
                    </div>
                    <div class="footer">
                        <a href="Order" target="_blank">Xem thêm...</a>
                    </div>
                </div>
            </div>
            <div class="box_content_item grid_column_3">
                <div class="box_wrap">
                    <div class="heading d_flex justify_content_between align_items_center">
                        <span class="title">TỔNG SỐ KHÁCH HÀNG</span>
                        <span class="value">0%</span>
                    </div>
                    <div class="body d_flex justify_content_between align_items_center">
                        <i class="fa fa-user"></i>
                        <span class="value"><?php {{ echo !empty($dataNotifiHome['totalCustomer']) ? $dataNotifiHome['totalCustomer'] : 0; }} ?></span>
                    </div>
                    <div class="footer">
                        <a href="Customer" target="_blank">Xem thêm...</a>
                    </div>
                </div>
            </div>
            <div class="box_content_item grid_column_3">
                <div class="box_wrap">
                    <div class="heading d_flex justify_content_between align_items_center">
                        <span class="title">KHÁCH ĐANG TRUY CẬP</span>
                        <span class="value">0%</span>
                    </div>
                    <div class="body d_flex justify_content_between align_items_center">
                        <i class="fa fa-users"></i>
                        <span class="value" style="font-size: .8rem;">Đang cập nhật ...</span>
                    </div>
                    <div class="footer">
                        <a href="">Xem thêm...</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel_row_item grid_row">
            <div class="panel_content_item grid_column_6">
                <div class="panel_box">
                    <div class="panel_heading">
                        <h3 class="panel_title">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                            <span class="title">Hỗ trợ trực tuyến</span>
                        </h3>
                    </div>
                    <?php if( !empty($listSupportNo_process) ) : ?>
                        <div class="panel_body">
                            <?php foreach( $listSupportNo_process as $supportNo_processItem ) : ?>
                                <?php {{
                                    $imgSrc = $supportNo_processItem['sp_customer_gender'] == "male" ? "./public/images/logo/man-icon.png" : "./public/images/logo/wonman-icon.png";
                                }} ?>
                                <div class="media d_flex">
                                    <a target="_blank" class="media_left" href="<?php echo "SupportCustomer/detail/{$supportNo_processItem['sp_customer_id']}/khach-hang-". Format::create_slug($supportNo_processItem['sp_customer_fullname']) .".html"; ?>">
                                        <img src="<?php {{ echo $imgSrc; }} ?>" width="70" alt="Ảnh khách hàng yêu cầu tư hỗ trợ">
                                    </a>
                                    <div class="media_right">
                                        <h5 class="media_heading">
                                            <strong>Tư vấn online</strong>
                                            <span>- Hỗ trợ tại Đà Nẵng</span>
                                        </h5>
                                        <p class="media_content">
                                            <strong class="label">Họ tên:</strong>
                                            <span>
                                                <?php {{ echo $supportNo_processItem['sp_customer_gender'] == "male" ? "Anh " : "Chị "; }} ?>
                                                <?php {{ echo $supportNo_processItem['sp_customer_fullname']; }} ?>
                                            </span>
                                        </p>
                                        <p class="media_content">
                                            <strong class="label">Thời gian:</strong>
                                            <span><?php {{ echo Format::formatFullTime($supportNo_processItem['sp_customer_time']); }} ?></span>
                                        </p>
                                        <p class="media_content">
                                            <span class="label">Điện thoại:</span>
                                            <a href="tel:<?php {{ echo $supportNo_processItem['sp_customer_phone']; }} ?>" class="d_inline"><?php {{ echo $supportNo_processItem['sp_customer_phone']; }} ?></a>
                                        </p>
                                        <p class="media_content">
                                            <a target="_blank" href="<?php echo "SupportCustomer/detail/{$supportNo_processItem['sp_customer_id']}/khach-hang-". Format::create_slug($supportNo_processItem['sp_customer_fullname']) .".html"; ?>" class="d_inline">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                Chi tiết
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="panel_content_item grid_column_6">
                <div class="panel_box">
                    <div class="panel_heading">
                        <h3 class="panel_title">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            <span class="title">Đăng ký đại lý</span>
                        </h3>
                    </div>
                    <div class="panel_body">
                        <?php if( !empty($listAgencyNo_process) ) : ?>
                            <?php foreach($listAgencyNo_process as $agencyItem) : ?>
                                <div class="media d_flex">
                                    <a target="_blank" class="media_left" href="<?php {{ echo "Agency/detail/{$agencyItem['agency_id']}"; }} ?>">
                                        <img src="<?php {{ echo "public/images/logo/tien-phat-plus.png"; }} ?>" width="70" alt="Đơn vị đăng ký trở thành đại lý">
                                    </a>
                                    <div class="media_right">
                                        <h5 class="media_heading">
                                            <strong>CÔNG TY</strong>
                                            <span>- <?php {{ echo $agencyItem['agency_company']; }} ?></span>
                                        </h5>
                                        <p class="media_content">
                                            <strong class="label">Người đăng ký:</strong>
                                            <span>- <?php {{ echo $agencyItem['agency_fullname']; }} ?></span>
                                        </p>
                                        <p class="media_content">
                                            <strong class="label">Thời gian:</strong>
                                            <span>- <?php {{ echo Format::formatFullTime($agencyItem['agency_createDate']); }} ?></span>
                                        </p>
                                        <p class="media_content">
                                            <span class="label">Điện thoại:</span>
                                            <a href="tel:<?php {{ echo $agencyItem['agency_phone']; }} ?>" class="d_inline">- <?php {{ echo $agencyItem['agency_phone']; }} ?></a>
                                        </p>
                                        <p class="media_content">
                                            <span class="label">Email:</span>
                                            <a href="mailTo:<?php {{ echo $agencyItem['agency_email']; }} ?>" class="d_inline">- <?php {{ echo $agencyItem['agency_email']; }} ?></a>
                                        </p>
                                        <p class="media_content">
                                            <a target="_blank" href="<?php {{ echo "Agency/detail/{$agencyItem['agency_id']}"; }} ?>" class="d_inline">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                Chi tiết
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="panel_content_item grid_column_4">
                <div class="panel_box">
                    <div class="panel_heading">
                        <h3 class="panel_title">
                            <i class="fa fa-bar-chart-o"></i>
                            <span class="title">Thống kê Bán hàng</span>
                        </h3>
                    </div>
                    <div class="panel_body"></div>
                </div>
            </div>
            <div class="panel_content_item grid_column_8">
                <div class="panel_box">
                    <div class="panel_heading">
                        <h3 class="panel_title">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="title">Đơn hàng mới nhất</span>
                        </h3>
                    </div>
                    <div class="table_wrap" style="height: 500px; overflow: auto;">
                        <?php if( !empty( $listOrder ) ) : ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Mã đơn hàng</td>
                                        <td>Tên khách hàng</td>
                                        <td>Trạng thái</td>
                                        <td>Thời gian đặt hàng</td>
                                        <td>Thành tiền</td>
                                        <td>Chi tiết</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach( $listOrder as $orderItem ) : ?>
                                        <tr>
                                            <td><?php {{ echo $orderItem['order_code']; }} ?></td>
                                            <td class="text_left">
                                                <a style="color: #2196F3; padding: 2px 0;" href="<?php {{ echo "Customer/detail/{$orderItem['order_customerId_ties']}/{$orderItem['order_customer_phone']}"; }} ?>"><?php {{ echo $orderItem['order_customer_fullname']; }} ?></a>
                                                <a style="color: #2196F3; padding: 2px 0;" href="tel:<?php {{ echo $orderItem['order_customer_phone']; }} ?>"><?php {{ echo ""; }} ?><?php {{ echo $orderItem['order_customer_phone']; }} ?></a>
                                                <a style="color: #2196F3; padding: 2px 0;" href="mailTo:<?php {{ echo $orderItem['order_customer_email']; }} ?>"><?php {{ echo ""; }} ?><?php {{ echo $orderItem['order_customer_email']; }} ?></a>
                                            </td>
                                            <td><?php {{ echo Format::formatStatusOrder($orderItem['order_status']); }} ?></td>
                                            <td><?php {{ echo Format::formatFullTime($orderItem['order_createDate']); }} ?></td>
                                            <td><?php {{ echo Format::formatCurrency($orderItem['order_totalPrice']); }} ?></td>
                                            <td>
                                                <a target="_blank" href="<?php {{ echo "Order/detail/{$orderItem['order_id']}/{$orderItem['order_code']}"; }} ?>" class="fa fa-eye view"></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p style="text-align: center; padding: 10px 0;">Chưa có đơn hàng nào !</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>