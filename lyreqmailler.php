<?php
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class LyreqMailler
{
    public $senderMail;
    public $senderPW;
    public $host;
    public $port;
    public $tls;

    public function __construct($port, $host, $senderMail, $senderPW, $tls = false)
    {
        function errorMessages($errorCode)
        {
            $data['0'] = "Transaction successful!";
            $data['1'] = "Please enter your mail port!";
            $data['2'] = "Please enter your mail host!";
            $data['3'] = "Please enter your e-mail address";
            $data['4'] = "Please enter your e-mail password";
            $data['5'] = "Please enter recipient e-mail address";
            $data['6'] = "Please enter the e-mail subject";
            $data['7'] = "Please enter the e-mail content";

            return $data[$errorCode];
        }

        $this->port = $port;
        $this->host = $host;
        $this->senderMail = $senderMail;
        $this->senderPW = $senderPW;
        $this->tls = $tls;


        if (empty($this->port)) {
            $returnMessages = errorMessages(1);
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
            exit;
        }
        if (empty($this->host)) {
            $returnMessages = errorMessages(2);
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
            exit;
        }
        if (empty($this->senderMail)) {
            $returnMessages = errorMessages(3);
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
            exit;
        }
        if (empty($this->senderPW)) {
            $returnMessages = errorMessages(4);
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
            exit;
        }
    }


    public function mailSend($senderName = "", $receiverName = "", $receiverMail, $subject, $body)
    {

        if (empty($receiverMail)) {
            $returnMessages = errorMessages(5);
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
            exit;
        }
        if (empty($subject)) {
            $returnMessages = errorMessages(6);
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
            exit;
        }
        if (empty($body)) {
            $returnMessages = errorMessages(7);
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
            exit;
        }
        try {

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = $this->host;
            $mail->SMTPAuth = true;
            $mail->Username =  $this->senderMail;
            $mail->Password =  $this->senderPW;

            if ($this->tls == true) {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            $mail->Port = $this->port;
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom($this->senderMail, $senderName);
            $mail->addBCC($receiverMail, $receiverName);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            $returnMessages = errorMessages(0);
            $returnData['status'] = true;
            $returnData['messages'] = $returnMessages;
            return $returnData;
   
        } catch (Exception $e) {
            $returnMessages = "You entered your mail settings incorrectly. Error Description:{$mail->ErrorInfo}";
            $returnData['status'] = false;
            $returnData['messages'] = $returnMessages;
            return $returnData;
       
        }
    }
}
