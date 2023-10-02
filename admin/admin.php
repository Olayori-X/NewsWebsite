<?php
session_start();
include "connect.php";

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];

  $users = "SELECT username FROM adminusers";
  $usersquery = mysqli_query($connect, $users);

  if($usersquery){
    $usernames = [];
    while($row = mysqli_fetch_assoc($usersquery)){
        $usernames[] = $row['username'];
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
                <form id = "newsForm" method = "post" action = "insertarticle.php">
                    <div class="form-group">
                        <label for="articleTitle">Title</label>
                        <input type="text" class="form-control" id="articleTitle" name = "title" placeholder="Enter title" required>
                    </div>
                    <div class="form-group">
                        <label for="articleContent">Content</label>
                        <textarea class="form-control" id="articleContent"rows="5" name = "content" placeholder="Enter article content" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name = "category" onchange = "showinput()" required>
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
                        <input type="text" class="form-control" name = "others" id="othercategory" placeholder="Enter Custom Category">
                    </div>

                    <div class="form-group">
                    <label for="reporter">Reporter</label>
                    <input class = "form-control" type = "text" id = "reporter" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control" id="searchreporter" name = "reporter" placeholder="If none, Input 'Nil'">
                    </div>

                    <div class = "card-mt-8">
                        <div class = "card-body">
                            <h5 class = "card-title">Featured image</h5>
                            <div class = "form-group" id = "imagediv">
                                <label for="file" class="d-block">Upload Image</label>
                                <input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event);" class="form-control-file" style= "display: none;">
                            </div>
                            <div class="form-group">
                                <img id="output" width="200" height= "200px" class="img-thumbnail"/>
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

        function autocomplete(input, list) {

            //Add an event listener to compare the input value with all countries
            input.addEventListener('input', function () {
                //Close the existing list if it is open
                closeList();
                //searchInput();

                //If the input is empty, exit the function
                if (!this.value)
                    return;

                //Create a suggestions <div> and add it to the element containing the input field
                suggestions = document.createElement('div');
                suggestions.setAttribute('id', 'suggestions');
                this.parentNode.appendChild(suggestions);

                //Iterate through all entries in the list and find matches
                for (let j=0; j < list.length; j++) {

                    if (list[j].toUpperCase().includes(this.value.toUpperCase())) {

                        //If a match is found, create a suggestion <div> and add it to the suggestions <div>
                        suggestion = document.createElement('div');
                        suggestion.innerHTML = list[j];
                        
                        suggestion.addEventListener('click', function () {
                            input.value = this.innerHTML;
                            closeList();
                        });
                        suggestion.style.cursor = 'pointer';
                        

                        suggestions.appendChild(suggestion);
                    }
                        
                }

            });

            function closeList() {
                let suggestions = document.getElementById('suggestions');
                if (suggestions)
                    suggestions.parentNode.removeChild(suggestions);
            }

        }

        function showusers(input, list) {

            //Add an event listener to compare the input value with all countries
            input.addEventListener('click', function () {
                closeLists();

                //Create a suggestions <div> and add it to the element containing the input field
                userdiv = document.createElement('div');
                userdiv.setAttribute('id', 'userdiv');
                this.parentNode.appendChild(userdiv);

                //Iterate through all entries in the list and find matches
                for (let j=0; j < list.length; j++) {
                    usersbtn = document.createElement('div');
                    usersbtn.innerHTML = list[j];
                    
                    usersbtn.addEventListener('click', function () {
                        input.value = this.innerHTML;
                        closeLists();
                    });
                    usersbtn.style.cursor = 'pointer';
                    

                    userdiv.appendChild(usersbtn);
                    
                }

            });

            function closeLists() {
                let users = document.getElementById('userdiv');
                if (users)
                    userss.parentNode.removeChild(users);
            }

        }

        showusers(document.getElementById("reporter"), usernames)
        autocomplete(document.getElementById("reporter"), usernames);
    </script>


</body>
</html>
<?php
}else{
    header("Location: adminlogout.php");
}
?>