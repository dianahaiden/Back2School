<?php
    require('database.php');
    
    $product_id = filter_input(INPUT_GET, 'product_id',FILTER_VALIDATE_INT);
    if ($product_id == NULL || $product_id ==  FALSE) {
    $product_id = 1;
    }

    // Get name for selected category
    $queryProduct = "SELECT * FROM Products WHERE ID = :product_id";
    $statement1 = $db ->prepare($queryProduct);
    $statement1 -> bindValue(':product_id', $product_id);
    $statement1 -> execute();
    $Product = $statement1 -> fetch();
    $Product_name = $Product['Name'];
    $statement1 -> closeCursor();

    $queryAllProducts = 'SELECT * FROM Products ORDER BY ID';
    $statement2 = $db -> prepare($queryAllProducts);
    $statement2 -> execute();
    $Products = $statement2 -> fetchAll();
    $statement2 -> closeCursor();

    
    $UserID = "1";
    $Username = filter_input(INPUT_POST, $UserID);
	$query2 = 'SELECT * FROM Users WHERE Username = :UserID';
	$statement3 = $db -> prepare($query2);
	$statement3 -> bindValue('UserID', $Username);
	$success = $statement3 -> execute();
	$Users = $statement3 -> fetch();
	$statement2 -> closeCursor();
    
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <title>Search</title>
        <link rel="search" href="stylesearch.css">
    </head>

    <header>
        <h1>Back2School</h1>
    </header>
    
    <body>
        <form class="example" action="action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i>Search</button>
        
        </form>
        <section class="products">
        <?php foreach ($Products as $Product) : ?>
            <div class="product-container">
                <div class="image-container">
                <!-- print out image -->
                    
                </div>  
                <div class="product_info">
                  <!-- print out name and price -->
                  <?php echo $Product['Name']; ?>
                  <?php echo $Product['Price']; ?>
                  <?php echo $UserID; ?>
                  <form action="4Products.php" method="post">
                    <input type="hidden" name="ProductID" value="<?php echo $Product['ID']; ?>">
                    <input type="hidden" name="UserID" value="<?php echo $Users['Username']; ?>">
                    <input type="submit" value="View">
                    </form>
                </div>  
            </div>
            <?php endforeach; ?>
        </section>


    </body>
</html>

