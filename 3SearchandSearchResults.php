<?php
	require('database.php');
	session_start();

	$Username = filter_input(INPUT_GET, 'UserID', FILTER_VALIDATE_INT);
	if ($Username == NULL || $Username == FALSE) {
		$Username = 1;
	}

	$status="";
	if (isset($_POST['code']) && $_POST['code']!="") {
		$code = $_POST['code'];
		$result = mysqli_query($con, "SELECT * FROM `product` WHERE `code`='$code'");
		$row = mysqli_fetch_assoc($result);
		$name = $row['name'];
		$code = $row['code'];
		$price = $row['price'];
		$image = $row['image'];
 
		$cartArray = array(
		$code=>array(
		'name'=>$name,
		'code'=>$code,
		'price'=>$price,
		'quantity'=>1,
		'image'=>$image)
		);
	
	if(empty($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		$status = "<div class='box'>Product is added to your cart!</div>";
	}else{
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if(in_array($code,$array_keys)) {
			$status = "<div class='box' style='color:red;'>Product is already added to your cart!</div>"; 
		} else {
			$_SESSION["shopping_cart"] = array_merge(
				$_SESSION["shopping_cart"],
				$cartArray
			);
			$status = "<div class='box'>Product is added to your cart!</div>";
		}
	}
}	
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Search</title>
        <link rel="stylesheet" href="styleproducts.css">
        <link rel="stylesheet" href="stylesearch.css">
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
				<a href=#><p>SIGN OUT</p></a>
			</div>
			<div class="flex2">
				<a href="5ShoppingCart.php"><img src="images/shopping-cart.png" width="60px">
					<?php
						if(!empty($_SESSION["shopping_cart"])) {
							$cart_count = count(array_keys($_SESSION["shopping_cart"]));
							echo $cart_count;
						} 
					?>
				</a>
			</div>
		</div>
	</div>	
        
    <body>
		<div class="search-container">
				<form class="example" action="3SearchandSearchResults.php">
					<input type="text" placeholder="Search.." name="search">
					<button type="submit" class="search-button"><p>SEARCH</p></button>
				</form>
		</div>
		<h1 class="pSection">Products</h1>
		<section class="product-list">
			<div class="product-container">
				<?php		
					$searchProducts = "SELECT * FROM `product` LIMIT 0,9";
					$result = mysqli_query($con, $searchProducts);
					while($row = mysqli_fetch_assoc($result)){
						echo
							"<form method='post' action='' class='card'>
								<div class='image'><img src=".$row['Image']."></div>
								<div class='title'>".$row['Name']."</div>
								<div class='price'>$ ".$row['Price']."</div>
								<button type='submit' class='add-button'>Add to Cart</button>
							</form>";
					}
					mysqli_close($con);
				?>
			</div>
		</section>
    </body>


	<footer>
		<p>@ 2021 Back2School</p>	
	</footer>
</html>
