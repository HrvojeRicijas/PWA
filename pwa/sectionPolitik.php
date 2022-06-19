<section class="politikSection">
        <h2> <a href="category.php?category=politik"> POLITIK > </a></h2>

        <div class="articles">

            <?php 
                $dbc = mysqli_connect('localhost', 'root','','projectdb') or die ('Error connecting to MySQL server.' . mysqli_connect_error());
                $query = "SELECT * FROM articles WHERE archive=0 AND category='politik' LIMIT 3";
                $result = mysqli_query($dbc, $query);
                while($row = mysqli_fetch_array($result)) { 
                    
                    echo '
                    <a href="clanak.php?id='. $row["id"] . '">
                        <article>
                            <img src="/pwa/articleImg/' . $row["image"]. '" class="articleImage">
                            <p class="articleCategory">'. $row["category"] .'</p>
                            <h3 class="articlePreview">'. $row["preview"] . '</h3>
                        </article>
                    </a>'; 
                }
                mysqli_close($dbc);
            ?>
        </div>
    </section>
