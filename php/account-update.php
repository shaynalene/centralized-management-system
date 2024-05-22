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

//update account information: account role
if (isset($_POST['changeRole'])){
    $account_id = $_POST["acc_id"];
    $updatedRole = $_POST['role'];
    $stmt = $conn->prepare("UPDATE accounts_list SET role_id = ? WHERE account_id = ?");
    $stmt->bind_param("ii", $updatedRole, $account_id);
    $stmt->execute();
    echo '<script>
            alert("Account Role Updated");
            window.location = "../pages/accounts-list.php";
          </script>';
    exit();
}
?>