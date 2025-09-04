<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['email']);
header("Location: ../loginSignup/home.php");
session_destroy();
?>
