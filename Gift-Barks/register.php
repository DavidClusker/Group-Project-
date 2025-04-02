<?php
session_start();// this is the connection to are database called giftbarks
$conn = new mysqli("localhost", "root", "", "giftbarks");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");// this is the sql query that selects the id from useres where email is equal
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "Email already exists. Try logging in.";//only one email can be used for the login 
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            // Redirect to success page
            header("Location: success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
$conn->close();
?>
