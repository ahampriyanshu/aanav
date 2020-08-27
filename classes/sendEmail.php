<?php
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 class sendEmail {

    public function send($userName, $email, $subject, $body){

       // Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'priyanshootiwari@gmail.com';           // SMTP username
    $mail->Password   = 'Django@1212';                          // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->addReplyTo('priyanshootiwari@gmail.com', 'aanav');
    $mail->setFrom('priyanshootiwari@gmail.com', 'aanav');
    $mail->addAddress($email, $userName);     // Add a recipient


    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $body;
      $mail->isHTML(true);                                  // Set email format to HTML

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}

    }

 }
