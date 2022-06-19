<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Stern</title>
</head>
<body>
    <header>
        <?php include "./header.php" ?>
    </header>

    <?php
        if(isset($_SESSION['access'])){
            if ($_SESSION['access'] == 1){
                include "./form.php";
            }
        } else {
            include "./login.php";
        }
    ?>

    <footer>
        <?php include "./footer.php" ?>
    </footer>
</body>
</html>