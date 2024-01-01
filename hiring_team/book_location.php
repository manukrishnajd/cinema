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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $details = $_POST['details'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';
    $login_id=$_SESSION['login_id'];
    if (isset($_GET['location_id'])) {
      $location_id = $_GET['location_id'];
  }

    // Validate and sanitize the form data (perform appropriate validation)
    // For example, you can check if the required fields are not empty before proceeding

    // Insert the booked location data into the database
    $insertQuery = "INSERT INTO book_location (location_id,login_id, start_date, end_date,details,status) VALUES ('$location_id','$login_id','$start_date','$end_date','$details','pending')";
    $result = mysqli_query($con, $insertQuery);

    if ($result) {
        // Booking successful, you can redirect to a success page or perform other actions
        ?>
        <script>alert('booking succesful')</script>
        <?php
        header("Location: /film/hiring_team/book_location.php"); // Redirect to a success page
        exit();
    } else {
        // Handle the case where the booking insertion fails
        echo "Error: " . mysqli_error($con);
        // You can redirect or display an error message as per your requirement
    }
}
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
      <!-- partial -->
      <?php include 'navbar_hiringteam.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
     <?php include 'sidebar_hiringteam.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           
            <div class="row">
              
            <center>
              <div class="col-8 grid-margin stretch-card" style="text-align:left">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Book</h4>
                    <form class="forms-sample" method='post' enctype="multipart/form-data">
                     
                      <div class="form-group">
                        <label for="exampleInputName1">details</label>
                        <textarea class="form-control" id="exampleInputName1" name='details' placeholder="details" row='10' col='10'></textarea>
                      </div>
                      <div class="form-group">
                        <label>start date</label>
                        <div class="input-group col-xs-12">
                          <input type="date" class="form-control file-upload-info" name="start_date"  placeholder="Start date">
                          
                        </div>
                      <div class="form-group">
                        <label>end date</label>
                        <div class="input-group col-xs-12">
                          <input type="date" class="form-control file-upload-info" name="end_date"  placeholder="End date">
                          
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
              </center>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
       
          <!-- partial -->
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