



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Booking Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<style>
    
        /* CSS styles */
        .container1 {
            border: 2px solid green;
            background-color: white;
            padding: 20px;
            width: 80%;
            margin: auto;
            text-align: center;
        }

        .legend {
            color: blue;
            text-align: center;
            margin-top: 20px;
        }

        .legend p {
            margin: 5px 0;
        }

        .horizontal-line {
            border-top: 2px solid green;
            margin: 20px 0;
        }

 /* Calendar Styles */
 .calendar-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* Fixed layout to make all columns equal width */
}

.calendar-table th, .calendar-table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
    width: 12.9%; /* Equal width for each cell (100% / 7) */
    height: 75px; /* Fixed height for each cell */
}

/* Calendar Cell Hover Effect */
.calendar-table td.calendar-cell:hover {
    background-color: #d3d3d3; /* Light grey color */
}
        /* Calendar Legend */
        .legend {
            text-align: center;
            margin-top: 20px;
        }

        .legend p {
            margin: 5px 0;
        }

        /* Navigation Buttons */
        .navigation-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .navigation-button:hover {
            background-color: #45a049;
        }

        .navigation-button:active {
            background-color: #3e8e41;
        }


        .blue-heading {
            color: blue;
        }
        .custom-input {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 5px;
        }
        .submit-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .submit-button:hover {
            background-color: #45a049;
        }
        .submit-button:active {
            background-color: #3e8e41;
        }
        .available{
    color: black;
    
}
.partially-available{
    color: white;
    background-color: yellow;
    
}
.fully-booked{
    color: white;
    background-color: red;
   
}
.fully-booked1{
    color: red;

}
.partially-available1{
    color: yellow;

}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Hall Booking System</title>
</head>
<body>
<div class="container1">
    <h1 style="color: maroon;">Wedding Hall Booking System</h1>
    <div class="horizontal-line"></div>
    <div class="legend">
        <p style="color: blue;font-weight: bold; font-size: 1.5em">[CALENDAR LEGEND]</p>
        <p style="color: black;font-weight: bold;font-size: 1.2em">
            [ ]<span class="available">WHITE</span> : Available
            [ ]<span class="partially-available1"> Yellow </span>: Partially Available
            [ ]<span class="fully-booked1">Red</span> :Fully Booked
        </p>

    </div>
    <div class="calendar">
        <!-- Calendar will be generated here -->
        <?php
 // Database connection
$conn = new mysqli('localhost', 'root', '', 'wedding_hall_booking');
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

// Fetch preferred dates and hall preferences from the database
$sql = "SELECT preferreddate, hallpreference FROM registration";
$result = $conn->query($sql);
$preferences = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $date = $row['preferreddate'];
        $preference = $row['hallpreference'];
        if (!empty($date)) {
            $preferences[$date][] = $preference;
        }
    }
}
// Set the correct timezone
date_default_timezone_set('asia/kolkata'); // Adjust this to your local timezone

// Get current month and year
$month = date('n');
$year = date('Y');

// Check if month and year are set in the URL
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
}

// Get the number of days in the month
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Calculate the first day of the month (0: Sunday, 1: Monday, ..., 6: Saturday)
$firstDayOfMonth = date('w', mktime(0, 0, 0, $month, 1, $year));

// Start the calendar table
echo '<table class="calendar-table">';
echo '<tr><th colspan="7">' . date('F Y', mktime(0, 0, 0, $month, 1, $year)) . '</th></tr>';
echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

// Print empty cells for the days before the first day of the month
echo '<tr>';
for ($i = 0; $i < $firstDayOfMonth; $i++) {
    echo '<td></td>';
}

