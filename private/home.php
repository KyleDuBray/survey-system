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
<html>

<head>
	<meta charset="utf-8">
	<title>Home Page</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link href="../css/private.home.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php include "../shared/navbar.php" ?>
	<div class="content">
		<h2>Welcome,
			<?php echo $_SESSION['username'] ?>!
		</h2>
	</div>
	<div class="home-links">
		<a href="./browsesurveys.php" class="home-link">
			<div class="home-link-container">
				<h3>Browse Surveys</h3>
				<div class="icon-container">
					<img src="../img/clipboard-take-survey.svg">
				</div>
				<p>Pick from a list of surveys available for the taking</p>
			</div>
		</a>
		<a href="./creationForm.php" class="home-link">
			<div class="home-link-container">
				<h3>Create a Survey</h3>
				<div class="icon-container">
					<img src="../img/clipboard-create-survey.svg">
				</div>
				<p>Create a new custom survey</p>
			</div>
		</a>
		<a href="./mysurveys.php" class="home-link">
			<div class="home-link-container">
				<h3>My Surveys</h3>
				<div class="icon-container">
					<img src="../img/clipboard-my-surveys.svg">
				</div>
				<p>View statistics for your created surveys</p>
			</div>
		</a>
	</div>
</body>

</html>