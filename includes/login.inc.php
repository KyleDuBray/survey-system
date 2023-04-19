<?php

if (!isset($_POST['submit'])) {
    header("location: ../public/login.php");
}

require_once 'dbc.inc.php';
require_once 'functions.inc.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (inputsEmptyLogin($username, $password)) {
    header("location: ../public/login.php?error=emptyinput");
    exit();
}

loginUser($conn, $username, $password);