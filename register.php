<?php
include 'db_connect.php';
require 'phpqrcode/qrlib.php';

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$birthday = $_POST['birthday']; 
$course = $_POST['course'];
$exam_date = $_POST['exam_date'];

// Generate unique code
$uniqueID = uniqid("STU", true);

// Encode data for QR
$qrData = "ID:$uniqueID | Name:$fullname | Email:$email | Birthday:$birthday | Course:$course | Exam:$exam_date";

// Folder for QR images
$tempDir = "qrcodes/";
if (!file_exists($tempDir)) {
  mkdir($tempDir);
}

// File name for QR
$fileName = $uniqueID . ".png";
$filePath = $tempDir . $fileName;

// Generate QR image
QRcode::png($qrData, $filePath, QR_ECLEVEL_L, 4);

// Save to database
$sql = "INSERT INTO students (fullname, email, birthday, course, exam_date, qr_text, qr_code)
        VALUES ('$fullname', '$email', '$birthday', '$course', '$exam_date', '$qrData', '$fileName')";

if (mysqli_query($conn, $sql)) {
  header("Location: schedule.php?qr=$fileName&name=$fullname&date=$exam_date&code=$uniqueID&bday=$birthday");
} else {
  echo "Database Error: " . mysqli_error($conn);
}
?>
