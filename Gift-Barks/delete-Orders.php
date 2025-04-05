<?php
include('partial/menu.php');

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the order ID from the URL

    // SQL query to delete the order
    $sql = "DELETE FROM orders WHERE ID=$id";
    $res = mysqli_query($conn, $sql); // Execute the query

    if ($res == true) {
        // Order deleted successfully, set session message and redirect
        $_SESSION['delete'] = "<div class='success'>Order deleted successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-Orders.php');
    } else {
        // Failed to delete order, set session message and redirect
        $_SESSION['delete'] = "<div class='error'>Failed to delete order.</div>";
        header('location:' . SITEURL . 'admin/manage-Orders.php');
    }
} else {
    // Redirect to manage-orders.php if no ID is provided
    header('location:' . SITEURL . 'admin/manage-Orders.php');
}
?>
