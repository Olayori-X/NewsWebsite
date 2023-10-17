<?php 
if(isset($_SESSION['username'])){
    session_start();
    $username = $_SESSION['username'];
}

    if (isset($_GET['id'])){
        include 'connect.php';
        include 'validate.php';

        $idget = validate($_GET['id']);
        $getdetails = "SELECT * FROM articletable WHERE id = '$idget'";
        $getdetailsquery = mysqli_query($connect, $getdetails);

        if($getdetailsquery){
            $articleinfo = [];
            
            while($row = mysqli_fetch_assoc($getdetailsquery)){
                $articleinfo[] = $row;
            }
        }

        $getcomments = "SELECT * FROM commenttable WHERE newsid = '$idget'";
        $getcommentsquery = mysqli_query($connect, $getcomments);

        if($getcommentsquery){
            $comments = [];
            
            while($row = mysqli_fetch_assoc($getcommentsquery)){
                $comments[] = $row;
            }
        }
        if(count($comments) > 0){
            $showcomments = "<div>";
            for($i = 0; $i < count($comments); $i++){
                $showcomments .= "<h6>" . $comments[$i]['username'] . "</h6><p>" . $comments[$i]['comment'] . "</p>";
            }
            $showcomments .= "</div";
        }else{
            $showcomments = "Be the first to comment";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    <div class="container mt-5">
        <header class="text-center">
            <h1><?php echo $articleinfo[0]['title']; ?></h1>
            <p>By <?php echo $articleinfo[0]['reporter']; ?></p>
        </header>
        <main>
            <article>
                <?php if($articleinfo[0]['image'] != ''){ ?>
                <div class="text-center">
                    <img src="admin/<?php echo $articleinfo[0]['image']; ?>" width= '300px' alt="Article Image" class="img-fluid">
                </div>
                <?php } ?>
                <p>
                    <?php echo $articleinfo[0]['content']; ?>
                </p>
            </article>
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title">Comments</h5>
                    <section><?php echo $showcomments; ?></section>
                    <form id = "newscomment " method = "post" action = "insertcomment.php">
                        <div class="form-group">
                            <label for="comment">Add a Comment</label>
                            <input type="text" class="form-control" id="comment" name = "comment" placeholder="Enter comment" required>
                        </div>
                        <input type = "hidden" value = "<?php echo $_GET['id']; ?>" name = "newsid">

                        <button type="submit" id = "submitform" class="btn btn-primary">Add comment</button>
                    </form>
                </div>
            </div>
        </main>
        <footer class="text-center mt-3">
            <p>&copy; 2023 Your Website</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
    }else{
        header("Location:index.php");
    }
?>