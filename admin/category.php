<?php
include "connect.php";

$getcategory = "SELECT * FROM category";
$categoryquery = mysqli_query($connect, $getcategory);

if($categoryquery){
    $categories = [];
    while($row = mysqli_fetch_assoc($categoryquery)){
        $categories[] = $row['categories'];
    }
}

$users = "SELECT reporter FROM reporters";
  $usersquery = mysqli_query($connect, $users);

  if($usersquery){
    $usernames = [];
    while($row = mysqli_fetch_assoc($usersquery)){
        $usernames[] = $row['reporter'];
    }
  }
?>