<?php
    require('database.php');
    session_start();

    if (isset($_SESSION['Username'])) {
     

    // Get Session and Username
    // $Username = filter_input(INPUT_POST,$_SESSION['Username']);
    $query1="SELECT * FROM user WHERE Username = '".$_SESSION['Username']."'";
    $statement1 = $db -> prepare($query1);
    //$statement1 -> bindValue($_SESSION['Username'], $Username);
	$statement1 -> execute();
    $users = $statement1 -> fetch();
    $UserID = $users['UserID'];
    $statement1 -> closeCursor();
    
    //$UserID = filter_input(INPUT_POST, $UserID);
    $ProductID = filter_input(INPUT_POST, 'ProductID');
	$query = "SELECT P.ProductID, P.Name, P.Price, C.Quantity FROM Product P INNER JOIN Cart C ON P.ProductID = C.ProductID WHERE C.UserID = '".$UserID."' ORDER BY P.ProductID;";
	$statement = $db -> prepare($query);
	$success = $statement -> execute();
	$products = $statement -> fetchAll(PDO::FETCH_ASSOC);
	$statement -> closeCursor();
    
    $totalquantity = 0;
    $totalamount = 0;

    } else {
        header('location: 1Login.php');
    }
?>

<!DOCTYPE html>
<hmtl>
<head>
        <title>Shoppingcart</title>
        <link rel="stylesheet" href="styleproducts.css">
    </head>

    <div class="header-bar">
		<div class="header-left">
			<p>HAVE FUN SHOPPING!</p>
		</div>
		<div class="header-homepage">
			<a href="3SearchAndSearchResults.php"><h1>BACK2SCHOOL</h1></a>
		</div>
		<div class="header-right">
			<div class="flex1">
                <a href="signout.php"><p>SIGN OUT</p></a>
			</div>
			<div class="flex2">
				<a href="5ShoppingCart.php"><img src="cart.png" width="60px"></a>
			</div>
		</div>
	</div>

    <body>
        <h2>Your Cart</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <form action="removeCart.php" method="post">
                <?php foreach ($products as $product) : ?>
                    <?php
                    $totalquantity = $totalquantity + $product['Quantity'];
                    $totalamount = $totalamount + $product['Price'] * $product['Quantity'];
                    ?>
                    <tr>
                        <td><?php echo $product['Name']; ?></td>
                        <td><?php echo $product['Quantity']; ?></td>
                        <td><?php echo $product['Price']; ?></td>
                        <td><?php echo $product['Price'] * $product['Quantity']; ?></td>
                        <td>
                            <input type="submit" value="Remove">
                            <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
						    <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                        </td>
                    </tr>
                    
                <?php endforeach; ?>
                <tr>
                    <td>Total</td>
                    <td><?php echo $totalquantity ?> </td>
                    <td></td>
                    <td><?php echo $totalamount ?> </td>
                </tr>
            </form>
        </table>
        <form action="6CheckOut.php" method="post">
            <input type="submit" value="Checkout">
        </form>
        
    </body>
</html>
