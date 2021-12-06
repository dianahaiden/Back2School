<?php 
    require('database.php');
    session_start();
    if (isset($_SESSION['Username'])) {
        $Username = $_SESSION['Username'];
    
    // receive input from Products.php
    $UserID = filter_input(INPUT_GET, 'UserID', FILTER_VALIDATE_INT);
	if ($UserID == NULL || $UserID == FALSE) {
		$UserID = 1;
	}

    $ProductID = filter_input(INPUT_GET, 'ProductID', FILTER_VALIDATE_INT);
	if ($ProductID == NULL || $ProductID == FALSE) {
		$ProductID = 1;
	}

    $Quantity = filter_input(INPUT_GET, 'Quantity', FILTER_VALIDATE_INT);
	if ($Quantity == NULL || $Quantity == FALSE) {
		$Quantity = 1;
	}

	$UserID = filter_input(INPUT_POST, 'UserID');
    $ProductID = filter_input(INPUT_POST, 'ProductID');
    $Quantity = filter_input(INPUT_POST, 'Quantity');

    // find the number of rows that exist when the UserID = input and ProductID = input
    // result should either be 0 or 1
    $query = 'SELECT COUNT(UserID) FROM Cart WHERE UserID = :UserID AND ProductID = :ProductID';
	$result = $db -> prepare($query);
    $result -> bindValue('UserID', $UserID);
    $result -> bindValue('ProductID', $ProductID);
    $success = $result -> execute();
    $result -> closeCursor();

    // if row already exists in database, then add to the quantity
    if ($result > 0) {
        // increases quantity of product by 1
        $queryUpdate = 'UPDATE Cart SET Quantity = Quantity + 1 WHERE UserID = :UserID AND ProductID = :ProductID';
        $statement = $db -> prepare($queryUpdate);
        $statement -> bindValue('UserID', $UserID);
        $statement -> bindValue('ProductID', $ProductID);
        $success = $statement -> execute();
        $statement -> closeCursor();

    // if row does not exist in database, create new row and put in input values
    } else {
        
        $queryAdd = 'INSERT INTO Cart (UserID, ProductID, Quantity) VALUES (:UserID, :ProductID, :Quantity)';
        $statement = $db -> prepare($queryAdd);
        $statement -> bindValue('UserID', $UserID);
        $statement -> bindValue('ProductID', $ProductID);
        $statement -> bindValue('Quantity', $Quantity);
        $success = $statement -> execute();
        $statement -> closeCursor();
    }

    // Returns user to Home page
    header("Location: 3SearchAndSearchResults.php");

    } else {
        header('location: 1Login.php');
    }

    /*
    // increases quantity of product by 1
    $queryUpdate = 'UPDATE Products SET Quantity = Quantity + 1 WHERE ID = :ID';
    $statement = $db -> prepare($query);
    $statement -> bindValue('ID', $ID);
    $success = $statement -> execute();

    // Returns user to Home page
    header("Location: 3SearchAndSearchResults.php");
    */

?>