
<?php
include '../connection.php';

// Fetch all details from the hiring table
$sql = "SELECT * FROM lender";
$result = $con->query($sql);

// Handle status update when buttons are clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['lender_id'])) {
    $lender_id = $_POST['lender_id'];
    $action = $_POST['action'];

    if ($action === 'accept' || $action === 'reject') {
        $sql = "UPDATE lender SET status = '$action' WHERE lender_id = '$lender_id'";
        if ($con->query($sql) === TRUE) {
            // Redirect back to the page after status update
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error updating status: " . $con->error;
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
     <?php include 'navbar_admin.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
     <?php include 'sidebar_admin.php'; ?>
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
                 
                    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Photo</th>
                    <th>ID Proof</th>
                    <th>Address</th>
                    <!-- Add more table headings for other columns if needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['lender_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td><img class='width' src=../uploads/" . $row['photo'] ." '> </td>";
                        echo "<td><img class='width' src=../uploads/" . $row['id_proof'] ." '> </td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                        echo "<input type='hidden' name='lender_id' value='" . $row['lender_id'] . "'>";
                        echo "<input type='hidden' name='action' value='accept'>";
                        echo "<button type='submit' class='btn btn-success btn-sm'>Accept</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                        echo "<input type='hidden' name='lender_id' value='" . $row['lender_id'] . "'>";
                        echo "<input type='hidden' name='action' value='reject'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm'>Reject</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
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
<style>
  .width{
    width:50px!important;
    height:50px!important
  }
</style>