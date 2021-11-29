<?php
    require('database.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
        <link rel="registration" href="styleregistration.css">
        <script type="text/javascript" src="confirm.js"></script>
    </head>

    <body>
        <form name = "register" onsubmit="return required()" action="reg.php" method="post">
            <!--New User-->
            <div> 
                <h1>Registration Form</h1>
                <p>Please fill in the details to create an account with us.</p>
                <hr>
                <!--USERNAME-->
                <label for="Name"><b>Name:</b></label>
                    <input type="text" placeholder="Username" name="name">
                    <br><br>
                <!--EMAIL-->
                <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email">
                    <br><br>
                <!--PASSWORD-->
                <label for="pwd"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="pwd">
                    <br><br>
                <label for="confirm"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Confirm Password" name="confirm">
                    <br><br>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <button type="submit" onclick="required()" ><strong>Register</strong></button>
            </div>

            <p id="demo"></p>

            <!--Returning User-->
            <div> 
                <p>Already have an account? <a href="1Login.php">Sign in</a>.</p>
            </div>
        </form>
        
    </body>
</html>