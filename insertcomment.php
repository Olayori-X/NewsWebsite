<?php
if(isset($_POST['comment'])){
    include 'connect.php';
    include 'validate.php';
    $comment = validate($_POST['comment']);
    $newsid = validate($_POST['newsid']);

    session_start();
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];

        $insertcomment = "INSERT INTO commenttable(username, comment, newsid) VALUES ('$username', '$comment', '$newsid')";
        $insertquery = mysqli_query($connect, $insertcomment);
        if($insertquery){
            header("Location: shownewsdetails.php?id=$newsid");
        }
    }else{
        header("Location: login.php?newsid=$newsid");
    }
}else{
    header("Location: index.php");
}