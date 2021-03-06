<?php
    require('database.php');

    session_start();
    
    $ProductID = filter_input(INPUT_GET, 'ProductID',FILTER_VALIDATE_INT);
    if ($ProductID == NULL || $ProductID ==  FALSE) {
    $ProductID = 1;
    }

    // Query product list
    $queryAllProducts = 'SELECT * FROM product ORDER BY ProductID';
    $statement2 = $db -> prepare($queryAllProducts);
    $statement2 -> execute();
    $products = $statement2 -> fetchAll();
    $statement2 -> closeCursor();

    // Obtain user if logged in
    if(isset($_SESSION['Username'])){
    $query1="SELECT * FROM user WHERE Username ='".$_SESSION['Username']."'";
    $statement1 = $db -> prepare($query1);
	$statement1 -> execute();
    $user = $statement1 -> fetch();
    $UserID = $user['UserID'];
    $statement1 -> closeCursor();
    
    $query2 = 'SELECT * FROM user WHERE UserID = :UserID';
	$statement3 = $db -> prepare($query2);
	$statement3 -> bindValue('UserID', $UserID);
	$success = $statement3 -> execute();
	$user = $statement3 -> fetch();
	$statement3 -> closeCursor();
    }
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <title>Search</title>
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
    <div class="product-container">
        <?php foreach ($products as $product) : ?>
            <div class="product-stuff">
                <div class="image-container">
                <form action="4Products.php" method="post">
                    <!-- print out image -->
                    <input type="image" src="<?php echo $product['Image']; ?>" width="150" height="150">
                    <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
                    <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
                </form>
                
                </div>  
                <div class="product_info">
                  <!-- print out name and price -->
                  <p><b><?php echo $product['Name']; ?></b></p>
                  <p>$<?php echo $product['Price']; ?></p>
                </div>  
        </div>
            <?php endforeach; ?>
            </div>
    </body>

    <footer>
		<p>@ 2021 Back2School</p>	
	</footer>
</html>