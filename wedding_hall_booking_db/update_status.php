<?php


// Database connection

$conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['date']) && isset($_POST['preference'])) {
        $id = $_POST['id'];
        $date = $_POST['date'];
        $preference = $_POST['preference'];

        // Update status to 1 for the provided ID
        $sql_update_status = "UPDATE registration SET status = 1 WHERE id = $id";
        if ($conn->query($sql_update_status) === TRUE) {
            // Update preferreddate and hallpreference for the provided ID
            $sql_update_date_preference = "UPDATE registration SET preferreddate = '$date', hallpreference = '$preference' WHERE id = $id";
            if ($conn->query($sql_update_date_preference) === TRUE) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}

$conn->close();

?>
