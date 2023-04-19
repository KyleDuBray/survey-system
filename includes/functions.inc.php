<?php

// helper functions

function inputsEmpty($username, $email, $password, $confirmpassword)
{
    $result = false;
    if (empty($username) || empty($email) || empty($password) || empty($confirmpassword)) {
        $result = true;
    }
    return $result;
}

function inputsEmptyLogin($username, $password)
{
    $result = false;
    if (empty($username) || empty($password)) {
        $result = true;
    }
    return $result;
}

function invalidUsername($username)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    return $result;
}

function invalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}

function passwordsDifferent($password, $confirmpassword)
{
    $result = false;
    if ($password !== $confirmpassword) {
        $result = true;
    }
    return $result;
}

function userExists($conn, $username, $email)
{
    $sql = "SELECT * FROM user WHERE username = ? OR email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../public/register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        $result = false;
        mysqli_stmt_close($stmt);
        return $result;
    }

}

function createUser($conn, $username, $email, $password)
{
    $sql = "INSERT INTO user (username, email, password) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../public/register.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //$resultData = mysqli_stmt_get_result($stmt);

    header("location: ../public/register.php?error=none");
}

function loginUser($conn, $username, $password)
{
    $userExists = userExists($conn, $username, $username);

    if ($userExists === false) {
        header("location: ../public/login.php?error=invalidcredentials");
        exit();
    }

    $passwordHashed = $userExists['password'];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
        header("location: ../public/login.php?error=invalidcredentials");
        exit();
    }
    session_start();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['username'] = $userExists['username'];
    $_SESSION['password'] = $password;
    $_SESSION['email'] = $userExists['email'];
    $_SESSION['id'] = $userExists['user_id'];
    header("location: ../private/home.php");
}