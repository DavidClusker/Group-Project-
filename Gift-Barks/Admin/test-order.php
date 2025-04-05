<?php
include('partial/menu.php'); // Ensure this file exists and is correctly included

// Check if the database connection is established
if (!isset($conn)) {
    include('../configs/constants.php'); // Include the database connection file if not already included
}

// Insert a test order into the database
$sql = "INSERT INTO orders (Drinks, Amount, Name, Email, RoomNum, Cost) 
        VALUES ('Test Drink', 1, 'Test User', 'test@example.com', '101', 10.00)";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    // Test order created successfully
    $_SESSION['add'] = "<div class='success'>Test order created successfully.</div>";
    header('location:' . SITEURL . 'admin/manage-Orders.php');
    exit();
} else {
    // Failed to create test order
    $_SESSION['add'] = "<div class='error'>Failed to create test order.</div>";
    header('location:' . SITEURL . 'admin/manage-Orders.php');
    exit();
}

include('partial/foot.php');
?>
