<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header("location: ../public/login.php");
    exit;
}

require_once 'dbc.inc.php';
require_once 'functions.inc.php';

echo var_dump($_POST);