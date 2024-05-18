<?php
session_start();
include '../centralized-service-system/php/server.php';
include '../centralized-service-system/php/onload.php';

$display = '<img
src="../centralized-service-system/dist/img/user2-160x160.jpg"
class="img-circle elevation-2"
alt="User Image"
/>';

// SQL query to count the number of entries in the resident_population table
$sql1 = "SELECT COUNT(*) AS total FROM resident_population";
$result1 = $conn->query($sql1);

$totalEntries1 = 0;

if ($result1->num_rows > 0) {
    // Fetch the result as an associative array
    $row1 = $result1->fetch_assoc();
    // Retrieve the total count
    $totalEntries1 = $row1["total"];
}

// SQL query to count the number of entries in the commercial_population table
$sql2 = "SELECT COUNT(*) AS total FROM resident_population";
$result2 = $conn->query($sql2);

$totalEntries2 = 0;

if ($result2->num_rows > 0) {
    // Fetch the result as an associative array
    $row2 = $result2->fetch_assoc();
    // Retrieve the total count
    $totalEntries2 = $row2["total"];
}

// SQL query to count the number of entries in the commercial_population table
$sql2 = "SELECT COUNT(*) AS total FROM resident_population";
$result2 = $conn->query($sql2);

$totalEntries2 = 0;

if ($result2->num_rows > 0) {
    // Fetch the result as an associative array
    $row2 = $result2->fetch_assoc();
    // Retrieve the total count
    $totalEntries2 = $row2["total"];
}

// SQL query to count the number of females from the gender column in the resident_population table
$sql_female = "SELECT COUNT(*) AS female_count FROM resident_population WHERE gender = 'Female'";
$result_female = $conn->query($sql_female);

$femaleCount = 0;

if ($result_female->num_rows > 0) {
    // Fetch the result as an associative array
    $row_female = $result_female->fetch_assoc();
    // Retrieve the female count
    $femaleCount = $row_female["female_count"];
}

// SQL query to count the number of males from the gender column in the resident_population table
$sql_male = "SELECT COUNT(*) AS male_count FROM resident_population WHERE gender = 'Male'";
$result_male = $conn->query($sql_male);

$maleCount = 0;

if ($result_male->num_rows > 0) {
    // Fetch the result as an associative array
    $row_male = $result_male->fetch_assoc();
    // Retrieve the male count
    $maleCount = $row_male["male_count"];
}

