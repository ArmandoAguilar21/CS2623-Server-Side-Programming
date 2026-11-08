// login.php (self-processing)
<?php declare(strict_types=1);
session_start();
// Simulated user store — in production this is a DB query
$users = [
 'admin' => password_hash('secret123', PASSWORD_DEFAULT),
 'jsmith' => password_hash('php4life!', PASSWORD_DEFAULT),
];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS)
?? '';
 $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT) ??
'';
 if (isset($users[$username]) && password_verify($password, $users[$username])) {
 session_regenerate_id(true); // ← prevents session fixation
 $_SESSION['user'] = $username;
 $_SESSION['login_at'] = time();
 header('Location: dashboard.php');
 exit;
 } else {
 $error = 'Invalid username or password.';
 }
}
?>
<!DOCTYPE html><html lang="en">
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
<h1>Login</h1>
<?php if ($error): ?>
 <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<form method="post">
 <label>Username: <input type="text" name="username"
autocomplete="username"></label><br>
 <label>Password: <input type="password" name="password" autocomplete="currentpassword"></label><br>
 <button type="submit">Log in</button>
</form>
</body></html>
