<style>.list_recomment{display:none;top:0;left:0;width:100%;height:200px;overflow:auto;background-color:#fff;box-shadow:0 0 12px rgba(0,0,0,.12)}.list_recomment .list{position:relative;z-index:2}.list_recomment .item{font-family:tienichnhabep-mainFont-Light;font-size:.9rem;padding:4px 7px;cursor:pointer}.list_recomment .item:hover{background-color:#eee}</style>
<?php {{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Bố cục</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="Home">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="javascipt:;">Cập nhật bố cục</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($displayItem) ? "disable" : null; }} ?> name="updateDisplay_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="Display">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php if(!empty($statusActionDisplay)) : ?>
            <div class="alert_wrap">
                <div class="alert alert_<?php {{ echo $statusActionDisplay['status']; }}
                    ?> position_relative" data-status="<?php {{
                        if(!empty($statusActionDisplay['status']))
                        { echo "true"; }; }}
                    ?>">
                    <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                    <span><?php {{ echo $statusActionDisplay['notifiTxt']; }} ?></span>
                    <button type="button" class="close position_absolute">x</button>
                </div>
            </div>
        <?php endif; ?>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-pencil"></i>
                        <span>Thêm bố cục</span>
                    </h2>
                </div>
                <?php if( !empty($displayItem) ) : ?>
                    <div class="panel_body">
                        <form action="" method="POST">
                            <div id="table_content">
                                <div class="nav_tabs d_flex align_items_center">
                                    <a class="tab_item active" href="#tab_general">Tổng quan</a>
                                    <a class="tab_item" href="#tab_links">Liên kết</a>
                                </div>
                                <div class="tab_content">
                                    <div class="tab_pane" id="tab_general">
                                        <div class="form_group status_wrap d_flex align_items_center">
                                            <label for="status_value" class="form_label">Trạng thái</label>
                                            <div class="switch_status">
                                                <label for="status_value" class="status_toogle">
                                                    <input type="checkbox" <?php {{
                                                        /*---------------------------------------------*/
                                                        if(!empty(Validation::setValue("display_status")))
                                                        { echo Validation::setValue("display_status") == "on" ? "checked" : null; }
                                                        else
                                                        { if(!empty($displayItem['display_status'])) {
                                                            echo $displayItem['display_status'] == "on" ? "checked" : null;
                                                        } }
                                                        /*---------------------------------------------*/
                                                    }} ?> name="display_status" id="status_value" class="d_none">
                                                    <span class="lever"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="content_group">
                                            <div class="form_group d_flex align_items_center">
                                                <label for="display_title" class="form_label"><span style="color: #f00;">*</span> Tên bố cục</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="display_title" id="display_title" value="<?php {{
                                                        /*---------------------------------------------*/
                                                        if(!empty(Validation::setValue("display_title")))
                                                        { echo Validation::setValue("display_title"); }
                                                        else
                                                        { echo !empty($displayItem['display_title']) ? $displayItem['display_title'] : null; }
                                                        /*---------------------------------------------*/
                                                    }} ?>" placeholder="Tên nhóm" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("display_title"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="display_order" class="form_label"><span style="color: #f00;">*</span>Số thứ tự</label>
                                                <div class="form_input">
                                                    <input class="form_control" type="text" name="display_order" id="display_order" value="<?php {{
                                                        /*---------------------------------------------*/
                                                        if(!empty(Validation::setValue("display_order")))
                                                        { echo Validation::setValue("display_order"); }
                                                        else
                                                        { echo !empty($displayItem['display_order']) ? $displayItem['display_order'] : null; }
                                                        /*---------------------------------------------*/
                                                    }} ?>" placeholder="Số thứ tự" autocomplete="off" spellcheck="false">
                                                    <?php {{ echo Validation::formError("display_order"); }} ?>
                                                </div>
                                            </div>
                                            <div class="form_group d_flex align_items_center">
                                                <label for="display_order" class="form_label"><span style="color: #f00;">*</span>Loại bố cục (default: Mặc định)</label>
                                                <div class="form_input">
                                                    <label for="display_type_nornal">
                                                        <input type="radio" class="display_type_option" name="display_type[]" <?php {{
                                                            /*---------------------------------------------*/
                                                            if(!empty(Validation::setValue("display_type")))
                                                            { echo Validation::setValue("display_type") == "normal" ? "checked" : null; }
                                                            else
                                                            { if(!empty($displayItem['display_type'])) {
                                                                echo $displayItem['display_type'] == "normal" ? "checked" : null;
                                                            } }
                                                            /*---------------------------------------------*/
                                                        }} ?> value="normal" id="display_type_nornal">
                                                        <span>Mặc định</span>
                                                    </label>
                                                    <label for="display_type_carousel">
                                                        <input type="radio" class="display_type_option" name="display_type[]" <?php {{
                                                            /*---------------------------------------------*/
                                                            if(!empty(Validation::setValue("display_type")))
                                                            { echo Validation::setValue("display_type") == "carousel" ? "checked" : null; }
                                                            else
                                                            { if(!empty($displayItem['display_type'])) {
                                                                echo $displayItem['display_type'] == "carousel" ? "checked" : null;
                                                            } }
                                                            /*---------------------------------------------*/
                                                        }} ?> value="carousel" id="display_type_carousel">
                                                        <span>Slider</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab_pane" id="tab_links">
                                        <div class="form_group d_flex">
                                            <label for="" class="form_label" title="Danh mục chính">
                                                <span style="color: #f00;">*</span>
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
                                                                            if(!empty($displayItem['display_cateProdId_main_ties'])) {
                                                                                echo $displayItem['display_cateProdId_main_ties'] == $cateProdItem['cateProd_id'] ? "checked" : null;
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
                                                <?php {{ echo Validation::formError("cateProd_main"); }} ?>
                                                <div class="list_button d_flex align_items_center">
                                                    <a href="" class="btn btn_warning" data-clear-btn="cateProd_main">Bỏ chọn</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex">
                                            <label for="" class="form_label" title="Liên kết nhanh đến danh mục">
                                                <span style="color: #f00;">*</span>
                                                <span>Danh mục liên kết</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input" id="block_cateProd_relay">
                                                <div class="grid_row">
                                                    <div class="grid_column_6">
                                                        <div class="form_list_wrap" style="margin-top: 10px;">
                                                            <select name="select_cateProd_rela" class="form_control" id="">
                                                                <option value="">-- Chọn danh mục --</option>
                                                                <?php if(!empty($listCateProd)) : ?>
                                                                    <?php foreach($listCateProd as $cateProdItem) : ?>
                                                                        <option value="<?php {{ echo $cateProdItem['cateProd_id']; }} ?>"><?php {{ echo str_repeat("-----", $cateProdItem['level']); }} {{ echo $cateProdItem['cateProd_name']; }} ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value="">Chưa có danh mục sản phẩm nào</option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <div class="list" style="height: 187px; overflow: auto; margin-top: 10px;">
                                                                <?php if(!empty(Validation::setValue("cateProd_rela"))) : ?>
                                                                    <?php foreach(Validation::setValue("cateProd_rela") as $cateProd_rela_item) : ?>
                                                                        <label for="cateProd_rela_<?php {{ echo $cateProd_rela_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                            <input type="checkbox" data-option-item="cateProd_rela" checked value="<?php {{ echo $cateProd_rela_item['id']; }} ?>" id="cateProd_rela_<?php {{ echo $cateProd_rela_item['id']; }} ?>">
                                                                            <span><?php {{ echo $cateProd_rela_item['name']; }} ?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <?php if(!empty($display_cateProdId_list_ties)) : ?>
                                                                        <?php foreach($display_cateProdId_list_ties as $cateProd_rela_item) : ?>
                                                                            <label for="cateProd_rela_<?php {{ echo $cateProd_rela_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                                <input type="checkbox" data-option-item="cateProd_rela" checked value="<?php {{ echo $cateProd_rela_item['id']; }} ?>" id="cateProd_rela_<?php {{ echo $cateProd_rela_item['id']; }} ?>">
                                                                                <span><?php {{ echo $cateProd_rela_item['name']; }} ?></span>
                                                                            </label>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form_list_wrap grid_column_6" style="height: 260.5px; margin-top: 10px;">
                                                        <ul class="list_content">
                                                            <?php if(!empty(Validation::setValue("cateProd_rela"))) : ?>
                                                                <?php $orderRow = 0; foreach(Validation::setValue("cateProd_rela") as $cateProd_rela_item) : $orderRow ++; ?>
                                                                    <li class="item">
                                                                        <span><?php {{ echo $cateProd_rela_item['name']; }} ?></span>
                                                                        <span class="close" data-name="cateProd_rela" data-id="<?php {{ echo $cateProd_rela_item['id']; }} ?>"></span>
                                                                        <input type="hidden" name="cateProd_rela[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $cateProd_rela_item['id']; }} ?>">
                                                                        <input type="hidden" name="cateProd_rela[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $cateProd_rela_item['name']; }} ?>">
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php else : ?>
                                                                <?php if(!empty($display_cateProdId_list_ties)) : ?>
                                                                    <?php $orderRow = 0; foreach($display_cateProdId_list_ties as $cateProd_rela_item) : $orderRow ++; ?>
                                                                        <li class="item">
                                                                            <span><?php {{ echo $cateProd_rela_item['name']; }} ?></span>
                                                                            <span class="close" data-name="cateProd_rela" data-id="<?php {{ echo $cateProd_rela_item['id']; }} ?>"></span>
                                                                            <input type="hidden" name="cateProd_rela[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $cateProd_rela_item['id']; }} ?>">
                                                                            <input type="hidden" name="cateProd_rela[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $cateProd_rela_item['name']; }} ?>">
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php {{ echo Validation::formError("cateProd_rela"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex" data-option-display="normal">
                                            <label for="" class="form_label" title="Nhấn để chọn danh mục">
                                                <span style="color: #f00;">*</span>
                                                <span>Sản phẩm nổi bậc</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input" id="block_prod_highlight">
                                                <div class="grid_row">
                                                    <div class="grid_column_6">
                                                        <div class="form_list_wrap" style="margin-top: 10px;">
                                                            <select name="select_prod_highlight" class="form_control" id="">
                                                                <option value="">-- Chọn danh mục --</option>
                                                                <?php if(!empty($listCateProd)) : ?>
                                                                    <?php foreach($listCateProd as $cateProdItem) : ?>
                                                                        <option value="<?php {{ echo $cateProdItem['cateProd_id']; }} ?>"><?php {{ echo str_repeat("-----", $cateProdItem['level']); }} {{ echo $cateProdItem['cateProd_name']; }} ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <option value="">Chưa có danh mục sản phẩm nào</option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <div class="list" style="height: 187px; overflow: auto; margin-top: 10px;">
                                                                <?php if( !empty(Validation::setValue("prod_highlight")) ) : ?>
                                                                    <?php foreach(Validation::setValue("prod_highlight") as $prod_highlight_item) : ?>
                                                                        <label for="prod_highlight_<?php {{ echo $prod_highlight_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                            <input type="checkbox" data-option-item="prod_highlight" checked value="<?php {{ echo $prod_highlight_item['id']; }} ?>" id="prod_highlight_<?php {{ echo $prod_highlight_item['id']; }} ?>">
                                                                            <span><?php {{ echo $prod_highlight_item['name']; }} ?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <?php if(!empty($display_prodId_highlight_list_ties)) : ?>
                                                                        <?php foreach($display_prodId_highlight_list_ties as $prod_highlight_item) : ?>
                                                                            <label for="prod_highlight_<?php {{ echo $prod_highlight_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                                <input type="checkbox" data-option-item="prod_highlight" checked value="<?php {{ echo $prod_highlight_item['id']; }} ?>" id="prod_highlight_<?php {{ echo $prod_highlight_item['id']; }} ?>">
                                                                                <span><?php {{ echo $prod_highlight_item['name']; }} ?></span>
                                                                            </label>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form_list_wrap grid_column_6" style="height: 260.5px; margin-top: 10px;">
                                                        <ul class="list_content">
                                                            <?php if(!empty(Validation::setValue("prod_highlight"))) : ?>
                                                                <?php $orderRow = 0; foreach(Validation::setValue("prod_highlight") as $prod_highlight_item) : $orderRow ++; ?>
                                                                    <li class="item">
                                                                        <span><?php {{ echo $prod_highlight_item['name']; }} ?></span>
                                                                        <span class="close" data-name="prod_highlight" data-id="<?php {{ echo $prod_highlight_item['id']; }} ?>"></span>
                                                                        <input type="hidden" name="prod_highlight[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $prod_highlight_item['id']; }} ?>">
                                                                        <input type="hidden" name="prod_highlight[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $prod_highlight_item['name']; }} ?>">
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <?php if(!empty($display_prodId_highlight_list_ties)) : ?>
                                                                    <?php $orderRow = 0; foreach($display_prodId_highlight_list_ties as $prod_highlight_item) : $orderRow ++; ?>
                                                                        <li class="item">
                                                                            <span><?php {{ echo $prod_highlight_item['name']; }} ?></span>
                                                                            <span class="close" data-name="prod_highlight" data-id="<?php {{ echo $prod_highlight_item['id']; }} ?>"></span>
                                                                            <input type="hidden" name="prod_highlight[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $prod_highlight_item['id']; }} ?>">
                                                                            <input type="hidden" name="prod_highlight[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $prod_highlight_item['name']; }} ?>">
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php {{ echo Validation::formError("prod_highlight"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex">
                                            <label for="" class="form_label" title="Nhấn để chọn danh mục">
                                                <span style="color: #f00;">*</span>
                                                <span>Sản phẩm hiển thị chung</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input" id="block_prod_normal">
                                                <div class="grid_row">
                                                    <div class="grid_column_6">
                                                        <div class="form_list_wrap" style="margin-top: 10px;">
                                                            <select name="select_prod_normal" class="form_control" id="">
                                                                <option value="">-- Chọn danh mục --</option>
                                                                <?php if(!empty($listCateProd)) : ?>
                                                                    <?php foreach($listCateProd as $cateProdItem) : ?>
                                                                        <option value="<?php {{ echo $cateProdItem['cateProd_id']; }} ?>"><?php {{ echo str_repeat("-----", $cateProdItem['level']); }} {{ echo $cateProdItem['cateProd_name']; }} ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <option value="">Chưa có danh mục sản phẩm nào</option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <div class="list" style="height: 187px; overflow: auto; margin-top: 10px;">
                                                                <?php if(!empty(Validation::setValue("prod_normal"))) : ?>
                                                                    <?php foreach(Validation::setValue("prod_normal") as $prod_normal_item) : ?>
                                                                        <label for="prod_normal_<?php {{ echo $prod_normal_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                            <input type="checkbox" data-option-item="prod_normal" checked value="<?php {{ echo $prod_normal_item['id']; }} ?>" id="prod_normal_<?php {{ echo $prod_normal_item['id']; }} ?>">
                                                                            <span><?php {{ echo $prod_normal_item['name']; }} ?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <?php if(!empty($display_prodId_normal_list_ties)) : ?>
                                                                        <?php foreach($display_prodId_normal_list_ties as $prod_normal_item) : ?>
                                                                            <label for="prod_normal_<?php {{ echo $prod_normal_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                                <input type="checkbox" data-option-item="prod_normal" checked value="<?php {{ echo $prod_normal_item['id']; }} ?>" id="prod_normal_<?php {{ echo $prod_normal_item['id']; }} ?>">
                                                                                <span><?php {{ echo $prod_normal_item['name']; }} ?></span>
                                                                            </label>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form_list_wrap grid_column_6" style="height: 260.5px; margin-top: 10px;">
                                                        <ul class="list_content">
                                                            <?php if(!empty(Validation::setValue("prod_normal"))) : ?>
                                                                <?php $orderRow = 0; foreach(Validation::setValue("prod_normal") as $prod_normal_item) : $orderRow ++; ?>
                                                                    <li class="item">
                                                                        <span><?php {{ echo $prod_normal_item['name']; }} ?></span>
                                                                        <span class="close" data-name="prod_normal" data-id="<?php {{ echo $prod_normal_item['id']; }} ?>"></span>
                                                                        <input type="hidden" name="prod_normal[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $prod_normal_item['id']; }} ?>">
                                                                        <input type="hidden" name="prod_normal[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $prod_normal_item['name']; }} ?>">
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <?php if(!empty($display_prodId_normal_list_ties)) : ?>
                                                                    <?php $orderRow = 0; foreach($display_prodId_normal_list_ties as $prod_normal_item) : $orderRow ++; ?>
                                                                        <li class="item">
                                                                            <span><?php {{ echo $prod_normal_item['name']; }} ?></span>
                                                                            <span class="close" data-name="prod_normal" data-id="<?php {{ echo $prod_normal_item['id']; }} ?>"></span>
                                                                            <input type="hidden" name="prod_normal[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $prod_normal_item['id']; }} ?>">
                                                                            <input type="hidden" name="prod_normal[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $prod_normal_item['name']; }} ?>">
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php {{ echo Validation::formError("prod_normal"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex" data-option-display="normal">
                                            <label for="" class="form_label" title="Nhấn để chọn danh mục">
                                                <span style="color: #f00;">*</span>
                                                <span>Sản phẩm hiển thị điện thoại</span>
                                                <i class="fa fa-question-circle" style="color: #1E91CF;" aria-hidden="true"></i>
                                            </label>
                                            <div class="form_input" id="block_prod_mobile">
                                                <div class="grid_row">
                                                    <div class="grid_column_6">
                                                        <div class="form_list_wrap" style="margin-top: 10px;">
                                                            <select name="select_prod_mobile" class="form_control" id="">
                                                                <option value="">-- Chọn danh mục --</option>
                                                                <?php if(!empty($listCateProd)) : ?>
                                                                    <?php foreach($listCateProd as $cateProdItem) : ?>
                                                                        <option value="<?php {{ echo $cateProdItem['cateProd_id']; }} ?>"><?php {{ echo str_repeat("-----", $cateProdItem['level']); }} {{ echo $cateProdItem['cateProd_name']; }} ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <option value="">Chưa có danh mục sản phẩm nào</option>
                                                                <?php endif; ?>
                                                            </select>
                                                            <div class="list" style="height: 187px; overflow: auto; margin-top: 10px;">
                                                                <?php if(!empty(Validation::setValue("prod_mobile"))) : ?>
                                                                    <?php $orderRow = 0; foreach(Validation::setValue("prod_mobile") as $prod_mobile_item) : $orderRow ++; ?>
                                                                        <label for="prod_mobile_<?php {{ echo $prod_mobile_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                            <input type="checkbox" data-option-item="prod_mobile" checked value="<?php {{ echo $prod_mobile_item['id']; }} ?>" id="prod_mobile_<?php {{ echo $prod_mobile_item['id']; }} ?>">
                                                                            <span><?php {{ echo $prod_mobile_item['name']; }} ?></span>
                                                                        </label>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <?php if(!empty($display_prodId_mobile_list_ties)) : ?>
                                                                        <?php foreach($display_prodId_mobile_list_ties as $prod_mobile_item) : ?>
                                                                            <label for="prod_mobile_<?php {{ echo $prod_mobile_item['id']; }} ?>" class="item d_flex align_items_center">
                                                                                <input type="checkbox" data-option-item="prod_mobile" checked value="<?php {{ echo $prod_mobile_item['id']; }} ?>" id="prod_mobile_<?php {{ echo $prod_mobile_item['id']; }} ?>">
                                                                                <span><?php {{ echo $prod_mobile_item['name']; }} ?></span>
                                                                            </label>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form_list_wrap grid_column_6" style="height: 260.5px; margin-top: 10px;">
                                                        <ul class="list_content">
                                                            <?php if(!empty(Validation::setValue("prod_mobile"))) : ?>
                                                                <?php $orderRow = 0; foreach(Validation::setValue("prod_mobile") as $prod_mobile_item) : $orderRow ++; ?>
                                                                    <li class="item">
                                                                        <span><?php {{ echo $prod_mobile_item['name']; }} ?></span>
                                                                        <span class="close" data-name="prod_mobile" data-id="<?php {{ echo $prod_mobile_item['id']; }} ?>"></span>
                                                                        <input type="hidden" name="prod_mobile[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $prod_mobile_item['id']; }} ?>">
                                                                        <input type="hidden" name="prod_mobile[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $prod_mobile_item['name']; }} ?>">
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <?php if(!empty($display_prodId_mobile_list_ties)) : ?>
                                                                    <?php $orderRow = 0; foreach($display_prodId_mobile_list_ties as $prod_mobile_item) : $orderRow ++; ?>
                                                                        <li class="item">
                                                                            <span><?php {{ echo $prod_mobile_item['name']; }} ?></span>
                                                                            <span class="close" data-name="prod_mobile" data-id="<?php {{ echo $prod_mobile_item['id']; }} ?>"></span>
                                                                            <input type="hidden" name="prod_mobile[<?php {{ echo $orderRow; }} ?>][id]" value="<?php {{ echo $prod_mobile_item['id']; }} ?>">
                                                                            <input type="hidden" name="prod_mobile[<?php {{ echo $orderRow; }} ?>][name]" value="<?php {{ echo $prod_mobile_item['name']; }} ?>">
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php {{ echo Validation::formError("prod_mobile"); }} ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else : ?>
                    <p class="data_empty_notification">Bố này này đã bị xóa hoặc không tồn tại !</p>
                <?php endif; ?>
            </div>
        </div>
    </form>
</main>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addDisplay.ajax.js"); }} ?>"></script>
<script>
    let listSelectBtn = document.querySelectorAll("[data-select-btn]");
    let listClearBtn  = document.querySelectorAll("[data-clear-btn]");
    listSelectBtn.forEach(el => {
        el.addEventListener('click', function() {
            event.preventDefault();
            let optionItem = this.getAttribute("data-select-btn");
            let listOption = document.querySelectorAll("[data-option-item='"+(optionItem)+"']");
            listOption.forEach(item => {
                item.checked = true;
            });
        });
    });
    listClearBtn.forEach(el => {
        el.addEventListener('click', function() {
            event.preventDefault();
            let optionItem = this.getAttribute("data-clear-btn");
            let listOption = document.querySelectorAll("[data-option-item='"+(optionItem)+"']");
            listOption.forEach(item => {
                item.checked = false;
            });
        });
    });
</script>
<script>
    let displayType_default = "normal";
    let blockDisplay        = document.querySelectorAll("[data-option-display]");
    let optionSelectDisplayType = document.querySelectorAll(".display_type_option");
    optionSelectDisplayType.forEach(el => {
        el.addEventListener('change', function() {
            displayType_default = this.value;
            handleDisableOption(displayType_default);
        });
    });
    handleDisableOption(displayType_default);
    function handleDisableOption(display_type) {
        blockDisplay.forEach(el => {
            el.setAttribute("data-option-display",display_type);
        });
    }
</script>
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