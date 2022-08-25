<!DOCTYPE html>
<html lang="en">
<?php
require 'ConnectDatabase.php'
?>
<?php
session_start();
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


<body>
    <?php
    if (isset($_POST['login'])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $stmt = $conn->prepare("SELECT * FROM `admin` WHERE email = :email AND password_ = :password_");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($user["email"])) {
            $_SESSION['username'] = $user['username'];
            
            header( "Location: AdminPage.php" );
        } else { ?>
            <div class="alert alert-danger" role="alert">
                Email OR Password Incorrect
            </div>
            <?php $sec = "1";
            header("Refresh: $sec; url=LoginPage.php"); ?>
    <?php
        }
    }
    if(isset($_SESSION['username'])){
        header( "Location: AdminPage.php" );
    }
    ?>

    <!-- Default form subscription -->
    <div class="container" style="width: 50%;">
        <form class="text-center border border-light p-5" method="post" action="LoginPage.php">
            <p class="h4 mb-4">Login Admin</p>
            <p>TOOL ADMIN</p>
            <!-- Email -->
            <input type="email" name="email" class="form-control mb-4" placeholder="E-mail" required>
            <!-- Name -->
            <input type="password" name="password" class="form-control mb-4" placeholder="Password" required>
            <!-- Sign in button -->
            <button class="btn btn-info btn-block" type="submit" name="login" value="login">Sign in</button>
        </form>
    </div>

</body>

</html>