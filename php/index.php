<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
    <?php
    require '../vendor/autoload.php';

    // Get config from .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
    $DB_USER     = $_ENV['DB_USER'];
    $DB_PASSWORD = $_ENV['DB_PASSWORD'];
    $DB_HOST     = $_ENV['DB_HOST'];
    $DB_PORT     = $_ENV['DB_PORT'];
    $DB_NAME     = $_ENV['DB_NAME'];

    echo "Hello there" . "<br>";


    $host     = $DB_HOST . ":" . $DB_PORT;
    $username = $DB_USER;
    $password = $DB_PASSWORD;
    $database = $DB_NAME;

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
</body>

</html>