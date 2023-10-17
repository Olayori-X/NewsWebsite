<?php include 'admin/category.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Website</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="styles.css"> Your custom styles here -->
    <script src = "indexjs.js"></script>
</head>
<body onload = "getarticle()">
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

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <!-- News Articles -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Headline News</h5>
                        <!-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                        <a href="#" class="btn btn-primary">Read More</a> -->
                        <div id = "headlinelists"></div>
                    </div>
                </div>
                <!-- More News Articles -->
                <!-- Add more cards for other articles here -->
            </div>

            <div class="col-md-4">
                <!-- News Articles -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Recent News</h5>
                        <!-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                        <a href="#" class="btn btn-primary">Read More</a> -->
                        <div id = "recentnews"></div>
                    </div>
                </div>
                <!-- More News Articles -->
                <!-- Add more cards for other articles here -->
            </div>

            <div class="col-md-4">
                <!-- Sidebar -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sidebar</h5>
                        <ul class="list-group" id = "categorylist">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3">
        &copy; 2023 NewsSite. All rights reserved.
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var category = <?php echo json_encode($categories); ?>;
        get(category, document.getElementById('categorylist'));
    </script>
</body>
</html>
