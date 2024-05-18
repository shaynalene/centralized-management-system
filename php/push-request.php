<?php
// Establish connection to the database
session_start();
include "../php/server.php";
include '../php/onload.php';

$account_id = $_SESSION["account_id"];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $for = $_POST['for'];
    $documentType = strtolower($_POST['document_type']);
    $ticket_number = '1';
    $reason = $_POST['req_reason'];
    $status = 'pending';

    // Sanitize and validate input data
    $for = mysqli_real_escape_string($conn, $for);
    $documentType = mysqli_real_escape_string($conn, $documentType);
    $reason = mysqli_real_escape_string($conn, $reason);

    // Determine document ID based on document type
    if ($documentType == 'permit') {
        $document_id = 1;
    } elseif ($documentType == 'clearance') {
        $document_id = 2;
    } elseif ($documentType == 'barangay id') {
        $document_id = 3;
    } elseif ($documentType == 'certificate of residency') {
        $document_id = 4;
    } else {
        // Handle invalid document type
        echo "Invalid document type: " . $documentType;
        exit();
    }



        // If the request is for a child, insert the child's name into another table
        if ($for == 'Others: Child') {
            $child_name = mysqli_real_escape_string($conn, $_POST['child_name']);
            $insertChildQuery = "INSERT INTO document_requests_family (ticket_number, document_id, name) VALUES ('$ticket_number', '$document_id', '$child_name')";
            mysqli_query($conn, $insertChildQuery);
        }
        else{
            // Check if the user has already made a request for the same document type
            $existingRequestQuery = "SELECT * FROM document_requests WHERE account_id = '$account_id' AND document_id = '$document_id'";
            $existingRequestResult = mysqli_query($conn, $existingRequestQuery);
            if (mysqli_num_rows($existingRequestResult) > 0) {
                echo '<script>
                alert("You already made a transaction of the same document type. Please visit the barangay hall for further verification.");
                window.location.href = "../pages/permit-req.php";
                </script>';
                exit();
            }
        }
    

    // Construct SQL query to insert into document_requests table
    $documentRequestQuery = "INSERT INTO document_requests (ticket_number, document_id, account_id, status, reason) 
                             VALUES ('$ticket_number', '$document_id', '$account_id', '$status', '$reason')";

    // Execute query for document_requests table insertion
    if (mysqli_query($conn, $documentRequestQuery)) {
        echo "Request submitted successfully.";
        header("Location: ../pages/permit-req.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
