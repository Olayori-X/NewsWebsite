<?php include "category.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Website Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src = "categories.js"></script>
</head>
<body>
    
<?php include 'UItrial.php'; ?>

<div class="container mt-5">
        <div class = "row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
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
                            <h5 class="card-title">Categories</h5>
                            <p class="card-text">Manage article categories.</p>
                            <a href="categories.php" class="btn btn-primary">Go to Categories</a>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h5 class="card-title">Authors</h5>
                <div class = "card-body" id = "reporters"></div>
            </div>
        </main>
    </div>
</div>

    <script>
        var reporterarray = <?php echo json_encode($usernames); ?>;

        listreporter(reporterarray);
    </script>
</body>
</html>