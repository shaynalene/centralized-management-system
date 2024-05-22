<?php
session_start();
include '../php/server.php';


//LOGIN
if (isset($_POST['login'])){
    // get data from HTML form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST["email"];
        $password = $_POST['password'];
    }
    
    // validate if there is an existing account with the login credentials
    $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];
        // check the password
        if (password_verify($password, $hashed_password)) {
            // Correct password
            $_SESSION['account_id'] = $row["account_id"];
            $_SESSION['role'] = $row["role_id"];
            #$_SESSION['firstname'] = $row["firstname"];
            #$_SESSION['lastname'] = $row["lastname"];
            #$_SESSION['number'] = $row["number"];
            #$_SESSION['email'] = $row["email"];

            #user
            if($row["role_id"] === 1){
                header("Location: ../dashboard-user.php");
            }
            #staff
            else if($row["role_id"] === 2){
                header("Location: ../dashboard-staff.php");
            }
            #admin
            else{
                header("Location: ../dashboard-admin.php");
            }
            exit();
        } else {
            //password is incorrect
            echo '<script>
                        alert("Incorrect Password!");
                        window.location.href = "../pages/account-login.html";
                    </script>';
        }
    } else {
        //invalid email
        echo '<script>
                        alert("Invalid/Unregistered Email Address!");
                        window.location.href = "../pages/account-login.html";
                </script>';
    }
}
//$stmt->close();
//$conn->close();


//FORGOT PASSWORD
if (isset($_POST['forgot'])){
    //get the username and password from the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST["email"];
    }

    //check if there is an existing account
    $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        //get the user email
        $email = $row["email"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $name = $firstname . ' ' . $lastname;
        
        
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
        $mail->Subject = 'Forgot Password';
        $mail->Body    = 'Hi, ' . $name . '! ' . '<br>' . '<br>' . 'To change your password, click the link below: ' . '<br>' . 'http://localhost/Centralized-Service-System/pages/forgot-password.php';
        $mail->send();
        }
        catch (Exception $e) {}

        //show alert that an email was sent
        echo '<script>alert("An email was sent to your registered email.");
                window.location = "../pages/account-login.html";
        </script>';
    }
    else {
        //no account was found
        echo    '<script>
                    alert("No account was found!");
                    window.location = "../pages/account-login.html";
                </script>';
    }
    $stmt->close();
    $conn->close();
}

?>