<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        include 'connect.php';
        $reporterlist = $_GET['reporter'];

        $getreporterlists = "SELECT * FROM articletable WHERE reporter = '$reporterlist'";
        $getquery = mysqli_query($connect, $getreporterlists);

        if($getquery){
            $selectedarticles = [];
            while($row = mysqli_fetch_assoc($getquery)){
                $selectedarticles[] = $row;
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
    <script src = "selectedcategoryjs.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="articles.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reporters.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminlogout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome to the Admin Panel</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Home</h5>
                        <p class="card-text">Overview</p>
                        <a href="index.php" class="btn btn-primary">Go to Dashboard</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Articles</h5>
                        <p class="card-text">Manage news articles</p>
                        <a href="articles.php" class="btn btn-primary">Go to Articles</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage user accounts.</p>
                        <a href="reporters.php" class="btn btn-primary">Go to Users</a>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container">
            <h1 class="my-4">Articles written by <?php echo $reporterlist; ?></h1>
            <div class="row" id = "articles">
                
                <!-- Add more image cards here -->
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var categorylist = <?php echo json_encode($selectedarticles); ?>;
        get(categorylist, document.getElementById('articles'));
    </script>
</body>
</html>
<?php }else{
    header("Location: adminlogin.php");
} ?>