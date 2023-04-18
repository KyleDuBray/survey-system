<!DOCTYPE html>
<html>
	<head>
				<title></title>
	</head>
	<body>
			<?php

			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "phplogin";

      $conn = mysqli_connect($servername, $username, $password, $database);

      if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_errno());
      }

      if (!isset($_POST['username'], $_POST['password'])) {
        exit('Both username and password are required fields');
      }

      if ($stmt = $conn->prepare('SELECT ID, Password FROM accounts WHERE Username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
          $stmt->bind_result($id, $password);
          $stmt->fetch();

          if ($_POST['password'] === $password) {
            session_start();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('location: home.php');
          }
          else {
            echo "Incorrect username/password";
          }
        }
        else {
          echo "Incorrect username/password";
        }

        $stmt->close();
      }










      ?>
  </body>
</html>
