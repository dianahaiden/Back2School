<?php
    require('database.php');
    session_start();

    print_r($_POST);

    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    $check=$_POST['check'];
    $_SESSION['Username'] = $_POST['Username'];
    
    $query="SELECT * FROM user WHERE Username='$Username' AND Password='$Password'";

    $data=$db->query($query);

    if($query) {
        if($check=='1') {
            // sets cookie that remembers usename and password and insta-logsin
            setcookie($Username, 'Username', time()+3600, "/"."",0);
            setcookie($Password, 'Password', time()+3600, "/"."",0);
            setcookie('mycookie', TRUE, time()+6);
        }
        
        header('Location: 3SearchandSearchResults.php');
        
    } else {
        // header('Location: error.html');
        echo "<p>wrong info, $Username, $Password,</p>";
    }
?>
