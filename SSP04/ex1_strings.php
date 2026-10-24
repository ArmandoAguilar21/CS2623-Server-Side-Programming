
<?php
declare(strict_types=1);

// Sample product description and values.
$description = "The UltraSound Headphones provide premium sound quality and comfortable wireless listening.";
$productPrice = 129.99;
$totalSold = 125000;

// Replace a word in the description.
$updatedDescription = str_replace(
    "UltraSound",
    "SoundWave",
    $description
);

// Check whether a keyword is present.
$keyword = "wireless";
$keywordFound = str_contains($description, $keyword);

// Change the letter case.
$lowercaseDescription = strtolower($description);
$uppercaseDescription = strtoupper($description);

// Count the number of bytes in the string.
// This sample contains only standard English characters.
$characterCount = strlen($description);

// Format the price with two decimal places.
$formattedPrice = sprintf("$%.2f", $productPrice);

// Format a large number with commas.
$formattedSales = number_format($totalSold);

// Extract the first 30 characters.
$descriptionExcerpt = substr($description, 0, 30);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSP04 - PHP String Functions</title>
    <link rel="stylesheet" href="../SSP01/main.css">
</head>
<body>
    <header>
        <h1>PHP String Functions</h1>
    </header>

    <main>
        <h2>Product Description Demonstration</h2>

        <h3>1. Original String</h3>
        <p><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></p>

        <h3>2. str_replace()</h3>
        <p>
            <?php echo htmlspecialchars($updatedDescription, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <h3>3. str_contains()</h3>
        <p>
            Does the description contain
            "<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>"?
            <?php echo $keywordFound ? 'Yes' : 'No'; ?>
        </p>

        <h3>4. strtolower() and strtoupper()</h3>
        <p>
            <strong>Lowercase:</strong>
            <?php echo htmlspecialchars($lowercaseDescription, ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p>
            <strong>Uppercase:</strong>
            <?php echo htmlspecialchars($uppercaseDescription, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <h3>5. strlen()</h3>
        <p>
            Description length:
            <?php echo $characterCount; ?> characters
        </p>

        <h3>6. sprintf()</h3>
        <p>
            Product price:
            <?php echo htmlspecialchars($formattedPrice, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <h3>7. number_format()</h3>
        <p>
            Total products sold:
            <?php echo htmlspecialchars($formattedSales, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <h3>8. substr()</h3>
        <p>
            First 30 characters:
            <?php echo htmlspecialchars($descriptionExcerpt, ENT_QUOTES, 'UTF-8'); ?>
        </p>
    </main>

    <footer>
        <p>CS2623 - Server-Side Programming</p>
    </footer>
</body>
</html>
