<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        include 'connect.php';
        $categorylist = $_GET['category'];

        $getcategorylists = "SELECT * FROM articletable WHERE category = '$categorylist'";
        $getquery = mysqli_query($connect, $getcategorylists);

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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9Blyw0ceOg07C8I3lwy4zve7Nq/yaTZyTX/Frqf12DdBOeGB1Up5eXA7Q9wM68VSd" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Image Gallery</title>
    <script src = 'shownewslistsjs.js'></script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">NewsSite</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shownewslists.php?category=topnews">Top News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shownewslists.php?category=politics">Politics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shownewslists.php?category=business">Business</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shownewslists.php?category=technology">Technology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shownewslists.php?category=sports">Sports</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <h1 class="my-4">Image Gallery</h1>
        <div class="row" id = "articles">
            
            <!-- Add more image cards here -->
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
<?php } ?>