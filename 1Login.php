<?php
    session_start();
    if(isset($_COOKIE['mycookie'])) {
        header('Location: 3SearchAndSearchResults.php');
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="login" href="stylelogin.css">
    </head>
    <body>
        <h1>Welcome to Back2School</h1>

        <form action="check.php" method="post">
            <label>Username:</label><br>
            <input type="text" name="Username" placeholder="Username"><br>
            <label>Password:</label><br>
            <input type="password" name="Password"><br>
            <label>Remember Me</label>
            <input type="checkbox" value="1" name="check"><br>
            <input type="submit" value="Login">
            <p>Don't have an account? <a href="2Registration.php">Register</a>.</p>
            <?php
                if(isset($_SESSION["error"])){
                    $error = $_SESSION["error"];
                    echo "<span>$error</span>";
                }
            ?>
        </form> 

    </body>
</html>
<?php
    unset($_SESSION["error"]);
?>
