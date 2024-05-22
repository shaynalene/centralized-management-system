<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

$account_id = $_SESSION["account_id"];

    $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE account_id=?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
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

                //send the forgot password email   
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
                $mail->Subject = 'Password Changed Successfully';
                $mail->Body    = 'Hi, ' . $name . '! ' . '<br>' . '<br>' . 'We noticed that you have recently changed your account password.' . '<br>' . 'If this change was not made by you, please reply to this email for further assistance.';
                $mail->send();
                }
                catch (Exception $e) {}
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
    }
?>