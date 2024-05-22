<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

include "server.php";

//get data from html form



//disapprove request
if (isset($_POST['disapproveComplaint'])){
    $account_id = $_POST["acc_id"];
    $complaint_id = $_POST["Complaint_ID"];
    
    $status = 'Disapproved';
    $stmt = $conn->prepare("UPDATE complaint_records SET status = ? WHERE Account_ID = ? and Complaint_ID =?");
    $stmt->bind_param("sii", $status, $account_id, $complaint_id);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE Account_ID = ?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $firstname = $row['firstname'];
      $middlename = $row['middlename'];
      $lastname = $row["lastname"];
      $name = $firstname . ' ' . $lastname;
      $email = $row["email"];

      //send the disapproved email from admin to user
      include "../php/generate-email.php";
      try {
      // Server settings
      $mail->SMTPDebug = 0;                      
      $mail->isSMTP();                                            
      $mail->Host       = 'smtp.gmail.com';                    
      $mail->SMTPAuth   = true;                              
      $mail->Username   = 'bus.ticketing.system.co@gmail.com';                    
      $mail->Password   = 'obiy hpfs bkhy achs';                           
      $mail->SMTPSecure = 'tls';         
      $mail->Port       = 587;                                    
      
      // EMAIL DETAILS
      $mail->setFrom('barangay.service.management@gmail.com', 'Barangay Service Management');
      $mail->addAddress($email, $name);     // Add a recipient
      
      // EMAIL CONTENTS
      $mail->isHTML(true);                                
      $mail->Subject = 'Barangay 1234 - Filed Complaint Status';
      $mail->Body    = 'Good Day, ' . $firstname . " " . $lastname . '! ' . '<br>' . '<br>' . 'The authorized staff from Barangay 1234 has reviewed your filed complaint. We regret to inform you that your complaint has been DENIED by the Barangay staff.' . '<br>' . 'Your complaint number is #' . $complaint_id. '<br>'. 'You may go to the Barangay 1234 Hall to inquire about your filed complaint'. '<br>'.'<br>'. 'For more details regarding your complaint, you may access Baragay 1234 Service Management System using the link below: ' . '<br>'. 'http://localhost/Ticketing-System/pages/account-login.html';
      $mail->send();
      }
      catch (Exception $e) {}

      echo '<script>
              alert("Request Disapproved");
              window.location = "../pages/admin_side-complaint_records.php";
            </script>';
      exit();
    }
}

//approve request
if (isset($_POST['approveComplaint'])){
    $account_id = $_POST["acc_id"];
    $complaint_id = $_POST["Complaint_ID"];

    $status = 'Approved';
    $stmt = $conn->prepare("UPDATE complaint_records SET status = ? WHERE Account_ID = ? and Complaint_ID =?");
    $stmt->bind_param("sii", $status, $account_id, $complaint_id);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE Account_ID = ?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $firstname = $row['firstname'];
      $middlename = $row['middlename'];
      $lastname = $row["lastname"];
      $name = $firstname . ' ' . $lastname;
      $email = $row["email"];
      //send the approved email from admin to user
      include "../php/generate-email.php";
        try {
        // Server settings
        $mail->SMTPDebug = 0;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                              
        $mail->Username   = 'bus.ticketing.system.co@gmail.com';                    
        $mail->Password   = 'obiy hpfs bkhy achs';                           
        $mail->SMTPSecure = 'tls';         
        $mail->Port       = 587;                                    
        
        // EMAIL DETAILS
        $mail->setFrom('barangay.service.management@gmail.com', 'Barangay Service Management');
        $mail->addAddress($email, $name);     // Add a recipient
        
        // EMAIL CONTENTS
        $mail->isHTML(true);                                
        $mail->Subject = 'Barangay 1234 - Filed Complaint Status';
        $mail->Body    = 'Good Day, ' . $firstname . " " . $lastname . '! ' . '<br>' . '<br>' . 'The authorized staff from Barangay 1234 has reviewed and APPROVED your filed complaint ' . '<br>' . 'Your complaint number is #' . $complaint_id. '<br>'. 'You may now go to the Barangay 1234 Hall to finish the process of your complaint'. '<br>'.'<br>'. 'For more details regarding your complaint, you may access Baragay 1234 Service Management System using the link below: ' . '<br>'. 'http://localhost/Ticketing-System/pages/account-login.html';
        $mail->send();
        }
        catch (Exception $e) {}

      echo '<script>
              alert("Request Approved");
              window.location = "../pages/admin_side-complaint_records.php";
            </script>';
      exit();
    }
}



