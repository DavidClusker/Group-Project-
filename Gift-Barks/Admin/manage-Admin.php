<?php
session_start(); // Start the session to manage session messages
include('partial/menu.php'); // Include the navigation menu
?>

<div class="main">
    <div class="wrapper">
        <h1 class="text-center">Manage Admin</h1>
        <br />
        <!-- Display session messages -->
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // Display success message for adding an admin
            unset($_SESSION['add']); // Clear the session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; // Display success message for deleting an admin
            unset($_SESSION['delete']); // Clear the session message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; // Display success message for updating an admin
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
        <!-- Center the Add Admin button -->
        <div class="text-center">
            <a href="add-Admin.php" class="btn-primary">Add Admin</a> <!-- Button to add a new admin -->
        </div>
        <br /><br />
        <!-- Table to display all admins -->
        <table class="tbl-full">
            <tr>
                <th>Serial Num.</th>
                <th>Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM admin"; // SQL query to fetch all admins
            $res = mysqli_query($conn, $sql); // Execute the query
            if ($res == true) {
                $count = mysqli_num_rows($res); // Get the number of rows in the result set
                $sn = 1; // Initialize serial number
                if ($count > 0) {
                    // Loop through each admin and display their details
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['ID'];
                        $name = $rows['Name'];
                        $username = $rows['Username'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td> <!-- Display serial number -->
                            <td><?php echo $name; ?></td> <!-- Display admin name -->
                            <td><?php echo $username; ?></td> <!-- Display admin username -->
                            <td>
                                <!-- Action buttons for each admin -->
                                <a href="password-admin.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Delete Admin</a>
                                <a href="update-admin.php?id=<?php echo $id; ?>" class="btn-tertiary">Update Admin</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // No admins found in the database
                    ?>
                    <tr>
                        <td colspan="4"><div class="error">No Admins Added Yet.</div></td>
                    </tr>
                    <?php
                }
            } else {
                // Query failed
                ?>
                <tr>
                    <td colspan="4"><div class="error">Failed to Fetch Data.</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
