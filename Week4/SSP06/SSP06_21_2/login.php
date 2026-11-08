<?php 
declare(strict_types=1);
session_start();
// Simulated user store — in production this is a DB query
$_SESSION['attempts'] = $_SESSION['attempts'] ?? 0;
$users = [
 'admin' => password_hash('secret123', PASSWORD_DEFAULT),
 'jsmith' => password_hash('php4life!', PASSWORD_DEFAULT),
];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_SESSION['attempts'] >= 3) {
        $error = 'Account locked due to too many failed login attempts.';
    } else {

        $username = filter_input(
            INPUT_POST,
            'username',
            FILTER_SANITIZE_SPECIAL_CHARS
        ) ?? '';

        $password = filter_input(
            INPUT_POST,
            'password',
            FILTER_DEFAULT
        ) ?? '';

        if (
            isset($users[$username]) &&
            password_verify($password, $users[$username])
        ) {
            session_regenerate_id(true);

            $_SESSION['user'] = $username;
            $_SESSION['login_at'] = time();
            $_SESSION['attempts'] = 0;

            if (isset($_POST['remember'])) {
                setcookie('remember_username', $username, [
                    'expires' => time() + (30 * 24 * 60 * 60),
                    'path' => '/',
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]);
            } else {
                setcookie('remember_username', '', [
                    'expires' => time() - 3600,
                    'path' => '/',
                ]);
            }

            header('Location: dashboard.php');
            exit;

        } else {
            $_SESSION['attempts']++;
            $error = 'Invalid username or password.';
        }
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
 <label>Username: 
    <input  type="text" 
            name="username"
            value="<?= htmlspecialchars($_COOKIE['remember_username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
            autocomplete="username">    
</label><br>
 <label>Password: <input type="password" name="password" autocomplete="currentpassword"></label><br>
 <label>
    <input type="checkbox" name="remember" value="yes"> 
    Remember me
</label><br>
 <button type="submit">Log in</button>
</form>
</body></html>
