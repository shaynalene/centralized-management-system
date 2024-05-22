<!-- FIX THE GENERATED EMAIL PROMPT -->
<!-- VERIFY THE INPUT DETAILS LIKE EMAIL AND NUMBER AND BIRTHDAY? -->
<!-- REDIRECT TO AN EMAIL NOTIF PAGE WITH LINK TO LOGIN PAGE -->

<?php
include "server.php";

//get data from html form
$firstname = $_POST["firstname"];
$middlename = $_POST["middlename"];
$lastname = $_POST["lastname"];
$birthday = $_POST["birthday"];
$email = $_POST["email"];
$number = $_POST["number"];
$password = $_POST['password'];
$confirm_password  = $_POST['confirm_password'];

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //confirm the password if same
    if ($password !== $confirm_password) {
        echo '  <script>
                        alert("Passwords do not match!");
                        window.location.href = "../pages/account-register.html";
                    </script>';
        exit();
    }
    else{
        //check if the firstname, lastname, and birthday match in the residents list
        $stmt = $conn->prepare("SELECT * FROM resident_population WHERE First_Name=? AND Last_Name=? AND Birthdate=?");
        $stmt->bind_param("sss", $firstname, $lastname, $birthday);
        $stmt->execute();
        $result = $stmt->get_result();

        //if resident is found:
        if ($result->num_rows === 1) {
            //check if the email is already registered
            $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            //if the email is already registered:
            if ($result->num_rows === 1) {
                echo '<script>
                        alert("Email Already Registered");
                        window.location.href = "../pages/account-register.html";
                    </script>';
            }
            //if the email is not yet in use, confirm it by sending a generated email
            else{
                //confirm the email 
                include "../php/generate-email.php";
                try {
                // Server settings
                $mail->SMTPDebug = 2;                      
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
                $mail->Subject = 'Barangay Service Management Login Details';
                $mail->Body    = 'Hi, ' . $firstname . " " . $lastname . '! ' . '<br>' . '<br>' . 'You have successfully registered an account. To continue, click the link below: ' . '<br>' . 'http://localhost/Centralized-Service-System/pages/account-login.html';
                $mail->send();
                echo '<script type="text/javascript">
                        window.location = "../pages/login-usr-page.html";
                        </script>';
                }
                catch (Exception $e) {}


                //kung umabot here, successful lahat ng validation
                //add the registration details to the database
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $role_id = 1; //this sets the account role into user

                //insert the data to database
                $sql = "INSERT INTO accounts_list (firstname, middlename, lastname, birthday, email, contact_number, role_id, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssiis", $firstname, $middlename, $lastname, $birthday, $email, $number, $role_id, $hashed_password);
                $stmt->execute();
                header("Location: ../pages/account-login.html");
                $stmt->close();
                $conn->close(); 
            }
        }
        //pag hindi nagmatch sa resident
        else{
            echo '<script>
                        alert("Your entered credentials do not match any resident records. Please double check your name and birthday input.");
                        window.location.href = "../pages/account-register.html";
                    </script>';
        }
    }
} else {
    echo '<script>
                        alert("Email Address Invalid");
                        window.location.href = "../pages/account-register.html";
                    </script>';
}

?>