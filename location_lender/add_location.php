<?php
// Start the session to access session variables
session_start();

// Check if the login_id is set in the session
if (!isset($_SESSION['login_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php"); // Replace login.php with your login page
    exit();
}

// Process form submission when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection
    include '../connection.php';

    // Get input data from the form
    $name = $_POST['name'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $login_id = $_SESSION['login_id']; 

    $photo = $_FILES['image']['name']; // File name


    $target_dir = "../uploads/"; // Directory where the file will be stored
    // You may want to add additional checks or validation for file uploads
    move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $photo);
    // Fetch login_id from the session

    // Handle file upload if needed (adjust this part according to your file upload method)

    // Prepare and execute the SQL query to insert data into the location table
    mysqli_query($con, "INSERT INTO location(login_id,name,price, details,image) VALUES ('$login_id','$name','$price','$details','$photo')");
   

    // Close the database connection

    
    // Redirect to a success page or any other page after insertion
    header("Location: /film/location_lender/view_location.php");
    // Replace success.php with your success page
    
    $con->close();
    
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
     <?php include 'navbar_lender.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
     <?php include 'sidebar_lender.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           
            <div class="row">
              
            <center>
              <div class="col-8 grid-margin stretch-card" style="text-align:left">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Location</h4>
                    <form class="forms-sample" method='post' enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Location name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name='name' placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Price per day</label>
                        <input type="text" class="form-control" id="exampleInputName1" name='price' placeholder="price">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Details</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" name='details' placeholder="Details">
                      </div>
                      <div class="form-group">
                        <label>Location image</label>
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