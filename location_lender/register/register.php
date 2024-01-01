<?php
// Include the database connection file
include '../../connection.php'; // Replace 'connection.php' with your actual database connection file name

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Retrieve and sanitize form data
    $name = mysqli_real_escape_string($con, $_POST['Name']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['Password']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    // File upload handling
    $photo = $_FILES['photo']['name']; // File name
    $id_proof = $_FILES['id_proof']['name']; // File name
	echo "$id_proof";
    $target_dir = "../../uploads/"; // Directory where the file will be stored
    // You may want to add additional checks or validation for file uploads
    move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir . $photo);
    move_uploaded_file($_FILES['id_proof']['tmp_name'], $target_dir . $id_proof);

    // Perform database insertion
    mysqli_query($con, "INSERT INTO login(username,password,type) VALUES ('$email','$password','lender')");
    $log = mysqli_insert_id($con);
    $sql = mysqli_query($con, "INSERT INTO lender(login_id,name,phone,photo,id_proof,address,status) VALUES ('$log','$name','$phone','$photo','$id_proof','$address','pending')");
    $lid = mysqli_query($con, "SELECT * FROM login WHERE login_id = '$log'");

    if ($sql) {
        $row = mysqli_fetch_assoc($lid);
        $myarray['message'] = 'Added';
        $myarray['login_id'] = $row['login_id'];
    } else {
        $myarray['message'] = 'Failed';
    }
    echo json_encode($myarray);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
 
	<!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Space Register Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->

	<!-- css files -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- css files -->

	<!-- Online-fonts -->
	<link href="//fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
	<!-- //Online-fonts -->

</head>
<body>

	<!-- Main Content -->
	<div class="main">
		<div class="main-w3l">
			<h1 class="logo-w3">Register Form</h1>
			<div class="w3layouts-main">
				<h2><span>Register now</span></h2>
					<form  enctype="multipart/form-data" method="post">
						<input placeholder="Full Name" name="Name" type="text" required="">
						<input placeholder="Email" name="Email" type="email" required="">
						<input placeholder="Phone Number" name="phone" type="text" required="">
						<input placeholder="Password" name="Password" type="password"  id="password1" required="">
						<input placeholder="Confirm Password" name="Password" type="password"  id="password2" required="">
						<input placeholder="photo" name="photo" type="file"   required="">
						<input placeholder="ID Proof" name="id_proof" type="file" required="">
						<input placeholder="Address" name="address" type="text"   required="">
						<input type="submit" value="Get Started" name="register">
					</form>
			</div>
			<!-- //main -->
			
			<!-- password-script -->
			<script>
				window.onload = function () {
					document.getElementById("password1").onchange = validatePassword;
					document.getElementById("password2").onchange = validatePassword;
				}

				function validatePassword() {
					var pass2 = document.getElementById("password2").value;
					var pass1 = document.getElementById("password1").value;
					if (pass1 != pass2)
						document.getElementById("password2").setCustomValidity("Passwords Don't Match");
					else
						document.getElementById("password2").setCustomValidity('');
					//empty string means no validation error
				}
			</script>
			<!-- //password-script -->

			<!--footer-->
			
			<!--//footer-->
			
		</div>
	</div>
	<!-- //Main Content -->

</body>
</html>
