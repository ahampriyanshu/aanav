<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class sendEmail {
public function send($userName, $email, $subject, $body){
require 'PHPMailer/vendor/autoload.php';
$mail = new PHPMailer(true);
try {

    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPSecure = false;
    $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
    $mail->Username   = 'priyanshootiwari@gmail.com';           // SMTP username
    $mail->Password   = 'pa$$@TEMP';                          // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    $mail->addReplyTo('priyanshootiwari@gmail.com', 'aanav');
    $mail->setFrom('priyanshootiwari@gmail.com', 'aanav');
    $mail->addAddress($email, $userName);     // Add a recipient
    $mail->AddEmbeddedImage('img/logo_nav.png', 'logoimg');

    $mail->Subject = $subject;
    $mail->Body    = "<center><p><img width=\"200\" height=\"95\" src=\"cid:logoimg\" /></p>".$body."</center>";
    $mail->AltBody = "<center><p><img width=\"200\" height=\"95\" src=\"cid:logoimg\" /></p>".$body."</center>";
    $mail->isHTML(true);
    $mail->send();

    return true;
} catch (Exception $e) {
    return false;
}

    }

 }
