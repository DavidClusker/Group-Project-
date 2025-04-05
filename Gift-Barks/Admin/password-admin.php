<?php
session_start(); // Start the session to manage session messages
include('partial/menu.php'); // Include the navigation menu

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the admin ID from the URL
} else {
    // Redirect to manage-admin.php if no ID is provided
    $_SESSION['user-not-found'] = "<div class='error'>Invalid admin ID.</div>";
    header('location:' . SITEURL . 'manage-Admin.php');
    exit();
}
?>

<div class="main">
    <div class="wrapper">
        <h1 class="text-center">Update Password</h1>
        <br />
        <!-- Display session messages -->
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; // Display success message for password update
            unset($_SESSION['update']); // Clear the session message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; // Display error message if user is not found
            unset($_SESSION['user-not-found']); // Clear the session message
        }
        if (isset($_SESSION['password-not-match'])) {
            echo $_SESSION['password-not-match']; // Display error message if passwords do not match
            unset($_SESSION['password-not-match']); // Clear the session message
        }
        ?>
        <br />
        <!-- Form to update the admin password -->
        <form action="" method="POST" class="tbl-30">
            <table>
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Enter current password" required></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="Enter new password" required></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm new password" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Hidden field to pass admin ID -->
                        <input type="submit" name="submit" value="Change Password" class="btn-primary"> <!-- Submit button -->
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Get the data from the form
    $current_password = md5($_POST['current_password']); // Hash the current password
    $new_password = md5($_POST['new_password']); // Hash the new password
    $confirm_password = md5($_POST['confirm_password']); // Hash the confirm password
    $id = $_POST['id']; // Get the admin ID from the form

    // Check if the current password matches the one in the database
    $sql = "SELECT * FROM admin WHERE ID=$id AND Password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res); // Get the number of rows in the result set
        if ($count == 1) {
            // Current password matches
            if ($new_password == $confirm_password) {
                // Update the password in the database
                $sql2 = "UPDATE admin SET Password='$new_password' WHERE ID=$id";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    // Password updated successfully
                    $_SESSION['update'] = "<div class='success'>Password updated successfully.</div>";
                    header('location: manage-Admin.php'); // Redirect to manage admin page
                    exit();
                } else {
                    // Failed to update password
                    $_SESSION['update'] = "<div class='error'>Failed to update password. Please try again later.</div>";
                    header('location: password-admin.php?id=' . $id); // Redirect back to the password update page
                    exit();
                }
            } else {
                // New password and confirm password do not match
                $_SESSION['password-not-match'] = "<div class='error'>New password and confirm password do not match.</div>";
                header('location: password-admin.php?id=' . $id); // Redirect back to the password update page
                exit();
            }
        } else {
            // Current password does not match
            $_SESSION['user-not-found'] = "<div class='error'>Current password is incorrect.</div>";
            header('location: password-admin.php?id=' . $id); // Redirect back to the password update page
            exit();
        }
    } else {
        // Query failed
        $_SESSION['user-not-found'] = "<div class='error'>Failed to fetch user credentials. Please try again later.</div>";
        header('location: manage-Admin.php'); // Redirect to manage admin page
        exit();
    }
}
?>

<?php include('partial/foot.php'); // Include the footer ?>