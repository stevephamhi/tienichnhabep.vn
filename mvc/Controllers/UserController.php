<?php

class UserController extends BaseController
{
    private $ConfigModel;
    private $CustomerModel;
    private $customerItem;
    private $OrderModel;
    private $ProductModel;

    public function __construct()
    {
        $this->ConfigModel   = $this->model("ConfigModel");
        $this->CustomerModel = $this->model("CustomerModel");
        $this->OrderModel    = $this->model("OrderModel");
        $this->ProductModel  = $this->model("ProductModel");
        $customerCore = new Customer;
        $this->customerItem = $this->CustomerModel->getCustomerItemByEmail($customerCore->getInfoCustomer("customer_email", Session::get("isLgTP_set")));
    }

    public function login() {
        if( isset($_POST['loginAccount_action']) ) {
            $error = [];
            global $error;
            if( empty($_POST['customer_phone_or_email']) ) {
                $error['customer_phone_or_email'] = "<span class='error'>* Vui lòng điền email hoặc SĐT</span>";
            } else {
                $customer_phone_or_email = Format::validationData($_POST['customer_phone_or_email']);
            }
            if( empty($_POST['customer_password']) ) {
                $error['customer_password'] = "<span class='error'>* Vui lòng điền mật khẩu</span>";
            } else {
                $customer_password = Format::validationData($_POST['customer_password']);
            }
            if( empty($error) ) {
                $checkLogin = $this->CustomerModel->checkLogin( $customer_phone_or_email, $customer_password );
                if( $checkLogin['status'] ) {
                    Session::set("isLgTP_set",md5($checkLogin['customerItem']['customer_email']));
                    Cookie::set("isLgTP_set", md5($checkLogin['customerItem']['customer_email']), 36000);
                    if( Session::check("actionRequest") ) {
                        Helper::redirect(Session::get("actionRequest"));
                    } else {
                        Helper::redirect(Config::getBaseUrlClient());
                    }
                } else {
                    $error['customer_login'] = $checkLogin['error'];
                }
            }
        }
        $this->view("Frontend.Users.login", [
            "configInfo"  => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function register() {
        if( isset($_POST['register_newMember_action']) ) {
            $error = [];
            global $error;

            if( empty($_POST['customer_fullname']) ) {
                $error['customer_fullname'] = "<span class='error'>* Vui lòng điền họ và tên</span>";
            } else {
                $customer_fullname = Format::validationData($_POST['customer_fullname']);
            }

            if( empty($_POST['customer_gender']) ) {
                $error['customer_gender'] = "<span class='error'>* Vui lòng chọn danh xưng</span>";
            } else {
                $customer_gender = $_POST['customer_gender'][0];
                $_POST['customer_gender'] = $customer_gender;
            }

            if( empty($_POST['customer_email']) ) {
                $error['customer_email'] = "<span class='error'>* Vui lòng điền email</span>";
            } else {
                if( !Validation::is_email($_POST['customer_email']) ) {
                    $error['customer_email'] = "<span class='error'>* Email không hợp lệ</span>";
                } else {
                    if( $this->CustomerModel->checkEmailExists($_POST['customer_email']) ) {
                        $error['customer_email'] = "<span class='error'>* Email Đã tồn tại</span>";
                    } else {
                        $customer_email = Format::validationData($_POST['customer_email']);
                    }
                }
            }

            if( empty($_POST['customer_phone']) ) {
                $error['customer_phone'] = "<span class='error'>* Vui lòng điền SĐT</span>";
            } else {
                if( !Validation::is_phone($_POST['customer_phone']) ) {
                    $error['customer_phone'] = "<span class='error'>* SĐT không hợp lệ</span>";
                } else {
                    if( $this->CustomerModel->checkPhoneExists($_POST['customer_phone']) ) {
                        $error['customer_phone'] = "<span class='error'>* SĐT Đã tồn tại</span>";
                    } else {
                        $customer_phone = Format::validationData($_POST['customer_phone']);
                    }
                }
            }

            if( empty($_POST['customer_password']) ) {
                $error['customer_password'] = "<span class='error'>* Vui lòng điền mật khẩu</span>";
            } else {
                if( !Validation::is_password($_POST['customer_password']) ) {
                    $error['customer_password'] = "<span class='error'>* Mật khẩu không hợp lệ [Mật khẩu bao gồm ký tự và số]</span>";
                } else {
                    $customer_password = Format::validationData($_POST['customer_password']);
                }
            }

            if( empty($error) ) {
                $time = time();
                $token_register = md5( $time . $customer_email . $customer_phone );
                $customer_confirm_register_code = rand(111111, 999999);
                $customer_time_register_validity_period = (int) $time + 360;
                $dataCustomer = [
                    "customer_fullname"              => $customer_fullname,
                    "customer_email"                 => $customer_email,
                    "customer_phone"                 => $customer_phone,
                    "customer_gender"                => $customer_gender,
                    "customer_password"              => $this->hashPassword($customer_password, $time),
                    "customer_createDate"            => $time,
                    "customer_status"                => "active",
                    "customer_is_active"             => "0",
                    "customer_token_register"        => $token_register,
                    "customer_confirm_register_code" => $customer_confirm_register_code,
                    "customer_time_register_validity_period" => $customer_time_register_validity_period
                ];
                $customer_id = $this->CustomerModel->addCustomerNew( $dataCustomer );
                if(is_int($customer_id)) {
                    Helper::redirect(Config::getBaseUrlClient("xac-nhan-dang-ky.html?token={$token_register}"));
                    $linkConfirmRegister = Config::getBaseUrlClient("xac-nhan-dang-ky.html?token={$token_register}");
                    $dataSendMail = [
                        [
                            "email"    => $customer_email,
                            "fullname" => $customer_fullname,
                            "title"    => "{$customer_confirm_register_code} là Mã xác nhận dùng để đăng ký tài khoảng tại Website Tienichnhabep.vn",
                            "content"  => $this->mailContentRegisCustomer($customer_gender, $customer_fullname, $customer_confirm_register_code, $customer_time_register_validity_period, $linkConfirmRegister)
                        ],
                    ];
                    send_mail($dataSendMail[0]);
                }
            }
        }
        $this->view("Frontend.Users.register", [
            "configInfo"  => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function mailContentRegisCustomer($customer_gender, $customer_fullname, $customer_confirm_register_code, $customer_time_register_validity_period, $linkConfirmRegister)
    {
        return '<div style="border: 1px solid rgba(0,0,0,0.12); display: inline-block; padding: 10px;background: #fafafa;">
                    <div style="font-weight: bold;">TIỆN ÍCH NHÀ BẾP XIN KÍNH CHÀO <strong style="color: #db0000; text-transform: capitalize;">' . Format::formatGender($customer_gender) . ' ' . $customer_fullname . '</strong> !</div>
                    <div style="padding: 2px 0; border-bottom: 1px solid rgb(190 190 190 / 12%);border-radius: 5px;">
                        <p style="padding: 2px 0; margin: 0;">Mã xác nhận dùng để đăng ký tài khoảng tại Website <a href="' . Config::getBaseUrlClient() . '">tienichnhabep.vn</a> là:<strong> '. $customer_confirm_register_code .'</strong></p>
                        <p style="padding: 2px 0; margin: 0;">Xác nhận tài khoản <a href="' . $linkConfirmRegister . '">TẠI ĐÂY</a></p>
                        <small>Mã xác nhận này hiệu lực đến <span style="color: #f17e7e; font-weight: bold;">'. Format::formatFullTime($customer_time_register_validity_period) .'</span></small>
                    </div>
                    <div style="padding: 2px 0;">Tiện ích nhà bếp xin chân thành cảm ơn !</div>
                </div>';
    }

    public function hashPassword($customer_password, $time)
    {
        return password_hash( (md5($customer_password).md5($time) ) , PASSWORD_BCRYPT, ['cost'=>12] );
    }

    public function forgotPassword() {
        $url = Helper::getUrl();
        $emailSent = !empty(explode("?sentToEmail=", $url)[1]) ? explode("?sentToEmail=", $url)[1] : null;
        if( empty($emailSent) ) {
            $emailSendAgain = !empty(explode("?email=", $url)[1]) ? explode("?email=", $url)[1] : null;
            if( isset($_POST['forgetPassword_action']) ) {
                $error = [];
                global $error;
                if( empty($_POST['customer_email']) ) {
                    $error['customer_email'] = "<span class='error'>* Vui lòng điền Email đăng ký</span>";
                } else {
                    if( !Validation::is_email($_POST['customer_email']) ) {
                        $error['customer_email'] = "<span class='error'>* Địa chỉ Email không hợp lệ</span>";
                    } else {
                        $customer_email = Format::validationData($_POST['customer_email']);
                    }
                }
                if( empty($error) ) {
                    if( $this->CustomerModel->checkEmailExists( $customer_email ) ) {
                        $customerItem = $this->CustomerModel->getCustomerItemByEmail($customer_email);
                        if( $customerItem['customer_is_active'] == '1' ) {
                            if( $customerItem['customer_status'] == 'disable' ) {
                                $error['customer_email'] = "<span class='error'>* Tài khoảng đã bị vô hiệu hóa</span>";
                            } else {
                                $time  = time();
                                $token_forgotPass = md5( $time . $customer_email );
                                $customer_time_forgotPass_validity_period = $time + 360;
                                $dataCustomer = [
                                    "customer_token_forgotPass"                => $token_forgotPass,
                                    "customer_time_start_forgotPass"           => $time,
                                    "customer_time_forgotPass_validity_period" => $customer_time_forgotPass_validity_period
                                ];
                                $process = $this->CustomerModel->updateCustomer($dataCustomer, $customerItem['customer_id']);
                                if($process) {
                                    $linkPasswordRetrieval = Config::getBaseUrlClient("thay-doi-mat-khau.html?token={$token_forgotPass}");
                                    $dataSendMail = [
                                        [
                                            "email"    => $customer_email,
                                            "fullname" => $customerItem['customer_fullname'],
                                            "title"    => "Xác nhận quên mật khẩu tại Website Tienichnhabep.vn",
                                            "content"  => $this->mailContentForgotCustomer($customerItem['customer_gender'], $customerItem['customer_fullname'], $linkPasswordRetrieval, $customer_time_forgotPass_validity_period)
                                        ],
                                    ];
                                    send_mail($dataSendMail[0]);
                                    Helper::redirect(Config::getBaseUrlClient("quen-mat-khau.html?sentToEmail={$customer_email}"));
                                }
                            }
                        } else {
                            $error['customer_email'] = "<span class='error'>* Tài khoảng chưa được xác nhận</span>";
                        }
                    } else {
                        $error['customer_email'] = "<span class='error'>* Email không tồn tại trong hệ thống</span>";
                    }
                }
            }
        }
        $this->view("Frontend.Users.forgotPassword",[
            "configInfo"     => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "emailSendAgain" => !empty($emailSendAgain) ? $emailSendAgain : null,
            "emailSent"      => !empty($emailSent)      ? $emailSent      : null
        ]);
    }

    public function mailContentForgotCustomer($customer_gender, $customer_fullname, $linkPasswordRetrieval, $customer_time_forgotPass_validity_period)
    {
        return '<div style="border: 1px solid rgba(0,0,0,0.12); display: inline-block; padding: 10px;background: #fafafa;">
                    <div style="font-weight: bold;">TIỆN ÍCH NHÀ BẾP XIN KÍNH CHÀO <strong style="color: #db0000; text-transform: capitalize;">' . Format::formatGender($customer_gender) . ' ' . $customer_fullname . '</strong> !</div>
                    <div style="padding: 2px 0; border-bottom: 1px solid rgb(190 190 190 / 12%);border-radius: 5px;">
                        <p style="padding: 2px 0; margin: 0;">Nhấn vào nút bên dưới để bắt đầu thiết lập lại mật khẩu ?</p>
                        <a style="display: block;text-align: center;background: #00bcd4;width: 160px;margin: 0 auto;color: #fff;text-decoration: none;padding: 3px 0px;border-radius: 5px;" target="_blank" href="'. $linkPasswordRetrieval .'">Thiết Lập Lại Mật Khẩu</a>
                        <small style="text-align: center;display: block;margin: 4px 0;">Mã xác nhận này hiệu lực đến <span style="color: #f17e7e; font-weight: bold;">'. Format::formatFullTime($customer_time_forgotPass_validity_period) .'</span></small>
                    </div>
                    <div style="padding: 2px 0;">Nếu đây không phải yêu cầu của bạn xin hãy bỏ qua tin nhắn này !</div>
                    <div style="padding: 2px 0;">Tiện ích nhà bếp xin chân thành cảm ơn !</div>
                </div>';
    }

    public function confirmChangePassword() {
        $url = Helper::getUrl();
        $token = !empty(explode("?token=", $url)[1]) ? explode("?token=", $url)[1] : null;
        $errorConfirmTokenForgot = null;
        if( !empty($token) ) {
            $customerItem = $this->CustomerModel->getCustomerItemByToken('customer_token_forgotPass', $token);
            if( !($customerItem['customer_time_forgotPass_validity_period'] >= time()) ) {
                $errorConfirmTokenForgot = "error";
            } else {
                if( isset($_POST['changePassword_action']) ) {
                    $error = [];
                    global $error;
                    if(empty($_POST['customer_password'])) {
                        $error['customer_password'] = "<span class='error'>* Vui lòng điền mật khẩu mới</span>";
                    } else {
                        if( !Validation::is_password($_POST['customer_password']) ) {
                            $error['customer_password'] = "<span class='error'>* Mật khẩu không hợp lệ [Mật khẩu bao gồm ký tự và số]</span>";
                        } else {
                            $customer_password = Format::validationData($_POST['customer_password']);
                        }
                    }
                    if(empty($error)) {
                        $dataCustomer = [
                            "customer_token_forgotPass"                => "",
                            "customer_time_start_forgotPass"           => "",
                            "customer_time_forgotPass_validity_period" => "",
                            "customer_password"                        => $this->hashPassword($customer_password, $customerItem['customer_createDate'])
                        ];
                        $process = $this->CustomerModel->updateCustomer($dataCustomer, $customerItem['customer_id']);
                        if($process) {
                            Session::set("isLgTP_set",md5($customerItem['customer_email']));
                            Cookie::set("isLgTP_set", md5($customerItem['customer_email']), 36000);
                            Helper::redirect(Config::getBaseUrlClient());
                        }
                    }
                }
            }
        } else {
            $customerItem = null;
        }
        $this->view("Frontend.Users.confirmChangePassword", [
            "configInfo"              => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "customerItem"            => !empty($customerItem) ? $customerItem : null,
            "errorConfirmTokenForgot" => !empty($errorConfirmTokenForgot) ? $errorConfirmTokenForgot : null
        ]);
    }

    public function confirmTokenRegister() {
        $url = Helper::getUrl();
        $token = !empty(explode("?token=", $url)[1]) ? explode("?token=", $url)[1] : null;
        if( !empty($token) ) {
            $customerItem = $this->CustomerModel->getCustomerItemByToken('customer_token_register', $token);
            if( !($customerItem['customer_time_register_validity_period'] >= time()) ) {
                $errorConfirmTokenRegister = "error";
            } else {
                if( isset( $_POST['confirmRegisterCode_action'] ) ) {
                    $error = [];
                    global $error;
                    if( empty( $_POST['customer_confirm_register_code'] ) ) {
                        $error['customer_confirm_register_code'] = "<p class='error'>* Vui lòng nhập mã xác nhận</p>";
                    } else {
                        $customer_confirm_register_code = Format::validationData($_POST['customer_confirm_register_code']);
                    }
                    if( empty($error) ) {
                        if( $customer_confirm_register_code === $customerItem['customer_confirm_register_code'] ) {
                            $dataCustomer = [
                                "customer_is_active" => "1",
                                "customer_token_register" => "",
                                "customer_time_register_validity_period" => "",
                                "customer_confirm_register_code" => ""
                            ];
                            $process = $this->CustomerModel->updateCustomer( $dataCustomer, $customerItem['customer_id'] );
                            if($process) {
                                Session::set("isLgTP_set",md5($customerItem['customer_email']));
                                Cookie::set("isLgTP_set", md5($customerItem['customer_email']), 36000);
                                Helper::redirect(Config::getBaseUrlClient());
                            }
                        } else {
                            $error['customer_confirm_register_code'] = "<p class='error'>* Mã xác nhận không chính xác</p>";
                        }
                    }
                }
            }
        } else {
            $customerItem = null;
        }

        $this->view("Frontend.Users.confirmTokenRegister", [
            "configInfo"   => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "customerItem" => !empty($customerItem) ? $customerItem : null,
            "errorConfirmTokenRegister" => !empty($errorConfirmTokenRegister) ? $errorConfirmTokenRegister : null
        ]);
    }

    public function logout() {
        Session::_unset("isLgTP_set");
        Session::_unset("actionRequest");
        Cookie::delete("isLgTP_set", Cookie::get("isLgTP_set"), 36000);
        Helper::redirect(Config::getBaseUrlClient());
    }

    public function sendAgainConfirmRegisterCode() {
        $token = $_POST['token'];
        $customerItem = $this->CustomerModel->getCustomerItemByToken('customer_token_register', $token);
        $time = time();
        $customer_time_register_validity_period = (int) $time + 360;
        if(!empty($customerItem)) {
            $customer_confirm_register_code = rand(111111, 999999);
            $dataCustomer = [
                "customer_createDate" => $time,
                "customer_time_register_validity_period" => $customer_time_register_validity_period,
                "customer_confirm_register_code" => $customer_confirm_register_code,
            ];
            $process = $this->CustomerModel->updateCustomer($dataCustomer, $customerItem['customer_id']);
            if($process) {
                $linkConfirmRegister = Config::getBaseUrlClient("xac-nhan-dang-ky.html?token={$token}");
                $dataSendMail = [
                    [
                        "email"    => $customerItem['customer_email'],
                        "fullname" => $customerItem['customer_fullname'],
                        "title"    => "{$customer_confirm_register_code} là Mã xác nhận dùng để đăng ký tài khoảng tại Website Tienichnhabep.vn",
                        "content"  => $this->mailContentRegisCustomer($customerItem['customer_gender'], $customerItem['customer_fullname'], $customer_confirm_register_code, $customer_time_register_validity_period, $linkConfirmRegister)
                    ],
                ];
                send_mail($dataSendMail[0]);
                $dataAjax = [
                    "status" => "success"
                ];
                echo json_encode($dataAjax);
            }
        } else {
            $dataAjax = [
                "status" => "error"
            ];
            echo json_encode($dataAjax);
        }
    }

    public function profile() {
        $customerItem = $this->customerItem;
        if( isset($_POST['updateInfoCustomer_action']) ) {
            $error = [];
            global $error;

            /**
             * -- Check customer fullname
             */
            if( empty($_POST['customer_fullname']) ) {
                $error['customer_fullname'] = "<span class='error'>* Vui lòng điền họ tên</span>";
            } else {
                $customer_fullname = Format::validationData($_POST['customer_fullname']);
            }

            /**
             * -- Check customer email
             */
            if( empty($_POST['customer_email']) ) {
                $error['customer_email'] = "<span class='error'>* Vui lòng điền email</span>";
            } else {
                if( !Validation::is_email($_POST['customer_email']) ) {
                    $error['customer_email'] = "<span class='error'>* Email không hợp lệ</span>";
                } else {
                    if( $customerItem['customer_email'] == $_POST['customer_email'] ) {
                        $customer_email = $_POST['customer_email'];
                    } else {
                        if( $this->CustomerModel->checkFieldInTableCustomerExists('customer_email', $_POST['customer_email']) ) {
                            $error['customer_email'] = "<span class='error'>* Email đã tồn tại</span>";
                        } else {
                            $customer_email = $_POST['customer_email'];
                        }
                    }
                }
            }

            /**
             * -- Check customer phone
             */
            if( empty($_POST['customer_phone']) ) {
                $error['customer_phone'] = "<span class='error'>* Vui lòng điền SĐT</span>";
            } else {
                if( !Validation::is_phone($_POST['customer_phone']) ) {
                    $error['customer_phone'] = "<span class='error'>* SĐT không hợp lệ</span>";
                } else {
                    if( $customerItem['customer_phone'] == $_POST['customer_phone'] ) {
                        $customer_phone = $_POST['customer_phone'];
                    } else {
                        if( $this->CustomerModel->checkFieldInTableCustomerExists('customer_phone', $_POST['customer_phone']) ) {
                            $error['customer_phone'] = "<span class='error'>* Số điện thoại đã tồn tại</span>";
                        } else {
                            $customer_phone = $_POST['customer_phone'];
                        }
                    }
                }
            }

            /**
             * -- Check customer birthday
             */
            $birthday_dayOfDate   = !empty($_POST['customer_birthday_dayOfDate']) ? $_POST['customer_birthday_dayOfDate'] : null;
            $birthday_monthOfDate = !empty($_POST['customer_birthday_monthOfDate']) ? $_POST['customer_birthday_monthOfDate'] : null;
            $birthday_yearOfDate  = !empty($_POST['customer_birthday_yearOfDate']) ? $_POST['customer_birthday_yearOfDate'] : null;

            if( !empty($birthday_dayOfDate) && !empty($birthday_monthOfDate) && !empty($birthday_yearOfDate) ) {
                $customer_birthday = strtotime( "{$birthday_yearOfDate}-{$birthday_monthOfDate}-{$birthday_dayOfDate}" );
            } else {
                $customer_birthday = null;
            }

            /**
             * -- Check customer gender
             */
            if( empty($_POST['customer_gender']) ) {
                $error['customer_gender'] = "<span class='error'>* Vui lòng chọn danh xưng</span>";
            } else {
                $customer_gender = $_POST['customer_gender'][0];
                $_POST['customer_gender'] = $customer_gender;
            }

            /**
             * -- Check customer avatar
             */
            if( empty($_POST['customer_avatar']) ) {
                $customer_avatar = null;
            } else {
                $customer_avatar_file = json_decode( $_POST['customer_avatar'], true );
                if( !empty($customer_avatar_file['targetFile']) ) {
                    $customer_avatar = $customer_avatar_file['targetFile'];
                    $customer_tmp    = $customer_avatar_file['tmp_name'];
                } else {
                    $customer_avatar = $_POST['customer_avatar'];
                }
                $_POST['customer_avatar'] = $customer_avatar;
            }

            /**
             * -- Check customer password
             */
            $pass_old     = !empty($_POST['customer_password_old'])     ? Format::validationData($_POST['customer_password_old'])     : null;
            $pass_new     = !empty($_POST['customer_password_new'])     ? Format::validationData($_POST['customer_password_new'])     : null;
            $pass_confirm = !empty($_POST['customer_password_confirm']) ? Format::validationData($_POST['customer_password_confirm']) : null;

            if( !empty($pass_new) ) {
                if( !empty($pass_old) ) {
                    $pass_old_hash = md5($pass_old) . md5($customerItem['customer_createDate']);
                    if( $this->CustomerModel->confirmPassword( $pass_old_hash, $customerItem['customer_id'] ) ) {
                        if( Validation::is_password($pass_new) ) {
                            if( !empty($pass_confirm) ) {
                                if( $pass_confirm == $pass_new ) {
                                    $customer_password_md5 = md5($pass_new) . md5($customerItem['customer_createDate']);
                                    $customer_password = password_hash($customer_password_md5, PASSWORD_BCRYPT, ['cost' => 12]);
                                } else {
                                    $error['customer_password'] = "<span class='error'>* Nhập lại mật khẩu mới không chính xác</span>";
                                }
                            } else {
                                $error['customer_password'] = "<span class='error'>* Vui lòng nhập lại mật khẩu mới</span>";
                            }
                        } else {
                            $error['customer_password'] = "<span class='error'>* Mật khẩu sai định dang [ Ký tự + số ]</span>";
                        }
                    } else {
                        $error['customer_password'] = "<span class='error'>* Mật khẩu cũ không chính xác</span>";
                    }
                } else {
                    $error['customer_password'] = "<span class='error'>* Vui lòng nhập mật khẩu cũ</span>";
                }
            }

            if( empty($error) ) {
                if( !empty($customer_password) ) {
                    $dataCustomer = [
                        "customer_fullname"   => $customer_fullname,
                        "customer_birthday"   => $customer_birthday,
                        "customer_avatar"     => $customer_avatar,
                        "customer_email"      => $customer_email,
                        "customer_phone"      => $customer_phone,
                        "customer_gender"     => $customer_gender,
                        "customer_password"   => $customer_password,
                        "customer_updateDate" => time(),
                    ];
                } else {
                    $dataCustomer = [
                        "customer_fullname"   => $customer_fullname,
                        "customer_birthday"   => $customer_birthday,
                        "customer_avatar"     => $customer_avatar,
                        "customer_email"      => $customer_email,
                        "customer_phone"      => $customer_phone,
                        "customer_gender"     => $customer_gender,
                        "customer_updateDate" => time(),
                    ];
                }
                $process = $this->CustomerModel->updateCustomer($dataCustomer, $customerItem['customer_id']);
                if($process) {
                    Cookie::set("isLgTP_set", md5($customer_email), 36000);
                    Session::set("isLgTP_set", md5($customer_email));
                    if( !empty($customer_tmp) ) {
                        move_uploaded_file(json_decode($customer_tmp), $customer_avatar);
                    }
                    $statusActionCustomer = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật tài khoản thành công"
                    ];
                } else {
                    $statusActionCustomer = [
                        "status"    => "success",
                        "notifiTxt" => "Cập nhật tài khoản không thành công"
                    ];
                }
            }
        }

        $this->view("Frontend.Users.profile", [
            "customerItem"         => !empty($customerItem) ? $customerItem : null,
            "configInfo"           => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "statusActionCustomer" => !empty($statusActionCustomer) ? $statusActionCustomer : null
        ]);
    }

    public function address_store() {
        $customerItem = $this->customerItem;
        if( !empty( $customerItem ) ) {
            $listAddress = $this->CustomerModel->getListAddressByCustomerId( $customerItem['customer_id'] );
        }
        $this->view("Frontend.Users.address_store", [
            "customerItem" => !empty($customerItem) ? $customerItem : null,
            "configInfo"   => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "listAddress"  => !empty($listAddress) ? $listAddress : null
        ]);
    }

    public function history() {
        $customerItem = $this->customerItem;
        /**
         * Pagination
         */
        $url     = Helper::getUrl();
        $page    = !empty(explode("page=", $url)[1]) ? (int) explode("page=", $url)[1] : 1;
        $pageUrl = !empty($page)         ? "?page=" : "";
        $numPerPage        = 10;
        $totalHistoryOrder = count($this->OrderModel->getListOrderByCustomerId($customerItem['customer_id']));
        $totalPage         = ceil($totalHistoryOrder / $numPerPage);
        $pageStart         = ($page - 1) * $numPerPage;
        $listHistoryOrder  = $this->OrderModel->getListHistoryOrderByPagination( $customerItem['customer_id'], $pageStart, $numPerPage );
        if(!empty($listHistoryOrder)) {
            foreach($listHistoryOrder as &$orderItem) {
                $listOrderItem = $this->OrderModel->getListOrderItemByOrderId($orderItem['order_id']);
                if(!empty($listOrderItem)) {
                    foreach($listOrderItem as $orderItem_item) {
                        $orderItemList['listProd'][] = $this->ProductModel->getProdItemById($orderItem_item['orderItem_prodId']);
                    }
                }
                $orderItem['prodInfo'] = $orderItemList['listProd'][0];
            }
        }
        $this->view("Frontend.Users.history",[
            "configInfo"       => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "customerItem"     => !empty($customerItem) ? $customerItem : null,
            "listHistoryOrder" => !empty($listHistoryOrder) ? $listHistoryOrder : null,
            "totalPage"        => !empty($totalPage) ? $totalPage : null,
            "page"             => $page,
            "pageUrl"          => !empty($pageUrl) ? $pageUrl : null,
        ]);
    }

    public function detailOrder() {
        $url         = Helper::getUrl();
        $orderCode   = !empty(explode("?donhangID=", $url)[1]) ? explode("?donhangID=", $url)[1] : null;
        $viewOrderStatus = false;
        if(!empty($orderCode)) {
            Session::set("actionRequest", Config::getBaseUrlClient("chi-tiet-don-hang.html?donhangID={$orderCode}"));
            $orderItem = $this->OrderModel->getOrderByOrderCode($orderCode);
            if( !empty($orderItem) ) {
                if( !empty($orderItem['order_customerId_ties']) || Auth::isLogin() ) {
                    if( $orderItem['order_customerId_ties'] == $this->customerItem['customer_id'] ) {
                        $viewOrderStatus = true;
                    } else {
                        $viewOrderStatus = false;
                    }
                } else {
                    $viewOrderStatus = true;
                }
                $listOrderItem = $this->OrderModel->getListOrderItemByOrderId($orderItem['order_id']);
                if(!empty($listOrderItem)) {
                    foreach($listOrderItem as &$orderItem_item) {
                        $orderItem_item['prodInfo'] = $this->ProductModel->getProdItemById($orderItem_item['orderItem_prodId']);
                    }
                }
            }
        }
        $this->view("Frontend.Users.detailOrder" , [
            "configInfo"      => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null,
            "orderItem"       => !empty($orderItem) ? $orderItem : null,
            "listOrderItem"   => !empty($listOrderItem) ? $listOrderItem : null,
            "viewOrderStatus" => $viewOrderStatus,
            "customerItem"    => !empty($this->customerItem) ? $this->customerItem : null,
        ]);
    }

    public function uploadAvatarCustomer() {
        if( $_SERVER['REQUEST_METHOD'] ) {
            $targetDir  = "admin/public/images/customer_avatar/";
            $fileName   = pathinfo( $_FILES['file']['name'], PATHINFO_FILENAME );
            $fileExten  = pathinfo( $_FILES['file']['name'], PATHINFO_EXTENSION );
            $targetFile = $targetDir . md5( time() . $fileName ) . "." . $fileExten;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile))
            $dataAjax = [
                "tmp_name" => $_FILES['file']['tmp_name'],
                "targetFile" => $targetFile
            ];
            echo json_encode($dataAjax);
        }
    }
}