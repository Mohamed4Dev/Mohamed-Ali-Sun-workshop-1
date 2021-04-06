<?php
require_once('inc/db-connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo $id;

    $query = "SELECT img FROM projects WHERE id=$id";
    $run_query = (mysqli_query($conn, $query));
    $result = mysqli_fetch_assoc(($run_query));
    $imgName = $result['img'];
    // echo $imgName;
    $fileToDelete = "images/$imgName";
    unlink($fileToDelete);


    $query = "DELETE FROM projects WHERE id=$id";
    $run_query = (mysqli_query($conn, $query));


    header("location: index.php");
}
