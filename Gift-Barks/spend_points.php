<?php
session_start();
$conn = new mysqli("localhost", "root", "", "giftbarks");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to spend points.");
}

$user_id = $_SESSION['user_id'];

// Fetch the user's current points
$sql = "SELECT points FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_points = $row['points'];

    // Check if the user has enough points
    if ($current_points >= 10) {
        // Deduct 10 points
        $new_points = $current_points - 10;

        // Update the user's points in the database
        $update_sql = "UPDATE users SET points = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $new_points, $user_id);
        $update_res = $update_stmt->execute();

        if ($update_res) {
            // Points deducted successfully
            $_SESSION['message'] = "10 points have been spent successfully!";
        } else {
            // Failed to deduct points
            $_SESSION['message'] = "Failed to spend points. Please try again.";
        }
    } else {
        // Not enough points
        $_SESSION['message'] = "You do not have enough points to perform this action.";
    }
} else {
    // User not found
    $_SESSION['message'] = "User not found. Unable to spend points.";
}

// Redirect back to the profile page
header("Location: Profile.html");
exit();
?>