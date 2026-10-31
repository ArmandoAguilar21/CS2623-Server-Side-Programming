<?php
declare(strict_types=1);

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD') ?? 'GET';

if ($method === 'POST') {
    $first = trim(filter_input(INPUT_POST, 'first_name', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR) ?: '');
    $last = trim(filter_input(INPUT_POST, 'last_name', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR) ?: '');

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL, FILTER_REQUIRE_SCALAR);
    if ($email === false || $email === null) {
        $email_error = 'Please enter a valid email address.';
        $email = '';
    } else {
        $email_error = '';
    }

    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, [
        'flags' => FILTER_REQUIRE_SCALAR,
        'options' => ['min_range' => 0],
    ]);
    if ($age === false || $age === null) {
        $age_error = 'Please enter a valid whole number for age.';
        $age = 0;
    } else {
        $age_error = '';
    }

    $gender = filter_input(INPUT_POST, 'gender', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR) ?: 'not specified';
    if (!in_array($gender, ['Female', 'Male', 'Other'], true)) {
        $gender = 'not specified';
    }

    $country = filter_input(INPUT_POST, 'country', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR) ?: '';
    if (!in_array($country, ['', 'United States', 'Canada', 'United Kingdom', 'Other'], true)) {
        $country = '';
    }

    $comments = filter_input(INPUT_POST, 'comments', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR) ?: '';
}
?>

<!-- HTML  form: first name, last name, email, age, gender radio, country select, comments
textarea, POST -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Form</title>
</head>
<body>
    <h1>Personal Information</h1>

    <form method="post" action="">
        <div>
            <label for="first_name">First name:</label>
            <input type="text" id="first_name" name="first_name">
        </div>

        <div>
            <label for="last_name">Last name:</label>
            <input type="text" id="last_name" name="last_name">
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <?php if (!empty($email_error)): ?>
                <span><?= htmlspecialchars($email_error, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age">
            <?php if (!empty($age_error)): ?>
                <span><?= htmlspecialchars($age_error, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
        </div>

        <fieldset>
            <legend>Gender:</legend>
            <label>
                <input type="radio" name="gender" value="Female">
                Female
            </label>
            <label>
                <input type="radio" name="gender" value="Male">
                Male
            </label>
            <label>
                <input type="radio" name="gender" value="Other">
                Other
            </label>
        </fieldset>

        <div>
            <label for="country">Country:</label>
            <select id="country" name="country">
                <option value="">Select a country</option>
                <option value="United States">United States</option>
                <option value="Canada">Canada</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div>
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" rows="4" cols="40"></textarea>
        </div>

        <button type="submit">Submit</button>
    </form>


<?php if ($method === 'POST'): ?>
<h2>Submitted Information</h2>
<p><strong>Name:</strong>
 <?= htmlspecialchars($first . ' ' . $last, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Email:</strong>
 <?= htmlspecialchars($email ?: '(invalid)', ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Age:</strong>
 <?= htmlspecialchars((string)$age, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Gender:</strong>
 <?= htmlspecialchars($gender, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Country:</strong>
 <?= htmlspecialchars($country, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Comments:</strong><br>
 <?= nl2br(htmlspecialchars($comments, ENT_QUOTES, 'UTF-8')) ?></p>
<?php endif; ?>

</body>
</html>