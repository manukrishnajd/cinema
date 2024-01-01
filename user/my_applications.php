
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

// Fetch application details including the corresponding vacancy name for the logged-in user
$login_id = $_SESSION['login_id']; // Get the login_id from the session

$query = "SELECT a.application_id, a.login_id, a.vacancy_id, v.name,a.status,a.feedback 
          FROM application a 
          INNER JOIN vacancy v ON a.vacancy_id = v.vacancy_id 
          WHERE a.login_id = '$login_id'";

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
     <?php include 'navbar_user.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
     <?php include 'sidebar_user.php'; ?>
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
                 
                   
                  
                  
                    <div>
        <h1>Application Details</h1>
        <?php if (isset($applications) && !empty($applications)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Login ID</th>
                    <th>Vacancy ID</th>
                    <th>Vacancy Name</th>
                    <th>status</th>
                    <th>feedback</th>
                    <!-- Add more columns as per your application table structure -->
                </tr>
            </thead>
            <tbody>
            <?php foreach ($applications as $application): ?>
                <tr>
                    <td><?php echo $application['application_id']; ?></td>
                    <td><?php echo $application['login_id']; ?></td>
                    <td><?php echo $application['vacancy_id']; ?></td>
                    <td><?php echo $application['name']; ?></td>
                    <td><?php echo $application['status']; ?></td>
                    <td><?php echo $application['feedback']; ?></td>
                     <td>
                     <a href="feedback.php?application_id=<?php echo $application['application_id']; ?>">
    <button type="submit" class="btn btn-primary">Give Feedback</button></a>
</form>
                </td>
                    <!-- Ensure the column name matches the actual name in the vacancy table -->
                    <!-- Add more columns as per your application table structure -->
                </tr>
            <?php endforeach; ?>
            <!-- You can display additional rows here -->
        </tbody>
    </table>
    <?php else: ?>
        <p>No applications found</p>
    <?php endif; ?>
</div>
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