<?php
include '../php/server.php';
if(isset($_POST['change'])){
    //store the data in variables
    $email = $_POST['email'];
    $new = $_POST['newPassword'];
    $confirm = $_POST['confirmPassword'];
    
    $stmt = $conn->prepare("SELECT * FROM accounts_list WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $name = $firstname . ' ' . $lastname;
        
        if($new == $confirm){
            //change the password
            $new_password = password_hash($new, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE accounts_list SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $new_password, $email);
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
            $mail->Body    = 'Hi, ' . $name . '! ' . '<br>' . '<br>' . 'We noticed that you have recently changed your account password.' . '<br>' . 'If this change was not made by you, please reply to this email for further assistance.'. '<br>' .'Thank you';
            $mail->send();
            }
            catch (Exception $e) {}
            echo '  <script>
                        alert("Password Changed Succcessfully");
                        window.location = "../pages/account-login.html";
                    </script>';
        }
        else{
            echo '  <script>
                        alert("Passwords do not match");
                    </script>';
        }
    }
    else{
        echo '  <script>
                        alert("Account not found");
                        window.location = "../pages/account-login.html";
                    </script>';
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barangay Service Management System</title>

    <link
      rel="shortcut icon"
      type="image/jpg"
      href="..\src\barangay-logo.png"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap");
    </style>

    <link
      rel="stylesheet"
      href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="../css/account-style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
  </head>
  <body>
    <!-- div -->
    <div class="first-div">
      <p class="title1">BARANGAY SERVICE MANAGEMENT SYSTEM</p>
    </div>

    <!-- div -->
    <div class="second-div">
      <p class="title2">LOGIN</p>
      <p class="title1"></p>
    </div>

    <!-- container div for image and login form-->
    <div class="container">
      <!-- image div -->
      <div class="image">
        <img src="../src/barangay_bg.jpg" />
      </div>
      <!-- end of image div -->

      <!-- login form -->
      <div class="login-div">
        <!-- service title -->
        <div class="service d-flex align-items-center p-5">
          <!-- barangay logo -->
          <img src="../src/barangay-logo.png" />
          <p class="login-title">BARANGAY SERVICE MANAGEMENT SYSTEM</p>
        </div>

        <p class="login-text1">Change Password</p>
        <p class="login-text2 mb-4">
          Please complete the form to change your password.
        </p>

        <div class="login-form">
          <form action="" method="post">

            <label for="email">Email</label><br />
            <input
              class="form-control"
              type="email"
              name="email"
              placeholder="  johndoe@untitledui.com  "
              autocomplete="off"
            /><br />

            <label for="newPassword">New Password: </label><br />
            <input
              class="form-control"
              type="password"
              name="newPassword"
              placeholder="  ***********  "
              autocomplete="off"
            /><br />

            <label for="confirmPassword">Confirm Password: </label><br />
            <input
              class="form-control"
              type="password"
              name="confirmPassword"
              placeholder="  ***********  "
            /><br />

            <button class="login-button p-2" name="change" type="submit">
              CHANGE PASSWORD
            </button>
          </form>
        </div>
      </div>
      <!-- end of login form -->
    </div>
    <!-- end of container div -->

    <!-- footer div -->
    <div class="footer">
      <p class="footer-text">© 2024 Barangay Service Management System</p>
    </div>
  </body>
</html>
