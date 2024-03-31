<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Get the date from the AJAX request
$date = $_GET['date'];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT hallpreference FROM registration WHERE preferreddate = ?");
$stmt->bind_param("s", $date);

// Execute the query
$stmt->execute();

$result = $stmt->get_result();
$preferences = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $preferences[] = $row['hallpreference'];
    }
}

// Return the hall preferences as JSON
echo json_encode($preferences);
?>
