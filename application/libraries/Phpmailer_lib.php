<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Phpmailer_lib
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        //  require_once(FCPATH."vendor/autoload.php");
        //  require_once APPPATH.'third_party/PHPMailer/src/Exception.php';
        //  require_once APPPATH.'third_party/PHPMailer/src/PHPMailer.php';
        //  require_once APPPATH.'third_party/PHPMailer/src/SMTP.php';

       
        //$mail = new PHPMailer;
        $mail = new PHPMailer(true);
		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = "smtp.googlemail.com";  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->Username = "raghavendra@prologictechnologies.in";  // SMTP username
		$mail->Password = ""; // SMTP password
		// $mail->From = "smtpt2m@talktomedic.in";
		// $mail->FromName = "TalkToMedic";
		//$mail->AddBCC("rajiv@prologictechnologies.in");
		$mail->IsHTML(true);
		return $mail;
    }
}