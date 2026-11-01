<?php
declare(strict_types=1);
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD') ?? 'GET';
if ($method === 'POST') {
    //Debugging: Display the contents of the $_POST array for debugging purposes.
    echo "<pre>DEBUG POST: " . print_r($_POST, true) . "</pre>";
 $cust_name = filter_input(INPUT_POST, 'cust_name') ?? '';
 $product = filter_input(INPUT_POST, 'product') ?? '';
 $quantity = filter_input(INPUT_POST, 'quantity',
FILTER_VALIDATE_INT) ?? 1;
 $payment = filter_input(INPUT_POST, 'payment') ?? 'none';
 $instructions = filter_input(INPUT_POST, 'instructions') ?? '';
 // Checkbox array — FILTER_REQUIRE_ARRAY keeps the submitted values as an array.
 $options = filter_input(
     INPUT_POST,
     'options',
     FILTER_SANITIZE_SPECIAL_CHARS,
     ['flags' => FILTER_REQUIRE_ARRAY]
 ) ?? [];
 if (!is_array($options)) {
     $options = [];
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        .order-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 320px), 1fr));
            gap: 2rem;
            max-width: 1000px;
        }

        .order-summary {
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>

<h1>Order Form</h1>

<main class="order-layout">
<form method="POST" action="">

    <label for="cust_name">Customer Name:</label>
    <input type="text" id="cust_name" name="cust_name" required>
    <br><br>

    <label for="product">Product:</label>
    <select id="product" name="product" required>
        <option value="">Select a product</option>
        <option value="PlayStation 5 - $799.99">PlayStation 5 - $799.99</option>
        <option value="PS5 Controller - $59.99">PS5 Controller - $59.99</option>
        <option value="Grand Theft Auto VI - $69.99">Grand Theft Auto VI - $69.99</option>
        <option value="Xbox Series X - $499.99">Xbox Series X - $499.99</option>
        <option value="Xbox Controller - $59.99">Xbox Controller - $59.99</option>
        <option value="Gears of War: E-Day - $69.99">Gears of War: E-Day - $69.99</option>
        <option value="Monitor - $199.99">Monitor - $199.99</option>
    </select>
    <br><br>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" value="1" required>
    <br><br>

   
    <p>Options:</p>

    <input type="checkbox" id="gift" name="options[]" value="Gift Wrapping">
    <label for="gift">Gift Wrapping</label>
    <br>
    <input type="checkbox" id="extended" name="options[]" value="Extended Warranty">
    <label for="extended">Extended Warranty</label>
    <br>
    <input type="checkbox" id="insurance" name="options[]" value="Shipping Insurance">
    <label for="insurance">Shipping Insurance</label>
    <br>
    <input type="checkbox" id="express" name="options[]" value="Express Shipping">
    <label for="express">Express Shipping</label>
    <br><br>
    <p>Payment Method:</p>

    <input type="radio" id="credit_card" name="payment" value="Credit Card" required>
    <label for="credit_card">Credit Card</label>
    <input type="radio" id="debit_card" name="payment" value="Debit Card">
    <label for="debit_card">Debit Card</label>
    <input type="radio" id="paypal" name="payment" value="PayPal">
    <label for="paypal">PayPal</label>
    <br><br>

    <p>Special Instructions:</p>
    <textarea id="instructions" name="instructions" rows="4" cols="50"></textarea>
    <br><br>


    <button type="submit">Place Order</button>

</form>

<?php if ($method === 'POST'): ?>
<section class="order-summary" aria-labelledby="summary-heading">
<h2 id="summary-heading">Order Summary</h2>
<p><strong>Customer:</strong>
 <?= htmlspecialchars($cust_name, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Product:</strong>
 <?= htmlspecialchars($product, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Quantity:</strong>
 <?= htmlspecialchars((string)$quantity, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Payment:</strong>
 <?= htmlspecialchars($payment, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Selected Options:</strong></p>
<ul>
<?php foreach ($options as $opt): ?>
 <li><?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?></li>

 <?php endforeach; ?>
</ul>
<p><strong>Instructions:</strong><br>
 <?= nl2br(htmlspecialchars($instructions, ENT_QUOTES, 'UTF-8')) ?></p>
</section>
<?php endif; ?>
</main>
