<?php include('partial/menu.php'); ?>

<div class="main-content">
    <div class="wrapper text-center">
        <h1>Update Orders</h1>
        <br />

        <br />
        <?php
        // Retrieve and validate the ID from the URL
        if (isset($_GET['id'])) {
            $id = $_GET['id']; // Get the order ID from the URL

            $sql = "SELECT * FROM orders WHERE ID=$id"; // SQL query to select the order with the given ID
            $res = mysqli_query($conn, $sql); // Execute the query
            $count = mysqli_num_rows($res); // Get the number of rows in the result set
            if($count == 1) {
                // Order found, retrieve the data
                $row = mysqli_fetch_assoc($res); // Fetch the order data
                $drink_name = $row['Drinks']; // Get drink name
                $amount = $row['Amount']; // Get amount
                $name = $row['Name']; // Get customer name
                $email = $row['Email']; // Get customer email
                $cost = $row['Cost']; // Get total cost
                $RoomNum = $row['RoomNum']; // Get room number
            } else {
                // Order not found, set session message and redirect
                $_SESSION['order-not-found'] = "<div class='error'>Order not found</div>";
                header('location:' . SITEURL . 'admin/manage-Orders.php');
                exit();
            }
        } else {
            // Redirect to manage-orders.php if no ID is provided
            header('location:' . SITEURL . 'admin/manage-Orders.php?id=' . $id);
            exit();
        }
        ?>

        <form action="" method="POST" class="text-center">
            <table class="tbl-30">
                <tr>
                    <!--display the form to update order details-->
                    <td>Drink Name:</td>
                    <td><b><input type ="text"name="drink" value="<?php   echo $drink_name;?>"></b></td>                </tr>
                <tr>
                    <td>Amount:</td>
                    <td><b><input type ="text"name="amount" value="<?php   echo $amount;?>"></b></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><b><input type ="text"name="name" value="<?php   echo $name;?>"></b></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><b><input type ="text"name="email" value="<?php   echo $email;?>"></b></td>                </tr>
                <tr>
                <tr>
                    <td>Cost:</td>
                    <td><b><input type="text" name="cost" value="<?php echo $cost; ?>"></b></td>
                </tr>
                <tr>
                    <td>Room Number:</td>
                    <td><b><input type="text" name="RoomNum" value="<?php echo $RoomNum; ?>"></b></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-primary">
                    </td>
                </tr>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </table>
        <?php
        if(isset($_POST['submit'])) {
            // Get the data from the form
            $id = $_POST['id']; // Get the order ID from the form
            $drink_name = $_POST['drink']; // Get drink name from the form
            $amount = $_POST['amount']; // Get amount from the form
            $name = $_POST['name']; // Get customer name from the form
            $email = $_POST['email']; // Get customer email from the form
            $cost = $_POST['cost']; // Get total cost from the form

            // SQL query to update the order in the database
            $sql2 = "UPDATE orders SET Drinks='$drink_name', Amount='$amount', Name='$name', Email='$email', Cost='$cost' WHERE ID=$id"; // SQL query to update the order with the given ID
            $res2 = mysqli_query($conn, $sql2); // Execute the query

            if ($res2 == true) {
                // Order updated successfully, set session message and redirect
                $_SESSION['update'] = "<div class='success'>Order updated successfully</div>";
                header('location:' . SITEURL . 'admin/manage-Orders.php');
                exit();
            } else {
                // Failed to update order, set session message and redirect
                $_SESSION['update'] = "<div class='error'>Failed to update order</div>";
                header('location:' . SITEURL . 'admin/manage-Orders.php');
                exit();
            }
        }
        // Display session messages if they exist
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']); // Remove the message after displaying it
        }
        if (isset($_SESSION['order-not-found'])) {
            echo $_SESSION['order-not-found'];
            unset($_SESSION['order-not-found']); // Remove the message after displaying it
        }
        ?>



<?php include('partial/foot.php');?>