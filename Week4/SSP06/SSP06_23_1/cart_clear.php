<?php
declare(strict_types=1);

session_start();

// Remove all cart contents
unset($_SESSION['cart']);

// Redirect back to the product catalog
header('Location: index.php');
exit;
?>