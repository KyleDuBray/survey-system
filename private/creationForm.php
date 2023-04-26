<!DOCTYPE html>
<html>

<head>
  <title>Create Survey</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" />
</head>

<body>
  <div class="create-survey-form">
    <div class="container">
      <h1>Create Survey</h1>
      <form id="create-survey-form" method="post" action="../includes/create-survey.inc.php">
        <div class="form-group">
          <label for="survey-name">Survey Name</label>
          <input type="text" id="survey-name" name="survey_name">
        </div>
        <div class="form-group">
          <label for="question-type">Question Type</label>
          <select id="question-type">
            <option value="text">Text</option>
            <option value="multiple_choice">Multiple Choice</option>
          </select>
        </div>
        <div class="form-group">
          <label for="question-text">Question Text</label>
          <input type="text" id="question-text">
        </div>
        <div class="form-group" id="options-group" style="display: none;">
          <label for="question-options">Question Options</label>
          <button type="button" id="add-option" class="btn">Add Option</button>
          <button type="button" id="remove-option" class="btn btn-danger" style="display: none;">Remove Option</button>
          <div id="options-container"></div>
        </div>
        <button type="button" id="add-question" class="btn">Add Question</button>
        <button type="submit" id="submit-survey" class="btn" style="display: none;">Submit Survey</button>
      </form>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      var questionCount = 1;
      var questionType;

      $('#question-type').on('change', function () {
        questionType = $(this).val();
        if (questionType == 'multiple_choice') {
          $('#options-group').show();
        } else {
          questionType = 'text';
          $('#options-group').hide();
        }
      });

      $('#add-option').on('click', function () {
        var optionCount = $('#options-container').children().length + 1;
        var optionHtml = '<div class="form-group option-group">';
        optionHtml += '<label for="option-' + optionCount + '">Option ' + String.fromCharCode(optionCount + 64) + '</label>';
        optionHtml += '<input type="text" id="option-' + optionCount + '">';
        optionHtml += '</div>';
        $('#options-container').append(optionHtml);
        if ($('#options-container').children().length > 1) {
          $('#remove-option').show();
        }
      });

      $('#remove-option').on('click', function () {
        $('#options-container').children().last().remove();
        if ($('#options-container').children().length == 1) {
          $('#remove-option').hide();
        }
      });

      $('#add-question').on('click', function () {
        var questionText = $('#question-text').val();
        var type = $('#question-type').val();
        console.log(questionCount);
        var questionHtml = '<div class="form-group question-group">';
        questionHtml += '<h2>Question ' + questionCount + ": " + questionText + '</h2>';
        questionHtml += '<input type="hidden" name="question_type[]" value="' + type + '">';
        questionHtml += '<input type="hidden" name="question_text[]" value="' + questionText + '">';
        var optionsHtml = '';
        if ($('#question-type').val() == 'multiple_choice') {
          var optionIndex = 1;
          $('.option-group input').each(function () {
            var optionLetter = String.fromCharCode(optionIndex + 64);
            optionsHtml += '<input type="hidden" name="question_options[]" value="' + $(this).val() + '">';
            optionsHtml += '<div class="form-group">';
            optionsHtml += '<div  id="option-' + questionCount + '-' + optionIndex + '" value="' + optionLetter + '">';
            optionsHtml += '<p id="option-' + questionCount + '-' + optionIndex + '">' + optionLetter + '.) ' + $(this).val() + '</label>';
            optionsHtml += '</div></div>';
            optionIndex++;
          });
          optionsHtml += '<input type="hidden" name="options_count[]" value="' + (optionIndex - 1) + '">';
        }
        else if ($('#question-type').val() == 'text') {
          //$('.option-group input').each(function () {
          optionsHtml += '<input type="hidden" name="question_options[]" value="NULL">';
          optionsHtml += '<input type="hidden" name="options_count[]" value="1">';
          //});
          //questionHtml += optionsHtml;
          /*
          questionHtml += '<div class="form-group">';
          questionHtml += '<label for="correct-answer-' + questionCount + '">Correct Answer:</label>';
          questionHtml += '<input type="text" id="correct-answer-' + questionCount + '" name="correct_answer_' + questionCount + '">';
          questionHtml += '</div>';
          */
          questionHtml += '</div>';
        }
        questionHtml += optionsHtml;
        questionHtml += '</div>';
        $('#create-survey-form').append(questionHtml);
        $('#submit-survey').show();
        questionCount++;
        $('#question-text').val('');
        $('#survey-name').prop('readonly', true);
      });

      /*
      $('#create-survey-form').on('submit', function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        // Send form data to server-side PHP script for processing and saving to database
        alert('Form data: ' + form_data);
        // Clear the form after submission
        $('#create-survey-form')[0].reset();
        $('#question-groups').empty();
        $('#submit-survey').hide();
        questionCount = 1;
        location.reload();
      });
      */
    });
  </script>
</body>

</html>