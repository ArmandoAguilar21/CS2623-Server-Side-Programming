<?php declare(strict_types=1);
$dataDir = __DIR__ . '/data/';
$logFile = $dataDir . 'log.txt';
$message = '';
$fileContent = '';
// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
 mkdir($dataDir, 0755, true);
}
// Handle form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = filter_input(INPUT_POST, 'action') ?? 'save';

    // Clear Log
    if ($action === 'clear') {
        file_put_contents($logFile, '');
        chmod($logFile, 0644);
        $message = 'Log cleared.';
    }
    // Save Entry
    else {
        $entry = filter_input(INPUT_POST, 'entry', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $entry = trim($entry);

        if ($entry !== '') {
            $now = new DateTime('now', new DateTimeZone('America/Chicago'));
            $line = $now->format('Y-m-d H:i:s') . ' — ' . $entry . PHP_EOL;

            file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
            chmod($logFile, 0644);

            $message = 'Entry saved.';
        } else {
            $message = 'Entry cannot be empty.';
        }
    }
}
// Read log file
if (file_exists($logFile)) {
 $fileContent = file_get_contents($logFile);
}
// Download Log
if (isset($_GET['download']) && file_exists($logFile)) {

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="log.txt"');

    readfile($logFile);
    exit;
}
// List files in data directory
$files = array_filter(
 scandir($dataDir),
 fn($f) => is_file($dataDir . $f)
);
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Ex 16-1 File I/O</title></head>
<body>
<h1>File Log Demo</h1>
<?php if ($message): ?>
 <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<form method="post">
 <label>New log entry:
 <input type="text" name="entry" maxlength="200">
 </label>
 <button type="submit" name="action" value="save">Save Entry</button>
 <button type="submit" name="action" value="clear">Clear Log</button>
</form>
<h2>Download Log</h2>
<a href="?download=1">Download log File</a>
<h2>Log Contents</h2>
<?php if (file_exists($logFile)): ?>
    <p>
        File Size:
        <?= number_format(filesize($logFile)) ?> bytes
    </p>
<?php endif; ?>
<?php if ($fileContent !== ''): ?>
 <pre><?= htmlspecialchars($fileContent, ENT_QUOTES, 'UTF-8') ?></pre>
<?php else: ?>
 <p>No entries yet.</p>
<?php endif; ?>
<h2>Files in /data/</h2>
<ul>
<?php foreach ($files as $f): ?>
 <li><?= htmlspecialchars(basename($f), ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
</ul>
</body></html>
