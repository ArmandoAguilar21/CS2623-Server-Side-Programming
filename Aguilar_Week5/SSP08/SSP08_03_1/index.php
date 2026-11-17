<?php
declare(strict_types=1);
// ── Functions (return values; never echo directly) ─────────────
function fn_fizzbuzz(int $n): string {
 if ($n % 15 === 0) return 'FizzBuzz';
 elseif ($n % 3 === 0) return 'Fizz';
 elseif ($n % 5 === 0) return 'Buzz';
 else return (string)$n;
}
function fn_dayOfWeek(int $dow): string {
 // MUST use if/elseif — do NOT use match() for this exercise
 if ($dow === 0) return 'Sunday';
 elseif ($dow === 1) return 'Monday';
 elseif ($dow === 2) return 'Tuesday';
 elseif ($dow === 3) return 'Wednesday';
 elseif ($dow === 4) return 'Thursday';
 elseif ($dow === 5) return 'Friday';
 else return 'Saturday';
}
function fn_gradeLabel(int $score): string {
 // MUST use switch — do NOT use match() for this exercise
 switch (true) {
 case $score >= 90: return 'A';
 case $score >= 80: return 'B';
 case $score >= 70: return 'C';
 case $score >= 60: return 'D';
 default: return 'F';
 }
}
// ── POST handling ───────────────────────────────────────────────
$start = (int)(filter_input(INPUT_POST, 'start', FILTER_VALIDATE_INT) ?? 1);
$end = (int)(filter_input(INPUT_POST, 'end', FILTER_VALIDATE_INT) ?? 20);
$score = (int)(filter_input(INPUT_POST, 'score', FILTER_VALIDATE_INT) ?? -1);

//Count Down section
$word = trim(filter_input(INPUT_POST, 'word') ?? '');
$repeatCount = (int)(filter_input(INPUT_POST, 'repeatCount', FILTER_VALIDATE_INT) ?? 1);

if ($start < 1) $start = 1;
if ($end > 100) $end = 100;

if ($repeatCount < 1) $repeatCount = 1;
if ($repeatCount > 20) $repeatCount = 20;

$rangeError = ($start > $end);
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Ex 03-1 Control Structures</title></head>
<body>
<h1>Control Structures Demo</h1>
<!-- Form -->
<form method="post">
 <label>Start: <input type="number" name="start" min="1" max="100"
 value="<?= (int)$start ?>"></label>
 <label>End: <input type="number" name="end" min="1" max="100"
 value="<?= (int)$end ?>"></label>
 <label>Score (0-100): <input type="number" name="score" min="0" max="100"
 value="<?= ($score >= 0 ? (int)$score : '') ?>"></label>
 <label>Word: <input type="text" name="word" value="<?= htmlspecialchars($word, ENT_QUOTES, 'UTF-8') ?>"></label>
 <label>Repeat Count: <input type="number" name="repeatCount" min="1" max="20" value="<?= (int)$repeatCount ?>"></label>
 <button type="submit">Run</button>
</form>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<?php if ($rangeError): ?>
    <p style="color:red;">Error: Start value must be less than or equal to End value.</p>
<?php else: ?>

<h2>FizzBuzz (for loop, <?= (int)$start ?>–<?= (int)$end ?>)</h2>
<ul>
<?php for ($i = $start; $i <= $end; $i++): ?>
 <li><?= htmlspecialchars(fn_fizzbuzz($i), ENT_QUOTES, 'UTF-8') ?></li>
<?php endfor; ?>
</ul>
<h2>Day Names (while loop)</h2>
<ul>
<?php $d = 0; while ($d <= 6): ?>
 <li><?= htmlspecialchars(fn_dayOfWeek($d), ENT_QUOTES, 'UTF-8') ?></li>
<?php $d++; endwhile; ?>
</ul>
<h2>Grade Lookup (switch)</h2>
<?php if ($score >= 0): ?>
 <p>Score <?= (int)$score ?>:
 Grade <strong><?= htmlspecialchars(fn_gradeLabel($score), ENT_QUOTES, 'UTF8') ?></strong>
 </p>
<?php endif; ?>
<h2>Multiplication Table (do-while)</h2>
<table border="1">
<?php $row = 1; do { ?>
 <tr>
 <?php $col = 1; do { ?>
 <td><?= (int)$row * (int)$col ?></td>
 <?php $col++; } while ($col <= 5); ?>
 </tr>
<?php $row++; } while ($row <= 5); ?>
</table>

<h2>Count Down (do-while)</h2>
<ul>
<?php
$count = $end;
do {
?>
    <li><?= (int)$count ?></li>
<?php
    $count--;
} while ($count >= $start);
?>
</ul>

<h2>Repeat Word (while loop)</h2>
<ul>
<?php
$repeat = 0;

while ($repeat < $repeatCount):
?>
    <li><?= htmlspecialchars($word, ENT_QUOTES, 'UTF-8') ?></li>
<?php
    $repeat++;
endwhile;
?>
</ul>
<?php endif; ?>
<?php endif; ?>
</body></html>
