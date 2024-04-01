<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Fetch preferred dates, groom names, bride names, and hall preferences from the database
$sql = "SELECT preferreddate, groomName, brideName, hallpreference FROM registration";
$result = $conn->query($sql);
$preferences = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $date = $row['preferreddate'];
        $groomName = $row['groomName'];
        $brideName = $row['brideName'];
        $preference = $row['hallpreference'];
        if (!empty($date)) {
            $preferences[$date] = [
                'groomName' => $groomName,
                'brideName' => $brideName,
                'hallPreference' => $preference
            ];
        }
    }
}

// Convert the array to JSON format for use in JavaScript
echo json_encode($preferences);
?>