// Print the days of the month
for ($day = 1; $day <= $daysInMonth; $day++) {
    if (($day + $firstDayOfMonth - 1) % 7 == 0) {
        echo '</tr><tr>';
    }
    $date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
    $class = '';
    $hallPreferenceText = ''; // Reset hallPreferenceText for each date
    $brideNameMainHall = '';
    $groomNameMainHall = '';
    $brideNameNorthHall = '';
    $groomNameNorthHall = '';
    if (isset($preferences[$date])) {
        $preferencesForDate = $preferences[$date];
        if (in_array('mainHall', $preferencesForDate) && in_array('northHall', $preferencesForDate)) {
            // If both hall preferences are present, mark as fully booked
            $class = 'fully-booked';
            $hallPreferenceText = 'Both Main Hall and North Hall';

            // Fetch bride and groom names for Main Hall
            $sqlMainHall = "SELECT brideName, groomName FROM registration WHERE preferreddate = '$date' AND hallpreference = 'mainHall'";
            $resultMainHall = $conn->query($sqlMainHall);
            if ($resultMainHall->num_rows > 0) {
                $rowMainHall = $resultMainHall->fetch_assoc();
                $brideNameMainHall = $rowMainHall['brideName'];
                $groomNameMainHall = $rowMainHall['groomName'];
            }

            // Fetch bride and groom names for North Hall
            $sqlNorthHall = "SELECT brideName, groomName FROM registration WHERE preferreddate = '$date' AND hallpreference = 'northHall'";
            $resultNorthHall = $conn->query($sqlNorthHall);
            if ($resultNorthHall->num_rows > 0) {
                $rowNorthHall = $resultNorthHall->fetch_assoc();
                $brideNameNorthHall = $rowNorthHall['brideName'];
                $groomNameNorthHall = $rowNorthHall['groomName'];
            }
        } elseif (in_array('mainHall', $preferencesForDate)) {
            // If only Main Hall preference is present, mark as partially available
            $class = 'partially-available';
            $hallPreferenceText = 'Main Hall';
        } elseif (in_array('northHall', $preferencesForDate)) {
            // If only North Hall preference is present, mark as partially available
            $class = 'partially-available';
            $hallPreferenceText = 'North Hall';
        }

        // onclick function to show booking details
        echo '<td class="calendar-cell ' . $class . '" onclick="showdetails(\'' . $date . '\', \'' . $hallPreferenceText . '\', \'' . $groomNameMainHall . '\', \'' . $brideNameMainHall . '\', \'' . $groomNameNorthHall . '\', \'' . $brideNameNorthHall . '\')">' . $day;
        
        
        
        if (!empty($hallPreferenceText)) {
            echo '<br>(' . $hallPreferenceText . ')';
        }
        echo '</td>';
    } else {
        // If the date is not a preferred date, just print the day without onclick function
        
        echo '<td class="calendar-cell">' . $day . '</td>';
    }
}

// Close the table
echo '</tr></table>';

// Navigation buttons
$previousMonth = $month - 1;
$previousYear = $year;
if ($previousMonth < 1) {
    $previousMonth = 12;
    $previousYear--;
}
$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}
echo '<button onclick="window.location=\'?month=' . $previousMonth . '&year=' . $previousYear . '\'" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">Previous Month</button>';

echo '<button onclick="window.location=\'?month=' . $nextMonth . '&year=' . $nextYear . '\'" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 4px;">Next Month</button>';

?>

        </div>
        <div class="horizontal-line"></div>
        
        <div class="container">
        <h1 class="blue-heading text-center">BOOKING FORM</h1>
