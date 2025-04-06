<?php
session_start();
header('Content-Type: application/json');

// Database connection
$conn = new mysqli("localhost", "root", "", "giftbarks");

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to deduct points.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Decode the JSON request body
$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'deduct' && isset($data['points'])) {
    $points_to_deduct = (int) $data['points'];

    // Fetch the user's current points
    $sql = "SELECT points FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_points = $row['points'];

        if ($current_points >= $points_to_deduct) {
            // Deduct points
            $new_points = $current_points - $points_to_deduct;
            $update_sql = "UPDATE users SET points = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ii", $new_points, $user_id);
            if ($update_stmt->execute()) {
                echo json_encode(['success' => true, 'new_points' => $new_points]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update points.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Not enough points.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$conn->close();
?>