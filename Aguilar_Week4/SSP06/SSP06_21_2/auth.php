<?php 
declare(strict_types=1);
session_start();
if (!isset($_SESSION['user'])) {
 header('Location: ../SSP06_21_2/login.php');
 exit;
}
?>