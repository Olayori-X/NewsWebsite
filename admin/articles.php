<?php include 'category.php'; include 'time.php'; ?>
<!DOCTYPE html>
<!-- This is the page to display the fetched articles and the details -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Website Admin Panel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src = "articles.js"></script>
</head>
<body onload="getarticle()">
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
                            <a href="reporters.php" class="btn btn-primary">Go to Users</a>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <form method = "post" action = "">
                    <label for = "category">Category</label>
                    <select id = "category"></select>
                    <label for = "reporter">Reporters</label>
                    <select id = "reporter"></select>
                    <label for = "month">Month</label>
                    <select id = "month">
                        <option>Select</option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>

                    <label for = "year">Year</label>
                    <select id = "year"></select>

                    <button type = "button" onclick = "getselectedarticles()" id = "submit" name = "submit">Filter</button>
                </form>
            </div>

            <div>
                <h5 class="card-title">Articles</h5>
                <div class = "card-body" id = "articles"></div>
            </div>
        </main>
    </div>
</div>

    <script>
        var usernames = <?php echo json_encode($usernames); ?>;
        var category = <?php echo json_encode($categories); ?>;

        get(usernames, document.getElementById('reporter'));
        get(category, document.getElementById('category'));

        var currentyear = '<?php echo $currentYear; ?>';
        var yeardiff = currentyear - 2020;

        var years = [];
        for(var i = 0; i < yeardiff; i++){
            years.push(currentyear);
            currentyear--;
        }


        var yearoptions = '<option>Select</option>';
        for(var i = 0; i < years.length; i++){
            yearoptions += '<option>' + years[i] + '<option>';
        }

        document.getElementById('year').innerHTML = yearoptions;
    </script>
</body>
</html>