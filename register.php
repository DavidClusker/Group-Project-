<?php
session_start(); // Start the session

// Connect to the database
$conn = new mysqli("localhost", "root", "", "giftbarks");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Check if the email already exists
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "Email already exists. Try logging in."; // Only one email can be used for the login
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Store the username in the session
            $_SESSION['username'] = $username;

            // Redirect to the profile page
            header("Location: success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $checkEmail->close();
    $stmt->close();
}

$conn->close();
?>