<?php
session_start(); // Start the session to access the logged-in user's data
require __DIR__ . '/vendor/autoload.php';

$stripe_secret_key = "sk_test_51RA9ZmCYMgYM0oh4ijwsdSjtHXukhHwiGmRZoS5ofbBMcBIBJqa84c7OgUDgucSz1CdVIOS8ivVw0kQ2Wt8IPM5G00b4JabQJ2";

\Stripe\Stripe::setApiKey($stripe_secret_key);

// Retrieve user_id from session
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("User not logged in.");
}

// Retrieve values from POST
$room = $_POST['room'] ?? 'Unknown Room';
$price = $_POST['price'] ?? 0; // Price in euros
$full_name = $_POST['full-name'] ?? 'Unknown';
$email = $_POST['email'] ?? 'Unknown';
$address = $_POST['address'] ?? 'Unknown';

// Convert price to cents (Stripe requires amounts in the smallest currency unit)
$price_in_cents = $price * 100;

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur', // Set currency to Euro
            'product_data' => [
                'name' => $room,
            ],
            'unit_amount' => $price_in_cents, // Amount in cents
        ],
        'quantity' => 1,
    ]],
    'customer_email' => $email, // Pre-fills the customer's email
    'metadata' => [
        'user_id' => $user_id, // Pass the logged-in user's ID
        'full_name' => $full_name,
        'address' => $address,
    ],
    'mode' => 'payment',
    'success_url' => 'http://localhost/Gift-Barks/payment_success.php?session_id={CHECKOUT_SESSION_ID}',
    //'cancel_url' => 'http://localhost/Gift-Barks/cancel.html', this doesnt work, it should be a page that exists
]);

http_response_code(303);
header("Location: " . $checkout_session->url);