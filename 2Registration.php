<?php
    require('database.php');
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
        <link rel="registration" href="styleregistration.css">
        <script>
            function required(){
                var name = document.forms["register"]["name"].value;
                var email = document.forms["register"]["email"].value;
                var pwd = document.forms["register"]["pwd"].value;
                var confirm = document.forms["register"]["confirm"].value;
                
                if (name_confirm(name)) {
                    if (email_confirm(email)) {
                        if (pwd_confirm(pwd)) {
                            if (conf_confirm(confirm, pwd)) {
                                document.getElementById("register").submit();
                            }
                        }
                    }
                }

                return false;
            }
            function name_confirm(name){
                var name_len = name.length;
                if (name_len == 0) {
                    alert("Username should not be empty");
                    name.focus();
                    return false;
                } else {
                    return true;
                }
            }

            function email_confirm(email){
                
                var email_len = email.length;
                if (email_len == 0) {
                    alert("Email should not be empty");
                    email.focus();
                    return false;
                } else {
                    return true;
                }
            }

            function pwd_confirm(pwd){
                var pwd_len = pwd.length;
                if (pwd_len == 0){
                    alert("Password should not be empty")
                    pwd.focus();
                    return false;
                } else {
                    return true;
                }
            }

            function conf_confirm(confirm, pwd){
                if(confirm.match(pwd)){
                    return true;
                } else {
                    alert("Passwords do not match")
                    confirm.focus();
                    return false;
                }
            }
        </script>
    </head>

    <body>
        <form name = "register" onsubmit="return required()" action="reg.php" method="post">
            <!--New User-->
            <div> 
                <h1>Registration Form</h1>
                <p>Please fill in the details to create an account with us.</p>
                <hr>
                <!--USERNAME-->
                <label for="Name"><b>Username:</b></label>
                    <input type="text" placeholder="Username" name="name">
                    <br><br>
                <!--EMAIL-->
                <label for="email"><b>Email</b></label>
                    <input type="email" placeholder="Enter Email" name="email">
                    <br><br>
                <!--PASSWORD-->
                <label for="pwd"><b>Password</b></label>
                    <input type="password" placeholder="Password" name="pwd">
                    <br><br>
                <label for="confirm"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Confirm Password" name="confirm">
                    <br><br>
                <hr>
                <input type="submit" value = "Register">
            </div>

            <p id="demo"></p>

            <!--Returning User-->
            <div> 
                <p>Already have an account? <a href="1Login.php">Sign in</a>.</p>
            </div>
        </form>
        
    </body>
</html>
