<?php
    require('database.php');
    
	// receives two pieces of input from SearchAndSearchResults, ProductID and UserID
	// filters input
	$ID = filter_input(INPUT_GET, 'ProductID', FILTER_VALIDATE_INT);
	if ($ID == NULL || $ID == FALSE) {
		$ID = 1;
	}

	$Username = filter_input(INPUT_GET, 'UserID', FILTER_VALIDATE_INT);
	if ($Username == NULL || $Username == FALSE) {
		$Username = 1;
	}

	$ID = filter_input(INPUT_POST, 'ProductID');

	// finds the product in Products table where the ID is equal to the input
	$query = 'SELECT * FROM Products WHERE ID = :ProductID';
	$statement = $db -> prepare($query);
	$statement -> bindValue('ProductID', $ID);
	$success = $statement -> execute();
	$Product = $statement -> fetch();
	$statement -> closeCursor();

	$Username = filter_input(INPUT_POST, 'UserID');
	$query2 = 'SELECT * FROM Users WHERE Username = :UserID';
	$statement2 = $db -> prepare($query2);
	$statement2 -> bindValue('UserID', $Username);
	$success = $statement2 -> execute();
	$Users = $statement2 -> fetch();
	$statement2 -> closeCursor();
	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="styleproducts.css">
    </head>
        
    <body>
			<main>
				<div class="photo-column">
					<!-- Print Image -->
					<img src="<?php echo $Product['Image']; ?>" width="600">

				</div>
			</main>
			
			<aside>
				<div class="product-info">
					<!-- Print Name and Product Description -->
					<h1><?php echo $Product['Name']; ?></h1>
					<p>Product Desciption should be put here.</p>
				</div>

				<div class="price-checkout">
					<!-- Print Price -->
					<h2>$<?php echo $Product['Price']; ?></h2>
					<!-- Increases Quantity by 1 and brings user back to home page -->
					<form action="AddToCart.php" method="post">
						<button type = "submit" class="checkout-button">Add to Cart</button>
						<!-- gives three inputs to the AddToCart.php page -->
                    	<input type="hidden" name="ProductID" value='1'>
						<input type="hidden" name="UserID" value='1'>
						<input type="hidden" name="Quantity" value="1">
					</form>
					
				</div>
			</aside>
		
		
    </body>
</html>