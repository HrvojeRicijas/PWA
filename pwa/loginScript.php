<?php
session_start();
$username = $_POST['username'];
$namename = $_POST['name'];
$password = $_POST['pass'];
$register = strlen($_POST['passRep']);
$hashed_password = password_hash($password, CRYPT_BLOWFISH);;
$registriranKorisnik = '';

$dbc = mysqli_connect('localhost', 'root','','projectdb') or
die ('Error connecting to MySQL server.' . mysqli_connect_error());

$sql = "SELECT username FROM users WHERE username = ?";
$stmt = mysqli_stmt_init($dbc);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
}

if(mysqli_stmt_num_rows($stmt) == 0 and $register){
    $sql = "INSERT INTO users (username, password, name)VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'sss', $username, $hashed_password, $namename);
        mysqli_stmt_execute($stmt);
        $registriranKorisnik = true;
        $_SESSION['access']=1;
    }
}else if(mysqli_stmt_num_rows($stmt) > 0 and $register){
    $_SESSION['msg'] = "Korisničko ime već postoji!";
}else if($register == 0){

    $sql="SELECT username, password FROM users WHERE username=?";
    $stmt=mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $sql)){
        mysqli_stmt_bind_param($stmt,'s',$username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }

    while ($row = $result->fetch_assoc()) {
        if(password_verify($password ,$row['password'])){
            $_SESSION['access']=1;
        }
    }
    $_SESSION['msg'] = "Pogrešni podaci za prijavu!";
}

/*
if(mysqli_stmt_num_rows($stmt) > 0){
    $_SESSION['msg'] = "Korisničko ime već postoji!";
}else
{

    $sql = "INSERT INTO users (username, password)VALUES (?, ?)";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 'ss', $username, $hashed_password);
        mysqli_stmt_execute($stmt);
        $registriranKorisnik = true;
    }
}
mysqli_close($dbc);

$_SESSION['access'] = 1;
*/
header('Location: ./admin.php')
?>