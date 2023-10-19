<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collapsible Sidebar Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
            background-color: #333;
            padding-top: 20px;
            width: 15%;
        }

        .sidebar a {
            padding: 15px;
            text-align: center;
            text-decoration: none;
            font-size: 20px;
            color: #fff;
            display: block;
        }

        .content {
            margin-left: 250px;
            transition: margin-left 0.3s;
        }

        #backbtn, #displaybtn {
            display: none;
        }

        @media (max-width: 767px) {
            .sidebar {
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1;
                background-color: #333;
                padding-top: 20px;
                width: 50%;
                display: none;
            }

            .content {
                margin-left: 0;
            }

            .sidebar.show + .content {
                margin-left: 0;
            }

            #backbtn, #displaybtn {
            display: block;
            }
        }
    </style>
</head>
<body>

    <nav id="mySidebar" class="sidebar">
        <button onclick="toggleSidebar()" id = "backbtn"><i class="fas fa-arrow-left"></i></button>
        <a class="nav-link" href="index.php">Dashboard</a>
        <a class="nav-link" href="newpost.php">Post new article</a>
        <a class="nav-link" href="articles.php">Articles</a>
        <a class="nav-link" href="categories.php">Categories</a>
        <a class="nav-link" href="reporters.php">Users</a>
        <a class="nav-link" href="adminlogout.php">Logout</a>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button onclick="toggleSidebar()" id = "displaybtn"><i class="fas fa-ellipsis-h fa-2x"></i></button>
        <a class="navbar-brand mx-auto" href="#">Admin Panel</a>
    </nav>

    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mySidebar');
            const content = document.getElementById('content');
            if(sidebar.style.display == "none"){
                sidebar.style.display = "block";
            }else{
                sidebar.style.display = "none";
            }
        }
    </script>
</body>
</html>
