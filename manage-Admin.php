<?php include('partial/menu.php'); ?>
<!--Drink section end-->


<!--Main section starts-->
<div class="main">
<div class="wrapper text-center">
    <h1>Manage Admin</h1>
    <br />

    <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add']; // Display session message
        unset($_SESSION['add']); // Remove session message
    }
    if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete']; // Display session message
        unset($_SESSION['delete']); // Remove session message
    }
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update']; // Display session message
        unset($_SESSION['update']); // Remove session message
    }
    if(isset($_SESSION['user-not-found'])) {
        echo $_SESSION['user-not-found']; // Display session message
        unset($_SESSION['user-not-found']); // Remove session message
    }
    if(isset($_SESSION['password-not-match'])) {
        echo $_SESSION['password-not-match']; // Display session message
        unset($_SESSION['password-not-match']); // Remove session message
    }
    ?>
    <!-- Button to add admin -->
     <a href="add-Admin.php" class="btn-primary">Add Admin</a>
     <!-- Button to delete admin -->
      <br />
    <table class="tbl-full">
        <tr>
            <th>Serial Num.</th>
            <th>Name</th>
            <th>Username</th>
            <th>Actions</th>
</tr>
<?php
$sql = "SELECT * FROM admin"; // SQL query to select all admins
$res = mysqli_query($conn, $sql); // Execute the query
if($res == true) {
    // Count rows to check if we have data in database
    $count = mysqli_num_rows($res); // Get the number of rows in the result set
    $sn = 1; // Initialize serial number
    if ($count > 0) {
        // We have data in database
        while ($rows = mysqli_fetch_assoc($res)) {
            // Using while loop to get all data from database
            // Using $rows['admin_id'] to get individual data
            $id = $rows['ID']; // Get admin ID
            $name = $rows['Name']; // Get admin name
            $username = $rows['Username']; // Get admin username
            ?>
            <tr>
                <td><?php echo $sn++; ?></td> <!-- Display serial number -->
                <td><?php echo $name; ?></td> <!-- Display admin name -->
                <td><?php echo $username; ?></td> <!-- Display admin username -->
                <td>
                <a href="password-admin.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a> <!-- Button to change password -->    
                <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Delete Admin</a>
                <a href="update-admin.php?id=<?php echo $id; ?>" class="btn-tertiary">Update Admin</a></td> <!-- Action buttons for delete and update -->
            </tr>
            <?php
        }
    } else {
        // No data in database


        ?>
        <tr>
            <td colspan="4"><div class="error">No Admins Added Yet.</div></td>
        </tr>
        <?php
    }
} else {
    // Failed to execute query
    ?>
    <tr>
        <td colspan="4"><div class="error">Failed to Fetch Data.</div></td>
    </tr>
    <?php
}
?>



</div>
<!--Main section end-->

<!--Drink section starts-->
<?php include('partial/foot.php'); ?>                      