<?php 

declare(strict_types=1);


$fruits = ['apple', 'banana', 'cherry', 'date', 'elderberry'];
// Sort fruits alphabetically
$sortedFruits = $fruits;
sort($sortedFruits);

$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $search !== '') {
 $found = in_array($search, $fruits, true); // strict === comparison
 $message = $found ? "✓ Found: $search" : "✗ Not found: $search";
}
// array_map with arrow function (PHP 7.4+)
$upper = array_map(fn($f) => strtoupper($f), $fruits);

// Remove fruits shorter than 6 characters
$filtered = array_filter($fruits, fn($f) => strlen($f) >= 6);
// arrays of arrays — simulates a DB result set
$catalog = [['id' => 1, 'name' => 'Apple', 'price' => 1.29],
 ['id' => 2, 'name' => 'Banana', 'price' => 0.49],
 ['id' => 3, 'name' => 'Cherry', 'price' => 2.99],
];

?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Ex 11-1 Arrays</title></head>
<body>
<h1>Fruit Array Demo</h1>
<!-- Search form -->
<form method="post">
 <label>Search fruit:
 <input type="text" name="search"
 value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
 </label>
 <button type="submit">Search</button>
 <button type="submit" name="action" value="sort"> Sort A-Z </button>

</form>
<?php if ($message): ?>
 <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<h2>Original List (<?= count($fruits) ?> items)</h2>
<ul>
<?php foreach ($fruits as $f): ?>
 <li><?= htmlspecialchars($f, ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
</ul>
<h2>Filtered List (6 or More Characters)</h2>
<ul>
<?php foreach ($filtered as $f): ?>
    <li><?= htmlspecialchars($f, ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
</ul>
<h2>Uppercase (array_map + arrow fn)</h2>
<ul>


<?php foreach ($upper as $u): ?>
 <li><?= htmlspecialchars($u, ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
</ul>


<h2>Sorted List (A-Z)</h2>
<ul>
<?php foreach ($sortedFruits as $f): ?>
<li><?= htmlspecialchars($f, ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
</ul>
<h2>Catalog (array of arrays)</h2>
<table border="1">
 <tr><th>ID</th><th>Name</th><th>Price</th></tr>
<?php foreach ($catalog as $row): ?>
 <tr>
 <td><?= (int)$row['id'] ?></td>
 <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
 <td>$<?= number_format((float)$row['price'], 2) ?></td>
 </tr>
<?php endforeach; ?>
</table>
</body></html>
