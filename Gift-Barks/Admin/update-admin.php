<?php
include('partial/menu.php');?>
<div class="main">
    <div class="wrapper text-center">
        <h1>Update Admin</h1>
        <br />
        <!-- Button to add admin -->
        <a href="addAdmin.php" class="btn-primary">Add Admin</a>
        <!-- Button to delete admin -->
        <br />


        <?php
        $id = $_GET['id']; // Get the ID of the admin to be updated
        
        $sql = "SELECT * FROM admin WHERE ID=$id"; // SQL query to select admin by ID
        $res = mysqli_query($conn, $sql); // Execute the query

        if ($res == true) {
            // Check if we have data in database
            $count = mysqli_num_rows($res); // Get the number of rows in the result set
            if ($count == 1) {
                // We have data in database
                $rows = mysqli_fetch_assoc($res); // Fetch the data
                $full_name = $rows['Name']; // Get admin name
                $username = $rows['Username']; // Get admin username
            } else {
                // No data in database
                header('location: manage-Admin.php'); // Redirect to manage admin page
            }
        }
        ?> 
        <form action="" method="POST" class="text-center">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name;?>"
                </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username;?>"
                </td>
                </tr>
                
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

    </div>

    <?php
    if(isset($_POST['submit'])) {
        // Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        
        // SQL query to update admin in database
        $sql = "UPDATE admin SET
            Name='$full_name',  /* Updated column name */
            Username='$username'
            WHERE ID=$id
        ";

        // Execute the query (updates in database)
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Check if the query executed successfully
        if ($res == true) {
            // Query executed successfully and admin updated
            $_SESSION['update'] = "<div class='success'>Admin updated successfully.</div>";
            header('location: manage-Admin.php'); // Redirect to manage admin page
        } else {
            // Failed to update admin
            $_SESSION['update'] = "<div class='error'>Failed to update admin.</div>";
            header('location: manage-Admin.php'); // Redirect to manage admin page
        }
    }

    ?>
