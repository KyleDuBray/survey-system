<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Surveys</title>
</head>

<body>
    <h1>My Surveys</h1>
    <?php
    require_once '../includes/dbc.inc.php';
    session_start();

    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header("location: ../public/login.php");
        exit;
    }
    // get id of logged in user
    $user_id = $_SESSION['id'];

    $sql_get_surveys = "SELECT * FROM survey WHERE creator_id = " . $user_id;
    $result = mysqli_query($conn, $sql_get_surveys);
    while ($row = mysqli_fetch_assoc($result)) //Get row from database table
    {
        echo "<br>";
        echo $row['title'];
        echo "<br>";
    }
    ?>
</body>

</html>