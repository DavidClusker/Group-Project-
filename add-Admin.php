<?php
include('partial/menu.php');
?>

<div class="main">
    <div class="wrapper text-center">
        <h1>Add Admin</h1>
        <br />
        <!-- Button to add admin -->
        <a href="addAdmin.php" class="btn-primary">Add Admin</a>
        <!-- Button to delete admin -->
        <br />
        <form action="" method="POST" class="text-center">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

    </div>

<?php include('partial/foot.php'); ?>

<?php
// add admin to database
if (isset($_POST['submit'])) {
    // get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // password encryption with md5

    // include database connection
    include('../configs/constants.php');

    // sql query to save admin to database
    $sql = "INSERT INTO admin SET
        name='$full_name',  /* Updated column name */
        username='$username',
        password='$password'
    ";

    // execute the query(saves in database)
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // check if the query executed successfully
    if ($res == true) {
        // query executed successfully and admin added
        $_SESSION['add'] = "<div class='success'>Admin added successfully.</div>";
        header('location: manage-Admin.php');
    } else {
        // failed to add admin
        $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";
        header('location: manage-Admin.php');
    }
}
?>