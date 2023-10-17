<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>NewsWebsite Login</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">NewsWebsite Login</div>
                    <div class="card-body">
                        <form action="checkuser.php" method="POST">
                            <?php if(isset($_GET['error'])){?>
                                <p><?php echo $_GET['error'];?></p>
                            <?php } ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <?php if(isset($_GET['newsid'])){?>
                            <input type="hidden" name = "newsid" value = "<?php echo $_GET['newsid']; ?>">
                        <?php } ?>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <?php if(isset($_GET['newsid'])){?>
                            <p>Don't have an account yet? <a href = "signup.php?newsid=<?php echo $_GET['newsid']; ?>">Sign up</a></p>    
                        <?php }else{ ?>
                            <p>Don't have an account yet? <a href = "signup.php">Sign up</a></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
