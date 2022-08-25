<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
        if(isset($_POST['submit'])){
            echo $_POST['submit'];
        }
    ?>
    </script>
    <form action="" method="post">

        <button type="submit" name="submit" value="submit" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');">test</button>
    </form>
    <div class="container col-md-6">
            <div class="mb-5">
                <label for="Image" class="form-label">Bootstrap 5 image Upload with Preview</label>
                <input class="form-control" type="file" id="formFile" onchange="preview()">
                <button onclick="clearImage()" class="btn btn-primary mt-3">Click me</button>
            </div>
            <img id="frame" src="" class="img-fluid" />
        </div>

        <script>
            function preview() {
                frame.src = URL.createObjectURL(event.target.files[0]);
            }
            function clearImage() {
                document.getElementById('formFile').value = null;
                frame.src = "";
            }
        </script>
</body>

</html>