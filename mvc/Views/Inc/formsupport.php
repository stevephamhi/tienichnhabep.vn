<div class="modal_loader">
    <div class="loader_img position_relative">
        <span class="thumbNail">
            <img class="full_size" src="<?php {{ echo Config::getBaseUrlClient("public/images/icon/logo_mini.png"); }} ?>" alt="">
        </span>
        <div class="loader_move position_absolute">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</div>
<div class="box_support_phone">
    <div class="box_support_title">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <span>TƯ VẤN MIỄN PHÍ</span>
    </div>
    <div class="box_support_body">
        <form action="" class="form_data_support_customer grid_row justify_content_between">
            <input type="hidden" id="prod_id_tis_sp_ctm" data-id="<?php {{ echo $prod_id; }} ?>">
            <div class="grid_column_12">
                <label for="gender_support_male">
                    <input type="radio" class="gender_support" name="gender_support[]" id="gender_support_male" value="male">
                    <span>Anh</span>
                </label>
                <label for="gender_support_female">
                    <input type="radio" class="gender_support" name="gender_support[]" id="gender_support_female" value="female">
                    <span>Chị</span>
                </label>
                <span class="gender_sp_error error_form"></span>
            </div>
            <div class="form_group">
                <input type="text" class="form_control w_100" name="fullname_support" placeholder="Nhập họ tên ..." autocomplete="off" spellcheck="false">
                <span class="fullname_sp_error error_form"></span>
            </div>
            <div class="form_group">
                <input type="text" class="form_control w_100" name="phone_support" placeholder="Nhập số điện thoại ..." autocomplete="off" spellcheck="false">
                <span class="phone_sp_error error_form"></span>
            </div>
            <div class="form_submit">
                <button type="submit" class="form_button w_100">NHẬN TƯ VẤN</button>
            </div>
        </form>
    </div>
    <div class="modal_notification_process_regis">
        <div class="modal_notification_mask"></div>
        <div class="modal_notification_content">
            <div class="status d_flex align_items_center">
                <i class="fa fa-check-square-o" aria-hidden="true"></i>
                <span>Đăng ký thành công</span>
            </div>
            <div class="content">Đội ngũ nhân viên tiện ích nhà bếp sẽ liên hệ lại với bạn trong thời gian ngắn nhất</div>
            <a href="tel:0708070827" class="hotline"><strong style="color: #f00;">*</strong> Mọi thắc mắc LH: 0708 0708 27</a>
        </div>
    </div>
</div>
<style>
    .modal_notification_process_regis{position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.7);z-index:1000000;justify-content:center;align-items:center;display:none}.modal_notification_process_regis.open{display:flex}.modal_notification_mask{position:absolute;width:100%;height:100%;top:0;left:0}.modal_notification_content{position:relative;width:300px;background-color:#fff;border-radius:3px;overflow:hidden}.modal_notification_content .status{font-family:tienitnhabep-mainFont-Bold;padding:7px 5px;background-color:#eee;color:#03a9f4;font-size:1.2rem;display:flex;justify-content:center;margin-bottom:4px}.modal_notification_content .status .fa{color:#03a9f4;font-size:1.5rem;margin-right:5px}.modal_notification_content .content{padding:5px;text-align:center}.modal_notification_content .hotline{color:#03a9f4;padding:4px 10px;text-align:center}.box_support_phone{background-color:#eee;padding:5px 10px;border-radius:3px}.box_support_phone .box_support_title{margin-bottom:1px}.box_support_phone .box_support_body{background-color:#f7f7f7;padding:5px;border-radius:3px}.box_support_phone .box_support_body .form_control{border-radius:3px;font-size:1rem;padding:5px 7px}@media screen and (min-width:320px){.box_support_phone .box_support_body .form_group,.box_support_phone .box_support_body .form_submit{flex:0 0 100%;max-width:100%;margin:4px 0}}@media screen and (min-width:768px){.box_support_phone .box_support_body .form_group{flex:0 0 39%;max-width:39%;margin:0 0}.box_support_phone .box_support_body .form_submit{flex:0 0 20%;max-width:20%;margin:0 0}}.box_support_phone .box_support_body .form_button{background-color:#00bcd4;color:#fff;padding:5px 5px;border:1px solid #00bcd4;border-radius:3px;height:30px}
</style>
<script src="<?php {{ echo Config::getBaseUrlClient("public/js/config/jquery.min.js"); }} ?>"></script>
<script src="<?php {{ echo Config::getBaseUrlClient("public/js/app/formsupport.ajax.js"); }} ?>"></script>