<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
function send_mail($dataSendMail)
{
    $configEmail = [
        "protocol"      => "smtp",
        "smtp_host"     => "smtp.gmail.com",
        "smtp_port"     => 587,
        "smtp_fullname" => "TIENICHNHABEP.VN",
        "smtp_user"     => "tienichnhabep.vn@gmail.com",
        "smtp_pass"     => "tienichnhabep.tienphat@gmail.com",
        "smtp_timeout"  => 7,
        "SMTPSecure"    => "tls",
        "mailtype"      => "html",
        "charset"       => "UTF-8",
    ];

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug  = 0;
        $mail->isSMTP();
        $mail->Host       = $configEmail['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = $configEmail['SMTPSecure'];
        $mail->Port       = $configEmail['smtp_port'];
        $mail->CharSet    = $configEmail['charset'];
        $mail->Username   = $configEmail['smtp_user'];
        $mail->Password   = $configEmail['smtp_pass'];

        $mail->setFrom( $configEmail['smtp_user'], $configEmail['smtp_fullname'] );
        $mail->addReplyTo( $configEmail['smtp_user'], $configEmail['smtp_fullname'] );

        $mail->IsHTML(true);

        $mail->addAddress($dataSendMail['email'], $dataSendMail['fullname']);

        $mail->Subject = $dataSendMail['title'];
        $mail->Body = $dataSendMail['content'];
        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}


class send_mail
{

}