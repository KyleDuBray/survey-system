<?php

if (!isset($_POST['submit'])) {
    header("location: ../public/register.php");
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];

require_once 'dbc.inc.php';
require_once 'functions.inc.php';

if (inputsEmpty($username, $email, $password, $confirmpassword) !== false) {
    header("location: ../public/register.php?error=emptyinput");
    exit();
}

if (invalidUsername($username) !== false) {
    header("location: ../public/register.php?error=invalidusername");
    exit();
}

if (invalidEmail($email) !== false) {
    header("location: ../public/register.php?error=invalidemail");
    exit();
}

if (passwordsDifferent($password, $confirmpassword) !== false) {
    header("location: ../public/register.php?error=passwordsdontmatch");
    exit();
}

if (userExists($conn, $username, $email)) {
    header("location: ../public/register.php?error=userexists");
    exit();
}

createUser($conn, $username, $email, $password);