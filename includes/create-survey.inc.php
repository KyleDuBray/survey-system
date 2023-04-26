<?php
/*
if (!isset($_POST['submit'])) {
header("location: ../public/login.php");
}
*/
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header("location: ../public/login.php");
    exit;
}

require_once 'dbc.inc.php';
require_once 'functions.inc.php';

// USER ID
$user_id = $_SESSION['id'];

// SURVEY TITLE
$survey_title = $_POST['survey_name'];

// NUMBER OF QUESTIONS IN SURVEY
//$num_questions = $_POST['num_questions'];

// ARRAY OF QUESTION TYPES IN ORDER (either "multiple_choice" or "text")
$question_types = $_POST['question_type'];

// ARRAY OF QUESTIONS IN ORDER
$question_texts = $_POST['question_text'];

// ARRAY OF RESPONSE OPTIONS IN ORDER- USE $option_count_for_question
//  TO DETERMINE WHEN TO STOP LISTING OPTIONS FOR GIVEN QUESTION
$question_options = $_POST['question_options'];
$option_count_for_question = $_POST['options_count'];

echo $survey_title;
echo "<br>";
$questionIndex = 0;
$optionsIndex = 0;
// loop through all questions
foreach ($question_texts as $text) {
    // output question text
    echo $text;
    echo "<br>";
    // if current questions is of multiple choice type
    if ($question_types[$questionIndex] === "multiple_choice") {
        // print current option and incremement for next one
        // until all options for current question are listed
        for (
            $i = $optionsIndex, $j = $optionsIndex;
            $i < $j + intval($option_count_for_question[$questionIndex]);
            $i++
        ) {
            echo $question_options[$i];
            echo "<br>";
            $optionsIndex++;
        }
        // otherwise, only increment options index
    } else {
        $optionsIndex++;
    }
    // increment question index
    $questionIndex++;
}

createSurvey(
    $conn,
    $user_id,
    $survey_title,
    $question_types,
    $question_texts,
    $question_options,
    $option_count_for_question
);

function createSurvey(
    $conn,
    $user_id,
    $survey_title,
    $question_types,
    $question_texts,
    $question_options,
    $option_count_for_question
) {
    // Insert Survey
    $sql_insert_survey = "INSERT INTO survey(creator_id, title) VALUES(?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql_insert_survey)) {
        header("location: ../public/creationForm.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $user_id, $survey_title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $survey_id = mysqli_insert_id($conn);


    $sql_insert_question = "INSERT INTO question(survey_id, question_text, response_type)
    VALUES(?, ?, ?);";

    $sql_insert_option = "INSERT INTO question_option(question_id, option_type, option_text)
    VALUES(?, ?, ?);";

    // Insert Questions
    $questionIndex = 0;
    $optionsIndex = 0;

    // Start SQL Statements
    $stmt_insert_question = $conn->prepare("INSERT INTO question(survey_id, question_text, response_type) 
VALUES(?, ?, ?);");

    $stmt_insert_option = $conn->prepare("INSERT INTO question_option(question_id, option_type, option_text) 
VALUES(?,?,?);");

    $current_question_type = "";
    // loop through all questions
    foreach ($question_texts as $text) {
        // maintain consistency in reponse type insertions
        if ($question_types[$questionIndex] === "multiple_choice") {
            $current_question_type =  "multiple-choice";
        } else {
            $current_question_type = "free-response";
        }
        // insert question
        $stmt_insert_question->bind_param('sss', $survey_id, $text, $current_question_type);
        $stmt_insert_question->execute();

        // Get inserted question ID
        $question_id = $conn->insert_id;
        // if current questions is of multiple choice type
        if ($question_types[$questionIndex] === "multiple_choice") {
            // insert each option
            for (
                $i = $optionsIndex, $j = $optionsIndex;
                $i < $j + intval($option_count_for_question[$questionIndex]);
                $i++
            ) {
                $stmt_insert_option->bind_param('sss', $question_id, $current_question_type, $question_options[$i]);
                $stmt_insert_option->execute();
                $optionsIndex++;
            }
            // otherwise, only increment options index
        } else {
            $stmt_insert_option->bind_param('sss', $question_id, $current_question_type, $question_options[$optionsIndex]);
            $stmt_insert_option->execute();
            $optionsIndex++;
        }
        // increment question index
        $questionIndex++;
    }

    $conn->close();
}
