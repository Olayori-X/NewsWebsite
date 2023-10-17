<?php
session_start();
include 'connect.php';



if (isset($_POST['email']) && isset($_POST['password'])) {
	include 'validate.php';
	
	$email = validate($_POST['email']);
	$password = md5(validate($_POST['password']));

	if (empty($email)){
		header("Location: adminlogin.php?error=Username is required");
		exit();
	}else if(empty($password)) {
		header("Location: adminlogin.php?error=Password is required");
		exit();
	}else{
		$info = "SELECT * FROM adminusers WHERE email = '$email' ";
		$SQLpass = mysqli_query($connect, $info);


		if (mysqli_num_rows($SQLpass) >= 1) {
		$row = mysqli_fetch_assoc($SQLpass);

			if($row['password'] === $password){
				echo "Logged in!";
				$_SESSION['username'] = $row['username'];
				echo $_SESSION['username'];
				header("Location: admin.php");
				exit();
			}else{
				header("Location: adminlogin.php?error=Incorrect Password");
				exit();	
			}

		}else{
			header("Location: adminlogin.php?error=Incorrect Username");
			exit();	
	}
}
}
?>