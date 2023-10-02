<?php
session_start();
$user = $_SESSION['username'];
include "connect.php";
include "validate.php";
include "time.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = validate($_POST['title']);
    $content = validate($_POST['content']);
    $category = validate($_POST['submitcategory']);
    $reporter = validate($_POST['reporter']);
    $image = validate($_POST['image']);
    $id = validate($_POST['id']);
    if(strtoupper($reporter) == "NIL"){
        $reporter = $user;
    }

    $insertarticle = "UPDATE articletable SET title = '$title', content = '$content', category = '$category', reporter = '$reporter', image = '$image', date = '$currentFullDate', month = '$currentMonth', year = '$currentYear' WHERE id = '$id'";
    $insertquery = mysqli_query($connect, $insertarticle);

    if($insertquery){
        header("Location: editnewsdetails.php?message=Post Updated&id=$id");
    }else{
        header("Location: editnewsdetails.php?message=Error");
    }
}else{
    header("Location: adminlogin.php");
}