<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="../css/public.register.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <?php include "../shared/navbar.php"; ?>
  <div class="register-container">
    <section class="register">
      <h2 class="register-heading">Register</h2>
      <form class="register-form" action="../includes/register.inc.php" method="post">
        <input class="register-form-input" type="text" name="username" placeholder="Username..." />
        <input class="register-form-input" type="text" name="email" placeholder="Email..." />
        <input class="register-form-input" type="password" name="password" placeholder="Password..." />
        <input class="register-form-input" type="password" name="confirmpassword" placeholder="Confirm Password..." />
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
        <button class="register-form-submit" type="submit" name="submit">Register</button>
      </form>

    </section>
  </div>


</body>

</html>