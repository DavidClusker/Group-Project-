<?php include('../configs/constants.php'); // Include the database connection and constants ?>
<html>
    <head>
        <title>GiftBarks</title>
        <link rel="stylesheet" href="../css/admin.css"> <!-- Link to the admin CSS file -->
    </head>
    <body>
        <!-- Navbar section -->
        <div class="menu text-center">
            <ul>
                <div class="wrapper">
                    <li><a href="admin.php">Home</a></li> <!-- Link to the admin dashboard -->
                    <li><a href="manage-Admin.php">Admin</a></li> <!-- Link to manage admins -->
                    <li><a href="manage-Category.php">Category</a></li> <!-- Link to manage categories -->
                    <li><a href="manage-Drinks.php">Drinks</a></li> <!-- Link to manage drinks -->
                    <li><a href="manage-Orders.php">Order</a></li> <!-- Link to manage orders -->
                </div>
            </ul>
        </div>
    </body>
</html>