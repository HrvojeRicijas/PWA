<?php
    session_start();
    if(!isset($_SESSION['access']) or !isset($_POST['toEdit']) or $_SESSION['access']<1) {
        header('Location: /pwa/index.php');
    } else{
        
    $id =$_POST['toEdit'];
    $dbc = mysqli_connect('localhost', 'root','','projectdb') or
    die ('Error connecting to MySQL server.' . mysqli_connect_error());

    $sql = "DELETE FROM articles WHERE ID = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);    
        }
    }
    mysqli_close($dbc);

    header('Location: /pwa/archive.php');
?>