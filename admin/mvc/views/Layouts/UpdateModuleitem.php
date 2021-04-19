<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Module item</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;">Thêm module item</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" name="addModuleitem_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Moduleitem/add">
                        <i class="fa fa-refresh" aria-hidden="true"></i>
                        <span>Làm mới</span>
                    </a>
                    <a class="btn_item btn_default" href="Moduleitem">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php if(!empty($statusActionModuleitem)) : ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionModuleitem['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionModuleitem['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionModuleitem['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php endif; ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm module item</span>
                    </h2>
                </div>
                <?php if( !empty($moduleitem_item) ) : ?>
                    <div class="panel_body">
                        <form action="" method="POST">
                            <div id="table_content">
                                <div class="nav_tabs d_flex align_items_center">
                                    <a class="tab_item active" href="#tab_general">Tổng quan</a>
                                    <a class="tab_item" href="#tab_link">Liên kết</a>
                                    <a class="tab_item" href="#tab_mini_banner">Banner</a>
                                </div>
                                <div class="tab_content">
                                    <div class="tab_pane" id="tab_general">
                                        <div class="form_group status_wrap d_flex align_items_center">
                                            <label for="status_value" class="form_label">Trạng thái</label>
                                            <div class="switch_status">
                                                <label for="status_value" class="status_toogle on">
                                                    <input type="checkbox" name="moduleitem_status" <?php {{
                                                        /*-----------------------------------------*/
                                                        if(!empty(Validation::setValue("moduleitem_status")))
                                                        { echo Validation::setValue("moduleitem_status") == "on" ? "checked" : null; }
                                                        else
                                                        { echo $moduleitem_item['moduleitem_status'] == "on" ? "checked" : null; }
                                                        /*-----------------------------------------*/
                                                    }} ?> id="status_value" class="d_none">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="moduleitem_nametap" class="form_label"><strong style="color: #f00;">*</strong> Tên tab</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="moduleitem_nametap" id="moduleitem_nametap" value="<?php {{
                                                        /*----------------------------------------*/
                                                        if(!empty(Validation::setValue("moduleitem_nametap")))
                                                        { echo Validation::setValue("moduleitem_nametap"); }
                                                        else
                                                        { echo !empty($moduleitem_item['moduleitem_nametap']) ? $moduleitem_item['moduleitem_nametap'] : null; }
                                                        /*----------------------------------------*/
                                                    }} ?>" placeholder="Tên tab control" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("moduleitem_nametap"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="moduleitem_title_txt" class="form_label"><strong style="color: #f00;">*</strong> Tiêu đề module item (Chữ)</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="moduleitem_title_txt" id="moduleitem_title_txt" value="<?php {{
                                                        /*----------------------------------------*/
                                                        if(!empty(Validation::setValue("moduleitem_title_txt")))
                                                        { echo Validation::setValue("moduleitem_title_txt"); }
                                                        else
                                                        { echo !empty($moduleitem_item["moduleitem_title_txt"]) ? $moduleitem_item["moduleitem_title_txt"] : null; }
                                                        /*----------------------------------------*/
                                                    }} ?>" placeholder="Tiêu đề bằng chữ của module" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("moduleitem_title_txt"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="moduleitem_title_img" class="form_label">Tên đề module item (Ảnh)</label>
                                                <div class="form_input">
                                                    <label for="moduleitem_title_img">
                                                        <input type="hidden" id="moduleitem_title_img" name="moduleitem_title_img" value="<?php {{
                                                            /*----------------------------------------*/
                                                           if(!empty(Validation::setValue("moduleitem_title_img")))
                                                           { echo Validation::setValue("moduleitem_title_img"); }
                                                           else
                                                           { echo !empty($moduleitem_item["moduleitem_title_img"]) ? $moduleitem_item["moduleitem_title_img"] : null; }
                                                            /*----------------------------------------*/
                                                        }} ?>">
                                                        <span class="thumbNail banner __PC" style="height: 200px;">
                                                            <img class="img_cover full_size" src="<?php {{
                                                                /*----------------------------------------*/
                                                                if(!empty(Validation::setValue("moduleitem_title_img")))
                                                                { echo Validation::setValue("moduleitem_title_img"); }
                                                                else
                                                                { echo !empty($moduleitem_item["moduleitem_title_img"]) ? $moduleitem_item["moduleitem_title_img"] : "./public/images/logo/no_image-50x50.png"; }
                                                                /*----------------------------------------*/
                                                            }} ?>" data-src-id="moduleitem_title_img" alt="">
                                                        </span>
                                                    </label>
                                                    <div class="popover" style="transform: translate(0)">
                                                        <div class="popover_content d_flex align_items_center">
                                                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=moduleitem_title_img" type="button" data-id-input-image="moduleitem_title_img" class="button_image btn btn_primary iframe-btn" title="Thêm tiêu đề ảnh module">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <button type="button" data-id-clear-img="moduleitem_title_img" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="moduleitem_bg_body" class="form_label">
                                                    <strong style="color: #f00;">*</strong> Màu nền
                                                    <small class="d_block">(Màu đen là không màu)</small>
                                                </label>
                                                <div class="form_input">
                                                    <input class="form_control" type="color" name="moduleitem_bg_body" id="moduleitem_bg_body" style="width: 100px; height: 100px;" value="<?php {{
                                                        /*----------------------------------------*/
                                                        if(!empty(Validation::setValue("moduleitem_bg_body")))
                                                        { echo Validation::setValue("moduleitem_bg_body"); }
                                                        else
                                                        { echo !empty($moduleitem_item['moduleitem_bg_body']) ? $moduleitem_item['moduleitem_bg_body'] : null; }
                                                        /*----------------------------------------*/
                                                    }} ?>" placeholder="Tiêu đề bằng chữ của module" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("moduleitem_bg_body"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="brand_order" class="form_label">Thứ tự lớn nhất</label>
                                                <div class="form_input">
                                                    <input type="text" disabled class="form_control" id="orderMax_current" style="width: 50px; margin-bottom: 5px;" value="">
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="moduleitem_order" class="form_label">Thứ tự</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="number" name="moduleitem_order" id="moduleitem_order" value="<?php {{
                                                        /*----------------------------------------*/
                                                        if(!empty(Validation::setValue("moduleitem_order")))
                                                        { echo Validation::setValue("moduleitem_order"); }
                                                        else
                                                        { echo !empty($moduleitem_item["moduleitem_order"]) ? $moduleitem_item["moduleitem_order"] : null; }
                                                        /*----------------------------------------*/
                                                    }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_link">
                                        <div class="content_group">
                                            <div class="form_group d_flex">
                                                <label for="" class="form_label" title="Liên kết chính">
                                                    <strong style="color: #f00;">*</strong>
                                                    <span>Module cha</span>
                                                    <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                                </label>
                                                <div class="form_input">
                                                    <div class="form_list_wrap">
                                                        <?php if( !empty($listModule) ) : ?>
                                                            <div class="list">
                                                                <?php foreach($listModule as $moduleItem) : ?>
                                                                    <label for="module_<?php {{ echo $moduleItem['module_id']; }} ?>" class="item d_flex align_items_center">
                                                                        <input type="radio" data-option-item="moduleitem_module_parent_id" name="moduleitem_module_parent_id[]" <?php {{
                                                                            /*-----------------------------------------------------------*/
                                                                            if(!empty(Validation::setValue("moduleitem_module_parent_id"))) {
                                                                                echo Validation::setValue("moduleitem_module_parent_id")[0] == $moduleItem['module_id'] ? "checked" : null;
                                                                            }
                                                                            else
                                                                            {
                                                                                if(!empty($moduleitem_item['moduleitem_module_parent_id'])) {
                                                                                    echo $moduleitem_item['moduleitem_module_parent_id'] == $moduleItem['module_id'] ? "checked" : null;
                                                                                }
                                                                            }
                                                                            /*-----------------------------------------------------------*/
                                                                        }} ?> value="<?php {{ echo $moduleItem['module_id']; }} ?>" id="module_<?php {{ echo $moduleItem['module_id']; }} ?>">
                                                                        <span><?php {{ echo $moduleItem['module_name']; }} ?></span>
                                                                    </label>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php else : ?>
                                                            <p>Chưa có module cha nào !</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php {{ echo Validation::formError("moduleitem_module_parent_id"); }} ?>
                                                    <div class="list_button d_flex align_items_center">
                                                        <a href="" class="btn btn_warning" data-clear-btn="cateProd_main">Bỏ chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex">
                                                <label for="" class="form_label" title="Liên kết chính">
                                                    <span>Danh mục chính</span>
                                                    <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                                </label>
                                                <div class="form_input">
                                                    <div class="form_list_wrap">
                                                        <div class="list">
                                                            <?php if(!empty($listCateProd)) : ?>
                                                                <?php foreach($listCateProd as $cateProdItem) : ?>
                                                                    <label for="cateProd_main_<?php {{ echo $cateProdItem['cateProd_id']; }} ?>" class="item d_flex align_items_center">
                                                                        <input type="radio" data-option-item="cateProd_main" name="cateProd_main[]" <?php {{
                                                                            /*-----------------------------------------------------------*/
                                                                            if(!empty(Validation::setValue("cateProd_main")))
                                                                            { echo Validation::setValue("cateProd_main")[0] == $cateProdItem['cateProd_id'] ? "checked" : null; }
                                                                            else
                                                                            {
                                                                                if(!empty($moduleitem_item["moduleitem_cateProd_id_ties"])) {
                                                                                    echo $moduleitem_item["moduleitem_cateProd_id_ties"] == $cateProdItem['cateProd_id'] ? "checked" : null;
                                                                                }
                                                                            }
                                                                            /*-----------------------------------------------------------*/
                                                                        }} ?> value="<?php {{ echo $cateProdItem['cateProd_id']; }} ?>" id="cateProd_main_<?php {{ echo $cateProdItem['cateProd_id']; }} ?>">
                                                                        <span><?php {{
                                                                            /*-----------------------------------------------------------*/
                                                                            echo str_repeat("-----", $cateProdItem['level']); }} {{ echo $cateProdItem['cateProd_name'];
                                                                            /*-----------------------------------------------------------*/
                                                                        }} ?></span>
                                                                    </label>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="list_button d_flex align_items_center">
                                                        <a href="" class="btn btn_warning" data-clear-btn="cateProd_main">Bỏ chọn</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex" data-option-display="normal">
                                                <label for="" class="form_label" title="Nhấn để chọn danh mục">
                                                    <span style="color: #f00;">*</span>
                                                    <span>Sản phẩm liên kết</span>
                                                    <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                                </label>
                                                <div class="form_input" id="block_prod_ties">
                                                    <div class="grid_row">
                                                        <div class="grid_column_6">
                                                            <div class="form_list_wrap" style="margin-top: 10px;">
                                                                <select name="select_prod_ties" class="form_control" id="">
                                                                    <option value="">-- Chọn danh mục --</option>
                                                                    <option value="flashsale">Sản phẩm flash sale</option>
                                                                    <?php if(!empty($listCateProd)) : ?>
                                                                        <?php foreach($listCateProd as $cateProdItem) : ?>
                                                                            <option value="<?php {{ echo $cateProdItem['cateProd_id']; }} ?>"><?php {{ echo str_repeat("-----", $cateProdItem['level']); }} {{ echo $cateProdItem['cateProd_name']; }} ?></option>
                                                                        <?php endforeach; ?>
                                                                    <?php else: ?>
                                                                        <option value="">Chưa có danh mục sản phẩm nào</option>
                                                                    <?php endif; ?>
                                                                </select>
                                                                <div class="list" style="height: 187px; overflow: auto; margin-top: 10px;">
                                                                    <?php if( !empty(Validation::setValue("block_prod_ties")) ) : ?>
                                                                        <?php foreach( Validation::setValue("block_prod_ties") as $prodItem ) : ?>
                                                                            <label for="block_prod_ties_<?php {{ echo $prodItem['id']; }} ?>" class="item d_flex align_items_center">
                                                                                <input type="checkbox" data-option-item="block_prod_ties" checked value="<?php {{ echo $prodItem['id']; }} ?>" id="block_prod_ties_<?php {{ echo $prodItem['id']; }} ?>">
                                                                                <span><?php {{ echo $prodItem['name']; }} ?></span>
                                                                            </label>
                                                                        <?php endforeach; ?>
                                                                    <?php else: ?>
                                                                        <?php if(!empty($moduleitem_list_idProd_ties)) ?>
                                                                            <?php foreach( $moduleitem_list_idProd_ties as $moduleProd_item ) : ?>
                                                                                <label for="block_prod_ties_<?php {{ echo $moduleProd_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                                    <input type="checkbox" data-option-item="block_prod_ties" checked value="<?php {{ echo $moduleProd_item['id']; }} ?>" id="block_prod_ties_<?php {{ echo $moduleProd_item['id']; }} ?>">
                                                                                    <span><?php {{ echo $moduleProd_item['name']; }} ?></span>
                                                                                </label>
                                                                            <?php endforeach; ?>
                                                                        <?php ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form_list_wrap grid_column_6" style="height: 260.5px; margin-top: 10px;">
                                                            <ul class="list_content">
                                                                <?php if(!empty(Validation::setValue("block_prod_ties"))) : ?>
                                                                    <?php $orderRow = 0; foreach(Validation::setValue("block_prod_ties") as $prodItem) : ?>
                                                                        <?php {{ $orderRow ++; }} ?>
                                                                        <li class="item">
                                                                            <span><?php {{ echo $prodItem['name']; }} ?></span>
                                                                            <span class="close" data-name="block_prod_ties" data-id="<?php {{ echo $prodItem['id']; }} ?>"></span>
                                                                            <input type="hidden" name="block_prod_ties[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $prodItem['id']; }} ?>">
                                                                            <input type="hidden" name="block_prod_ties[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $prodItem['name']; }} ?>">
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <?php if( !empty($moduleitem_list_idProd_ties) ) : ?>
                                                                        <?php $orderRow = 0; foreach($moduleitem_list_idProd_ties as $moduleProd_item) : $orderRow ++; ?>
                                                                            <li class="item">
                                                                                <span><?php {{ echo $moduleProd_item['name']; }} ?></span>
                                                                                <span class="close" data-name="block_prod_ties" data-id="<?php {{ echo $moduleProd_item['id']; }} ?>"></span>
                                                                                <input type="hidden" name="block_prod_ties[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $moduleProd_item['id']; }} ?>">
                                                                                <input type="hidden" name="block_prod_ties[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $moduleProd_item['name']; }} ?>">
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php {{ echo Validation::formError("block_prod_ties"); }} ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_mini_banner">
                                        <table class="table mini_banner_banner_table">
                                            <thead>
                                                <tr>
                                                    <td>Tiêu đề</td>
                                                    <td>Ảnh PC</td>
                                                    <td>Sắp xếp</td>
                                                    <td>Tác vụ</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty(Validation::setValue("listbannerPromotion_prod"))) : ?>
                                                    <?php $orderRow = 0; foreach(Validation::setValue("listbannerPromotion_prod") as $bannerItem) : ?>
                                                        <tr id="banner_module_item_row<?php {{ echo $orderRow; }} ?>">
                                                            <td>
                                                                <div class="form_group d_flex align_items_center">
                                                                    <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Tiêu đề</label>
                                                                    <div class="form_input grid_column_9">
                                                                        <input class="form_control" type="text" value="<?php {{ echo !empty($bannerItem['title']) ? $bannerItem['title'] : null; }} ?>" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][title]" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="form_group d_flex align_items_center">
                                                                    <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Mô tả</label>
                                                                    <div class="form_input grid_column_9">
                                                                        <input class="form_control" type="text" value="<?php {{ echo !empty($bannerItem['desc']) ? $bannerItem['desc'] : null; }} ?>" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][desc]" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="form_group d_flex align_items_center">
                                                                    <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Đường dẫn</label>
                                                                    <div class="form_input grid_column_9">
                                                                        <input class="form_control" type="text" value="<?php {{ echo !empty($bannerItem['link']) ? $bannerItem['link'] : null; }} ?>" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][link]" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                                                                    </div>
                                                                </div>
                                                                <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                                                    <label for="" class="form_label grid_column_2"></label>
                                                                    <div class="form_input grid_column_9">
                                                                        <select class="form_control" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][target]" id="">
                                                                            <option value="_blank" <?php {{ echo $bannerItem['target'] == "_blank" ? "selected" : null; }} ?>>Hiển thị tab mới</option>
                                                                            <option value="self"   <?php {{ echo $bannerItem['target'] == "self"   ? "selected" : null; }} ?>>Hiển thị tab hiện tại</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="position_relative">
                                                                <span>343x274 px</span>
                                                                <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 343px; height: 274px; display: flex;">
                                                                    <img data-src-id="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" class="full_size img_cover" src="<?php {{
                                                                        /*----------------------------------------------------------------*/
                                                                        echo !empty($bannerItem['bannerPC']) ? $bannerItem['bannerPC'] : "./public/images/logo/no_image-50x50.png";
                                                                        /*----------------------------------------------------------------*/
                                                                    }} ?>" alt="">
                                                                </div>
                                                                <input type="hidden" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][bannerPC]" value="<?php {{
                                                                    /*----------------------------------------------------------------*/
                                                                    echo !empty($bannerItem['bannerPC']) ? $bannerItem['bannerPC'] : null;
                                                                    /*----------------------------------------------------------------*/
                                                                }} ?>" id="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>">
                                                                <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                                                                    <div class="popover_content d_flex align_items_center">
                                                                        <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" type="button" data-id-input-image="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" class="button_image btn btn_primary iframe-btn" title="Thêm banner khuyến mãi">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                        <button type="button" style="padding: 7px 12px;" data-id-clear-img="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                            <i class="fa fa-trash-o"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input class="form_control" type="number" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][order]" value="<?php {{
                                                                    /*--------------------------------------------------------------------*/
                                                                    echo !empty($bannerItem['order']) ? $bannerItem['order'] : null;
                                                                    /*--------------------------------------------------------------------*/
                                                                }} ?>" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn_danger btnClear">
                                                                    <i class="fa fa-minus-circle"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php {{ $orderRow ++; }} ?>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <?php if(!empty($listModuleitemBannerPromotion)) : ?>
                                                        <?php $orderRow = 0; foreach($listModuleitemBannerPromotion as $bannerPromoItem) : ?>
                                                            <tr id="banner_module_item_row<?php {{ echo $orderRow; }} ?>">
                                                                <td>
                                                                    <div class="form_group d_flex align_items_center">
                                                                        <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Tiêu đề</label>
                                                                        <div class="form_input grid_column_9">
                                                                            <input class="form_control" type="text" value="<?php {{ echo !empty($bannerPromoItem['modulebannerPromo_title']) ? $bannerPromoItem['modulebannerPromo_title'] : null; }} ?>" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][title]" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form_group d_flex align_items_center">
                                                                        <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Mô tả</label>
                                                                        <div class="form_input grid_column_9">
                                                                            <input class="form_control" type="text" value="<?php {{ echo !empty($bannerPromoItem['modulebannerPromo_desc']) ? $bannerPromoItem['modulebannerPromo_desc'] : null; }} ?>" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][desc]" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form_group d_flex align_items_center">
                                                                        <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Đường dẫn</label>
                                                                        <div class="form_input grid_column_9">
                                                                            <input class="form_control" type="text" value="<?php {{ echo !empty($bannerPromoItem['modulebannerPromo_link']) ? $bannerPromoItem['modulebannerPromo_link'] : null; }} ?>" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][link]" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                                                                        <label for="" class="form_label grid_column_2"></label>
                                                                        <div class="form_input grid_column_9">
                                                                            <select class="form_control" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][target]" id="">
                                                                                <option value="_blank" <?php {{ echo $bannerPromoItem['modulebannerPromo_target'] == "_blank" ? "selected" : null; }} ?>>Hiển thị tab mới</option>
                                                                                <option value="self"   <?php {{ echo $bannerPromoItem['modulebannerPromo_target'] == "self"   ? "selected" : null; }} ?>>Hiển thị tab hiện tại</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="position_relative">
                                                                    <span>343x274 px</span>
                                                                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 343px; height: 274px; display: flex;">
                                                                        <img data-src-id="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" class="full_size img_cover" src="<?php {{
                                                                            /*----------------------------------------------------------------*/
                                                                            echo !empty($bannerPromoItem['modulebannerPromo_src']) ? $bannerPromoItem['modulebannerPromo_src'] : "./public/images/logo/no_image-50x50.png";
                                                                            /*----------------------------------------------------------------*/
                                                                        }} ?>" alt="">
                                                                    </div>
                                                                    <input type="hidden" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][bannerPC]" value="<?php {{
                                                                        /*----------------------------------------------------------------*/
                                                                        echo !empty($bannerPromoItem['modulebannerPromo_src']) ? $bannerPromoItem['modulebannerPromo_src'] : null;
                                                                        /*----------------------------------------------------------------*/
                                                                    }} ?>" id="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>">
                                                                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                                                                        <div class="popover_content d_flex align_items_center">
                                                                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" type="button" data-id-input-image="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" class="button_image btn btn_primary iframe-btn" title="Thêm banner khuyến mãi">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </a>
                                                                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="banner_module_itemIMG<?php {{ echo $orderRow; }} ?>" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input class="form_control" type="number" name="banner_module_item[<?php {{ echo $orderRow; }} ?>][order]" value="<?php {{
                                                                        /*--------------------------------------------------------------------*/
                                                                        echo !empty($bannerPromoItem['modulebannerPromo_order']) ? $bannerPromoItem['modulebannerPromo_order'] : null;
                                                                        /*--------------------------------------------------------------------*/
                                                                    }} ?>" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn_danger btnClear">
                                                                        <i class="fa fa-minus-circle"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php $orderRow ++; endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </tbody>
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
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <p class="data_empty_notification">Module item này không tồn tại</p>
                <?php endif; ?>
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
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/latest.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addModuleItem.ajax.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/lib/fancybox.min.js"); }} ?>" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous"></script>
<script type="text/javascript" class="handle__js__app">
const imgConfig = "./public/images/logo/no_image-50x50.png";

