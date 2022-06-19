<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

    <?php

        $title = "";
        $preview = "";
        $text = "";
        $category = "";
        $image = "";
        $archive = "";
        $updating = FALSE;

        if(isset($_POST['toEdit'])){
            $dbc = mysqli_connect('localhost', 'root','','projectdb') or die ('Error connecting to MySQL server.' . mysqli_connect_error());


            $query = "SELECT * FROM articles WHERE id = " . $_POST['toEdit'];
            $result = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result);

            $updating = TRUE;

            $title = $row['title'];
            $preview = $row['preview'];
            $text = $row['text'];
            $category = $row['category'];
            $image = $row['image'];
            $archive = $row['archive'];
        }
    ?>
    
    <form enctype="multipart/form-data" action="insert.php"
        method="POST">
        <div class="form-item">
            <span id="porukaTitle" class="bojaPoruke"></span>
            <label for="title">Naslov</label> 
            <div class="form-field">
                <input type="text" name="title" id="title" class="formfield-textual" value="<?php echo $title ?>" >
            </div>
        </div>

        <div class="form-item">
            <span id="porukaAbout" class="bojaPoruke"></span>
            <label for="about">Kratki sadržaj</label>
            <div class="form-field">
                <textarea name="about" id="about" cols="30" rows="10" class="form-field-textual"><?php echo $preview ?></textarea>
            </div>
        </div>

        <div class="form-item">
            <span id="porukaContent" class="bojaPoruke"></span>
            <label for="content">Sadržaj vijesti</label>
            <div class="form-field">
                <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"><?php echo $text ?></textarea>
            </div>
        </div>

        <div class="form-item">
            <span id="porukaSlika" class="bojaPoruke"></span>
            <label for="pphoto">Slika: </label> 
            <?php echo'<img src="/pwa/articleImg/' . $image. '?>" alt="">'; ?>
            <div class="form-field">
                <input type="file" class="input-text" id="pphoto" name="pphoto"/>
            </div>
        </div>

        <div class="form-item">
            <span id="porukaKategorija" class="bojaPoruke"></span>
            <label for="category">Kategorija vijesti</label>
            <div class="form-field">
            <select name="category" id="category" class="form-fieldtextual">
            <option value="" disabled <?php if($updating==FALSE){echo "selected";}?> >Odabir kategorije</option>
            <option value="politik">Politika</option>
            <option value="gesundheit">Zdravlje</option>
            </select>
            </div>
        </div>
        <div class="form-item-checkbox">
            <label>Spremiti u arhivu:
            <div class="form-field">
                <input type="checkbox" name="archive" id="archive" <?php if($updating==TRUE and $archive){echo 'checked';}?>>
            </div>
            </label>
        </div>

        <?php
            if(isset($_POST['toEdit'])){
                echo '<input type="text" name="toEdit" class="sneaky" value="' . $row["id"] . '"></input>';
            }
        ?>

        <div class="form-item">
            <button type="reset" value="Poništi">Poništi</button>
            <button type="submit" value="Prihvati" id="slanje">Prihvati</button>
        </div>
    </form>
</body>

<script type="text/javascript">

    document.getElementById("slanje").onclick = function(event) {

        var slanjeForme = true;
        var poljeTitle = document.getElementById("title");
        var title = document.getElementById("title").value;

        if (title.length < 2 || title.length > 50) {
            slanjeForme = false;
            poljeTitle.style.border="1px dashed red";
            document.getElementById("porukaTitle").innerHTML="Naslov vijesti mora imati između 2 i 50 znakova!<br>";
        } else {
            poljeTitle.style.border="1px solid green";
            document.getElementById("porukaTitle").innerHTML="";
        }

        var poljeAbout = document.getElementById("about");
        var about = document.getElementById("about").value;
        
        if (about.length < 10 || about.length > 100) {
            slanjeForme = false;
            poljeAbout.style.border="1px dashed red";
            document.getElementById("porukaAbout").innerHTML="Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
        } else {
            poljeAbout.style.border="1px solid green";
            document.getElementById("porukaAbout").innerHTML="";
        }

        var poljeContent = document.getElementById("content");
        var content = document.getElementById("content").value;
        
        if (content.length == 0) {
            slanjeForme = false;
            poljeContent.style.border="1px dashed red";
            document.getElementById("porukaContent").innerHTML="Sadržaj mora biti unesen!<br>";
        } else {
            poljeContent.style.border="1px solid green";
            document.getElementById("porukaContent").innerHTML="";
        }

        <?php if($updating==false){ echo '
        var poljeSlika = document.getElementById("pphoto");
        var pphoto = document.getElementById("pphoto").value;
        
        if (pphoto.length == 0) {
            
            slanjeForme = false;
            poljeSlika.style.border="1px dashed red";
            document.getElementById("porukaSlika").innerHTML="Slika mora biti unesena!<br>";
        } else {
            poljeSlika.style.border="1px solid green";
            document.getElementById("porukaSlika").innerHTML="";
        }
        ';}
        ?>

        var poljeCategory = document.getElementById("category");
        if(document.getElementById("category").selectedIndex == 0) {
            slanjeForme = false;
            poljeCategory.style.border="1px dashed red";
            document.getElementById("porukaKategorija").innerHTML="Kategorija mora biti odabrana!<br>";
        } else {
            poljeCategory.style.border="1px solid green";
            document.getElementById("porukaKategorija").innerHTML="";
        }

        if (slanjeForme != true) {
            event.preventDefault();
        }
    };

</script>
</html>