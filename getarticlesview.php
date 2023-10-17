<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
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
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = file_get_contents("php://input");
	$newsinfo = json_decode($data, true);

    function changedata($data){
        if($data == "Select"){
            $data = '%';
        }
        return $data;
    }
    $category = changedata($newsinfo['category']);
    $reporter = changedata($newsinfo['reporter']);
    $month = changedata($newsinfo['month']);
    $year = changedata($newsinfo['year']);

    $getarticles = "SELECT * FROM articletable WHERE category LIKE '$category' AND reporter LIKE '$reporter' AND month LIKE '$month' AND year LIKE '$year'";
    $getarticlequery = mysqli_query($connect, $getarticles);

    if($getarticlequery){
        $articleinfo = [];

        while($row = mysqli_fetch_assoc($getarticlequery)){
            $articleinfo[] = $row;
        }

        header("Content-Type: application/json");
        echo json_encode($articleinfo);
    }
}
?>