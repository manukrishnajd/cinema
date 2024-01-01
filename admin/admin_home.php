<?php
include '../connection.php';



// Get count of rows in the hiring table
$sqlHiringCount = "SELECT COUNT(*) as hiring_count FROM hiring";
$resultHiringCount = $con->query($sqlHiringCount);
$hiringCount = ($resultHiringCount->num_rows > 0) ? $resultHiringCount->fetch_assoc()['hiring_count'] : 0;

// Get count of rows in the lender table
$sqlLenderCount = "SELECT COUNT(*) as lender_count FROM lender";
$resultLenderCount = $con->query($sqlLenderCount);
$lenderCount = ($resultLenderCount->num_rows > 0) ? $resultLenderCount->fetch_assoc()['lender_count'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Purple Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Your custom CSS or additional styles -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar_admin.php'; ?>

    <div class="container-fluid page-body-wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar_admin.php'; ?>

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> Dashboard
                    </h3>
                </div>

                <!-- Row to display counts -->
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Hiring Team <i class="mdi mdi-chart-line mdi-24px float-right"></i></h4>
                                <h2 class="mb-5"><?php echo $hiringCount; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Location Lender <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                                <h2 class="mb-5"><?php echo $lenderCount; ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- Add more similar code blocks to display counts of other tables if needed -->
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- Endinject -->
        <!-- Plugin js for this page -->
        <script src="../assets/vendors/chart.js/Chart.min.js"></script>
        <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- Inject:js -->
        <script src="../assets/js/off-canvas.js"></script>
        <script src="../assets/js/hoverable-collapse.js"></script>
        <script src="../assets/js/misc.js"></script>
        <!-- Endinject -->
        <!-- Custom js for this page -->
        <script src="../assets/js/dashboard.js"></script>
        <script src="../assets/js/todolist.js"></script>
        <!-- End custom js for this page -->
    </body>
</html>
