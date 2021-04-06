<?php
session_start();

require_once('inc/db-connection.php');
require_once('inc/header.php');

if (!isset($_SESSION['email'])) {
    header("location:index.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo $id;
    $query = "SELECT * FROM projects WHERE id=$id";
    $run_query = (mysqli_query($conn, $query));
    $result = mysqli_fetch_assoc($run_query);
    // print_r($result);
?>
    <div class="container py-5">
        <form action="handle-edit.php?id=<?= $result['id'] ?>" method="post" enctype="multipart/form-data">
            <label class="mt-2">Name* :</label>
            <input class="form-control" value="<?= $result['name'] ?>" name="name" type="text" placeholder="Enter project Name">
            <label class="mt-2">Description* :</label>
            <textarea class="form-control" name="desc" placeholder="Please Enter Description">
        <?= $result['description'] ?>
        </textarea>
            <label class="mt-2">Img *:</label>
            <input type="file" name="file" class="form-control">
            <label class="mt-2">Website-URL :</label>
            <input class="form-control" value="<?= $result['url'] ?>" name="url" type="text" placeholder="Enter webtsite url">
            <label class="mt-2">Repo-URL :</label>
            <input class="form-control" value="<?= $result['repo'] ?>" name="repo" type="text" placeholder="Enter github url">
            <button class="btn btn-success mt-4" type="submit" name="submit">Add</button>
            <a href="index.php" class="btn btn-primary mt-4">back to home</a>
        </form>
    </div>
<?php
} elseif (!isset(($_GET['id']))) {
    $id = $_SESSION['id'];
    // echo $id;
    $query = "SELECT * FROM projects WHERE id=$id";
    $run_query = (mysqli_query($conn, $query));
    $result = mysqli_fetch_assoc($run_query);

?>
    <div class="container py-5">
        <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
        ?>
                <h3 class="text-danger"> *<?php echo "$error <br>"; ?></h3>
        <?php
            }
        }
        ?>
        <form action="handle-edit.php?id=<?= $result['id'] ?>" method="post" enctype="multipart/form-data">
            <label class="mt-2">Name* :</label>
            <input class="form-control" value="<?= $result['name'] ?>" name="name" type="text" placeholder="Enter project Name">
            <label class="mt-2">Description* :</label>
            <textarea class="form-control" name="desc" placeholder="Please Enter Description">
        <?= $result['description'] ?>
        </textarea>
            <label class="mt-2">Img *:</label>
            <input type="file" name="file" class="form-control">
            <label class="mt-2">Website-URL :</label>
            <input class="form-control" value="<?= $result['url'] ?>" name="url" type="text" placeholder="Enter webtsite url">
            <label class="mt-2">Repo-URL :</label>
            <input class="form-control" value="<?= $result['repo'] ?>" name="repo" type="text" placeholder="Enter github url">
            <button class="btn btn-success mt-4" type="submit" name="submit">Add</button>
            <a href="index.php" class="btn btn-primary mt-4">back to home</a>
        </form>
    </div>
<?php
}

unset($_SESSION['errors']);
?>

<?php require_once('inc/footer.php'); ?>