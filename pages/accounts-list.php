<?php
session_start();
include "../php/server.php"; 
include "../php/onload.php"; 

if($_SESSION["role"] != 3){
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barangay Service Management System</title>

    <link rel="stylesheet" type="text/css" href="..\style.css" />
    <link
      rel="shortcut icon"
      type="image/jpg"
      href="..\src\barangay-logo.png"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap");
    </style>

    <!-- DataTables -->
    <link
      rel="stylesheet"
      href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css"
    />
    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="..\plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link
      rel="stylesheet"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <!-- Tempusdominus Bootstrap 4 -->
    <link
      rel="stylesheet"
      href="..\plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
    />
    <!-- iCheck -->
    <link
      rel="stylesheet"
      href="..\plugins/icheck-bootstrap/icheck-bootstrap.min.css"
    />
    <!-- JQVMap -->
    <link rel="stylesheet" href="..\plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="..\dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link
      rel="stylesheet"
      href="..\plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
    />
    <!-- Daterange picker -->
    <link
      rel="stylesheet"
      href="..\plugins/daterangepicker/daterangepicker.css"
    />
    <!-- summernote -->
    <link
      rel="stylesheet"
      href="..\plugins/summernote/summernote-bs4.min.css"
    />
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
        <a href="../dashboard-admin.php" class="brand-link">
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
              <a href="../pages/admin-account-information.php">
                <?php echo $display ?>
              </a>
            </div>

            <div class="info pt-3">
              <a href="../pages/admin-account-information.php" class="user-name d-block fw-bold text-center fs-4 text-wrap"
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
              <li class="nav-item">
                <a href="../dashboard-admin.php" class="nav-link">
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
                    <a href="../pages/admin_side-complaint_records.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Complaint Records</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin-permit-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p class="text-center">Permit Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin-clearance-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Clearance Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin-id-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Barangay ID Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin-cert-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cert. of Residency Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin-feedback.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Feedback Records</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pages/accounts-list.php" class="active-link nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Accounts List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin_side-resident_population.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p class="text-center">Resident Population</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin_side-commercial_population.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Commercial Population</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin_side-announcements_record.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Announcements</p>
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
      <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                        <div class="trans-title col-md-12 pt-5 pl-5">
                            ACCOUNTS LIST
                        </div>
                        <div class="col-md-12 p-5">
                            <div class="card">
                                <div class="card-body">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                                    <thead class="table-head">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Birthday</th>
                                                            <th>Email</th>
                                                            <th>Contact Number</th>
                                                            <th>Role</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="transactionBody">
                                                    <?php 

$sql = "SELECT * FROM accounts_list AL
        INNER JOIN account_role AR
        ON AL.role_id = AR.role_id";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $name = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
        $birthday = $row['birthday'];
        $email = $row['email'];
        $number = $row['contact_number'];
        $role = $row['system_role'];
        $acc_id = $row['account_id'];

        $sql = "SELECT * FROM image_avatar WHERE account_id=?";
        $stmt->bind_param("i", $acc_id);
        $stmt->execute();
        $image_result = $stmt->get_result();
        
        if ($image_result->num_rows === 1) {
          $row = $image_result->fetch_assoc();
          $file_extension = pathinfo($row["filename"], PATHINFO_EXTENSION);
          $image = $row['avatar'];
        
          if($file_extension === 'png'){
            $display_avatar = '<img src="data:image/png;base64,'.base64_encode($image).'"/>';
          }
          else if($file_extension === 'jpeg' || 'jpg'){
            $display_avatar = '<img src="data:image/jpeg;base64,'.base64_encode($image).'"/>';
          }
          else{
            #echo 'Invalid Format';
          }
        }
        else{
          $display_avatar = '<img
          src="..\dist/img/user2-160x160.jpg"
          class="img-circle elevation-2"
          alt="User Image"
        />';
        }

        echo "<tr>";
        echo "<td class='text-break'>" . htmlspecialchars($name) . "</td>";
        echo "<td class='text-break'>" . htmlspecialchars($birthday) . "</td>";
        echo "<td class='text-break'>" . htmlspecialchars($email) . "</td>";
        echo "<td class='text-break'>" . htmlspecialchars($number) . "</td>";
        echo "<td class='text-break'>" . htmlspecialchars($role) . "</td>";
        echo "<td><button type='button' class='btn btn-success' data-toggle='modal' data-target='#view" . htmlspecialchars($row['account_id']) . "'>View</button></td>";
    echo "</tr>";

    echo "<!-- Modal -->
          <div class='modal fade' id='view" . htmlspecialchars($row['account_id']) . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLongTitle'>View Account Details</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  <form id='editForm" . htmlspecialchars($row['account_id']) . "' method='post' action='../php/account-update.php'>
                  <div class='form-group'>
                  $display_avatar
                  </div>
                  <div class='form-group'>
                      <label for='editEmail$name'>Name:</label>
                      <input type='text' class='form-control' id='editEmail$name' name='name' autocomplete='off' value='$name' readonly='true'>
                    </div>
                    <div class='form-group'>
                      <label for='editEmail$birthday'>Birthday:</label>
                      <input type='text' class='form-control' id='editEmail$birthday' name='birthday' autocomplete='off' value='$birthday' readonly='true'>
                    </div>
                    <div class='form-group'>
                      <label for='editEmail$email'>Email:</label>
                      <input type='text' class='form-control' id='editEmail$email' name='email' autocomplete='off' value='$email' readonly='true'>
                    </div>
                    <div class='form-group'>
                      <label for='editEmail$number'>Contact Number:</label>
                      <input type='text' class='form-control' id='editEmail$number' name='number' autocomplete='off' value='$number' readonly='true'>
                    </div>
                    <div class='form-group'>
                      <label for='editEmail$role'>Current Account Role:</label>
                      <input type='text' class='form-control' id='editEmail$role' name='role' autocomplete='off' value='$role' readonly='true'>
                    </div>
                    <div class='form-group'>
                      <label for='edit$role'>Change Account Role:</label>
                      <select name='role' id='role'>
                        <option value='1'>User</option>
                        <option value='2'>Staff</option>
                        <option value='3'>Admin</option>
                      </select>
                    </div>
                    <input type='hidden' name='acc_id' value='$acc_id'>
                  </div>
                  <div class='modal-footer'>
                  <button type='submit' class='btn btn-primary' name='changeRole'>Change Account Role</button>
                  </form>
                </div>
              </div>
            </div>
          </div>";
    }
  }
 else {
    echo "<tr><td colspan='4'>No results found</td></tr>";
}
$conn->close();
?>
       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <script src="../script.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
      $(function () {
        $("#example1")
          .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: [
              {
                extend: "colvis",
                text: "Filter",
                className: "custom-colvis-button", // Add custom class
              },
            ],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");

        $("#example2").DataTable({
          paging: true,
          lengthChange: false,
          searching: false,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
        });
      });
    </script>
  </body>
</html>
