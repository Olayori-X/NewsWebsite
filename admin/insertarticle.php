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
    $dateadded = $currentMonth . " " . $currentYear;


    $target_dir = "C:/Xampp/htdocs/NewsWebsite/admin/uploads/";
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
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
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
                    $image =  basename($_FILES["image"]["name"]);
                    if(strpos($reporter, '[Guest]')){
                        $addreporter = "INSERT INTO reporters(reporter, reportertype) VALUES('$reporter', 'guest')";
                        $addreporterquery = mysqli_query($connect, $addreporter);
                    }
                    if(!(in_array($category, $categories))){
                        $addcategory = "INSERT INTO category(categories) VALUES('$category')";
                        $addcategoryquery = mysqli_query($connect, $addcategory);
                    }
                    $insertarticle = "INSERT INTO articletable(title, subtitle, content, category, reporter, image, date, month, year) VALUES ('$title', '$subtitle', '$content', '$category', '$reporter', '$image', '$dateadded', '$currentMonth', '$currentYear')";
                    
                    $insertquery = mysqli_query($connect, $insertarticle);
        
                    if($insertquery){
                        $time = $currentHour. ":". $currentMinute; 
                        $insertactivity = "INSERT INTO activitytable(username, activity, time, date, month, year) VALUES('$user', 'Posted $title', '$time', '$currentFullDate', '$currentMonth', '$currentYear')";
                        $insertactivityquery = mysqli_query($connect, $insertactivity);
                        if($insertactivityquery){
                            header("Location: newpost.php");
                        }
                    }else{
                        echo "Error";
                    }
                }
            }
        }
    }
}else{
    header("Location: adminlogin.php");
}
?>