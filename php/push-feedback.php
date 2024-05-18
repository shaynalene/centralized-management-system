<?php
// Establish connection to the database
session_start();
include "../php/server.php";
include '../php/onload.php';

$account_id = $_SESSION["account_id"];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $feedbackTitle = $_POST['feedback_title'];
    $feedbackDetails = $_POST['feedback'];

    // Sanitize and validate input data (for demonstration, you can use more robust validation methods)
    $feedbackTitle = mysqli_real_escape_string($conn, $feedbackTitle);
    $feedbackDetails = mysqli_real_escape_string($conn, $feedbackDetails);
 
    $file = $_FILES['image'];
    $filename = $file['name'];
    $imageType = $file['type'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $stmt = $conn->prepare("INSERT INTO feedback_records (feedback_title, feedback, feedback_photo, filename, filetype, account_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssi', $feedbackTitle, $feedbackDetails, $image, $filename, $imageType, $account_id);
    $stmt->execute();
    $stmt->close();

    // Redirect after successful submission
    header("Location: ../pages/user-feedback.php"); // Change to your desired redirect page


/*
    if($file_extension === 'png'){a
        echo 'this is a png file';
        echo '<img src="data:image/png;base64,'.base64_encode($image).'"/>';
    }
    else if($file_extension === 'jpeg' || 'jpg'){
        echo 'this is a jpg file';
        echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'"/>';
    }
    else{
        #echo 'Invalid Format';
    }
    */

    // Close connection
    mysqli_close($conn);
}
?>
