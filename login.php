<?php
//Database connection
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            echo "Login successful! <a href='welcome.php'>Go to Dashboard</a>";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with this email.";
    }
}
$conn->close();
?>
