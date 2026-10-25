<?php
declare(strict_types=1);

//Original String
$description = "Michale Jacksons Thriller sold roughly 70000000 copies worldwide, making around 130000000 dollars in revenue.";

// Replace a word
$replaceOutput = str_replace("Thriller", "Bad", $description);

// Check whether the description contains "PHP"
$containsOutput = str_contains($description, "PHP");

// Convert to lowercase and uppercase
$lowercaseOutput = strtolower($description);
$uppercaseOutput = strtoupper($description);

// Count characters (bytes for this ASCII text)
$lengthOutput = strlen($description);

// Format revenue as a price
$revenue = 130000000;
$priceOutput = sprintf("$%.2f", 130000000);

// Format copies sold with commas
$copiesSold = 70000000;
$numberOutput = number_format($copiesSold);

// Extract the first 30 characters
$substringOutput = substr($description, 0, 30);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSP04 — String Functions & Date/Time</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <h1>SSP04 - String Functions</h1>
    </header>

    <main>
       
<h2>String Function Results</h2>
<p>
    Original String: <?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?>
</p>

<table>
    <thead>
        <tr>
            <th>Function</th>
            <th>Input</th>
            <th>Output</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>str_replace()</td>
            <td>"Thriller" "Bad"</td>
            <td><?php echo htmlspecialchars($replaceOutput, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>str_contains()</td>
            <td>"PHP"</td>
            <td><?php echo $containsOutput ? 'true' : 'false'; ?></td>
        </tr>
        <tr>
            <td>strtolower()</td>
            <td>Original description</td>
            <td><?php echo htmlspecialchars($lowercaseOutput, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>strtoupper()</td>
            <td>Original description</td>
            <td><?php echo htmlspecialchars($uppercaseOutput, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>strlen()</td>
            <td>Original description</td>
            <td><?php echo $lengthOutput; ?></td>
        </tr>
        <tr>
            <td>sprintf("$%.2f", 130000000)</td>
            <td>130000000</td>
            <td><?php echo htmlspecialchars($priceOutput, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>number_format(70000000)</td>
            <td>70000000</td>
            <td><?php echo htmlspecialchars($numberOutput, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <tr>
            <td>substr()</td>
            <td>First 30 characters</td>
            <td><?php echo htmlspecialchars($substringOutput, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
    </tbody>
</table>

    </main>

    <footer>
        <p>CS2623 - Server-Side Programming</p>
    </footer>
</body>
</html>
