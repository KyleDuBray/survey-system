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
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Home Page</title>
	<link href="../css/home.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" />

</head>

<body>
	 <div class="home">
	
		
			<h1>uForms</h1>
			<a href="../private/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="../includes/logout.inc.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		
	
	
		<h1>Welcome</h1>
		<p>Hello
			<?php echo $_SESSION['username'] ?>!
		</p>
	</div>
</body>

</html>