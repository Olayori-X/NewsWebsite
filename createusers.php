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
if(isset($_POST['newsid'])){
    $newsid = validate($_POST['newsid']);
}


if($txtPassword != $txtconfirmPassword){
    header("Location: javascript:history.go(-1)");
    exit();
}
else{
    $UserVerification = "SELECT username FROM user WHERE username = '$txtUsername'";
    $UserQuery = mysqli_query($connect, $UserVerification);

    if($UserQuery -> num_rows > 0){
        while($row = $UserQuery->fetch_assoc()) {
            if($row['Username'] === $txtUsername){
                if(isset($newsid)){
                    header("Location: signup.php?error=This Username exists&&newsid=$newsid");
                }else{
                    header("Location: signup.php?error=This Username exists");
                }

            }else {
                $sql = "INSERT INTO user (firstname, lastname, phone, email, username, password) VALUES ('$txtfirstName', '$txtlastName', '$txtPhone','$txtEmail', '$txtUsername','$txtPassword')";

                // insert in database 
                $rs = mysqli_query($connect, $sql);

                if($rs){
                    if(isset($newsid)){
                        header("Location: login.php?newsid=$newsid");
                        exit();
                    }else{
                        header("Location: login.php");
                        exit();
                    }
                }
            }
        }
    }else{
        $sql = "INSERT INTO user (firstname, lastname, phone, email, username, password) VALUES ('$txtfirstName', '$txtlastName', '$txtPhone','$txtEmail', '$txtUsername','$txtPassword')";

        // insert in database 
        $rs = mysqli_query($connect, $sql);

        if($rs){
            if(isset($newsid)){
                header("Location: login.php?newsid=$newsid");
                exit();
            }else{
                header("Location: login.php");
                exit();
            }
        }
    }
}
?>

