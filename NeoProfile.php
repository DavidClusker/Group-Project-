<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Giftbarks";//uses the giftbarks database
$conn = new mysqli($servername, $username, $password, $dbname);//creates a new sql inquiry
if ($conn->connect_error) {
    die("No server sorry: " . $conn->connect_error);
}
$sql = "SELECT username FROM users ORDER BY RAND() LIMIT 1";//finds username in the users table
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["username"];//allows the username to be shown
} else {
    echo "No words found";
}
$conn->close();//stops rendering the connection
?>