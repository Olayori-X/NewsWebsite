<?php
//This is a page to edit a particular article that had been posted. It gets that article from the database, and displays the details that can be changed by the user.
include "connect.php";
include "validate.php";
include "category.php";

if(isset($_GET['id'])){
    $id = validate($_GET['id']);

    $getarticledetails = "SELECT * FROM articletable WHERE id = '$id'";
    $querydetails = mysqli_query($connect, $getarticledetails);

    if($querydetails){
        $newsdetails = [];
        while($row = mysqli_fetch_assoc($querydetails)){
            $newsdetails[] = $row;
        }
    }

    $users = "SELECT reporter FROM reporters";
    $usersquery = mysqli_query($connect, $users);

    if($usersquery){
        $usernames = [];
        while($row = mysqli_fetch_assoc($usersquery)){
            $usernames[] = $row['reporter'];
        }
    }
    include "time.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post "<?php echo $newsdetails[0]['title']; ?>"</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src = "newpostjs.js"></script>
</head>

<body>
    <?php include 'UItrial.php'; ?>

    <div class="container mt-5">
        <div class = "row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
                    <form id = "newsForm" method = "post" action = "updatearticle.php" enctype="multipart/form-data">
                        <input type = "hidden" value = "<?php echo $id; ?>" name = "id">
                        <div class="form-group">
                            <label for="articleTitle">Title</label>
                            <input type="text" class="form-control" id="articleTitle" name = "title" placeholder="Enter title" value = "<?php echo $newsdetails[0]['title'];?>" required>
                        </div>

                        <div class="form-group">
                            <label for="articleSubTitle">Subtitle</label>
                            <input type="text" class="form-control" id="articleSubTitle" name = "subtitle" placeholder="Enter subtitle" value = "<?php echo $newsdetails[0]['subtitle'];?>" required>
                        </div>

                        <div class="form-group">
                            <label for="articleContent">Content</label>
                            <textarea class="form-control" id="articleContent" rows="11" name = "content" placeholder="Enter article content" required><?php echo $newsdetails[0]['content'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id = "category" name = "category" onchange = "showinput(); changecategory()">
                            </select>
                        </div>

                        <div class="form-group" id = "othercategorydiv" style= "display:none;">
                            <label for="othercategory">Input Custom Category</label>
                            <input type="text" class="form-control" name = "others" id="othercategory" placeholder="Enter Custom Category" onblur = "changecategory()">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="existingcategory" value = "<?php echo($newsdetails[0]['category']);?>" readonly>
                            <input type ="hidden" name = "submitcategory" id = "submitcategory" value = "<?php echo($newsdetails[0]['category']);?>" >
                        </div>

                        <div class="form-group">
                            <label for="reporter">Reporter</label>
                            <input class = "form-control" type = "text" id = "reporter" onclick= "toggleDiv('reporterDiv')" value = "<?php echo($newsdetails[0]['reporter']);?>" readonly required>
                            <div class= "" id = "reporterDiv" style = "display: none;">
                                <input class = "form-control" type = "text" id = "searchreporter" placeholder= "Author" width= "70%">
                                <input type ="hidden" name = "reporter" id = "submittedreporter" value = "<?php echo($newsdetails[0]['reporter']);?>">
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
                                    <img id="output" width="200" height= "200px" class="img-thumbnail" src = "uploads/<?php echo $newsdetails[0]['image']; ?> "/>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id = "submitform" class="btn btn-primary">Update Article</button>
                    </form>
                </div>
            </div>
        </main>
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

        var usernames = <?php echo json_encode($usernames); ?>;
        var category = <?php echo json_encode($categories); ?>;
        
        var option = "<option>Select Category</option>";
        for(var i = 0; i < category.length; i++){
            option += "<option>" + category[i] + "</option>";
        }
        option += "<option>Others</option>";
        document.getElementById('category').innerHTML = option;

        // showusers(document.getElementById("reporter"), usernames)
        autocomplete(document.getElementById("searchreporter"), usernames, document.getElementById('submittedreporter'));
    </script>

</body>
</html>

<?php
}else{
    header("Location: adminlogout.php");
}
?>