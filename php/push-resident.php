<?php
// Establish connection to the database
include "../php/server.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $First_Name = $_POST['First_Name'];
    $Middle_Name = $_POST['Middle_Name'];
    $Last_Name = $_POST['Last_Name'];
    $Birthdate = $_POST['Birthdate'];
    $Gender = $_POST['Gender'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];

    // Sanitize and validate input data (for demonstration, you can use more robust validation methods)
    $First_Name = mysqli_real_escape_string($conn, $First_Name);
    $Middle_Name = mysqli_real_escape_string($conn,  $Middle_Name);
    $Last_Name = mysqli_real_escape_string($conn, $Last_Name);
    $Birthdate  = mysqli_real_escape_string($conn, $Birthdate );
    $Gender = mysqli_real_escape_string($conn,$Gender);
    $Phone = mysqli_real_escape_string($conn, $Phone);
    $Address = mysqli_real_escape_string($conn, $Address);


    $file = $_FILES['image'];
    $filename = $file['name'];
    $imageType = $file['type'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $stmt = $conn->prepare("INSERT INTO resident_population (First_Name, Middle_Name, Last_Name, Birthdate, Gender, Phone, Address, resident_photo, filename, filetype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssss', $First_Name, $Middle_Name, $Last_Name, $Birthdate, $Gender, $Phone, $Address, $image, $filename, $imageType);
    $stmt->execute();
    $stmt->close();

// Redirect after successful submission
header("Location: ../pages/admin_side-add_resident.php"); // Change to your desired redirect page


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