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
	 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profile Page</title>
	<link href="../css/profile.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" />
</head>

<body>
	 <div style="text-align: center;">
	 <div class="profile">
			<h1>uForms</h1>
			<a href="../private/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
 			<a href="../includes/logout.inc.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		<h1>Profile Page</h1>
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