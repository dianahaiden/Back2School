<?php
session_start();
// sign out
setcookie('mycookie', '', time()-3600);
session_unset();
session_destroy();
header('location: 1Login.php');
?>