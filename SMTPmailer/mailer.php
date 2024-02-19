<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
// Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$Durl = __DIR__ . '/credentials.json';
$details_handle = fopen($Durl, "r");
$details = json_decode(fread($details_handle, filesize($Durl)));

// Save resource
fclose($details_handle);

// Instantiation and passing `true` enables exceptions

function send_mail(array $recipients, $subject, $body, $from = 'info@siitgo.com', $from_name = null, $replyTo = 'info@siitgo.com', $isANHTML = false)
{
    global $details;
    
    $host = $details->host;
    $username = $details->username;
    $password = $details->password;
    $port = 587;

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = $host; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $username; // SMTP username
        $mail->Password = $password; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $port; // TCP port to connect to

        //Recipients
        if ($from_name) {
            $mail->setFrom($from, $from_name);
        } else {
            $mail->setFrom($from);
        }
        $mail->addReplyTo($replyTo);
        $mail->addAddress($recipients[0]); // Add a recipient

        for ($i = 1; $i < count($recipients); $i++) {
            $mail->addBCC($recipients[$i]);
        }

        // Content
        $mail->isHTML($isANHTML); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        // $mail->AltBody = strip_tags($body);
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
    return false;
}

// print_r(send_mail(['levischat@gmail.com', 'cgi.helpcentre@gmail.com'], 'Hello, test!', 'My body test!', 'info@siitgo.com', 'info@siitgo.com'));
