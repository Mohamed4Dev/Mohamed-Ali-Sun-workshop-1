<?php
require_once('inc/db-connection.php');
session_start();
if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    // echo $name;
    // echo strlen($name);
    $desc = htmlspecialchars(trim($_POST['desc']));
    $url = htmlspecialchars(trim($_POST['url']));
    $repo = htmlspecialchars(trim($_POST['repo']));
    $file = $_FILES['file'];
    // print_r($file);
    /*Array ( [name] => 2020-12-31.jpg
    [type] => image/jpeg [tmp_name] => C:\xampp\tmp\php875B.tmp 
    [error] => 0 [size] => 4587 ) */
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    //unique name for file upload
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileNewName = uniqid() . "." . $ext;

    //validation
    $errors = [];
    //validate name
    if (empty($name)) {
        $errors[] = "name is required";
    } elseif (strlen($name) < 5) {
        $errors[] = "name lenght min charachters is 5";
    } elseif (strlen($name) > 255) {
        $errors[] = "name lenght max charachters is 255";
    } elseif (!(is_string($name)) && (is_numeric($name))) {
        $errors[] = "name must be string";
    }
    //validate description
    if (empty($desc)) {
        $errors[] = "description is required";
    } elseif (strlen($desc) < 50) {
        $errors[] = "description lenght min charachters is 50";
    } elseif (strlen($desc) < 50 || strlen($name) > 1000) {
        $errors[] = "description lenght max charachters is 1000";
    }
    //validate file
    if ($fileError > 0) {
        $errors[] = "error uploading file";
    }
    //validate url
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $errors[] = "url not valid";
    }
    //validate repo
    if (!filter_var($repo, FILTER_VALIDATE_URL)) {
        $errors[] = "repo not valid";
    }

    //add data to database
    if (empty($errors)) {
        $query = "INSERT INTO projects (name,description,img,url,repo)
        VALUES ('$name','$desc','$fileNewName','$url','$repo')";
        $run_query = mysqli_query($conn, $query);
        move_uploaded_file($fileTmpName, "images/$fileNewName");
        header("location: index.php");
    } else {
        $_SESSION['errors'] = $errors;
        header("location: addProjectForm.php");
    }
}
