<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Survey Savvy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/public.home.css">
</head>

<body>
    <?php include "../shared/navbar.php";
    if (isset($_SESSION['loggedin'])) {
        header("location: ../private/home.php");
        exit;
    } ?>
    <div class="intro">
        <img src="../img/clipboard-intro.svg" alt="clipboard logo">
        <div class="intro-text-and-buttons">
            <h1 class="intro-text-main">Survey Savvy</h1>
            <h3 class="intro-text-sub">Create and Take Surveys</h3>
            <div class="intro-buttons">
                <a class="intro-btn btn-login" href="./login.php">Login</a>
                <a class="intro-btn btn-register" href="./register.php">Register</a>
            </div>

        </div>

    </div>
</body>

</html>