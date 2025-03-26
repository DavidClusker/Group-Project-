<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "barks";

session_start();
$conn = new mysqli("localhost", "root", "", "giftbarks");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo "Email already exists. Try logging in.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            echo "Registration successful. <a href='login.html'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
$conn->close();
?>
