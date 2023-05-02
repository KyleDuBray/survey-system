<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
   <link href="../css/register.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" />
</head>

<body>
  <div class="register">
  <section>
    <h1>Register</h1>
    <form action="../includes/register.inc.php" method="post">
      <input type="text" name="username" placeholder="Username..." />
      <input type="text" name="email" placeholder="Email..." />
      <input type="password" name="password" placeholder="Password..." />
      <input type="password" name="confirmpassword" placeholder="Confirm Password..." />
      <button type="submit" name="submit">Register</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
      switch ($_GET["error"]) {
        case "emptyinput":
          echo "<p class=error>Please fill in all fields.</p>";
          break;
        case "invalidusername":
          echo "<p class=error>Please provide a valid username.</p>";
          break;
        case "invalidemail":
          echo "<p class=error>Please provide a valid email.</p>";
          break;
        case "passwordsdontmatch":
          echo "<p class=error>Please make sure passwords match.</p>";
          break;
        case "userexists":
          echo "<p class=error>Invalid username or email provided.</p>";
          break;
        default:
          break;
      }
    }
    ?>
</div>

</body>

</html>