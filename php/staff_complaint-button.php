<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

include "server.php";

//get data from html form
$firstname = $_SESSION['firstname'];
$middlename = $_SESSION['middlename'];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];


//disapprove request
if (isset($_POST['disapproveComplaint'])){
    $account_id = $_SESSION["account_id"];
    $complaint_id = $_POST["Complaint_ID"];
    
    $status = 'disapproved';
    $stmt = $conn->prepare("UPDATE complaint_records SET status = ? WHERE Account_ID = ? and Complaint_ID =?");
    $stmt->bind_param("sii", $status, $account_id, $complaint_id);
    $stmt->execute();
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
    $mail->setFrom('bus.ticketing.system.co@gmail.com', 'Bus Ticketing System Co');
    $mail->addAddress($email, $name);     // Add a recipient
    
    // EMAIL CONTENTS
    $mail->isHTML(true);                                
    $mail->Subject = 'Barangay 1234 - Filed Complaint Status';
    $mail->Body    = 'Good Day, ' . $firstname . " " . $lastname . '! ' . '<br>' . '<br>' . 'The authorized staff from Barangay 1234 has reviewed your filed complaint. We regret to inform you that your complaint has been DENIED by the Barangay staff.' . '<br>' . 'Your complaint number is #' . $complaint_id. '<br>'. 'You may go to the Barangay 1234 Hall to inquire about your filed complaint'. '<br>'.'<br>'. 'For more details regarding your complaint, you may access Baragay 1234 Service Management System using the link below: ' . '<br>'. 'http://localhost/Ticketing-System/pages/account-login.html';
    $mail->send();
    }
    catch (Exception $e) {}

    echo '<script>
            alert("Request Disapproved" $complaint_id);
            window.location = "../pages/staff_side-complaint_records.php";
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
      $mail->setFrom('bus.ticketing.system.co@gmail.com', 'Bus Ticketing System Co');
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
            window.location = "../pages/staff_side-complaint_records.php";
          </script>';
    exit();
}

?>


