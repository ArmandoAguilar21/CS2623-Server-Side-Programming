<?php
/*
* include_dynamic_content.php 
* CS2623 SSP02 - Week 1
* Dynamically generates a weekly planner table using a for loop.
*/
?>

<!-- Weekly Planner Table -->
<table id ="weekly-planner">    
    <caption>CS2623 Weekly Planner — Armando Aguilar</caption>
  <thead>
    <tr>
        <th scope="col">Day of Week</th>
        <th scope="col">Task</th>
        <th scope="col">Time (hrs.)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Array of days and activities
    $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
    $Task = ["Math Class", "Science Lab", "History Lecture", "Art Workshop", "Physical Education"];

    //Adding a for loop to generate table rows dynamically, each day would now appear in the table with a corresponding task and time.
    for ($i = 0; $i < count($days); $i++) {
        $hours = number_format(($i + 1) / 2, 1);
        echo "<tr>";
        echo " <td>" . htmlspecialchars($days[$i], ENT_QUOTES, "UTF-8") . "</td>";
        echo " <td>" . htmlspecialchars($Task[$i % count($Task)], ENT_QUOTES, "UTF-8") . "</td>";
        echo " <td>" . htmlspecialchars($hours, ENT_QUOTES, "UTF-8") . "</td>";
        echo "</tr>\n";
    }
        ?>
    </tbody>
</table>


