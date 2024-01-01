<?php
// Start the session to access session variables
session_start();

// Include your database connection
include '../connection.php';
if (!isset($_SESSION['login_id'])) {
  // Redirect to the login page if the session variable is not set
  header("Location: /film"); // Replace login.php with your login page URL
  exit();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['work_name'];
    $description = $_POST['description'];
    $login_id = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : null;

    // Process file upload if needed (adjust this part according to your file upload method)
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    $target_dir = "../uploads/"; // Directory where the file will be stored
    move_uploaded_file($file_tmp, $target_dir . $file_name);

    // Insert data into the previous_work table
    $query = "INSERT INTO previous_work (login_id, name, details, image) VALUES ('$login_id', '$name', '$description', '$file_name')";

    if (mysqli_query($con, $query)) {
        
?>
<script>alert('added succesfully')
<?php
header('Location: /film/user/previous_work_view.php')
?>
</script>

<?php

        // Redirect to another page or perform any further actions after successful insertion
        // header("Location: another_page.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
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
                    <h4 class="card-title">Add Your Previous Works</h4>
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="workName">Name of the work</label>
                                            <input type="text" class="form-control" id="workName" name="work_name" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="workDescription">Description</label>
                                            <input type="text" class="form-control" id="workDescription" name="description" placeholder="Description" required>
                                        </div>
                                        <div class="form-group">
                                            <label>File upload</label>
                                            <div class="input-group col-xs-12">
                                                <input type="file" class="form-control file-upload-info" name='file' placeholder="Upload Image">
                                            </div>
                                        </div>
                                      
                                          <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
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