<!-- 
    COMMENTS:
    1. fix the fonts
    2. file upload field design
    3. ratio of the avatar  
    4. update and change buttons
    
-->
<?php
session_start();
include '../php/server.php';
include '../php/onload.php';


//submit image
if (isset($_POST['submit_image'])){
    $account_id = $_SESSION["account_id"];
    $file = $_FILES['image'];
    $filename = $file['name'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    //check if there is an existing image for the account
    $stmt = $conn->prepare("SELECT * FROM image_avatar WHERE account_id=?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    //if there is a pic already, update the data
    if ($result->num_rows === 1) {
      $stmt = $conn->prepare("UPDATE image_avatar SET filename = '$filename' and image = '$image' WHERE account_id = $account_id");
      $conn->query($sql);
      echo '<script>
                    alert("Image Updated");
                </script>';
    }
    //if wala pa
    else{
      $stmt = $conn->prepare("INSERT INTO image_avatar (account_id, filename, avatar) VALUES (?, ?, ?)");
      $stmt->bind_param('iss', $account_id, $filename, $image);
      $stmt->execute();
      $stmt->close();
      echo '<script>
                    alert("Image Uploaded");
                </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barangay Service Management System</title>

    <link rel="stylesheet" type="text/css" href="../style.css" />
    <link rel="shortcut icon" type="image/jpg" href="../src\barangay-logo.png" />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap");

    .title1{
        color: #102937;
        font-weight: 500;
        padding-top: 2vh;
        padding-left: 3vh;
        float: left;
    }
    .second-div{
        background-color: white;
        height: 8vh;
        width: 100%;
    }

    .account-info{
        font-weight: 500;
        margin-top: 3vh;
        margin-left: 5vh;
    }

    .account-container{
        background-color: white;
        margin-top: 5%;
        margin-bottom: 5%;
        width: 65%;
        height: 75%;
        margin-left: auto;
        margin-right: auto;
        display: flex;
        padding-left: 0;
        justify-content:left;
        flex-direction: column;
    }

    .top-div{
        background-color: #102937;
        height: 20vh;
        text-align: center;
        padding-top: 50px;
    }
    .account-name{
        color: white;
        font-weight: 600;
        font-size: x-large;
    }

    .login-div{
        width: 100%;
    }
    .login-title{
        color: #16555D;
        font-weight: 700;
        font-size: x-large;
    }
    .login-text1{
        font-weight: 600;
        font-size: large;
        margin-left: 10%;
    }
    .login-text2{
        color: gray;
        margin-left: 10%;
    }
    input{
        border-radius: 15px; 
        border-color: gray;
        border-style: double;
        width: 100%;
        height: 100%;
    }
    .login-button{
        background-color: #16555D;
        color: white;
        display: block;
        margin: auto;
        width: 100%;
        border: none;
        border-radius: 5px; 
    }
    .login-text3{
        padding: 3%;
        text-align: center;
    }

    .account-footer{
        background-color: #102937;
        height: 5vh;
        width: 100%;
        padding: 5px 10px 0 0;
    }
    .account-footer-text{
        font-weight: 500;
        color: #E45B30;
        float: right;
        margin: 0;
    }

    .submit_form{
      background-color: #16555D;
        color: white;
        display: block;
        margin: auto;
        width: 100%;
        border: none;
        border-radius: 5px; 
    }
    </style>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link
      rel="stylesheet"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <!-- Tempusdominus Bootstrap 4 -->
    <link
      rel="stylesheet"
      href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
    />
    <!-- iCheck -->
    <link
      rel="stylesheet"
      href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css"
    />
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link
      rel="stylesheet"
      href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
    />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css" />
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Preloader -->

      <!-- Navbar -->
      <nav
        class="main-header navbar navbar-expand"
        style="background-color: #102937"
      >
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <div class="header-subtitle">
              BARANGAY SERVICE MANAGEMENT SYSTEM
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../dashboard-staff.php" class="brand-link">
          <img
            src="../src/barangay-logo.png"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
          />

          <span class="brand-text">Barangay 1234</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 mb-3 pt-3 pb-3 d-flex">
            <div class="image">
              <a href="../pages/staff-account-information.php">
                <?php echo $display ?>
              </a>
            </div>

            <div class="info pt-3">
              <a href="../pages/staff-account-information.php" class="user-name d-block fw-bold text-center fs-4 text-wrap"
                ><?php echo $name ?></a
              >
              <p class="role text-center text-uppercase"><?php echo $role ?></p>
            </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item mb-3 mt-3">
              <a href="#" class="nav-link logout-btn d-flex align-items-center overflow-hidden">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <form action="../php/logout-user.php" method="post">
                    <!-- <p class="logout-btn-t">LOGOUT</p> -->
                    <button class="logout-btn-t" name="logout" type="submit">LOGOUT</button>
                  </form>
                </a>
              </li>

              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item menu-open">
                <a href="../dashboard-staff.php" class="active-link nav-link active">
                  <i class="nav-icon fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>
                    Barangay Services
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pages/staff-complaint_records.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Complaint Records</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/staff-permit-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p class="text-center">Permit Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/staff-clearance-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Clearance Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/staff-id-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Barangay ID Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/staff-cert-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cert. of Residency Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/staff-feedback.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Feedback Records</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <!-- <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) 
            <div class="row">
              <div class="col-lg-12 col-12">
                <!-- small box -->

                <!--START OF ACCOUNT INFORMATION CONTENT-->
                <!-- div -->
                <div class="second-div">
                    <p class="title1">ACCOUNTS</p>
                </div>

                <!-- body -->
                <h3 class="account-info">ACCOUNT INFORMATION</h3>

                <!-- container div for image and login form-->
                <div class="account-container">
                    
                    <!-- image div -->
                    <div class="top-div">
                        <p class="account-name"><?php echo $name ?></p>
                    </div>
                    <!-- end of image div -->

                    <!-- login form -->
                    <div class="login-div card p-5">

                      <div class="d-flex flex-column">
                        <p class="login-title">ACCOUNT DETAILS</p>

                        <p>Upload/Update your photo here in jpeg, jfif, or png format.</p>
                        <form action="" method="post" enctype="multipart/form-data">
                          <input class="form-control" type="file" name="image" id="image" accept="image/*" required>
                          <br>
                          <input class="submit_form p-2" type="submit" name="submit_image">
                          <br>
                        </form>

                        </div>

                        <div class="login-form">
                            <!-- start of login form -->
                            <form action="../php/account-update.php" method="post">
                                
                                <label for="name">Name</label><br>
                                <input class="form-control" type="text" name="name" value="<?php echo $name ? htmlspecialchars($name) : ''; ?>" readonly><br>

                                <label for="birthday">Birthday</label><br>
                                <input class="form-control" type="date" name="birthday" value="<?php echo $birthday ? htmlspecialchars($birthday) : ''; ?>" readonly><br>
                                
                                <label for="email">Email</label><br>
                                <input class="form-control" type="email" name="email" value="<?php echo $email ? htmlspecialchars($email) : ''; ?>" readonly><br>

                                <label for="number">Phone Number</label><br>
                                <input class="form-control" type="number" name="number" value="<?php echo $number ? htmlspecialchars($number) : ''; ?>" readonly><br>

                                <label for="password">Password</label><br>
                                <input class="form-control" type="password" name="password" placeholder="  ***********  " readonly><br><br>

                                <!-- UPDATE ACCOUNT INFORMATION -->
                                <?php echo "<button type='button' class='login-button p-2 mb-3' data-toggle='modal' data-target='#exampleModalCenter$account_id'>Update Information</button> 
                                <!-- Modal -->
                                <div class='modal fade' id='exampleModalCenter$account_id' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                                  <div class='modal-dialog modal-dialog-centered' role='document'>
                                    <div class='modal-content'>
                                      <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle'>Update Account Details</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                          <span aria-hidden='true'>&times;</span>
                                        </button>
                                      </div>
                                      <div class='modal-body'>
                                        <form id='editForm$account_id' method='post' action='../php/account-update.php'>
                                            <div class='form-group'>
                                                <label for='editEmail'>Email:</label>
                                                <input type='text' class='form-control' id='editEmail' name='editEmail' autocomplete='off' value='" ;
                                                 echo htmlspecialchars($email);
                                                 echo"'>   
                                                
                                                 <label for='editNumber'>Phone Number:</label>
                                                <input type='text' class='form-control' id='editNumber' name='editNumber' autocomplete='off' value='";
                                                 echo htmlspecialchars($number);
                                                 echo"'>      
                                              
                                              </div>
                                        </form>
                                    </div>
                        
                                    <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                    <button type='submit' class='btn btn-primary' name='updateInfo'>Save Changes</button>
                                     </div>
                                
                                    </div>
                                  </div>
                                </div>";?>
                            </form>

                            <!-- CHANGE PASSWORD -->
                            <button type="button" class="login-button p-2" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>

<!-- Modal for changing password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm" method="post" action="../php/account-password.php">
                    <div class="form-group">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>

                        <label for="newPassword">New Password:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>

                        <label for="confirmPassword">Confirm New Password:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="changePasswordForm" name="changePassword">Change Password</button>
            </div>
        </div>
    </div>
</div>
                            <!-- end of login form -->


                            

                        </div>
                    </div>
                    <!-- end of login form -->

                </div>
                <!-- end of container div -->

                <!-- footer div -->
                <div class="account-footer">
                    <p class="account-footer-text">© 2024 Barangay Service Management System</p>
                </div>




              <!--</div>
            </div>
          </div>
        </section>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>

    <script src="script.js"></script>
  </body>
</html>
