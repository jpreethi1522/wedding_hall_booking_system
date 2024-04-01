<?php

// Create connection
$conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking', 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$groomName = $_POST['groomName'];
$groomFatherName = $_POST['groomFatherName'];
$groomMotherName = $_POST['groomMotherName'];
$brideName = $_POST['brideName'];
$brideFatherName = $_POST['brideFatherName'];
$brideMotherName = $_POST['brideMotherName'];
$contactName = $_POST['contactName'];
$contactNumber = $_POST['contactNumber'];
$contactEmail = $_POST['contactEmail'];
$preferredDate1 = $_POST['preferredDate1'];
$preferredDate2 = $_POST['preferredDate2'];
$preferredDate3 = $_POST['preferredDate3'];
$hallPreference1 = $_POST['hallPreference1'];
$hallPreference2 = $_POST['hallPreference2'];
$hallPreference3 = $_POST['hallPreference3'];

// Prepare SQL statement
$sql = "INSERT INTO registration (groomName, groomFatherName, groomMotherName, brideName, brideFatherName, brideMotherName, contactName, contactNumber, contactEmail, preferredDate1, preferredDate2, preferredDate3, hallPreference1, hallPreference2, hallPreference3) VALUES ('$groomName', '$groomFatherName', '$groomMotherName', '$brideName', '$brideFatherName', '$brideMotherName', '$contactName', '$contactNumber', '$contactEmail', '$preferredDate1', '$preferredDate2', '$preferredDate3', '$hallPreference1', '$hallPreference2', '$hallPreference3')";

if ($conn->query($sql) === TRUE) { echo '';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();

// Email sending
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
    // $mail->SMTPDebug=4;

    $mail->setFrom('preethivit@gmail.com');
    $mail->addAddress($contactEmail);
    $mail->isHTML(true);
    $mail->Subject = 'Form Submission Confirmation';
    $mail->Body = "Dear $contactName,<br><br>Thank you for reaching out to us.<br><br>We are writing to confirm that we have received your form submission successfully. Our team has been notified of your inquiry, and we are now in the process of reviewing the information provided.<br><br>Rest assured, we are committed to addressing your query promptly and efficiently. We will be reaching out to you as soon as possible with further details or any additional steps required.<br><br>We appreciate your interest in us, and we look forward to assisting you further.<br><br>Best regards,<br>Thank you,";
    $mail->send();

    $mail->clearAddresses(); 
    $mail->addAddress('vimegh@gmail.com'); //admin email
    $mail->isHTML(true);
    $mail->Subject = 'New Booking Form Submission';
    $mail->Body = "
            <p>Groom's Name: $groomName</p>
            <p>Bride's Name: $brideName</p>
            <p>Contact Name: $contactName</p>
            <p>Contact Email: $contactEmail</p>
            <p>Contact Number: $contactNumber</p>
            <p>Preferred Dates:</p>
            <ul><b><h2>
                <li>Date 1: $preferredDate1, Hall Preference: $hallPreference1</li>
                <li>Date 2: $preferredDate2, Hall Preference: $hallPreference2</li>
                <li>Date 3: $preferredDate3, Hall Preference: $hallPreference3</li></h2></b>
            </ul>
            <p><b>Please confirm a slot based on  details of preferred dates and hall preferences.</b></p>";
    $mail->send();

    // echo "Emails sent successfully";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}





?>
