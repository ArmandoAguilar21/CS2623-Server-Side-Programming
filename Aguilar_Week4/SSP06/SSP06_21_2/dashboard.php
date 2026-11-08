<?php
declare(strict_types=1);
date_default_timezone_set('America/Chicago');
require 'auth.php'; // redirects if not logged in
?>

<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><title>Dashboard</title></head>
<body>
<h1>Welcome, <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>!</h1>
<p>Current time: <?= date('g:i A') ?></p>
<a href="logout.php">Log out</a>
<br>
<a href="profile.php">View Profile</a>
<br>
<a href="../SSP06_23_1/index.php">Go to Guitar Shop</a>
</body></html>
