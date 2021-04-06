<?php
session_start();
// session_destroy();
require_once('inc/db-connection.php');
require_once('inc/header.php');

$query = "SELECT * FROM projects";
$run_query = (mysqli_query($conn, $query));
$projects = mysqli_fetch_all($run_query, MYSQLI_ASSOC);
// print_r($projects);
?>
<?php if (!isset($_SESSION['email'])) { ?>
    <a class="btn btn-primary m-3" href="login.php">Log in</a>
<?php } ?>
<?php if (isset($_SESSION['email'])) { ?>
    <a class="btn btn-primary m-3" href="addProjectForm.php">Add Projrct</a>
<?php } ?>
<?php if (isset($_SESSION['email'])) { ?>
    <a class="btn btn-danger m-3" href="logout.php">Log out</a>
<?php } ?>
<div class="container mt-5">
    <div class="row py-5">
        <?php foreach ($projects as $project) { ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img class="img-fluid" src="images/<?= $project['img'] ?>" alt="image">
                <h1><?= $project['name'] ?></h1>
                <a class="btn btn-primary" href="showproject.php?id=<?= $project['id'] ?>">View details</a>
                <?php if (isset($_SESSION['email'])) { ?>
                    <a class="btn btn-success" href="edit.php?id=<?= $project['id'] ?>">Edit</a>
                    <a class="btn btn-danger" href="delete.php?id=<?= $project['id'] ?>">Delete</a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
<?php require_once('inc/footer.php'); ?>