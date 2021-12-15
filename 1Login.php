<?php
    session_start();
    // If cookie is set stay logged in
    if(isset($_COOKIE['mycookie'])) {
        header('Location: 3SearchAndSearchResults.php');
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>

    <div class="header-bar">
        <div class="header-homepage">
            <h1>WELCOME TO BACK2SCHOOL</h1>
        </div>
    </div>

    <div class="login-body">
        <form action="check.php" method="post">
            <label>USERNAME:</label><br>
            <input type="text" name="Username" placeholder="Username"><br>
            <label>PASSWORD:</label><br>
            <input type="password" name="Password"><br>
            <label>REMEMBER ME:</label>
            <input type="checkbox" value="1" name="check"><br>
            <button type = "submit" class="checkout-button">Login</button>
            <p>DON'T HAVE AN ACCOUNT?</p>
            </p><a href="2Registration.php">REGISTER</a></p>
            
            <!-- If username or password is incorrect -->
            <?php
                if(isset($_SESSION["error"])){
                    $error = $_SESSION["error"];
                    echo "<span>$error</span>";
                }
            ?>
        </form> 
    </div>

    </body>

    <footer>
		<p>@ 2021 Back2School</p>	
	</footer>
</html>
<?php
    unset($_SESSION["error"]);
?>