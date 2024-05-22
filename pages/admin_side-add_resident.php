<?php
session_start();
include '../php/server.php';
include '../php/onload.php';

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
            src="..\src/barangay-logo.png"
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
            <?php echo $display ?>
            </div>
            <div class="info pt-3">
              <a href="#" class="user-name d-block fw-bold text-center fs-4"
                ><?php echo $name ?></a
              >
              <p class="role text-center"><?php echo $role ?></p>
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

              <li class="nav-item  menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>
                    Reports
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../pages/accounts-list.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Accounts List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../pages/admin_side-resident_population.php" class="active-link nav-link active">
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
            <div class="row d-flex justify-content-center">
              <div class="trans-title col-md-12 pt-5 pl-5"></div>
              <div class="card-container d-flex justify-content-center">
                <div class="card-ans-form card m-5 col-md-8">
                  <div class="card-header card-title-header d-flex pl-5">
                    <!-- Brand Logo -->
                    <div class="brand-link-form d-flex align-items-center">
                      <img
                        src="..\src/barangay-logo.png"
                        alt="AdminLTE Logo"
                        class="brand-image-form img-circle elevation-3"
                      />

                      <span class="brand-text-form">BARANGAY 1234</span>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <a href="../pages/admin_side-resident_population.php" class="btn btn-primary float-right">
                            <<< Go Back to Resident Records
                            </a>
                  <form action="../php/push-resident.php" method="post" enctype="multipart/form-data">
                    <div class="card-body px-5 pt-5 pb-0">
                      <div class="form-group disclaimer">
                        <div class="disclaimer-title pb-3">
 
                          ADD RESIDENT
                        </div>
                        <div class="disclaimer-subtitle">
                          Please fill out the following form with the resident's personal information. 
                        </div>
                      </div>
                      <hr class="my-4" />
                      <div class="form-group">
                        <label for="First_Name">First Name:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="First_Name"
                          name="First_Name"
                          placeholder="Enter First Name Here"
                        />
                      </div>
                      <div class="form-group">
                        <label for="Middle_Name">Middle Name:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="Middle_Name"
                          name="Middle_Name"
                          placeholder="Enter Middle Name Here"
                        />
                      </div>
                      <div class="form-group">
                        <label for="Last_Name">Last Name:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="Last_Name"
                          name="Last_Name"
                          placeholder="Enter Last Name Here"
                        />
                      </div>
                      <div class="form-group">
                        <label for="Birthdate">Birthdate:</label>
                        <input
                          type="date"
                          class="form-control"
                          id="Birthdate"
                          name="Birthdate"
                          placeholder=""
                        />
                      </div>
                      <div class="form-group">
                        <label for="Gender">Gender:</label>
                        <select id="Gender" name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        </select>  
                      </div>
                      <div class="form-group">
                        <label for="Phone">Phone:</label>
                        <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Enter Phone Number Here">
                      </div>
                      <div class="form-group">
                        <label for="Address">Full Address:</label>
                        <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Full Address Here">
                      </div>

                      <div class="form-group">
                        <label for="image">Upload Resident's Recent Photo </label>
                        <input class="form-control" type="file" name="image" id="image" accept="image/*">
                  </div>

  
                    <!-- /.card-body -->

                    <div class="card-footer d-flex justify-content-center p-5">
                      <button type="submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                  </form>
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

      document.addEventListener("DOMContentLoaded", function () {
        // Function to show/hide input fields based on selected option
        function toggleInputFields() {
          var selectBox = document.getElementById("exampleSelectType");
          var selectedOption = selectBox.options[selectBox.selectedIndex].value;
          var inputFields = document.querySelectorAll(".child-input");

          // If the selected option is "Others: Child", show the input fields, else hide them
          if (selectedOption === "Others: Child") {
            for (var i = 0; i < inputFields.length; i++) {
              inputFields[i].style.display = "block";
            }
          } else {
            for (var i = 0; i < inputFields.length; i++) {
              inputFields[i].style.display = "none";
            }
          }
        }

        // Add event listener to the select box
        document
          .getElementById("exampleSelectType")
          .addEventListener("change", toggleInputFields);

        // Initially hide the input fields
        toggleInputFields();
      });
    </script>
  </body>
</html>