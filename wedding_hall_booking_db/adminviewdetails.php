<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .hall-preference-container {
            background-color: blue;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            margin-top: 15px;
            margin-right: 20px;
            display: inline-block;
        }

        .btn-success.active,
        .btn-success:active {
            background-color: orange !important;
        }

        .hall-preference-container.active {
            background-color: orange !important;
        }

        /* Add spacing between buttons */
        .btn-group .btn {
            margin-right: 10px; /* Updated margin-right */
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Registered Users</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Groom Name</th>
                    <th>Groom Father's Name</th>
                    <th>Groom Mother's Name</th>
                    <th>Bride Name</th>
                    <th>Bride Father's Name</th>
                    <th>Bride Mother's Name</th>
                    <th>Contact Name</th>
                    <th>Contact Number</th>
                    <th>Contact Email</th>
                    <th colspan="7">Preferred Dates</th>
                    <th>Status</th>
                </tr>
            </thead>
            <form id="exportForm" action="export_data.php" method="post">
                <input type="submit" id="exportDataBtn" value="Export Data">
            </form>

            <tbody>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking');
            if ($conn->connect_error) {
                die('Connection Failed : ' . $conn->connect_error);
            }

            // Fetch data from the table
            $sql = "SELECT * FROM registration";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['groomName'] . "</td>";
                    echo "<td>" . $row['groomFatherName'] . "</td>";
                    echo "<td>" . $row['groomMotherName'] . "</td>";
                    echo "<td>" . $row['brideName'] . "</td>";
                    echo "<td>" . $row['brideFatherName'] . "</td>";
                    echo "<td>" . $row['brideMotherName'] . "</td>";
                    echo "<td>" . $row['contactName'] . "</td>";
                    echo "<td>" . $row['contactNumber'] . "</td>";
                    echo "<td>" . $row['contactEmail'] . "</td>";
                    echo "<td colspan='7'>";
                    echo "<div class='d-flex flex-row justify-content-between'>"; // Start of flex container with row direction

                    $status = $row['status'];

                    // Loop through preferred dates
                    for ($i = 1; $i <= 3; $i++) {
                        $dateKey = 'preferredDate' . $i;
                        $prefKey = 'hallPreference' . $i;

                        if ($status == 1 && $row[$dateKey] == $row['preferreddate'] && $row[$prefKey] == $row['hallpreference']) {
                            echo "<div class='d-flex flex-column align-items-center'>";
                            echo "<button style='margin-right: 10px; margin-bottom: 5px; padding: 5px 20px; border-radius: 5px; background-color: orange; color: white; border: none;' class='preferred-date active' data-date='" . $row[$dateKey] . "' data-preference='" . $row[$prefKey] . "'>" . $row[$dateKey] . "</button>";
                            echo "<div class='hall-preference-container preference-display' style='background-color: orange; padding: 5px 20px; border-radius: 5px; color: white; margin-top: 10px;'>" . $row[$prefKey] . "</div>";
                            echo "</div>";
                        } else {
                            echo "<div class='d-flex flex-column align-items-center'>";
                            echo "<button style='margin-right: 10px; margin-bottom: 5px; padding: 5px 20px; border-radius: 5px; background-color: green; color: white; border: none;' class='preferred-date' data-date='" . $row[$dateKey] . "' data-preference='" . $row[$prefKey] . "'>" . $row[$dateKey] . "</button>";
                            echo "<div class='hall-preference-container preference-display' style='background-color: blue; padding: 5px 20px; border-radius: 5px; color: white; margin-top: 10px;'>" . $row[$prefKey] . "</div>";
                            echo "</div>";
                        }
                    }
                    if ($status == 0) {
                        echo "<button style='padding: 15px 20px; border-radius: 5px; background-color: grey; color: white; border: none; display: block; margin: 0 auto; margin-top: 50px;' class='cancel-btn' onclick='cancelBooking(" . $row['id'] . ")'>Cancel</button>";
                    } else {
                        // Check if preferred date is '0000-00-00'
                        if ($row['preferreddate'] == '0000-00-00') {
                            echo "<button style='padding: 15px 20px; border-radius: 5px; background-color: red; color: white; border: none; display: block; margin: 0 auto; margin-top: 50px;' class='cancel-btn disabled' disabled>Cancel</button>";
                        } else {
                            echo "<button style='padding: 15px 20px; border-radius: 5px; background-color: grey; color: white; border: none; display: block; margin: 0 auto; margin-top: 50px;' class='cancel-btn' onclick='cancelBooking(" . $row['id'] . ")'>Cancel</button>";
                        }
                    }
                    echo "</div>"; // End of flex container
                    echo "</td>";

                    // Display status
                    echo "<td id='status" . $row['id'] . "'>";
                    if ($status == 0) {
                        echo "Pending";
                    } else {
                        echo "Done";
                    }
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14'>No records found</td></tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $('.preferred-date').click(function() {
        var status = $(this).closest('tr').find('td:last').text().trim();
        if (status === 'Done') {
            alert('This record has already been processed. No further updates allowed.');
            return;
        }
        var serialNo = $(this).closest('tr').find('td:first').text().trim(); // Get the serial number
        var id = $(this).closest('tr').find('td:first').text().trim(); // Get the id
        var date = $(this).data('date');
        var preference = $(this).data('preference');
        var contactEmail = $(this).closest('tr').find('td:nth-child(10)').text().trim(); // Assuming the contact email is in the 10th column

        $.ajax({
            url: 'send_booking_email.php',
            method: 'POST',
            data: { contactEmail: contactEmail, date: date, preference: preference },
            success: function(response) {
                console.log(response);
            }
        });

        $(this).addClass('active');
        $(this).next('.hall-preference-container').addClass('active');

        console.log("Data sent to server:", { id: id, date: date, preference: preference });
        setTimeout(function() {
            location.reload();
        }, 300);

        $.ajax({
            url: 'update_status.php',
            method: 'POST',
            data: { id: id, date: date, preference: preference },
            success: function(response) {
                if (response.trim() === 'success') {
                    var statusCell = $('#status' + serialNo); // Use the serial number to find the status cell
                    statusCell.text('Done');
                    console.log(response);
                } else {
                    alert('Failed to update status');
                }
            }
        });

        $('.preferred-date').not(this).prop('disabled', true);
    });
    function cancelBooking(id) {
    $('.preferred-date').prop('disabled', true);
    $('.cancel-btn').prop('disabled', true);
    $('.cancel-btn').addClass('disabled');
    $('#cancelBtn' + id).removeClass('disabled').addClass('active');
    $('#status' + id).text('Done');
    var contactEmail = $('#status' + id).closest('tr').find('td:nth-child(10)').text().trim();
    $('#status' + id).closest('tr').find('.preferred-date, .cancel-btn').prop('disabled', true);

    $.ajax({
        url: 'cancel_booking.php', // Adjust the URL to your cancellation script
        method: 'POST',
        data: { id: id, contactEmail: contactEmail },
        success: function(response) {
            console.log(response);
            // Update the status to 'Done' after successful cancellation
            $('#status' + id).text('Done');
        }
    });
    setTimeout(function() {
        location.reload();
    }, 300);
}

</script>

</body>
</html>
