<?php
include '../connection.php';
// Start the session to access session variables
session_start();

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id'])) {
  // Retrieve the 'id' value from the URL
  $id = $_GET['id'];

  // Fetch data from the location table based on the provided ID
  $result = mysqli_query($con, "SELECT * FROM location WHERE location_id = '$id'");
  
  if ($result && mysqli_num_rows($result) > 0) {
      // Fetch the data as an associative array
      $locationData = mysqli_fetch_assoc($result);
      echo "data";
  } else {
      echo "No data found for the provided ID";
  }
} else {
  echo "No ID parameter found in the URL";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get input data from the form
  $name = $_POST['name'] ?? '';
  $price = $_POST['price'] ?? '';
  $details = $_POST['details'] ?? '';
  $login_id = $_SESSION['login_id'] ?? '';

  $photo = $_FILES['image']['name'] ?? ''; // File name

  $target_dir = "../uploads/"; // Directory where the file will be stored
  move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $photo);

  // Prepare the base SQL query
  $sql = "UPDATE location SET";
  $setValues = [];

  // Create SET clauses for the fields that are provided
  if (!empty($name)) {
      $setValues[] = " name = '$name'";
  }
  if (!empty($price)) {
      $setValues[] = " price = '$price'";
  }
  if (!empty($details)) {
      $setValues[] = " details = '$details'";
  }
  if (!empty($photo)) {
      $setValues[] = " image = '$photo'";
  }

  // Combine the SET clauses
  $sql .= implode(',', $setValues);

  // Add WHERE condition for the location ID
  $sql .= " WHERE location_id = '$id'";

  // Execute the SQL query
  mysqli_query($con, $sql);

  // Redirect to a success page or any other page after updating
  header("Location: /film/location_lender/view_location.php");
  // Replace success.php with your success page
  
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
        <!-- Populate form fields with fetched data as placeholders -->
        <input type="text" class="form-control" id="exampleInputName1" name='name' placeholder="<?php echo isset($locationData['name']) ? $locationData['name'] : ''; ?>">
        <input type="text" class="form-control" id="exampleInputName1" name='price' placeholder="<?php echo isset($locationData['price']) ? $locationData['price'] : ''; ?>">
        <input type="text" class="form-control" id="exampleInputEmail3" name='details' placeholder="<?php echo isset($locationData['details']) ? $locationData['details'] : ''; ?>">
        <input type="file" class="form-control file-upload-info" name="image"  placeholder="Upload Image">
        <!-- Add a hidden input field to pass 'id' during form submission -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
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