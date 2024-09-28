<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: registration.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Details</h2><br>
        <p><strong>Name:</strong> <?php echo $_SESSION["name"]; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION["email"]; ?></p>
        <p><strong>Facebook URL:</strong> <?php echo $_SESSION["facebook"]; ?></p>
        <p><strong>Phone:</strong> <?php echo $_SESSION["phone"]; ?></p>
        <p><strong>Gender:</strong> <?php echo $_SESSION["gender"]; ?></p>
        <p><strong>Country:</strong> <?php echo $_SESSION["country"]; ?></p>
        <p><strong>Skills:</strong> <?php echo implode(", ", $_SESSION["skills"]); ?></p>
        <p><strong>Biography:</strong> <?php echo $_SESSION["bio"]; ?></p>
    </div>
</body>
</html>
