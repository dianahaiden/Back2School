<?php
session_start();
// sign out
session_unset();
session_destroy();
header('location: 1Login.php')
?>