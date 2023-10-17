<?php
session_start();
$user = $_SESSION['username'];
include "connect.php";
include "validate.php";
include "time.php";
include 'category.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = validate($_POST['title']);
    $subtitle = validate($_POST['subtitle']);
    $content = validate($_POST['content']);
    $category = validate($_POST['submitcategory']);
    $reporter = validate($_POST['reporter']);
    $id = validate($_POST['id']);


    $target_dir = "C:/Xampp/htdocs/NewsWebsite/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        header("Location: admin.php?message=File is not an image.");
        $uploadOk = 0;
    } else {
        $uploadOk = 1;
        // Check if file already exists
        if (file_exists($target_file)) {
            header("Location: admin.php?message=Sorry, file already exists.");
            $uploadOk = 0;
        }else{
            // Check file size
            if ($_FILES["image"]["size"] > 50000) {
                header("Location: admin.php?message=Sorry, File limit is 50MB");
                $uploadOk = 0;
            }else{
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    header("Location: admin.php?message=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                    $uploadOk = 0;
                }else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image = "uploads/" . basename($_FILES["image"]["name"]);
                        if(strpos($reporter, '[Guest]')){
                            $addreporter = "INSERT INTO reporters(reporter, reportertype) VALUES('$reporter', 'guest')";
                            $addreporterquery = mysqli_query($connect, $addreporter);
                        }
                        if(!(in_array($category, $categories))){
                            $addcategory = "INSERT INTO category(categories) VALUES('$category')";
                            $addcategoryquery = mysqli_query($connect, $addcategory);
                        }
                        $insertarticle = "UPDATE articletable SET title = '$title', subtitle = '$subtitle', content = '$content', category = '$category', reporter = '$reporter', image = '$image', date = '$currentFullDate', month = '$currentMonth', year = '$currentYear' WHERE id = '$id'";
                        $insertquery = mysqli_query($connect, $insertarticle);

                        if($insertquery){
                            header("Location: editnewsdetails.php?message=Post Updated&id=$id");
                        }else{
                            header("Location: editnewsdetails.php?message=Error");
                        }
                    }
                }
            }
        }
    }
}else{
    header("Location: adminlogin.php");
}
?>

    
    
}else{
    header("Location: adminlogin.php");
}