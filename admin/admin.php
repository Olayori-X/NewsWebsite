<?php
session_start();
include "connect.php";
include "category.php";

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];

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
    <script src = "admin.js"></script>
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
                <form id = "newsForm" method = "post" action = "insertarticle.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="articleTitle">Title</label>
                        <input type="text" class="form-control" id="articleTitle" name = "title" placeholder="Enter title" required>
                    </div>

                    <div class="form-group">
                        <label for="articleSubTitle">Subtitle</label>
                        <input type="text" class="form-control" id="articleSubTitle" name = "subtitle" placeholder="Enter subtitle" required>
                    </div>

                    <div class="form-group">
                        <label for="articleContent">Content</label>
                        <textarea class="form-control" id="articleContent"rows="5" name = "content" placeholder="Enter article content" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name = "category" oninput = "showinput(); changecategory()" required>
                        </select>
                    </div>

                    <div class="form-group" id = "othercategorydiv" style= "display:none;">
                        <label for="othercategory">Input Custom Category</label>
                        <input type="text" class="form-control" name = "others" id="othercategory" placeholder="Enter Custom Category" onblur = "changecategory()">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="existingcategory" name = "submitcategory" readonly>
                    </div>

                    <div class="form-group">
                        <label for="reporter">Reporter</label>
                        <input class = "form-control" type = "text" id = "reporter" name = "reporter" onclick= "toggleDiv('reporterDiv')" readonly required>
                        <div class= "" id = "reporterDiv" style = "display: none;">
                            <input class = "form-control" type = "text" id = "searchreporter" placeholder= "Author" width= "70%">
                        </div>
                    </div>

                    <button class = "btn btn-transparent text-success" type = "button" id = "guestbtn" onclick = "toggleDiv('addguest')"> Add new guest</button>

                    <div class = "form-group card mt-2" id = "addguest" style = "display:none">
                        <div class = "card-body" style= "text-align: center">
                            <label for = "guest" >Add New Guest</label>
                            <button class = "btn btn-transparent text-danger" type = "button" onclick = "toggleDiv('addguest')" style= "float: right"><i class="fas fa-times"></i></button>
                            <input class = "form-control" type = "text" id = "guest"><br>
                            <button type="button" onclick = "addGuest()" id = "submitform" class="btn btn-success mx-auto d-block">Add New Guest</button>
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
                                <img id="output" width="300" height= "300px" class="img-thumbnail"/>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id = "submitform" class="btn btn-primary">Publish Article</button>
                </form>
            </div>
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
    </script>

    <script>
        var usernames = <?php echo json_encode($usernames); ?>;
        var category = <?php echo json_encode($categories); ?>;
        
        var option = "<option>Select Category</option>";
        for(var i = 0; i < category.length; i++){
            option += "<option>" + category[i] + "</option>";
        }
        option += "<option>Others</option>";
        document.getElementById('category').innerHTML = option;

        // showusers(document.getElementById("reporter"), usernames)
        autocomplete(document.getElementById("searchreporter"), usernames);
    </script>


</body>
</html>
<?php
}else{
    header("Location: adminlogout.php");
}
?>