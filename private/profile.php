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
<html>

<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="loggedin">
	<?php include "../shared/navbar.php" ?>
	<div class="content">
		<h2>Profile Page</h2>
		<div>
			<p>Your account details are below:</p>
			<table>
				<tr>
					<td>Username:</td>
					<td>
						<?php echo $_SESSION['username'] ?>
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td>
						<?php echo $_SESSION['password'] ?>
					</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>
						<?php echo $_SESSION['email'] ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>