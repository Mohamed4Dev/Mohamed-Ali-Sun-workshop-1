<?php
session_start();
require_once('inc/db-connection.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    // echo $email . $password;


    $query = "SELECT * FROM users WHERE email='$email'";
    $run_query = (mysqli_query($conn, $query));
    // echo mysqli_num_rows($run_query);
    //validate if email exists?
    if (mysqli_num_rows($run_query) > 0) {
        $user = mysqli_fetch_assoc($run_query);
        print_r($user);
        $isCorrect = password_verify($password, $user['password']);
        if ($isCorrect) {
            $_SESSION['email'] = $email;
            header("location: index.php");
        } else {
            $_SESSION['errors'] = "password is not correct";
            header("location: login.php");
        }
    } else {
        $_SESSION['errors'] = "email not found";
        header("location: login.php");
    }
    // $_SESSION['errors'] = $errors;
    // $projects = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
}
