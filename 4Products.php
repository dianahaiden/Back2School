<?php
    require('database.php');
	session_start();
    
	// receives two pieces of input from SearchAndSearchResults, ProductID and UserID
	// filters input
	$ProductID = filter_input(INPUT_GET, 'ProductID', FILTER_VALIDATE_INT);
	if ($ProductID == NULL || $ProductID == FALSE) {
		$ProductID = 1;
	}

	$UserID = filter_input(INPUT_GET, 'UserID', FILTER_VALIDATE_INT);
	if ($UserID == NULL || $UserID == FALSE) {
		$UserID = 1;
	}

	$ProductID = filter_input(INPUT_POST, 'ProductID');

	// finds the product in Products table where the ID is equal to the input
	$query = 'SELECT * FROM product WHERE ProductID = :ProductID';
	$statement = $db -> prepare($query);
	$statement -> bindValue('ProductID', $ProductID);
	$success = $statement -> execute();
	$product = $statement -> fetch();
	$statement -> closeCursor();

	// obtain user if if logged in
	if(isset($_SESSION['Username'])){
	$query1="SELECT * FROM user WHERE Username ='".$_SESSION['Username']."'";
    $statement1 = $db -> prepare($query1);
	$statement1 -> execute();
    $user = $statement1 -> fetch();
    $UserID = $user['UserID'];
    $statement1 -> closeCursor();
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
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
		<div class="content-container">
			<main>
				<div class="photo-column">
					<!-- Print Image -->
					<img src="<?php echo $product['Image']; ?>" width="600" height="480">

				</div>
			</main>
			
			<aside>
				<div class="product-info">
					<!-- Print Name and Product Description -->
					<h1><?php echo $product['Name']; ?></h1>
					<p><?php echo $product['ProductDescription']; ?></p>
				</div>

				<div class="price-checkout">
					<!-- Print Price -->
					<h2>$<?php echo $product['Price']; ?></h2>
					<!-- Increases Quantity by 1 and brings user back to home page -->
					<form action="AddToCart.php" method="post">
						<button type = "submit" class="checkout-button">Add to Cart</button>
						<!-- gives three inputs to the AddToCart.php page -->
                    	<input type="hidden" name="ProductID" value="<?php echo $product['ProductID'] ?>">
						<input type="hidden" name="UserID" value="<?php echo $UserID ?>">
						<input type="hidden" name="Quantity" value="1">
					</form>
					
				</div>
			</aside>
		</div>
		
    </body>

	<footer>
		<p>@ 2021 Back2School</p>	
	</footer>
</html>