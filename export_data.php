<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Fetch data from the table where status == 1
$sql = "SELECT * FROM registration WHERE status = 1";
$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Export data to Excel
exportToExcel($data);

function exportToExcel($data) {
    $fileName = "exported_data_" . date('Y-m-d') . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    $showColumn = false;
    foreach ($data as $record) {
        if (!$showColumn) {
            echo implode("\t", array_keys($record)) . "\n";
            $showColumn = true;
        }
        echo implode("\t", array_values($record)) . "\n";
    }
    exit;
}

$conn->close();
?>
