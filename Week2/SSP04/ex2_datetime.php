<?php
declare(strict_types=1);
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$today_name = $now->format('l'); // e.g. "Tuesday"
$today_date = $now->format('F j, Y'); // e.g. "October 10, 2026"
$today_time = $now->format('g:i:s A'); // e.g. "2:35:04 PM"
echo '<p>Today is: ' . htmlspecialchars($today_name . ', ' . $today_date,
ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p>Current time (America/Chicago): ' . htmlspecialchars($today_time, ENT_QUOTES,
'UTF-8') . '</p>';

// Countdown to semester end (adjust date as needed)
$end_date = new DateTime('2026-12-15', $tz);
$interval = $now->diff($end_date);
$days_left = $interval->days;
echo '<p>Days until semester end: ';
echo htmlspecialchars((string)$days_left, ENT_QUOTES, 'UTF-8');
echo ' days</p>';

// Parse a date string with createFromFormat()
$birth_str = '1998-06-04'; // Change to your own birthdate
$birth_date = DateTime::createFromFormat('Y-m-d', $birth_str, $tz);
$birthdate_errors = DateTime::getLastErrors();
if (
    $birth_date === false
    || ($birthdate_errors !== false
        && ($birthdate_errors['warning_count'] > 0 || $birthdate_errors['error_count'] > 0))
) {
    throw new RuntimeException('Birthdate could not be parsed. Use the YYYY-MM-DD format.');
}

$age_interval = $birth_date->diff($now);
echo '<p>Age in years: ' . htmlspecialchars((string)$age_interval->y,
ENT_QUOTES, 'UTF-8') . '</p>';
echo '<p>Age in days: ' . htmlspecialchars((string)$age_interval->days,
ENT_QUOTES, 'UTF-8') . '</p>';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSP04 - String Functions</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <h1>SSP04 — String Functions & Date/Time</h1>
    </header>

    <main>
       
<h2>Date/Time Function Results</h2>
<p>
    Current Date and Time: <?php echo htmlspecialchars($today_name . ', ' . $today_date . ' ' . $today_time, ENT_QUOTES, 'UTF-8'); ?>
</p>

<table>
    <thead>
        <tr>
            <th>Task</th>
            <th>Output</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>DateTimeZone('America/Chicago') used</td>
            <td><?php echo htmlspecialchars($today_name . ', ' . $today_date . ' ' . $today_time, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>Current Day</td>
            <td><?php echo htmlspecialchars($today_name, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>Time Since Birthday</td>
            <td><?php echo htmlspecialchars((string)$age_interval->y, ENT_QUOTES, 'UTF-8'); ?> years, <?php echo htmlspecialchars((string)$age_interval->m, ENT_QUOTES, 'UTF-8'); ?> months, <?php echo htmlspecialchars((string)$age_interval->d, ENT_QUOTES, 'UTF-8'); ?> days</td>
        </tr>

        <tr>
            <td>Days Until Semester End</td>
            <td><?php echo htmlspecialchars((string)$days_left, ENT_QUOTES, 'UTF-8'); ?> days</td>
        </tr>
        <tr>
            <td>Birthdate Parsed</td>
            <td><?php echo htmlspecialchars($birth_date->format('F j, Y'), ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
    </tbody>
</table>

    </main>

    <footer>
        <p>CS2623 - Server-Side Programming</p>
    </footer>
</body>
</html>