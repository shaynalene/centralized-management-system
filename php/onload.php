<?php
// Check if the user is logged in
if (!isset($_SESSION["account_id"])) {
  header("Location: pages/account-login.html");
  exit();
}

//get the data from table
$account_id = $_SESSION["account_id"];
$sql = "SELECT * FROM accounts_list WHERE account_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $account_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

//place data in corresponding variables
$firstname = $row["firstname"];
$middlename = $row["middlename"];
$lastname = $row["lastname"];
$name = $firstname . ' ' . $middlename . ' ' . $lastname;

$birthday = $row["birthday"];
$email = $row["email"];
$number = $row["contact_number"];

//account role
$account_id = $_SESSION["account_id"];
$stmt = $conn->prepare("SELECT * FROM accounts_list AL
                        INNER JOIN account_role AR 
                        ON AL.account_id=? WHERE AL.role_id=AR.role_id");
$stmt->bind_param("i", $account_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$role = $row['system_role'];

//account avatar
$account_id = $_SESSION["account_id"];
$stmt = $conn->prepare("SELECT * FROM image_avatar WHERE account_id=?");
$stmt->bind_param("i", $account_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $file_extension = pathinfo($row["filename"], PATHINFO_EXTENSION);
  $image = $row['avatar'];
  
  if($file_extension === 'png'){
    $display = '<img src="data:image/png;base64,'.base64_encode($image).'"/>';
  }
  else if($file_extension === 'jpeg' || 'jpg'){
    $display = '<img src="data:image/jpeg;base64,'.base64_encode($image).'"/>';
  }
  else{
    #echo 'Invalid Format';
  }
}
else{
  $display = '<img
  src="../dist/img/user2-160x160.jpg"
  class="img-circle elevation-2"
  alt="User Image"
/>';
}
?>