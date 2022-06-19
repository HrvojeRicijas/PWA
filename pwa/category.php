<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/pwa/style.css">
    <title>Stern</title>
</head>
<body>
    <header>
        <?php include "./header.php" ?>
    </header>

    <div class="articles">

        <?php 
            $dbc = mysqli_connect('localhost', 'root','','projectdb') or die ('Error connecting to MySQL server.' . mysqli_connect_error());
            $query = "SELECT * FROM articles WHERE archive=0 AND category='". $_GET['category'] ."'";
            $result = mysqli_query($dbc, $query);
            $i = 1;
            while($row = mysqli_fetch_array($result)) {
                
                echo '
                <a href="clanak.php?id='. $row["id"] . '">
                    <article>
                        <img src="/pwa/articleImg/'. $row["image"]. '" class="articleImage">
                        <p class="articleCategory">'. $row["category"] .'</p>
                        <h3 class="articlePreview">'. $row["preview"] . '</h3>
                    </article>
                </a>'; 

                if ($i%3 == 0){
                    echo '</div> <div class="articles">';
                }
                $i++;
            }
            mysqli_close($dbc);
        ?>

    </div>
    <footer>
        <?php include "./footer.php" ?>
    </footer>
</body>
</html>