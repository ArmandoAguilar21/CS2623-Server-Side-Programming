<?php declare(strict_types=1);
class ValidationException extends RuntimeException {}
class FormatException extends validationException {}
class DatabaseException extends RuntimeException {}
function validateContact(array $data): array {
 $errors = [];
 // Email — use filter_var, NOT a custom regex
 if (!filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
 $errors[] = 'Invalid email address.';
 }
 // URL — use filter_var, NOT a custom regex
$url = $data['url'] ?? '';
if ($url !== '' && !filter_var($url, FILTER_VALIDATE_URL)) {
    $errors[] = 'Invalid URL address.';
}
 // Phone — filter_var has no phone validator; use preg_match
 $phone = $data['phone'] ?? '';
 if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
 $errors[] = 'Phone must be in format 555-555-5555.';
 }
 // ZIP code
 $zip = $data['zip'] ?? '';
 if (!preg_match('/^\d{5}(-\d{4})?$/', $zip)) {
 $errors[] = 'ZIP must be 5 digits or ZIP+4 (e.g. 74103 or 74103-1234).';
 }
 // Product code — two uppercase letters followed by four digits
$productCode = $data['product_code'] ?? '';

if (!preg_match('/^[A-Z]{2}\d{4}$/', $productCode)) {
    throw new FormatException(
        'Product code must contain two uppercase letters followed by four digits.'
    );
}
 if ($errors) {
 throw new ValidationException(implode(' | ', $errors));
 }
 return $data;
}
$result = null;
$errMsg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $raw = [
 'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS)
?? '',

 'url' => filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS)
?? '',

 'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS)
?? '',
 'zip' => filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_SPECIAL_CHARS)
?? '',
 'notes' => filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_SPECIAL_CHARS)
?? '',
'message' => filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS) ?? '',
'product_code' => filter_input(INPUT_POST, 'product_code', FILTER_SANITIZE_SPECIAL_CHARS) ?? ''

];
 try {
 $result = validateContact($raw);
 } catch (FormatException $e) { // specific first
 $errMsg = $e->getMessage();
 } catch (ValidationException $e) { // specific first
 $errMsg = $e->getMessage();
 } catch (RuntimeException $e) { // broader next
 $errMsg = 'System error: ' . $e->getMessage();
 } finally {
 // runs regardless — good for logging
 error_log('Contact form processed at ' . date('Y-m-d H:i:s'));
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Ex 15-1 Validation</title></head>
<body>
<h1>Contact Form Validation</h1>
<?php if ($errMsg): ?>
 <div class="error">
 <?= htmlspecialchars($errMsg, ENT_QUOTES, 'UTF-8') ?>
 </div>
<?php endif; ?>
<?php if ($result): ?>
 <p>✓ All fields valid — ready to save.</p>
 <ul>
 <li>Email: <?= htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8')
?></li>
<li>URL: <?= htmlspecialchars($result['url'], ENT_QUOTES, 'UTF-8') 
?></li>
 <li>Phone: <?= htmlspecialchars($result['phone'], ENT_QUOTES, 'UTF-8')
?></li>
 <li>ZIP: <?= htmlspecialchars($result['zip'], ENT_QUOTES, 'UTF-8')
?></li>
<li>Product Code: <?= htmlspecialchars($result['product_code'], ENT_QUOTES, 'UTF-8')
?></li>
<p>Message:</p>
<div>
    <?= nl2br(htmlspecialchars($result['message'], ENT_QUOTES, 'UTF-8')) ?>
</div>
 </ul>
<?php endif; ?>
<form method="post">
 <label>Email: <input type="text" name="email"></label><br>
 <label>URL: <input type="text" name="url"></label><br>
 <label>Phone (555-555-5555): <input type="text" name="phone"></label><br>
 <label>ZIP: <input type="text" name="zip"></label><br>
 <label>Product Code (Ex.AA1234): <input type="text" name="product_code"></label><br>
 <label>Notes:<br>
 <textarea name="notes" rows="4" cols="40"></textarea>
 </label><br>
 <label>Message:<br>
 <textarea name="message" rows="4" cols="40"></textarea>
 <button type="submit">Validate</button>
</form>
</body></html>
