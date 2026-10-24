<?php
declare(strict_types=1);
require_once __DIR__ . '/PHP/functions_ssp03.php';
require_once __DIR__ . '/PHP/include_header.php';
// ── Timezone fix for Apollo server (runs UCT, 6 hrs ahead of CDT) ──
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$current_day = (int)$now->format('N'); // 1 = Monday … 7 = Sunday
fn_tableOpen('CS-2623 Weekly Study Planner');
// loop Mon-Sun, highlight current day
for ($day = 1; $day <= 7; $day++) {
    $name = fn_dayOfWeek($day);
    $details = fn_dayDetails($day);
    $time = fn_dayTime($day);

    if ($day === $current_day) {
        fn_tableRowCurrent($name, $details, $time);
    } else {
        fn_tableRow($name, $details, $time);
    }
}
fn_tableClose();
require_once __DIR__ . '/PHP/include_footer.php';
?>