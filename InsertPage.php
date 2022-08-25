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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
<?php
$target_dir = "Image/";
if (isset($_POST['submit1'])) {
    $name = $_POST["name"];
    $title = $_POST["title"];
    $address = "test";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType == "jpg") {
        echo $name . $title . $imageFileType;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "INSERT INTO `place_travel` VALUES (:id,:name, :title, :picture, :address)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => null,
            ':name' => $name,
            ':title' => $title,
            ':picture' => $target_file,
            ':address' => $address,
        ]);
    }
}
?>
<?php
$target_dir = "Image/";
if (isset($_POST['submit2'])) {
    $name = $_POST["name"];
    $title = $_POST["title"];
    $address = "test";
    $time_update = "";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType == "jpg") {
        echo $name . $title . $imageFileType;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $sql = "INSERT INTO `top_ten_best` VALUES (:id,:name, :title, :picture, :address,:time_update)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => null,
            ':name' => $name,
            ':title' => $title,
            ':picture' => $target_file,
            ':address' => $address,
            ':time_update' => ''
        ]);
    }
}
?>
<script>
    function preview1() {
        frame1.src = URL.createObjectURL(event.target.files[0]);
    }
    function preview2() {
        frame2.src = URL.createObjectURL(event.target.files[0]);
    }

</script>

<body>

    <div class="d-flex">
        <div class="border border-primary">
            <ul class="nav d-flex flex-column " style="margin-top: 50px;">
                <li class="nav-item"><button class="nav-link w-100 btn btn-light" onclick="location.href='AdminPage.php';">Manager</button></li>
                <li class="nav-item"><button class="nav-link w-100 btn btn-light active" onclick="location.href='InsertPage.php';">Insert</button></li>
                <form action="" method="POST">
                    <li class="nav-item "><button class="nav-link w-100 btn btn-light" name="signout" value="signout">signout</button></li>
                </form>
            </ul>
        </div>


        <div class="p-2" style="margin-left: 20%;">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="inone-tab" data-bs-toggle="tab" data-bs-target="#insert-tab-one" type="button" role="tab" aria-controls="in-tab-pane" aria-selected="true">Insert Main</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-two" type="button" role="tab" aria-controls="intwo-tab-pane" aria-selected="false">Insert TOP Best</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="insert-tab-one" role="tabpanel" aria-labelledby="inone-tab" tabindex="0">

                    <h1 class="text-center">InsertData</h1>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="InputName" class="form-label">Name</label>
                            <input type="Text" class="form-control" id="InputName" aria-describedby="NameHelp" name="name" id="name" required>
                            <div id="NameHelp" class="form-text">กรอกชื่อสถานที่ท่องเที่ยว</div>
                        </div>
                        <div class="mb-3">
                            <label for="FormControlTitle" class="form-label">Discript</label>
                            <textarea class="form-control" id="FormControlTitle" rows="3" name="title" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Image" class="form-label">image Upload with Preview</label>
                                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" onchange="preview1()" required>
                            </div>
                            <img id="frame1" src="" class="img-fluid" />
                        </div>
                        <button type="submit" value="submit1" name="submit1" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile-tab-two" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                    <h1 class="text-center">Insert Data Best</h1>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="InputName" class="form-label">Name</label>
                            <input type="Text" class="form-control" id="InputName" aria-describedby="NameHelp" name="name" id="name" required>
                            <div id="NameHelp" class="form-text">กรอกชื่อสถานที่ท่องเที่ยว</div>
                        </div>
                        <div class="mb-3">
                            <label for="FormControlTitle" class="form-label">Discript</label>
                            <textarea class="form-control" id="FormControlTitle" rows="3" name="title" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Image" class="form-label">image Upload with Preview</label>
                                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" onchange="preview2()" required>
                            </div>
                            <img id="frame2" src="" class="img-fluid" />
                        </div>
                        <button type="submit" value="submit2" name="submit2" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>