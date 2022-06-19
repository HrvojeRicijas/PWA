<?php /*
        session_start();
        if (isset($_SESSION['access'])) {
            if($_SESSION['access']==1){header('Location: ./admin.php');
            }
        }
        */
?>

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

    <form enctype="multipart/form-data" action="loginScript.php" method="POST">
        <div class="form-item">
            <span id="porukaUsername" class="bojaPoruke"></span>
            <label for="content">Korisničko ime:</label>
            <?php if(isset($_SESSION['msg'])){echo '<br><span class="bojaPoruke">'.$_SESSION['msg'].'</span>'; unset($_SESSION['msg']);} ?>
            <div class="form-field">
                <input type="text" name="username" id="username" class="formfield-textual">
            </div>
        </div>

        <div class="form-item">
            <span id="porukaPass" class="bojaPoruke"></span>
            <label for="pphoto">Lozinka: </label>
                <div class="form-field">
            <input type="password" name="pass" id="pass" class="formfield-textual">
            </div>
        </div>

        <div class="form-item">
            <button type="submit" value="Prijava"
            id="slanje">Prijava</button>
        </div>
        <br>
        <div class="form-item">
            <span id="porukaPassRep" class="bojaPoruke"></span>
            <label for="pphoto">Za registraciju ponovite lozinku: </label>
            <div class="form-field">
                <input type="password" name="passRep" id="passRep" class="form-field-textual">
            </div>
        </div>

        <div class="form-item">
            <span id="porukaName" class="bojaPoruke"></span>
            <label for="content">I dodajte osobno ime:</label>
            <br><span class="bojaPoruke"></span>
            <div class="form-field">
                <input type="text" name="name" id="name" class="formfield-textual">
            </div>
        </div>

        <div class="form-item">
            <button type="submit" value="Prijava"
            id="registracija">Registracija</button>
        </div>

        
    </form>

   
</body>
<script type="text/javascript">
    document.getElementById("registracija").onclick = function(event) {

        var slanjeForme = true;

        var poljeUsername = document.getElementById("username");
        var username = document.getElementById("username").value;
        if (username.length == 0) {
            slanjeForme = false;
            poljeUsername.style.border="1px dashed red";
            document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
        } else {
            poljeUsername.style.border="1px solid green";
            document.getElementById("porukaUsername").innerHTML="";
        }

        var poljeUsername = document.getElementById("name");
        var username = document.getElementById("name").value;
        if (username.length == 0) {
            slanjeForme = false;
            poljeUsername.style.border="1px dashed red";
            document.getElementById("porukaName").innerHTML="<br>Unesite osobno ime!<br>";
        } else {
            poljeUsername.style.border="1px solid green";
            document.getElementById("porukaName").innerHTML="";
        }

        // Provjera podudaranja lozinki
        var poljePass = document.getElementById("pass");
        var pass = document.getElementById("pass").value;
        var poljePassRep = document.getElementById("passRep");
        var passRep = document.getElementById("passRep").value;
        if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
            slanjeForme = false;
            poljePass.style.border="1px dashed red";
            poljePassRep.style.border="1px dashed red";
            document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
            document.getElementById("porukaPassRep").innerHTML="<br>Lozinke nisu iste!<br>";
        } else {
            poljePass.style.border="1px solid green";
            poljePassRep.style.border="1px solid green";
            document.getElementById("porukaPass").innerHTML="";
            document.getElementById("porukaPassRep").innerHTML="";
        }

        if (slanjeForme != true) {
            event.preventDefault();
        }
    };

    document.getElementById("slanje").onclick = function(event) {

        var slanjeForme = true;

        var poljeUsername = document.getElementById("username");
        var username = document.getElementById("username").value;
        if (username.length == 0) {
            slanjeForme = false;
            poljeUsername.style.border="1px dashed red";
            document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
        } else {
            poljeUsername.style.border="1px solid green";
            document.getElementById("porukaUsername").innerHTML="";
        }
        

        // Provjera podudaranja lozinki
        var poljePass = document.getElementById("pass");
        var pass = document.getElementById("pass").value;
        if (pass.length == 0) {
            slanjeForme = false;
            poljePass.style.border="1px dashed red";
            document.getElementById("porukaPass").innerHTML="<br>Unesite Lozinku!<br>";
        } else {
            poljePass.style.border="1px solid green";
            poljePassRep.style.border="1px solid green";
            document.getElementById("porukaPass").innerHTML="";
        }

        if (slanjeForme != true) {
            event.preventDefault();
        }
        };
</script>
</html>

<?php /*
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password'])){

            $username = $_POST['username'];
            $password = $_POST['password'];
            $dbc = mysqli_connect('localhost', 'root','','projectdb') or
            die ('Error connecting to MySQL server.' . mysqli_connect_error());

            echo "banana";

            $sql="INSERT INTO users (Username, Password) values (?, ?)";

            $stmt->init($dbc);

            if ($stmt->prepare($$sql)){
            $stmt->bind_param('ss',$username,$password);

            $stmt->execute();
            }

            

            $select = mysqli_query($dbc, "SELECT * FROM users WHERE username = '".$username."'") or
            die('Error querying databese.');

            if($row = mysqli_fetch_assoc($select)) {
                if (password_verify($password, $row['password'])){
                    $_SESSION['username'] = $username;
                    echo '<a href="m12.php">LINK</a>';
                    die();
               }else {
                    echo "unijeli ste pogrešno korisničko ime ili lozinku";
               }
               
            }
            else{
                echo "Unijeli ste pogrešno korisničko ime ili lozinku.";
            }
            mysqli_close($dbc);
        }
        */
    ?>



