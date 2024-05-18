<?php
// Establish connection to the database
include "../php/server.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Title = $_POST['Title'];
    $Created_By = $_POST['Created_By'];
    $Content = $_POST['Content'];

    // Sanitize and validate input data (for demonstration, you can use more robust validation methods)
    $Title = mysqli_real_escape_string($conn,  $Title);
    $Created_By = mysqli_real_escape_string($conn,  $Created_By);
    $Content = mysqli_real_escape_string($conn, $Content);



    $file = $_FILES['image'];
    $filename = $file['name'];
    $imageType = $file['type'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $stmt = $conn->prepare("INSERT INTO announcements (Title, Created_By, Content, announcement_photo, filename, filetype) VALUES ( ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $Title, $Created_By, $Content, $image, $filename, $imageType);
    $stmt->execute();
    $stmt->close();

// Redirect after successful submission
header("Location: ../pages/admin_side-add_announcement.php"); // Change to your desired redirect page


/*
    if($file_extension === 'png'){a
        echo 'this is a png file';
        echo '<img src="data:image/png;base64,'.base64_encode($image).'"/>';
    }
    else if($file_extension === 'jpeg' || 'jpg'){
        ec<?php
// Establish connection to the database
include "../php/server.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Title = $_POST['Title'];
    $Created_By = $_POST['Created_By'];
    $Content = $_POST['Content'];

    // Sanitize and validate input data (for demonstration, you can use more robust validation methods)
    $Title = mysqli_real_escape_string($conn,  $Title);
    $Created_By = mysqli_real_escape_string($conn,  $Created_By);
    $Content = mysqli_real_escape_string($conn, $Content);



    $file = $_FILES['image'];
    $filename = $file['name'];
    $imageType = $file['type'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $stmt = $conn->prepare("INSERT INTO announcements (Title, Created_By, Content, announcement_photo, filename, filetype) VALUES ( ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $Title, $Created_By, $Content, $image, $filename, $imageType);
    $stmt->execute();
    $stmt->close();

// Redirect after successful submission
header("Location: ../pages/admin_side-add_announcement.php"); // Change to your desired redirect page


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
?>ho 'this is a jpg file';
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