<form id="myForm" action="send.php" method="post">
    <label for="groomName">Groom's Name:</label>
    <input type="text" id="groomName" name="groomName" required><br>
    
    <label for="groomFatherName">Groom's Father's Name:</label>
    <input type="text" id="groomFatherName" name="groomFatherName" required><br>
    
    <label for="groomMotherName">Groom's Mother's Name:</label>
    <input type="text" id="groomMotherName" name="groomMotherName" required><br>
    
    <label for="brideName">Bride's Name:</label>
    <input type="text" id="brideName" name="brideName" required><br>
    
    <label for="brideFatherName">Bride's Father's Name:</label>
    <input type="text" id="brideFatherName" name="brideFatherName" required><br>
    
    <label for="brideMotherName">Bride's Mother's Name:</label>
    <input type="text" id="brideMotherName" name="brideMotherName" required><br>
    
    <label for="contactName">Contact Name:</label>
    <input type="text" id="contactName" name="contactName" required><br>
    
    <label for="contactNumber">Contact Number:</label>
    <input type="text" id="contactNumber" name="contactNumber" required><br>
    
    <label for="contactEmail">Contact Email:</label>
    <input type="email" id="contactEmail" name="contactEmail" required><br>
    
    <label for="preferredDate1">Preferred Date 1:</label>
    <input type="date" id="preferredDate1" name="preferredDate1" min="<?php echo date('Y-m-d'); ?>" required><br>
    
    <label for="hallPreference1">Hall Preference 1:</label><br>
    <input type="radio" id="hallPreference1" name="hallPreference1" value="Option 1" required> Option 1<br>
    <input type="radio" id="hallPreference1" name="hallPreference1" value="Option 2"> Option 2<br>
    <input type="radio" id="hallPreference1" name="hallPreference1" value="Option 3"> Option 3<br>
    
    <label for="preferredDate2">Preferred Date 2:</label>
    <input type="date" id="preferredDate2" name="preferredDate2" min="<?php echo date('Y-m-d'); ?>"><br>
    
    <label for="hallPreference2">Hall Preference 2:</label><br>
    <input type="radio" id="hallPreference2" name="hallPreference2" value="Option 1"> Option 1<br>
    <input type="radio" id="hallPreference2" name="hallPreference2" value="Option 2"> Option 2<br>
    <input type="radio" id="hallPreference2" name="hallPreference2" value="Option 3"> Option 3<br>
    
    <label for="preferredDate3">Preferred Date 3:</label>
    <input type="date" id="preferredDate3" name="preferredDate3" min="<?php echo date('Y-m-d'); ?>"><br>
    
    <label for="hallPreference3">Hall Preference 3:</label><br>
    <input type="radio" id="hallPreference3" name="hallPreference3" value="Option 1"> Option 1<br>
    <input type="radio" id="hallPreference3" name="hallPreference3" value="Option 2"> Option 2<br>
    <input type="radio" id="hallPreference3" name="hallPreference3" value="Option 3"> Option 3<br>
    
    <input type="submit" name="submit" value="Submit">
</form>
</div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
          $(document).ready(function() {
            $('#myForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
    type: 'POST',
    url: $(this).attr('action'),
    data: formData,
    success: function(response) {
        console.log('Success:', response);
        $('#myForm')[0].reset();
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error:', textStatus, errorThrown);
    },
    complete: function(jqXHR, textStatus) {
        console.log('Request Complete:', textStatus);
    }
});

            });
        });


// function showBookingDetails(groomNameMainHall, brideNameMainHall, groomNameNorthHall, brideNameNorthHall, hallPreferenceText) {
//     if (hallPreferenceText === 'Both Main Hall and North Hall') {
//         alert("Main Hall Booked by:\nBride: " + brideNameMainHall + "\nGroom: " + groomNameMainHall + "\n\nNorth Hall Booked by:\nBride: " + brideNameNorthHall + "\nGroom: " + groomNameNorthHall);
//     } else if (hallPreferenceText === 'Main Hall') {
//         alert("Main Hall Booked by:\nBride: " + brideNameMainHall + "\nGroom: " + groomNameMainHall);
//     } else if (hallPreferenceText === 'North Hall') {
//         alert("North Hall Booked by:\nBride: " + brideNameNorthHall + "\nGroom: " + groomNameNorthHall);
//     } else {
//         alert("Date is available.");
//     }
// }
function showdetails(date, hallPreferenceText, groomNameMainHall, brideNameMainHall, groomNameNorthHall, brideNameNorthHall) {
    if (hallPreferenceText === 'Both Main Hall and North Hall') {
        showBookingDetails1(groomNameMainHall, brideNameMainHall, groomNameNorthHall, brideNameNorthHall, hallPreferenceText);
    } else if (hallPreferenceText === 'Main Hall' || hallPreferenceText === 'North Hall') {
        console.log(hallPreferenceText)
        showBookingDetails2(date);
    }
}

function showBookingDetails1(groomNameMainHall, brideNameMainHall, groomNameNorthHall, brideNameNorthHall, hallPreferenceText) {
    alert("Main Hall Booked by:\nBride: " + brideNameMainHall + "\nGroom: " + groomNameMainHall + "\n\nNorth Hall Booked by:\nBride: " + brideNameNorthHall + "\nGroom: " + groomNameNorthHall);
}

