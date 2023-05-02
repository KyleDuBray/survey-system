<?php

// get root of URL since navbar among multiple different pages/paths
$httpProtocol = !isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on' ? 'http' : 'https';

$base = $httpProtocol . '://' . $_SERVER['HTTP_HOST'] . '/';

$publicNav = " <nav class='navbar'>
    <a href=" . $base . "public/home.php>" . "
    <img src='../img/logo-name.svg' alt='logo with name'></a>
    <div class='nav-links'>" .
    formatLink("./login.php", "login") .
    formatLink("./register.php", "register") . "</div></nav>";

$privateNav = " <nav class='navbar'>
    <a href=" . $base . "private/home.php>" . "
    <img src='../img/logo-name.svg' alt='logo with name';
    <div class='nav-links'>" .
    formatLink("./browsesurveys.php", "browse") .
    formatLink("./mysurveys.php", "my surveys") .
    formatLink("./creationForm.php", "create") .
    formatLink("./profile.php", "profile") .
    formatLink("../includes/logout.inc.php", "logout") .
    "</div></nav>";


if (!isset($_SESSION['loggedin'])) {
    echo $publicNav;
} else {
    echo $privateNav;
}

function formatLink($href, $text)
{
    return "<a class='link' href='" . $href . "'>" .
        $text . "</a>";
}