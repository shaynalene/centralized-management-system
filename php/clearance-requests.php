<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

//disapprove request
if (isset($_POST['disapproveReq'])){
  $account_id = $_POST["account_id"];
    $ticket_number = $_POST["reqNumber"];
    $document_id = 2;
    $status = 'disapproved';
    $stmt = $conn->prepare("UPDATE document_requests SET status = ? WHERE account_id = ? and ticket_number = ? and document_id = ?");
    $stmt->bind_param("siii", $status, $account_id, $ticket_number, $document_id);
    $stmt->execute();
    echo '<script>
            alert("Request Disapproved");
            window.location = "../pages/staff-clearance-requests.php";
          </script>';
    exit();
}

//approve request
if (isset($_POST['approveReq'])){
  $account_id = $_POST["account_id"];
    $document_id = 2;
    $ticket_number = $_POST["reqNumber"];
    $status = 'approved';
    $stmt = $conn->prepare("UPDATE document_requests SET status = ? WHERE account_id = ? and ticket_number = ? and document_id = ?");
    $stmt->bind_param("siii", $status, $account_id, $ticket_number, $document_id);
    $stmt->execute();
    echo '<script>
            alert("Request Approved");
            window.location = "../pages/staff-clearance-requests.php";
          </script>';
    exit();
}
?>