<?php
    include 'connect.php';

    $category = 'Politics';
    $reporter = 'Olayori';
    $month = 'September';

    $getarticles = "SELECT * FROM articletable WHERE category LIKE '$category' AND reporter LIKE '%'";
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