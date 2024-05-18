<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

$account_id = $_SESSION["account_id"];

    $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE account_id=?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $hashed_password = $row["password"];

$current = $_POST["currentPassword"];
$new = $_POST["newPassword"];
$confirm = $_POST["confirmPassword"];

if (password_verify($current, $hashed_password)) {
    
    if ($new == $confirm) {
        $new_password = password_hash($new, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE accounts_list SET password = ? WHERE account_id = ?");
        $stmt->bind_param("si", $new_password, $account_id);
        $stmt->execute();
        echo '  <script>
                    alert("Password Updated Succcessfully");
                    window.location = "../pages/account-information.php";
                </script>';
    }
    else{
        echo '  <script>
                    alert("Passwords do not match");
                    window.location = "../pages/account-information.php";
                </script>';
    }
}
else{
    echo '  <script>
                    alert("Incorrect Password");
                    window.location = "../pages/account-information.php";
                </script>';
}


?>