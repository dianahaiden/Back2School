<?php
session_start();    
$name = filter_input(INPUT_POST, 'name');
$pwd = filter_input(INPUT_POST, 'pwd');
$email = filter_input(INPUT_POST, 'email');
$confirm = filter_input(INPUT_POST, 'confirm');

$error1 = "Username is already in use";
$error2 = "Email is already in use";

// if failed input return to registration
if ($name == null || $email == null || $pwd == null || (strcmp($pwd, $confirm)!== 0)){
    header('location: 2Registration.php');
} else {
    require_once('database.php');
    // check if username is already in use
    $query1 = "SELECT * FROM user WHERE Username='$name'";
    $data1=$db->query($query1);

    if($data1->rowCount()>0) {
        $_SESSION["error"] = $error1;
        header('Location: 2Registration.php');
    } else {
        // check if email is already in use
        $query2 = "SELECT * FROM user WHERE Email='$email'";
        $data2=$db->query($query2);
        if($data2->rowCount()>0) {
            $_SESSION["error"] = $error2;
            header('Location: 2Registration.php');
        } else {
            // register the user
            $query3 = 'INSERT INTO user (Username, Password, Email) VALUES(:name, :pwd, :email)';
            $statement = $db->prepare($query3);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':pwd', $pwd);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $statement->closeCursor();
            
            header('location: 1Login.php');
        }
    }
}


?>
