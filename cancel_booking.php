<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['contactEmail'])) {
        $id = $_POST['id'];
        $contactEmail = $_POST['contactEmail'];

        // Update status to 1 for the provided ID
        $sql_update_status = "UPDATE registration SET status = 1 WHERE id = $id";
        if ($conn->query($sql_update_status) === TRUE) {


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
    // $mail->SMTPDebug=4;

    $mail->setFrom('preethivit@gmail.com');
    $mail->addAddress($_POST['contactEmail']);
    $mail->isHTML(true);
    $mail->Subject = 'Slot Cancellation Confirmation';
    $mail->Body = "<p>Dear User,</p>
    <p>We regret to inform you that your slot booking has been cancelled. We apologize for any inconvenience this may cause.</p>
    <p>If you have any questions or need further assistance, please feel free to contact us.</p>
    <p>Thank you for your understanding.</p>
    <p>Thanks & Regards,</p>";
        $mail->send();
    $mail->clearAddresses(); 
    $mail->addAddress('vimegh2@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Slot Cancelled';
    $mail->Body = "<p>Hello Admin,</p>
              <p>A slot has been cancelled successfully. Here are the details:</p>
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
          
    } else {
        echo 'error';
    }
}}

$conn->close();
?>
