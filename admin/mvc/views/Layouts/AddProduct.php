<?php {{ $base = new Base; }} ?>
<style>
    .list_recomment {
        display: none;
        top: 0;
        left: 0;
        width: 100%;
        height: 200px;
        overflow: auto;
        background-color: #fff;
        box-shadow: 0 0 12px rgba(0,0,0,0.12);
    }
    .list_recomment .list {
        position: relative;
        z-index: 2;
    }
    .list_recomment .item {
        font-family: "tienichnhabep-mainFont-Light";
        font-size: .9rem;
        padding: 4px 7px;
        cursor: pointer;
    }
    .list_recomment .item:hover {
        background-color: #eeeeee;
    }
</style>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Sản phẩm</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="<?php {{ echo $base->getBaseURLClient(); }} ?>">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thêm sản phẩm</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="addProd_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Product/add">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <span>Làm mới</span>
                    </a>
                    <a class="btn_item btn_default" href="Product">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{ if(!empty($statusActionProd)) { ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionProd['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionProd['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionProd['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php } }} ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm sản phẩm</span>
                    </h2>
                </div>
                <div class="panel_body">
                    <form action="" method="POST">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="tab_item active" href="#tab_general">Tổng quan</a>
                                <a class="tab_item" href="#tab_data">Dữ liệu</a>
                                <a class="tab_item" href="#tab_links">Liên kết</a>
                                <a class="tab_item" href="#tab_images">Hình ảnh</a>
                                <a class="tab_item" href="#tab_attribute">Thuộc tính</a>
                                <a class="tab_item" href="#tab_flash_sale">Flash sale</a>
                                <a class="tab_item" href="#tab_special">Khuyến mãi</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle on">
                                                <input type="checkbox" name="prod_status" id="status_value" class="d_none" <?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_status") == "on" ? "checked" : null;
                                                    /* --------------------------------------------------- */
                                                }} ?>>
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_name" class="form_label"><span style="color: #f00;">*</span> Tên sản phẩm</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="prod_name" id="prod_name" placeholder="Tên sản phẩm" autocomplete="off" spellcheck="false" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_name");
                                                    /* --------------------------------------------------- */
                                                }} ?>">
                                                <?php {{ echo Validation::formError("prod_name"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_desc" class="form_label">Mô tả ngắn</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="prod_desc" id="prod_desc" placeholder="Mô tả ngắn" spellcheck="false"><?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_desc");
                                                    /* --------------------------------------------------- */
                                                }} ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_content" class="form_label">Mô tả chi tiết</label>
                                            <div class="form_input">
                                                <textarea class="form_control ckeditor" name="prod_content" id="prod_content" placeholder="Mô tả chi tiết" spellcheck="false"><?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_content");
                                                    /* --------------------------------------------------- */
                                                }} ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_metaTitle" class="form_label"><span style="color: #f00;">*</span> Thẻ tiêu đề (Meta title)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="prod_metaTitle" id="prod_metaTitle" placeholder="Thẻ tiêu đề (Meta title)" autocomplete="off" spellcheck="false" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_metaTitle");
                                                    /* --------------------------------------------------- */
                                                }} ?>">
                                                <?php {{ echo Validation::formError("prod_metaTitle"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_metaDesc" class="form_label"><span style="color: #f00;">*</span> Thẻ mô tả (Meta desc)</label>
                                            <div class="form_input">
                                                <textarea class="form_control" name="prod_metaDesc" id="prod_metaDesc" placeholder="Thẻ mô tả (Meta desc)" spellcheck="false"><?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_metaDesc");
                                                    /* --------------------------------------------------- */
                                                }} ?></textarea>
                                                <?php {{ echo Validation::formError("prod_metaDesc"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="prod_keywords" class="form_label">Từ khóa (tags)</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="prod_keywords" id="prod_keywords" placeholder="Thẻ mô tả (Meta desc)" autocomplete="off" spellcheck="false" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_keywords");
                                                    /* --------------------------------------------------- */
                                                }} ?>">
                                                <?php {{ echo Validation::formError("prod_keywords"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="search_gg_info" class="form_label">Xem trước kết quả tìm kiếm</label>
                                            <div class="form_input">
                                                <div class="google_title"><?php {{ echo Validation::setValue("prod_metaTitle"); }} ?></div>
                                                <div class="google_url">
                                                    <span class="default"><?php {{ echo $base->getBaseURLClient(); }} ?>/</span>
                                                    <span class="url"><?php {{ echo Validation::setValue("prod_seoUrl"); }} ?></span>
                                                </div>
                                                <div class="google_desc"><?php {{ echo Validation::setValue("prod_metaDesc"); }} ?></div>
                                            </div>
                                        </div>
                                        <div class="form_group cateProd_seo_url d_flex align_items_center">
                                            <label for="prod_seoUrl" class="form_label"><span style="color: #f00;">*</span> Đường dẫn SEO</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" id="prod_seoUrl" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_seoUrl");
                                                    /* --------------------------------------------------- */
                                                }} ?>" placeholder="Đường dẫn SEO" autocomplete="off" spellcheck="false">
                                                <input type="hidden" name="prod_seoUrl" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_seoUrl");
                                                    /* --------------------------------------------------- */
                                                }} ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_data">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_avatar" class="form_label"><span style="color: #f00;">*</span>Ảnh avatar</label>
                                        <div class="form_input">
                                            <label for="prod_avatar">
                                                <input type="hidden" name="prod_avatar" id="prod_avatar" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo !empty(Validation::setValue("prod_avatar")) ? Validation::setValue("prod_avatar") : null;
                                                    /* --------------------------------------------------- */
                                                }} ?>">
                                                <span>400px x 350px</span>
                                                <span class="thumbNail small" style="width: 400px; height: 350px;">
                                                    <img data-src-id="prod_avatar" class="img_cover full_size" alt="" src="<?php {{
                                                        echo !empty(Validation::setValue("prod_avatar")) ? Validation::setValue("prod_avatar") : "./public/images/logo/no_image-50x50.png";
                                                    }} ?>">
                                                </span>
                                            </label>
                                            <?php {{ echo Validation::formError("prod_avatar"); }} ?>
                                            <div class="popover" style="transform: translate(0)">
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6.5px 10px 6.5px 12px; margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=prod_avatar" type="button" data-id-input-image="prod_avatar" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh sản phẩm">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="prod_avatar" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_banner" class="form_label"><span style="color: #f00;" title='Chỉ xuất hiện khi sản phẩm là nổi bậc khi hiển thị ở trang chủ'>*</span>Banner highlight</label>
                                        <div class="form_input">
                                            <label for="prod_banner">
                                                <input type="hidden" name="prod_banner" id="prod_banner" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo !empty(Validation::setValue("prod_banner")) ? Validation::setValue("prod_banner") : null;
                                                    /* --------------------------------------------------- */
                                                }} ?>">
                                                <span>500px x 200px</span>
                                                <span class="thumbNail small" style="width: 500px; height: 200px;">
                                                    <img data-src-id="prod_banner" class="img_cover full_size" alt="" src="<?php {{
                                                        echo !empty(Validation::setValue("prod_banner")) ? Validation::setValue("prod_banner") : "./public/images/logo/no_image-50x50.png";
                                                    }} ?>">
                                                </span>
                                            </label>
                                            <div class="popover" style="transform: translate(0)">
                                                <i style='margin-top: 3px; font-size: .8rem;'>Chỉ xuất hiện khi sản phẩm là nổi bậc khi hiển thị ở trang chủ</i>
                                                <div class="popover_content d_flex align_items_center">
                                                    <a style="padding: 6.5px 10px 6.5px 12px; margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=prod_banner" type="button" data-id-input-image="prod_banner" class="button_image btn btn_primary iframe-btn" title="Thêm banner sản phẩm">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <button type="button" data-id-clear-img="prod_banner" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="video_intro_box form_group d_flex align_items_center">
                                        <label for="prod_video" class="form_label">Video</label>
                                        <div class="form_input">
                                            <div class="position_relative">
                                                <input class="form_control valueLoadIframe" type="text" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_video");
                                                    /* --------------------------------------------------- */
                                                }} ?>" id="prod_video" placeholder="Copy iframe video từ youtube" spellcheck="false">
                                                <input type="hidden" name="prod_video" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_video");
                                                    /* --------------------------------------------------- */
                                                }} ?>">
                                                <button type="button" class="GetURL_iframe position_absolute">
                                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                                </button>
                                                <style>.GetURL_iframe{top:0;right:0;height:100%;font-size:1.1rem;padding:0 20px;cursor:pointer;border:1px solid #b3b3b3;border-top-right-radius:3px;border-bottom-right-radius:3px}</style>
                                            </div>
                                            <div class="iframe_box">
                                                <?php if(!empty(Validation::setValue("prod_video"))) : ?>
                                                    <iframe src="<?php {{ echo Validation::setValue("prod_video"); }} ?>" frameborder="0"></iframe>
                                                <?php endif; ?>
                                            </div>
                                            <style> .iframe_box {width: 100%;} iframe { width: 100%!important; height: 400px!important; } </style>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_currentPrice" class="form_label"><span style="color: #f00;">*</span> Giá mới</label>
                                        <div class="form_input">
                                            <input class="form_control price_input" data-price-name="prod_currentPrice" type="text" id="prod_currentPrice" placeholder="Giá bán" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_currentPrice");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                            <input type="hidden" name="prod_currentPrice" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_currentPrice");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                            <?php {{ echo Validation::formError("prod_currentPrice"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_oldPrice" class="form_label">Giá catalogue</label>
                                        <div class="form_input">
                                            <input class="form_control price_input" data-price-name="prod_oldPrice" type="text" id="prod_oldPrice" placeholder="Giá cũ" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_oldPrice");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                            <input type="hidden" name="prod_oldPrice" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_oldPrice");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_model" class="form_label">Mã sản phẩm [ Model ]</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="prod_model" id="prod_model" placeholder="Mã sản phẩm [ Model ]" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_model");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_amount" class="form_label"><span style="color: #f00;">*</span> Số lượng sản phẩm</label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="prod_amount" id="prod_amount" placeholder="Số lượng sản phẩm" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_amount");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                            <?php {{ echo Validation::formError("prod_amount"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_minimun_amount" class="form_label" title="Số lượng tối thiểu khách phải mua">
                                            <span><span style="color: #f00;">*</span> Số lượng tối thiểu</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="prod_minimun_amount" id="prod_minimun_amount" placeholder="Số lượng sản phẩm tối thiểu khách phải mua" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_minimun_amount");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                            <?php {{ echo Validation::formError("prod_minimun_amount"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_sku" class="form_label" title="Đơn vị lưu kho (Stock Keeping Unit)">
                                            <span>SKU</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="prod_sku" id="prod_sku" placeholder="Đơn vị lưu kho [ Stock Keeping Unit ]" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_sku");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_order" class="form_label">Số thứ thứ</label>
                                        <div class="form_input">
                                            <input class="form_control" type="number" name="prod_order" id="prod_order" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_order");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_stock_status" class="form_label" title="Hiểu thị trạng thái hết hàng">
                                            <span><span style="color: #f00;">*</span> Trạng thái kho hàng</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <select class="form_control" name="prod_stock_status" id="prod_stock_status">
                                                <option value="">--Chọn--</option>
                                                <option value="1" <?php {{ echo Validation::setValue("prod_stock_status") == "1" ? "selected" : null; }} ?>>Còn hàng</option>
                                                <option value="2" <?php {{ echo Validation::setValue("prod_stock_status") == "2" ? "selected" : null; }} ?>>Hết hàng</option>
                                                <option value="3" <?php {{ echo Validation::setValue("prod_stock_status") == "3" ? "selected" : null; }} ?>>Sản phẩm mới</option>
                                                <option value="4" <?php {{ echo Validation::setValue("prod_stock_status") == "4" ? "selected" : null; }} ?>>Tin đồn</option>
                                                <option value="5" <?php {{ echo Validation::setValue("prod_stock_status") == "5" ? "selected" : null; }} ?>>Sắp về</option>
                                                <option value="6" <?php {{ echo Validation::setValue("prod_stock_status") == "6" ? "selected" : null; }} ?>>Ngừng kinh doanh</option>
                                            </select>
                                            <?php {{ echo Validation::formError("prod_stock_status"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_deliveryPromo" class="form_label">Khuyến mãi giao hàng</label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" name="prod_deliveryPromo" id="prod_deliveryPromo" placeholder="Khuyến mãi giao hàng [Miễn phí vận chuyển]" autocomplete="off" spellcheck="false" value="<?php {{
                                                /* --------------------------------------------------- */
                                                echo Validation::setValue("prod_deliveryPromo");
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_for_agents" class="form_label"><span style="color: #f00;">*</span> Sản phẩm cho đại lý <span class="d_block" style="font-size: .7rem;">(Mặc định là: Không)</span></label>
                                        <div class="form_input">
                                            <label for="yes_for_agents">
                                                <input type="radio" <?php echo Validation::setValue("prod_for_agents") == "1" ? "checked" : null; ?> name="prod_for_agents[]" id="yes_for_agents" value="1">
                                                <span>Có</span>
                                            </label>
                                            <label for="no_for_agents">
                                                <input type="radio" <?php echo Validation::setValue("prod_for_agents") == "2" ? "checked" : null; ?> name="prod_for_agents[]" id="no_for_agents" value="2">
                                                <span>Không</span>
                                            </label>
                                            <?php {{ echo Validation::formError("prod_for_agents"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_installment" class="form_label"><span style="color: #f00;">*</span> Áp dụng trả góp <span class="d_block" style="font-size: .7rem;">(Mặc định là: Không)</span></label>
                                        <div class="form_input">
                                            <label for="yes_installment">
                                                <input type="radio" <?php echo Validation::setValue("prod_installment") == "1" ? "checked" : null; ?> name="prod_installment[]" id="yes_installment" value="1">
                                                <span>Có</span>
                                            </label>
                                            <label for="no_installment">
                                                <input type="radio" <?php echo Validation::setValue("prod_installment") == "2" ? "checked" : null; ?> name="prod_installment[]" id="no_installment" value="2">
                                                <span>Không</span>
                                            </label>
                                            <div class="form_installment_rate d_flex align_items_center" style="font-weight: bold;">
                                                <input type="text" class="form_control" value="<?php {{
                                                    /* --------------------------------------------------- */
                                                    echo Validation::setValue("prod_installment_rate");
                                                    /* --------------------------------------------------- */
                                                }} ?>" style="width: 80px; text-align: center;" placeholder="VD: 0" name="prod_installment_rate" id="">
                                                <span style="font-size: 1.3rem;  margin-left: 4px;">%</span>
                                            </div>
                                            <?php {{ echo Validation::formError("prod_installment"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_avt_tax" class="form_label"><span style="color: #f00;">*</span> Thuế giá trị gia tăng (VAT) <span class="d_block" style="font-size: .7rem;">(Mặc định là: Không)</span></label>
                                        <div class="form_input">
                                            <label for="yes_avt_tax">
                                                <input type="radio" <?php echo Validation::setValue("prod_avt_tax") == "1" ? "checked" : null; ?> name="prod_avt_tax[]" id="yes_avt_tax" value="1">
                                                <span>Có</span>
                                            </label>
                                            <label for="no_avt_tax">
                                                <input type="radio" <?php echo Validation::setValue("prod_avt_tax") == "2" ? "checked" : null; ?> name="prod_avt_tax[]" id="no_avt_tax" value="2">
                                                <span>Không</span>
                                            </label>
                                            <?php {{ echo Validation::formError("prod_avt_tax"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_liquidation" class="form_label"><span style="color: #f00;">*</span> Sản phẩm thanh lý <span class="d_block" style="font-size: .7rem;">(Mặc định là: Không)</span></label>
                                        <div class="form_input">
                                            <label for="yes_avt_tax">
                                                <input type="radio" <?php echo Validation::setValue("prod_liquidation") == "1" ? "checked" : null; ?> name="prod_liquidation[]" id="yes_avt_tax" value="1">
                                                <span>Có</span>
                                            </label>
                                            <label for="no_avt_tax">
                                                <input type="radio" <?php echo Validation::setValue("prod_liquidation") == "2" ? "checked" : null; ?> name="prod_liquidation[]" id="no_avt_tax" value="2">
                                                <span>Không</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_links">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_ties_brand_id" class="form_label" title="Nhấn để chọn hãng sản xuất">
                                            <span><span style="color: #f00;">*</span> Hãng sản xuất [ Thương hiệu ]</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" id="prod_ties_brand_id" value="<?php {{
                                                /* --------------------------------------------------- */
                                                if((!empty(Validation::setValue("prod_ties_brand_id"))) && (!empty($listBrand))) {
                                                    foreach($listBrand as $brandItem) {
                                                        echo $brandItem['brand_id'] == Validation::setValue("prod_ties_brand_id") ? $brandItem['brand_name'] : null;
                                                    }
                                                }
                                                /* --------------------------------------------------- */
                                            }} ?>" placeholder="Hãng sản xuất [ Thương hiệu ]" autocomplete="off" spellcheck="false">
                                            <input type="hidden" name="prod_ties_brand_id" value="<?php {{
                                                /* --------------------------------------------------- */
                                                if((!empty(Validation::setValue("prod_ties_brand_id"))) && (!empty($listBrand))) {
                                                    foreach($listBrand as $brandItem) {
                                                        echo $brandItem['brand_id'] == Validation::setValue("prod_ties_brand_id") ? $brandItem['brand_id'] : null;
                                                    }
                                                }
                                                /* --------------------------------------------------- */
                                            }} ?>">
                                            <div class="position_relative">
                                                <div id="content_recomment_brand" class="list_recomment position_absolute">
                                                    <ul class="list"></ul>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("prod_ties_brand_id"); }} ?>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex">
                                        <label for="prod_listId_cateProd_ties" class="form_label" title="Nhấn để chọn danh mục">
                                            <span><span style="color: #f00;">*</span> Danh mục</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <div class="form_list_wrap">
                                                <div class="list">
                                                    <?php {{ if(!empty($listCateProd)) {
                                                        foreach($listCateProd as $cateProdItem) { ?>
                                                            <label for="cateProd_<?php {{ echo $cateProdItem['cateProd_id']; }} ?>" class="item d_flex align_items_center">
                                                                <input type="checkbox" name="cateProdId[]" class="cateProdId_checkItem" <?php {{
                                                                    /*----------------------------------------------*/
                                                                    if(!empty(Validation::setValue("cateProdId"))) {
                                                                        foreach(Validation::setValue("cateProdId") as $__cateProdItem) {
                                                                            echo $__cateProdItem == $cateProdItem['cateProd_id'] ? "checked" : null;
                                                                        }
                                                                    }
                                                                    /*----------------------------------------------*/
                                                                }} ?> value="<?php {{
                                                                    /*----------------------------------------------*/
                                                                    echo $cateProdItem['cateProd_id'];
                                                                    /*----------------------------------------------*/
                                                                }} ?>" id="cateProd_<?php {{ echo $cateProdItem['cateProd_id']; }} ?>">
                                                                <span><?php {{ echo str_repeat("-----", $cateProdItem['level']); }}{{ echo $cateProdItem['cateProd_name']; }} ?></span>
                                                            </label>
                                                        <?php }
                                                    } else { ?> <p class="data_empty_notification text_left">Bạn chưa có danh mục sản phẩm nào !</p> <?php } }} ?>
                                                </div>
                                            </div>
                                            <?php {{ echo Validation::formError("cateProdId"); }} ?>
                                            <div class="list_button d_flex align_items_center">
                                                <a href="" class="btn btn_primary cateProdSelectAll">Chọn tất cả</a>
                                                <a href="" class="btn btn_warning cateProdClearAll">Bỏ chọn tất cả</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex">
                                        <label for="prod_listId_newsIntro_ties" class="form_label" title="Nhấn để chọn bài viết">
                                            <span>Bài viết về sản phẩm</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <div class="form_list_wrap">
                                                <div class="list">
                                                    <?php {{
                                                        if(!empty($listNews)) {
                                                            foreach ($listNews as $newsItem) {
                                                            ?>
                                                                <label for="newsIntro_<?php {{ echo $newsItem['news_id']; }} ?>" class="item d_flex align_items_center">
                                                                    <input type="checkbox" name="newsIntroId[]" class="newsIntroId_checkItem" <?php {{
                                                                        /*----------------------------------------------*/
                                                                        if(!empty(Validation::setValue("newsIntroId"))) {
                                                                            foreach(Validation::setValue("newsIntroId") as $__newsIntroItem) {
                                                                                echo $__newsIntroItem == $newsItem['news_id'] ? "checked" : null;
                                                                            }
                                                                        }
                                                                        /*----------------------------------------------*/
                                                                    }} ?> value="<?php {{
                                                                        /*----------------------------------------------*/
                                                                        echo $newsItem['news_id'];
                                                                        /*----------------------------------------------*/
                                                                    }} ?>" id="newsIntro_<?php {{ echo $newsItem['news_id']; }} ?>">
                                                                    <span><?php {{ echo $newsItem['news_name']; }} ?></span>
                                                                </label>
                                                            <?php
                                                            }
                                                        }
                                                    }} ?>
                                                </div>
                                            </div>
                                            <div class="list_button d_flex align_items_center">
                                                <a href="" class="btn btn_primary newsIntroSelectAll">Chọn tất cả</a>
                                                <a href="" class="btn btn_warning newsIntroClearAll">Bỏ chọn tất cả</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex">
                                        <label for="prod_listId_newsTutorial_ties" class="form_label" title="Nhấn để chọn bài viết">
                                            <span>Bài viết hướng dẫn sử dụng</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <div class="form_list_wrap">
                                                <div class="list">
                                                    <?php {{
                                                        if(!empty($listNews)) {
                                                            foreach ($listNews as $newsItem) {
                                                            ?>
                                                                <label for="newsTutorial_<?php {{ echo $newsItem['news_id']; }} ?>" class="item d_flex align_items_center">
                                                                    <input type="checkbox" name="newsIdTutorial[]" class="newsIdTutorial_checkItem" <?php {{
                                                                        /*----------------------------------------------*/
                                                                        if(!empty(Validation::setValue("newsIdTutorial"))) {
                                                                            foreach(Validation::setValue("newsIdTutorial") as $__newsTutorialItem) {
                                                                                echo $__newsTutorialItem == $newsItem['news_id'] ? "checked" : null;
                                                                            }
                                                                        }
                                                                        /*----------------------------------------------*/
                                                                    }} ?> value="<?php {{
                                                                        /*----------------------------------------------*/
                                                                        echo $newsItem['news_id'];
                                                                        /*----------------------------------------------*/
                                                                    }} ?>" id="newsTutorial_<?php {{ echo $newsItem['news_id']; }} ?>">
                                                                    <span><?php {{ echo $newsItem['news_name']; }} ?></span>
                                                                </label>
                                                            <?php
                                                            }
                                                        }
                                                    }} ?>
                                                </div>
                                            </div>
                                            <div class="list_button d_flex align_items_center">
                                                <a href="" class="btn btn_primary newsTutorialSelectAll">Chọn tất cả</a>
                                                <a href="" class="btn btn_warning newsTutorialClearAll">Bỏ chọn tất cả</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_listId_recomment" class="form_label" title="Lựa chọn các sản phẩm thường mua kèm">
                                            <span>Sản phẩm thường mua kèm</span>
                                            <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                        </label>
                                        <div class="form_input">
                                            <input class="form_control" type="text" id="prod_listId_recomment" placeholder="Lựa chọn các sản phẩm thường mua kèm" autocomplete="off" spellcheck="false">
                                            <div class="position_relative">
                                                <div class="form_list_wrap" style="height: 150px;">
                                                    <ul class="list_content">
                                                        <?php {{
                                                            if(!empty(Validation::setValue("prod_listId_recomment"))) {
                                                                $numRow = 1;
                                                                foreach(Validation::setValue("prod_listId_recomment") as $__prod_item__) {
                                                                    ?>
                                                                        <li class="item">
                                                                            <span><?php {{ echo $__prod_item__['prod_name']; }} ?></span>
                                                                            <span class="close" data-id="<?php {{ echo $__prod_item__['prod_id']; }} ?>"></span>
                                                                            <input type="hidden" name="prod_listId_recomment[<?php {{ echo $numRow; }} ?>][prod_id]" value="<?php {{ echo $__prod_item__['prod_id']; }} ?>">
                                                                            <input type="hidden" name="prod_listId_recomment[<?php {{ echo $numRow; }} ?>][prod_name]" value="<?php {{ echo $__prod_item__['prod_name']; }} ?>">
                                                                        </li>
                                                                    <?php
                                                                    $numRow ++;
                                                                }
                                                            }
                                                        }} ?>
                                                    </ul>
                                                </div>
                                                <div id="content_recomment_products" class="list_recomment position_absolute">
                                                    <ul class="list"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_images">
                                    <div class="table_images_wrap">
                                        <table class="table_images table">
                                            <thead>
                                                <tr>
                                                    <td>Hình ảnh bổ sung</td>
                                                    <td>Sắp xếp</td>
                                                    <td>Tác vụ</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php {{ if(!empty(Validation::setValue("prod_image_desc"))) {
                                                    $numRow = 0;
                                                    foreach(Validation::setValue("prod_image_desc") as $prod_image_desc_item) {
                                                    ?>
                                                    <tr id="image_row<?php {{ echo $numRow; }} ?>">
                                                        <td class="position_relative">
                                                            <div class="thumbNail">
                                                                <img data-src-id="input_image<?php {{ echo $numRow; }} ?>" src="<?php {{
                                                                    /*----------------------------------------------*/
                                                                    echo !empty($prod_image_desc_item['image']) ? $prod_image_desc_item['image'] : "./public/images/logo/no_image-50x50.png";
                                                                    /*----------------------------------------------*/
                                                                }} ?>" alt="">
                                                            </div>
                                                            <div class="popover position_absolute">
                                                                <div class="popover_content d_flex align_items_center">
                                                                    <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=input_image<?php {{ echo $numRow; }} ?>" type="button" data-id-input-image="input_image<?php {{ echo $numRow; }} ?>" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh mô tả">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <button type="button" data-id-clear-img="input_image<?php {{ echo $numRow; }} ?>" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="prod_image_desc[<?php {{ echo $numRow; }} ?>][image]" value="<?php {{
                                                                /*----------------------------------------------*/
                                                                echo !empty($prod_image_desc_item['image']) ? $prod_image_desc_item['image'] : null;
                                                                /*----------------------------------------------*/
                                                            }} ?>" id="input_image<?php {{ echo $numRow; }} ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" min="0" name="prod_image_desc[<?php {{ echo $numRow; }} ?>][sort_order]" value="<?php {{
                                                                /*----------------------------------------------*/
                                                                echo !empty($prod_image_desc_item['sort_order']) ? $prod_image_desc_item['sort_order'] : null;
                                                                /*----------------------------------------------*/
                                                            }} ?>" placeholder="Sắp xếp" class="form_control">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn_danger btnClear">
                                                                <i class="fa fa-minus-circle"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        $numRow ++;
                                                    }
                                                } }} ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>
                                                        <button type="button" id="btnCreate_rowImage" class="btn btn_primary">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_attribute">
                                    <div class="form_group d_flex align_items_center" style="background-color: #eee;">
                                        <label for="prod_old_content_ties" class="form_label">Sản phẩm cũ liên quan</label>
                                        <div class="form_input">
                                            <textarea class="form_control ckeditor" name="prod_old_content_ties" id="prod_old_content_ties" placeholder="Sản phẩm cũ liên quan" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("prod_old_content_ties");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <p class="caption" style="margin-top: 20px;">Khởi tạo table và thể hiện</p>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_intro_content" class="form_label">Giới thiệu nổi bậc</label>
                                        <div class="form_input">
                                            <textarea class="form_control ckeditor" name="prod_intro_content" id="prod_intro_content" placeholder="Giới thiệu nổi bậc" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("prod_intro_content");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <p class="caption" style="margin-top: 20px;">Khởi tạo table và thể hiện</p>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_specifications_content" class="form_label">Thông số kỹ thuật</label>
                                        <div class="form_input">
                                            <textarea class="form_control ckeditor" name="prod_specifications_content" id="prod_specifications_content" placeholder="Mô tả thông số kỹ thuật" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("prod_specifications_content");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <p class="caption" style="margin-top: 20px;">Khởi tạo table và thể hiện</p>
                                        </div>
                                    </div>
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_outstanding_features" class="form_label">Tính năng nổi bậc</label>
                                        <div class="form_input">
                                            <textarea class="form_control ckeditor" name="prod_outstanding_features" id="prod_outstanding_features" placeholder="Tính năng nổi bậc của sản phẩm" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("prod_outstanding_features");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <p class="caption" style="margin-top: 20px;">Khởi tạo table và thể hiện</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_flash_sale">
                                    <div class="table_flash_sale_wrap">
                                        <table class="flash_sale table">
                                            <thead>
                                                <tr>
                                                    <td>Nhóm khách hàng</td>
                                                    <td>Độ ưu tiên</td>
                                                    <td>Giá khuyến mãi</td>
                                                    <td>Date Start</td>
                                                    <td>Date End</td>
                                                    <td>Trạng thái</td>
                                                    <td>Tác vụ</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php {{ if(!empty(Validation::setValue("prod_flashSale"))) {
                                                    $numRow = 0;
                                                    foreach(Validation::setValue("prod_flashSale")  as $prodFlashSaleItem) { ?>
                                                    <tr id="flashSale_row<?php {{ echo $numRow; }} ?>">
                                                        <td>
                                                            <select class="form_control" name="prod_flashSale[<?php {{ echo $numRow; }} ?>][customer_group_id]">
                                                                <option value="1" <?php {{ echo $prodFlashSaleItem == '1' ? "checked" : null; }} ?> >Mặc định</option>
                                                                <option value="2" <?php {{ echo $prodFlashSaleItem == '2' ? "checked" : null; }} ?> >Khách hàng tìm năng</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form_control" type="number" value="<?php {{ echo $prodFlashSaleItem['order']; }} ?>" name="prod_flashSale[<?php {{ echo $numRow; }} ?>][order]" placeholder="Độ ưu tiên" autocomplete="off" spellcheck="false">
                                                        </td>
                                                        <td>
                                                            <input class="form_control price_input" value="<?php {{ echo $prodFlashSaleItem['price']; }} ?>" name="prod_flashSale[<?php {{ echo $numRow; }} ?>][price]" type="text" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
                                                        </td>
                                                        <td>
                                                            <div class="input_group">
                                                                <input class="form_control dateStart_value" value="<?php {{ echo $prodFlashSaleItem['date_start']; }} ?>" type="date" name="prod_flashSale[<?php {{ echo $numRow; }} ?>][date_start]" placeholder="Thời gian bắt đầu" autocomplete="off" spellcheck="false">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input_group">
                                                                <input class="form_control dateEnd_value" value="<?php {{ echo $prodFlashSaleItem['date_end']; }} ?>" type="date" name="prod_flashSale[<?php {{ echo $numRow; }} ?>][date_end]" placeholder="Thời gian kết thúc" autocomplete="off" spellcheck="false">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select name="prod_flashSale[<?php {{ echo $numRow; }} ?>][status]" class="form_control">
                                                                <option value="on"  <?php {{ echo $prodFlashSaleItem['status'] == "on"  ? "selected" : null; }} ?>>Bật</option>
                                                                <option value="off" <?php {{ echo $prodFlashSaleItem['status'] == "off" ? "selected" : null; }} ?>>Tắt</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn_danger btnClear">
                                                                <i class="fa fa-minus-circle"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php $numRow++; }
                                                } }} ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td>
                                                        <button type="button" id="btnCreate_rowFlashSale" class="btn btn_primary">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_special">
                                    <div class="form_group d_flex align_items_center">
                                        <label for="prod_discout_content" class="form_label">Nội dung khuyến mãi</label>
                                        <div class="form_input">
                                            <textarea class="form_control ckeditor" name="prod_discout_content" id="prod_discout_content" placeholder="Khuyến mãi kèm theo sản phẩm" spellcheck="false"><?php {{
                                                /*----------------------------------------------*/
                                                echo Validation::setValue("prod_discout_content");
                                                /*----------------------------------------------*/
                                            }} ?></textarea>
                                            <p class="caption">Khởi tạo table và thể hiện</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
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
// ------ Start Group select --------------------------------------------------
let btnSelectAllCateProd     = document.querySelector(".cateProdSelectAll");
let btnSelectAllNewsIntro    = document.querySelector(".newsIntroSelectAll");
let btnSelectAllNewsTutorial = document.querySelector(".newsTutorialSelectAll");
// ------ End Group select ----------------------------------------------------
// ------ Start Group clear ---------------------------------------------------
let btnClearAllCateProd     = document.querySelector(".cateProdClearAll");
let btnClearAllNewsIntro    = document.querySelector(".newsIntroClearAll");
let btnClearAllNewsTutorial = document.querySelector(".newsTutorialClearAll");
// ------ End Group clear -----------------------------------------------------
// ------ Start List Group check ----------------------------------------------
let listAllCateProd     = document.querySelectorAll(".cateProdId_checkItem");
let listAllNewsIntro    = document.querySelectorAll(".newsIntroId_checkItem");
let listAllNewsTutorial = document.querySelectorAll(".newsIdTutorial_checkItem");
// ------ End List Group check ------------------------------------------------
// ------ Start Handle --------------------------------------------------------
// select -- action
btnSelectAllCateProd.addEventListener('click', function() {
    listAllCateProd.forEach(el => {
        el.checked = true;
    });
    event.preventDefault();
});
btnSelectAllNewsIntro.addEventListener('click', function() {
    listAllNewsIntro.forEach(el => {
        el.checked = true;
    });
    event.preventDefault();
});
btnSelectAllNewsTutorial.addEventListener('click', function() {
    listAllNewsTutorial.forEach(el => {
        el.checked = true;
    });
    event.preventDefault();
});
// clear -- action
btnClearAllCateProd.addEventListener('click', function() {
    listAllCateProd.forEach(el => {
        el.checked = false;
    });
    event.preventDefault();
});
btnClearAllNewsIntro.addEventListener('click', function() {
    listAllNewsIntro.forEach(el => {
        el.checked = false;
    });
    event.preventDefault();
});
btnClearAllNewsTutorial.addEventListener('click', function() {
    listAllNewsTutorial.forEach(el => {
        el.checked = false;
    });
    event.preventDefault();
});
// ------ End Handle ----------------------------------------------------------
</script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/product_add.ajax.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/plugins/Ckeditor/ckeditor/ckeditor.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>

