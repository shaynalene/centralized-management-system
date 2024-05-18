<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

//disapprove request
if (isset($_POST['disapproveComplaint'])){
    $account_id = $_SESSION["account_id"];
    $complaint_id = $_POST["Complaint_ID"];
    
    $status = 'disapproved';
    $stmt = $conn->prepare("UPDATE complaint_records SET status = ? WHERE Account_ID = ? and Complaint_ID =?");
    $stmt->bind_param("sii", $status, $account_id, $complaint_id);
    $stmt->execute();
    echo '<script>
            alert("Request Disapproved" $complaint_id);
            window.location = "../pages/admin_side-complaint_records.php";
          </script>';
    exit();
}

//approve request
if (isset($_POST['approveComplaint'])){
    $account_id = $_SESSION["account_id"];
    $complaint_id = $_POST["Complaint_ID"];

    $status = 'approved';
    $stmt = $conn->prepare("UPDATE complaint_records SET status = ? WHERE Account_ID = ? and Complaint_ID =?");
    $stmt->bind_param("sii", $status, $account_id, $complaint_id);
    $stmt->execute();
    echo '<script>
            alert("Request Approved");
            window.location = "../pages/admin_side-complaint_records.php";
          </script>';
    exit();
}
?>