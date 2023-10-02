<?php
session_start();
$user = $_SESSION['username'];
include "connect.php";
include "validate.php";
include "time.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = validate($_POST['title']);
    $content = validate($_POST['content']);
    $category = validate($_POST['category']);
    $reporter = validate($_POST['reporter']);
    $image = validate($_POST['image']);
    if(strtoupper($reporter) == "NIL"){
        $reporter = $user;
    }

    $insertarticle = "INSERT INTO articletable(title, content, category, reporter, image, date, month, year) VALUES ('$title', '$content', '$category', '$reporter', '$image' '$currentFullDate', '$currentMonth', '$currentYear')";
    $insertquery = mysqli_query($connect, $insertarticle);

    if($insertquery){
        header("Location: admin.php");
    }else{
        echo "Error";
    }
}else{
    header("Location: adminlogin.php");
}
?>