// ========== ########## START MAIN BANNER ########## ========== //

var dataCreateRowMiniBanner = {
    btnCreate : document.getElementById('btnCreate_rowMiniBanner'),
    placeAppendData: document.querySelector('table.mini_banner_banner_table.table tbody'),
    rowOrderCurrent: document.querySelectorAll('table.mini_banner_banner_table.table tbody tr').length,
    btnClear: undefined,
    htmlEl: [],
}

dataCreateRowMiniBanner['btnCreate'].addEventListener('click', function() {
    let htmlEl = cloneHmtlByMiniBanner(dataCreateRowMiniBanner['rowOrderCurrent']);
    dataCreateRowMiniBanner['htmlEl'][dataCreateRowMiniBanner['rowOrderCurrent']] = htmlEl;
    if(dataCreateRowMiniBanner['rowOrderCurrent'] === 0) {
        dataCreateRowMiniBanner['placeAppendData'].innerHTML = htmlEl;
    } else {
        jQuery("table.mini_banner_banner_table.table tbody").find('tr:last-child').after(htmlEl);
    }
    dataCreateRowMiniBanner['btnClear'] = document.querySelectorAll("table.mini_banner_banner_table.table button.btnClear");
    dataCreateRowMiniBanner['rowOrderCurrent'] ++;
    handleClearImageRow(dataCreateRowMiniBanner['btnClear']);
    handleOpenFilemana();
});

