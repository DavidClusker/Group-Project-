<?php
session_start();
$conn = new mysqli("localhost", "root", "", "giftbarks");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require __DIR__ . '/vendor/autoload.php';

$stripe_secret_key = "sk_test_51RA9ZmCYMgYM0oh4ijwsdSjtHXukhHwiGmRZoS5ofbBMcBIBJqa84c7OgUDgucSz1CdVIOS8ivVw0kQ2Wt8IPM5G00b4JabQJ2";

\Stripe\Stripe::setApiKey($stripe_secret_key);

// Retrieve the session ID from the URL
$session_id = $_GET['session_id'] ?? null;

if ($session_id) {
    // Retrieve the checkout session from Stripe
    $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);

    // Retrieve payment details
    $payment_intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
    $amount = $payment_intent->amount / 100; // Convert cents to euros
    $currency = strtoupper($payment_intent->currency);
    $status = $payment_intent->status;

    // Get user ID from the metadata
    $user_id = $checkout_session->metadata->user_id ?? null;

    if ($user_id) {
        // Fetch the user's current points from the database
        $sql = "SELECT points FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_points = $row['points'];

            // Calculate new points using the formula
            $new_points = ($amount * 10) + $current_points;

            // Update the user's points in the database
            $update_sql = "UPDATE users SET points = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("di", $new_points, $user_id);
            $update_res = $update_stmt->execute();

            if ($update_res) {
                // Points updated successfully
                $points_message = "Your points have been updated successfully!";
            } else {
                // Failed to update points
                $points_message = "Failed to update your points. Please contact support.";
            }
        } else {
            // User not found
            $points_message = "User not found. Unable to update points.";
        }
    } else {
        // No user ID provided
        $points_message = "No user ID provided. Unable to update points.";
    }
} else {
    die("Invalid session ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .success {
            color: green;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .details {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1 class="success">Payment Successful!</h1>
    <p class="details">Thank you for your payment.</p>
    <p class="details">Amount Paid: €<?php echo htmlspecialchars($amount); ?> <?php echo htmlspecialchars($currency); ?></p>
    <p class="details">Payment Status: <?php echo htmlspecialchars($status); ?></p>
    <p class="details"><?php echo $points_message; ?></p>
    <a href="Profile.php">Return to Home</a>
</body>
</html>