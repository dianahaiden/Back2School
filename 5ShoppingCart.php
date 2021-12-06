<?php
    require('database.php');
    // session_start();

    // Get Session and Username
    
    $UserID = "1";
    $UserID = filter_input(INPUT_POST, $UserID);
    $ProductID = filter_input(INPUT_POST, 'ProductID');
	$query = 'SELECT P.ProductID, P.Name, P.Price FROM Product P INNER JOIN Cart C ON P.ProductID = C.ProductID WHERE C.UserID = UserID ORDER BY P.ProductID;';
	$statement = $db -> prepare($query);
	$success = $statement -> execute();
	$Products = $statement -> fetchAll(PDO::FETCH_ASSOC);
	$statement -> closeCursor();

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