<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header("location: ../public/login.php");
    exit;
}

require_once 'dbc.inc.php';
require_once 'functions.inc.php';

//echo var_dump($_POST);
//echo var_dump($_SESSION);

foreach ($_POST as $key => $value) {

    $qID = $key;
    $textresp = $value;
    $sID = $_SESSION['surveyid'];
    $uID = $_SESSION['id'];

    $query = "SELECT option_type FROM question_option WHERE question_id ='" . $qID . "'";
    $question_type = getDataElement($conn, $query);

    if ($question_type == 'free-response') {
        $query2 = "SELECT option_id FROM question_option WHERE question_id ='" . $qID . "'";
        $oID = getDataElement($conn, $query2);
    } else {
        $query3 = "SELECT option_id FROM question_option WHERE question_id ='" . $qID . "' AND option_text = '" . $textresp . "'";
        $oID = getDataElement($conn, $query3);
    }
    echo "surveyID = {$sID}<br>questionID = {$qID}<br>optionID = {$oID}<br>userID = {$uID}<br>response text = {$textresp}<br><br><br>";

    $response_stmt = "INSERT INTO response(survey_id, question_id, option_id, user_id, response_text) 
VALUES('$sID', '$qID', '$oID', '$uID', '$textresp')";
    $conn->query($response_stmt);

    //echo "{$question_type}<br>";
}

function getDataElement($conn, $sql)
{ //get an element of data by performing a query on db			
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_row($result)) {
        foreach ($row as $value)
            return $value;
    }
}
