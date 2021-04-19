<style>.list_recomment{display:none;z-index: 10;top:0;left:0;width:100%;height:200px;overflow:auto;background-color:#fff;box-shadow:0 0 12px rgba(0,0,0,.12)}.list_recomment .list{position:relative;z-index:2}.list_recomment .item{font-family:tienichnhabep-mainFont-Light;font-size:.9rem;padding:4px 7px;cursor:pointer}.list_recomment .item:hover{background-color:#eee}</style>
<style>.form_load_action{margin-bottom:5px}.form_load{border-radius:0}.form_action{top:0;right:0;height:100%;padding:0 20px;border:1px solid #b3b3b3}.iframe_box{border:1px solid #b3b3b3}.iframe_box iframe{width: 100%!important; height: 100%!important;}</style>
<?php
{{ $base = new Base; }} ?>
<main class="main_content">
    <form action="" method="POST">
        <div class="page_header">
            <div class="container_fluid d_flex justify_content_between align_items_center">
                <div class="d_flex align_items_end">
                    <h1>Bố cục</h1>
                    <ol class="breadcrumb d_flex align_items_center">
                        <li>
                            <a href="">Trang chủ</a>
                        </li>
                        <li class="active">
                            <a href="">Cập nhật nhóm video trang chủ</a>
                        </li>
                    </ol>
                </div>
                <div class="d_flex align_items_center">
                    <button type="submit" <?php {{ echo empty($videoGroupItem) ? "disable" : null; }} ?> name="updateVideoGroup_action" class="btn_item btn btn_primary">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        <span>Lưu</span>
                    </button>
                    <a class="btn_item btn_default" href="VideoGroup">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        <span>Hủy</span>
                    </a>
                </div>
            </div>
        </div>
        <?php {{
            if(!empty($statusActionVideoGroup)) { ?>
                <div class="alert_wrap">
                    <div class="alert alert_<?php {{ echo $statusActionVideoGroup['status']; }}
                        ?> position_relative" data-status="<?php {{
                            if(!empty($statusActionVideoGroup['status']))
                            { echo "true"; }; }}
                        ?>">
                        <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                        <span><?php {{ echo $statusActionVideoGroup['notifiTxt']; }} ?></span>
                        <button type="button" class="close position_absolute">x</button>
                    </div>
                </div>
        <?php }  }} ?>
        <div class="alert_wrap">
            <div class="alert  position_relative" data-status="">
                <i class="fa fa-check-circle" style="margin-right: 5px;"></i>
                <span></span>
                <button type="button" class="close position_absolute">x</button>
            </div>
        </div>
        <div class="table_content container_fluid">
            <div class="panel_table">
                <div class="panel_heading">
                    <h2 class="panel_title">
                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                        <span>Cập nhật nhóm video</span>
                    </h2>
                </div>
                <div class="panel_body">
                    <form action="" method="POST">
                        <div id="table_content">
                            <div class="nav_tabs d_flex align_items_center">
                                <a class="tab_item active" href="#tab_general">Tổng quan</a>
                                <a class="tab_item" href="#tab_detail">Nội dung</a>
                            </div>
                            <div class="tab_content">
                                <div class="tab_pane" id="tab_general">
                                    <div class="form_group status_wrap d_flex align_items_center">
                                        <label for="status_value" class="form_label">Trạng thái</label>
                                        <div class="switch_status">
                                            <label for="status_value" class="status_toogle">
                                                <input type="checkbox" name="videoGroup_status" <?php {{
                                                    /*---------------------------------------------*/
                                                    if(!empty(Validation::setValue("videoGroup_status")))
                                                    { echo Validation::setValue("videoGroup_status") == "on" ? "checked" : null; }
                                                    else
                                                    { if(!empty($videoGroupItem['videoGroup_status'])) {
                                                        echo $videoGroupItem['videoGroup_status'] == "on" ? "checked" : null;
                                                    } }
                                                    /*---------------------------------------------*/
                                                }} ?> id="status_value" class="d_none">
                                                <span class="lever"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="content_group">
                                        <div class="form_group d_flex align_items_center">
                                            <label for="videoGroup_name" class="form_label"><span style="color: #f00;">*</span> Tên nhóm video</label>
                                            <div class="form_input">
                                                <input class="form_control" type="text" name="videoGroup_name" id="videoGroup_name" value="<?php {{
                                                    /*---------------------------------------------*/
                                                    if(!empty(Validation::setValue("videoGroup_name")))
                                                    { echo Validation::setValue("videoGroup_name"); }
                                                    else
                                                    { echo !empty($videoGroupItem['videoGroup_name']) ? $videoGroupItem['videoGroup_name'] : null; }
                                                    /*---------------------------------------------*/
                                                }} ?>" placeholder="Tên nhóm" autocomplete="off" spellcheck="false">
                                                <?php {{ echo Validation::formError("videoGroup_name"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="videoGroup_startDate" class="form_label"><span style="color: #f00;">*</span> Ngày bắt đầu</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" name="videoGroup_startDate" id="videoGroup_startDate" value="<?php {{
                                                    /*---------------------------------------------*/
                                                    if(Validation::setValue("videoGroup_startDate"))
                                                    { echo Validation::setValue("videoGroup_startDate"); }
                                                    else
                                                    { echo !empty($videoGroupItem['videoGroup_startDate']) ? Format::formatTimeDateInput($videoGroupItem['videoGroup_startDate']) : null; }
                                                    /*---------------------------------------------*/
                                                }} ?>" spellcheck="false">
                                                <?php {{ echo Validation::formError("videoGroup_startDate"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="" class="form_label"><span style="color: #f00;">*</span> Ngày kết thúc</label>
                                            <div class="form_input">
                                                <input class="form_control" type="date" name="videoGroup_endDate" id="videoGroup_endDate" value="<?php {{
                                                    /*---------------------------------------------*/
                                                    if(!empty(Validation::setValue("videoGroup_endDate")))
                                                    { echo Validation::setValue("videoGroup_endDate"); }
                                                    else
                                                    { echo !empty($videoGroupItem['videoGroup_endDate']) ? Format::formatTimeDateInput($videoGroupItem['videoGroup_endDate']) : null; }
                                                    /*---------------------------------------------*/
                                                }} ?>" spellcheck="false">
                                                <?php {{ echo Validation::formError("videoGroup_endDate"); }} ?>
                                            </div>
                                        </div>
                                        <div class="form_group d_flex align_items_center">
                                            <label for="videoGroup_order" class="form_label">Số thứ tự</label>
                                            <div class="form_input">
                                                <input class="form_control" type="number" name="videoGroup_order" id="videoGroup_order" value="<?php {{
                                                    /*---------------------------------------------*/
                                                    if(!empty(Validation::setValue("videoGroup_order")))
                                                    { echo Validation::setValue("videoGroup_order"); }
                                                    else
                                                    { echo !empty($videoGroupItem['videoGroup_order']) ? $videoGroupItem['videoGroup_order'] : null; }
                                                    /*---------------------------------------------*/
                                                }} ?>" placeholder="Thứ tự hiển thị" autocomplete="off" spellcheck="false">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab_pane" id="tab_detail">
                                    <div class="content_group">
                                        <div class="grid_row">
                                            <div class="grid_column_6 box_value_wrap">
                                                <div class="video_intro_box">
                                                    <div class="form_load_action position_relative">
                                                        <input class="form_control w_100 form_load valueLoadIfram" value="<?php {{
                                                            /*---------------------------------------------*/
                                                            echo !empty($videoGroupItem['video_iframe']) ? $videoGroupItem['video_iframe'] : null;
                                                            /*---------------------------------------------*/
                                                        }} ?>" spellcheck="false" autocomplete="off" placeholder="iframe video" type="text" id="video_iframe">
                                                        <input type="hidden" name="video_iframe" value="<?php {{
                                                            /*---------------------------------------------*/
                                                            echo !empty($videoGroupItem['video_iframe']) ? $videoGroupItem['video_iframe'] : null;
                                                            /*---------------------------------------------*/
                                                        }} ?>">
                                                        <button type="button" class="form_button position_absolute form_action btnLoadIframe">
                                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div style="height: 548px;" class="iframe_box">
                                                        <iframe src="<?php {{
                                                            /*---------------------------------------------*/
                                                            if(!empty(Validation::setValue("video_iframe")))
                                                            { echo html_entity_decode(Validation::setValue("video_iframe")); }
                                                            else
                                                            { echo !empty($videoGroupItem['video_iframe']) ? html_entity_decode($videoGroupItem['video_iframe']) : null; }
                                                            /*---------------------------------------------*/
                                                        }} ?>" frameborder="0"></iframe>
                                                    </div>
                                                    <?php {{ echo Validation::formError("video_iframe"); }} ?>
                                                </div>
                                            </div>
                                            <div class="grid_column_6">
                                                <div class="grid_row">
                                                    <div class="grid_column_6 box_value_wrap">
                                                        <div class="video_intro_box">
                                                            <div class="form_load_action position_relative">
                                                                <input class="form_control w_100 form_load video_prodId_ties_1_name" id="video_prodId_ties_1" name="video_prodId_ties_1[name]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_1")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_1")['name']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_1']) ? $videoGroupItem['video_prod_1']['prod_name'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>" spellcheck="false" autocomplete="off" placeholder="Chọn sản phẩm" type="text">
                                                                <input type="hidden" class="video_prodId_ties_1_id" name="video_prodId_ties_1[id]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_1")['id']))
                                                                    { echo Validation::setValue("video_prodId_ties_1")['id']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_1']) ? $videoGroupItem['video_prod_1']['prod_id'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <input type="hidden" class="video_prodId_ties_1_image" name="video_prodId_ties_1[image]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_1")['image']))
                                                                    { echo Validation::setValue("video_prodId_ties_1")['image']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_1']) ? $videoGroupItem['video_prod_1']['prod_avatar'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <div class="position_relative">
                                                                    <div id="spaceAppend_video_prodId_ties_1" class="list_recomment position_absolute" style="display: none;">
                                                                        <ul class="list"></ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" class="video_view_link w_100 h_100">
                                                                <div class="box_img position_relative">
                                                                    <img class="img img_cover full_size video_prodId_ties_1_src" src="<?php {{
                                                                        /*---------------------------------------------*/
                                                                        if(!empty(Validation::setValue("video_prodId_ties_1")['image']))
                                                                        { echo Validation::setValue("video_prodId_ties_1")['image']; }
                                                                        else
                                                                        { if(!empty($videoGroupItem['video_prod_1'])) {
                                                                            echo $videoGroupItem['video_prod_1']['prod_avatar'];
                                                                        } else { echo "./public/images/logo/no_image-50x50.png"; } }
                                                                        /*---------------------------------------------*/
                                                                    }} ?>" alt="" style="height: 265px;">
                                                                    <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                                                </div>
                                                                <h4 class="box_title video_prodId_ties_1_nameText"><?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_1")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_1")['name']; }
                                                                    else
                                                                    { if(!empty($videoGroupItem['video_prod_1'])) {
                                                                        echo $videoGroupItem['video_prod_1']['prod_name'];
                                                                    } else { echo "------------Tên sản phẩm------------"; } }
                                                                    /*---------------------------------------------*/
                                                                }} ?></h4>
                                                                <?php {{ echo Validation::formError("video_prodId_ties_1"); }} ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="grid_column_6 box_value_wrap">
                                                        <div class="video_intro_box">
                                                            <div class="form_load_action position_relative">
                                                                <input class="form_control w_100 form_load video_prodId_ties_2_name" id="video_prodId_ties_2" name="video_prodId_ties_2[name]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_2")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_2")['name']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_2']) ? $videoGroupItem['video_prod_2']['prod_name'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>" spellcheck="false" autocomplete="off" placeholder="Chọn sản phẩm" type="text">
                                                                <input type="hidden" class="video_prodId_ties_2_id" name="video_prodId_ties_2[id]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_2")['id']))
                                                                    { echo Validation::setValue("video_prodId_ties_2")['id']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_2']) ? $videoGroupItem['video_prod_2']['prod_id'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <input type="hidden" class="video_prodId_ties_2_image" name="video_prodId_ties_2[image]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_2")['image']))
                                                                    { echo Validation::setValue("video_prodId_ties_2")['image']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_2']) ? $videoGroupItem['video_prod_2']['prod_avatar'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <div class="position_relative">
                                                                    <div id="spaceAppend_video_prodId_ties_2" class="list_recomment position_absolute" style="display: none;">
                                                                        <ul class="list"></ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" class="video_view_link w_100 h_100">
                                                                <div class="box_img position_relative">
                                                                    <img class="img img_cover full_size video_prodId_ties_2_src" src="<?php {{
                                                                        /*---------------------------------------------*/
                                                                        if(!empty(Validation::setValue("video_prodId_ties_2")['image']))
                                                                        { echo Validation::setValue("video_prodId_ties_2")['image']; }
                                                                        else
                                                                        { echo !empty($videoGroupItem['video_prod_2']) ? $videoGroupItem['video_prod_2']['prod_avatar'] : "./public/images/logo/no_image-50x50.png"; }
                                                                        /*---------------------------------------------*/
                                                                    }} ?>" alt="" style="height: 265px;">
                                                                    <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                                                </div>
                                                                <h4 class="box_title video_prodId_ties_2_nameText"><?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_2")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_2")['name']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_2']) ? $videoGroupItem['video_prod_2']['prod_name'] : "------------Tên sản phẩm-----------"; }
                                                                    /*---------------------------------------------*/
                                                                }} ?></h4>
                                                                <?php {{ echo Validation::formError("video_prodId_ties_2"); }} ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="grid_column_6 box_value_wrap">
                                                        <div class="video_intro_box">
                                                            <div class="form_load_action position_relative">
                                                                <input class="form_control w_100 form_load video_prodId_ties_3_name" id="video_prodId_ties_3" name="video_prodId_ties_3[name]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_3")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_3")['name']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_3']) ? $videoGroupItem['video_prod_3']['prod_name'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>" spellcheck="false" autocomplete="off" placeholder="Chọn sản phẩm" type="text">
                                                                <input type="hidden" class="video_prodId_ties_3_id" name="video_prodId_ties_3[id]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_3")['id']))
                                                                    { echo Validation::setValue("video_prodId_ties_3")['id']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_3']) ? $videoGroupItem['video_prod_3']['prod_id'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <input type="hidden" class="video_prodId_ties_3_image" name="video_prodId_ties_3[image]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_3")['image']))
                                                                    { echo Validation::setValue("video_prodId_ties_3")['image']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_3']) ? $videoGroupItem['video_prod_3']['prod_avatar'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <div class="position_relative">
                                                                    <div id="spaceAppend_video_prodId_ties_3" class="list_recomment position_absolute" style="display: none;">
                                                                        <ul class="list"></ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" class="video_view_link w_100 h_100">
                                                                <div class="box_img position_relative">
                                                                    <img class="img img_cover full_size video_prodId_ties_3_src" src="<?php {{
                                                                        /*---------------------------------------------*/
                                                                        if(!empty(Validation::setValue("video_prodId_ties_3")['image']))
                                                                        { echo Validation::setValue("video_prodId_ties_3")['image']; }
                                                                        else
                                                                        { echo !empty($videoGroupItem['video_prod_3']) ? $videoGroupItem['video_prod_3']['prod_avatar'] : "./public/images/logo/no_image-50x50.png"; }
                                                                        /*---------------------------------------------*/
                                                                    }} ?>" alt="" style="height: 265px;">
                                                                    <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                                                </div>
                                                                <h4 class="box_title video_prodId_ties_3_nameText"><?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_3")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_3")['name']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_3']) ? $videoGroupItem['video_prod_3']['prod_name'] : "------------Tên sản phẩm-----------"; }
                                                                    /*---------------------------------------------*/
                                                                }} ?></h4>
                                                                <?php {{ echo Validation::formError("video_prodId_ties_3"); }} ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="grid_column_6 box_value_wrap">
                                                        <div class="video_intro_box">
                                                            <div class="form_load_action position_relative">
                                                                <input class="form_control w_100 form_load video_prodId_ties_4_name" id="video_prodId_ties_4" name="video_prodId_ties_4[name]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_4")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_4")['name']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_4']) ? $videoGroupItem['video_prod_4']['prod_name'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>" spellcheck="false" autocomplete="off" placeholder="Chọn sản phẩm" type="text">
                                                                <input type="hidden" class="video_prodId_ties_4_id" name="video_prodId_ties_4[id]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_4")['id']))
                                                                    { echo Validation::setValue("video_prodId_ties_4")['id']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_4']) ? $videoGroupItem['video_prod_4']['prod_id'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <input type="hidden" class="video_prodId_ties_4_image" name="video_prodId_ties_4[image]" value="<?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_4")['image']))
                                                                    { echo Validation::setValue("video_prodId_ties_4")['image']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_4']) ? $videoGroupItem['video_prod_4']['prod_avatar'] : null; }
                                                                    /*---------------------------------------------*/
                                                                }} ?>">
                                                                <div class="position_relative">
                                                                    <div id="spaceAppend_video_prodId_ties_4" class="list_recomment position_absolute" style="display: none;">
                                                                        <ul class="list"></ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" class="video_view_link w_100 h_100">
                                                                <div class="box_img position_relative">
                                                                    <img class="img img_cover full_size video_prodId_ties_4_src" src="<?php {{
                                                                        /*---------------------------------------------*/
                                                                        if(!empty(Validation::setValue("video_prodId_ties_4")['image']))
                                                                        { echo Validation::setValue("video_prodId_ties_4")['image']; }
                                                                        else
                                                                        { echo !empty($videoGroupItem['video_prod_4']) ? $videoGroupItem['video_prod_4']['prod_avatar'] : "./public/images/logo/no_image-50x50.png"; }
                                                                        /*---------------------------------------------*/
                                                                    }} ?>" alt="" style="height: 265px;">
                                                                    <i class="icon fa fa-play position_absolute" aria-hidden="true"></i>
                                                                </div>
                                                                <h4 class="box_title video_prodId_ties_4_nameText"><?php {{
                                                                    /*---------------------------------------------*/
                                                                    if(!empty(Validation::setValue("video_prodId_ties_4")['name']))
                                                                    { echo Validation::setValue("video_prodId_ties_4")['name']; }
                                                                    else
                                                                    { echo !empty($videoGroupItem['video_prod_4']) ? $videoGroupItem['video_prod_4']['prod_name'] : "------------Tên sản phẩm-----------"; }
                                                                    /*---------------------------------------------*/
                                                                }} ?></h4>
                                                                <?php {{ echo Validation::formError("video_prodId_ties_4"); }} ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/config/jquery.min.js"); }} ?>"></script>
<script type="text/javascript" src="<?php {{ echo $base->getBaseURLAdmin("public/js/app/addVideoGroup.ajax.js"); }} ?>"></script>
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