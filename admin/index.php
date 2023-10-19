<?php
session_start();
include "connect.php";
include "category.php";

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
    $getactivity = "SELECT * FROM activitytable WHERE username = '$username'";
    $getactivityquery = mysqli_query($connect, $getactivity);
    
    if($getactivityquery){
        $activities = [];
        while($row = mysqli_fetch_assoc($getactivityquery)){
            $activities[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Website Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel = "stylesheet" href= "indexstyle.css">
    <script src = "indexjs.js"></script>
</head>
<body>
    <?php include "UItrial.php"; ?>

    

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class = "text-center"><h2>Dashboard</h2></div>
                <!-- <div class = "center"><div>Hello</div></div> -->
                <div class = "row">
                    <div id = "activity" class = "col-md-6">Hello</div>
                    <div id = "recentactivity" class = "col-md-6">Hello</div>
                </div>

            </main>
        </div>
    </div>

    <script>
        var activity = <?php echo json_encode($activities); ?>;

        get(activity, document.getElementById('activity'));
    </script>

</body>
</html>
<?php
}else{
    header("Location: adminlogout.php");
}
?>