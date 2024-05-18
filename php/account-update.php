<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

//update account information: email, number, password
if (isset($_POST['updateInfo'])){
    $account_id = $_SESSION["account_id"];
    $updatedEmail = $_POST['editEmail'];
    $updatedNumber = $_POST['editNumber'];
    $stmt = $conn->prepare("UPDATE accounts_list SET email = ?, contact_number = ? WHERE account_id = ?");
    $stmt->bind_param("sii", $updatedEmail, $updatedNumber, $account_id);
    $stmt->execute();
    echo '<script>
            alert("Account Information Updated");
            window.location = "../pages/account-information.php";
          </script>';
    exit();
  }
?>