///////////////////  STAFF STIDE

//disapprove request
if (isset($_POST['disapproveComplaint2'])){
  $account_id = $_POST["acc_id"];
  $complaint_id = $_POST["Complaint_ID"];
  
  $status = 'Disapproved';
  $stmt = $conn->prepare("UPDATE complaint_records SET status = ? WHERE Account_ID = ? and Complaint_ID =?");
  $stmt->bind_param("sii", $status, $account_id, $complaint_id);
  $stmt->execute();
  //send the disapproved email from staff to user
  include "../php/generate-email.php";
  try {
  // Server settings
  $mail->SMTPDebug = 0;                      
  $mail->isSMTP();                                            
  $mail->Host       = 'smtp.gmail.com';                    
  $mail->SMTPAuth   = true;                              
  $mail->Username   = 'bus.ticketing.system.co@gmail.com';                    
  $mail->Password   = 'obiy hpfs bkhy achs';                           
  $mail->SMTPSecure = 'tls';         
  $mail->Port       = 587;                                    
  
  // EMAIL DETAILS
  $mail->setFrom('barangay.service.management@gmail.com', 'Barangay Service Management');
  $mail->addAddress($email, $name);     // Add a recipient
  
  // EMAIL CONTENTS
  $mail->isHTML(true);                                
  $mail->Subject = 'Barangay 1234 - Filed Complaint Status';
  $mail->Body    = 'Good Day, ' . $firstname . " " . $lastname . '! ' . '<br>' . '<br>' . 'The authorized staff from Barangay 1234 has reviewed your filed complaint. We regret to inform you that your complaint has been DENIED by the Barangay staff.' . '<br>' . 'Your complaint number is #' . $complaint_id. '<br>'. 'You may go to the Barangay 1234 Hall to inquire about your filed complaint'. '<br>'.'<br>'. 'For more details regarding your complaint, you may access Baragay 1234 Service Management System using the link below: ' . '<br>'. 'http://localhost/Ticketing-System/pages/account-login.html';
  $mail->send();
  }
  catch (Exception $e) {}

  echo '<script>
          alert("Request Disapproved");
          window.location = "../pages/staff-complaint_records.php";
        </script>';
  exit();
}

//approve request
if (isset($_POST['approveComplaint2'])){
  $account_id = $_POST["acc_id"];
  $complaint_id = $_POST["Complaint_ID"];

  $status = 'Approved';
  $stmt = $conn->prepare("UPDATE complaint_records SET status = ? WHERE Account_ID = ? and Complaint_ID =?");
  $stmt->bind_param("sii", $status, $account_id, $complaint_id);
  $stmt->execute();
  //send the approved email from staff to user
  include "../php/generate-email.php";
    try {
    // Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                              
    $mail->Username   = 'bus.ticketing.system.co@gmail.com';                    
    $mail->Password   = 'obiy hpfs bkhy achs';                           
    $mail->SMTPSecure = 'tls';         
    $mail->Port       = 587;                                    
    
    // EMAIL DETAILS
    $mail->setFrom('barangay.service.management@gmail.com', 'Barangay Service Management');
    $mail->addAddress($email, $name);     // Add a recipient
    
    // EMAIL CONTENTS
    $mail->isHTML(true);                                
    $mail->Subject = 'Barangay 1234 - Filed Complaint Status';
    $mail->Body    = 'Good Day, ' . $firstname . " " . $lastname . '! ' . '<br>' . '<br>' . 'The authorized staff from Barangay 1234 has reviewed and APPROVED your filed complaint ' . '<br>' . 'Your complaint number is #' . $complaint_id. '<br>'. 'You may now go to the Barangay 1234 Hall to finish the process of your complaint'. '<br>'.'<br>'. 'For more details regarding your complaint, you may access Baragay 1234 Service Management System using the link below: ' . '<br>'. 'http://localhost/Ticketing-System/pages/account-login.html';
    $mail->send();
    }
    catch (Exception $e) {}

  echo '<script>
          alert("Request Approved");
          window.location = "../pages/staff-complaint_records.php";
        </script>';
  exit();
}























?>