function showBookingDetails2(date) {
    // Fetch preferred dates from the PHP file
    $.getJSON('booking_details.php', function(data) {
        // Check if the clicked date is in the preferred dates
        if (data.hasOwnProperty(date)) {
            var details = data[date];
            alert("Date is preferred by:\nGroom: " + details.groomName + "\nBride: " + details.brideName + "\nHall Preference: " + details.hallPreference);
        } else {
            alert("Date is not preferred.");
        }
    });
}

function validateForm() {
    
    var groomName = document.getElementById('groomName').value;
    var groomFatherName = document.getElementById('groomFatherName').value;
    var groomMotherName = document.getElementById('groomMotherName').value;
    var brideName = document.getElementById('brideName').value;
    var brideFatherName = document.getElementById('brideFatherName').value;
    var brideMotherName = document.getElementById('brideMotherName').value;
    var contactName = document.getElementById('contactName').value;
    var contactNumber = document.getElementById('contactNumber').value;
    var contactEmail = document.getElementById('contactEmail').value;
    var preferredDate1 = document.getElementById('preferredDate1').value;
    var preferredDate2 = document.getElementById('preferredDate2').value;
    var preferredDate3 = document.getElementById('preferredDate3').value;
    var hallPreference1 = getRadioValue('hallPreference1');
    var hallPreference2 = getRadioValue('hallPreference2');
    var hallPreference3 = getRadioValue('hallPreference3');
    if ((hallPreference1 === hallPreference2 && preferredDate1 === preferredDate2) ||
        (hallPreference1 === hallPreference3 && preferredDate1 === preferredDate3) ||
        (hallPreference2 === hallPreference3 && preferredDate2 === preferredDate3)) {
        alert("Please choose different hall preferences for each preferred date.");
        return false;
    }

    

    console.log("Groom's Name:", groomName);
    console.log("Groom's Father's Name:", groomFatherName);
    console.log("Groom's Mother's Name:", groomMotherName);
    console.log("Bride's Name:", brideName);
    console.log("Bride's Father's Name:", brideFatherName);
    console.log("Bride's Mother's Name:", brideMotherName);
    console.log("Contact Name:", contactName);
    console.log("Contact Number:", contactNumber);
    console.log("Contact Email:", contactEmail);
    console.log("Preferred Date 1:", preferredDate1);
    console.log("Preferred Date 2:", preferredDate2);
    console.log("Preferred Date 3:", preferredDate3);
    console.log("Hall preference 1:", hallPreference1);
    console.log("Hall preference 2:", hallPreference2);
    console.log("Hall preference 3:", hallPreference3);

    if (groomName == "" || groomFatherName == "" || groomMotherName == "" ||
        brideName == "" || brideFatherName == "" || brideMotherName == "" ||
        contactName == "" || contactNumber == "" || contactEmail == "" || preferredDate1 == "") {
        showToast("Please fill in all the details.");
        return false;
    } else {
        return true;
    }
}

function getRadioValue(name) {
    var radios = document.getElementsByName(name);
    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            return radios[i].value;
        }
    }
    return ""; // Return empty string if no radio button is checked
}
$(document).ready(function() {
    // Event listener for preferredDate1
    $('#preferredDate1').change(function() {
        checkAvailability($(this).val(), 'hallPreference1');
    });

    // Event listener for preferredDate2
    $('#preferredDate2').change(function() {
        checkAvailability($(this).val(), 'hallPreference2');
    });

    // Event listener for preferredDate3
    $('#preferredDate3').change(function() {
        checkAvailability($(this).val(), 'hallPreference3');
    });
});

function checkAvailability(date, hallPreferenceName) {
    $.ajax({
        url: 'check_availability.php',
        type: 'GET',
        data: {date: date},
        dataType: 'json',
        success: function(data) {
            // Assuming the PHP script returns an array of hall preferences for the date
            // Disable the radio buttons based on the returned data
            $('input[name="' + hallPreferenceName + '"]').each(function() {
                if (data.includes($(this).val())) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
        }
    });
}


</script>

</body>
</html>
