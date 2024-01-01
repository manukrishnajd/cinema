
<?php
// Start the session to access session variables
session_start();

// Include your database connection
include '../connection.php';

// Check if the login_id is set in the session
if (!isset($_SESSION['login_id'])) {
    // Redirect to the login page if the session variable is not set
    header("Location: /login.php"); // Replace login.php with your login page URL
    exit();
}

// Fetch application details including the corresponding vacancy name for the logged-in user
if (isset($_GET['login_id'])) {
  $login_id = intval($_GET['login_id']); 
  echo $login_id;
}

$query = "SELECT previous_work.*,application.* from application join previous_work on application.login_id=previous_work.login_id where application.login_id='$login_id'";

$result = mysqli_query($con, $query);
$applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
            <div class='d-flex gap-4 flex-wrap'>

            <?php foreach ($applications as $application): ?>

            <div class="card" style="width: 18rem;">
  <img class="card-img-top" src='../uploads/<?php echo $application['image']; ?>' alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $application['name']; ?></h5>
    <p class="card-text"><?php echo $application['details']; ?></p>
  </div>
</div>
<?php endforeach; ?>
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