<?php
declare(strict_types=1);

require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>

<h1>User Profile</h1>

<p>
    Username:
    <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>
</p>

<a href="dashboard.php">Back to Dashboard</a>
<br>
<a href="logout.php">Log Out</a>

</body>
</html>