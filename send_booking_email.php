<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'preethivit@gmail.com';   //your gmail
    $mail->Password = 'iuiw qptj sdnq tiwg';    //your password from google account
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587;

    $mail->setFrom('preethivit@gmail.com');
    $mail->addAddress($_POST['contactEmail']);
    $mail->isHTML(true);
    $mail->Subject = 'Slot Booked Confirmation';
    $mail->Body = "Dear User,<br><br>We are pleased to inform you that your slot has been successfully booked! <br>Thank you for choosing our services.
    
    Here are the details of your booking:<br><br><b>Date: " . $_POST['date'] . "<br>Hall Preference: " . $_POST['preference']."<br><br>Thanks & Regards";
    $mail->send();
    $mail->clearAddresses(); // Clear previous recipient

    // Sending confirmation to admin
    $mail->addAddress('vimegh@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Slot confirmation';
$mail->Body = "<p>Hello Admin,</p>
              <p>A slot has been booked. Here are the details:</p>
              <ul>
                <li><strong>Date:</strong> {$_POST['date']}</li>
                <li><strong>Hall Preference:</strong> {$_POST['preference']}</li>
                <li><strong>Contact Email:</strong> {$_POST['contactEmail']}</li>
                <!-- Add more details as needed -->
              </ul>
              <p>Thank you!</p>"; // Add HTML tags
$mail->send();

    echo "Email sent successfully";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
