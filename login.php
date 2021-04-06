<?php session_start();
if (isset($_SESSION['email'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>


<body>
    <div class="login-form">
        <span class="text-danger">
            <?php
            if (isset($_SESSION['errors'])) {
                echo '* ' . ($_SESSION['errors']);
            }
            ?>
        </span>
        <form action="handle-login.php" method="post">
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Log
                    in</button>
            </div>
        </form>
    </div>

    <?php
    unset($_SESSION['errors']);
    require_once('inc/footer.php');
    ?>