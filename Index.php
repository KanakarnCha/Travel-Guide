<!DOCTYPE html>
<html lang="en">
<?php
require 'ConnectDatabase.php';
?>

<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    ?>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="Index.php">Travel Guide</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center " id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="TopTenPage.php">Top 10 Best</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AdminPage.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    $sql = "SELECT * FROM place_travel";
    $data = $conn->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_DEFAULT);
    ?>
    <div class="container text-center " style="margin-top: 20px;">
        <div class="row row-cols-2 row-cols-md-4 g-4">
            <?php foreach ($result as $row) { ?>
                <div class="col">
                    <div class="card h-100">
                        <img src=<?php echo $row["picture"] ?> class="card-img-top" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["name"] ?></h5>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $row["id"] ?>">Info</button>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop<?php echo $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"><?php echo $row["name"] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="card-text"><?php echo $row["title"] ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal close -->
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><?php echo "address " . $row["address"] ?></small>
                        </div>
                    </div>
                </div>

            <?php }
            ?>
        </div>
    </div>
</body>

</html>