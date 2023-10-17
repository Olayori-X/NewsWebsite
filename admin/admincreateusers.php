<?php
include 'connect.php';
include 'validate.php';

$txtfirstName = $_POST['firstName'];
$txtlastName = $_POST['lastName'];
$txtPhone = $_POST['phoneNumber'];
$txtEmail = validate($_POST['email']);
// $txtCountry = $_POST['country'];
// $txtState = $_POST['state'];
// $txtCity = $_POST['city'];
$txtPassword = md5(validate($_POST['password']));
$txtconfirmPassword = md5(validate($_POST['confirmPassword']));
$txtUsername = validate($_POST['username']);
$txtCompanyCode = validate($_POST['code']);

if($txtCompanyCode == $code){
	if($txtPassword != $txtconfirmPassword){
		header("Location: javascript:history.go(-1)");
		exit();
	}
	else{
		$UserVerification = "SELECT Username FROM adminusers WHERE Username = '$txtUsername'";
		$UserQuery = mysqli_query($connect, $UserVerification);

		if($UserQuery -> num_rows > 0){
			while($row = $UserQuery->fetch_assoc()) {
				echo $row['Username'];
				if($row['Username'] === $txtUsername){

					header("Location: adminsignup.php?error=This Username exists");
					echo "This Username exists";

				}else {
					$sql = "INSERT INTO adminusers (firstname, lastname, phone, email, username, password) VALUES ('$txtfirstName', '$txtlastName', '$txtPhone','$txtEmail', '$txtUsername','$txtPassword')";

					// insert in database 
					$rs = mysqli_query($connect, $sql);

					if($rs){
						$addreporter = "INSERT INTO reporters(reporter, reportertype) VALUES('$txtUsername', 'user')";
                        $addreporterquery = mysqli_query($connect, $addreporter);
						header("Location: adminlogin.php");
						exit();
					}
				}
			}
		}else{
			$sql = "INSERT INTO adminusers (firstname, lastname, phone, email, username, password) VALUES ('$txtfirstName', '$txtlastName', '$txtPhone','$txtEmail', '$txtUsername','$txtPassword')";

			// insert in database 
			$rs = mysqli_query($connect, $sql);

			if($rs){
				$addreporter = "INSERT INTO reporters(reporter, reportertype) VALUES('$txtUsername', 'user')";
                $addreporterquery = mysqli_query($connect, $addreporter);
				header("Location: adminlogin.php");
				exit();
			}
		}
	}
}
else{
	header("Location: adminsignup.php?error=Incorrect Company Code");
}
?>

