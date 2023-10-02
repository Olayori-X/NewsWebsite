<?php
include "connect.php";

$getarticles = "SELECT * FROM articletable";
$getarticlequery = mysqli_query($connect, $getarticles);

if($getarticlequery){
    $articleinfo = [];
    
    while($row = mysqli_fetch_assoc($getarticlequery)){
        $articleinfo[] = $row;
    }

    header("Content-Type: application/json");
    echo json_encode($articleinfo);
}
?>