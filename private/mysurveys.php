<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header("location: ../public/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Surveys</title>
    <link href="../css/private.mysurveys.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php
    include "../shared/navbar.php";
    ?>
    <div class="surveys-container">
        <h1>My Surveys</h1>
        <?php
        require_once '../includes/dbc.inc.php';
        // get id of logged in user
        $user_id = $_SESSION['id'];

        $sql_get_surveys = "SELECT * FROM survey WHERE creator_id = " . $user_id;
        $result = mysqli_query($conn, $sql_get_surveys);
        while ($row = mysqli_fetch_assoc($result)) //Get row from database table
        {
            echo "<br>";
            createSurveyLink($row['survey_id'], $row['title']);
            echo "<br>";
        }

        function createSurveyLink($id, $title)
        {
            echo "<a href='./surveystats.php?survey_id=" . $id . "'>" . $title . "</a>";
        }
        ?>

    </div>

</body>

</html>