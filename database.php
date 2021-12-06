<?php
try {
$dsn = 'mysql:host=localhost;dbname=back2school';
$username = 'root';
$password = '';
$db = new PDO($dsn,$username,$password);
$con = mysqli_connect('localhost',$username,$password, 'back2school');
} catch(PDOException $e) {
  $error_message = $e -> getMessage();
  echo "<p> An error occured while connecting to the database: $error_message </p>";
} catch(Exception $e) {
  $error_message = $e -> getMessage();
  echo "<p> An error occured while connecting to the database: $error_message </p>";
}
?>
