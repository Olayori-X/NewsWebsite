<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Website Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src = "admin.js"></script>
</head>
<?php
include "connect.php";
include "validate.php";

if(isset($_GET['id'])){
    $id = validate($_GET['id']);

    $getarticledetails = "SELECT * FROM articletable WHERE id = '$id'";
    $querydetails = mysqli_query($connect, $getarticledetails);

    if($querydetails){
        $newsdetails = [];
        while($row = mysqli_fetch_assoc($querydetails)){
            $newsdetails[] = $row;
        }

        // header('Content-Type: application/json');
        // echo json_encode($newsdetails);
        // print_r($newsdetails[0]['reporter']);
    }
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="articles.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminlogout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome to the Admin Panel</h1>
        <?php
         if(isset($_GET['message'])){ ?>
            <p><?php echo $_GET['message']; ?></p>
        <?php } ?>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Articles</h5>
                        <p class="card-text">Manage news articles.</p>
                        <a href="articles.php" class="btn btn-primary">Go to Articles</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <p class="card-text">Manage article categories.</p>
                        <a href="categories.php" class="btn btn-primary">Go to Categories</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage user accounts.</p>
                        <a href="#" class="btn btn-primary">Go to Users</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section for Posting News -->
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title">Post a News Article</h5>
                <form id = "newsForm" method = "post" action = "updatearticle.php">
                    <input type = "hidden" value = "<?php echo $id; ?>" name = "id">
                    <div class="form-group">
                        <label for="articleTitle">Title</label>
                        <input type="text" class="form-control" id="articleTitle" name = "title" placeholder="Enter title" value = "<?php echo $newsdetails[0]['title'];?>" required>
                    </div>
                    <div class="form-group">
                        <label for="articleContent">Content</label>
                        <textarea class="form-control" id="articleContent" rows="11" name = "content" placeholder="Enter article content" required><?php echo $newsdetails[0]['content'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id = "category" name = "category" onchange = "showinput(); changecategory()">
                            <option>Select category</option>
                            <!-- Populate with categories from your database -->
                            <option>Politics</option>
                            <option>Business</option>
                            <option>Sports</option>
                            <option>Technology</option>
                            <option>Music</option>
                            <option>Others</option>
                        </select>
                    </div>

                    <div class="form-group" id = "othercategorydiv" style= "display:none;">
                        <label for="othercategory">Input Custom Category</label>
                        <input type="text" class="form-control" name = "others" id="othercategory" placeholder="Enter Custom Category" onblur = "changecategory()">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="existingcategory" name = "submitcategory" value = "<?php echo($newsdetails[0]['category']);?>" readonly>
                    </div>

                    <div class="form-group card mt-2">
                        <div class = "card-body">
                            <label for="reporter">Reporter</label>
                            <input type="text" class="form-control" id="reporter" name = "reporter" placeholder="If none, Input 'Nil'" required><br>

                            <button type="button" id = "submitform" class="btn btn-success mx-auto d-block">Add New Guest</button>
                        </div>
                    </div>

                    <div class = "card-mt-8">
                        <div class = "card-body">
                            <h5 class = "card-title">Featured image</h5>
                            <div class = "form-group" id = "imagediv">
                                <label for="file" class="d-block">Upload Image</label>
                                <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event);" class="form-control-file" style= "display: none;">
                            </div>
                            <div class="form-group">
                                <img id="output" width="200" height= "200px" class="img-thumbnail" src = "<?php echo $newsdetails[0]['image']; ?> "/>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id = "submitform" class="btn btn-primary">Update Article</button>
                </form>
            </div>
        </div>


    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        // Function to trigger a click event on the hidden file input

        function triggerFileInput() {
            document.getElementById('file').click();
        }

        autocomplete("")
    </script>

</body>
</html>

<?php
}else{
    header("Location: adminlogout.php");
}
?>