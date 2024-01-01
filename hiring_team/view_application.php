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

// Fetch applications based on the login_id and vacancy_id
$query = "SELECT a.application_id,a.resume,a.feedback, a.login_id, a.vacancy_id, v.name AS vacancy_name, a.status 
          FROM application a 
          INNER JOIN vacancy v ON a.vacancy_id = v.vacancy_id 
          WHERE a.vacancy_id = v.vacancy_id ";

$result = mysqli_query($con, $query);
if (!$result) {
  // Display error message if query execution fails
  echo "Error: " . mysqli_error($con);
} else {
  // Fetch data if the query is successful
  $applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

foreach ($applications as $application) {
  $a_loginId = $application['login_id'];

  // Fetch user details based on the login_id
  $userQuery = "SELECT * FROM user WHERE login_id = '$a_loginId'";
  $userResult = mysqli_query($con, $userQuery);

  if ($userResult) {
      // Fetch user data if the query is successful
      $userDetails[$a_loginId] = mysqli_fetch_assoc($userResult);
  } else {
      // Display error message if query execution fails
      echo "Error: " . mysqli_error($con);
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['status'])) {
      $status = $_POST['status'];
      // Perform status update in the application table
      $applicationId = $_POST['application_id'];

      $updateQuery = "UPDATE application SET status = '$status' WHERE application_id = '$applicationId'";
      $updateResult = mysqli_query($con, $updateQuery);

      if ($updateResult) {
          // Status updated successfully
          header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page
          exit();
      } else {
          // Display error message if status update fails
          echo "Error updating status: " . mysqli_error($con);
      }
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
                    <h4 class="card-title">Registered Hiring Teams</h4>
                    <div class="table-responsive">
                    <?php if (!empty($applications)): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Application ID</th>
                                                <th>Name of Applicant</th>
                                                <th>Contact</th>
                                                <th>Vacancy Name</th>
                                                <th style='width:20px'>resume</th>
                                                <th>feedback  </th>
                                                <th>Status</th>
                                                <!-- User details columns -->
                                                <!-- Add more columns as needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($applications as $application): ?>
                                                <tr>
                                                    <td><?php echo $application['application_id']; ?></td>
                                                    <td> <?php echo  $userDetails[$application['login_id']]['name'];?>

                                                   <br><br> <a href="/film/hiring_team/previous_work.php?login_id=<?php echo  $userDetails[$application['login_id']]['login_id'];?>"><button class='btn btn-primary'>previous work</button></a>

                                                  </td>

<td>
    <?php
   
    
            echo  $userDetails[$application['login_id']]['phone'];
        
  
    ?>
</td>
                                                    <td><?php echo $application['vacancy_name']; ?></td>
                                                    <td style='max-width: 100px; overflow: hidden; text-overflow: ellipsis;'><a href='../uploads/<?php echo $application['resume']; ?>' download>download</a></td>
                                                    <td><?php echo $application['feedback']; ?></td>
                                                    <td>
    <?php echo $application['status']; ?>
    <form method="post">
        <input type="hidden" name="application_id" value="<?php echo $application['application_id']; ?>"><br>
        <?php if ($application['status'] == 'pending'): ?>
          <button class='btn btn-success' type="submit" name="status" value="Accept">Accept</button><br><br>
            <button class='btn btn-danger' type="submit" name="status" value="Reject">Reject</button>
          
            <?php endif; ?>
        <?php if ($application['status'] == 'Reject'): ?>
            <button class='btn btn-success' type="submit" name="status" value="Accept">Accept</button><br><br>
        <?php endif; ?>
    </form>
</td>
                                                    <!-- Display user details -->
                                                    
                                                    <!-- Add more columns as per your application table structure -->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    </div>
                <?php else: ?>
                    <p>No applications found</p>
                <?php endif; ?>


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