<div class="container_user">
    <div class="logoUser_wrap">
        <div class="logo_wrap">
            <img width="300" style="margin: 0 auto;" src="./public/images/logo/logo_full.png" alt="">
        </div>
    </div>
    <div class="formLogin_wrap">
        <form action="./User/Login" method="POST" id="formLogin">
            <div class="form_group">
                <label for="username" class="form_label">* Tên đăng nhập hoặc email</label>
                <div class="form_value position_relative">
                    <div class="addon_input position_absolute"><i class="fa fa-user" aria-hidden="true"></i></div>
                    <input type="text" class="form_control" name="username" id="username" value="<?php {{ echo Validation::setValue("username"); }} ?>" placeholder="Tên đăng nhập hoặc email" autocomplete="off" spellcheck="false">
                </div>
                <span class="error error_username"></span>
                <?php {{ echo Validation::formError("fullname"); }} ?>
            </div>
            <div class="form_group">
                <label for="password" class="form_label">* Mật khẩu</label>
                <div class="form_value position_relative">
                    <div class="addon_input position_absolute"><i class="fa fa-lock" aria-hidden="true"></i></div>
                    <input type="password" class="form_control" name="password" id="password" value="" placeholder="Mật khẩu" autocomplete="off" spellcheck="false">
                </div>
                <span class="error error_password"></span>
                <?php {{ echo Validation::formError("password"); }} ?>
            </div>
            <div class="statusLogin error" style="width: 320px;"><?php {{ echo Validation::formError("statusLogin"); }} ?></div>
            <div class="form_group d_flex justify_content_between align_items_center">
                <a href="" class="help_user">Quên mật khẩu?</a>
            </div>
            <div class="form_group">
                <button type="submit" class="form_button" name="loginAddminAction">
                    <span>ĐĂNG NHẬP</span>
                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="copyright">
        <p>© Copyright <a href="" class="d_inline">tienichnhabep</a></p>
    </div>
    <script type="module" src="<?php {{ $base->getBaseURLAdmin("public/js/app/login.js"); }} ?>"></script>
</div>