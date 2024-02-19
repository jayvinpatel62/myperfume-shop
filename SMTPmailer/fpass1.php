<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('vendor/autoload.php');	




$mail = new PHPMailer(true); 
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'janvi.patel31103@gmail.com';                 // SMTP username
    $mail->Password = 'moseqevuevhrdchy';                           // SMTP password
    $mail->SMTPSecure = 'tls';                 // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
$mlid="janvi.patel3112003@gmail.com";
    //Recipients
    $mail->setFrom('janvi.patel31103@gmail.com', 'Mailer');
    $mail->addAddress($mlid,$mlid);     // Add a recipient
    

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'otp to reset password';
	$cod = rand(1000,9999);
	
	$str="your otp for reset password is<br/><h1>$cod</h1>"; 
	
	
	
    $mail->Body    = $str;
   
	
	
    $mail->send();
    echo 'Message has been sent';
	//header("Location:http://localhost/bakery/client6/np.php");
    } 
	catch (Exception $e) 
	{
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

  




?>





 


