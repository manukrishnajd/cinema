<?php
include '../connection.php';

// Fetch all vacancies from the vacancy table
$result = mysqli_query($con, "SELECT * FROM location");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
</head>
<body>

<!-- partial:partials/_navbar.html -->
<?php include 'navbar_hiringteam.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
     <?php include 'sidebar_hiringteam.php'; ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
            </div>

            <div class=" d-flex gap-4 flex-wrap">

                <?php
                // Loop through the fetched vacancies and create cards
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
<div class="card" style="width: 18rem;">
  <img class="card-img-top" width='300px' height='200px' src="../uploads/<?php echo $row['image']; ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row['name']; ?></h5>
    <h5 class="card-title">Rs. <?php echo $row['price']; ?></h5>
    <p class="card-text"><?php echo $row['details']; ?></p>
    <a href='/film/hiring_team/book_location.php?location_id=<?php echo $row['location_id']?>' class="card-link pe-2 m-auto "><button class='btn btn-primary'>Book now</button></a>
  </div>
</div>
                    
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="../assets/vendors/chart.js/Chart.min.js"></script>
<script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="../assets/js/dashboard.js"></script>
<script src="../assets/js/todolist.js"></script>
<!-- End custom js for this page -->
</body>
</html>
