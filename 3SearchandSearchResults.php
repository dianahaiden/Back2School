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
        <div class="search-container">
        <form class="example" action="action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit" class="add-button"><i ></i>Search</button>
        </form>
        </div>
        <br><br>
        <br><br>
        <section class="product-list">
            <?php foreach ($Products as $Product) : ?>
                <h1 class="pSection">Products</h1>

                <div class="product-container"> 
                    <!-- MECHANICAL PENCILS -->
                    <div class="card">
                        <div class="image">
                        <img src="images/mechanicalpencil1.jpg" alt="Mechanical Pencils"> 
                        </div>
                        <a href="products.html"><div class="title">Mechanical Pencils</div></a>
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- PEN -->
                    <div class="card">
                        <div class="image">
                        <img src="images/pen.jpg" alt="Pens"> 
                        </div>
                        <a href="products.html"><div class="title">Pens</div></a> 
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- NOTEBOOKS -->
                    <div class="card">
                        <div class="image">
                        <img src="images/notebook.jpg" alt="Mechanical Pencils"> 
                        </div>
                        <a href="products.html"><div class="title">Notebooks</div></a>
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- BINDERS -->
                    <div class="card"> 
                        <div class="image">
                        <img src="images/binder.jpg" alt="Binders"> 
                        </div>
                        <a href="products.html"><div class="title">Binders</div></a>
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- HIGHLIGHTERS -->
                    <div class="card"> 
                        <div class="image">
                        <img src="images/highlighter.jpg" alt="Highlighters"> 
                        </div>
                        <a href="products.html"><div class="title">Highlighters</div></a>
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- POST-IT NOTES -->
                    <div class="card">
                        <div class="image">
                        <img src="images/post-it-note.jpg" alt="Post-It Notes"> 
                        </div>
                        <a href="products.html"><div class="title">Post-It Notes</div></a> 
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- BACKPACK -->
                    <div class="card"> 
                        <div class="image">
                        <img src="images/backpack.jpg" alt="Backpack"> 
                        </div>
                        <a href="products.html"><div class="title">Backpack</div></a>
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- LAPTOP -->
                    <div class="card">
                        <div class="image">
                        <img src="images/laptop.jpg" alt="Laptop"> 
                        </div>
                        <a href="products.html"><div class="title">Laptop</div></a> 
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>

                    <!-- ACCESSORIES -->
                    <div class="card">
                        <div class="image">
                        <img src="images/accessories.jpg" alt="Accessories"> 
                        </div>
                        <a href="products.html"><div class="title">Accessories</div></a>
                        <div class="text">Product Description...</div>
                        <br>
                        <div class="price">$3.99</div>
                        <button class="add-button">Add to Cart</button>
                    </div>
                </div>





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
