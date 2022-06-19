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
        <?php include "header.php" ?>
    </header>

    <?php 

        $dbc = mysqli_connect('localhost', 'root','','projectdb') or die ('Error connecting to MySQL server.' . mysqli_connect_error());
        $query = "SELECT * FROM articles WHERE id = " . $_GET['id'];
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result)
    ?>

    <div class="titleDate">
        <div class="dateBox"><p><?php echo $row['date']; ?></p></div>

        <h2 class="articleTitle"><?php echo $row['title'];?></h2>
    </div>
    <h3 class="articlePreviewArticle"><?php echo $row['preview']; ?></h3>
    <div class="articleImageBox">
        <img src="<?php echo "/pwa/articleImg/" . $row['image'];?>" alt="" class="articleImage">
    </div>

    <p class="articleText">
        <?php echo $row['text'];?>
    </p>

    <footer>
        <?php include "./footer.php" ?>
    </footer>
</body>
</html>