<?php
session_start();
require_once('inc/db-connection.php');
require_once('inc/header.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo $id;
} elseif (!isset($_GET['id'])) {
    //redirect to index.php
    header("location: index.php");
}

$query = "SELECT * FROM projects WHERE id='$id'";
$run_query = (mysqli_query($conn, $query));
$projects = mysqli_fetch_assoc($run_query);

// print_r($projects);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <img class="img-fluid" src="images/<?= $projects['img'] ?>" alt="image">
            <h1><?= $projects['name'] ?></h1>
            <p><?= $projects['description'] ?></p>
        </div>
    </div>
</div>

<?php require_once('inc/footer.php'); ?>