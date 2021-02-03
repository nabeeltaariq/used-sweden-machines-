<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'gmail-email/vendor/phpmailer/src/Exception.php';
require_once 'gmail-email/vendor/phpmailer/src/PHPMailer.php';
require_once 'gmail-email/vendor/phpmailer/src/SMTP.php';
// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);


    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'pms.demo.pvt@gmail.com'; // YOUR gmail email
    $mail->Password = 'pms@2020'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom('pms.demo.pvt@gmail.com', 'demo');
    $mail->addAddress( $email, $fname . " " . $lname);
   // $mail->addReplyTo('noreply@gmail.com', 'Sender Name'); // to set the reply to

    // Setting the email content

   
    $mail->IsHTML(true);
    $mail->Subject =" From PMS: Order Details";
    $mail->Body = $body;

    //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    if($mail->send())
    {
   echo "<script type='text/javascript'>
   window.location.replace('checkout.php?msg=1');

  
    </script>";
}
else
{
    echo "<script type='text/javascript'>
   window.location.replace('checkout.php?msg=2');

  
    </script >";
}


?>
