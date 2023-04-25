<?php
/*
if (!isset($_POST['submit'])) {
header("location: ../public/login.php");
}
*/
require_once 'dbc.inc.php';
require_once 'functions.inc.php';

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