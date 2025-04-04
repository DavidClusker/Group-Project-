<?php
include('partial/menu.php');?>

<div="main">
    <div class="wrapper text-center">
        <h1>Update Password</h1>
        <br />
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id']; // Get the ID of the admin to be updated
        } else {
            header('location: manage-Admin.php'); // Redirect to manage admin page if no ID is provided
        }
        ?>
        <form action="" method="POST" class="text-center">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Enter current password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="Enter new password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm new password"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Update Password" class="btn-secondary">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_password" value="<?php echo $current_password; ?>">
                </td>
                </tr>
            </table>
</form>
        <!-- Button to add admin -->
        
        <!-- Button to delete admin -->
        <br />

        <?php
        if(isset($_POST['submit'])) {
            // Get the data from form
            $current_password = md5($_POST['current_password']); // Encrypt current password
            $new_password = md5($_POST['new_password']); // Encrypt new password
            $confirm_password = md5($_POST['confirm_password']); // Encrypt confirm password

            // Check if current password matches the one in database
            $sql = "SELECT * FROM admin WHERE ID=$id AND Password='$current_password'"; // SQL query to select admin by ID and current password
            $res = mysqli_query($conn, $sql); // Execute the query

            if($res == true) {
                // Check if we have data in database
                $count = mysqli_num_rows($res); // Get the number of rows in the result set
                if($count == 1) {

                    else(
                        //user not found
                        $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";
                        header('location: manage-Admin.php'); // Redirect to manage admin page
                    
                    )
                    // Current password is correct, update to new password
                    if($new_password == $confirm_password) {
                        // New password and confirm password match
                        $sql2 = "UPDATE admin SET Password='$new_password' WHERE ID=$id"; // SQL query to update password
                        $res2 = mysqli_query($conn, $sql2); // Execute the query

                        if($res2 == true) {
                            $_SESSION['update'] = "<div class='success'>Password updated successfully.</div>";
                            header('location: manage-Admin.php'); // Redirect to manage admin page
                        } else {
                            $_SESSION['update'] = "<div class='error'>Failed to update password.</div>";
                            header('location: manage-Admin.php'); // Redirect to manage admin page
                        }
                    } else {
                        $_SESSION['update'] = "<div class='error'>New password and confirm password do not match.</div>";
                        header('location: manage-Admin.php'); // Redirect to manage admin page
                    }
                } else {
                    $_SESSION['update'] = "<div class='error'>Current password is incorrect.</div>";
                    header('location: manage-Admin.php'); // Redirect to manage admin page
                }
            }
        }
        ?>
        <br />
<?php
include('partial/foot.php');

?>