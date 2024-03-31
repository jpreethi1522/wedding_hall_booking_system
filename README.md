![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/4ba8f065-fb15-4983-998f-a1324dc73f50)
# wedding_hall_booking_system
user can give the preferreddates through form when he submits , realtime email is sent to admin and user and when admin confirms the booking a realtime confirmation or cancellation email is sent to both user and admin and even we can download this data into excel format
MySQL - setup 
1.Create a database name = wedding_hall_booking 
2.Under this either manually create a table with name = registration or just execute this query 
CREATE TABLE registration (
    id INT(50) AUTO_INCREMENT PRIMARY KEY,
    groomName VARCHAR(50) NOT NULL,
    groomFatherName VARCHAR(50) NOT NULL,
    groomMotherName VARCHAR(50) NOT NULL,
    brideName VARCHAR(50) NOT NULL,
    brideFatherName VARCHAR(50) NOT NULL,
    brideMotherName VARCHAR(50) NOT NULL,
    contactName VARCHAR(50) NOT NULL,
    contactNumber INT(50) NOT NULL,
    contactEmail VARCHAR(50) NOT NULL,
    preferredDate1 DATE ,
    hallPreference1 VARCHAR(50) DEFAULT '',
    preferredDate2 DATE ,
    hallPreference2 VARCHAR(50) DEFAULT '',
    preferredDate3 DATE ,
    hallPreference3 VARCHAR(50) DEFAULT '',
    preferreddate DATE ,
    hallpreference VARCHAR(50) DEFAULT '',
    status TINYINT(1) DEFAULT 0
);
once you do this your sql will look like this 
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/4b621d23-b7c8-495d-9c6f-7d3e84a1bd4b)

2.Replace the email and password in send.php , send_booking_email.php , cancel_booking.php 
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/acacd4c9-b694-42d7-872c-cc3ca32aeaae)

you can get your google app key follow these steps
1.https://myaccount.google.com/
2.Go to Security
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/fdc36d3e-2c8c-4064-bb0b-71c2877ef685)
3.enable 2 step verification and create app name and copy password
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/9a25e295-f216-40bf-b191-30b6d6d02fbe)
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/95f915cb-7663-46fc-ae60-e4e45106c487)
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/42703008-21a9-43be-afd7-6589f73ab0b9)

4.paste it in the specified files.

3.Run the apllication
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/78e1a971-573e-435d-81b7-7f96a28e1948)

first : open wedding.php
second : open admin.php
4.admin name admin@gmail.com and password: admin@abcd

OutPut
User Side
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/b2c7aa71-1886-4593-ad72-40bc4ebfc96f)
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/8125d00e-3893-4f12-b477-a73188d4f0f1)
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/f2c8b8c6-02e2-4b53-8b2e-b4c746df9691)
with previous dates disabled
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/ba83a997-ff94-422d-9cb5-7483ae45c731)
Admin side 
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/9d5de62e-adb7-4d1c-87bc-6cd3f6fade88)
admin name admin@gmail.com and password: admin@abcd
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/53f0dcd0-5f27-4a92-aa04-4278d55c0e42)
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/9c4b271c-26ff-4e7b-94c3-daf352186cb4)
![image](https://github.com/jpreethi1522/wedding_hall_booking_system/assets/120386192/5650f25a-a167-4886-b4f2-443cd7b7a074)



















