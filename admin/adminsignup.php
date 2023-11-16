<!DOCTYPE html>
<html>
<head>
    <title>Admin Sign Up</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src = "adminsignup.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Sign Up</h2>
        <!--This is the php code to get errors from the server -->
        <?php if(isset($_GET['error'])){ ?>
            <p><?php echo $_GET['error'] ?></p>
        <?php } ?>
        <!-- It ends here -->
        <!-- This is the div to show errors derived by the browser -->
        <div id = "error" class = "alert alert-primary" style = "display : none;"></div>
        <form action="admincreateusers.php" method="POST" id = "signupForm">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
            </div>
            <div class="form-group">
                <label for="companyCode">Company Code</label>
                <input type="password" class="form-control" id="companyCode" name="code" onchange = "validateForm()" required>
            </div>
            <button type="submit" id = "submitbtn" class="btn btn-primary" disabled>Sign Up</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery (if needed) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
