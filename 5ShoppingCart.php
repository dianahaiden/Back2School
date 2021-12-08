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
	$query = 'SELECT P.ProductID, P.Name, P.Price, C.Quantity FROM Product P INNER JOIN Cart C ON P.ProductID = C.ProductID WHERE C.UserID = UserID ORDER BY P.ProductID;';
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
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        <?php foreach ($Products as $Product) : ?>
           <tr>
                <td><?php echo $Product['Name']; ?></td>
                <td><?php echo $Product['Quantity']; ?></td>
                <td><?php echo $Product['Price'] * $Product['Quantity']; ?></td>
                <td><button type="submit">Remove</button></td>
           </tr>
         <?php endforeach; ?>
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
