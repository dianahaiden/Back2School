<?php
    require('database.php');
    session_start();

    if (isset($_SESSION['Username'])) {
     

    // Get Session and Username
    // $Username = filter_input(INPUT_POST,$_SESSION['Username']);
    $query1="SELECT * FROM user WHERE Username = '".$_SESSION['Username']."'";
    $statement1 = $db -> prepare($query1);https://github.com/dianahaiden/Back2School/stargazers
    //$statement1 -> bindValue($_SESSION['Username'], $Username);
	$statement1 -> execute();
    $users = $statement1 -> fetch();
    $UserID = $users['UserID'];
    $statement1 -> closeCursor();

    echo $UserID;
    
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
                <th>Change Quantity</th>
            </tr>
            <form action="AddToCart.php" method="post">
                <?php foreach ($Products as $Product) : ?>
                    <tr>
                        <td><?php echo $Product['Name']; ?></td>
                        <td><?php echo $Product['Quantity']; ?></td>
                        <td><?php echo $Product['Price'] * $Product['Quantity']; ?></td>
                        <td><form action="AddToCart.php" method="post">
                        <input type="text" name="Quantity">
						<input type = "submit" value = "Change">
						<!-- gives three inputs to the AddToCart.php page -->
                    	<input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
						<input type="hidden" name="UserID" value="<?php echo $UserID?>">
					    </form></td>
                    </tr>
                <?php endforeach; ?>
            </form>
        </table>
        <form action="6CheckOut.php" method="post">
            <input type="submit" value="Checkout">
        </form>
        
    </body>
</html>
