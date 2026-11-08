<?php 
declare(strict_types=1);

// auth.php — include in every protected page
session_start();
if (!isset($_SESSION['user'])) {
 header('Location: login.php');
 exit;
}
?>