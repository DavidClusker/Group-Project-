<?php
session_start();
$conn = new mysqli("localhost", "root", "", "giftbarks");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    if (empty($_POST['username']) || empty($_POST['password'])) {
        die("Username and password are required.");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check for special admin credentials
    if ($username === "admin" && $password === "admin123") {
        // Redirect to admin.php
        header("Location: Admin/admin.php");
        exit();
    }

    // Prepare statement for regular user login
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashedPassword);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Store user data in session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            // Redirect to success page
            header("Location: Profile.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with this username.";
    }

    $stmt->close();
}

$conn->close();
?>

