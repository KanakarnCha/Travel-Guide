<!DOCTYPE html>
<html lang="en">
<?php
require 'ConnectDatabase.php';
session_start();
?>
<?php
if (!isset($_SESSION['username'])) {
    header("Location: LoginPage.php");
}
?>

<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">
    <script type="text/javascript" src="node_modules/mdbootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/mdb.min.js"></script>
    <title>Document</title>
</head>

<?php
if (isset($_POST["signout"])) {
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    header("Location: Index.php");
    die();
}
?>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        text-align: center;
        padding: 10px;

    }
</style>
<?php

if (isset($_POST['deleteTop'])) {
    $id = $_POST["deleteTop"];
    $sql = "DELETE FROM `top_ten_best` WHERE id = :id";
    $data = $conn->prepare($sql);
    $data->execute([
        'id' => $id
    ]);
}
if (isset($_POST['deleteMain'])) {
    $id = $_POST["deleteMain"];
    $sql = "DELETE FROM `place_travel` WHERE id = :id";
    $data = $conn->prepare($sql);
    $data->execute([
        'id' => $id
    ]);
}
?>

<?php
$target_dir = "Image/";
if (isset($_POST['submit1'])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $title = $_POST["title"];
    $address = "test";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType == "jpg") {
        echo $name . $title . $imageFileType;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "UPDATE `place_travel` SET  name = :name,title = :title, picture = :picture, address = :address WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':title' => $title,
            ':picture' => $target_file,
            ':address' => $address,
            ':id' => $id
        ]);
    }
}
if (isset($_POST['submit2'])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $title = $_POST["title"];
    $address = "test";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType == "jpg") {
        echo $name . $title . $imageFileType;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "UPDATE `top_ten_best` SET  name = :name,title = :title, image = :image, address = :address WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':title' => $title,
            ':image' => $target_file,
            ':address' => $address,
            ':id' => $id
        ]);
    }
}
?>

<body>
    <div class="d-flex">
        <div class="border border-primary">
            <ul class="nav d-flex flex-column " style="margin-top: 50px;">
                <li class="nav-item"><button class="nav-link w-100 btn btn-light active" onclick="location.href='AdminPage.php';">Manager</button></li>
                <li class="nav-item"><button class="nav-link w-100 btn btn-light " onclick="location.href='InsertPage.php';">Insert</button></li>
                <form action="" method="POST">
                    <li class="nav-item "><button class="nav-link w-100 btn btn-light" name="signout" value="signout">signout</button></li>
                </form>
            </ul>
        </div>
        <div style="display: flex-inline; flex-direction: column; margin-left:10px;">
            <div class="p-2" style="margin-left: 20%;margin:auto;">
                <h2 style="text-align: center;">Hoam Travel</h2>

                <table style="width:100%;">
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Title</td>
                        <td>Image</td>
                        <td>Address</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM place_travel";
                    $data = $conn->prepare($sql);
                    $data->execute();
                    $result = $data->fetchAll(PDO::FETCH_DEFAULT);
                    ?>
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><img src="<?php echo $row['picture'] ?>" alt="" srcset="" width="100px" height="50px"></td>
                            <td><?php echo $row['address'] ?></td>

                            <td><button type="submit" name="edit" value="edit" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#EditModalMain<?php echo $row['id']; ?>" data-bs-whatever=<?php echo $row['id']; ?>>Edit</button></td>
                            <form method="POST">
                                <td><button type="submit" name="deleteMain" value="<?php echo $row['id']; ?>" class="btn btn-outline-danger" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');">Delete</button></td>
                            </form>
                        </tr>
                        <div class="modal fade" id="EditModalMain<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="Label"><?php echo 'เเก้ไขข้อมูลในไอดีที่' . $row['id']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="recipient-ID" class="col-form-label">ID:</label>
                                                <input type="text" class="form-control" id="recipient-ID" name="id" value="<?php echo $row['id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="name" value="<?php echo $row['name']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="Discript-text" class="col-form-label">Discript:</label>
                                                <textarea class="form-control" id="Discript-text" name="title" 
                                                value = "test"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Image" class="form-label">image Upload with Preview</label>
                                                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" class="btn btn-primary" value="submit1" name="submit1">Edit</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php }; ?>
                </table>
            </div>
            <div class="p-2" style="margin-left: 20%;margin:auto;">
                <h2 style="text-align: center;">Top 10 Travel</h2>

                <table style="width:100%;">
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Title</td>
                        <td>Image</td>
                        <td>Address</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM top_ten_best";
                    $data = $conn->prepare($sql);
                    $data->execute();
                    $result = $data->fetchAll(PDO::FETCH_DEFAULT);
                    ?>
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['title'] ?></td>
                            <td><img src="<?php echo $row['image'] ?>" alt="" srcset="" width="100px" height="50px"></td>
                            <td><?php echo $row['address'] ?></td>

                            <td><button type="submit" name="edit" value="edit" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#EditModalTop<?php echo $row['id']; ?>" data-bs-whatever=<?php echo $row['id']; ?>>Edit</button></td>
                            <form action="" method="POST">
                                <td><button type="submit" name="deleteTop" value="<?php echo $row['id']; ?>" class="btn btn-outline-danger" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');">Delete</button></td>
                            </form>
                        </tr>
                        <div class="modal fade" id="EditModalTop<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="Label"><?php echo 'เเก้ไขข้อมูลในไอดีที่' . $row['id']; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="recipient-ID" class="col-form-label">ID:</label>
                                                <input type="text" class="form-control" id="recipient-ID" name="id" value="<?php echo $row['id']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="name" value="<?php echo $row['name']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="Discript-text" class="col-form-label">Discript:</label>
                                                <textarea class="form-control" id="Discript-text" name="title" 
                                                value = "test"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Image" class="form-label">image Upload with Preview</label>
                                                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="Submit" class="btn btn-primary" value="submit2" name="submit2">Edit</button>
                                            </div>

                                        </form>
                                    </div>
                    <?php }; ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>