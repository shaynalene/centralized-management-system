<?php
session_start();
// Establish connection to the database
include "../php/server.php";
include "../php/onload.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Name_Of_Respondent = $_POST['Name_Of_Respondent'];
    $Address_Of_The_Respondent = $_POST['Address_Of_The_Respondent'];
    $Summary_Of_The_Complaint = $_POST['Summary_Of_The_Complaint'];
    $accountID = $_SESSION["account_id"];
    $name = $_SESSION["name"];


    // Sanitize and validate input data (for demonstration, you can use more robust validation methods)
    $Name_Of_Complainant = $name;
    $Name_Of_Respondent = mysqli_real_escape_string($conn, $Name_Of_Respondent);
    $$Address_Of_The_Respondent = mysqli_real_escape_string($conn, $Address_Of_The_Respondent);
    $Summary_Of_The_Complaint = mysqli_real_escape_string($conn, $Summary_Of_The_Complaint);
    $status = "Pending";
 
    $file = $_FILES['image'];
    $filename = $file['name'];
    $imageType = $file['type'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $stmt = $conn->prepare("INSERT INTO complaint_records (Name_Of_Complainant, Name_Of_Respondent, Address_Of_The_Respondent, Summary_Of_The_Complaint, complaint_photo, filename, filetype, account_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssssis',  $Name_Of_Complainant, $Name_Of_Respondent, $Address_Of_The_Respondent, $Summary_Of_The_Complaint, $image, $filename, $imageType,  $accountID, $status);
    $stmt->execute();
    $stmt->close();


    // Redirect after successful submission
    header("Location: ../pages/user_side-complaint.php"); // Change to your desired redirect page


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
