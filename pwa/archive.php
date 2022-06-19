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
    
    <hr>
    <?php
        if(isset($_SESSION['access'])){
            if ($_SESSION['access'] == 0){
                header('Location: ./admin.php');
            }
        } else {
            header('Location: ./admin.php');
        }

        $dbc = mysqli_connect('localhost', 'root','','projectdb') or die ('Error connecting to MySQL server.' . mysqli_connect_error());
        $query = "SELECT * FROM articles";
        $result = mysqli_query($dbc, $query);

        
        while($row = mysqli_fetch_array($result)) {
            $arch = $row["archive"] ? 'archived' : 'active';
            echo '
                <div class="archiveDiv">
                    <p class="archiveTitle">' . $row["title"] . ' </p>
                    <img src="/pwa/articleImg/'. $row["image"]. '" class="archiveImg">
                    <p class="archiveCategory">'. $row["category"] .'</p>
                    <p class="' . $arch . '" >' . $arch . '</p>
                    <form method="POST" action="/pwa/admin.php"><input type="text" name="toEdit" class="sneaky" value="' . $row["id"] . '"></input><input type="submit" class="archiveButton" value="Edit"></submit></form>
                    <form method="POST" action="/pwa/deleteArticle.php"><input type="text" name="toEdit" class="sneaky" value="' . $row["id"] . '"></input><input type="submit" class="archiveBut" value="Delete"></submit></form>
                    </div>
                <hr>
                '; 
        }

        mysqli_close($dbc);
    ?>

    <footer>
        <?php include "./footer.php" ?>
    </footer>
</body>
</html>