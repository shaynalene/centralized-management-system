<?php
// Establish connection to the database
include "../php/server.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Commercial_Name = $_POST['Commercial_Name'];
    $Owner_First_Name = $_POST['Owner_First_Name'];
    $Owner_Middle_Name = $_POST['Owner_Middle_Name'];
    $Owner_Last_Name = $_POST['Owner_Last_Name'];
    $Contact_Number = $_POST['Contact_Number'];
    $Location = $_POST['Location'];
    $Validity = $_POST['Validity'];

    // Sanitize and validate input data (for demonstration, you can use more robust validation methods)
    $Commercial_Name = mysqli_real_escape_string($conn, $Commercial_Name);
    $Owner_First_Name = mysqli_real_escape_string($conn,  $Owner_First_Name);
    $Owner_Middle_Name = mysqli_real_escape_string($conn,  $Owner_Middle_Name);
    $Owner_Last_Name = mysqli_real_escape_string($conn, $Owner_Last_Name);
    $Contact_Number = mysqli_real_escape_string($conn, $Contact_Number );
    $Location = mysqli_real_escape_string($conn,$Location);
    $Validity = mysqli_real_escape_string($conn, $Validity);


    $file = $_FILES['image'];
    $filename = $file['name'];
    $imageType = $file['type'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $stmt = $conn->prepare("INSERT INTO commercial_population (Commercial_Name, Owner_First_Name, Owner_Middle_Name, Owner_Last_Name, Contact_Number, Location, Validity, commercial_photo, filename, filetype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssss', $Commercial_Name, $Owner_First_Name, $Owner_Middle_Name, $Owner_Last_Name, $Contact_Number, $Location, $Validity,  $image, $filename, $imageType);
    $stmt->execute();
    $stmt->close();

// Redirect after successful submission
header("Location: ../pages/admin_side-add_commercial.php"); // Change to your desired redirect page


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