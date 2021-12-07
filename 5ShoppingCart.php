<?php
    require('database.php');
    session_start();

    if (isset($_SESSION['Username'])) {
     

    // Get Session and Username
    $Username = filter_input(INPUT_POST,$_SESSION['Username']);
    $query1='SELECT * FROM user WHERE Username = :Username';
    $statement1 = $db -> prepare($query1);
    $statement1 -> bindValue('Username', $Username);
	$statement1 -> execute();
    $user = $statement1 -> fetchAll();
    //$UserID = $user['UserID'];
    $statement1 -> closeCursor();
    
    //$UserID = filter_input(INPUT_POST, $UserID);
    $ProductID = filter_input(INPUT_POST, 'ProductID');
	$query = 'SELECT P.ProductID, P.Name, P.Price FROM Product P INNER JOIN Cart C ON P.ProductID = C.ProductID WHERE C.UserID = UserID ORDER BY P.ProductID;';
	$statement = $db -> prepare($query);
	$success = $statement -> execute();
	$Products = $statement -> fetchAll(PDO::FETCH_ASSOC);
	$statement -> closeCursor();
    
    } else {
        header('location: 1Login.php');
    }
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <title>Shoppingcart</title>
        <link rel="shoppingcart" href="styleshoppingcart.css">
    </head>

    <body>
        <h2>Your Cart</h2>
        <table>
        <?php foreach ($Products as $Product) : ?>
           <tr>
                <th><?php echo $Product['Name']; ?></th>
                <th><?php echo $Product['Price']; ?></th>
                <th></th>
           </tr>
         <?php endforeach; ?>
           <tr>
               <td>placeholder</td>
               <td>total</td> 
               <td><button type="submit">Remove</button></td>
           </tr>
           <tr>
                <td>placeholderprice</td>
                <td>totalprice</td>
            </tr>
            <tr>
               
            </tr>
        </table>
        <form action="6CheckOut.php">
            <input type="submit" value="Checkout">
        </form>
        
    </body>
</html>