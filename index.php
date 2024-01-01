
<?php
// Include the database connection file
include 'connection.php';
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sub'])) {
    // Retrieve the entered username and password
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute a query to fetch user details based on username and user type
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userType = $row['type'];
        $_SESSION['login_id'] = $row['login_id'];
        

        if ($userType === 'admin') {
            // Redirect to adminhome.php if user type is 'admin'
            
            header("Location: admin/admin_home.php");
            
            exit();
        } elseif ($userType === 'hiring') {
            // Fetch the hiring details for the logged-in user
            $login_id = $row['login_id'];
            echo "$login_id";
            $hiringStatusQuery = "SELECT * FROM hiring WHERE login_id = '$login_id'";
            $hiringResult = $con->query($hiringStatusQuery);

            if ($hiringResult->num_rows > 0) {
                $hiringDetails = $hiringResult->fetch_assoc();
                $status = $hiringDetails['status'];

                if ($status === 'accept') {
                    // Redirect to view_application.php if status is 'accept'
                    header("Location: hiring_team/view_application.php");
                    exit();
                } else {
                    echo "Your status is pending or declined. You can't login at the moment.";
                }
            } else {
                echo "No hiring details found for this user.";
            }
        }
        elseif ($userType === 'lender') {
          // Fetch the hiring details for the logged-in user
          $login_id = $row['login_id'];
          $hiringStatusQuery = "SELECT * FROM lender WHERE login_id = '$login_id'";
          $hiringResult = $con->query($hiringStatusQuery);

          if ($hiringResult->num_rows > 0) {
              $hiringDetails = $hiringResult->fetch_assoc();
              $status = $hiringDetails['status'];

              if ($status === 'accept') {
                  // Redirect to view_application.php if status is 'accept'
                  header("Location: location_lender/view_location.php");
                  exit();
              } else {
                  echo "Your status is pending or declined. You can't login at the moment.";
              }
          } else {
              echo "No lender details found for this user.";
          }
      } 

      elseif ($userType === 'user') {
        // Fetch the hiring details for the logged-in user
        $login_id = $row['login_id'];
        $hiringStatusQuery = "SELECT * FROM user WHERE login_id = '$login_id'";
        $hiringResult = $con->query($hiringStatusQuery);

        if ($hiringResult->num_rows > 0) {
            $hiringDetails = $hiringResult->fetch_assoc();
            
                // Redirect to view_application.php if status is 'accept'
                header("Location: user/view_vaccancy.php");
                exit();
            
        } else {
            echo "No lender details found for this user.";
        }
    } 
        
        
        else {
            echo "Invalid username or password.";
        }
       
    } else {
        echo "Invalid username or password.";
    }
    $con->close();
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
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <!-- <img src="assets/images/logo.svg"> -->
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3"  method="POST">
                  <div class="form-group">
                    <input type="email" name='email' class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name='password' class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <input type='submit'  class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" name='sub'>
                  </div>
                 
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>