<?php
  require('database.php');
  session_start();

  if( isset($_SESSION['Username']) ){
    $username = $_SESSION['Username'];

    // Get userid
    $user_query = "SELECT * FROM user WHERE Username = :username";
    $user_stmt = $db->prepare($user_query);
    $user_stmt->bindValue(':username', $username);
    $user_stmt->execute();
    $user = $user_stmt->fetch();

    // Delete items from the cart
    $cart_del_query = "DELETE * FROM cart WHERE UserID = :userid";
    $cart_del_stmt = $db->prepare($cart_del_query);
    $cart_del_stmt->bindValue(':userid', $user['UserID']);
    $cart_del_stmt->execute();
    $cart_del_stmt->closeCursor();

  }
  else{
    header('location: 1Login.php');
  }
?>

