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
</head>

<body>
	<?php include "../shared/navbar.php" ?>
	<div class="content">
		<h2>Welcome,
			<?php echo $_SESSION['username'] ?>!
		</h2>
	</div>
</body>

</html>