<script>
const imgConfig = "./public/images/logo/no_image-50x50.png";
// ========== ########## --------------------------- ########## ========== //
// ========== ########## START HANDLE CLIENT PRODUCT ########## ========== //
// ========== ########## --------------------------- ########## ========== //
var dataCreateRowImagesDesc = {
    btnCreate : document.getElementById('btnCreate_rowImage'),
    placeAppendData: document.querySelector('table.table_images.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.table_images.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowImagesDesc['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByImagesDesc(dataCreateRowImagesDesc['rowOrderCurrent']);
    dataCreateRowImagesDesc['htmlEl'][dataCreateRowImagesDesc['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowImagesDesc['rowOrderCurrent'] === 0) {
        dataCreateRowImagesDesc['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.table_images.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowImagesDesc['btnClear'] = document.querySelectorAll("table.table_images.table button.btnClear");
    dataCreateRowImagesDesc['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowImagesDesc['btnClear']);
    handleOpenFilemana();
});


function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('image_row')[1]);
            (dataCreateRowImagesDesc['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.table_images.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowImagesDesc['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByImagesDesc(order)
{
    return `<tr id="image_row${order}">
                <td class="position_relative">
                    <div class="thumbNail">
                        <img data-src-id="input_image${order}" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <div class="popover position_absolute">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=0&field_id=input_image${order}" type="button" data-id-input-image="input_image${order}" class="button_image btn btn_primary iframe-btn" title="Thêm ảnh mô tả">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" data-id-clear-img="input_image${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="prod_image_desc[${order}][image]" id="input_image${order}">
                </td>
                <td>
                    <input type="number" min="0" name="prod_image_desc[${order}][sort_order]" value="${order+1}" placeholder="Sắp xếp" class="form_control">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}

//
handleOpenFilemana();
function handleOpenFilemana() {
    $('.iframe-btn').fancybox({
        'width'		: 900,
        'height'	: 600,
        'type'		: 'iframe',
        'autoScale'	: false
    });
}

function responsive_filemanager_callback(field_id){
    var url = jQuery('#'+field_id).val();
    $("[data-src-id='"+(field_id)+"']").attr('src', url);
    handleClearImage();
}

function handleClearImage() {
    let listBtnClearSrcImg = document.querySelectorAll("[data-id-clear-img]");
    listBtnClearSrcImg.forEach(btnEl => {
        btnEl.addEventListener('click', function() {
            let field_id = btnEl.getAttribute('data-id-clear-img');
            let imgElClear = document.querySelector("[data-src-id='"+(field_id)+"']");
            let inputElClear = document.getElementById(""+(field_id)+"");
            imgElClear.setAttribute('src',imgConfig);
            inputElClear.setAttribute('value','');
        });
    });
}

// ========== ########## ----------- ########## ========== //
// ========== ########## START FLASH SALE ########## ========== //
// ========== ########## ----------- ########## ========== //
var dataCreateRowFlashSale = {
    btnCreate : document.getElementById('btnCreate_rowFlashSale'),
    placeAppendData: document.querySelector('table.flash_sale tbody'),
    rowOrderCurrent: document.querySelectorAll('table.flash_sale tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowFlashSale['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByFlashSale(dataCreateRowFlashSale['rowOrderCurrent']);
    dataCreateRowFlashSale['htmlEl'][dataCreateRowFlashSale['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowFlashSale['rowOrderCurrent'] === 0) {
        dataCreateRowFlashSale['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.flash_sale tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowFlashSale['btnClear'] = document.querySelectorAll("table.flash_sale button.btnClear");
    dataCreateRowFlashSale['rowOrderCurrent'] ++;
    handleClearFlashSale(dataCreateRowFlashSale['btnClear']);
});

function handleClearFlashSale(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('image_row')[1]);
            (dataCreateRowFlashSale['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.flash_sale tbody tr').length;
            if(numRow === 0) {
                dataCreateRowFlashSale['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByFlashSale(order) {
    return `
    <tr id="flashSale_row${order}">
        <td>
            <select class="form_control" name="prod_flashSale[0][customer_group_id]">
                <option value="1">Mặc định</option>
                <option value="2">Khách hàng tìm năng</option>
            </select>
        </td>
        <td>
            <input class="form_control" type="number" value="${order+1}" name="prod_flashSale[${order}][order]" placeholder="Độ ưu tiên" autocomplete="off" spellcheck="false">
        </td>
        <td>
            <input class="form_control price_input" name="prod_flashSale[${order}][price]" type="text" placeholder="Giá khuyến mãi" autocomplete="off" spellcheck="false">
        </td>
        <td>
            <div class="input_group">
                <input class="form_control dateStart_value" type="date" name="prod_flashSale[${order}][date_start]" placeholder="Thời gian bắt đầu" autocomplete="off" spellcheck="false">
            </div>
        </td>
        <td>
            <div class="input_group">
                <input class="form_control dateEnd_value" type="date" name="prod_flashSale[${order}][date_end]" placeholder="Thời gian kết thúc" autocomplete="off" spellcheck="false">
            </div>
        </td>
        <td>
            <select name="prod_flashSale[${order}][status]" class="form_control">
                <option value="on">Bật</option>
                <option value="off" selected>Tắt</option>
            </select>
        </td>
        <td>
            <button type="button" class="btn btn_danger btnClear">
                <i class="fa fa-minus-circle"></i>
            </button>
        </td>
    </tr>
    `;
}
</script>

<!-- ====================================================== -->
<!-- ========== ########## APP CONFIG ########## ========== -->
<!-- ====================================================== -->

<script type="text/javascript">
handleOpenFilemana();
function handleOpenFilemana() {
    $('.iframe-btn').fancybox({
        'width'		: 900,
        'height'	: 600,
        'type'		: 'iframe',
        'autoScale'	: false
    });
}

function responsive_filemanager_callback(field_id){
    var url = jQuery('#'+field_id).val();
    $("[data-src-id='"+(field_id)+"']").attr('src', url);
    handleClearImage();
}

function handleClearImage() {
    let listBtnClearSrcImg = document.querySelectorAll("[data-id-clear-img]");
    listBtnClearSrcImg.forEach(btnEl => {
        btnEl.addEventListener('click', function() {
            let field_id = btnEl.getAttribute('data-id-clear-img');
            let imgElClear = document.querySelector("[data-src-id='"+(field_id)+"']");
            let inputElClear = document.getElementById(""+(field_id)+"");
            imgElClear.setAttribute('src',imgConfig);
            inputElClear.setAttribute('value','');
        });
    });
}


//========= ##### handle keyup word and append ##### ==========//

var metaTitleEl = document.querySelector("#prod_metaTitle");
var metaDescEl  = document.querySelector("#prod_metaDesc");
var seoUrlEl    = document.querySelector("#prod_seoUrl");

metaTitleEl.addEventListener('keyup', function() {
    let vl = this.value;
    let spaceAppend = document.querySelector(".google_title");
    appendKeyWord(vl, spaceAppend);
});

metaDescEl.addEventListener('keyup', function() {
    let vl = this.value;
    let spaceAppend = document.querySelector(".google_desc");
    appendKeyWord(vl, spaceAppend);
});


seoUrlEl.addEventListener('keyup', function() {
    let vl = this.value;
    let spaceAppend = document.querySelector(".google_url .url");
    document.querySelector("[name='prod_seoUrl']").value = slug_string(vl);
    appendKeyWord(slug_string(vl), spaceAppend);
});


function appendKeyWord(keyWord, placeAppend)
{
    placeAppend.innerText = keyWord;
}

function slug_string(str)
{
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "-");
    str = str.replace(/-+-/g, "-");
    str = str.replace(/^\-+|\-+$/g, "");
    if (str === undefined) {
        return false;
    } else {
        return str;
    }
}
</script>
<script>
// handle notification status add new
var alertStatusAddEl = document.querySelector('.alert');
if(alertStatusAddEl !== null) {
    var buttonCloseAlertEl   = document.querySelector(".alert .close");
    if(alertStatusAddEl.getAttribute('data-status') === 'true') {
        alertStatusAddEl.classList.add('open');
        setTimeout(function() {
            alertStatusAddEl.classList.remove('open');
        },5000);
    }

    buttonCloseAlertEl.addEventListener('click', function() {
        alertStatusAddEl.classList.remove('open');
    });
}
</script>
<script type="text/javascript" class="handle_format_price">
    document.querySelectorAll(".price_input").forEach(el => {
        el.addEventListener('keyup', function() {
            let priceVl = (this.value).replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g, "");
            document.querySelector(("[name='"+(this.getAttribute('data-price-name'))+"']")).value = priceVl;
        });
    });
</script>
<script>
    let btnSelectYes_installment = document.querySelector("#yes_installment");
    let btnSelectNo_installment  = document.querySelector("#no_installment");
    let formInstallment_rate     = document.querySelector(".form_installment_rate");
    if(btnSelectYes_installment.checked) {
        formInstallment_rate.classList.add('open');
    }
    btnSelectYes_installment.addEventListener("change", function() {
        formInstallment_rate.classList.add('open');
    });
    btnSelectNo_installment.addEventListener("click", function() {
        formInstallment_rate.classList.remove('open');
    });
</script>
<style>
    .form_installment_rate {
        height: 0;
        overflow: hidden;
        transition: all .25s;
    }
    .form_installment_rate.open {
        height: auto;
        transition: all .25s;
    }
</style>