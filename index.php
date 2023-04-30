<?php

if (!isset($_SESSION['loggedin'])) {
    header("location: ../public/home.php");
    exit;
} else {
    header("location: ../private/home.php");
    exit;
}