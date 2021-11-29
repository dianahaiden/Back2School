<?php
    require('database.php');
    session_start();

    print_r($_POST);

    $Username=$_POST['name'];
    $Password=$_POST['password'];
    $check=$_POST['check'];

    $_SESSION['Username'] = $Username;

    $query="SELECT * FROM Users WHERE name='$Username' AND password='$Password'";

    $data=$db->query($query);

    if($data->rowCount()>0) {
        if($check=='1') {
            // sets cookie that remembers usename and password and insta-logsin
            setcookie($Username, 'name', time()+3600, "/"."",0);
            setcookie($Password, 'password', time()+3600, "/"."",0);
            setcookie("mycookie", TRUE, time()+6);
        }

        header('Location: 3SearchandSearchResults.php');
        
    } else {
        // header('Location: error.html');
        echo "<p>wrong info, $Username, $Password,</p>";
    }
?>