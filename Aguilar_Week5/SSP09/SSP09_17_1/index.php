<?php declare(strict_types=1);
$tz = new DateTimeZone('America/Chicago'); // Apollo UTC fix
// ── POST data ──────────────────────────────────────────────────
$inputText = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS) ??
'';
$inputNum = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT) ??
0.0;
$searchFor = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ??
'';
// ── String operations ──────────────────────────────────────────
$lower = strtolower($inputText);
$upper = strtoupper($inputText);
$trimmed = trim($inputText);
$length = strlen($trimmed);
$contains = $searchFor !== '' ? str_contains(strtolower($trimmed),
strtolower($searchFor)) : null;
$startsWith = $searchFor !== '' ? str_starts_with(strtolower($trimmed),
strtolower($searchFor)) : null;
$endsWith = $searchFor !== '' ? str_ends_with(strtolower($trimmed),
strtolower($searchFor)) : null;
$wordCount = $trimmed === '' ? 0 : count(explode(' ', $trimmed));
$vowelsReplaced = str_replace(
    ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'],
    '*',
    $trimmed
);
$firstTen = substr($trimmed, 0, 10);
// ── Number operations ──────────────────────────────────────────
$formatted = number_format((float)$inputNum, 2);
$currency = '$' . $formatted;
$randNum = random_int(1, 100); // secure; never use rand()
$rounded = round((float)$inputNum, 0);
$ceiling = (int)ceil((float)$inputNum);
$paddedAmount = sprintf('%10.2f', (float)$inputNum);
// ── Date operations ────────────────────────────────────────────
$now = new DateTime('now', $tz);
$formatted_date = $now->format('l, F j, Y'); // e.g. Saturday, October 10,
2026
$formatted_time = $now->format('g:i:s A T'); // e.g. 11:45:30 PM CDT
$tomorrow = (new DateTime('tomorrow', $tz))->format('Y-m-d');
$daysUntilXmas = (new DateTime('now', $tz))->diff(new DateTime('December 25', $tz))-
>days;
$yearStart = new DateTime($now->format('Y') . '-01-01', $tz);

$daysSinceNewYear = date_diff($yearStart, $now)->days;
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Ex 17-1 Strings, Numbers & Dates</title></head>
<body>
<h1>String, Number & Date Functions</h1>
<form method="post">
 <label>Enter text:<br>
 <input type="text" name="text" size="40"
 value="<?= htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8') ?>">
 </label><br>
 <label>Search within text:
 <input type="text" name="search" size="20"
 value="<?= htmlspecialchars($searchFor, ENT_QUOTES, 'UTF-8') ?>">
 </label><br>
 <label>Dollar amount:
 <input type="number" step="0.01" name="amount"
 value="<?= htmlspecialchars((string)$inputNum, ENT_QUOTES, 'UTF-8')
?>">
 </label><br>
 <button type="submit">Analyze</button>
</form>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<h2>String Results</h2>
<ul>
 <li>Original: <?= htmlspecialchars($inputText, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Lowercase: <?= htmlspecialchars($lower, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Uppercase: <?= htmlspecialchars($upper, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Trimmed length: <?= (int)$length ?> characters</li>
 <li> Vowel-replaced: <?= htmlspecialchars($vowelsReplaced, ENT_QUOTES, 'UTF-8') ?></li>
 <li>First 10 characters: <?= htmlspecialchars($firstTen, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Word count: <?= (int)$wordCount ?></li>
 <?php if ($contains !== null): ?>
 <li>Contains "<?= htmlspecialchars($searchFor, ENT_QUOTES, 'UTF-8') ?>": <?=
$contains ? 'Yes' : 'No' ?></li>
 <li>Starts with it: <?= $startsWith ? 'Yes' : 'No' ?></li>
 <?php endif; ?>
</ul>
<h2>Number Results</h2>
<ul>
 <li>Formatted: <?= htmlspecialchars($currency, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Rounded: <?= number_format((float)$rounded, 0) ?></li>
 <li>Ceiling: <?= (int)$ceiling ?></li>
 <li>Random (1-100): <?= (int)$randNum ?></li>
 <li>Padded: <?= htmlspecialchars($paddedAmount, ENT_QUOTES, 'UTF-8') ?></li>
</ul>
<?php endif; ?>
<h2>Date & Time (US Central / Apollo-safe)</h2>
<ul>
 <li>Today: <?= htmlspecialchars($formatted_date, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Time: <?= htmlspecialchars($formatted_time, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Tomorrow: <?= htmlspecialchars($tomorrow, ENT_QUOTES, 'UTF-8') ?></li>
 <li>Days until Christmas: <?= (int)$daysUntilXmas ?></li>
<li>Days since New Year: <?= (int)$daysSinceNewYear ?></li>
</ul>
</body></html>