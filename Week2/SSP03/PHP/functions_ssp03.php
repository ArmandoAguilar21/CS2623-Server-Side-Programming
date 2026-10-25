<?php

declare(strict_types=1);
/**
 * fn_tableOpen() - Opens a table with a caption.
 * @param string $caption The caption displayed above the table.
 * @return void
 */

function fn_tableOpen (string $caption) : void {

    echo '<table border="1" cellpadding="6" cellspacing="0">';
    echo '<caption style="background-color:#1B2A6B;color:#FFFFFF;">';
    echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8');
    echo '</caption>';
    echo '<tr style="background-color:#006B7D;color:#FFFFFF;">';
    echo '<th>Day</th><th>Details</th><th>Time</th>';
    echo '</tr>';

}
/**
 * fn_tableClose() - Closes a table.
 * @return void
 */
function fn_tableClose(): void {
 echo '</table>';
}

/**
 * fn_tableRowCurrent() - Outputs a table row for the current day.
 * @param string $day The name of the day.
 * @param string $details The scheduled activity or details.
 * @param string $time The scheduled time.
 * @return void
 */
function fn_tableRowCurrent(string $day, string $details, string $time):void 
{
 echo '<tr style="background-color:#FFFF66;">';
 echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
 echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') . '</td>';
 echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
 echo '</tr>';
}
/**
 * fn_tableRow() - Outputs a table row for a non-current day.
 * @param string $day The name of the day.
 * @param string $details The scheduled activity or details.
 * @param string $time The scheduled time.
 * @return void
 */
function fn_tableRow(string $day, string $details, string $time): void 
{
 echo '<tr>';
 echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
 echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') . '</td>';
 echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
 echo '</tr>';  
 }

/**
 * fn_dayOfWeek() - Returns the name of the day of the week for a given day number.
 * @param int $day_num The day number, from 1 (Monday) to 7 (Sunday).
 * @return string The name of the day, or 'Unknown Day' for an invalid number.
 */

 function fn_dayOfWeek(int $day_num) : string 
 {
    if ($day_num === 1) {
        return 'Monday';
    } elseif ($day_num === 2) {
        return 'Tuesday';
    } elseif ($day_num === 3) {
        return 'Wednesday';
    } elseif ($day_num === 4) {
        return 'Thursday';
    } elseif ($day_num === 5) {
        return 'Friday';
    } elseif ($day_num === 6) {
        return 'Saturday';
    } elseif ($day_num === 7) {
        return 'Sunday';
    } else {
        return 'Unknown Day';
    }
 }

 /**
 * fn_dayDetails() - Returns the details for a given day number.
 * @param int $day_num The day number, from 1 to 7.
 * @return string The activity details, or 'No schedule' for an invalid number.
 */
 function fn_dayDetails(int $day_num) : string
 {
    switch ($day_num) {
        case 1: return 'PHP lecture — Ch08 Conditionals';
        case 2: return 'Lab: SSP03 function library';
        case 3: return 'Study: string functions Ch09';
        case 4: return 'Lab: SSP04 exercises';
        case 5: return 'Quiz review + office hours';
        case 6: return 'Project work';
        case 7: return 'Rest day';
        default: return 'No schedule';

    }
 }
/**
 * fn_dayTime() - Returns the time for a given day number.
 * @param int $day_num The day number from 1 to 7.
 * @return string The scheduled time, or 'TBD' for an invalid number.
 */
 function fn_dayTime(int $day_num) : string
 {  if ($day_num === 1 || $day_num === 3) return '9:00 AM – 10:20 AM';
    elseif ($day_num === 2 || $day_num === 4) return '1:00 PM – 2:50 PM';
    elseif ($day_num === 5) return '10:00 AM – 11:00 AM';
    elseif ($day_num === 6 || $day_num === 7) return 'Flexible';
    else return 'TBD';
 }