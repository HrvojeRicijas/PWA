<?php
    session_start();
    $title = $_POST['title'];
    $preview = $_POST['about'];
    $content = $_POST['content'];
    $photo = $_FILES['pphoto'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']);
    $edit = isset($_POST['toEdit']);
    


    $dbc = mysqli_connect('localhost', 'root','','projectdb') or
    die ('Error connecting to MySQL server.' . mysqli_connect_error());

    if($edit){
        print_r("a rather large banana");
        $id=$_POST['toEdit'];
        $sql = "UPDATE articles SET title = ?, preview = ?, text = ?, category = ?, archive = ? WHERE ID = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssii', $title, $preview, $content, $category, $archive, $id);
            mysqli_stmt_execute($stmt);

            if($_FILES["pphoto"]['size']>0){
                $stmt = mysqli_stmt_init($dbc);
                $sql = "UPDATE articles SET image = ? where ID = ?";
        
                $target_dir = __DIR__."/articleImg/";
                
                $path_parts = pathinfo(basename( $_FILES["pphoto"]["name"]));
                $target_dir = $target_dir . $id . '.' . $path_parts['extension'];
                $imgName = $id . '.' . $path_parts['extension'];
                move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 'ss', $imgName, $id);
                    mysqli_stmt_execute($stmt);
                }
            }
            
        }
        $postID=$id;
    } else {

        $sql = "INSERT INTO articles (title, preview, text, category, date, archive)VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = mysqli_stmt_init($dbc);


        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssi', $title, $preview, $content, $category, $archive);
            mysqli_stmt_execute($stmt);
            $postID = $dbc->insert_id;

            $stmt = mysqli_stmt_init($dbc);
            $sql = "UPDATE articles SET image = ? where ID = ?";

            $target_dir = __DIR__."/articleImg/";
            
            $path_parts = pathinfo(basename( $_FILES["pphoto"]["name"]));
            $target_dir = $target_dir . $postID . '.' . $path_parts['extension'];
            $imgName = $postID . '.' . $path_parts['extension'];
            move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ss', $imgName, $postID);
                mysqli_stmt_execute($stmt);
            }
            
        } 
    }

    mysqli_close($dbc);
    header('Location: /pwa/clanak.php?id='.$postID);

?>