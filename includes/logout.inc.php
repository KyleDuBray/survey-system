<?php
session_start();
session_destroy();
// Redirect to the login page:
header("location: ../public/login.php");
?>