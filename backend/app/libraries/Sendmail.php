<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include APPPATH . 'third_party/mail/class.phpmailer.php';
include APPPATH . "third_party/mail/class.smtp.php";

class Sendmail {

    public function send($toparam = array(), $subject, $html_body, $attachment = NULL) {
        $CI = & get_instance();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = SMTPSecure;
        $mail->Port = MAIL_PORT;
        $mail->From = MAIL_FROM_EMAIL;
        $mail->FromName = MAIL_FROM_NAME;

        if (isset($toparam) && count($toparam) > 0) {
            $to_email = $toparam['to_email'];
            $to_name = $toparam['to_name'];
        }
        $html = $CI->load->view("mail/header", '', true);
        $html .= $html_body;
        $html .= $CI->load->view("mail/footer", '', true);
        
       
        
        $mail->addAddress($to_email, $to_name);
        $body = $mail->MsgHTML($html);
        $mail->WordWrap = 50;
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if (MAIL_SWITCH == true) {
            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        }
    }

}

?>