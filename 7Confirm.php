<?php
  require('database.php');
  session_start();

  if( isset($_SESSION['Username']) ){
    $username = $_SESSION['Username'];

    // Get userid
    $user_query = "SELECT * FROM user WHERE Username = :username";
    $user_stmt = $db->prepare($user_query);
    $user_stmt->bindValue(':username', $username);
    $user_stmt->execute();
    $user = $user_stmt->fetch();

    // Delete items from the cart
    $cart_del_query = "DELETE FROM cart WHERE UserID = :userid";
    $cart_del_stmt = $db->prepare($cart_del_query);
    $cart_del_stmt->bindValue(':userid', $user['UserID']);
    $cart_del_stmt->execute();
    $cart_del_stmt->closeCursor();

  }
  else{
    header('location: 1Login.php');
  }
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <title>Search</title>
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
    <div class="confirm-container">
        <h2>Thanks for your purchase!</h2>
    </div>
    </body>

    <footer>
		<p>@ 2021 Back2School</p>	
	</footer>
</html>
