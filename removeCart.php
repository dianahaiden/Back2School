<?php
require_once('database.php');

$ProductID = filter_input(INPUT_POST, 'ProductID');
$UserID = filter_input(INPUT_POST, 'UserID');

// delete item from cart
$query = 'DELETE FROM cart WHERE UserID = :UserID AND ProductID = :ProductID';
$statement = $db->prepare($query);
$statement -> bindValue('ProductID', $ProductID);
$statement -> bindValue('UserID', $UserID);
$success = $statement->execute();
$statement->closeCursor();
header("location: 5ShoppingCart.php")
?>