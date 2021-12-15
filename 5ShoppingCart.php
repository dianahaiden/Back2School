<?php
    require('database.php');
    session_start();

    // if user is logged in
    if (isset($_SESSION['Username'])) {
    // get user id
    $query1="SELECT * FROM user WHERE Username = '".$_SESSION['Username']."'";
    $statement1 = $db -> prepare($query1);
	$statement1 -> execute();
    $users = $statement1 -> fetch();
    $UserID = $users['UserID'];
    $statement1 -> closeCursor();
    
    // get correct cart of the user logged in
    $ProductID = filter_input(INPUT_POST, 'ProductID');
	$query = "SELECT P.ProductID, P.Name, P.Price, C.Quantity FROM Product P INNER JOIN Cart C ON P.ProductID = C.ProductID WHERE C.UserID = '".$UserID."' ORDER BY P.ProductID;";
	$statement = $db -> prepare($query);
	$success = $statement -> execute();
	$products = $statement -> fetchAll(PDO::FETCH_ASSOC);
	$statement -> closeCursor();
    
    // variables for total
    $totalquantity = 0;
    $totalamount = 0;

    } else {
        // if user is not logged in return to login
        header('location: 1Login.php');
    }
?>

<!DOCTYPE html>
<hmtl>
<head>
        <title>Shoppingcart</title>
        <link rel="stylesheet" href="main.css">
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
        <div class="cart-body">
        <h2>YOUR CART</h2>
        <table>
            <tr>
                <div class="table-stuff">
                <th><b><p>Name</p><b></th>
                <th><b><p>Quantity</p><b></th>
                <th><b><p>Price</p><b></th>
                <th><b><p>Total</p><b></th>
                </div>
            </tr>
            <form action="removeCart.php" method="post">
                <?php foreach ($products as $product) : ?>
                    <?php
                    // total number of items
                    $totalquantity = $totalquantity + $product['Quantity'];

                    // total cost
                    $totalamount = $totalamount + $product['Price'] * $product['Quantity'];
                    ?>
                    <tr>
                        <td><p><?php echo $product['Name']; ?></p></td>
                        <td><p><?php echo $product['Quantity']; ?></p></td>
                        <td><p>$<?php echo $product['Price']; ?></p></td>
                        <td><p>$<?php echo $product['Price'] * $product['Quantity']; ?></p></td>
                        <td>
                        <!-- Button to remove item from cart-->
                        <button type = "submit" class="remove-button">Remove</button>
                            <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
						    <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                        </td>
                    </tr>
                    
                <?php endforeach; ?>
                <tr>
                    <!-- Print total -->
                    <td><b><p>Total</b></p></td>
                    <td><b><p><?php echo $totalquantity ?></b></p></td>
                    <td></td>
                    <td><b><p>$<?php echo $totalamount ?></b></p></td>
                </tr>
            </form>
        </table>
        <form action="6CheckOut.php" method="post">
            <button type = "submit" class="checkout-button">Checkout</button>
        </form>
        </div>
    </body>

    <footer>
		<p>@ 2021 Back2School</p>	
	</footer>
</html>