?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barangay Service Management System</title>

    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="shortcut icon" type="image/jpg" href="src\barangay-logo.png" />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap");
    </style>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../centralized-service-system/plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link
      rel="stylesheet"
      href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <!-- Tempusdominus Bootstrap 4 -->
    <link
      rel="stylesheet"
      href="../centralized-service-system/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
    />
    <!-- iCheck -->
    <link
      rel="stylesheet"
      href="../centralized-service-system/plugins/icheck-bootstrap/icheck-bootstrap.min.css"
    />
    <!-- JQVMap -->
    <link rel="stylesheet" href="../centralized-service-system/plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../centralized-service-system/dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link
      rel="stylesheet"
      href="../centralized-service-system/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
    />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../centralized-service-system/plugins/daterangepicker/daterangepicker.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="../centralized-service-system/plugins/summernote/summernote-bs4.min.css" />
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
        <a href="../centralized-service-system/dashboard-staff.php" class="brand-link">
          <img
            src="src/barangay-logo.png"
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
              <a href="../centralized-service-system/pages/staff-account-information.php">
                <?php echo $display ?>
              </a>
            </div>

            <div class="info pt-3">
              <a href="../centralized-service-system/pages/staff-account-information.php" class="user-name d-block fw-bold text-center fs-4 text-wrap"
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
                  <form action="../centralized-service-system/php/logout-user.php" method="post">
                    <!-- <p class="logout-btn-t">LOGOUT</p> -->
                    <button class="logout-btn-t" name="logout" type="submit">LOGOUT</button>
                  </form>
                </a>
              </li>

              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <li class="nav-item menu-open">
                <a href="../centralized-service-system/dashboard-staff.php" class="active-link nav-link active">
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
                    <a href="../centralized-service-system/pages/staff-complaint_records.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Complaint Records</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../centralized-service-system/pages/staff-permit-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p class="text-center">Permit Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../centralized-service-system/pages/staff-clearance-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Clearance Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../centralized-service-system/pages/staff-id-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Barangay ID Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../centralized-service-system/pages/staff-cert-requests.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cert. of Residency Requests</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../centralized-service-system/pages/staff-feedback.php" class="nav-link">
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
        <section class="content">
          <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <!-- small box -->
              <div class="header">
                <div class="container">
                  <div class="carousel-main-container">
                    <div class="carousel-title">
                      <div class="line"></div>
                      <div class="carousel-title-gap">
                        <div>
                          <div class="carousel-title-header">BARANGAY 1234</div>
                          <div class="carousel-title-sub1">
                            BARANGAY SERVICE SYSTEM
                          </div>
                        </div>
                        <div class="carousel-title-sub2">
                          MANILA, 1234 METRO MANILA
                        </div>
                      </div>
                    </div>
                    <div class="carousel-subtitle-container">
                      <div class="carousel-subtitle">
                        The most exciting district of Metro Manila, get your
                        opportunity to move forward together.
                      </div>
                      <div class="subtitle-btn">
                        <a class="btn btn-lg btn-primary" href="#" role="button"
                          >DISCOVER OUR OFFICIALS</a
                        >
                      </div>
                    </div>
                  </div>
                  <div class="carousel-barangay">
                    <img src="../centralized-service-system/src/barangay-logo.png" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="population-title col align-self-center pb-5 pt-5">
                <i class="fas fa-child"></i>
                <div class="population-subtitle">
                  <div class="population-subtitle-1">POPULATION</div>
                  <div class="population-subtitle-2">AS OF YEAR 2024</div>
                </div>
              </div>
            </div>
            <div class="row pl-5 pr-5 pb-4">
              <div class="col-md-6 col-6">
                <!-- small box -->
                <div class="small-box bg-population p-2">
                  <div class="inner">
                    <p class="category">RESIDENTS</p>
                    <h3 class="numbers"> <?php echo $totalEntries1; ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-circle"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-md-6 col-6">
                <!-- small box -->
                <div class="small-box bg-population p-2">
                  <div class="inner">
                    <p class="category">COMMERCIALS</p>
                    <h3 class="numbers"><?php echo $totalEntries2; ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-circle"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-md-6 col-6">
                <!-- small box -->
                <div class="small-box bg-population p-2">
                  <div class="inner">
                    <p class="category">MALE</p>
                    
                    <h3 class="numbers"><?php echo $maleCount; ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-circle"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-md-6 col-6">
                <!-- small box -->
                <div class="small-box bg-population p-2">
                  <div class="inner">
                    <p class="category">FEMALE</p>
                    <h3 class="numbers"><?php echo $femaleCount; ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-circle"></i>
                  </div>
                </div>
              </div>
              <!-- ./col -->
            </div>

            <?php include '../centralized-service-system/php/announcements_archive.php'; ?>

