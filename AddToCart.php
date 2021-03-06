<?php 
    require('database.php');
    session_start();

    // if user if logged in
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
        $query = 'SELECT COUNT(CartID) FROM cart WHERE UserID = :UserID AND ProductID = :ProductID';
        $result = $db -> prepare($query);
        $result -> bindValue('UserID', $UserID);
        $result -> bindValue('ProductID', $ProductID);
        $success = $result -> execute();
        $count = $result->fetchColumn();
        $result -> closeCursor();

        // if row already exists in database, then add to the quantity
        if ($count > 0) {
            // increases quantity of product by 1
            $queryUpdate = 'UPDATE cart SET Quantity = Quantity + 1 WHERE UserID = :UserID AND ProductID = :ProductID';
            $statement = $db -> prepare($queryUpdate);
            $statement -> bindValue('UserID', $UserID);
            $statement -> bindValue('ProductID', $ProductID);
            $success = $statement -> execute();
            $statement -> closeCursor();

        // if row does not exist in database, create new row and put in input values
        } else {
            
            $queryAdd = 'INSERT INTO cart (UserID, ProductID, Quantity) VALUES (:UserID, :ProductID, :Quantity)';
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
        // Return to login if user not logged in
        header('location: 1Login.php');
    }
?>