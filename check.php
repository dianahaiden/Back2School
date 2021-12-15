<?php
    require('database.php');
    session_start();

    print_r($_POST);

    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    $check=$_POST['check'];
    $error = "Username/Password Incorrect";
    
    
    $query="SELECT * FROM user WHERE Username='$Username' AND Password='$Password'";


    $data=$db->query($query);

    if($data->rowCount()>0) {
        // set sesstion
        $_SESSION['Username'] = $_POST['Username'];
        if($check=='1') {
            // sets cookie that remembers usename and password and insta-logsin
            setcookie('mycookie', TRUE, time()+6);
        }
        
        header('Location: 3SearchandSearchResults.php');
        
    } 
    
    // login failed
    else {
        $_SESSION["error"] = $error;
        header('Location: 1Login.php');
    }
?>
