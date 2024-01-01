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

// Get the login_id from the session
$login_id = $_SESSION['login_id'];

// Fetch data from book_location and location tables
$query = "SELECT bl.*, l.* 
          FROM book_location AS bl
          INNER JOIN location AS l ON bl.location_id = l.location_id
          WHERE bl.login_id = $login_id";

$result = mysqli_query($con, $query);

$bookLocationDetails = [];

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the data and store it in $bookLocationDetails array
    while ($row = mysqli_fetch_assoc($result)) {
        $bookLocationDetails[] = $row;
    }
} else {
    // Handle the case where no data is found
    echo "No data found for the provided login ID.";
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
           
         
           
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Bookings</h4>
                 
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> location name </th>
                          <th> start date </th>
                          <th> end date </th>
                          <th> details </th>
                          <th> status </th>
                        </tr>
                      </thead>
                      <tbody>
            <?php
            if (isset($bookLocationDetails)) {
                // Loop through the fetched data and display it in the table rows
                foreach ($bookLocationDetails as $index => $row) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $row['name'] . "</td>"; // Assuming 'location_name' is a column name from the fetched data
                    echo "<td>" . $row['start_date'] . "</td>"; // Assuming 'start_date' is a column name from the fetched data
                    echo "<td>" . $row['end_date'] . "</td>"; // Assuming 'end_date' is a column name from the fetched data
                    echo "<td>" . $row['details'] . "</td>"; // Assuming 'details' is a column name from the fetched data
                    echo "<td>" . $row['status'] . "</td>"; // Assuming 'status' is a column name from the fetched data
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            ?>
        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            
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