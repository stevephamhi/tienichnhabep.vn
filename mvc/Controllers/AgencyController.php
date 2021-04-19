<?php

class AgencyController extends BaseController
{
    private $AgencyModel;
    private $ConfigModel;

    public function __construct()
    {
        $this->AgencyModel = $this->model("AgencyModel");
        $this->ConfigModel = $this->model("ConfigModel");
    }

    public function index()
    {
        $this->view("Frontend.Agencys.index", [
            "configInfo" => !empty($this->ConfigModel->getInfoConfig()) ? $this->ConfigModel->getInfoConfig() : null
        ]);
    }

    public function regisMember()
    {
        $fullname = Format::validationSearch($_POST['fullname']);
        $company  = Format::validationSearch($_POST['company']);
        $phone    = Format::validationSearch($_POST['phone']);
        $email    = Format::validationSearch($_POST['email']);

        $dataAgency = [
            "agency_fullname"   => $fullname,
            "agency_company"    => $company,
            "agency_phone"      => $phone,
            "agency_email"      => $email,
            "agency_createDate" => time(),
            "agency_status"     => "no_process",
        ];

        $agency_id = $this->AgencyModel->addAgencyNew($dataAgency);
        if(is_int($agency_id)) {
            // set cookie
            Cookie::set("regisAgencyTime", $company, time() + 3600);
            // send mail
            $this->sendMailNotificationToCustomer( $dataAgency );
            $dataAjax = [
                "status" => "success",
                "dataAgency" => $dataAgency
            ];
        } else {
            $dataAjax = [
                "status" => "error"
            ];
        }

        echo json_encode($dataAjax);
    }

    public function sendMailNotificationToCustomer( $dataAgency )
    {
        $dataSendMail = [
            [
                "email"    => $dataAgency['agency_email'],
                "fullname" => $dataAgency['agency_fullname'],
                "title"    => "TIẾN PHÁT THÔNG BÁO, CHÂN THÀNH CẢM ƠN QUÝ C.TY " . $dataAgency['agency_company'] . " ĐÃ ĐĂNG KÝ ĐỂ TRỞ THÀNH ĐẠI LÝ CÙNG CHÚNG TÔI",
                "content"  => $this->contentNotificationRegisCustomer( $dataAgency )
            ],
        ];
        send_mail($dataSendMail[0]);
    }

    public function contentNotificationRegisCustomer( $dataAgency )
    {
        return "<div style='font-family: Arial; font-size: 1rem; background-color: #f2f2f2; padding: 20px;'>
        <div style='background-color: #fff; width: 90%; padding: 20px; margin: 0 auto;'>
            <div style='margin-bottom: 20px;'>
                <a href=' " . Config::getBaseUrlClient() . " '>
                    <img width='400' src=' " . Config::getBaseUrlClient('public/images/icon/TIEN-PHAT-khong-nen-01.png') . " ' alt='CÔNG TY TNHH TIẾN PHÁT'>
                </a>
            </div>
            <div style='margin-bottom: 10px;'>Cám ơn bạn đã đăng ký để trở thành đại lý với <strong>TIẾN PHÁT</strong></div>
            <table style='border-collapse:collapse;width:100%;border-top: 1px solid #1f86c8;border-left: 1px solid #1f86c8;margin-bottom:20px;'>
                <thead>
                    <tr>
                        <td style='font-size: 15px;border-right: 1px solid #1f86c8;border-bottom: 1px solid #1f86c8;background-color: #2c9ae0;font-weight:bold;text-align:left;padding:7px;color: #fff;'>
                            <span>Thông tin quý công ty</span>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style='font-size: 14px;border-right: 1px solid #2c9ae0;border-bottom: 1px solid #2c9ae0;text-align:left;padding: 10px;line-height: 1.4;'>
                            <p>
                                <strong>Họ tên người đăng ký: </strong>
                                <span> " . $dataAgency['agency_fullname'] . " </span>
                            </p>
                            <p>
                                <strong>Tên công ty / Đơn vị: </strong>
                                <span> " . $dataAgency['agency_company'] . " </span>
                            </p>
                            <p>
                                <strong>Số điện thoại: </strong>
                                <span> " . $dataAgency['agency_phone'] . " </span>
                            </p>
                            <p>
                                <strong>Email: </strong>
                                <span> " . $dataAgency['agency_email'] . " </span>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>Vui lòng trả lời thư này nếu có bất kì câu hỏi nào</div>
            <div style='margin-top:5px;border: 1px dashed #1f86c8;padding: 5px 10px;'>
                <span style='margin-bottom: 5px;'>Mọi thắc mắc xin liên hệ</span>
                <a target='_blank' style='display: block; margin-left: 10px; font-size: .9rem;' href='tel:0708070827'>Hotline: 0708 0708 27</a>
                <a target='_blank' style='display: block; margin-left: 10px; font-size: .9rem;' href='mailTo:0708070827'>Email: tienichnhabep.vn@gmai.com</a>
            </div>
            <strong style='margin: 5px 0; display: block;'>Một lần nữa TIẾN PHÁT cảm ơn quý công ty !</strong>
            <a target='_blank' href='" . Config::getBaseUrlClient() . "' style='text-align: right; text-decoration: none; margin-top: 10px; display: block;'>tienichnhabep.vn</a>
        </div>
    </div>";
    }
}