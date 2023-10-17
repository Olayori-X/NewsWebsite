<?php
session_start();
include 'connect.php';



if (isset($_POST['email']) && isset($_POST['password'])) {
	include 'validate.php';
	
	$email = validate($_POST['email']);
	$password = md5(validate($_POST['password']));
	if(isset($_POST['newsid'])){
		$newsid = validate($_POST['newsid']);
	}

	if (empty($email)){
		if(isset($newsid)){
			header("Location: login.php?error=Username is required&&newsid=$newsid");
		}else{
			header("Location: login.php?error=Username is required");
		}
		
		exit();
	}else if(empty($password)) {
		if(isset($newsid)){
			header("Location: login.php?error=Password is required&&newsid=$newsid");
		}else{
			header("Location: login.php?error=Password is required");
		}
		exit();
	}else{
		$info = "SELECT * FROM user WHERE email = '$email' ";
		$SQLpass = mysqli_query($connect, $info);


		if (mysqli_num_rows($SQLpass) >= 1) {
			$row = mysqli_fetch_assoc($SQLpass);

			if($row['password'] === $password){
				$_SESSION['username'] = $row['username'];
				
				if(isset($newsid)){
					header("Location: shownewsdetails.php?id=$newsid");
				}else{
					header("Location: index.php");
				}
				exit();
			}else{
				if(isset($newsid)){
					header("Location: login.php?error=Incorrect Password&&newsid=$newsid");
				}else{
					header("Location: login.php?error=Incorrect Password");
				}
				
				exit();	
			}

		}else{
			if(isset($newsid)){
				header("Location: login.php?error=Incorrect Username&&newsid=$newsid");
			}else{
				header("Location: login.php?error=Incorrect Username");
			}
			exit();	
		}
	}
}
?>