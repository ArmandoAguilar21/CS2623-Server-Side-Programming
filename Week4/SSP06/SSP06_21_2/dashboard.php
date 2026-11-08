// dashboard.php — protected page
<?php
require 'auth.php'; // redirects if not logged in 
declare(strict_types=1);
require 'auth.php'; // redirects if not logged in
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><title>Dashboard</title></head>
<body>
<h1>Welcome, <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>!</h1>
<p>Logged in at: <?= date('g:i A', $_SESSION['login_at']) ?></p>
<a href="logout.php">Log out</a>
<br>
<a href="profile.php">View Profile</a>
</body></html>
