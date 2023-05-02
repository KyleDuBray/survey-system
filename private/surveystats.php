<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../public/home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Stats</title>
    <link href="../css/private.surveystats.css" rel="stylesheet" type="text/css">
</head>

<body>

    <?php
    include "../shared/navbar.php";
    require_once '../includes/dbc.inc.php';



    // get id of logged in user
    $user_id = $_SESSION['id'];
    $survey_id = $_GET['survey_id'];

    $sql_get_title = "SELECT title FROM survey WHERE survey_id = " . $survey_id;
    $titleRes = mysqli_query($conn, $sql_get_title);
    $title = mysqli_fetch_assoc($titleRes);

    echo "<h1>" . $title["title"] . " Results</h1>";
    echo "<div class='stats-container'>";

    $sql_get_questions = "SELECT * FROM question
    INNER JOIN question_option on question.question_id = question_option.question_id
    WHERE survey_id = " . $survey_id . " ORDER BY question.question_id ASC, option_id ASC";

    $result = mysqli_query($conn, $sql_get_questions);

    $curQuestionId = -1;
    $newQuestion = true;
    $inMultipleChoice = false;
    while ($row = mysqli_fetch_assoc($result)) //Get row from database table
    {
        // if current question not set to current row question id-
        // - set curQuestionId to the question_id of current row
        // - set newQuestion to true, so we know to write the new question
        if ($curQuestionId !== $row['question_id']) {
            $curQuestionId = $row['question_id'];
            $newQuestion = true;

            // end multiple choice options in case we were listing them
            if ($inMultipleChoice === true) {
                echo "</ul>";
                $inMultipleChoice = false;
            }
        }

        // if we are on a new question-
        // - write the question text
        // - set newQuestion to false
        if ($newQuestion) {
            echo "<h3>" . $row['question_text'] . "</h3>";
            $newQuestion = false;
        }

        // if this is a free response question-
        // - list all responses (later will need to change to only certain amount, with ability to view more)
        // - set newQuestion to true
        if ($row['response_type'] === "free-response") {
            echo "<ul>";
            $responses = getFreeResponses($conn, $survey_id, $curQuestionId);
            // list free responses
            while ($res = mysqli_fetch_assoc($responses)) {
                echo "<li>" . $res['response_text'] . "</li>";
            }
            echo "</ul>";
            $newQuestion = true;
        }
        // else if this is a multiple choice question
        elseif ($row['response_type'] === "multiple-choice") {
            if ($inMultipleChoice === true) {
                echo "<li>" . $row["option_text"];
            } else { // otherwise, need to start listing of options
                echo "<ul>";
                echo "<li>" . $row["option_text"];
                $inMultipleChoice = true;
            }

            // append response count for option
            $optionResult = getMultipleChoiceResponses($conn, $survey_id, $curQuestionId, $row['option_id']);
            $optionCount = mysqli_fetch_assoc($optionResult);

            echo " - " . $optionCount["option_count"] . "</li>";
        }
        echo "<br>";
    }

    echo "</div>";


    function getFreeResponses($conn, $survey_id, $question_id)
    {

        // SQL statement
        $sql_get_responses = "SELECT * FROM response WHERE survey_id = " . $survey_id
            . " AND question_id = " . $question_id;

        // Run Query
        $result = mysqli_query($conn, $sql_get_responses);

        // Return array of responses
        return $result;
    }

    function getMultipleChoiceResponses($conn, $survey_id, $question_id, $option_id)
    {
        // SQL statement
        $sql_get_responses = "SELECT COUNT(*) AS option_count FROM response WHERE survey_id = " . $survey_id .
            " AND question_id = " . $question_id . " AND option_id = " . $option_id;

        // Run Query
        $result = mysqli_query($conn, $sql_get_responses);

        // Return array of responses
        return $result;
    }

    ?>
</body>

</html>