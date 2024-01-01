<?php
// Start the session to access session variables
session_start();

// Include your database connection
include '../connection.php';

// Check if the login_id is set in the session
if (!isset($_SESSION['login_id'])) {
  // Redirect to the login page if the session variable is not set
  header("Location: /film"); // Replace login.php with your login page URL
  exit();
}
// Retrieve vacancy_id from the URL parameter as an integer
if (isset($_GET['vacancy_id'])) {
    $vacancy_id = intval($_GET['vacancy_id']); // Convert the parameter value to an integer
} else {
    // Redirect to a page or display an error if vacancy_id is not provided
    // For example:
    header("Location: /error.php"); // Replace error.php with your error page URL
    exit();
}

// Process form submission when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data from the form
    $details = $_POST['bio'];
    $login_id = $_SESSION['login_id'];
    $photo = $_FILES['image']['name']; // File name
    $target_dir = "../uploads/"; // Directory where the file will be stored

    // You may want to add additional checks or validation for file uploads
    move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $photo);

    // Prepare and execute the SQL query to insert data into the application table
    $query = "INSERT INTO application (login_id, vacancy_id, resume, bio,status) VALUES ('$login_id', '$vacancy_id', '$photo', '$details','pending')";
    mysqli_query($con, $query);

    // Redirect to a success page or any other page after insertion
    header("Location: /film/user/my_applications.php");
    exit();
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
      <?php include 'navbar_user.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
     <?php include 'sidebar_user.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           
            <div class="row">
              
            <center>
              <div class="col-8 grid-margin stretch-card" style="text-align:left">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Apply</h4>
                    <form class="forms-sample" method='post' enctype="multipart/form-data">
                     
                      <div class="form-group">
                        <label for="exampleInputName1">bio</label>
                        <textarea class="form-control" id="exampleInputName1" name='bio' placeholder="bio" row='10' col='10'></textarea>
                      </div>
                      <div class="form-group">
                        <label>Resume</label>
                        <div class="input-group col-xs-12">
                          <input type="file" class="form-control file-upload-info" name="image"  placeholder="Upload Image">
                          
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