function handleClearImageRow(nodeButtonList) {
    nodeButtonList.forEach(el => {
        el.addEventListener('click', function() {
            let rowEl = this.parentElement.parentElement;
            let idRow = parseInt(rowEl.getAttribute('id').split('miniBannerImgRow')[1]);
            (dataCreateRowMiniBanner['htmlEl']).splice(idRow,1);
            rowEl.remove();
            let numRow = document.querySelectorAll('table.mini_banner_banner_table.table tbody tr').length;
            if(numRow === 0) {
                dataCreateRowMiniBanner['rowOrderCurrent'] = 0;
            }
        });
    });
}

function cloneHmtlByMiniBanner(order)
{
    return `<tr id="banner_module_item_row${order}">
                <td>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Tiêu đề</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="banner_module_item[${order}][title]" placeholder="Tiêu đề" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Mô tả</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="banner_module_item[${order}][desc]" placeholder="Mô tả" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center">
                        <label for="" class="form_label grid_column_2"><strong style="color: #f00;">*</strong> Đường dẫn</label>
                        <div class="form_input grid_column_9">
                            <input class="form_control" type="text" name="banner_module_item[${order}][link]" placeholder="Đường dẫn" autocomplete="off" spellcheck="false">
                        </div>
                    </div>
                    <div class="form_group d_flex align_items_center" style="border-bottom: 1px solid #E5E5E5;">
                        <label for="" class="form_label grid_column_2"></label>
                        <div class="form_input grid_column_9">
                            <select class="form_control" name="banner_module_item[${order}][target]" id="">
                                <option value="_blank">Hiển thị tab mới</option>
                                <option value="self">Hiển thị tab hiện tại</option>
                            </select>
                        </div>
                    </div>
                </td>
                <td class="position_relative">
                    <span>343x274 px</span>
                    <div class="thumbNail d_flex justify_content_center align_items_center" style="width: 343px; height: 274px; display: flex;">
                        <img data-src-id="banner_module_itemIMG${order}" class="full_size img_cover" src="./public/images/logo/no_image-50x50.png" alt="">
                    </div>
                    <input type="hidden" name="banner_module_item[${order}][bannerPC]" id="banner_module_itemIMG${order}">
                    <div class="popover position_absolute" style="top: 84%;left: 41%;transform: translate(0);">
                        <div class="popover_content d_flex align_items_center">
                            <a style="padding: 6px 10px 7px 12px;margin-right: 3px;" href="./public/plugins/filemanager/dialog.php?type=1&field_id=banner_module_itemIMG${order}" type="button" data-id-input-image="banner_module_itemIMG${order}" class="button_image btn btn_primary iframe-btn" title="Thêm banner khuyến mãi">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <button type="button" style="padding: 7px 12px;" data-id-clear-img="banner_module_itemIMG${order}" class="button_clear btn btn_danger" title="Xóa ảnh này">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="form_control" type="number" name="banner_module_item[${order}][order]" value="${order+1}" placeholder="Sắp xếp" autocomplete="off" spellcheck="false">
                </td>
                <td>
                    <button type="button" class="btn btn_danger btnClear">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            </tr>`;
}
// ========== ########## END MAIN BANNER ########## ========== //

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