<div class="row announcements justify-content-center align-items-center">
    <div class="col-md-12 p-5 officials-title">ANNOUNCEMENTS</div>
    <div class="col-md-9 p-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Announcements</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php foreach ($announcements as $index => $announcement): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
                        <?php endforeach; ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php foreach ($announcements as $index => $announcement): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <div class="card-body">
                                    <div class="time pb-5">
                                        <i class="fas fa-clock"></i>
                                        <div class="time-title"><?= htmlspecialchars($announcement['time_posted']) ?></div>
                                    </div>
                                    <div class="card-title-2 pb-3">
                                        <?= htmlspecialchars($announcement['title']) ?>
                                    </div>
                                    <p class="card-text pb-3 text-justify">
                                        <?= htmlspecialchars($announcement['content']) ?>
                                    </p>
                                    <div class="learn-more">
                                    <p class="card-text pb-3 text-justify"> Created By: 
                                        <?= htmlspecialchars($announcement['created_by']) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-custom-icon" aria-hidden="true">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>


            <div class="row p-5">
              <div class="col-md-12 p-5 barangay-i-title">
                BARANGAY INFORMATION
              </div>
              <div class="col-md-12 col-lg-6 col-xl-6 p-4">
                <div class="card mb-2 bg-gradient-dark">
                  <img
                    class="card-img-top"
                    src="../centralized-service-system/dist/img/brgy-info-pic.jfif"
                    alt="Dist Photo 1"
                  />
                  <div
                    class="card-img-overlay d-flex flex-column justify-content-end"
                  >
                    <h5 class="card-title text-primary text-white">
                      Card Title
                    </h5>
                    <p class="card-text text-white pb-2 pt-1">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit
                      sed do eiusmod tempor.
                    </p>
                    <a href="#" class="text-white">Last update 2 mins ago</a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-6 p-4">
                <p class="card-text p-5 text-justify"">
                  At the heart of Barangay 1234, our mission is to cultivate a nurturing environment where every resident, regardless of background or circumstance, can flourish. We are committed to promoting unity, equity, and social justice through transparent and accountable governance. By providing efficient and responsive public services, fostering sustainable development initiatives, and nurturing a culture of active citizenship, we aim to enhance the quality of life for all members of our community. Our mission is not just to meet the needs of today but to build a foundation for a prosperous and resilient future, where every individual has the opportunity to reach their full potential.
                </p>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-8 p-4 mx-auto">
                <div class="card mb-2 bg-gradient-dark">
                  <img
                    class="card-img-top"
                    src="../centralized-service-system/src/barangay_bg.jpg"
                    alt="Dist Photo 1"
                  />
                  <div
                    class="card-img-overlay d-flex flex-column justify-content-end"
                  >
                    <h5 class="card-title text-primary text-white">
                      Card Title
                    </h5>
                    <p class="card-text text-white pb-2 pt-1 text-justify">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit
                      sed do eiusmod tempor.
                    </p>
                    <a href="#" class="text-white">Last update 2 mins ago</a>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-12 p-4">
                <p class="card-text p-5 text-justify"">
                In Barangay 1234, we envision a future where the bonds of kinship and solidarity strengthen our community, and where diversity is embraced as a source of strength. We aspire to be a beacon of excellence and innovation, setting the standard for inclusive and participatory governance. Our vision is of a barangay where infrastructure meets the needs of our residents, where economic opportunities abound, and where environmental sustainability is a cornerstone of our development efforts. We see [Barangay Name] as not just a place on the map but as a home where generations thrive, where dreams are nurtured, and where the legacy of our shared heritage is cherished and passed on with pride.
                </p>
              </div>
            </div>

            <div class="row officials">
              <div class="col-md-12 p-5 officials-title">
                <div class="officials-title text-center">BARANGAY OFFICIALS</div>
                <div class="officials-subtitle text-center">Meet our officials that govern the entire district.</div>
              </div>
              <div class="card-body p-5">
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <img src="../centralized-service-system/src/bo-prof.jpg" alt="user-avatar" class="img-fluid">
                    <div class="d-flex flex-fill justify-content-center flex-column p-4">
                      <div class="bo-info text-center">JANE DOE</div>
                      <div class="bo-position text-center">Chairman</div>
                      <div class="bo-socials d-flex justify-content-center pt-4">
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                      </div>
  
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <img src="../centralized-service-system/src/bo-prof.jpg" alt="user-avatar" class="img-fluid">
                    <div class="d-flex flex-fill justify-content-center flex-column p-4">
                      <div class="bo-info text-center">JANE DOE</div>
                      <div class="bo-position text-center">Chairman</div>
                      <div class="bo-socials d-flex justify-content-center pt-4">
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                      </div>
  
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <img src="../centralized-service-system/src/bo-prof.jpg" alt="user-avatar" class="img-fluid">
                    <div class="d-flex flex-fill justify-content-center flex-column p-4">
                      <div class="bo-info text-center">JANE DOE</div>
                      <div class="bo-position text-center">Chairman</div>
                      <div class="bo-socials d-flex justify-content-center pt-4">
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                      </div>
  
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <img src="../centralized-service-system/src/bo-prof.jpg" alt="user-avatar" class="img-fluid">
                    <div class="d-flex flex-fill justify-content-center flex-column p-4">
                      <div class="bo-info text-center">JANE DOE</div>
                      <div class="bo-position text-center">Chairman</div>
                      <div class="bo-socials d-flex justify-content-center pt-4">
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                      </div>
  
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <img src="../centralized-service-system/src/bo-prof.jpg" alt="user-avatar" class="img-fluid">
                    <div class="d-flex flex-fill justify-content-center flex-column p-4">
                      <div class="bo-info text-center">JANE DOE</div>
                      <div class="bo-position text-center">Chairman</div>
                      <div class="bo-socials d-flex justify-content-center pt-4">
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                      </div>
  
                    </div>
                  </div>
                  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <img src="../centralized-service-system/src/bo-prof.jpg" alt="user-avatar" class="img-fluid">
                    <div class="d-flex flex-fill justify-content-center flex-column p-4">
                      <div class="bo-info text-center">JANE DOE</div>
                      <div class="bo-position text-center">Chairman</div>
                      <div class="bo-socials d-flex justify-content-center pt-4">
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
                        <i class="social fas fa-circle ml-1 mr-1"></i>
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
    <script src="../centralized-service-system/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../centralized-service-system/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="../centralized-service-system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../centralized-service-system/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../centralized-service-system/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../centralized-service-system/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../centralized-service-system/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../centralized-service-system/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../centralized-service-system/plugins/moment/moment.min.js"></script>
    <script src="../centralized-service-system/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../centralized-service-system/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../centralized-service-system/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../centralized-service-system/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../centralized-service-system/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../centralized-service-system/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../centralized-service-system/dist/js/pages/dashboard.js"></script>

    <script src="../centralized-service-system/script.js"></script>
  </body>
</html>
