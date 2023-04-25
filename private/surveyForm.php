<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.php');
	exit;
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Survey</title>
	<link href="../css/test.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1>uForms</h1>
			<a href="../private/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="../includes/logout.inc.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content">
		<form id="surveyForm" action="">
		<!-- tabs modded by sql question no -->
		<!-- 2 current question types, mult choice & free response  -->
		<?php
			echo "<h3>Survey_title Here</h3>"; //get from db
			$limit = 2;//get count from db
			for ($i = 0; $i < $limit; $i++) { //limit is no. questions in survey
				$question_text = "Question text here";//will get this from db
				echo "<div class='tab'>",$question_text;
				$question_type = "Free Response"; //may also be Multiple Choice; from db
				//$question_type = "Multiple Choice";
				//switch for response type
				switch($question_type){
				case "Free Response":
  					echo "<p><input placeholder='Please Type Response' oninput='this.className = '''></p>";
					break;
				case "Multiple Choice":
					$option_limit = 5;//get count from db
					for ($j = 0; $j < $option_limit; $j++){
						$option_text = "an option";
						echo "<br><input type='radio' name =",$i," value='",$option_text,"' oninput='this.className = '''>",$option_text,"<br>";
						//name will probably change from '$i' with backend
					}
					break;
				default:
					echo "<p>ERROR: Question has NULL or non-existent response type.</p>";
				}
  				echo "</div>";
			}
		?>

		<div class="tab">Question test: <!-- remove this example when backend added-->
 			<br><input type="radio" name="choice" value="1">1<br>
			<input type="radio" value="2" oninput='this.className = ''>2<br>
			<input type="radio" value="3" oninput='this.className = ''>3<br>
			<input type="radio" value="4" oninput='this.className = ''>4<br>
			<input type="radio" value="5" oninput='this.className = ''>5
		</div>
		<div style="overflow:auto;">
  			<div style="float:right;">
    				<button type="button" id="prevButton" onclick="nextPrev(-1)">Previous</button>
    				<button type="button" id="nextButton" onclick="nextPrev(1)">Next</button>
  			</div>
		</div>
		<!-- steps modded by sql question no -->
		<div style="text-align:center;margin-top:40px;">
			<?php
			for ($i = 0; $i < $limit; $i++){
  				echo "<span class='step'></span>";}
  			echo "<span class='step'></span>";//remove with example later
			?>
		</div>
		</form>
		<!-- JavaScript to be moved or replaced if need be -->
		<script>
			var currentTab = 0; // Current tab is set to be first(0)
			displayTab(currentTab); // Display current tab

			function displayTab(n){//function displays a tab of the form, buttons, & step indicator
 				var x = document.getElementsByClassName("tab");
  				x[n].style.display = "block";
  				if (n == 0){
    					document.getElementById("prevButton").style.display = "none";
  				} 
				else{
    					document.getElementById("prevButton").style.display = "inline";
  				}
  				if (n == (x.length - 1)){
    					document.getElementById("nextButton").innerHTML = "Submit";
  				} 
				else{
    					document.getElementById("nextButton").innerHTML = "Next";
  				}
  				setStep(n);
			}

			function nextPrev(n){ //function finds which tab to display
  				var x = document.getElementsByClassName("tab");
  				//Exits function if any field in tab is invalid
  				if (n == 1 && !validateForm()) 
					return false;
  				//Hides the current tab
  				x[currentTab].style.display = "none";
  				// Increase or decrease tab no by 1:
  				currentTab = currentTab + n;
  				// if end is reached, submit
  				if (currentTab >= x.length){
    					document.getElementById("surveyForm").submit();
    					return false;
  				}
  				// Otherwise display correct tab:
  				displayTab(currentTab);
			}

			function validateForm(){ //function deals with validation of form fields
  				var x, y, i, valid = true;
  				x = document.getElementsByClassName("tab");
  				y = x[currentTab].getElementsByTagName("input");
  				//checks input field(s) in tab
  				for (i = 0; i < y.length; i++){
    					// If field is empty, invalidate
    					if (y[i].value == ""){
      						y[i].className += " invalid";
      						valid=false;
    					}
  				}
  			// If valid, mark step as finished and validated
  				if (valid){
    					document.getElementsByClassName("step")[currentTab].className += " finish";
  				}
  			return valid; // return the valid status
			}

			function setStep(n){ //sets correct status for step markers (circles at bottom of page)
  				var i, x = document.getElementsByClassName("step");
  				for (i = 0; i < x.length; i++){
    					x[i].className = x[i].className.replace(" active", "");
  				}
  				x[n].className += " active";
			}
		</script>
	</div>
</body>

</html>