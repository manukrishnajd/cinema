<?php
// Start the session to access session variables
session_start();

// Check if the login_id is set in the session
if (!isset($_SESSION['login_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php"); // Replace login.php with your login page
    exit();
}

// Include your database connection
include '../connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_location'])) {
  $vacancy_id = $_POST['delete_location'];

  // Delete record from the database
  $delete_query = "DELETE FROM vacancy WHERE vacancy_id = '$vacancy_id'";
  $delete_result = mysqli_query($con, $delete_query);

  if ($delete_result) {
      echo '<script>windows.location.reload()</script>';
  } else {
      echo '<script>alert("Failed to delete location. Please try again.");</script>';
  }
}


// Fetch location data for the current session's login_id
$login_id = $_SESSION['login_id'];
$query = "SELECT * FROM vacancy WHERE login_id = '$login_id'";
$result = mysqli_query($con, $query);

// Fetch data and populate the HTML table
// Example code for populating the table
$tableData = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tableData .= "<tr>";
        $tableData .= "<td>" . $row['vacancy_id'] . "</td>";
        $tableData .= "<td>" . $row['name'] . "</td>";
        $tableData .= "<td>" . $row['details'] . "</td>";
        $tableData .= "<td>" . $row['vacancies'] . "</td>";
        $tableData .= "<td>
        <form method='post' >
                    <button type='submit' data-id=". $row['vacancy_id']." class='btn btn-danger' name='delete_location' value=" . $row['vacancy_id'] . ">Delete</button>
                </form>
                </td>";
                
        $tableData .= "<td>
       
       <a href='/film/hiring_team/edit_vacancy.php?id=". $row['vacancy_id']."'> <button type='button' id='editbt' data-id=". $row['vacancy_id']." class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
        Edit
      </button></a>
      
      
        </td>";
        
        $tableData .= "</tr>";
    }
} else {
    $tableData .= "<tr><td colspan='5'>No data found</td></tr>";
}

// Close the database connection
mysqli_close($con);
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
                    <h4 class="card-title">Locations  </h4>
                 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th># </th>
                                <th> name of post </th>
                                <th> Details </th>
                                <th> Vacancies </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $tableData; ?>
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
    <!-- End custom js for this page -->
  </body>
</html>